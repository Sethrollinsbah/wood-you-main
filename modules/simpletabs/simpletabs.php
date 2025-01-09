<?php
/**
* 2007-2018 PrestaShop
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2018 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class SimpleTabs extends Module
{
    public function __construct()
    {
        if (!defined('_PS_VERSION_')) {
            exit;
        }

        $this->name = 'simpletabs';
        $this->tab = 'front_office_features';
        $this->version = '2.1.0';
        $this->author = 'Prestapro';
        $this->need_instance = 0;
        $this->module_key = '20335b7bde634df9710b3d98dd09fa85';
        $this->secure_key = Tools::encrypt($this->name);
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        $this->bootstrap = true;
        $this->db = Db::getInstance();

        parent::__construct();

        $this->displayName = $this->l('Simple Tabs');
        $this->description = $this->l('Adds a tabbed description section to product pages in the front office.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    private function prepareTable($action)
    {
        switch ($action) {
            case 'add':
                $product_tab =
                    'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'product_tab` (
                        `id_tab` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                        `id_product` INT(10) UNSIGNED NOT NULL,
                        PRIMARY KEY (`id_tab`, `id_product`),
                        INDEX (`id_product`)
                    ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8';
                $product_tab_lang =
                    'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'product_tab_lang` (
                        `id_tab` INT(10) UNSIGNED NOT NULL,
                        `id_shop` INT(10) UNSIGNED NOT NULL,
                        `id_lang` INT(10) UNSIGNED NOT NULL,
                        `title` VARCHAR(128) NOT NULL,
                        `content` TEXT NOT NULL,
                        `status` TINYINT UNSIGNED NOT NULL,
                        PRIMARY KEY (`id_tab`, `id_shop`, `id_lang`)
                    ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8';
                break;

            case 'remove':
                $product_tab = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'product_tab`';
                $product_tab_lang = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'product_tab_lang`';
                break;
        }


        return $this->db->execute($product_tab) && $this->db->execute($product_tab_lang);
    }

    public function install()
    {
        if (!parent::install()
        || !$this->prepareTable('add')
        || !$this->registerHook('displayProductTab')
        || !$this->registerHook('displayProductTabContent')
        || !$this->registerHook('displayBackOfficeHeader')
        || !$this->registerHook('actionProductSave')
        || !$this->registerHook('actionProductDelete')
        || !$this->registerHook('displayAdminProductsExtra')) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall()
        || !$this->prepareTable('remove')) {
            return false;
        }

        return true;
    }

    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('controller') != 'AdminProducts') {
            return;
        }

        $this->context->controller->addCSS($this->_path.'views/css/back.css');
        $this->context->controller->addJquery();
    }

    public function getProductData($id_product, $id_tab = null)
    {
        $result = $this->db->executeS(
            'SELECT pl.`id_product`,
                    pl.`name`,
                    pt.`id_product` AS status
            FROM '._DB_PREFIX_.'product_lang pl
            LEFT JOIN '._DB_PREFIX_.'product_tab pt
            ON (pt.`id_product` = pl.`id_product` AND pt.`id_tab` = '.(int)$id_tab.')
            WHERE pl.`id_product` != '.(int)$id_product.'
              AND pl.`id_shop` = '.(int)$this->context->shop->id.'
              AND pl.`id_lang` = '.(int)$this->context->language->id.'
            ORDER BY pl.`id_product` ASC'
        );

        return $result;
    }

    private function displayProductList($id_product, $id_tab = null)
    {
        $this->context->smarty->assign(array('products' => $this->getProductData($id_product, $id_tab)));

        return $this->display($this->local_path, 'views/templates/admin/display-product-list.tpl');
    }

    private function generateCategoryTree($category_array)
    {
        $children = $category_tree = null;

        foreach ($category_array as $child) {
            $this->context->smarty->assign(array('category' => $child));
            $category = $this->display($this->local_path, 'views/templates/admin/display-category.tpl');

            if (isset($child['children'])) {
                $children .= $this->generateCategoryTree($child['children']);
                $this->context->smarty->assign(array(
                    'category' => $category,
                    'children' => $children,
                ));
                $category_tree .= $this->display(
                    $this->local_path,
                    'views/templates/admin/display-parent-category.tpl'
                );
                $children = null;
            } else {
                $this->context->smarty->assign(array('category' => $category));
                $category_tree .= $this->display(
                    $this->local_path,
                    'views/templates/admin/display-child-category.tpl'
                );
            }
        }

        return $category_tree;
    }

    private function displayCategories()
    {
        $result = $this->db->executeS(
            'SELECT c.`id_category`,
                    c.`id_parent`,
                    c.`active`,
                    c.`position`,
                    cl.`name`
            FROM '._DB_PREFIX_.'category c
            INNER JOIN '._DB_PREFIX_.'category_lang cl ON (cl.`id_category` = c.`id_category`
                AND cl.`id_lang` = '.(int)$this->context->language->id.'
                AND cl.id_shop = '.(int)$this->context->shop->id.')
            INNER JOIN '._DB_PREFIX_.'category_shop cs ON (cs.`id_category` = c.`id_category`
                AND cs.`id_shop` = '.(int)$this->context->shop->id.')
            ORDER BY c.`id_parent` ASC'
        );

        if (!empty($result)) {
            $root_category = Configuration::get('PS_ROOT_CATEGORY');

            $categories = $buff = array();

            foreach ($result as $row) {
                $current = &$buff[$row['id_category']];
                $current = $row;

                if ($row['id_category'] == $root_category) {
                    $categories[] = &$current;
                } else {
                    $buff[$row['id_parent']]['children'][] = &$current;
                }
            }

            $this->context->smarty->assign(array(
                'category_tree' => $this->generateCategoryTree($categories[0]['children'])
            ));
            return $this->display($this->local_path, 'views/templates/admin/display-category-tree.tpl');
        }
    }

    private function displayTabList($id_product)
    {
        $result = $this->db->executeS(
            'SELECT ptl.`id_tab`,
                    ptl.`title`,
                    ptl.`content`,
                    ptl.`status`
            FROM '._DB_PREFIX_.'product_tab pt
            LEFT JOIN '._DB_PREFIX_.'product_tab_lang ptl ON (ptl.`id_tab` = pt.`id_tab`)
            WHERE pt.`id_product` = '.(int)$id_product.'
              AND ptl.`id_shop` = '.(int)$this->context->shop->id.'
              AND ptl.`id_lang` = '.(int)$this->context->language->id.'
            ORDER BY ptl.`id_tab` ASC'
        );

        $this->context->smarty->assign(
            array(
                'cancel' => AdminController::$currentIndex.
                    '&configure='.$this->name.
                    '&token='.Tools::getAdminTokenLite('AdminProducts'),
                'tab_list' => $result,
            )
        );

        return $this->display($this->local_path, 'views/templates/admin/display-tab-list.tpl');
    }

    public function getTabData($id_tab)
    {
        $values = array();

        if ($id_tab) {
            $result = $this->db->executeS(
                'SELECT `id_tab`,
                        `id_lang`,
                        `title`,
                        `content`,
                        `status`
                FROM '._DB_PREFIX_.'product_tab_lang
                WHERE `id_tab` = '.(int)$id_tab.'
                  AND `id_shop` = '.(int)$this->context->shop->id
            );

            if ($result && is_array($result)) {
                foreach ($result as $data) {
                    $values['title'][$data['id_lang']] = $data['title'];
                    $values['content'][$data['id_lang']] = $data['content'];
                }

                $values['status'] = (int)$result[0]['status'];
            }
        }

        return $values;
    }

    private function displayTabForm($id_product, $id_tab = null)
    {
        $values = array();

        if ($id_tab) {
            $values = $this->getTabData($id_tab);
        }

        $this->context->smarty->assign(
            array(
                'languages' => Language::getLanguages(true),
                'default_form_language' => (int)$this->context->controller->default_form_language,
                'values' => $values,
                'product_list' => $this->displayProductList($id_product, $id_tab),
                'categories' => $this->displayCategories(),
            )
        );

        return $this->display($this->local_path, 'views/templates/admin/display-tab-form.tpl');
    }

    private function displayTabPage($id_product, $id_tab = null)
    {
        $iso = $this->context->language->iso_code;
        $this->context->smarty->assign(
            array(
                'tab_list' => $this->displayTabList($id_product),
                'tab_form' => $this->displayTabForm($id_product, $id_tab),
                'module_dir' => _MODULE_DIR_,
                'iso' => file_exists(_PS_CORE_DIR_.'/js/tiny_mce/langs/'.$iso.'.js') ? $iso : 'en',
                'path_css' => _THEME_CSS_DIR_,
                'admin_dir' => __PS_BASE_URI__.basename(_PS_ADMIN_DIR_),
                'secure_key' => $this->secure_key,
                'id_product' => $id_product,
            )
        );

        return $this->display($this->local_path, 'views/templates/admin/display-tab-page.tpl');
    }

    public function deleteTab($id_tab)
    {
        $this->db->delete('product_tab', '`id_tab` = '.(int)$id_tab);
        $this->db->delete('product_tab_lang', '`id_tab` = '.(int)$id_tab);
    }

    public function getContent()
    {
        $this->context->smarty->assign(array(
            'documentation_link' => $this->_path.'readme_en.pdf',
        ));

        return $this->display($this->local_path, 'views/templates/admin/configure.tpl');
    }

    public function hookDisplayAdminProductsExtra($params)
    {
        return $this->displayTabPage($params['id_product']);
    }

    public function hookActionProductSave($params)
    {
        if (Tools::getValue('simpletabs_submit') != 1) {
            return false;
        }

        $data = $insert = array();

        foreach (Language::getLanguages(true) as $language) {
            $data['title'] = pSQL(trim(Tools::getValue('simpletabs_title_'.(int)$language['id_lang'])));

            if (empty($data['title'])) {
                continue;
            }

            $data['content'] = pSQL(trim(Tools::getValue('simpletabs_content_'.(int)$language['id_lang'])), true);
            $data['id_lang'] = (int)$language['id_lang'];

            $insert[] = $data;
        }

        if (empty($insert)) {
            return false;
        }

        $id_tab = Tools::getValue('simpletabs_id_tab');
        $additional_products = Tools::getValue('simpletabs_productBox');
        $additional_categories = Tools::getValue('simpletabs_categoryBox');

        if (!is_numeric($id_tab)) {
            $this->db->insert('product_tab', array('id_product' => (int)$params['id_product']));
            $id_tab = $this->db->Insert_ID();
        } else {
            $this->db->delete(
                'product_tab',
                '`id_tab` = '.(int)$id_tab.' AND `id_product` != '.(int)$params['id_product']
            );
        }

        if (!empty($additional_products)) {
            foreach ($additional_products as $id_product) {
                $this->db->insert('product_tab', array(
                    'id_tab' => (int)$id_tab,
                    'id_product' => (int)$id_product,
                ), false, true, Db::ON_DUPLICATE_KEY);
            }
        }

        if (!empty($additional_categories)) {
            $this->db->execute(
                'INSERT INTO '._DB_PREFIX_.'product_tab (`id_tab`, `id_product`)
                SELECT "'.(int)$id_tab.'", `id_product`
                FROM '._DB_PREFIX_.'category_product cp
                WHERE cp.`id_category` IN ('.implode(',', array_map('intval', $additional_categories)).')
                ON DUPLICATE KEY UPDATE `id_tab` = "'.(int)$id_tab.'"'
            );
        }

        $common_data = array(
            'id_tab' => (int)$id_tab,
            'id_shop' => (int)$this->context->shop->id,
            'status' => (int)(Tools::getValue('simpletabs_status')),
        );

        foreach ($insert as $lang_data) {
            $this->db->insert(
                'product_tab_lang',
                array_merge($common_data, $lang_data),
                false,
                true,
                Db::ON_DUPLICATE_KEY
            );
        }
    }

    public function hookActionProductDelete($params)
    {
        $this->db->execute(
            'DELETE pt, ptl
            FROM '._DB_PREFIX_.'product_tab pt
            LEFT JOIN '._DB_PREFIX_.'product_tab_lang ptl
            ON (ptl.`id_tab` = pt.`id_tab`)
            WHERE pt.`id_product` = '.(int)$params['id_product']
        );
    }

    public function hookDisplayProductTab()
    {
        $result = $this->db->executeS(
            'SELECT ptl.`id_tab`,
                    ptl.`title`,
                    ptl.`content`
            FROM '._DB_PREFIX_.'product_tab pt
            LEFT JOIN '._DB_PREFIX_.'product_tab_lang ptl
            ON (ptl.`id_tab` = pt.`id_tab`
               AND ptl.`id_shop` = '.(int)$this->context->shop->id.'
               AND ptl.`id_lang` = '.(int)$this->context->language->id.')
            WHERE pt.`id_product` = '.(int)Tools::getValue('id_product').'
              AND ptl.`status` = 1
            ORDER BY ptl.`id_tab` ASC'
        );

        if ($result && !empty($result)) {
            $this->context->smarty->assign(array('tabs' => $result));

            return $this->display(__FILE__, 'tab.tpl');
        }
    }

    public function hookDisplayProductTabContent()
    {
        $result = $this->db->executeS(
            'SELECT ptl.`id_tab`,
                    ptl.`title`,
                    ptl.`content`
            FROM '._DB_PREFIX_.'product_tab pt
            LEFT JOIN '._DB_PREFIX_.'product_tab_lang ptl
            ON (ptl.`id_tab` = pt.`id_tab`
               AND ptl.`id_shop` = '.(int)$this->context->shop->id.'
               AND ptl.`id_lang` = '.(int)$this->context->language->id.')
            WHERE pt.`id_product` = '.(int)Tools::getValue('id_product').'
              AND ptl.`status` = 1
            ORDER BY ptl.`id_tab` ASC'
        );

        if ($result && !empty($result)) {
            $this->context->smarty->assign(array('tabs' => $result));

            return $this->display(__FILE__, 'display-footer-product.tpl');
        }
    }
}
