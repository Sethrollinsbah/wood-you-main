<?php
/**
 * GIFT CARD
 *
 *    @author    EIRL Timactive De Véra
 *    @copyright Copyright (c) TIMACTIVE 2015 -EIRL Timactive De Véra
 *    @license   Commercial license
 *    @category pricing_promotion
 *    @version 1.1.0
 *
 *************************************
 **         GIFT CARD                *
 **          V 1.0.0                 *
 *************************************
 * +
 * + Languages: EN, FR, ES
 * + PS version: 1.5,1.6,1.7
 */

class Link extends LinkCore
{

    /**
     *
     * @author
     */
    public function getProductLink(
        $product,
        $alias = null,
        $category = null,
        $ean13 = null,
        $idLang = null,
        $idShop = null,
        $idProductAttribute = null,
        $force_routes = false,
        $relativeProtocol = false,
        $withIdInAnchor = false,
        $extraParams = [],
        $addAnchor = true
    ) {
        $giftcard = Module::getInstanceByName('giftcard');
        if ($giftcard && $giftcard->active) {
            if (! is_object($product)) {
                if (is_array($product) && isset($product['id_product'])) {
                    $id_product = $product['id_product'];
                } elseif ((int) $product) {
                    $id_product = (int) $product;
                }
            } else {
                $id_product = $product->id;
            }
            if ((int) $id_product > 0 && $giftcard->isGiftCard($id_product)) {
                $params = array();
                $params['id_product'] = $id_product;
                return ($this->getModuleLink('giftcard', 'choicegiftcard', $params));
            }
        }
        if (version_compare(_PS_VERSION_, '1.6.0.10', '<') === true) {
            return (parent::getProductLink(
                $product,
                $alias,
                $category,
                $ean13,
                $idLang,
                $idShop,
                $idProductAttribute,
                $force_routes
            ));
        }
        if (version_compare(_PS_VERSION_, '1.6.1.1', '<') === true) {
            return (parent::getProductLink(
                $product,
                $alias,
                $category,
                $ean13,
                $idLang,
                $idShop,
                $idProductAttribute,
                $force_routes,
                $relativeProtocol
            ));
        }
        if (version_compare(_PS_VERSION_, '1.7.0.0', '<') === true) {
            return (parent::getProductLink(
                $product,
                $alias,
                $category,
                $ean13,
                $idLang,
                $idShop,
                $idProductAttribute,
                $force_routes,
                $relativeProtocol,
                $withIdInAnchor
            ));
        }
        if (version_compare(_PS_VERSION_, '1.7.8.0', '<') === true) {
            return (parent::getProductLink(
                $product,
                $alias,
                $category,
                $ean13,
                $idLang,
                $idShop,
                $idProductAttribute,
                $force_routes,
                $relativeProtocol,
                $withIdInAnchor,
                $extraParams
            ));
        }
        return (parent::getProductLink(
            $product,
            $alias,
            $category,
            $ean13,
            $idLang,
            $idShop,
            $idProductAttribute,
            $force_routes,
            $relativeProtocol,
            $withIdInAnchor,
            $extraParams,
            $addAnchor
        ));
    }
}
