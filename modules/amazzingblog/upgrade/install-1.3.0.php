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

function upgrade_module_1_3_0($module_obj)
{
    if (!defined('_PS_VERSION_')) {
        exit;
    }

    // prepare postlist settings basing on category settings
    $category_settings = $module_obj->getSettings('category');
    $category_settings = upgradeCoverTitleIntroSettings($category_settings);
    $postlist_settings = array();
    $postlist_fields = array_keys($module_obj->getSettingsFields('postlist'));
    foreach ($postlist_fields as $name) {
        if (isset($category_settings[$name])) {
            $postlist_settings[$name] = $category_settings[$name];
            unset($category_settings[$name]);
        }
    }
    $shop_ids = Shop::getShops(false, null, true);
    $module_obj->saveSettings('postlist', $postlist_settings, $shop_ids);
    $module_obj->saveSettings('category', $category_settings, $shop_ids);

    // upgrade blocks settings
    $replacements = array(
        'latest' => 'post_latest',
        'selectedposts' => 'post_selected',
        'mostviewed' => 'post_mostviewed',
        'random' => 'post_random',
        'related' => 'post_relatedtopost',
    );
    $block_rows = $module_obj->db->executeS('SELECT * FROM '._DB_PREFIX_.'a_blog_block');
    foreach ($block_rows as &$r) {
        $settings = Tools::jsonDecode($r['settings'], true);
        if (isset($settings['type']) && isset($replacements[$settings['type']])) {
            $settings['type'] = $replacements[$settings['type']];
        }
        $settings = upgradeCoverTitleIntroSettings($settings);
        $r['settings'] = Tools::jsonEncode($settings);
        $r = '(\''.implode('\', \'', array_map('pSQL', $r)).'\')';
    }
    if ($block_rows) {
        $module_obj->db->execute('REPLACE INTO '._DB_PREFIX_.'a_blog_block VALUES '.implode(', ', $block_rows));
    }
    $module_obj->addRelatedBlocksIfRequired();
    $module_obj->prepareDatabase();
    $module_obj->prepareInitialSettings();
    $module_obj->registerHook('displayAdminProductsExtra');
    $module_obj->registerHook('actionProductSave');
    return true;
}

function upgradeCoverTitleIntroSettings($settings)
{
    $replacements = array(
        'show_cover' => 'cover_type',
        'show_title' => 'title_truncate',
        'show_intro' => 'truncate',
    );
    foreach ($replacements as $a => $b) {
        if (isset($settings[$a]) && !$settings[$a]) {
            $settings[$b] = '';
        }
        unset($settings[$a]);
    }
    return $settings;
}
