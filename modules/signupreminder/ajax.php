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

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');
include(dirname(__FILE__).'/signupreminder.php');

$module = new SignUpReminder();

if (!Module::isEnabled('signupreminder') || Tools::getValue('secure_key') != $module->secure_key) {
    exit;
}

if (Tools::getValue('email', false)) {
    $data = array(
        'firstname' => Tools::getValue('firstname', false),
        'lastname' => Tools::getValue('lastname', false),
        'gender' => Tools::getValue('gender', false),
        'birthdate' => Tools::getValue('birthdate', false),
        'email' => Tools::getValue('email', false),
    );

    echo Tools::jsonEncode($module->saveCustomer($data));
}
