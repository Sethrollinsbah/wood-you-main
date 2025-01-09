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

class LggoogleanalyticsTools
{


    public static function getAffiliation()
    {
        $context = Context::getContext();

        $shop_name = $context->shop->name;
        $iso_lang = $context->language->iso_code;

        $affiliation = $shop_name.' - '.$iso_lang;

        return $affiliation;
    }

    public static function getCoupon($order)
    {
        $coupon = null;
        $coupons = array();

        if (Validate::isLoadedObject($order)) {
            // Get Discounts applied in the order
            $cart_rules = $order->getCartRules();

            // get coupon name into coupons array
            foreach ($cart_rules as $cart_rule) {
                $coupons[] = $cart_rule['name'];
            }

            // set all coupons in one string
            $coupon = implode(' / ', $coupons);
        }
        return $coupon;
    }


    ///////////////////////////////
    /// Handle Tag Order Layer

    /**
     * Prepare order model for order-confirmation page
     * @param $order
     * @return array
     */
    public static function tagOrder($order)
    {
        $affiliation = self::getAffiliation();
        $coupons = self::getCoupon($order);
        $order_tax = (float)$order->total_paid_tax_incl - (float)$order->total_paid_tax_excl;
        $currency = new Currency($order->id_currency);

        $tag_order = array(
            'transaction_id' => (int)$order->id,
            'affiliation' => isset($affiliation) ? $affiliation : '',
            'value' => round((float)$order->total_paid, 2),
            'currency' => $currency->iso_code,
            'tax' => round((float)$order_tax, 2),
            'shipping' => round((float)$order->total_shipping, 2),
            'coupon' => isset($coupons) ? $coupons : null
        );

        return $tag_order;
    }
}
