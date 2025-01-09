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

class CompareWishlistProComparisonToolsModuleFrontController extends ModuleFrontController
{
    public function __construct()
    {
        parent::__construct();
        require_once $this->module->getLocalPath().'classes/Comparison.php';
    }

    public function initContent()
    {
        $context = Context::getContext();
        $action = Tools::getValue('action');
        $add = (!strcmp($action, 'add') ? 1 : 0);
        $delete = (!strcmp($action, 'delete') ? 1 : 0);
        $id_product = Tools::getValue('id_product');

        $result = array(
            'count' => 0,
            'permalink' => '',
        );

        if (($add || $delete) && !empty($id_product)) {
            if ($add) {
                $product_ids = array();

                if (!isset($context->cookie->product_comparison)) {
                    $context->cookie->__set('product_comparison', null);
                } else {
                    $product_ids = Tools::jsonDecode($context->cookie->product_comparison, true);
                }

                if (!isset($product_ids[$id_product])) {
                    $product_ids[$id_product] = $id_product;
                }

                $context->cookie->__set('product_comparison', Tools::jsonEncode($product_ids));
            } elseif ($delete) {
                $product_ids = array();

                if (isset($context->cookie->product_comparison)) {
                    $product_ids = Tools::jsonDecode($context->cookie->product_comparison, true);

                    if (!is_array($id_product)) {
                        $id_product = array($id_product);
                    }

                    foreach ($id_product as $id) {
                        $id = (int)$id;

                        if (isset($product_ids[$id])) {
                            unset($product_ids[$id]);
                        }
                    }

                    $context->cookie->__set('product_comparison', Tools::jsonEncode($product_ids));
                }
            }

            $result = array(
                'count' => count($product_ids),
                'permalink' => sprintf(
                    '%s?id_product=%s',
                    $context->link->getModuleLink($this->module->name, 'comparison'),
                    implode(',', $product_ids)
                ),
            );
        }

        header('Content-Type: application/json');
        exit(Tools::jsonEncode($result));
    }
}
