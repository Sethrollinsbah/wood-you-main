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

class CompareWishlistProCartModuleFrontController extends ModuleFrontController
{
    public function __construct()
    {
        parent::__construct();
        require_once $this->module->getLocalPath().'classes/WishList.php';
    }

    public function initContent()
    {
        $context = Context::getContext();
        $action = Tools::getValue('action');
        $add = (!strcmp($action, 'add') ? 1 : 0);
        $delete = (!strcmp($action, 'delete') ? 1 : 0);
        $id_wishlist = (int)Tools::getValue('id_wishlist');
        $id_product = (int)Tools::getValue('id_product');
        $quantity = (int)Tools::getValue('quantity');
        $id_product_attribute = (int)Tools::getValue('id_product_attribute');
        $result = array();

        if (Configuration::get('PS_TOKEN_ENABLE') == 1
        && strcmp(Tools::getToken(false), Tools::getValue('token'))
        && $context->customer->isLogged() === true) {
            echo $this->module->l('Invalid token');
        }

        if ($context->customer->isLogged()) {
            if (($add || $delete) && empty($id_product) === false) {
                if (empty($id_wishlist) || !WishList::exists($id_wishlist, $context->customer->id)) {
                    $default_wishlist = Wishlist::getDefault($context->customer->id);

                    if (!empty($default_wishlist)) {
                        $context->cookie->__set('id_wishlist', (int)$default_wishlist['id_wishlist']);
                    } else {
                        $wishlist = new WishList();
                        $wishlist->id_shop = $context->shop->id;
                        $wishlist->id_shop_group = $context->shop->id_shop_group;
                        $wishlist->default = 1;
                        $wishlist->name = $this->module->default_wishlist_name;
                        $wishlist->id_customer = (int)$context->customer->id;
                        list($us, $s) = explode(' ', microtime());
                        srand($s * $us);
                        $wishlist->token = Tools::strtoupper(
                            Tools::substr(sha1(uniqid(rand(), true)._COOKIE_KEY_.$context->customer->id), 0, 16)
                        );
                        $wishlist->add();
                        $context->cookie->__set('id_wishlist', (int)$wishlist->id);
                    }
                } else {
                    $context->cookie->__set('id_wishlist', (int)$id_wishlist);
                }

                if ($add && $quantity) {
                    WishList::addProduct(
                        $context->cookie->id_wishlist,
                        $context->customer->id,
                        $id_product,
                        $id_product_attribute,
                        $quantity
                    );
                } elseif ($delete) {
                    WishList::removeProduct(
                        $context->cookie->id_wishlist,
                        $context->customer->id,
                        $id_product,
                        $id_product_attribute
                    );
                }

                $result = array(
                    'wishlist_product_count' => Wishlist::getProductCountByIdCustomer($context->customer->id),
                );
            }
        } else {
            $result = array(
                'error' => $this->module->l('You must be logged in to manage your wishlist.'),
            );
        }

        header('Content-Type: application/json');
        exit(Tools::jsonEncode($result));
    }
}
