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

function upgrade_module_2_1_0($module_obj)
{

    if (!defined('_PS_VERSION_')) {
        exit;
    }

    if (file_exists(_PS_MODULE_DIR_.$module_obj->name.'/changelog.txt')) {
        unlink(_PS_MODULE_DIR_.$module_obj->name.'/changelog.txt');
    }

    // "/css/", "/js/", "/img/" are moved to 'views'
    $current_avatars = glob(_PS_MODULE_DIR_.$module_obj->name.'/img/avatars/*.jpg');
    foreach ($current_avatars as $avatar_path) {
        Tools::copy($avatar_path, _PS_MODULE_DIR_.$module_obj->name.'/views/img/avatars/'.basename($avatar_path));
    }

    foreach (array('css', 'js', 'img') as $folder_name) {
        recursiveRemove(_PS_MODULE_DIR_.$module_obj->name.'/'.$folder_name);
    }
    return true;
}

function recursiveRemove($dir, $top_level = false)
{
    $files_to_keep = array();
    if ($top_level) {
        $files_to_keep = array('index.php');
    }
    $structure = glob(rtrim($dir, '/').'/*');
    if (is_array($structure)) {
        foreach ($structure as $file) {
            if (is_dir($file)) {
                recursiveRemove($file);
            } elseif (is_file($file) && !in_array(basename($file), $files_to_keep)) {
                unlink($file);
            }
        }
    }
    if (!$top_level && is_dir($dir)) {
        rmdir($dir);
    }
}
