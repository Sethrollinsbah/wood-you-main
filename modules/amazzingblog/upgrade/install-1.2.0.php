<?php
/**
* 2007-2018 Amazzing
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
*
*  @author    Amazzing <mail@amazzing.ru>
*  @copyright 2007-2018 Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/

function upgrade_module_1_2_0($module_obj)
{
    if (!defined('_PS_VERSION_')) {
        exit;
    }

    $module_obj->prepareDatabase();
    $module_obj->db->execute('
        ALTER TABLE '._DB_PREFIX_.'a_blog_post
        ADD publish_from DATETIME NOT NULL AFTER date_add,
        ADD INDEX publish_from (publish_from),
        ADD publish_to DATETIME NOT NULL AFTER publish_from,
        ADD INDEX publish_to (publish_to)
    ');
    $module_obj->db->execute('
        UPDATE '._DB_PREFIX_.'a_blog_post
        SET publish_from = date_add
    ');

    // update compact variable in blocks
    $blocks = $module_obj->db->executeS('
        SELECT * FROM '._DB_PREFIX_.'a_blog_block
    ');
    $rows = array();
    foreach ($blocks as $b) {
        $settings = Tools::jsonDecode($b['settings'], true);
        if ($settings['display_type'] == 'compact_list') {
            $settings['display_type'] = 'list';
            $settings['compact'] = 1;
        }
        $b['settings'] = Tools::jsonEncode($settings);
        $rows[] = '(\''.implode('\', \'', $b).'\')';
    }
    if ($rows) {
        $module_obj->db->execute('
            REPLACE INTO '._DB_PREFIX_.'a_blog_block
            VALUES '.implode(', ', $rows).'
        ');
    }

    // update show_date and show_tags for post/category
    $multishop_general_settings = $module_obj->db->executeS('
        SELECT * FROM '._DB_PREFIX_.'a_blog_settings WHERE name = \'general\'
    ');
    $show_date_array = array();
    foreach ($multishop_general_settings as $s) {
        $value = Tools::jsonDecode($s['value'], true);
        $show_date_array[$s['id_shop']] = isset($value['show_date']) ? $value['show_date'] : 0;
    }
    $rows = array();
    $settings_rows = $module_obj->db->executeS('
        SELECT * FROM '._DB_PREFIX_.'a_blog_settings
    ');
    foreach ($settings_rows as $row) {
        if (in_array($row['name'], array('category', 'post'))) {
            $decoded_value = Tools::jsonDecode($row['value'], true);
            $decoded_value['show_date'] = !empty($show_date_array[$row['id_shop']]) ? '1' : '0';
            $decoded_value['show_tags'] = '1';
            $row['value'] = Tools::jsonEncode($decoded_value);
            $rows[] = '(\''.implode('\', \'', $row).'\')';
        }
    }
    if ($rows) {
        $module_obj->db->execute('
            REPLACE INTO '._DB_PREFIX_.'a_blog_settings
            VALUES '.implode(', ', $rows).'
        ');
    }

    // new exceptions system
    $exc_data = $module_obj->db->executeS('
        SELECT hme.*, h.name AS hook_name
        FROM '._DB_PREFIX_.'hook_module_exceptions hme
        LEFT JOIN '._DB_PREFIX_.'hook h ON h.id_hook = hme.id_hook
        WHERE id_module = '.(int)$module_obj->id.'
    ');
    $hook_exceptions = $hook_rows = array();
    foreach ($exc_data as $d) {
        $hook_exceptions[$d['id_shop']][$d['hook_name']][] = $d['file_name'];
    }
    foreach ($hook_exceptions as $id_shop => $exceptions) {
        foreach ($exceptions as $hook_name => $e) {
            $e = implode(',', array_map('pSQL', $e));
            $hook_rows[] = '(\''.pSQL($hook_name).'\', '.(int)$id_shop.', 1, \''.$e.'\')';
        }
    }
    if ($hook_rows) {
        $module_obj->db->execute('
            INSERT INTO '._DB_PREFIX_.'a_blog_hook_settings
            (hook_name, id_shop, exc_type, exc_controllers)
            VALUES '.implode(', ', $hook_rows).'
            ON DUPLICATE KEY UPDATE
            exc_type = VALUES(exc_type),
            exc_controllers = VALUES(exc_controllers)
        ');
    }
    return true;
}
