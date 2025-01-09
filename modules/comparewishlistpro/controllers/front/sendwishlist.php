<?php
/**
* 2007-2021 PrestaShop
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2021 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class CompareWishlistProSendWishlistModuleFrontController extends ModuleFrontController
{
    public function __construct()
    {
        parent::__construct();
        require_once $this->module->getLocalPath().'classes/WishList.php';
        require_once $this->module->getLocalPath().'classes/Comparison.php';
    }

    public function initContent()
    {
        $context = Context::getContext();
        $mode = Tools::getValue('mode');

        if (Configuration::get('PS_TOKEN_ENABLE') == 1
        && strcmp(Tools::getToken(false), Tools::getValue('token'))
        && $context->customer->isLogged() === true
        && $mode == 'wishlist') {
            exit($this->module->l('invalid token'));
        }

        if (($mode == 'wishlist' && $context->customer->isLogged()) || $mode == 'comparison') {
            $id_wishlist = (int)Tools::getValue('id_wishlist');
            $id_product = Tools::getValue('id_product');

            $toName = (string)Configuration::get('PS_SHOP_NAME');
            $customer = $context->customer;

            if (Validate::isLoadedObject($customer)) {
                $lastname = $customer->lastname;
                $firstname = $customer->firstname;
                $customer_name = sprintf('%s %s', $firstname, $lastname);
                $customer_email = $customer->email;
            } else {
                $customer_name = sprintf('%s %s', $toName, $this->module->l('customer'));
                $customer_email = null;
            }

            if ($mode == 'wishlist') {
                if (empty($id_wishlist) === true) {
                    exit($this->module->l('Invalid wishlist'));
                }

                $wishlist = WishList::exists($id_wishlist, $context->customer->id, true);

                if ($wishlist === false) {
                    exit($this->module->l('Invalid wishlist'));
                }

                $template_vars = array(
                    '{name}' => $customer_name,
                    '{wishlist_name}' => $wishlist['name'],
                    '{url}' => $context->link->getModuleLink(
                        $this->module->name,
                        'view',
                        array('token' => $wishlist['token'])
                    ),
                );
            } else {
                $product_ids = Comparison::getPermalinkIDs();

                if (empty($product_ids)) {
                    exit($this->module->l('No valid product IDs specified', $this->module->name));
                }

                $template_vars = array(
                    '{name}' => $customer_name,
                    '{url}' => sprintf(
                        '%s?id_product=%s',
                        $context->link->getModuleLink($this->module->name, 'comparison'),
                        $id_product
                    ),
                );
            }

            for ($i = 1; empty(Tools::getValue('email'.(string)$i)) === false; ++$i) {
                $to = Tools::getValue('email'.$i);

                if ($mode == 'wishlist' && WishList::addEmail($id_wishlist, $to) === false) {
                    exit($this->module->l('Wishlist send error'));
                }

                Mail::Send(
                    $context->language->id,
                    $mode,
                    sprintf(Mail::l('Message from %s', $context->language->id), $customer_name),
                    $template_vars,
                    $to,
                    $toName,
                    $customer_email,
                    $customer_name,
                    null,
                    null,
                    dirname(__FILE__).'/mails/'
                );
            }

            exit();
        }
    }
}
