<?php
/**
 * Copyright 2022 LÍNEA GRÁFICA E.C.E S.L.
 *
 * @author    Línea Gráfica E.C.E. S.L.
 * @copyright Lineagrafica.es - Línea Gráfica E.C.E. S.L. all rights reserved.
 * @license   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class LggoogleanalyticsGtagModuleFrontController extends ModuleFrontController
{
    public $auth = false;
    public $ajax;
    protected $name = 'lggoogleanalytics';

    public function __construct()
    {
        parent::__construct();

        $this->content_only = true;
        $this->ajax = 1;

        $token = Tools::getAdminToken($this->name);
        if ($token != Tools::getValue('token')) {
            $this->ajaxDie("Forbidden\n");
        }
    }

    public function displayAjaxGetProduct()
    {
        $id_product = (int) Tools::getValue('id_product');
        if (!empty($id_product) && isset($this->context->cart)) {
            $products = $this->context->cart->getProducts(null, $id_product);
            $product = current($products);
            if (!empty($product)) {
                $id_lang = Configuration::get('PS_LANG_DEFAULT');
                $affiliation = htmlentities(Configuration::get('PS_SHOP_NAME'));
                $category = new Category((int) $product['id_category_default']);
                $item_category = $category->getName($id_lang);
                $currency = new Currency((int) $this->context->cart->id_currency);
                $currency = $currency->iso_code;
                $item_brand = isset($product['manufacturer_name'])
                ? $product['manufacturer_name']
                : Manufacturer::getNameById($product['id_manufacturer']);
                if (isset($product['price_without_reduction'])) {
                    if ($product['price_without_reduction'] > $product['price_with_reduction']) {
                        $discount = $product['price_without_reduction'] - $product['price_with_reduction'];
                    } else {
                        $discount = 0;
                    }
                } else {
                    $discount = $product['reduction'];
                }

                $event = array(
                    'currency' => $currency,
                    'items' => [array(
                        'item_id' => (int) $product['id_product'],
                        'item_name' => $product['name'],
                        'discount' => Tools::ps_round((float) $discount, 2),
                        'affiliation' => $affiliation,
                        'item_brand' => $item_brand,
                        'item_category' => $item_category,
                        'item_variant' => $product['attributes'],
                        'price' => Tools::ps_round((float) $product['price_wt'], 2),
                        'currency' => $currency,
                        'quantity' => $product['quantity'],
                    )],
                    'value' => Tools::ps_round((float) $product['total_wt'], 2),
                );

                $json = Lggoogleanalytics::jsonEncode($event);

                $this->ajaxDie($json);
            }
        }

        return Lggoogleanalytics::jsonEncode([]);
    }
}
