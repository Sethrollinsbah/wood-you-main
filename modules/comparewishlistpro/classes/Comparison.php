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

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;

class Comparison extends ObjectModel
{
    /** @var integer Comparison ID */
    public $id;

    /** @var integer Customer ID */
    public $id_customer;

    /** @var integer Token */
    public $token;

    /** @var integer Name */
    public $name;

    /** @var string Object creation date */
    public $date_add;

    /** @var string Object last modification date */
    public $date_upd;

    /** @var string Object last modification date */
    public $id_shop;

    /** @var string Object last modification date */
    public $id_shop_group;

    /** @var integer default */
    public $default;

    public static $definition = array(
        'table' => 'comparison',
        'primary' => 'id_comparison',
        'fields' => array(
            'id_customer' =>    array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
            'token' =>          array('type' => self::TYPE_STRING, 'validate' => 'isMessage', 'required' => true),
            'name' =>           array('type' => self::TYPE_STRING, 'validate' => 'isMessage'),
            'date_add' =>       array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'date_upd' =>       array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'id_shop' =>        array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'id_shop_group' =>  array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
        ),
    );

    public function delete()
    {
        Db::getInstance()->execute(
            'DELETE FROM `'._DB_PREFIX_.'comparison_product` WHERE `id_comparison` = '.(int)($this->id)
        );

        if (isset($this->context->cookie->id_comparison)) {
            unset($this->context->cookie->id_comparison);
        }

        return (parent::delete());
    }

    public static function incCounter($id_wishlist)
    {
        if (!Validate::isUnsignedId($id_wishlist)) {
            die(Tools::displayError());
        }

        $result = Db::getInstance()->getRow(
            'SELECT `counter`
            FROM `'._DB_PREFIX_.'wishlist`
            WHERE `id_wishlist` = '.(int)$id_wishlist
        );

        if ($result == false || !count($result) || empty($result) === true) {
            return (false);
        }

        return Db::getInstance()->execute(
            'UPDATE `'._DB_PREFIX_.'wishlist` SET
            `counter` = '.(int)($result['counter'] + 1).'
            WHERE `id_wishlist` = '.(int)$id_wishlist
        );
    }

    public static function isExistsByNameForUser($name)
    {
        if (Shop::getContextShopID()) {
            $shop_restriction = 'AND id_shop = '.(int)Shop::getContextShopID();
        } elseif (Shop::getContextShopGroupID()) {
            $shop_restriction = 'AND id_shop_group = '.(int)Shop::getContextShopGroupID();
        } else {
            $shop_restriction = '';
        }

        $context = Context::getContext();

        return Db::getInstance()->getValue(
            'SELECT COUNT(*) AS total
            FROM `'._DB_PREFIX_.'wishlist`
            WHERE `name` = \''.pSQL($name).'\'
                AND `id_customer` = '.(int)$context->customer->id.'
                '.$shop_restriction
        );
    }

    public static function exists($id_customer, $return = false)
    {
        if (!Validate::isUnsignedId($id_customer)) {
            die(Tools::displayError());
        }

        $result = Db::getInstance()->getRow(
            'SELECT `id_comparison`, `token`
            FROM `'._DB_PREFIX_.'comparison`
            WHERE `id_customer` = '.(int)$id_customer.'
              AND `id_shop` = '.(int)Context::getContext()->shop->id
        );

        if (empty($result) === false && $result != false && count($result) > 0) {
            if ($return === false) {
                return true;
            } else {
                return $result;
            }
        }

        return false;
    }

    public static function getCustomers()
    {
        $cache_id = 'WhishList::getCustomers';

        if (!Cache::isStored($cache_id)) {
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
                'SELECT c.`id_customer`, c.`firstname`, c.`lastname`
                  FROM `'._DB_PREFIX_.'wishlist` w
                INNER JOIN `'._DB_PREFIX_.'customer` c ON c.`id_customer` = w.`id_customer`
                ORDER BY c.`firstname` ASC'
            );
            Cache::store($cache_id, $result);
        }

