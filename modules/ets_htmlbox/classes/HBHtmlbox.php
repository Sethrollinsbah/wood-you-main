<?php
/**
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
 */

class HBHtmlbox extends ObjectModel
{
    protected static $instance;
    public $name;
    public $style;
    public $position;
    public $active;
    public $html;
    public static $definition = array(
        'table' => 'ets_hb_html_box',
        'primary' => 'id_ets_hb_html_box',
        'multilang' => true,
        'fields' => array(
            'name' => array('type' => self::TYPE_STRING, 'lang' => false, 'validate' => 'isCleanHtml'),
            'style' => array('type' => self::TYPE_STRING, 'lang' => false, 'validate' => 'isString'),
            'active' => array('type' => self::TYPE_INT, 'lang' => false, 'validate' => 'isInt'),
            // Lang fields
            'html' => array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isString', 'required' => true),
        )
    );

    public function __construct($id_item = null, $id_lang = null, $id_shop = null)
    {
        if ($id_item) {
            $this->position = HBHtmlboxPosition::getPosition($id_item);
        }
        parent::__construct($id_item, $id_lang, $id_shop);
    }

    public function add($auto_date = true, $null_values = false)
    {
        return parent::add($auto_date, $null_values);
    }

    public function delete()
    {
        HBHtmlboxPosition::deletePosition($this->id);
        return parent::delete(); // TODO: Change the autogenerated stub
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new HBHtmlbox();
        }
        return self::$instance;
    }

    public static function getHookPosition()
    {
        $hooks = array(
            array(
                'name' => 'On Homepage',
                'hook' => 'displayHome',
                'id' => 3,
            ),
            array(
                'name' => 'Left column: On the bottom of the left column',
                'hook' => 'displayLeftColumn',
                'id' => 7,
            ),
            array(
                'name' => 'Left column: On the top of the left column',
                'hook' => 'displayLeftColumnBefore',
                'id' => 16,
            ),
            array(
                'name' => 'Right column: On the bottom of the right column',
                'hook' => 'displayRightColumn',
                'id' => 8,
            ),
            array(
                'name' => 'Right column: On the top of the right column',
                'hook' => 'displayRightColumnBefore',
                'id' => 17,
            ),
            //Customhook
            array(
                'name' => 'Checkout page: On top of the checkout page',
                'hook' => 'displayCartGridBodyBefore2',
                'id' => 22,
            ),
            array(
                'name' => 'Checkout page: On the bottom of the checkout page',
                'hook' => 'displayCartGridBodyAfter',
                'id' => 23,
            ),
            
        );
        $version = (string)_PS_VERSION_;
        $version = (string)Tools::substr($version, 0, 7);
        $version = str_replace('.', '', $version);
        $version = (int)$version;
	    $hooks[] = array(
		    'name' => 'Category page: On top of the header of product listing page',
		    'hook' => 'displayProductListHeaderBefore',
		    'id' => 14,
	    );
	    $hooks[] = array(
		    'name' => 'Category page: Under the header of product listing page',
		    'hook' => 'displayProductListHeaderAfter',
		    'id' => 15,
	    );
	    if (version_compare(_PS_VERSION_, '1.7.7.0', '>=')) {
		    $hooks[] = array(
			    'name' => 'Category page: On the bottom of product category page',
			    'hook' => 'displayFooterCategory',
			    'id' => 6,
		    );
	    }
	    if (version_compare(_PS_VERSION_, '1.7.7.0', '>=')) {
		    $hooks[] = array(
			    'name' => 'Header: On top of the homepage banner',
			    'hook' => 'displayBanner',
			    'id' => 2,
		    );
	    }
	    if(version_compare(_PS_VERSION_, '1.7.0.0', '>=')){
		    $hooks[] = array(
			    'name' => 'Header: On the top navigation bar',
			    'hook' => 'displayNav1',
			    'id' => 1,
		    );
		    $hooks[] = array(
			    'name' => 'Footer: On top of Footer section',
			    'hook' => 'displayFooterBefore',
			    'id' => 4,
		    );
		    $hooks[] = array(
			    'name' => 'Footer: On the bottom of Footer section',
			    'hook' => 'displayFooterAfter',
			    'id' => 5,
		    );
		    $hooks[] = array(
			    'name' => 'Footer: On the Footer section',
			    'hook' => 'displayFooter',
			    'id' => 25,
		    );
		    $hooks[] = array(
			    'name' => 'Cart page: On the top of shopping cart detail on "Shopping cart" page',
			    'hook' => 'displayCartGridBodyBefore1',
			    'id' => 21,
		    );
	    }
	    $hooks[] = array(
		    'name' => 'Cart page: On the bottom of shopping cart detail',
		    'hook' => 'displayShoppingCartFooter',
		    'id' => 13,
	    );
	    $hooks[] = array(
		    'name' => 'Product page: under the product description section',
		    'hook' => 'displayFooterProduct',
		    'id' => 12,
	    );
	    $hooks[] = array(
		    'name' => 'Product page: On top of the product combination block',
		    'hook' => 'displayProductVariantsBefore',
		    'id' => 18,
	    );
	    $hooks[] = array(
		    'name' => 'Product page: On the bottom of the product combination block',
		    'hook' => 'displayProductVariantsAfter',
		    'id' => 19,
	    );
	    if(version_compare(_PS_VERSION_, '1.7.0.0', '>=')){
		    $hooks[] = array(
			    'name' => 'Product page: Under the "Customer reassurance" block',
			    'hook' => 'displayReassurance',
			    'id' => 11,
		    );
	    }
	    if (version_compare(_PS_VERSION_, '1.7.1.0', '>=')) {
		    $hooks[] = array(
			    'name' => 'Product page: Under the product thumbnail images on product detail page',
			    'hook' => 'displayAfterProductThumbs',
			    'id' => 9,
		    );
	    }
	    if (version_compare(_PS_VERSION_, '1.7.6.0', '>=')) {
		    $hooks[] = array(
			    'name' => 'Product page: On top of "Social sharing" block on product detail page',
			    'hook' => 'displayProductActions',
			    'id' => 10,
		    );
		    $hooks[] = array(
			    'name' => 'Product page: On top of "Product Comments" block on product detail page',
			    'hook' => 'displayProductCommentsListHeaderBefore',
			    'id' => 20,
		    );
	    }
        $hooks[] = array(
            'name' => 'Custom hook',
            'hook' => 'displayCustomHTMLBox',
            'id' => 24,
        );
        
        return $hooks;
    }

    public static function getHookFilter()
    {
        $arr = array();
        $hooks = HBHtmlbox::getHookPosition();
        if (sizeof($hooks) > 0) {
            foreach ($hooks as $h) {
                $arr[$h['id'] . "' OR position LIKE '" . $h['id'] . ",%' OR position LIKE '%," . $h['id'] . ",%' OR position LIKE '%," . $h['id'] . "' OR position LIKE '" . $h['id'] . "') AND '1"] = $h['name'];
            }
        }
        return $arr;
    }

    public static function getHTMLBoxByHook($hook_name = null, $id_lang = false)
    {
        $hks = HBHtmlbox::getHookPosition();
        $hook_id = null;
        if (sizeof($hks) > 0) {
            foreach ($hks as $hk) {
                if ($hk['hook'] == $hook_name) {
                    $hook_id = $hk['id'];
                    break;
                }
            }
        }
        if ($hook_id && $id_lang) {
            $sql = "
            SELECT hbl.html,hb.style,hbl.id_lang
            FROM `" . _DB_PREFIX_ . "ets_hb_html_box` hb
            LEFT JOIN `" . _DB_PREFIX_ . "ets_hb_html_box_lang` hbl 
                ON (hb.`id_ets_hb_html_box` = hbl.`id_ets_hb_html_box` AND hbl.`id_lang` = " . (int)$id_lang . ")
            JOIN `" . _DB_PREFIX_ . "ets_hb_html_box_position` hbp 
                ON (hbp.`id_ets_hb_html_box` = hb.`id_ets_hb_html_box`)
            WHERE hb.active = 1
                AND hbp.`position` = " . (int)$hook_id . "
            ";
            return Db::getInstance()->executeS($sql);
        }
        return null;
    }
    public static function getHTMLBoxById($hb_id = null, $id_lang = false)
    {
        if ($hb_id && $id_lang) {
            $sql = "
            SELECT hbl.html,hb.style,hbl.id_lang
            FROM `" . _DB_PREFIX_ . "ets_hb_html_box` hb
            LEFT JOIN `" . _DB_PREFIX_ . "ets_hb_html_box_lang` hbl 
                ON (hb.`id_ets_hb_html_box` = hbl.`id_ets_hb_html_box` AND hbl.`id_lang` = " . (int)$id_lang . ")
            JOIN `" . _DB_PREFIX_ . "ets_hb_html_box_position` hbp 
                ON (hbp.`id_ets_hb_html_box` = hb.`id_ets_hb_html_box`)
            WHERE hb.active = 1
                AND hb.`id_ets_hb_html_box` = " . (int)$hb_id . "
            ";
            $rs = Db::getInstance()->executeS($sql);
            if($rs){
                return $rs;
            }else{
                return null;
            }
        }
        return null;
    }
    public static function getHTMLBoxs($filter='',$sort='',$start=0,$limit=10,$total=false)
    {
        if($total)
            return Db::getInstance()->getValue('SELECT COUNT(DISTINCT b.id_ets_hb_html_box) 
            FROM `'._DB_PREFIX_.'ets_hb_html_box` b 
            LEFT JOIN `'._DB_PREFIX_.'ets_hb_html_box_position` c ON (c.`id_ets_hb_html_box` = b.`id_ets_hb_html_box`)
            WHERE 1 '.($filter ? :''));
        else
        {
           $boxs = Db::getInstance()->executeS('SELECT b.*,GROUP_CONCAT(c.position) as position 
           FROM `'._DB_PREFIX_.'ets_hb_html_box` b 
           LEFT JOIN `'._DB_PREFIX_.'ets_hb_html_box_position` c ON (c.`id_ets_hb_html_box` = b.`id_ets_hb_html_box`)
           WHERE 1 '.($filter ? :'').' GROUP BY b.id_ets_hb_html_box '.($sort ? ' ORDER BY '.$sort: ' ORDER BY b.id_ets_hb_html_box DESC').($limit ? ' LIMIT '.(int)$start.','.(int)$limit.'':''));
           return $boxs;
        }
    }
    public static function deleteSelected($ids)
    {
        if($ids && is_array($ids))
        {
            return Db::getInstance()->execute('DELETE FROM `'._DB_PREFIX_.'ets_hb_html_box` WHERE id_ets_hb_html_box IN ('.implode(',',array_map('intval',$ids)).')');
        }
    }
    public static function enableSelected($ids)
    {
        if($ids && is_array($ids))
        {
            return Db::getInstance()->execute('UPDATE `'._DB_PREFIX_.'ets_hb_html_box` SET active=1 WHERE id_ets_hb_html_box IN ('.implode(',',array_map('intval',$ids)).')');
        }
    }
    public static function disableSelected($ids)
    {
        if($ids && is_array($ids))
        {
            return Db::getInstance()->execute('UPDATE `'._DB_PREFIX_.'ets_hb_html_box` SET active=0 WHERE id_ets_hb_html_box IN ('.implode(',',array_map('intval',$ids)).')');
        }
    }
}
