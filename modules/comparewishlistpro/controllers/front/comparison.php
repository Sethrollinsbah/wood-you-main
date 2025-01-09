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

class CompareWishlistProComparisonModuleFrontController extends ModuleFrontController
{
    public $ssl = true;

    public function __construct()
    {
        parent::__construct();
        $this->context = Context::getContext();
        include_once $this->module->getLocalPath().'classes/Comparison.php';
    }

    public function initContent()
    {
        parent::initContent();
        $action = Tools::getValue('action');

        if (!Tools::isSubmit('myajax')) {
            $this->assign();
        } elseif (!empty($action) && method_exists($this, 'ajaxProcess'.Tools::toCamelCase($action))) {
            $this->{'ajaxProcess'.Tools::toCamelCase($action)}();
        } else {
            die(Tools::jsonEncode(array('error' => 'method doesn\'t exist')));
        }
    }

    public function assign()
    {
        $errors = array();
        $delete = Tools::getIsset('deleted');
        $delete = (empty($delete) === false ? 1 : 0);
        $template_flags = 0;

        if ($delete) {
            $this->context->cookie->product_comparison = array();
        }

        $products = Comparison::getProductByIdCustomer();
        $product_ids_string = implode(',', $products['product_ids']);
        $settings = $this->module->getSettings();
        $features = $this->module->getFeatures();
        $feature_rows = array();

        foreach ($features as $feature) {
            $row = array();
            $empty = true;

            foreach ($products['products_for_template'] as $product) {
                $value = null;

                if (isset($product['grouped_features'][$feature['name']])) {
                    if (trim($product['grouped_features'][$feature['name']]['value']) != '') {
                        $value = $product['grouped_features'][$feature['name']]['value'];
                        $empty = false;
                    }
                } elseif (isset($product['features']) && !empty($product['features'])) {
                    foreach ($product['features'] as $feature_array) {
                        if ($feature_array['id_feature'] == $feature['id_feature']) {
                            if (trim($feature_array['value']) != '') {
                                $value = $feature_array['value'];
                                $empty = false;
                            }

                            break;
                        }
                    }
                }

                $row[] = array(
                    'id_product' => $product['id_product'],
                    'id_feature' => $feature['id_feature'],
                    'name' => $feature['name'],
                    'value' => $value,
                );
            }

            if ($empty === false) {
                $feature_rows[] = $row;
            }
        }

        if (file_exists(_PS_THEME_DIR_.'templates/catalog/_partials/product-flags.tpl')) {
            $template_flags = 1;
        }

        $this->context->smarty->assign(array(
            'products' => $products['products_for_template'],
            'condition_row' => $products['condition'],
            'manufacturers_row' => $products['manufacturers'],
            'features' => $feature_rows,
            'categories' => $products['categories'],
            'errors' => $errors,
            'form_link' => $errors,
            'comparison_permalink' => sprintf(
                '%s?id_product=%s',
                $this->context->link->getModuleLink($this->module->name, 'comparison'),
                $product_ids_string
            ),
            'product_ids' => $product_ids_string,
            'condition' => $settings['comparison_condition'],
            'manufacturer' => $settings['comparison_manufacturer'],
            'comparison_layout' => $settings['comparison_layout'],
            'navigation' => $settings['comparison_navigation'],
            'table_items_desktop' => $settings['comparison_table_items_desktop'],
            'table_items_tablet' => $settings['comparison_table_items_tablet'],
            'hide_features' => $settings['comparison_hide_features'],
            'show_email_block' => $settings['comparison_show_email_block'],
            'icons_on_hover' => $settings['icons_on_hover'],
            'template_flags' => $template_flags,
        ));

        $this->setTemplate('module:'.$this->module->name.'/views/templates/front/comparison.tpl');
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        return $breadcrumb;
    }
}
