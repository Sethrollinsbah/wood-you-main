<?php
/**
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
 */

if (!defined('_PS_VERSION_')) { exit; }
/**
 * @param Ets_multilayerslider $module
 * @return bool
 */
function upgrade_module_1_0_6($module)
{
    if(!is_dir(_PS_ETS_MLS_IMG_DIR_))
    {
        @mkdir(_PS_ETS_MLS_IMG_DIR_,0755,true);
    }
    $module->copy_directory(dirname(__FILE__).'/../views/img/upload',_PS_ETS_MLS_IMG_DIR_);
    $module->rrmdir(dirname(__FILE__).'/../views/img/upload');
    Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.'ets_mls_layer_lang` CHANGE `content_layer` `content_layer` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL');
    return true;
}