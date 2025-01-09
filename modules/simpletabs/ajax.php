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

include dirname(__FILE__).'/../../config/config.inc.php';
include dirname(__FILE__).'/../../init.php';
include dirname(__FILE__).'/simpletabs.php';

$module = new SimpleTabs();

if (!Module::isEnabled('simpletabs') || Tools::getValue('secure_key') != $module->secure_key) {
    exit;
}

$result = array();

if (Tools::getValue('mode', false)
&& Tools::getValue('id_tab', false)
&& Tools::getValue('id_product', false)) {
    $id_tab = Tools::getValue('id_tab');
    $id_product = Tools::getValue('id_product');

    if (!empty($id_tab)) {
        switch (Tools::getValue('mode')) {
            case 'edit':
                $result = $module->getTabData($id_tab);
                $result['products'] = $module->getProductData($id_product, $id_tab);
                break;

            case 'delete':
                $module->deleteTab($id_tab);
                break;

            default:
                break;
        }
    }
}

echo Tools::jsonEncode($result);
