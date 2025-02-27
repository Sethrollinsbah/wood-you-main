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

class CompareWishlistProBuyWishlistProductModuleFrontController extends ModuleFrontController
{
    public function __construct()
    {
        parent::__construct();
        require_once $this->module->getLocalPath().'classes/WishList.php';
    }

    public function initContent()
    {
        $cart = null;
        $error = '';
        $token = Tools::getValue('token');
        $id_product = (int)Tools::getValue('id_product');
        $id_product_attribute = (int)Tools::getValue('id_product_attribute');

        if (Configuration::get('PS_TOKEN_ENABLE') == 1
        && strcmp(Tools::getToken(false), Tools::getValue('static_token'))) {
            $error = $this->module->l('Invalid token');
        }

        if (!Tools::strlen($error)
        && empty($token) === false
        && empty($id_product) === false) {
            $wishlist = WishList::getByToken($token);

            if ($wishlist !== false) {
                WishList::addBoughtProduct($wishlist['id_wishlist'], $id_product, $id_product_attribute, $cart->id, 1);
            }
        } else {
            $error = $this->module->l('You must log in');
        }

        if (empty($error) === false) {
            echo $error;
        }
    }
}