        return Cache::retrieve($cache_id);
    }

    public static function getByToken($token)
    {
        if (!Validate::isMessage($token)) {
            die(Tools::displayError());
        }

        return (Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
        SELECT w.`id_wishlist`, w.`name`, w.`id_customer`, c.`firstname`, c.`lastname`
          FROM `'._DB_PREFIX_.'wishlist` w
        INNER JOIN `'._DB_PREFIX_.'customer` c ON c.`id_customer` = w.`id_customer`
        WHERE `token` = \''.pSQL($token).'\''));
    }

    public static function getByIdCustomer($id_customer)
    {
        if (!Validate::isUnsignedId($id_customer)) {
            die(Tools::displayError());
        }

        if (Shop::getContextShopID()) {
            $shop_restriction = 'AND id_shop = '.(int)Shop::getContextShopID();
        } elseif (Shop::getContextShopGroupID()) {
            $shop_restriction = 'AND id_shop_group = '.(int)Shop::getContextShopGroupID();
        } else {
            $shop_restriction = '';
        }

        $cache_id = 'WhishList::getByIdCustomer_'.(int)$id_customer.'-'.(int)Shop::getContextShopID().'-'.
            (int)Shop::getContextShopGroupID();

        if (!Cache::isStored($cache_id)) {
            $result = Db::getInstance()->executeS('
            SELECT w.`id_wishlist`, w.`name`, w.`token`, w.`date_add`, w.`date_upd`, w.`counter`, w.`default`
            FROM `'._DB_PREFIX_.'wishlist` w
            WHERE `id_customer` = '.(int)($id_customer).'
            '.$shop_restriction.'
            ORDER BY w.`name` ASC');
            Cache::store($cache_id, $result);
        }

        return Cache::retrieve($cache_id);
    }

    public static function refreshWishList($id_wishlist)
    {
        $old_carts = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            'SELECT wp.id_product,
                    wp.id_product_attribute,
                    wpc.id_cart,
                    UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(wpc.date_add) AS timecart
            FROM `'._DB_PREFIX_.'wishlist_product_cart` wpc
            JOIN `'._DB_PREFIX_.'wishlist_product` wp ON (wp.id_wishlist_product = wpc.id_wishlist_product)
            JOIN `'._DB_PREFIX_.'cart` c ON  (c.id_cart = wpc.id_cart)
            JOIN `'._DB_PREFIX_.'cart_product` cp ON (wpc.id_cart = cp.id_cart)
            LEFT JOIN `'._DB_PREFIX_.'orders` o ON (o.id_cart = c.id_cart)
            WHERE (wp.id_wishlist='.(int)($id_wishlist).' AND o.id_cart IS NULL)
            HAVING timecart  >= 3600*6'
        );

        if (isset($old_carts) && $old_carts != false) {
            foreach ($old_carts as $old_cart) {
                Db::getInstance()->execute(
                    'DELETE FROM `'._DB_PREFIX_.'cart_product`
                    WHERE id_cart='.(int)($old_cart['id_cart']).'
                      AND id_product='.(int)($old_cart['id_product']).'
                      AND id_product_attribute='.(int)($old_cart['id_product_attribute'])
                );
            }
        }

        $freshwish = Db::getInstance()->executeS(
            'SELECT  wpc.id_cart, wpc.id_wishlist_product
            FROM `'._DB_PREFIX_.'wishlist_product_cart` wpc
            JOIN `'._DB_PREFIX_.'wishlist_product` wp ON (wpc.id_wishlist_product = wp.id_wishlist_product)
            JOIN `'._DB_PREFIX_.'cart` c ON (c.id_cart = wpc.id_cart)
            LEFT JOIN `'._DB_PREFIX_.'cart_product` cp ON (cp.id_cart = wpc.id_cart AND cp.id_product = wp.id_product
                AND cp.id_product_attribute = wp.id_product_attribute)
            WHERE (wp.id_wishlist = '.(int)($id_wishlist).'
                AND ((cp.id_product IS NULL AND cp.id_product_attribute IS NULL)))
            '
        );

        $res = Db::getInstance()->executeS(
            'SELECT wp.id_wishlist_product, cp.quantity AS cart_quantity, wpc.quantity AS wish_quantity, wpc.id_cart
            FROM `'._DB_PREFIX_.'wishlist_product_cart` wpc
            JOIN `'._DB_PREFIX_.'wishlist_product` wp ON (wp.id_wishlist_product = wpc.id_wishlist_product)
            JOIN `'._DB_PREFIX_.'cart` c ON (c.id_cart = wpc.id_cart)
            JOIN `'._DB_PREFIX_.'cart_product` cp
                ON (cp.id_cart = wpc.id_cart
                    AND cp.id_product = wp.id_product
                    AND cp.id_product_attribute = wp.id_product_attribute)
            WHERE wp.id_wishlist='.(int)($id_wishlist)
        );

        if (isset($res) && $res != false) {
            foreach ($res as $refresh) {
                if ($refresh['wish_quantity'] > $refresh['cart_quantity']) {
                    Db::getInstance()->execute(
                        'UPDATE `'._DB_PREFIX_.'wishlist_product`
                        SET `quantity`= `quantity` + '.
                            ((int)($refresh['wish_quantity']) - (int)($refresh['cart_quantity'])).'
                        WHERE id_wishlist_product='.(int)($refresh['id_wishlist_product'])
                    );
                    Db::getInstance()->execute(
                        'UPDATE `'._DB_PREFIX_.'wishlist_product_cart`
                        SET `quantity`='.(int)($refresh['cart_quantity']).'
                        WHERE id_wishlist_product='.(int)($refresh['id_wishlist_product']).
                            ' AND id_cart='.(int)($refresh['id_cart'])
                    );
                }
            }
        }

        if (isset($freshwish) && $freshwish != false) {
            foreach ($freshwish as $prodcustomer) {
                Db::getInstance()->execute(
                    'UPDATE `'._DB_PREFIX_.'wishlist_product` SET `quantity`=`quantity` + (
                        SELECT `quantity` FROM `'._DB_PREFIX_.'wishlist_product_cart`
                        WHERE `id_wishlist_product`='.(int)($prodcustomer['id_wishlist_product']).
                            ' AND `id_cart`='.(int)($prodcustomer['id_cart']).'
                    ) WHERE `id_wishlist_product`='.(int)($prodcustomer['id_wishlist_product']).
                        ' AND `id_wishlist`='.(int)($id_wishlist)
                );
                Db::getInstance()->execute(
                    'DELETE FROM `'._DB_PREFIX_.'wishlist_product_cart`
                    WHERE `id_wishlist_product`='.(int)($prodcustomer['id_wishlist_product']).
                        ' AND `id_cart`='.(int)($prodcustomer['id_cart'])
                );
            }
        }
    }

    public static function getPermalinkIDs()
    {
        return array_filter(explode(',', Tools::getValue('id_product')), function ($value) {
            return Validate::isUnsignedInt($value) && $value > 0;
        });
    }

    public static function getProductByIdCustomer($id_product = null)
    {
        $context = Context::getContext();
        $product_ids = $condition = $manufacturers = array();
        $condition_empty = $manufacturers_empty = true;
        $id_lang = $context->language->id;

        $result = array(
            'products_for_template' => array(),
            'product_ids' => array(),
            'categories' => array(),
            'condition' => array(),
            'manufacturers' => array(),
        );

        $permalink_ids = self::getPermalinkIDs();

        if (!empty($permalink_ids)) {
            $product_ids = array_combine($permalink_ids, $permalink_ids);
            $context->cookie->__set('product_comparison', Tools::jsonEncode($product_ids));
        } elseif (Validate::isUnsignedInt($id_product) && $id_product > 0) {
            $product_ids[] = $id_product;
        } elseif (isset($context->cookie->product_comparison)) {
            $product_ids = Tools::jsonDecode($context->cookie->product_comparison, true);
        }

        if (empty($product_ids)) {
            return $result;
        }

        $product_ids = array_slice($product_ids, 0, 20);

        $products = Db::getInstance()->executeS(
            'SELECT p.*,
                    product_shop.*,
                    stock.out_of_stock,
                    IFNULL(stock.quantity, 0) AS quantity,
                    pl.`description_short`,
                    pl.`available_now`,
                    pl.`available_later`,
                    pl.`link_rewrite`,
                    pl.`name`,
                    image_shop.`id_image` id_image,
                    il.`legend`,
                    m.`name` manufacturer_name,
                    DATEDIFF(
                        p.`date_add`,
                        DATE_SUB(
                            "'.date('Y-m-d').' 00:00:00",
                            INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT'))
                                ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY
                        )
                    ) > 0 new
                    '.(Combination::isFeatureActive() ?
                        ', product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity,
                    IFNULL(product_attribute_shop.`id_product_attribute`, 0) id_product_attribute' : '').'
            FROM `'._DB_PREFIX_.'product` p
            '.Shop::addSqlAssociation('product', 'p').'
            INNER JOIN `'._DB_PREFIX_.'product_lang` pl ON (
                p.`id_product` = pl.`id_product`
                AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').'
            )
            '.(Combination::isFeatureActive() ?
            'LEFT JOIN `'._DB_PREFIX_.'product_attribute_shop` product_attribute_shop
                ON (p.`id_product` = product_attribute_shop.`id_product`
                    AND product_attribute_shop.`default_on` = 1
                    AND product_attribute_shop.id_shop='.(int)$context->shop->id.')':'').'
            '.Product::sqlStock('p', 0).'
            LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON m.`id_manufacturer` = p.`id_manufacturer`
            LEFT JOIN `'._DB_PREFIX_.'image_shop` image_shop
                ON (image_shop.`id_product` = p.`id_product`
                AND image_shop.cover=1
                AND image_shop.id_shop='.(int)$context->shop->id.')
            LEFT JOIN `'._DB_PREFIX_.'image_lang` il
                ON (image_shop.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$id_lang.')
            WHERE p.id_product IN ('.implode(',', array_map('intval', $product_ids)).')
              AND pl.`id_lang` = '.(int)$id_lang.'
            GROUP BY p.id_product'
        );

        if (empty($products) || count($products) <= 0) {
            return $result;
        }

        if (!empty($products)) {
            $products_for_template = array();
            $categories = array();
            $image_retriever = new ImageRetriever($context->link);

            if (method_exists($image_retriever, 'getNoPictureImage')) {
                $no_picture_image = $image_retriever->getNoPictureImage($context->language);
                $image_placeholder = $no_picture_image['small']['url'];
                $image_placeholder_medium = $no_picture_image['medium']['url'];
            } else {
                $image_placeholder = $image_placeholder_medium = sprintf(
                    '%sp/%s.jpg',
                    _PS_IMG_,
                    $context->language->iso_code
                );
            }

            $assembler = new ProductAssembler($context);
            $presenter_factory = new ProductPresenterFactory($context);
            $presentation_settings = $presenter_factory->getPresentationSettings();
            $presenter = new ProductListingPresenter(
                $image_retriever,
                $context->link,
                new PriceFormatter(),
                new ProductColorsRetriever(),
                $context->getTranslator()
            );

            foreach ($products as $raw_product) {
                $products_for_template[] = $presenter->present(
                    $presentation_settings,
                    $assembler->assembleProduct($raw_product),
                    $context->language
                );

                $result['product_ids'][] = $raw_product['id_product'];
            }

            foreach ($products_for_template as $key => $product) {
                $condition_label = $manufacturer_name = null;

                $image_link = $context->link->getImageLink(
                    $product['link_rewrite'],
                    $product['id_image'],
                    ImageType::getFormattedName('home')
                );

                $split_ids = explode('-', $product['id_image']);
                $id_image = (isset($split_ids[1]) ? $split_ids[1] : $split_ids[0]);

                if (Validate::isUnsignedInt($id_image)) {
                    $image_path = _PS_PROD_IMG_DIR_.Image::getImgFolderStatic($id_image).$id_image;

                    if (!file_exists($image_path.'-'.ImageType::getFormattedName('home').'.jpg')) {
                        $image_link = $image_placeholder;
                    }

                    if (!file_exists($image_path.'-'.ImageType::getFormattedName('home').'.jpg')
                    && isset($products_for_template[$key]['cover']['bySize'])) {
                        $products_for_template[$key]['cover']['bySize'][ImageType::getFormattedName('home')]['url'] =
                            $image_placeholder_medium;
                    }
                } else {
                    $image_link = $image_placeholder;
                }

                $products_for_template[$key]['image_link'] = $image_link;

                if (!isset($categories[$product['id_category_default']])) {
                    $categories[$product['id_category_default']] = array(
                        'id' => $product['id_category_default'],
                        'name' => $product['category_name'],
                        'count' => 1,
                    );
                } else {
                    $categories[$product['id_category_default']]['count']++;
                }

                if ($product['show_condition'] == 1 && trim($product['condition']['label']) != '') {
                    $condition_label = $product['condition']['label'];
                    $condition_empty = false;
                }

                $condition[] = array(
                    'id_product' => $product['id_product'],
                    'label' => $condition_label,
                );

                if (trim($product['manufacturer_name']) != '') {
                    $manufacturer_name = $product['manufacturer_name'];
                    $manufacturers_empty = false;
                }

                $manufacturers[] = array(
                    'id_product' => $product['id_product'],
                    'name' => $manufacturer_name,
                );
            }

            $result['products_for_template'] = $products_for_template;
            $result['categories'] = $categories;

            if (!$condition_empty) {
                $result['condition'] = $condition;
            }

            if (!$manufacturers_empty) {
                $result['manufacturers'] = $manufacturers;
            }
        }

        return $result;
    }

    public static function getInfosByIdCustomer($id_customer)
    {
        if (Shop::getContextShopID()) {
            $shop_restriction = 'AND id_shop = '.(int)Shop::getContextShopID();
        } elseif (Shop::getContextShopGroupID()) {
            $shop_restriction = 'AND id_shop_group = '.(int)Shop::getContextShopGroupID();
        } else {
            $shop_restriction = '';
        }

        if (!Validate::isUnsignedId($id_customer)) {
            die(Tools::displayError());
        }

        return (Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            'SELECT SUM(wp.`quantity`) AS nbProducts, wp.`id_wishlist`
              FROM `'._DB_PREFIX_.'wishlist_product` wp
            INNER JOIN `'._DB_PREFIX_.'wishlist` w ON (w.`id_wishlist` = wp.`id_wishlist`)
            WHERE w.`id_customer` = '.(int)($id_customer).'
            '.$shop_restriction.'
            GROUP BY w.`id_wishlist`
            ORDER BY w.`name` ASC'
        ));
    }

    public static function addProduct($id_comparison, $id_product, $id_product_attribute = 0)
    {
        if (!Validate::isUnsignedId($id_comparison)
        || !Validate::isUnsignedId($id_product)) {
            die(Tools::displayError());
        }

        $result = Db::getInstance()->getRow(
            'SELECT cp.`id_comparison_product`
            FROM `'._DB_PREFIX_.'comparison_product` cp
            WHERE cp.`id_comparison` = '.(int)($id_comparison).'
              AND cp.`id_product` = '.(int)($id_product).'
              AND cp.`id_product_attribute` = '.(int)($id_product_attribute)
        );

        if (empty($result)) {
            return (Db::getInstance()->execute(
                'INSERT INTO `'._DB_PREFIX_.'comparison_product` (
                    `id_comparison`,
                    `id_product`,
                    `id_product_attribute`
                ) VALUES(
                    '.(int)($id_comparison).',
                    '.(int)($id_product).',
                    '.(int)($id_product_attribute).'
                )'
            ));
        }
    }

    public static function removeProduct($id_comparison, $id_product, $id_product_attribute = 0)
    {
        if (!Validate::isUnsignedId($id_comparison)
        || !Validate::isUnsignedId($id_product)) {
            die(Tools::displayError());
        }

        Db::getInstance()->execute(
            'DELETE FROM `'._DB_PREFIX_.'comparison_product`
            WHERE `id_comparison` = '.(int)($id_comparison).'
            AND `id_product` = '.(int)($id_product).'
            AND `id_product_attribute` = '.(int)($id_product_attribute)
        );

        $result = Db::getInstance()->getRow(
            'SELECT cp.`id_comparison_product`
            FROM `'._DB_PREFIX_.'comparison_product` cp
            WHERE cp.`id_comparison` = '.(int)$id_comparison
        );

        if (empty($result) || $result === false || count($result) <= 0) {
            Db::getInstance()->execute(
                'DELETE FROM `'._DB_PREFIX_.'comparison`
                WHERE `id_comparison` = '.(int)$id_comparison
            );
        }

        return true;
    }

    public static function getBoughtProduct($id_wishlist)
    {
        if (!Validate::isUnsignedId($id_wishlist)) {
            die(Tools::displayError());
        }

        return (Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            'SELECT wp.`id_product`,
                    wp.`id_product_attribute`,
                    wpc.`quantity`,
                    wpc.`date_add`,
                    cu.`lastname`,
                    cu.`firstname`
            FROM `'._DB_PREFIX_.'wishlist_product_cart` wpc
            JOIN `'._DB_PREFIX_.'wishlist_product` wp ON (wp.id_wishlist_product = wpc.id_wishlist_product)
            JOIN `'._DB_PREFIX_.'cart` ca ON (ca.id_cart = wpc.id_cart)
            JOIN `'._DB_PREFIX_.'customer` cu ON (cu.`id_customer` = ca.`id_customer`)
            WHERE wp.`id_wishlist` = '.(int)($id_wishlist)
        ));
    }

    public static function addBoughtProduct($id_wishlist, $id_product, $id_product_attribute, $id_cart, $quantity)
    {
        if (!Validate::isUnsignedId($id_wishlist)
        || !Validate::isUnsignedId($id_product)
        || !Validate::isUnsignedId($quantity)) {
            die(Tools::displayError());
        }

        $result = Db::getInstance()->getRow(
            'SELECT `quantity`, `id_wishlist_product`
            FROM `'._DB_PREFIX_.'wishlist_product` wp
            WHERE `id_wishlist` = '.(int)($id_wishlist).'
            AND `id_product` = '.(int)($id_product).'
            AND `id_product_attribute` = '.(int)($id_product_attribute)
        );

        if (!sizeof($result)
        || ($result['quantity'] - $quantity) < 0
        || $quantity > $result['quantity']) {
            return (false);
        }

        Db::getInstance()->executeS(
            'SELECT * FROM `'._DB_PREFIX_.'wishlist_product_cart`
            WHERE `id_wishlist_product`='.(int)($result['id_wishlist_product']).' AND `id_cart`='.(int)($id_cart)
        );

        if (Db::getInstance()->NumRows() > 0) {
            $result2 = Db::getInstance()->execute(
                'UPDATE `'._DB_PREFIX_.'wishlist_product_cart`
                SET `quantity`=`quantity` + '.(int)($quantity).'
                WHERE `id_wishlist_product`='.(int)($result['id_wishlist_product']).' AND `id_cart`='.(int)($id_cart)
            );
        } else {
            $result2 = Db::getInstance()->execute(
                'INSERT INTO `'._DB_PREFIX_.'wishlist_product_cart`
                (`id_wishlist_product`, `id_cart`, `quantity`, `date_add`) VALUES(
                '.(int)($result['id_wishlist_product']).',
                '.(int)($id_cart).',
                '.(int)($quantity).',
                \''.pSQL(date('Y-m-d H:i:s')).'\')'
            );
        }

        if ($result2 === false) {
            return (false);
        }

        return (Db::getInstance()->execute(
            'UPDATE `'._DB_PREFIX_.'wishlist_product` SET
            `quantity` = '.(int)($result['quantity'] - $quantity).'
            WHERE `id_wishlist` = '.(int)($id_wishlist).'
            AND `id_product` = '.(int)($id_product).'
            AND `id_product_attribute` = '.(int)($id_product_attribute)
        ));
    }

    public static function addEmail($id_wishlist, $email)
    {
        if (!Validate::isUnsignedId($id_wishlist) || empty($email) || !Validate::isEmail($email)) {
            return false;
        }

        return (Db::getInstance()->execute(
            'INSERT INTO `'._DB_PREFIX_.'wishlist_email` (`id_wishlist`, `email`, `date_add`) VALUES(
            '.(int)($id_wishlist).',
            \''.pSQL($email).'\',
            \''.pSQL(date('Y-m-d H:i:s')).'\')'
        ));
    }

    public static function getEmail($id_wishlist, $id_customer)
    {
        if (!Validate::isUnsignedId($id_wishlist)
        || !Validate::isUnsignedId($id_customer)) {
            die(Tools::displayError());
        }

        return (Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            'SELECT we.`email`, we.`date_add`
            FROM `'._DB_PREFIX_.'wishlist_email` we
            INNER JOIN `'._DB_PREFIX_.'wishlist` w ON w.`id_wishlist` = we.`id_wishlist`
            WHERE we.`id_wishlist` = '.(int)($id_wishlist).'
            AND w.`id_customer` = '.(int)($id_customer)
        ));
    }

    public static function isDefault($id_customer)
    {
        return (bool)Db::getInstance()->getValue(
            'SELECT * FROM `'._DB_PREFIX_.'wishlist` WHERE `id_customer` = '.$id_customer.' AND `default` = 1'
        );
    }

    public static function getDefault($id_customer)
    {
        return Db::getInstance()->executeS(
            'SELECT * FROM `'._DB_PREFIX_.'wishlist` WHERE `id_customer` = '.$id_customer.' AND `default` = 1'
        );
    }

    public function setDefault()
    {
        if ($default = $this->getDefault($this->id_customer)) {
            Db::getInstance()->update('wishlist', array('default' => '0'), 'id_wishlist = '.$default[0]['id_wishlist']);
        }

        return Db::getInstance()->update('wishlist', array('default' => '1'), 'id_wishlist = '.$this->id);
    }
};
