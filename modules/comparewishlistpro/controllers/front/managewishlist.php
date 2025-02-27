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

class CompareWishlistProManageWishlistModuleFrontController extends ModuleFrontController
{
    public function __construct()
    {
        parent::__construct();
        require_once $this->module->getLocalPath().'classes/WishList.php';
    }

    public function initContent()
    {
        $context = Context::getContext();

        if ($context->customer->isLogged()) {
            $action = Tools::getValue('action');
            $id_wishlist = (int)Tools::getValue('id_wishlist');
            $id_product = (int)Tools::getValue('id_product');
            $id_product_attribute = (int)Tools::getValue('id_product_attribute');
            $quantity = (int)Tools::getValue('quantity');
            $priority = Tools::getValue('priority');
            $wishlist = new WishList((int)($id_wishlist));
            $refresh = ((Tools::getValue('refresh') == 'true') ? 1 : 0);

            if (empty($id_wishlist) === false) {
                if (!strcmp($action, 'update')) {
                    WishList::updateProduct($id_wishlist, $id_product, $id_product_attribute, $priority, $quantity);
                    exit();
                } else {
                    if (!strcmp($action, 'delete')) {
                        WishList::removeProduct(
                            $id_wishlist,
                            (int)$context->customer->id,
                            $id_product,
                            $id_product_attribute
                        );
                    }

                    $products = WishList::getProductByIdCustomer(
                        $id_wishlist,
                        $context->customer->id,
                        $context->language->id
                    );
                    $bought = WishList::getBoughtProduct($id_wishlist);

                    for ($i = 0; $i < sizeof($products); ++$i) {
                        $obj = new Product((int)($products[$i]['id_product']), false, $context->language->id);

                        if (!Validate::isLoadedObject($obj)) {
                            continue;
                        } else {
                            if ($products[$i]['id_product_attribute'] != 0) {
                                $combination_imgs = $obj->getCombinationImages($context->language->id);

                                if (isset($combination_imgs[$products[$i]['id_product_attribute']][0])) {
                                    $products[$i]['cover'] = $obj->id.'-'.
                                        $combination_imgs[$products[$i]['id_product_attribute']][0]['id_image'];
                                } else {
                                    $cover = Product::getCover($obj->id);
                                    $products[$i]['cover'] = $obj->id.'-'.$cover['id_image'];
                                }
                            } else {
                                $images = $obj->getImages($context->language->id);

                                foreach ($images as $k => $image) {
                                    if ($image['cover']) {
                                        $products[$i]['cover'] = $obj->id.'-'.$image['id_image'];
                                        break;
                                    }
                                }
                            }

                            if (!isset($products[$i]['cover'])) {
                                $products[$i]['cover'] = $context->language->iso_code.'-default';
                            }
                        }

                        $products[$i]['bought'] = false;

                        for ($j = 0, $k = 0; $j < count($bought); ++$j) {
                            if ($bought[$j]['id_product'] == $products[$i]['id_product']
                            && $bought[$j]['id_product_attribute'] == $products[$i]['id_product_attribute']) {
                                $products[$i]['bought'][$k++] = $bought[$j];
                            }
                        }
                    }

                    $productBoughts = array();

                    foreach ($products as $product) {
                        if (!empty($product['bought'])) {
                            $productBoughts[] = $product;
                        }
                    }

                    $context->smarty->assign(array(
                        'products' => $products,
                        'productsBoughts' => $productBoughts,
                        'id_wishlist' => $id_wishlist,
                        'refresh' => $refresh,
                        'token_wish' => $wishlist->token,
                        'wishlists' => WishList::getByIdCustomer($context->cookie->id_customer),
                        'link' => $context->link,
                    ));

                    $theme_template = _PS_THEME_DIR_.'modules/'.$this->module->name.
                        '/views/templates/front/managewishlist.tpl';
                    $module_dir = _PS_MODULE_DIR_.$this->module->name;

                    if (Tools::file_exists_cache($theme_template)) {
                        echo $this->module->fetch($theme_template);
                    } elseif (Tools::file_exists_cache(
                        $module_dir.'/views/templates/front/managewishlist.tpl'
                    )) {
                        echo $this->module->fetch($module_dir.'/views/templates/front/managewishlist.tpl');
                    } elseif (Tools::file_exists_cache($module_dir.'/managewishlist.tpl')) {
                        echo $this->module->fetch($module_dir.'/managewishlist.tpl');
                    } else {
                        echo $this->module->l('No template found');
                    }

                    exit();
                }
            }
        }
    }
}
