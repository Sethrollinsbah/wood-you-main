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

function upgrade_module_2_5_0($module_obj)
{
    if (!defined('_PS_VERSION_')) {
        exit();
    }
    $module_obj->unregisterHook('moduleRoutes');
    $all_shop_ids = Shop::getShops(false, null, true);
    $id_shop_default = Configuration::get('PS_SHOP_DEFAULT');
    foreach ($all_shop_ids as $id_shop) {
        if ($id_shop == $id_shop_default) {
            $id_shop = null;
        }
        if ($general_settings = Configuration::get('TWA_GENERAL_SETTINGS', null, null, $id_shop)) {
            $general_settings = Tools::jsonDecode($general_settings, true);
            // save meta_url_rewrite basing on slug from previous version
            if (!empty($general_settings['slug']) && !$module_obj->getSavedMetaValues($id_shop)) {
                $meta_values = array('meta_url_rewrite' => array());
                foreach ($module_obj->getAvailableLanguages(true) as $id_lang) {
                    $meta_values['meta_url_rewrite'][$id_lang] = Tools::str2url($general_settings['slug']);
                }
                $module_obj->saveMetaValues($meta_values, $id_shop);
            }
            unset($general_settings['slug']);
            // update rating_class
            if (!empty($general_settings['rating_class'])) {
                $general_settings['rating_class'] = 'icon-'.$general_settings['rating_class'];
            }
            // save general settings under new key TWA_SETTINGS_GENERAL
            $module_obj->saveSettings('general', '', $general_settings, $id_shop);
        }
    }
    Configuration::deleteByName('TWA_GENERAL_SETTINGS');
    $module_obj->saveAllSettings();
    return true;
}
