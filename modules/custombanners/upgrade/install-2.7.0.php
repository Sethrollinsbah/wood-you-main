<?php
/**
* 2007-2018 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2018 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

function upgrade_module_2_7_0($module_obj)
{
    if (!defined('_PS_VERSION_')) {
        exit;
    }

    $context = Context::getContext();
    $module_obj->prepareDatabase();

    // add new columns to tables
    $module_obj->db->execute('
        ALTER TABLE '._DB_PREFIX_.'cb_hook_settings
        ADD exc_type tinyint(1) NOT NULL DEFAULT 1 AFTER id_shop,
        ADD exc_controllers text NOT NULL AFTER exc_type
    ');
    $module_obj->db->execute('
        ALTER TABLE '._DB_PREFIX_.'custombanners
        ADD id_wrapper INT(10) unsigned NOT NULL AFTER hook_name
    ');

    // prepare exceptions rows
    $exc_data = $module_obj->db->executeS('
        SELECT hme.*, h.name AS hook_name
        FROM '._DB_PREFIX_.'hook_module_exceptions hme
        LEFT JOIN '._DB_PREFIX_.'hook h ON h.id_hook = hme.id_hook
        WHERE id_module = '.(int)$module_obj->id.'
    ');
    $cb_hook_exceptions = $cb_hook_rows = array();
    foreach ($exc_data as $d) {
        $id_shop = $d['id_shop'];
        $hook_name = $d['hook_name'];
        $cb_hook_exceptions[$id_shop][$hook_name][] = $d['file_name'];
    }
    foreach ($cb_hook_exceptions as $id_shop => $exceptions) {
        foreach ($exceptions as $hook_name => $e) {
            $e = implode(',', array_map('pSQL', $e));
            $cb_hook_rows[] = '(\''.pSQL($hook_name).'\', '.(int)$id_shop.', 1, \''.$e.'\')';
        }
    }
    $exc_sql = '
        INSERT INTO '._DB_PREFIX_.'cb_hook_settings
        (hook_name, id_shop, exc_type, exc_controllers)
        VALUES '.implode(', ', $cb_hook_rows).'
        ON DUPLICATE KEY UPDATE
        exc_type = VALUES(exc_type),
        exc_controllers = VALUES(exc_controllers)
    ';

    // gather and sort carousels data to avoid multiple requests
    $hook_carousel_settings = array();
    $hook_settings = $module_obj->db->executeS('SELECT * FROM '._DB_PREFIX_.'cb_hook_settings');
    foreach ($hook_settings as $s) {
        $hook_name = $s['hook_name'];
        $settings = $s['carousel'];
        if ($s['id_shop'] = $context->shop->id || empty($hook_carousel_settings[$hook_name])) {
            $hook_carousel_settings[$hook_name] =  $settings;
        }
    }

    // add wrappers, and prepare banner rows for updating
    $updated_wrappers = $cb_rows = $cb_columns = $upd_values = array();
    $banners_data = $module_obj->db->executeS('SELECT * FROM '._DB_PREFIX_.'custombanners');
    foreach ($banners_data as $data) {
        $hook_name = $data['hook_name'];
        $in_carousel = $data['in_carousel'];
        if (!isset($updated_wrappers[$hook_name][$in_carousel])) {
            $id_wrapper = $module_obj->addWrapper();
            if ($in_carousel) {
                $general_settings = Tools::jsonEncode(array('custom_class' => '', 'display_type' => 2));
                $module_obj->saveWrapperSettings($id_wrapper, $general_settings, 'general');
                // update defaut carousel settings only if there is a db record for this hook
                if (!empty($hook_carousel_settings[$hook_name])) {
                    $carousel_settings = $hook_carousel_settings[$hook_name];
                    $module_obj->saveWrapperSettings($id_wrapper, $carousel_settings, 'carousel');
                }
            }
            $updated_wrappers[$hook_name][$in_carousel] = $id_wrapper;
        } else {
            $id_wrapper = $updated_wrappers[$hook_name][$in_carousel];
        }
        $data['id_wrapper'] = $id_wrapper;
        if (!$cb_columns) {
            $cb_columns = array_keys($data);
        }
        foreach ($data as &$d) {
            $d = pSQL($d, true);
        }
        $cb_rows[] = '(\''.implode('\', \'', $data).'\')';
    }
    foreach ($cb_columns as $c) {
        $upd_values[] = pSQL($c).' = VALUES('.pSQL($c).')';
    }
    $wrp_sql = '
        INSERT INTO '._DB_PREFIX_.'custombanners
        ('.implode(', ', array_map('pSQL', $cb_columns)).')
        VALUES '.implode(', ', $cb_rows).'
        ON DUPLICATE KEY UPDATE
        '.implode(', ', $upd_values).'
    ';

    // DROP non-required columns
    $drop_sql = '
        ALTER TABLE '._DB_PREFIX_.'custombanners DROP in_carousel;
        ALTER TABLE '._DB_PREFIX_.'hook_settings DROP carousel
    ';

    $module_obj->db->execute($exc_sql);
    $module_obj->db->execute($wrp_sql);
    $module_obj->db->execute($drop_sql);

    // $context->controller->warnings[] = 'warning text here';

    return true;
}
