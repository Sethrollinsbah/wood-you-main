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

function upgrade_module_1_0_0($module_obj)
{
    if (!defined('_PS_VERSION_')) {
        exit;
    }

    include_once(_PS_MODULE_DIR_.$module_obj->name.'/classes/BlogFields.php');
    $module_obj->fields = new BlogFields();
    $module_obj->shop_ids = Shop::getContextListShopID();

    // update settings
    $general_settings = $module_obj->getSettings('general');
    $new_settings = array(
        'cat_' => 'category',
        'post_' => 'post',
        'c_' => 'comment',
    );
    foreach ($new_settings as $prefix => $type) {
        $fields = $module_obj->getSettingsFields($type);
        $settings = array();
        foreach ($fields as $name => $field) {
            if (!empty($general_settings[$prefix.$name])) {
                $value = $general_settings[$prefix.$name];
            } elseif (!empty($general_settings[$name])) {
                $value = $general_settings[$name];
            } else {
                $value = $field['value'];
            }
            $settings[$name] = $value;
        }
        $module_obj->saveSettings($type, $settings);
    }

    // update blocks
    $blocks = $module_obj->db->executeS('
        SELECT * FROM '._DB_PREFIX_.'a_blog_block
    ');
    $block_fields = $module_obj->getSettingsFields('block');
    $block_rows = array();
    foreach ($blocks as $row) {
        $settings = Tools::jsonDecode($row['settings'], true);
        foreach ($block_fields as $name => $field) {
            if (!isset($settings[$name])) {
                $settings[$name] = $field['value'];
            }
        }
        $settings = Tools::jsonEncode($settings);
        $block_rows[] = '(\''.implode('\', \'', array_map('pSQL', $row)).'\')';
    }
    $module_obj->db->execute('
        REPLACE INTO '._DB_PREFIX_.'a_blog_block VALUES
        '.implode(', ', $block_rows).'
    ');

    return true;
}
