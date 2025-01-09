<?php
/**
* 2007-2018 Amazzing
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
*
*  @author    Amazzing <mail@amazzing.ru>
*  @copyright 2007-2018 Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/

class AmazzingBlog extends Module
{
    public $empty_date = '0000-00-00 00:00:00';

    public function __construct()
    {
        if (!defined('_PS_VERSION_')) {
            exit;
        }
        $this->name = 'amazzingblog';
        $this->tab = 'front_office_features';
        $this->version = '1.3.1';
        $this->author = 'Amazzing';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->module_key = '40276b75d9bf50788fddf308cda2ca59';

        parent::__construct();

        $this->displayName = $this->l('Amazzing blog');
        $this->description = $this->l('Blog for PrestaShop');
        $this->prepareGlobals();
    }

    public function prepareGlobals()
    {
        $this->db = Db::getInstance();
        $this->id_lang = $this->context->language->id;
        $this->id_shop = $this->context->shop->id;
        $this->img_dir = $this->_path.'views/img/uploads/';
        $this->img_dir_local = $this->local_path.'views/img/uploads/';
        $this->admin_controller = 'AdminBlog';
        $this->root_id = 1;
        $this->slug = 'blog';
        if (Module::isInstalled($this->name)) {
            $this->general_settings = $this->getSettings('general');
            if ($this->friendly_url = Configuration::get('PS_REWRITING_SETTINGS')) {
                $this->defineCustomSlug();
            }
        }
        $this->is_17 = Tools::substr(_PS_VERSION_, 0, 3) === '1.7';
    }

    public function defineCustomSlug()
    {
        $this->slug = 'blog';
        $this->slug_other_languages = array();
        $data = $this->db->executeS('
            SELECT link_rewrite, id_lang FROM '._DB_PREFIX_.'a_blog_category_lang
            WHERE id_shop = '.$this->id_shop.' AND id_category = '.(int)$this->root_id.'
        ');
        foreach ($data as $d) {
            if ($d['id_lang'] == $this->id_lang && $d['link_rewrite']) {
                $this->slug = $d['link_rewrite'];
            } else {
                $this->slug_other_languages[$d['id_lang']] = $d['link_rewrite'];
            }
        }
    }

    public function getSettings($type, $force_query = false)
    {
        if (empty($this->settings[$type]) || $force_query) {
            $settings = $this->db->getValue('
                SELECT value FROM '._DB_PREFIX_.'a_blog_settings
                WHERE name = \''.pSQL($type).'\'
                AND id_shop = '.(int)$this->context->shop->id.'
            ');
            $this->settings[$type] = $settings ? Tools::jsonDecode($settings, true) : array();
            if (in_array($type, array('post', 'postlist')) && !$this->general_settings['user_comments']) {
                $this->settings[$type]['show_comments'] = 0;
            }
        }
        return $this->settings[$type];
    }

    public function saveSettings($type, $data = array(), $forced_shop_ids = array())
    {
        if (!$required_settings = $this->getSettingsFields($type)) {
            $this->throwError($this->l('Undefined settings type'));
        }
        $to_save = array();
        foreach ($required_settings as $name => $field) {
            $to_save[$name] = isset($data[$name]) ? $data[$name] : $field['value'];
            if ($name == 'notif_email' && $to_save[$name] && !Validate::isEmail($to_save[$name])) {
                $this->throwError($this->l('Please use a correct e-mail'));
            }
            if ($name == 'avatar' || $type == 'img') {
                $value = explode('*', $to_save[$name]);
                $w = $value[0];
                $h = !empty($value[1]) ? $value[1] : 0;
                if (!$w || !$h || !Validate::isInt($w) || !Validate::isInt($h)) {
                    $this->throwError($this->l('Incorrect format: ').' '.implode('*', $value));
                }
                $to_save[$name] = $w.'*'.$h;
            }
        }
        $rows = array();
        $encoded_data = Tools::jsonEncode($to_save);
        $shop_ids = $forced_shop_ids ? $forced_shop_ids : $this->shop_ids;
        foreach ($shop_ids as $id_shop) {
            $rows[] = '(\''.pSQL($type).'\', '.(int)$id_shop.', \''.pSQL($encoded_data).'\')';
        }
        if ($rows) {
            $this->db->execute('REPLACE INTO '._DB_PREFIX_.'a_blog_settings VALUES '.implode(', ', $rows));
        }
        return $to_save;
    }

    public function install()
    {
        $installed = true;
        $this->shop_ids = Shop::getShops(false, null, true);
        if (!$this->prepareDatabase()
            || !parent::install()
            || !$this->prepareInitialSettings()
            || !$this->prepareDemoContent()
            || !$this->registerHook('displayHeader')
            || !$this->registerHook('displayBackofficeHeader')
            || !$this->registerHook('displayAdminProductsExtra')
            || !$this->registerHook('actionProductSave')
            || !$this->registerHook('moduleRoutes')
            || !$this->addTabs()
        ) {
            $installed = false;
        }
        return $installed;
    }

    public function getTables()
    {
        $tables = array(
            'a_blog_post' => '(
                id_post int(10) unsigned NOT NULL AUTO_INCREMENT,
                id_category_default int(10) unsigned NOT NULL,
                active tinyint(1) NOT NULL DEFAULT 1,
                cover varchar(32) NOT NULL,
                main_img varchar(32) NOT NULL,
                author int(10) NOT NULL,
                date_add datetime NOT NULL,
                publish_from datetime NOT NULL,
                publish_to datetime NOT NULL,
                PRIMARY KEY (id_post),
                KEY id_category_default (id_category_default),
                KEY active (active),
                KEY date_add (date_add),
                KEY publish_from (publish_from),
                KEY publish_to (publish_to),
                KEY author (author)
                )',
            'a_blog_post_stats' => '(
                id_post int(10) unsigned NOT NULL,
                views int(10) unsigned NOT NULL default 0,
                comments int(10) unsigned NOT NULL default 0,
                likes int(10) unsigned NOT NULL default 0,
                PRIMARY KEY (id_post),
                KEY views (views),
                KEY comments (comments),
                KEY likes (likes)
                )',
            'a_blog_post_lang' => '(
                id_post int(10) unsigned NOT NULL,
                id_shop int(10) unsigned NOT NULL,
                id_lang int(10) unsigned NOT NULL,
                link_rewrite varchar(255) NOT NULL,
                title text NOT NULL,
                meta_title varchar(255) NOT NULL,
                meta_description varchar(255) NOT NULL,
                meta_keywords varchar(255) NOT NULL,
                content text NOT NULL,
                date_upd datetime NOT NULL,
                PRIMARY KEY (id_post, id_shop, id_lang),
                KEY date_upd (date_upd)
                )',
            'a_blog_category' => '(
                id_category int(10) unsigned NOT NULL AUTO_INCREMENT,
                id_parent int(10) unsigned NOT NULL,
                active tinyint(1) NOT NULL DEFAULT 1,
                level_depth int(10) unsigned NOT NULL,
                position int(10) NOT NULL,
                date_add datetime NOT NULL,
                date_upd datetime NOT NULL,
                PRIMARY KEY (id_category),
                KEY id_parent (id_parent),
                KEY active (active),
                KEY date_add (date_add),
                KEY date_upd (date_upd)
                )',
            'a_blog_category_lang' => '(
                id_category int(10) unsigned NOT NULL,
                id_shop int(10) unsigned NOT NULL,
                id_lang int(10) unsigned NOT NULL,
                link_rewrite varchar(255) NOT NULL,
                title text NOT NULL,
                meta_title varchar(255) NOT NULL,
                meta_description varchar(255) NOT NULL,
                meta_keywords varchar(255) NOT NULL,
                description text NOT NULL,
                PRIMARY KEY (id_category, id_shop, id_lang)
                )',
            'a_blog_post_category' => '(
                id_category int(10) unsigned NOT NULL,
                id_post int(10) unsigned NOT NULL,
                position int(10) unsigned NOT NULL,
                PRIMARY KEY (id_category, id_post)
                )',
            'a_blog_tag' => '(
                id_tag int(10) unsigned NOT NULL AUTO_INCREMENT,
                id_lang int(10) unsigned NOT NULL,
                tag_url varchar(64) NOT NULL,
                tag_name varchar(64) NOT NULL,
                PRIMARY KEY (id_tag),
                KEY id_lang (id_lang),
                KEY tag_url (tag_url),
                KEY tag_name (tag_name)
                )',
            'a_blog_post_tag' => '(
                id_post int(10) unsigned NOT NULL,
                id_tag int(10) unsigned NOT NULL,
                PRIMARY KEY (id_post, id_tag)
                )',
            'a_blog_block' => '(
                id_block int(10) unsigned NOT NULL AUTO_INCREMENT,
                hook_name varchar(64) NOT NULL,
                position int(10) unsigned NOT NULL,
                active tinyint(1) NOT NULL,
                settings text NOT NULL,
                PRIMARY KEY (id_block)
                )',
            'a_blog_block_lang' => '(
                id_block int(10) unsigned NOT NULL,
                id_shop int(10) unsigned NOT NULL,
                id_lang int(10) unsigned NOT NULL,
                title text NOT NULL,
                PRIMARY KEY (id_block, id_shop, id_lang)
                )',
            'a_blog_comment' => '(
                id_comment int(10) unsigned NOT NULL AUTO_INCREMENT,
                id_shop int(10) unsigned NOT NULL,
                id_post int(10) unsigned NOT NULL,
                id_user int(10) unsigned NOT NULL,
                active tinyint(1) NOT NULL DEFAULT 0,
                approved_by int(10) unsigned NOT NULL DEFAULT 0,
                notif_sent tinyint(1) NOT NULL DEFAULT 0,
                content text NOT NULL,
                date_add datetime NOT NULL,
                date_upd datetime NOT NULL,
                ip varchar(32) NOT NULL,
                answers text NOT NULL,
                PRIMARY KEY (id_comment),
                KEY id_post (id_post),
                KEY active (active),
                KEY ip (ip)
                )',
            'a_blog_user' => '(
                id_user int(10) unsigned NOT NULL AUTO_INCREMENT,
                id_guest int(10) unsigned NOT NULL,
                user_name text NOT NULL,
                avatar text NOT NULL,
                PRIMARY KEY (id_user),
                KEY id_guest (id_guest)
                )',
            'a_blog_settings' => '(
                name varchar(16) NOT NULL,
                id_shop int(10) unsigned NOT NULL,
                value text NOT NULL,
                PRIMARY KEY (name, id_shop)
                )',
            'a_blog_hook_settings' => '(
                hook_name varchar(64) NOT NULL,
                id_shop int(10) unsigned NOT NULL,
                exc_type tinyint(1) NOT NULL DEFAULT 1 ,
                exc_controllers text NOT NULL,
                PRIMARY KEY (hook_name, id_shop)
                )',
            'a_blog_related_products' => '(
                id_post int(10) unsigned NOT NULL,
                id_product int(10) unsigned NOT NULL,
                position_post int(10) unsigned NOT NULL DEFAULT 0,
                position_product int(10) unsigned NOT NULL DEFAULT 0,
                PRIMARY KEY (id_post, id_product)
                )',
        );
        return $tables;
    }

    public function prepareDatabase()
    {
        $sql = array();
        $tables = $this->getTables();
        foreach ($tables as $k => $query) {
            $sql[] = 'CREATE TABLE IF NOT EXISTS `'.bqSQL(_DB_PREFIX_.$k).'` '.$query.'
            ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8';
        }
        return $this->runSql($sql);
    }

    public function prepareInitialSettings()
    {
        include_once('classes/BlogFields.php');
        $this->fields = new BlogFields();
        return $this->saveSettings('general')
            && $this->saveSettings('post')
            && $this->saveSettings('postlist')
            && $this->saveSettings('category')
            && $this->saveSettings('comment')
            && $this->saveSettings('img');
    }

    public function prepareDemoContent()
    {
        $prepared = true;
        if (!is_file($this->local_path.'defaults/data.zip') ||
            !$this->importData($this->local_path.'defaults/data.zip')) {
            $root_category_data = array(
                'id_category' => $this->root_id,
                'active' => 1,
                'id_parent' => 0,
                'position' => 0,
                'multilang' => array(),
            );
            foreach (Language::getLanguages() as $lang) {
                $root_category_data['multilang']['title'][$lang['id_lang']] = $this->l('Blog');
                $root_category_data['multilang']['link_rewrite'][$lang['id_lang']] = $this->slug;
                $root_category_data['multilang']['description'][$lang['id_lang']] = '';
            }
            $prepared &= $this->saveCategory($root_category_data);
        }
        $this->addRelatedBlocksIfRequired();
        return $prepared;
    }

    public function addRelatedBlocksIfRequired()
    {
        $initial_shop_ids = !empty($this->shop_ids) ? $this->shop_ids : Shop::getContextListShopID();
        $this->shop_ids = Shop::getShops(false, null, true);
        $id_lang = $this->context->language->id;
        $required_block_types = array(
            'post_relatedtoproduct' => array(
                'hook_name' => 'displayFooterProduct',
                'multilang' => array('title' => array($id_lang => $this->l('Related posts'))),
            ),
            'product_relatedtopost' => array(
                'hook_name' => 'displayPostFooter',
                'multilang' => array('title' => array($id_lang => $this->l('Related products'))),
            ),
        );
        $current_blocks = $this->db->executeS('SELECT * FROM '._DB_PREFIX_.'a_blog_block');
        foreach ($current_blocks as $b) {
            $settings = Tools::jsonDecode($b['settings'], true);
            if (isset($settings['type']) && isset($required_block_types[$settings['type']])) {
                unset($required_block_types[$settings['type']]);
            }
        }
        $block_fields = $this->fields->getBlockFields();
        foreach ($required_block_types as $type => $block_data) {
            $block_data['active'] = 1;
            $block_data['id_block'] = 0;
            // make sure all fields are submitted
            foreach ($block_fields as $field_name => $field) {
                if (empty($field['multilang'])) {
                    if (Tools::substr($field_name, 0, 9) === 'carousel_') {
                        $field_name = str_replace('carousel_', '', $field_name);
                        $block_data['settings']['carousel'][$field_name] = $field['value'];
                    } else {
                        $block_data['settings'][$field_name] = $field['value'];
                    }
                }
            }
            if ($type == 'product_relatedtopost') {
                $block_data['settings']['carousel']['i'] = '5';
                $block_data['settings']['carousel']['i_1200'] = '4';
                $block_data['settings']['carousel']['i_992'] = '3';
                $block_data['settings']['carousel']['i_768'] = '2';
                $block_data['settings']['carousel']['i_480'] = '1';
            }
            $block_data['settings']['exceptions'] = array();
            $block_data['settings']['type'] = $type;
            $this->saveBlock($block_data);
        }
        $this->shop_ids = $initial_shop_ids;
    }

    public function addTabs()
    {
        $parent_tab = new Tab();
        $parent_tab->name = array();
        foreach (Language::getLanguages() as $language) {
            $parent_tab->name[$language['id_lang']] = $this->l('Blog');
        }
        $parent_tab->class_name = $this->admin_controller;
        $parent_tab->id_parent = 0;
        $parent_tab->module = $this->name;
        $parent_tab->add();
        return true;
    }

    public function uninstall()
    {
        $sql = array();
        $tables = $this->getTables();
        foreach (array_keys($tables) as $name) {
            $sql[] = 'DROP TABLE IF EXISTS `'.bqSQL(_DB_PREFIX_.$name).'`';
        }
        if ($ret = $this->runSql($sql)) {
            $this->removeAllImages();

            // remove tabs
            $tab_id = Tab::getIdFromClassName($this->admin_controller);
            $tab = new Tab($tab_id);
            $tab->delete();

            $ret &= parent::uninstall();
        }
        return $ret;
    }

    public function removeAllImages()
    {
        $this->recursiveRemove($this->img_dir_local.'posts/', true);
        $this->recursiveRemove($this->img_dir_local.'categories/', true);
        $this->recursiveRemove($this->img_dir_local.'avatars/', true);
    }

    public function runSql($sql)
    {
        foreach ($sql as $s) {
            if (!$this->db->execute($s)) {
                return false;
            }
        }
        return true;
    }

    public function hookModuleRoutes()
    {
        $routes = array(
            'module-amazzingblog-blog' => array(
                'controller' => 'blog',
                'rule' =>  $this->slug.'/{rewrite}',
                'keywords' => array('rewrite' => array('regexp' => '[\/\+_a-zA-Z0-9-\pL]*')),
                'params' => array('fc' => 'module', 'module' => $this->name),
            ),
        );
        return $routes;
    }

    public function hookDisplayBackOfficeHeader()
    {
        $this->context->controller->addCSS($this->_path.'views/css/blog-icons.css', 'all');
        if (Tools::getValue('configure') == $this->name) {
            $this->context->controller->addJquery();
            $this->context->controller->addJqueryUI('ui.sortable');
            $this->context->controller->addJQueryUI('ui.datetimepicker');
            $this->context->controller->addJQueryPlugin('tagify');
            $this->context->controller->css_files[$this->_path.'views/css/back.css?'.$this->version] = 'all';
            if ($this->is_17) {
                $this->context->controller->css_files[$this->_path.'views/css/back-17.css?'.$this->version] = 'all';
            }
            $this->context->controller->css_files[$this->_path.'views/css/common-classes.css?'.$this->version] = 'all';
            $this->context->controller->js_files[] = $this->_path.'views/js/back.js?'.$this->version;
            // tinyMCE
            $this->context->controller->addJS(__PS_BASE_URI__.'js/tiny_mce/tiny_mce.js');
            if (file_exists(_PS_ROOT_DIR_.'/js/admin/tinymce.inc.js')) {
                $this->context->controller->addJS(__PS_BASE_URI__.'js/admin/tinymce.inc.js');
            } else { // retro-compatibility
                $this->context->controller->addJS(__PS_BASE_URI__.'js/tinymce.inc.js');
            }
        }
        if (Tools::getValue('controller') == 'AdminProducts') {
            $this->context->controller->addJqueryUI('ui.sortable');
        }
    }

    public function getContent()
    {
        $this->failed_txt = $this->l('Failed');
        $this->saved_txt = $this->l('Saved');
        $this->shop_ids = Shop::getContextListShopID();
        $this->special_img_types = array(
            'cover' => $this->l('cover'),
            'main_img' => $this->l('main image')
        );

        include_once('classes/BlogFields.php');
        $this->fields = new BlogFields();

        $this->img_settings = $this->getImgSettings();

        if (Tools::isSubmit('ajax') && Tools::isSubmit('action')) {
            $action_method = 'ajax'.Tools::getValue('action');
            $this->$action_method();
        }

        if (Tools::getValue('action') == 'exportData') {
            $this->exportData();
        }

        $iso = $this->context->language->iso_code;
        $mce_additional_css_files = array(
            $this->_path.'views/css/mce-styles.css?'.$this->version,
        );
        if (!$this->is_17) {
            $mce_additional_css_files[] = _THEME_CSS_DIR_.'global.css';
            // for 1.7 it should be _THEME_CSS_DIR_.'theme.css'
            // but for some reason if it is included in content_css,
            // mce html and body get hardcoded inline styles overflow-y: hidden
        }
        $js_strings = array(
            'iso' => file_exists(_PS_ROOT_DIR_.'/js/tiny_mce/langs/'.$iso.'.js') ? $iso : 'en',
            'mce_additional_css_files' => implode(', ', $mce_additional_css_files),
            'ad' => dirname($_SERVER['PHP_SELF']),
            'savedTxt' => $this->saved_txt,
            'failedTxt' => $this->failed_txt,
            'saveFisrt' => $this->l('Please save settings'),
            'areYouSureTxt' => $this->l('Are you sure?'),
            'ab_ajax_path' => $this->getConfigPagePath().'&ajax=1',
        );
        $js_vars = array(
            'PS_ALLOW_ACCENTED_CHARS_URL' => (int)Configuration::get('PS_ALLOW_ACCENTED_CHARS_URL'),
            'specialTypes' => Tools::jsonEncode(array_keys($this->special_img_types)),
            'is_17' => (int)$this->is_17,
            'id_lang_current' => (int)$this->context->language->id,
        );
        // plain js for retro-compatibility
        $js = '<script type="text/javascript">';
        foreach ($js_strings as $name => $value) {
            $js .= "\nvar $name = '".$this->escapeApostrophe($value)."';";
        }
        foreach ($js_vars as $name => $value) {
            $js .= "\nvar $name = ".$value.";";
        }
        $js .= "\n</script>";
        $html = $this->displayForm();
        // retro-compatibility
        $html .= $this->display(__FILE__, 'views/templates/admin/dynamic-modal.tpl');
        return $js.$html;
    }

    public function escapeApostrophe($string)
    {
        return str_replace("'", "\'", $string);
    }

    public function exportData()
    {
        $languages = Language::getLanguages(false);
        $all_shop_ids = Shop::getShops(false, null, true);
        $lang_id_iso = array();
        foreach ($languages as $lang) {
            $lang_id_iso[$lang['id_lang']] = $lang['iso_code'];
        }

        $id_shop_default = Configuration::get('PS_SHOP_DEFAULT');
        $id_lang_default = Configuration::get('PS_LANG_DEFAULT');

        $tables_to_export = array_keys($this->getTables());
        $tables_to_export[] = 'hook_module';
        $tables_to_export = array_combine($tables_to_export, $tables_to_export);
        if (!$include_comments = Tools::getValue('include_comments')) {
            unset($tables_to_export['a_blog_comment']);
            unset($tables_to_export['a_blog_user']);
        }
        if (!$include_related_products = Tools::getValue('include_related_products')) {
            unset($tables_to_export['a_blog_related_products']);
        }
        $export_data = array();
        foreach ($tables_to_export as $table_name) {
            $ret = array();
            $data_from_db = $this->db->executeS('SELECT * FROM `'.bqSQL(_DB_PREFIX_.$table_name).'`');
            if (strpos($table_name, '_lang') !== false) {
                foreach ($data_from_db as $row) {
                    $id_shop = $row['id_shop'] == $id_shop_default ? 'ID_SHOP_DEFAULT' : $row['id_shop'];
                    $iso = $row['id_lang'] == $id_lang_default ? 'LANG_ISO_DEFAULT' : $lang_id_iso[$row['id_lang']];
                    // if ($id_shop != 'ID_SHOP_DEFAULT' || $iso != 'LANG_ISO_DEFAULT') continue;
                    $ret[$id_shop][$row[key($row)]][$iso] = $row;
                }
            } elseif ($table_name == 'a_blog_tag') {
                foreach ($data_from_db as $row) {
                    $iso = $row['id_lang'] == $id_lang_default ? 'LANG_ISO_DEFAULT' : $lang_id_iso[$row['id_lang']];
                    // if ($iso != 'LANG_ISO_DEFAULT') continue;
                    $ret[$iso][] = $row;
                }
            } elseif (in_array($table_name, array('a_blog_settings', 'a_blog_comment'))) {
                foreach ($data_from_db as $row) {
                    $id_shop = $row['id_shop'] == $id_shop_default ? 'ID_SHOP_DEFAULT' : $row['id_shop'];
                    // if ($id_shop != 'ID_SHOP_DEFAULT') continue;
                    $ret[$id_shop][] = $row;
                }
            } elseif ($table_name == 'hook_module') {
                foreach ($data_from_db as $row) {
                    if ($row['id_module'] != $this->id) {
                        continue;
                    }
                    $id_shop = $row['id_shop'] == $id_shop_default ? 'ID_SHOP_DEFAULT' : $row['id_shop'];
                    // if ($id_shop != 'ID_SHOP_DEFAULT') continue;
                    $hook_name = Hook::getNameByid($row['id_hook']);
                    $ret[$id_shop][$hook_name] = $row['position'];
                }
            } else {
                $ret = $data_from_db;
            }

            if (isset($ret['ID_SHOP_DEFAULT'])) {
                foreach ($all_shop_ids as $id_shop) {
                    if ($id_shop != $id_shop_default && !isset($ret[$id_shop])) {
                        $ret[$id_shop] = array();
                    }
                }
            }
            $export_data[$table_name] = $ret;
        }

        $tmp_zip_file = tempnam($this->local_path.'tmp', 'zip');
        $zip = new ZipArchive();
        $zip->open($tmp_zip_file, ZipArchive::OVERWRITE);
        $zip->addFromString('data.txt', Tools::jsonEncode($export_data));
        $this->addToZipRecursively($zip, $this->img_dir_local.'posts/');
        $this->addToZipRecursively($zip, $this->img_dir_local.'categories/');
        $this->addToZipRecursively($zip, $this->img_dir_local.'avatars/');
        $zip->close();

        $archive_name = 'backup-'.date('d-m-Y');
        if (!$include_comments) {
            $archive_name .= '-no-comments';
        }
        if (!$include_related_products) {
            $archive_name .= '-no-related-products';
        }
        $archive_name .= '.zip';

        header('Content-Type: application/zip');
        header('Content-Length: '.filesize($tmp_zip_file));
        header('Content-Disposition: attachment; filename="'.$archive_name.'"');
        readfile($tmp_zip_file);
        unlink($tmp_zip_file);
        return '';
    }

    public function addToZipRecursively(&$zip, $dir)
    {
        $structure = glob(rtrim($dir, '/').'/*');
        if (is_array($structure)) {
            foreach ($structure as $file) {
                if (is_dir($file)) {
                    $this->addToZipRecursively($zip, $file);
                } elseif (is_file($file)) {
                    $zip->addFile($file, str_replace($this->img_dir_local, 'uploads/', $file));
                }
            }
        }
    }

    public function ajaxImportData()
    {
        if ($this->importData()) {
            $ret = array('upd_html' => utf8_encode($this->import_response.$this->displayForm()));
        } else {
            $ret = array('errors' => $this->import_response);
        }
        exit(Tools::jsonEncode($ret));
    }

    public function importData($zip_file = false)
    {
        $tmp_dir = $this->local_path.'tmp/';
        $exctracted_contents_dir =  $tmp_dir.'uploaded_extracted/';
        $tmp_zip_file = $tmp_dir.'uploaded.zip';
        if (!$zip_file) {
            if (!isset($_FILES['zipped_data'])) {
                return $this->clearFilesAndSetError($this->l('File not uploaded'));
            }
            $uploaded_file = $_FILES['zipped_data'];
            $type = $uploaded_file['type'];
            $accepted_types = array(
                'application/zip',
                'application/x-zip-compressed',
                'multipart/x-zip',
                'application/x-compressed'
            );
            if (!in_array($type, $accepted_types)) {
                return $this->clearFilesAndSetError($this->l('Please upload a valid zip file'));
            }
            if (!move_uploaded_file($uploaded_file['tmp_name'], $tmp_zip_file)) {
                return $this->clearFilesAndSetError($this->failed_txt);
            }
        } else {
            Tools::copy($zip_file, $tmp_zip_file);
        }

        if (!Tools::ZipExtract($tmp_zip_file, $exctracted_contents_dir)
        || !file_exists($exctracted_contents_dir.'data.txt')) {
            return $this->clearFilesAndSetError($this->l('This is not a valid backup file'));
        }

        $imported_data = Tools::jsonDecode(Tools::file_get_contents($exctracted_contents_dir.'data.txt'), true);
        if (!$include_comments = Tools::getValue('include_comments')) {
            unset($imported_data['a_blog_comment']);
            unset($imported_data['a_blog_user']);
        }
        if (!Tools::getValue('include_related_products')) {
            unset($imported_data['a_blog_related_products']);
        }

        $languages = Language::getLanguages(false);
        $lang_iso_id = array();
        foreach ($languages as $lang) {
            $lang_iso_id[$lang['iso_code']] = $lang['id_lang'];
        }
        $id_lang_default = Configuration::get('PS_LANG_DEFAULT');
        $shop_ids = Shop::getShops(false, null, true);
        $tables = array_keys($this->getTables());
        $tables_to_fill = $hooks_data = array();

        foreach ($tables as $table_name) {
            $rows = array();
            if (!isset($imported_data[$table_name])) {
                $imported_data[$table_name] = array();
            }
            if (strpos($table_name, '_lang') !== false) {
                foreach ($shop_ids as $id_shop) {
                    $key = isset($imported_data[$table_name][$id_shop]) ? $id_shop : 'ID_SHOP_DEFAULT';
                    $data = $imported_data[$table_name][$key];
                    foreach ($data as $multilang) {
                        foreach ($lang_iso_id as $iso => $id_lang) {
                            $key = isset($multilang[$iso]) ? $iso : 'LANG_ISO_DEFAULT';
                            $lang_row = $multilang[$key];
                            $lang_row['id_shop'] = $id_shop;
                            $lang_row['id_lang'] = $id_lang;
                            $rows[] = $lang_row;
                        }
                    }
                }
            } elseif ($table_name == 'a_blog_tag') {
                $data = $imported_data[$table_name];
                // tags should be filled only for matching languages
                foreach ($data as $iso => $tag_rows) {
                    if ($iso == 'LANG_ISO_DEFAULT') {
                        $id_lang = $id_lang_default;
                    } elseif (isset($lang_iso_id[$iso])) {
                        $id_lang = $lang_iso_id[$iso];
                    } else {
                        $id_lang = false;
                    }
                    if ($id_lang) {
                        foreach ($tag_rows as $tag_row) {
                            $tag_row['id_lang'] = $id_lang;
                            $rows[] = $tag_row;
                        }
                    }
                }
            } elseif (in_array($table_name, array('a_blog_settings', 'a_blog_comment'))) {
                foreach ($shop_ids as $id_shop) {
                    $key = isset($imported_data[$table_name][$id_shop]) ? $id_shop : 'ID_SHOP_DEFAULT';
                    if (isset($imported_data[$table_name][$key])) {
                        $data = $imported_data[$table_name][$key];
                        foreach ($data as $row) {
                            $row['id_shop'] = $id_shop;
                            $rows[] = $row;
                        }
                    }
                }
            } elseif ($table_name == 'a_blog_post_stats' && !$include_comments) {
                foreach ($imported_data[$table_name] as $row) {
                    $row['comments'] = 0;
                    $rows[] = $row;
                }
            } elseif ($table_name == 'a_blog_post') {
                foreach ($imported_data[$table_name] as $row) {
                    // retro compatibility
                    $row['publish_from'] = isset($row['publish_from']) ? $row['publish_from'] : $row['date_add'];
                    $row['publish_to'] = isset($row['publish_to']) ? $row['publish_to'] : '';
                    $rows[] = $row;
                }
            } else {
                $rows = $imported_data[$table_name];
            }
            $tables_to_fill[$table_name] = $rows;
        }

        $sql = array();
        foreach ($tables_to_fill as $table_name => $rows_to_insert) {
            $db_columns = $this->db->executeS('SHOW COLUMNS FROM '._DB_PREFIX_.pSQL($table_name));
            $column_names = array();
            foreach ($db_columns as $col) {
                $column_names[$col['Field']] = $col['Field'];
            }

            $sql[] = 'TRUNCATE '._DB_PREFIX_.pSQL($table_name);
            $rows = array();
            foreach ($rows_to_insert as $row) {
                $values = array();
                foreach ($column_names as $col_name) {
                    if (!isset($row[$col_name])) {
                        $err = $this->l('Database tables don\'t match (%s).');
                        return $this->clearFilesAndSetError(sprintf($err, _DB_PREFIX_.$table_name));
                    } else {
                        $value = $row[$col_name];
                        $allow_html = in_array($col_name, array('content', 'description'));
                        $value = pSQL((_PS_MAGIC_QUOTES_GPC_ ? addslashes($value) : $value ), $allow_html);
                    }
                    $values[] = $value;
                }
                $rows[] = '(\''.implode('\', \'', $values).'\')';
            }
            if (!$rows || !$column_names) {
                continue;
            }
            $sql[] = '
                REPLACE INTO '._DB_PREFIX_.pSQL($table_name).'
                ('.implode(', ', array_map('pSQL', $column_names)).')
                VALUES '.implode(', ', $rows).'
            ';
        }

        if ($imported = $this->runSql($sql)) {
            // register hooks
            $hooks_to_register = array();
            foreach ($imported_data['a_blog_block'] as $b) {
                $hooks_to_register[$b['hook_name']] = 1;
            }
            foreach ($shop_ids as $id_shop) {
                foreach (array_keys($hooks_to_register) as $hook_name) {
                    $this->registerHook($hook_name, array($id_shop));
                }
            }

            $this->removeAllImages();
            // upload new images
            Tools::ZipExtract($tmp_zip_file, $this->local_path.'views/img/');
            unlink($this->local_path.'views/img/data.txt');

            // save original shop context, because it will be changed while setting up hooks & positions
            $original_shop_context = Shop::getContext();
            $original_shop_context_id = null;
            if ($original_shop_context == Shop::CONTEXT_GROUP) {
                $original_shop_context_id = $this->context->shop->id_shop_group;
            } elseif ($original_shop_context == Shop::CONTEXT_SHOP) {
                $original_shop_context_id = $this->context->shop->id;
            }

            if (!empty($imported_data['hook_module'])) {
                foreach ($shop_ids as $id_shop) {
                    $key = isset($imported_data['hook_module'][$id_shop]) ? $id_shop : 'ID_SHOP_DEFAULT';
                    $hooks_data[$id_shop] = $imported_data['hook_module'][$key];
                }
            }
            foreach ($hooks_data as $id_shop => $hook_list) {
                foreach ($hook_list as $hook_name => $position) {
                    if ($id_shop != $this->context->shop->id) {
                        Cache::clean('hook_module_list');
                        Shop::setContext(Shop::CONTEXT_SHOP, $id_shop);
                    }
                    $id_hook = Hook::getIdByName($hook_name);
                    $this->registerHook($hook_name, array($id_shop));
                    $this->updatePosition($id_hook, 0, $position);
                }
            }
            Shop::setContext($original_shop_context, $original_shop_context_id);

            // make sure all settings are properly saved for all shops
            $settings = array('general', 'img', 'post', 'postlist', 'category', 'comment');
            foreach ($shop_ids as $id_shop) {
                foreach ($settings as $type) {
                    $saved_settings = $this->db->getValue('
                        SELECT value FROM '._DB_PREFIX_.'a_blog_settings
                        WHERE name = \''.pSQL($type).'\'
                        AND id_shop = '.(int)$id_shop.'
                    ');
                    $saved_settings = Tools::jsonDecode($saved_settings, true);
                    $this->saveSettings($type, $saved_settings, array($id_shop));
                }
            }

            // update settings data for the new form
            $this->general_settings = $this->getSettings('general', true);
            $this->import_response = $this->displayConfirmation($this->l('Data was successfully imported'));
        } else {
            $this->import_response = $this->displayError($this->l('An error occured while importing data'));
        }
        $this->recursiveRemove($tmp_dir, true);
        return $imported;
    }


    private function displayForm()
    {
        $available_hooks = $this->getAvailableHooks();
        $blocks = $this->getBlocks();
        $hooks = array();
        foreach ($blocks as $block) {
            $hooks[$block['hook_name']] = isset($hooks[$block['hook_name']]) ? $hooks[$block['hook_name']] + 1 : 1;
            unset($available_hooks[$block['hook_name']]);
        }
        arsort($hooks);
        $hooks += $available_hooks;

        $pagination_settings = array();
        foreach (array('post', 'comment') as $resource) {
            $pagination_settings[$resource] = $this->getPaginationSettings($resource);
        }
        $order_by = Tools::getValue('order_by', 'publish_from');
        $order_way = Tools::getValue('order_way', 'DESC');

        $comment_filters = array(
            'id_post' => array(
                'label' => $this->l('Filter by post'),
                'options' => $this->getFullList('post'),
            ),
            'id_user' => array(
                'label' => $this->l('Filter by user'),
                'options' => $this->getFullList('user'),
            ),
            'active' => array(
                'label' => $this->l('Filter by status'),
                'options' => array(
                    '1' => $this->l('Visible'),
                    '0' => $this->l('Hidden'),
                ),
            ),
        );

        $this->context->smarty->assign(array(
            'languages' => Language::getLanguages(false),
            'id_lang_current' => $this->id_lang,
            'posts' => $this->getPostListInfos($pagination_settings['post'], $order_by, $order_way),
            'total_posts_num' => $pagination_settings['post']['total'],
            'order_by' => $order_by,
            'order_way' => $order_way,
            'pagination_posts' => $this->renderPagination($pagination_settings['post']),
            'sorted_categories' => $this->getSortedCategories(),
            'total_cats_num' => $this->getTotal('category'),
            'authors' => $this->getAuthorOptions(),
            'root_id' => $this->root_id,
            'comments' => $this->getCommentListInfos($pagination_settings['comment'], 'date_add', 'DESC'),
            'total_comments_num' => $pagination_settings['comment']['total'],
            'comment_filters' => $comment_filters,
            'pagination_comments' => $this->renderPagination($pagination_settings['comment']),
            'new_comments_num' => $this->getTotal('comment', array('approved_by' => '0')),
            'settings_types' => array(
                'post' => $this->l('Post page'),
                'postlist' => $this->l('Post list'),
                'category' => $this->l('Category page'),
                'comment' => $this->l('Comments'),
                'img' => $this->l('Images'),
                'general' => $this->l('General'),
            ),
            'avatars_dir' => $this->img_dir.'avatars/',
            'hooks' => $hooks,
            'blocks' => $blocks,
            'id_lang_current' => $this->id_lang,
            'img_settings' => $this->img_settings,
            'sorting_options' => $this->getSortingOptions(),
            'tags_options' => $this->getTagsOptions(),
            'state_options' => $this->getStateOptions(),
            'documentation_link' => $this->_path.'readme_en.pdf',
            'info_links' => array(
                'changelog' => $this->_path.'Readme.md?v='.$this->version,
                'documentation' => $this->_path.'readme_en.pdf?v='.$this->version,
                'contact' => 'https://addons.prestashop.com/en/contact-us?id_product=22905',
                'modules' => 'http://addons.prestashop.com/en/2_community-developer?contributor=64815',
            ),
            'files_update_warnings' => $this->getFilesUpdadeWarnings(),
            'blog' => $this,
        ));
        return $this->display(__FILE__, 'views/templates/admin/configure.tpl');
    }

    public function getFilesUpdadeWarnings()
    {
        $warnings = $customizable_layout_files = array();
        $locations = array(
            '/css/' => 'css',
            '/js/'  => 'js',
            '/templates/admin/' => 'tpl',
            '/templates/hook/' => 'tpl',
            '/templates/front/' => 'tpl',
        );
        foreach ($locations as $loc => $ext) {
            $loc = 'views'.$loc;
            $files = glob($this->local_path.$loc.'*.'.$ext);
            foreach ($files as $file) {
                $customizable_layout_files[] = '/'.$loc.basename($file);
            }
        }
        foreach ($customizable_layout_files as $file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if ($this->is_17) {
                $customized_file_path = _PS_THEME_DIR_.'modules/'.$this->name.$file;
            } else {
                $customized_file_path = _PS_THEME_DIR_.($ext != 'tpl' ? $ext.'/' : '').'modules/'.$this->name.$file;
            }
            if (file_exists($customized_file_path)) {
                $original_file_path = $this->local_path.$file;
                $original_rows = file($original_file_path);
                $original_identifier = trim(array_pop($original_rows));
                $customized_rows = file($customized_file_path);
                $customized_identifier = trim(array_pop($customized_rows));
                if ($original_identifier != $customized_identifier) {
                    $warnings[$file] = $original_identifier;
                }
            }
        }
        return $warnings;
    }

    public function getAuthorOptions()
    {
        $authors_data = $this->db->executeS('
            SELECT e.id_employee AS author, e.firstname, e.lastname FROM '._DB_PREFIX_.'employee e
        ');
        $options = array();
        foreach ($authors_data as $a) {
            $options[$a['author']] = $a['firstname'].' '.$a['lastname'];
        }
        return $options;
    }

    public function getFullList($resource = 'post')
    {
        $sorted_list = array();
        $data = array();
        switch ($resource) {
            case 'post':
                $query = '
                    SELECT p.id_post AS id, pl.title as name
                    FROM '._DB_PREFIX_.'a_blog_comment c
                    LEFT JOIN  '._DB_PREFIX_.'a_blog_post p ON p.id_post = c.id_post
                    LEFT JOIN '._DB_PREFIX_.'a_blog_post_lang pl ON pl.id_post = p.id_post
                    WHERE c.id_shop IN ('.implode(', ', array_map('intval', $this->shop_ids)).')
                    AND pl.id_lang = '.(int)$this->id_lang.'
                ';
                break;
            case 'user':
                $query = '
                    SELECT c.id_user AS id, u.user_name as name
                    FROM '._DB_PREFIX_.'a_blog_comment c
                    LEFT JOIN '._DB_PREFIX_.'a_blog_user u ON u.id_user = c.id_user
                    WHERE id_shop IN ('.implode(', ', array_map('intval', $this->shop_ids)).')
                ';
                break;
        }
        $data = $this->db->executeS($query);
        foreach ($data as $d) {
            $sorted_list[$d['id']] = $d['name'];
        }
        return $sorted_list;
    }

    public function getTotal($resource = 'post', $additional_filters = array())
    {
        $query = '';
        $imploded_shop_ids = empty($this->shop_ids) ? $this->context->shop->id : implode(', ', $this->shop_ids);
        switch ($resource) {
            case 'post':
            case 'category':
                $identifier = 'id_'.$resource;
                $query = new DbQuery();
                $query->select('COUNT(DISTINCT main.'.pSQL($identifier).')');
                $query->from('a_blog_'.pSQL($resource), 'main');
                $query->innerJoin(
                    'a_blog_'.pSQL($resource).'_lang',
                    'lang',
                    'lang.'.pSQL($identifier).' = main.'.pSQL($identifier)
                );
                if ($resource == 'post') {
                    $this->addDateAndStateAssociation($query, $additional_filters, 'main');
                    $this->addJoinFiltersAssociation($query, $additional_filters, 'main');
                }
                foreach ($additional_filters as $name => $value) {
                    if ($value != '-') {
                        $query->where('main.'.pSQL($name).' = \''.pSQL($value).'\'');
                    }
                }
                $query->where('lang.id_shop IN ('.pSQL($imploded_shop_ids).')');
                break;
            case 'comment':
                $query = new DbQuery();
                $query->select('COUNT(DISTINCT c.id_comment)');
                $query->from('a_blog_comment', 'c');
                $query->innerJoin('a_blog_post', 'p', 'c.id_post = p.id_post');
                $query->where('c.id_shop IN ('.pSQL($imploded_shop_ids).')');
                foreach ($additional_filters as $name => $value) {
                    if ($value != '-') {
                        $query->where('c.'.pSQL($name).' = \''.pSQL($value).'\'');
                    }
                }
                break;
        }
        $num = $query ? $this->db->getValue($query) : 0;
        return $num;
    }

    public function addJoinFiltersAssociation($query, &$additional_filters, $alias = 'p')
    {
        $join_filters = array('id_category', 'id_tag');
        foreach ($join_filters as $col_name) {
            if (!empty($additional_filters[$col_name]) &&
                (int)$additional_filters[$col_name]) {
                if (!is_array($additional_filters[$col_name])) {
                    $additional_filters[$col_name] = array($additional_filters[$col_name]);
                }
                $ids = implode(', ', array_map('intval', $additional_filters[$col_name]));
                $table_name = str_replace('id_', '', $col_name);
                $join_str = pSQL($alias).'.id_post = '.pSQL($table_name).'.id_post
                AND '.pSQL($table_name).'.'.pSQL($col_name).' IN ('.pSQL($ids).')';
                $query->innerJoin(
                    'a_blog_post_'.pSQL($table_name),
                    pSQL($table_name),
                    $join_str
                );
                unset($additional_filters[$col_name]);
            }
        }
    }

    public function addDateAndStateAssociation($query, &$additional_filters = array(), $alias = 'p')
    {
        $now = date('Y-m-d H:i:s');
        if (in_array($this->context->controller->controller_type, array('front', 'modulefront'))) {
            $this->onlyPublishedAssociation($query, $alias, $now);
        } else {
            $query->select('DATEDIFF('.pSQL($alias).'.publish_from, \''.pSQL($now).'\') AS days_before_publish');
            $query->select('DATEDIFF(\''.pSQL($now).'\', '.pSQL($alias).'.publish_to) AS days_expired');
            if (!empty($additional_filters['state']) && $additional_filters['state'] != '-') {
                switch ($additional_filters['state']) {
                    case 'visible':
                        $query->where(pSQL($alias).'.active = 1');
                        break;
                    case 'hidden':
                        $query->where(pSQL($alias).'.active = 0');
                        break;
                    case 'published':
                        $this->onlyPublishedAssociation($query, $alias, $now);
                        break;
                    case 'not_published_yet':
                        $query->where(pSQL($alias).'.publish_from > \''.pSQL($now).'\'');
                        break;
                    case 'expired':
                        $query->where(pSQL($alias).'.publish_to <> \''.pSQL($this->empty_date).'\'');
                        $query->where(pSQL($alias).'.publish_to < \''.pSQL($now).'\'');
                        break;
                }
            }
            unset($additional_filters['state']);
        }
    }

    public function onlyPublishedAssociation($query, $alias = 'p', $now = false)
    {
        $now = !$now ? date('Y-m-d H:i:s') : $now;
        $query->where(pSQL($alias).'.publish_from <= \''.pSQL($now).'\'');
        $query->where(pSQL($alias).'.publish_to = \''.pSQL($this->empty_date).'\'
        OR '.pSQL($alias).'.publish_to >= \''.pSQL($now).'\'');
    }

    public function getPaginationSettings($resource = 'post', $additional_filters = array(), $forced_page = false)
    {
        if ($npp = Tools::getValue('npp')) {
            $this->context->cookie->__set('ab_user_npp', $npp);
        } elseif (!empty($this->context->cookie->ab_user_npp)) {
            $npp = $this->context->cookie->ab_user_npp;
        } else {
            $npp = 10;
        }
        $settings = array(
            'p' => $forced_page ? $forced_page : Tools::getValue('p', 1),
            'total' => Tools::getValue('total', $this->getTotal($resource, $additional_filters)),
            'npp' => $npp,
            'npp_options' => $this->getNppOptions(),
        );
        return $settings;
    }

    public function getNppOptions()
    {
        return array(5 => 5, 10 => 10, 20 => 20, 100 => 100);
    }

    public function getSortingOptions()
    {
        $options = array(
            'p.id_post' => $this->l('ID'),
            'date_add' => $this->l('Date added'),
            'date_upd' => $this->l('Date modified'),
            'publish_from' => $this->l('Publication date'),
            'views' => $this->l('Views'),
            'comments' => $this->l('Comments'),
            'position' => $this->l('Position'),
            // 'pl.title' => $this->l('Title'),
        );
        return $options;
    }

    public function getStateOptions()
    {
        $options = array(
            'visible' => $this->l('Visible'),
            'hidden' => $this->l('Hidden'),
            'published' => $this->l('Published'),
            'not_published_yet' => $this->l('Not published yet'),
            'expired' => $this->l('Expired'),
        );
        return $options;
    }

    public function getTagsOptions()
    {
        $options = $lang_id_iso = array();
        $lang_data = $this->db->executeS('SELECT id_lang, iso_code FROM '._DB_PREFIX_.'lang');
        foreach ($lang_data as $ld) {
            $lang_id_iso[$ld['id_lang']] = $ld['iso_code'];
        }
        $all_tags = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'a_blog_tag t
            INNER JOIN '._DB_PREFIX_.'a_blog_post_tag pt
                ON pt.id_tag = t.id_tag
        ');
        foreach ($all_tags as $t) {
            $id_lang = $t['id_lang'];
            $iso_code = isset($lang_id_iso[$id_lang]) ? $lang_id_iso[$id_lang] : '--';
            $options[$iso_code][$t['id_tag']] = $t['tag_name'];
        }
        return $options;
    }

    public function renderPagination($settings)
    {
        $this->context->smarty->assign(array(
            'settings' => $settings
        ));
        return $this->display(__FILE__, 'views/templates/front/pagination.tpl');
    }

    public function getCommentListInfos(
        $pagination_settings,
        $order_by,
        $order_way,
        $additional_filters = array(),
        $id_comment = false
    ) {
        if ($pagination_settings['npp'] == 'all') {
            $pagination_settings['npp'] = $pagination_settings['total'];
        }
        $query = new DbQuery();
        $query->select('c.*, u.*, bpl.title AS post_title, e.firstname AS approved_by_name');
        $query->from('a_blog_comment', 'c');
        $query->leftJoin('a_blog_user', 'u', 'u.id_user = c.id_user');
        $query->leftJoin('a_blog_post_lang', 'bpl', 'bpl.id_post = c.id_post AND bpl.id_shop = c.id_shop');
        $query->leftJoin('employee', 'e', 'e.id_employee = c.approved_by');
        $query->where('bpl.id_lang = '.(int)$this->id_lang);
        $query->where('c.id_shop IN ('.implode(', ', $this->shop_ids).')');
        foreach ($additional_filters as $name => $value) {
            if ($value != '-') {
                $query->where('c.'.$name.' = '.(int)$value);
            }
        }
        if ($id_comment) {
            $query->where('c.id_comment = '.(int)$id_comment);
        }
        $query->orderBy('approved_by ASC, '.pSQL($order_by).' '.pSQL($order_way));
        if (!$id_comment) {
            $limit = $pagination_settings['npp'];
            $offset = ($pagination_settings['p'] - 1) * $pagination_settings['npp'];
            $query->limit($limit, $offset);
        }

        $comments = $id_comment ? $this->db->getRow($query) : $this->db->executeS($query);

        return $comments;
    }

    public function ajaxDisplayListItems()
    {
        $resource = Tools::getValue('resource');
        $additional_filters = $this->unserialize(Tools::getValue('filters'));
        $pagination_settings = $this->getPaginationSettings($resource, $additional_filters);
        $pagination_html = $this->renderPagination($pagination_settings);
        $order_by = Tools::getValue('order_by', 'publish_from');
        $order_way = Tools::getValue('order_way', 'DESC');

        $items = array();
        switch ($resource) {
            case 'post':
                $items = $this->getPostListInfos($pagination_settings, $order_by, $order_way, $additional_filters);
                break;
            case 'comment':
                $items = $this->getCommentListInfos($pagination_settings, 'date_add', 'DESC', $additional_filters);
                break;
        }
        $items_html = '';
        $smarty_array = array(
            'blog' => $this,
            'order_by' => $order_by,
            'order_way' => $order_way,
        );
        if ($resource == 'comment') {
            $smarty_array['avatars_dir'] = $this->img_dir.'avatars/';
            $smarty_array['blog'] = $this;
        }
        foreach ($items as $item) {
            $smarty_array[$resource] = $item;
            $this->context->smarty->assign($smarty_array);
            $items_html .= $this->display(__FILE__, 'views/templates/admin/'.$resource.'-form.tpl');
        }
        if (!$items_html) {
            $items_html = $this->display(__FILE__, 'views/templates/admin/no-items.tpl');
        }
        $ret = array(
            'items_html' => utf8_encode($items_html),
            'total' => $pagination_settings['total'],
            'pagination_html' => utf8_encode($pagination_html),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function ajaxUpdatePostPositions()
    {
        $id_post = Tools::getValue('id_post');
        $id_cat = Tools::getValue('id_cat');
        $new_position = Tools::getValue('new_position');
        $p = Tools::getValue('p');
        $npp = Tools::getValue('npp');
        $order_way = Tools::getValue('order_way');
        $saved = $this->updatePostPositions($id_post, $id_cat, $new_position, $order_way, $p, $npp);
        exit(Tools::jsonEncode(array('saved' => $saved)));
    }

    public function updatePostPositions($id_post, $id_cat, $new_position, $order_way = 'ASC', $p = 1, $npp = 0)
    {
        $posts = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'a_blog_post_category
            WHERE id_category = '.(int)$id_cat.'
            ORDER BY position '.pSQL($order_way).'
        ');
        $ordered = array();
        $key = 0;
        foreach ($posts as $k => $post) {
            if ($post['id_post'] == 0) {
                $this->db->execute('
                    DELETE FROM '._DB_PREFIX_.'a_blog_post_category WHERE id_post = 0
                ');
            } else {
                $ordered[] = $post['id_post'];
                if ($post['id_post'] == $id_post) {
                    $key = $k;
                }
            }
        }
        $position_global = (($p - 1) * (int)$npp) + $new_position;

        $out = array_splice($ordered, $key, 1);
        array_splice($ordered, $position_global - 1, 0, $out);

        $saved = true;
        if ($ordered) {
            $i = 1;
            $upd_rows = array();
            foreach ($ordered as $id_post) {
                $upd_rows[] = '('.(int)$id_cat.', '.(int)$id_post.', '.(int)$i++.')';
            }
            $saved &= $this->db->execute('
                REPLACE INTO '._DB_PREFIX_.'a_blog_post_category
                VALUES '.implode(', ', $upd_rows).'
            ');
        }

        return $saved;
    }

    public function getImgSettings()
    {
        $fields = $this->fields->getImgSettingsFields();
        $saved_settings = $this->getSettings('img');
        if (is_array($saved_settings)) {
            foreach ($saved_settings as $name => $value) {
                if (isset($fields[$name])) {
                    $fields[$name]['value'] = $value;
                }
            }
        }
        return $fields;
    }

    public function getImgSrc($resource_type, $id, $size, $img_name)
    {
        $src = '';
        $dir = $resource_type == 'category' ? 'categories' : 'posts';
        $path = $dir.'/'.$id.'/'.$size.'/'.$img_name;
        if (is_file($this->img_dir_local.$path)) {
            $src = $this->img_dir.$path;
        }
        return $src;
    }

    public function getPostListInfos($pagination_settings, $order_by, $order_way, $additional_filters = array())
    {
        if ($order_by == 'position') {
            $order_way = 'ASC';
        }
        if ($pagination_settings['npp'] == 'all') {
            $pagination_settings['npp'] = $pagination_settings['total'];
        }
        $query = new DbQuery();
        $query->select('p.*, pl.*, ps.views, ps.comments, ps.likes, cl.title AS cat_title, e.firstname, e.lastname');
        $query->from('a_blog_post', 'p');
        $query->leftJoin('a_blog_post_lang', 'pl', 'p.id_post = pl.id_post');
        $query->leftJoin('a_blog_post_stats', 'ps', 'p.id_post = ps.id_post');
        $query->leftJoin('a_blog_category_lang', 'cl', 'p.id_category_default = cl.id_category');
        $query->leftJoin('employee', 'e', 'p.author = e.id_employee');
        if (!empty($additional_filters['author']) && (int)$additional_filters['author']) {
            $query->where('p.author = '.(int)$additional_filters['author']);
        }
        if (!empty($additional_filters['active'])) {
            $query->where('p.active = '.(int)$additional_filters['active']);
        }
        if (!empty($additional_filters['post_ids'])) {
            $query->where('p.id_post IN ('.pSQL($additional_filters['post_ids'].')'));
        }
        $query->where('pl.id_lang = '.(int)$this->id_lang);
        if (!empty($this->shop_ids)) {
            $query->where('pl.id_shop IN ('.implode(', ', $this->shop_ids).')');
        } else {
            $query->where('pl.id_shop = '.(int)$this->context->shop->id);
        }
        $this->addDateAndStateAssociation($query, $additional_filters);
        $this->addJoinFiltersAssociation($query, $additional_filters);
        $query->groupBy('pl.id_post');
        $query->orderBy(pSQL($order_by).' '.pSQL($order_way));
        $limit = $pagination_settings['npp'];
        $offset = ($pagination_settings['p'] - 1) * $pagination_settings['npp'];
        $query->limit($limit, $offset);
        $posts = $this->db->executeS($query);
        foreach ($posts as &$p) {
            $p['tags'] = $this->getPostTags($p['id_post'], $this->id_lang, false);
        }
        return $posts;
    }

    public function getCategoryListInfos($settings)
    {
        if ($settings['type'] == 'c_selected') {
            $imploded_ids = $this->formatIDs($settings['cat_ids']);
        } elseif ($settings['type'] == 'c_children') {
            $imploded_parent_ids = $this->formatIDs($settings['parent_ids']);
            if (!$imploded_parent_ids) {
                $imploded_parent_ids = $this->root_id;
            }
        }
        $id_lang = $this->context->language->id;
        $id_shop = $this->context->shop->id;
        $categories = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'a_blog_category c
            INNER JOIN '._DB_PREFIX_.'a_blog_category_lang cl
                ON cl.id_category = c.id_category AND cl.id_lang = '.(int)$id_lang.' AND cl.id_shop = '.(int)$id_shop.'
            WHERE c.active = 1 AND c.id_category <> '.(int)$this->root_id.
            (!empty($imploded_ids) ? ' AND c.id_category IN ('.pSQL($imploded_ids).')' : '').
            (!empty($imploded_parent_ids) ? ' AND c.id_parent IN ('.pSQL($imploded_parent_ids).')' : '').'
        ');
        foreach ($categories as &$c) {
            $c['id'] = $c['id_category'];
            $c['url'] = $this->getCategoryLink($c['id_category'], $c['link_rewrite']);
            // $c['img'] = ...
        }
        return $categories;
    }

    public function getProductListInfos($ids, $settings)
    {
        if (!$imploded_ids = $this->formatIDs(implode(',', $ids))) {
            return array();
        }
        if (!$this->is_17 && Configuration::get('PS_CATALOG_MODE')) {
            $settings['price'] = $settings['add_to_cart'] = 0;
        }
        $id_lang = $this->context->language->id;
        $id_shop = $this->context->shop->id;
        $show_cat = !empty($settings['product_cat']);
        $show_man = !empty($settings['product_man']);
        $products_infos = array();
        $now = date('Y-m-d H:i:s');
        $nb_days_new = Configuration::get('PS_NB_DAYS_NEW_PRODUCT');
        $query_order_by = '';
        if ($settings['product_order_by'] == 'date_add' || $settings['product_order_by'] == 'date_upd') {
            $query_order_by = 'ORDER BY product_shop.'.$settings['product_order_by'].' DESC';
        } elseif ($settings['product_order_by'] == 'random') {
            shuffle($ids);
        }

        $products_data = $this->db->executeS('
            SELECT p.*, product_shop.*, pl.*, image.id_image, il.legend,
            '.($show_cat ? 'cl.name AS cat_name, cl.link_rewrite as cat_link_rewrite, ' : '').'
            '.($show_man ? 'm.name AS man_name, ' : '').'
            DATEDIFF(\''.pSQL($now).'\', p.date_add) < '.(int)$nb_days_new.' AS new
            FROM '._DB_PREFIX_.'product p
            '.Shop::addSqlAssociation('product', 'p').'
            INNER JOIN '._DB_PREFIX_.'product_lang pl
                ON (pl.id_product = p.id_product
                AND pl.id_shop = '.(int)$id_shop.' AND pl.id_lang = '.(int)$id_lang.')
            '.($show_cat ? '
                LEFT JOIN '._DB_PREFIX_.'category_lang cl
                    ON (cl.id_category = product_shop.id_category_default
                    AND cl.id_shop = '.(int)$id_shop.' AND cl.id_lang = '.(int)$id_lang.')
            ' : '').'
            '.($show_man ? '
                LEFT JOIN '._DB_PREFIX_.'manufacturer m
                    ON m.id_manufacturer = p.id_manufacturer AND m.active = 1
            ' : '').'
            LEFT JOIN '._DB_PREFIX_.'image image
                ON (image.id_product = p.id_product AND image.cover = 1)
            LEFT JOIN '._DB_PREFIX_.'image_lang il
                ON (il.id_image = image.id_image AND il.id_lang = '.(int)$id_lang.')
            WHERE p.id_product IN ('.pSQL($imploded_ids).')
            '.($query_order_by ? pSQL($query_order_by) : '').'
        ');

        $second_images = array();
        if (!empty($settings['second_image'])) {
            $second_images_data = $this->db->executeS('
                SELECT i.id_product, i.id_image
                FROM '._DB_PREFIX_.'image i
                '.Shop::addSqlAssociation('image', 'i').'
                WHERE i.id_product IN ('.pSQL($imploded_ids).')
                AND i.cover IS NULL
                GROUP BY i.id_product
            ');
            foreach ($second_images_data as $d) {
                $second_images[$d['id_product']] = $d['id_image'];
            }
        }

        $positions = array_flip($ids);
        foreach ($products_data as $pd) {
            $id = $pd['id_product'];
            $pd = Product::getProductProperties($id_lang, $pd);
            if ($this->is_17) {
                $pd = $this->presentProduct($pd);
                unset($pd['flags']['discount']);
            } else {
                // retro-compatibility
                $pd['url'] = $pd['link'];
                $pd['flags'] = array();
                if (!empty($pd['new'])) {
                    $pd['flags']['new'] = array('type' => 'new', 'label' => $this->l('New'));
                }
                $pd['has_discount'] = !empty($pd['specific_prices']['reduction']);
                $pd['discount_type'] = $pd['specific_prices']['reduction_type'];
                $pd['discount_amount'] = $pd['specific_prices']['reduction'];
                if ($pd['discount_type'] == 'percentage') {
                    $pd['discount_percentage'] = '-'.($pd['discount_amount'] * 100).'%';
                } else {
                    $pd['discount_amount'] = Tools::displayPrice($pd['discount_amount']);
                }
                $pd['regular_price'] = Tools::displayPrice($pd['price_without_reduction']);
                $pd['price'] = Tools::displayPrice($pd['price']);
            }
            if ($pd['has_discount']) {
                $pd['discount_value'] = '-'.ltrim($pd['discount_'.$pd['discount_type']], '-');
            }
            $image_type = $settings['product_img_type'] != 'original' ? $settings['product_img_type'] : null;
            $link_rewrite = $pd['link_rewrite'];
            $pd['img_src'] = $this->context->link->getImageLink($link_rewrite, $pd['id_image'], $image_type);
            if (!empty($second_images[$id])) {
                $src  = $this->context->link->getImageLink($link_rewrite, $second_images[$id], $image_type);
                $pd['second_img_src'] = $src;
            }
            if ($show_man && !empty($pd['id_manufacturer'])) {
                $alias = Tools::str2url($pd['man_name']);
                $pd['man_url'] = $this->getItemUrl('manufacturer', $pd['id_manufacturer'], $alias);
                if ($show_man != 1) {
                    $pd['man_img_src'] = $this->getImageUrl('manufacturer', $pd['id_manufacturer'], $show_man);
                }
            }
            if ($show_cat && !empty($pd['id_category_default'])) {
                $pd['cat_url'] = $this->getItemUrl('category', $pd['id_category_default'], $pd['cat_link_rewrite']);
            }
            $products_infos[$positions[$id]] = $pd;
        }
        if (!$query_order_by) {
            ksort($products_infos);
        }
        return $products_infos;
    }

    public function presentProduct($product_data)
    {
        if (!isset($this->factory_presenter)) {
            $factory = new ProductPresenterFactory($this->context, new TaxConfiguration());
            $this->factory_presenter = $factory->getPresenter();
            $this->factory_settings = $factory->getPresentationSettings();
        }
        return $this->factory_presenter->present($this->factory_settings, $product_data, $this->context->language);
    }

    public function getItemUrl($item_type, $id, $alias = null)
    {
        $url = '#';
        $method = 'get'.Tools::ucfirst($item_type).'Link';
        if (is_callable(array($this->context->link, $method))) {
            $url = $this->context->link->$method($id, $alias);
        }
        return $url;
    }

    public function getImageUrl($resource_type, $id, $image_type)
    {
        if ($image_type == '--') {
            return false;
        }
        $first_char = Tools::substr($resource_type, 0, 1);
        $local_dir = _PS_IMG_DIR_.$first_char.'/';
        $dir = _PS_IMG_.$first_char.'/';
        $img = $id.($image_type != 'original' ? '-'.$image_type : '').'.jpg';
        $default_img = $this->context->language->iso_code.'-default-'.$image_type.'.jpg';
        return file_exists($local_dir.$img) ? $dir.$img : $dir.$default_img;
    }

    public function getAvailableHooks()
    {
        $methods = get_class_methods(__CLASS__);
        $methods_to_exclude = array('hookDisplayBackOfficeHeader', 'hookDisplayHeader',
        'hookDisplayAdminProductsExtra');
        $available_hooks = array();
        foreach ($methods as $m) {
            if (Tools::substr($m, 0, 11) === 'hookDisplay' && !in_array($m, $methods_to_exclude)) {
                $available_hooks[str_replace('hookDisplay', 'display', $m)] = 0;
            }
        }
        // ksort($available_hooks);
        return $available_hooks;
    }

    public function getBlocks()
    {
        $blocks = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'a_blog_block b
            LEFT JOIN '._DB_PREFIX_.'a_blog_block_lang bl ON bl.id_block = b.id_block
            WHERE id_lang = '.(int)$this->id_lang.'
            AND id_shop IN ('.implode(', ', array_map('intval', $this->shop_ids)).')
            GROUP BY b.id_block
        ');
        foreach ($blocks as &$b) {
            $settings = Tools::jsonDecode($b['settings'], true);
            if (!empty($settings['exceptions'])) {
                $b['exc_note'] = $this->getExceptionsNote($settings['exceptions']);
            }
        }
        return $blocks;
    }

    public function getSortedCategories()
    {
        $result = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'a_blog_category c
            LEFT JOIN '._DB_PREFIX_.'a_blog_category_lang cl
            ON c.id_category = cl.id_category
            WHERE id_lang = '.(int)$this->id_lang.'
            AND id_shop IN ('.implode(', ', array_map('intval', $this->shop_ids)).')
            GROUP BY c.id_category
        ');
        $sorted_categories = array();
        foreach ($result as $r) {
            $sorted_categories[$r['id_parent']][] = $r;
        }
        return $sorted_categories;
    }

    public function ajaxToggleParam()
    {
        $resource = Tools::strtolower(Tools::getValue('resource'));
        $param_name = Tools::getValue('param_name');
        $param_value = Tools::getValue('param_value');
        if ($param_name == 'approved_by') {
            $param_value = $this->context->employee->id;
        }
        $table_name = _DB_PREFIX_.'a_blog_'.$resource;
        $id = Tools::getValue('id');
        $identifier = 'id_'.$resource;

        if (!$param_name || !$resource) {
            $this->throwError($this->l('Parameters not provided correctly'));
        }

        $update_query = '
            UPDATE '.bqSQL($table_name).'
            SET '.bqSQL($param_name).' = '.(int)$param_value.'
            WHERE '.bqSQL($identifier).' = '.(int)$id.'
        ';

        $ret = array('success' => $this->db->execute($update_query));
        if ($resource == 'comment') {
            $ret['updated_html'] = utf8_encode($this->renderCommentAdmin($id));
        }
        exit(Tools::jsonEncode($ret));
    }

    public function renderCommentAdmin($id_comment)
    {
        $pagination_settings = $this->getPaginationSettings('comment');
        $comment = $this->getCommentListInfos($pagination_settings, 'date_add', 'DESC', array(), $id_comment);
        $this->context->smarty->assign(array(
            'comment' => $comment,
            'avatars_dir' => $this->img_dir.'avatars/',
            'blog' => $this,
        ));
        return $this->display(__FILE__, 'views/templates/admin/comment-form.tpl');
    }

    public function ajaxCallBlockForm()
    {
        $id_block = Tools::getValue('id');
        $hook_name = Tools::getValue('hook_name');
        $full = Tools::getValue('full');
        $ret = array(
            'form' => utf8_encode($this->callBlockForm($id_block, $hook_name, $full)),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function callBlockForm($id_block, $hook_name, $full)
    {
        $block_data = $this->db->getRow('
            SELECT * FROM '._DB_PREFIX_.'a_blog_block
            WHERE id_block = '.(int)$id_block.'
        ');
        $block_data_lang = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'a_blog_block_lang
            WHERE id_block = '.(int)$id_block.'
            AND id_shop = '.(int)$this->context->shop->id.'
        ');

        $block = array(
            'id_block' => (int)$id_block,
            'active' => 1,
            'hook_name' => $hook_name,
            'editable_fields' => $this->fields->getBlockFields(),
        );
        if ($id_block && $block_data) {
            $translatable_fields = array();
            foreach (array_keys($block) as $name) {
                if (isset($block_data[$name])) {
                    $block[$name] = $block_data[$name];
                }
            }
            $settings = Tools::jsonDecode($block_data['settings'], true);
            foreach ($block['editable_fields'] as $name => &$field) {
                if (!isset($field['multilang'])) {
                    if (Tools::substr($name, 0, 9) === 'carousel_') {
                        $name = str_replace('carousel_', '', $name);
                        $field['value'] = $settings['carousel'][$name];
                    } elseif (Tools::substr($name, 0, 8) === 'related_') {
                        $name = str_replace('related_', '', $name);
                        $field['value'] = $settings['related'][$name];
                    } elseif (Tools::substr($name, 0, 11) === 'exceptions_') {
                        $name = explode('_', $name);
                        if (isset($settings[$name[0]][$name[1]][$name[2]])) {
                            $field['value'] = $settings[$name[0]][$name[1]][$name[2]];
                        }
                    } elseif (isset($settings[$name])) {
                        $field['value'] = $settings[$name];
                    }
                } elseif (isset($field['multilang'])) {
                    $translatable_fields[] = $name;
                }
            }
            foreach ($block_data_lang as $bdl) {
                foreach ($translatable_fields as $field_name) {
                    if (isset($bdl[$field_name])) {
                        $block['editable_fields'][$field_name]['value'][$bdl['id_lang']] = $bdl[$field_name];
                    }
                }
            }
        }
        if (!$id_block) {
            if ($this->isColumnHook($hook_name)) {
                $block['editable_fields']['compact']['value'] = 1;
                $block['editable_fields']['show_tags']['value'] = 0;
            }
            if ($hook_name == 'displayPostFooter') {
                $block['editable_fields']['type']['value'] = 'product_relatedtopost';
                $block['editable_fields']['carousel_i']['value'] = '5';
                $block['editable_fields']['carousel_i_1200']['value'] = '4';
                $block['editable_fields']['carousel_i_992']['value'] = '3';
                $block['editable_fields']['carousel_i_768']['value'] = '2';
                $block['editable_fields']['carousel_i_480']['value'] = '1';
            } elseif ($hook_name == 'displayPostAfterComments') {
                $block['editable_fields']['type']['value'] = 'post_relatedtopost';
            } elseif ($hook_name == 'displayFooterProduct') {
                $block['editable_fields']['type']['value'] = 'post_relatedtoproduct';
            }
        }
        $block['title'] = $block['editable_fields']['title']['value'][$this->id_lang];
        if (!empty($settings['exceptions'])) {
            $block['exc_note'] = $this->getExceptionsNote($settings['exceptions']);
        }

        $this->context->smarty->assign(array(
            'block' => $block,
            'sorted_categories' => $this->getSortedCategories(),
            'root_id' => $this->root_id,
            'languages' => Language::getLanguages(false),
            'id_lang_current' => $this->id_lang,
            'multishop_note' => count(Shop::getContextListShopID()) > 1,
            'full' => $full,
        ));
        return $this->display(__FILE__, 'views/templates/admin/block-form.tpl');
    }

    public function getExceptionsNote($exceptions)
    {
        $exc_note = '';
        $exceptions_txt = array();
        if (!empty($exceptions['page']['type'])) {
            $exceptions_txt[] = $this->l('on selected pages');
        }
        if (!empty($exceptions['customer']['type'])) {
            $exceptions_txt[] = $this->l('for selected customers');
        }
        if ($exceptions_txt) {
            $exc_note = sprintf($this->l('Displayed %s'), implode('/', $exceptions_txt));
        }
        return $exc_note;
    }

    public function getSettingsFields($type, $fill_values = false)
    {
        if (empty($this->fields)) {
            include_once('classes/BlogFields.php');
            $this->fields = new BlogFields();
        }
        $method = 'get'.Tools::ucfirst($type).'SettingsFields';
        if (method_exists($this->fields, $method)) {
            $fields = $this->fields->$method();
            if ($fill_values) {
                foreach ($this->getSettings($type) as $name => $value) {
                    if (!empty($fields[$name])) {
                        $fields[$name]['value'] = $value;
                    }
                }
            }
        } else {
            $fields = false;
        }
        return $fields;
    }

    public function ajaxCallSettingsForm()
    {
        $type = Tools::strtolower(Tools::getValue('type'));
        if ($fields = $this->getSettingsFields($type, true)) {
            $this->context->smarty->assign(array(
                'type' => $type,
                'settings' => $fields,
            ));
            $form_html = $this->display(__FILE__, 'views/templates/admin/settings-form.tpl');
        } else {
            $form_html = $this->displayError($this->l('No settings available for this resource'));
        }
        $ret = array(
            'form_html' => utf8_encode($form_html),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function ajaxSaveSettings()
    {
        $type = Tools::getValue('type');
        $data = $this->unserialize(Tools::getValue('data'));
        $ret = array(
            'saved' => $this->saveSettings($type, $data),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function ajaxCallHookSettingsForm()
    {
        $hook_name = Tools::getValue('hook_name');
        $settings_type = Tools::getValue('settings_type');
        $method = 'getHook'.Tools::ucfirst($settings_type).'Settings';
        if (!is_callable(array($this, $method))) {
            $this->throwError($this->l('This type of settings is not supported'));
        }
        $this->context->smarty->assign(array(
            'settings' => $this->$method($hook_name),
            'settings_type' => $settings_type,
            'hook_name' => $hook_name,
        ));
        $form_html = $this->display($this->local_path, 'views/templates/admin/hook-'.$settings_type.'-form.tpl');
        $ret = array(
            'form_html' => utf8_encode($form_html),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function getHookExceptionsSettings($hook_name)
    {
        $exc_data = $this->db->executeS('
            SELECT exc_type, exc_controllers
            FROM '._DB_PREFIX_.'a_blog_hook_settings
            WHERE hook_name = \''.pSQL($hook_name).'\'
            AND id_shop IN ('.pSQL(implode(', ', $this->shop_ids)).')
        ');

        $type = 0;
        $current_exceptions = array();
        foreach ($exc_data as $row) {
            if (!$type || $row['id_shop'] == $this->context->controller->id_shop) {
                $type = $row['exc_type'];
            }
            $current_exceptions += explode(',', $row['exc_controllers']);
        }
        $current_exceptions = array_flip($current_exceptions);

        $sorted_exceptions = array(
            'core' => array(
                'group_name' => $this->l('Core pages'),
                'values' => array(),
            ),
            'modules' => array(
                'group_name' => $this->l('Module pages'),
                'values' => array(),
            ),
        );

        $front_controllers = $this->getFrontControllers();
        foreach ($front_controllers as $fc) {
            $sorted_exceptions['core']['values'][$fc] = (int)isset($current_exceptions[$fc]);
        }

        $module_front_controllers = Dispatcher::getModuleControllers('front');
        foreach ($module_front_controllers as $module_name => $controllers) {
            foreach ($controllers as $controller_name) {
                $key = 'module-'.$module_name.'-'.$controller_name;
                $sorted_exceptions['modules']['values'][$key] = (int)isset($current_exceptions[$key]);
            }
        }
        $settings = array(
            'type' => $type,
            'exceptions' => $sorted_exceptions,
        );
        return $settings;
    }

    public function getFrontControllers()
    {
        $controllers = array_keys(Dispatcher::getControllers(_PS_FRONT_CONTROLLER_DIR_));
        // retro compatibility
        $controllers = array_combine($controllers, $controllers);
        $controllers['auth'] = 'authentication';
        $controllers['compare'] = 'productscomparison';
        return $controllers;
    }

    public function getHookPositionsSettings($hook_name)
    {
        $hook_modules = Hook::getModulesFromHook(Hook::getIdByName($hook_name));
        $sorted = array();
        foreach ($hook_modules as $m) {
            if ($instance = Module::getInstanceByName($m['name'])) {
                $logo_src = false;
                if (file_exists(_PS_MODULE_DIR_.$instance->name.'/logo.png')) {
                    $logo_src = _MODULE_DIR_.$instance->name.'/logo.png';
                }
                $sorted[$m['id_module']] = array(
                    'name' => $instance->name,
                    'position' => $m['m.position'],
                    'enabled' => $instance->isEnabledForShopContext(),
                    'display_name' => $instance->displayName,
                    'description' => $instance->description,
                    'logo_src' => $logo_src,
                );
                if ($m['id_module'] == $this->id) {
                    $sorted[$m['id_module']]['current'] = 1;
                }
            }
        }
        return $sorted;
    }

    public function ajaxSaveHookSettings()
    {
        $hook_name = Tools::getValue('hook_name');
        $id_hook = Hook::getIdByName($hook_name);
        $settings_type = Tools::getValue('settings_type');
        $saved = false;
        if ($settings_type == 'exceptions') {
            $exc_type = Tools::getValue('exceptions_type');
            if ($exc_controllers = implode(',', Tools::getValue('exceptions'))) {
                $rows = array();
                foreach ($this->shop_ids as $id_shop) {
                    $row = '\''.pSQL($hook_name).'\', '.(int)$id_shop.', '.
                    (int)$exc_type.', \''.pSQL($exc_controllers).'\'';
                    $rows[] = '('.$row.')';
                }
                $saved = $this->db->execute('
                    INSERT INTO '._DB_PREFIX_.'a_blog_hook_settings
                    (hook_name, id_shop, exc_type, exc_controllers)
                    VALUES '.implode(', ', $rows).'
                    ON DUPLICATE KEY UPDATE
                    exc_type = VALUES(exc_type),
                    exc_controllers = VALUES(exc_controllers)
                ');
            } else {
                $imploded_shop_ids = implode(', ', $this->shop_ids);
                $saved = $this->db->execute('
                    DELETE FROM '._DB_PREFIX_.'a_blog_hook_settings
                    WHERE hook_name = \''.pSQL($hook_name).'\'
                    AND id_shop IN ('.pSQL($imploded_shop_ids).')
                ');
            }
             // make sure native exceptions are not used
            $saved = $this->unregisterExceptions($id_hook, $this->shop_ids);
        } elseif ($settings_type == 'position') {
            $id_module = Tools::getValue('id_module');
            $new_position = Tools::getValue('new_position');
            $way = Tools::getValue('way');
            if ($module = Module::getInstanceById($id_module)) {
                $saved = $module->updatePosition($id_hook, $way, $new_position);
            }
        }
        $ret = array(
            'saved' => $saved
        );
        exit(Tools::jsonEncode($ret));
    }

    public function ajaxProcessModule()
    {
        $id_module = Tools::getValue('id_module');
        $hook_name = Tools::getValue('hook_name');
        $act = Tools::getValue('act');
        $module = Module::getInstanceById($id_module);
        $saved = false;
        if (Validate::isLoadedObject($module)) {
            switch ($act) {
                case 'disable':
                    $module->disable();
                    $saved = !$module->isEnabledForShopContext();
                    break;
                case 'unhook':
                    $saved = $module->unregisterHook(Hook::getIdByName($hook_name));
                    break;
                case 'uninstall':
                    if ($id_module != $this->id) {
                        $saved = $module->uninstall();
                    }
                    break;
                case 'enable':
                    $saved = $module->enable();
                    break;
            }
        }
        $ret = array ('saved' => $saved);
        exit(Tools::jsonEncode($ret));
    }

    public function ajaxSave()
    {
        $resource = Tools::getValue('resource');
        $data = $this->unserialize(Tools::getValue('data'));
        $save_method = 'save'.$resource;
        $this->verifyMethod($save_method);

        $call_method = 'call'.$resource.'Form';
        $this->verifyMethod($call_method);
        $id = $this->$save_method($data);
        if ($resource == 'Category') {
            $this->context->smarty->assign(array(
                'sorted_categories' => $this->getSortedCategories(),
                'root_id' => $this->root_id,
                'type' => 'full',
            ));
            $tree = $this->display(__FILE__, 'views/templates/admin/category-tree.tpl');
            $ret = array(
                'tree' => utf8_encode($tree),
            );
        } else {
            $ret = array(
                'form' => utf8_encode($this->$call_method($id, Tools::getValue('full'))),
                'id' => $id,
            );
        }
        $ret['total'] = $this->getTotal(Tools::strtolower($resource));

        exit(Tools::jsonEncode($ret));
    }

    public function formatIDs($ids_string, $return_string = true)
    {
        $ids = array_map('intval', explode(',', $ids_string));
        $ids = array_combine($ids, $ids);
        unset($ids[0]);
        return $return_string ? implode(',', $ids) : $ids;
    }

    public function saveBlock($block_data)
    {
        $id_block = $block_data['id_block'];
        $active = $block_data['active'];
        $hook_name = $block_data['hook_name'];
        $id_lang_default = Configuration::get('PS_LANG_DEFAULT');

        $settings = $block_data['settings'];
        // verify fields
        $settings['post_ids'] = $this->formatIDs($settings['post_ids']);
        $settings['cat_ids'] = $this->formatIDs($settings['cat_ids']);
        $settings['parent_ids'] = $this->formatIDs($settings['parent_ids']);
        foreach ($settings['exceptions'] as $key => &$exc) {
            if ($exc['type'] && Tools::substr($exc['type'], -4) != '_all') {
                $exc['ids'] = $this->formatIDs($exc['ids']);
                if (!$exc['ids']) {
                    $exc['type'] = ($key == 'page') ? $exc['type'].'_all' : '0';
                }
            } else {
                $exc['ids'] = '';
            }
        }

        $data_multilang = $block_data['multilang'];
        $editable_fields = $this->fields->getBlockFields();
        foreach ($data_multilang as $name => $data) {
            if (!empty($editable_fields[$name]['required']) && empty($data[$id_lang_default])) {
                $lang_iso = Language::getIsoById($id_lang_default);
                $display_name = $editable_fields[$name]['display_name'];
                $txt = sprintf($this->l('Please specify %1$s (%2$s)'), $display_name, $lang_iso);
                $this->throwError($txt);
            }
        }

        $settings = Tools::jsonEncode($settings);
        $saved = $this->db->execute('
            INSERT INTO '._DB_PREFIX_.'a_blog_block VALUES
            ('.(int)$id_block.', \''.pSQL($hook_name).'\', 0, '.(int)$active.', \''.pSQL($settings).'\')
            ON DUPLICATE KEY UPDATE
            hook_name = VALUES(hook_name),
            settings = VALUES(settings)
        ');
        if (!$id_block) {
            $id_block = $this->db->Insert_ID();
        }

        $lang_rows = array();
        foreach ($this->shop_ids as $id_shop) {
            foreach ($data_multilang as $name) {
                foreach ($name as $id_lang => $value) {
                    if (!$value && !empty($name[$id_lang_default])) {
                        $value = $name[$id_lang_default];
                    }
                    $lang_rows[] = '('.(int)$id_block.', '.(int)$id_shop.', '.(int)$id_lang.', \''.pSQL($value).'\')';
                }
            }
        }
        if ($lang_rows) {
            $saved &= $this->db->execute('
                REPLACE INTO '._DB_PREFIX_.'a_blog_block_lang
                VALUES '.implode(', ', $lang_rows).'
            ');
        }
        if ($saved) {
            foreach ($this->shop_ids as $id_shop) {
                if (!$this->isRegisteredInHookConsideringShop($hook_name, $id_shop)) {
                    $saved &= $this->registerHook($hook_name, array($id_shop));
                }
            }
        }
        return $saved ? (int)$id_block : false;
    }

    public function ajaxCallCategoryForm()
    {
        $id_category = Tools::getValue('id_category');
        $id_parent = Tools::getValue('id_parent');
        $ret = array(
            'category_form' => utf8_encode($this->callCategoryForm($id_category, $id_parent)),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function callCategoryForm($id_category, $id_parent = false)
    {
        $category_data = $this->db->getRow('
            SELECT * FROM '._DB_PREFIX_.'a_blog_category
            WHERE id_category = '.(int)$id_category.'
        ');

        $category_data_lang = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'a_blog_category_lang
            WHERE id_category = '.(int)$id_category.'
            AND id_shop = '.(int)$this->context->shop->id.'
        ');

        $category = array(
            'id_category' => (int)$id_category,
            'position' => 0,
            'active' => 1,
            'editable_fields' => $this->fields->getCategoryFields($id_parent),
        );

        if ($id_category && $category_data) {
            $translatable_fields = array();
            foreach (array_keys($category) as $name) {
                if (isset($category_data[$name])) {
                    $category[$name] = $category_data[$name];
                }
            }
            foreach ($category['editable_fields'] as $name => &$field) {
                if (!isset($field['multilang']) && isset($category_data[$name])) {
                    $field['value'] = $category_data[$name];
                } elseif (isset($field['multilang'])) {
                    $translatable_fields[] = $name;
                }
            }

            foreach ($category_data_lang as $cdl) {
                foreach ($translatable_fields as $field_name) {
                    if (isset($cdl[$field_name])) {
                        $category['editable_fields'][$field_name]['value'][$cdl['id_lang']] = $cdl[$field_name];
                    }
                }
            }
        }
        $category['title'] = $category['editable_fields']['title']['value'][$this->id_lang];

        $this->context->smarty->assign(array(
            'category' => $category,
            'sorted_categories' => $this->getSortedCategories(),
            'root_id' => $this->root_id,
            'languages' => Language::getLanguages(false),
            'id_lang_current' => $this->id_lang,
            'multishop_note' => count(Shop::getContextListShopID()) > 1,
        ));
        return $this->display(__FILE__, 'views/templates/admin/category-form.tpl');
    }

    public function saveCategory($category_data)
    {
        $id_category = $category_data['id_category'];
        $id_parent = $category_data['id_parent'];
        $active = $category_data['active'];
        $level_depth = 0;
        if ($id_parent) {
            $level_depth = $this->db->getValue('
                SELECT level_depth FROM '._DB_PREFIX_.'a_blog_category WHERE id_category = '.(int)$id_parent.'
            ');
            $level_depth = (int)$level_depth + 1;
        }
        $position = 0;
        $date = date('Y-m-d H:i:s');

        $data_multilang = $category_data['multilang'];
        $multilang_fields = $this->fields->getCategoryFields(false, true);
        $lang_rows = $this->prepareMultilangRows('category', $data_multilang, $multilang_fields, $id_category);

        $saved = $this->db->execute('
                INSERT INTO '._DB_PREFIX_.'a_blog_category VALUES (
                '.(int)$id_category.',
                '.(int)$id_parent.',
                '.(int)$active.',
                '.(int)$level_depth.',
                '.(int)$position.',
                \''.pSQL($date).'\',
                \''.pSQL($date).'\')
                ON DUPLICATE KEY UPDATE
                id_parent = VALUES(id_parent),
                level_depth = VALUES(level_depth),
                date_upd = VALUES(date_upd),
                active = VALUES(active)
            ');
        if (!$id_category) {
            $id_category = $this->db->Insert_ID();
            foreach ($lang_rows as &$row) {
                $row = '('.(int)$id_category.', '.ltrim($row, '(0, ');
            }
        }

        if ($saved && $id_category) {
            $lang_columns = 'id_category, id_shop, id_lang, '.implode(', ', array_keys($data_multilang));
            $saved &= $this->db->execute('
                REPLACE INTO '._DB_PREFIX_.'a_blog_category_lang ('.pSQL($lang_columns).')
                VALUES '.implode(', ', $lang_rows).'
            ');
        }

        return $saved ? (int)$id_category : false;
    }

    public function deleteCategory($id_category)
    {
        if ($id_category == 1) {
            return false;
        }
        $deleted = $this->db->execute('
            DELETE FROM '._DB_PREFIX_.'a_blog_category_lang
            WHERE id_category = '.(int)$id_category.'
            AND id_shop IN ('.implode(', ', array_map('intval', $this->shop_ids)).')
        ');

        $exists = $this->db->getValue(
            'SELECT * FROM '._DB_PREFIX_.'a_blog_category_lang WHERE id_category = '.(int)$id_category
        );
        if (!$exists) {
            foreach (array('a_blog_category', 'a_blog_post_category') as $table) {
                $deleted &= $this->db->execute('
                    DELETE FROM `'._DB_PREFIX_.bqSQL($table).'` WHERE id_category = '.(int)$id_category.'
                ');
            }
        }

        // update default category if it was assigned to some posts
        $posts_to_update = $this->db->executeS('
            SELECT id_post FROM '._DB_PREFIX_.'a_blog_post WHERE id_category_default = '.(int)$id_category.'
        ');
        $position = (int)$this->db->getValue('
            SELECT MAX(position) FROM '._DB_PREFIX_.'a_blog_post_category WHERE id_category = '.(int)$this->root_id.'
        ');
        $post_ids = $cat_rows = array();
        foreach ($posts_to_update as $post) {
            $post_ids[] = (int)$post['id_post'];
            if (!$this->isPostPositioned($post['id_post'], $this->root_id)) {
                $position++;
                $cat_rows[] = '('.(int)$this->root_id.', '.(int)$post['id_post'].', '.(int)$position.')';
            }
        }
        if ($post_ids) {
            $this->db->execute('
                UPDATE '._DB_PREFIX_.'a_blog_post SET id_category_default = '.(int)$this->root_id.'
                WHERE id_post IN ('.implode(', ', $post_ids).')
            ');
        }
        if ($cat_rows) {
            $this->db->execute('
                REPLACE INTO '._DB_PREFIX_.'a_blog_post_category
                VALUES '.implode(', ', $cat_rows).'
            ');
        }
        // end updating default category

        $children = $this->db->executeS('
            SELECT id_category FROM '._DB_PREFIX_.'a_blog_category WHERE id_parent = '.(int)$id_category.'
        ');
        foreach ($children as $child) {
            $this->deleteCategory($child['id_category']);
        }

        return $deleted;
    }

    public function addNewPost()
    {
        $post_data = array(
            'id_post' => 0,
            'active' => 0,
            'author' => $this->context->employee->id,
            'id_category_default' => $this->root_id,
            'cat_ids' => array($this->root_id),
            'publish_from' => '',
            'publish_to' => '',
        );
        $title = $this->l('New post');
        $link_rewrite = Tools::str2url($title);
        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            $id_lang = $lang['id_lang'];
            $post_data['multilang']['title'][$id_lang] = $title;
            $post_data['multilang']['meta_title'][$id_lang] = $title;
            $post_data['multilang']['link_rewrite'][$id_lang] = $link_rewrite;
        }
        return $this->savePost($post_data);
    }

    public function ajaxCallPostForm()
    {
        $id_post = Tools::getValue('id');
        $id_post = $id_post ? $id_post : $this->addNewPost();
        $ret = array(
            'form' => utf8_encode($this->callPostForm($id_post)),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function getPostTags($id_post, $id_lang = false, $implode = true)
    {
        $tags = array();
        $raw_data = $this->db->executeS('
            SELECT t.* FROM '._DB_PREFIX_.'a_blog_tag t
            INNER JOIN '._DB_PREFIX_.'a_blog_post_tag pt
                ON pt.id_tag = t.id_tag AND pt.id_post = '.(int)$id_post.'
                '.($id_lang ? ' WHERE t.id_lang = '.(int)$id_lang : '').'
        ');
        foreach ($raw_data as $d) {
            $tags[$d['id_lang']][$d['tag_url']] = $d['tag_name'];
        }
        foreach ($tags as &$t) {
            ksort($t);
            $t = !$implode ? $t : implode(',', $t);
        }
        if ($id_lang) {
            $tags = isset($tags[$id_lang]) ? $tags[$id_lang] : array();
        }
        return $tags;
    }

    public function callPostForm($id_post, $full = true)
    {
        $query = new DbQuery();
        $query->select('p.*, ps.views, ps.comments, ps.likes, cl.title AS cat_title, e.firstname, e.lastname');
        $query->from('a_blog_post', 'p');
        $query->leftJoin('a_blog_post_stats', 'ps', 'p.id_post = ps.id_post');
        $query->leftJoin('employee', 'e', 'p.author = e.id_employee');
        $c_join = 'p.id_category_default = cl.id_category AND cl.id_lang = '.(int)$this->id_lang.'
        AND cl.id_shop = '.(int)$this->context->shop->id;
        $query->leftJoin('a_blog_category_lang', 'cl', $c_join);
        $query->where('p.id_post = '.(int)$id_post);
        $this->addDateAndStateAssociation($query);
        $post_data = $this->db->getRow($query);

        $post_data_multilang = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'a_blog_post_lang
            WHERE id_post = '.(int)$id_post.'
            AND id_shop IN ('.implode(', ', array_map('intval', $this->shop_ids)).')
        ');
        $categories_db = $this->db->executeS('
            SELECT pc.*, cl.title FROM '._DB_PREFIX_.'a_blog_post_category pc
            LEFT JOIN '._DB_PREFIX_.'a_blog_category_lang cl ON cl.id_category = pc.id_category
            WHERE id_post = '.(int)$id_post.'
            AND id_lang = '.(int)$this->id_lang.'
        ');
        $categories = array();
        foreach ($categories_db as $cat) {
            $categories[$cat['id_category']] = $cat['title'];
        }

        if (!$categories) {
            $categories[$this->root_id] = $this->db->getValue('
                SELECT title FROM '._DB_PREFIX_.'a_blog_category_lang
                WHERE id_lang = '.(int)$this->id_lang.'
                AND id_category = '.(int)$this->root_id.'
            ');
        }

        $post = array(
            'id_post' => 0,
            'id_category_default' => $this->root_id,
            'active' => 1,
            'author' => $this->context->employee->id,
            'editable_fields' => $this->fields->getPostFields(false),
            'views' => 0,
            'comments' => 0,
            'date_add' => '',
            'date_upd' => '',
            'days_before_publish' => 0,
            'days_expired' => 0,
            'publish_from' => $this->empty_date,
            'publish_to' => $this->empty_date,
            'cover' => '',
            'main_img' => '',
            // additional data
            'cat_title' => '',
            'firstname' => '',
            'lastname' => '',
        );
        $post['editable_fields']['categories']['value'] = $categories;

        if ($id_post && $post_data) {
            $translatable_fields = array();
            foreach (array_keys($post) as $name) {
                if (isset($post_data[$name])) {
                    $post[$name] = $post_data[$name];
                }
            }

            $related_ids = $this->getRelatedIDs('post', $id_post);
            $related_items = $related_ids ? $this->getBasicInfos('product', $related_ids) : array();
            $post['editable_fields']['related_products']['value'] = $related_ids;
            $post['editable_fields']['related_products']['related_items'] = $related_items;

            foreach ($post['editable_fields'] as $name => &$field) {
                if (!isset($field['multilang']) && isset($post_data[$name])) {
                    $field['value'] = $post_data[$name];
                } elseif (isset($field['multilang'])) {
                    $translatable_fields[] = $name;
                }
            }

            foreach ($post_data_multilang as $pdm) {
                // date_upd is stored in multilang table because it is connected to id_shop
                if (!$post['date_upd'] || $pdm['id_lang'] == $this->context->language->id) {
                    $post['date_upd'] = $post['editable_fields']['date_upd']['value'] = $pdm['date_upd'];
                }
                foreach ($translatable_fields as $field_name) {
                    if (isset($pdm[$field_name])) {
                        $post['editable_fields'][$field_name]['value'][$pdm['id_lang']] = $pdm[$field_name];
                    }
                }
            }
            $post['editable_fields']['tags']['value'] = $this->getPostTags($id_post);
            $post['editable_fields']['images']['value'] = $this->getPostImages($id_post, true);
        }

        $post['title'] = $post['editable_fields']['title']['value'][$this->id_lang];
        $publish_from = $post['publish_from'] != $this->empty_date ? $post['publish_from'] : $post['date_add'];
        $post['editable_fields']['publish_from']['value'] = $publish_from;
        $publish_to = $post['publish_to'] != $this->empty_date ? $post['publish_to'] : '';
        $post['editable_fields']['publish_to']['value'] = $publish_to;

        $this->context->smarty->assign(array(
            'post' => $post,
            'post_tabs' => $this->fields->getPostTabs(),
            'current_tab' => 'content',
            'sorted_categories' => $this->getSortedCategories(),
            'root_id' => $this->root_id,
            'languages' => Language::getLanguages(false),
            'id_lang_current' => $this->id_lang,
            'image_types' => $this->img_settings,
            'multishop_note' => count($this->shop_ids) > 1,
            'full' => $full,
            'blog' => $this,
        ));
        return $this->display(__FILE__, 'views/templates/admin/post-form.tpl');
    }

    public function saveTag($tag_name, $id_lang)
    {
        $tag_url = Tools::str2url($tag_name);
        $row = '(\'\', '.(int)$id_lang.', \''.pSQL($tag_url).'\', \''.pSQL($tag_name).'\')';
        $this->db->execute('INSERT INTO '._DB_PREFIX_.'a_blog_tag VALUES '.$row);
        return $this->db->Insert_ID();
    }

    public function savePostTags($id_post, $tags_multilang)
    {
        $tag_rows = $all_tags = array();
        $raw_tags_data = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'a_blog_tag
        ');
        foreach ($raw_tags_data as $rtd) {
            $all_tags[$rtd['id_lang']][$rtd['tag_name']] = $rtd['id_tag'];
        }
        foreach ($tags_multilang as $id_lang => $tags) {
            $tags = explode(',', $tags);
            foreach ($tags as $tag) {
                if (!$tag || !Validate::isGenericName($tag)) {
                    continue;
                }
                $id_tag = isset($all_tags[$id_lang][$tag]) ? $all_tags[$id_lang][$tag] : $this->saveTag($tag, $id_lang);
                $tag_rows[] = '('.(int)$id_post.', '.(int)$id_tag.')';
            }
        }
        $saved = $this->db->execute('DELETE FROM '._DB_PREFIX_.'a_blog_post_tag WHERE id_post = '.(int)$id_post);
        if ($tag_rows) {
            $saved &= $this->db->execute('
                INSERT INTO '._DB_PREFIX_.'a_blog_post_tag VALUES '.implode(', ', $tag_rows).'
                ON DUPLICATE KEY UPDATE id_tag = VALUES(id_tag)
            ');
        }
        $this->clearUnusedTags();
        return $saved;
    }

    public function clearUnusedTags()
    {
        $current_tags = $this->db->executeS('
            SELECT t.id_tag, pt.id_post FROM '._DB_PREFIX_.'a_blog_tag t
            LEFT JOIN '._DB_PREFIX_.'a_blog_post_tag pt ON pt.id_tag = t.id_tag
        ');
        foreach ($current_tags as $t) {
            if (!$t['id_post']) {
                $this->db->execute('DELETE FROM '._DB_PREFIX_.'a_blog_tag WHERE id_tag = '.(int)$t['id_tag']);
            }
        }
    }

    public function getRelatedColumns($resource_type)
    {
        if ($resource_type == 'post') {
            $columns = array('id_post', 'id_product', 'position_product');
        } else {
            $columns = array('id_product', 'id_post', 'position_post');
        }
        return $columns;
    }

    public function saveRelatedIDs($resource_type, $resource_id, $related_ids_imploded)
    {
        $saved = true;
        if (!$resource_id) {
            return $saved;
        }
        $related_ids_imploded = $this->formatIDs($related_ids_imploded);
        $related_ids = explode(',', $related_ids_imploded);
        $columns = $this->getRelatedColumns($resource_type);
        $saved &= $this->db->execute('
            DELETE FROM '._DB_PREFIX_.'a_blog_related_products
            WHERE '.pSQL($columns[0]).' = '.(int)$resource_id.'
            '.($related_ids_imploded ? ' AND '.pSQL($columns[1]).' NOT IN ('.pSQL($related_ids_imploded).')' : '').'
        ');
        $rows = array();
        foreach ($related_ids as $position => $id) {
            if ($resource_id && $id) {
                $rows [] = '('.(int)$resource_id.', '.(int)$id.', '.(int)$position.')';
            }
        }
        if ($rows) {
            $saved &= $this->db->execute('
                INSERT INTO '._DB_PREFIX_.'a_blog_related_products
                ('.pSQL(implode(', ', $columns)).')
                VALUES '.implode(', ', $rows).'
                ON DUPLICATE KEY UPDATE
                id_post = VALUES(id_post),
                id_product = VALUES(id_product),
                '.pSQL($columns[2]).' = VALUES('.pSQL($columns[2]).')
            ');
        }
        return $saved;
    }

    public function getRelatedIDs($resource_type, $resource_id, $implode = true)
    {
        $columns = $this->getRelatedColumns($resource_type);
        $ids = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'a_blog_related_products
            WHERE id_post > 0 AND id_product > 0 AND '.pSQL($columns[0]).' = '.(int)$resource_id.'
            ORDER BY '.pSQL($columns[2]).' ASC
        ');
        foreach ($ids as &$id) {
            $id = $id[$columns[1]];
        }
        return $implode ? implode(',', $ids) : $ids;
    }

    public function ajaxGetAutocompleteMatches()
    {
        $type = Tools::getValue('type');
        $query = Tools::getValue('q');
        $excluded_ids = Tools::getValue('excluded_ids');
        $limit = Tools::getValue('limit');
        $included_ids = '';
        if ((int)$query) {
            $included_ids = (int)$query;
            $query = '';
            $limit = 1;
        } elseif (Tools::strlen($query) < 3) {
            return '';
        }
        $matches = $this->getBasicInfos($type, $included_ids, $query, $excluded_ids, $limit);
        foreach ($matches as &$m) {
            $m = $m['id'].' - '.$m['name'];
        }
        $result = implode("\n", $matches);
        exit($result);
    }

    public function getBasicInfos($type, $included_ids = '', $q = '', $excluded_ids = '', $limit = '')
    {
        $db_vars = $type == 'post' ? array('a_blog_post_lang', 'id_post', 'title') :
        array('product_lang', 'id_product', 'name');
        $id_lang = $this->context->language->id;
        $imploded_shop_ids = implode(',', Shop::getContextListShopID());
        $included_ids = $this->formatIDs($included_ids);
        $excluded_ids = $this->formatIDs($excluded_ids);
        $items = $this->db->executeS('
            SELECT DISTINCT('.pSQL($db_vars[1]).') AS id, '.pSQL($db_vars[2]).' AS name
            FROM '._DB_PREFIX_.pSQL($db_vars[0]).'
            WHERE id_lang = '.(int)$id_lang.' AND id_shop IN ('.pSQL($imploded_shop_ids).')
            '.($q ? ' AND '.pSQL($db_vars[2]).' LIKE \'%'.pSQL($q).'%\'' : '').'
            '.($included_ids ? ' AND '.pSQL($db_vars[1]).' IN ('.pSQL($included_ids).')' : '').'
            '.($excluded_ids ? ' AND '.pSQL($db_vars[1]).' NOT IN ('.pSQL($excluded_ids).')' : '').'
            '.($included_ids ? ' ORDER BY FIELD('.pSQL($db_vars[1]).', '.pSQL($included_ids).')' : '').'
            '.((int)$limit ? ' LIMIT '.(int)$limit : '').'
        ');
        return $items;
    }

    public function savePost($post_data)
    {
        $id_post = $post_data['id_post'];
        $id_category_default = $post_data['id_category_default'];
        $active = $post_data['active'];
        $cover = $main_img = '';
        $author = $post_data['author'];
        $date = date('Y-m-d H:i:s');
        if (!$post_data['publish_from']) {
            $post_data['publish_from'] = $date;
        }
        $publish_dates = array('from' => $post_data['publish_from'], 'to' => $post_data['publish_to']);
        foreach ($publish_dates as $k => $v) {
            if ($v && !Validate::isDate($v)) {
                $this->throwError($this->l('Wrong date format').': publish_'.$k);
            }
        }

        $cat_ids = $post_data['cat_ids'];
        if (!$cat_ids) {
            $this->throwError($this->l('Please, select at least one category'));
        }

        $data_multilang = $post_data['multilang'];
        $multilang_fields = $this->fields->getPostFields(true);
        $lang_rows = $this->prepareMultilangRows('post', $data_multilang, $multilang_fields, $id_post);

        $saved = $this->db->execute('
                INSERT INTO '._DB_PREFIX_.'a_blog_post VALUES (
                '.(int)$id_post.',
                '.(int)$id_category_default.',
                '.(int)$active.',
                \''.pSQL($cover).'\',
                \''.pSQL($main_img).'\',
                '.(int)$author.',
                \''.pSQL($date).'\',
                \''.pSQL($publish_dates['from']).'\',
                \''.pSQL($publish_dates['to']).'\')
                ON DUPLICATE KEY UPDATE
                id_category_default = VALUES(id_category_default),
                author = VALUES(author),
                active = VALUES(active),
                publish_from = VALUES(publish_from),
                publish_to = VALUES(publish_to)
            ');
        if (!$id_post) {
            $id_post = $this->db->Insert_ID();
            foreach ($lang_rows as &$row) {
                $row = '('.(int)$id_post.', '.ltrim($row, '(0, ');
            }
        }

        if ($saved && $id_post) {
            // prepare cat_rows
            $current_positions = $cat_rows = array();
            $current_rows = $this->db->executeS('
                SELECT * FROM '._DB_PREFIX_.'a_blog_post_category
                WHERE id_post = '.(int)$id_post.'
            ');
            foreach ($current_rows as $r) {
                $current_positions[$r['id_category']] = $r['position'];
            }
            foreach ($cat_ids as $id_cat) {
                $position = isset($current_positions[$id_cat]) ? $current_positions[$id_cat]: 0;
                $cat_rows[] = '('.(int)$id_cat.', '.(int)$id_post.', '.(int)$position.')';
            }

            $saved &= $this->db->execute('
                DELETE FROM '._DB_PREFIX_.'a_blog_post_category
                WHERE id_post = '.(int)$id_post.'
            ');
            $saved &= $this->db->execute('
                REPLACE INTO '._DB_PREFIX_.'a_blog_post_category
                VALUES '.implode(', ', $cat_rows).'
            ');

            $lang_columns = 'id_post, id_shop, id_lang, '.implode(', ', array_keys($data_multilang)).', date_upd';
            foreach ($lang_rows as &$row) {
                $row = rtrim($row, ')').', \''.pSQL($date).'\')';
            }
            $saved &= $this->db->execute('
                REPLACE INTO '._DB_PREFIX_.'a_blog_post_lang ('.pSQL($lang_columns).')
                VALUES '.implode(', ', $lang_rows).'
            ');
            if ($saved && !$post_data['id_post']) {
                $saved &= $this->db->execute('
                    INSERT INTO '._DB_PREFIX_.'a_blog_post_stats (id_post) VALUES ('.(int)$id_post.')
                    ');
            }
            foreach ($cat_ids as $id_cat) {
                if (!$this->isPostPositioned($id_post, $id_cat)) {
                    $saved &= $this->updatePostPositions($id_post, $id_cat, 1);
                }
            }

            $saved &= $this->savePostTags($id_post, $post_data['multilang']['tags']);
            $saved &= $this->saveRelatedIDs('post', $id_post, $post_data['related_products']);
        }
        return $saved ? (int)$id_post : false;
    }

    public function prepareMultilangRows($resource_type, &$data_lang, $multilang_fields, $id)
    {
        $languages_to_submit = array_keys(current($data_lang));
        $id_lang_default = Configuration::get('PS_LANG_DEFAULT');
        $lang_rows = $data_lang_sorted = array();
        foreach ($this->shop_ids as $id_shop) {
            foreach ($languages_to_submit as $id_lang) {
                $lang_row = (int)$id.', '.(int)$id_shop.', '.(int)$id_lang;
                foreach ($multilang_fields as $name => $f) {
                    // set missing data_multilang in order to insert all columns properly
                    $data_lang_sorted[$name] = isset($data_lang[$name]) ? $data_lang[$name] : $f['value'];
                    $id_lang_source = !empty($data_lang_sorted[$name][$id_lang]) ? $id_lang : $id_lang_default;
                    $value = $data_lang_sorted[$name][$id_lang_source];
                    $error = false;
                    $validate = !empty($f['validate']) ? $f['validate'] : false;
                    if (!empty($f['required']) && empty($value)) {
                        $error = $this->l('Please specify %s (%s)');
                    } elseif (!empty($validate) && !Validate::$validate($value)) {
                        $error = $this->l('%s (%s) is incorrect');
                    }
                    if ($error) {
                        $lang_iso = Language::getIsoById($id_lang_default);
                        $this->throwError(sprintf($error, Tools::strtolower($f['display_name']), $lang_iso));
                    }
                    if ($name == 'link_rewrite') {
                        // integer values are reserved by page numbers
                        $value = (int)$value ? '_'.$value : $value;
                        // make sure link_rewrite is unique
                        $suffix = $reserved_by_id = 0;
                        do {
                            $new_value = $value.($suffix ? '-'.$suffix : '');
                            foreach (array('post', 'category') as $type) {
                                $reserved_by_id = $this->db->getValue('
                                    SELECT `id_'.bqSQL($type).'`
                                    FROM `'._DB_PREFIX_.'a_blog_'.bqSQL($type).'_lang`
                                    WHERE `link_rewrite` = \''.pSQL($new_value).'\'
                                    AND `id_lang` = '.(int)$id_lang.'
                                    '.($resource_type == $type ? 'AND `id_'.bqSQL($type).'` <> '.(int)$id : '').'
                                ');
                                if ($reserved_by_id) {
                                    $suffix = !$suffix ? 2 : $suffix + 1;
                                    break;
                                }
                            }
                        } while ($reserved_by_id);
                        $value = $new_value;
                    }
                    $allow_html = in_array($name, array('content', 'description')) ? true : false;
                    $lang_row .= ', \''.pSQL($value, $allow_html).'\'';
                }
                $lang_rows[] = '('.$lang_row.')';
            }
        }
        $data_lang = $data_lang_sorted;
        return $lang_rows;
    }

    public function isPostPositioned($id_post, $id_cat)
    {
        $positioned = $this->db->getValue('
            SELECT position FROM '._DB_PREFIX_.'a_blog_post_category
            WHERE id_post = '.(int)$id_post.' AND id_category = '.(int)$id_cat.'
        ');
        return (bool)$positioned;
    }

    public function hookDisplayAdminProductsExtra($params)
    {
        $id_product = !empty($params['id_product']) ? $params['id_product'] : Tools::getValue('id_product');
        $related_ids = $this->formatIDs($this->getRelatedIDs('product', $id_product));
        $config_path = $this->getConfigPagePath();
        $this->context->smarty->assign(array(
            'id_product' => $id_product,
            'imploded_post_ids' => $related_ids,
            'related_post_items' => $related_ids ? $this->getBasicInfos('post', $related_ids) : array(),
            'ab_config_path' => $config_path,
            'is_17' => $this->is_17,
        ));
        $js = '
            <script type="text/javascript">
                var ab_ajax_path = "'.$config_path.'&ajax=1";
            </script>
        ';
        return $js.$this->display(__FILE__, 'views/templates/admin/product-tab.tpl');
    }

    public function getConfigPagePath()
    {
        return 'index.php?controller=AdminModules&configure='.$this->name.
        '&token='.Tools::getAdminTokenLite('AdminModules');
    }

    public function hookActionProductSave()
    {
        if (Tools::isSubmit('related_post_ids')) {
            $id_product = Tools::getValue('id_product');
            $related_post_ids = Tools::getValue('related_post_ids');
            $this->saveRelatedIDs('product', $id_product, $related_post_ids);
        }
    }

    public function ajaxDelete()
    {
        $id = Tools::getValue('id');
        $resource = Tools::getValue('resource');
        $method = 'delete'.$resource;
        $this->verifyMethod($method);
        $ret = array(
            'deleted' => $this->$method($id),
            'total' => $this->getTotal(Tools::strtolower($resource)),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function ajaxDeleteCategory()
    {
        $ret = array(
            'deleted' => $this->deleteCategory(Tools::getValue('id_category')),
            'total' => $this->getTotal('category'),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function verifyMethod($method_name)
    {
        if (!method_exists($this, $method_name)) {
            $this->throwError($this->l('Unknown method:').' '.$method_name);
        }
    }

    public function deleteBlock($id_block)
    {
        $deleted = $this->db->execute('
            DELETE FROM '._DB_PREFIX_.'a_blog_block_lang
            WHERE id_block = '.(int)$id_block.'
            AND id_shop IN ('.implode(', ', array_map('intval', $this->shop_ids)).')
        ');
        $exists = $this->db->getValue('
            SELECT * FROM '._DB_PREFIX_.'a_blog_block_lang WHERE id_block = '.(int)$id_block.'
        ');
        if ($deleted && !$exists) {
            $deleted &= $this->db->execute('
                DELETE FROM '._DB_PREFIX_.'a_blog_block WHERE id_block = '.(int)$id_block.'
            ');
        }
        return $deleted;
    }

    public function deletePost($id_post)
    {
        $deleted = $this->db->execute('
            DELETE FROM '._DB_PREFIX_.'a_blog_post_lang
            WHERE id_post = '.(int)$id_post.'
            AND id_shop IN ('.implode(', ', array_map('intval', $this->shop_ids)).')
        ');
        $exists = $this->db->getValue('SELECT * FROM '._DB_PREFIX_.'a_blog_post_lang WHERE id_post = '.(int)$id_post);
        if ($deleted && !$exists) {
            $deleted &= $this->db->execute('
                DELETE FROM '._DB_PREFIX_.'a_blog_post WHERE id_post = '.(int)$id_post.';
                DELETE FROM '._DB_PREFIX_.'a_blog_post_category WHERE id_post = '.(int)$id_post.';
                DELETE FROM '._DB_PREFIX_.'a_blog_post_stats WHERE id_post = '.(int)$id_post.';
                DELETE FROM '._DB_PREFIX_.'a_blog_comment WHERE id_post = '.(int)$id_post.';
                DELETE FROM '._DB_PREFIX_.'a_blog_related_products WHERE id_post = '.(int)$id_post.';
            ');
        }
        if ($deleted) {
            $this->recursiveRemove($this->img_dir_local.'posts/'.$id_post.'/');
        }
        return $deleted;
    }

    public function deleteComment($id_comment)
    {
        $id_post = $this->db->getValue(
            'SELECT id_post FROM '._DB_PREFIX_.'a_blog_comment WHERE id_comment = '.(int)$id_comment
        );
        $deleted = $this->db->execute(
            'DELETE FROM '._DB_PREFIX_.'a_blog_comment WHERE id_comment = '.(int)$id_comment
        );
        $total = $this->db->getValue(
            'SELECT COUNT(*) FROM '._DB_PREFIX_.'a_blog_comment WHERE id_post = '.(int)$id_post
        );
        $this->addPostStats($id_post, 'comments', $total);
        return $deleted;
    }

    public function ajaxUploadImages()
    {
        $id_post = Tools::getValue('id_post');
        $post_dir_local = $this->img_dir_local.'posts/'.$id_post.'/';
        $post_dir = $this->img_dir.'posts/'.$id_post.'/';
        if (!file_exists($post_dir_local)) {
            mkdir($post_dir_local, 0755);
            Tools::copy($this->local_path.'index.php', $post_dir_local.'index.php');
        }
        $saved_images = array();
        $num = count($this->getPostImages($id_post));
        $sizes = array();
        foreach ($this->img_settings as $type => $settings) {
            $sizes[$type] = $settings['value'];
        }

        $special_imgs_verified = false;
        foreach ($_FILES as $file) {
            $saved_img = $this->saveSubmittedImage($file, $post_dir_local, ++$num, $sizes);
            $key = $saved_img;
            if (!$special_imgs_verified) {
                foreach (array_keys($this->special_img_types) as $type) {
                    if (!$this->getPostImg($type, $id_post)) {
                        $this->setPostImg($type, $id_post, $saved_img);
                    }
                }
                $special_imgs_verified = true;
            }
            $saved_images[$key] = $post_dir.'m/'.$saved_img;
        }
        ksort($saved_images);
        $smarty_array = array(
            'images' => $saved_images,
            'image_types' => $this->img_settings,
        );
        foreach (array_keys($this->special_img_types) as $type) {
            $smarty_array[$type] = $this->getPostImg($type, $id_post);
        }
        $this->context->smarty->assign($smarty_array);
        $image_set_html = $this->display(__FILE__, 'views/templates/admin/post-images.tpl');
        $ret = array('saved_images_html' => utf8_encode($image_set_html));
        exit(Tools::jsonEncode($ret));
    }

    public function saveSubmittedImage($file, $location, $prefix, $sizes, $keep_original = true)
    {
        if (!isset($file['tmp_name']) || empty($file['tmp_name']) || !empty($this->errors)) {
            return '';
        }

        $max_size = 10485760; // 10 mb

        // Check image validity
        if ($error = ImageManager::validateUpload($file, Tools::getMaxUploadSize($max_size))) {
            $this->throwError($error);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_img_name = $this->getNewFilename($location, $prefix).'.'.$ext;

        if (!move_uploaded_file($file['tmp_name'], $location.$new_img_name)) {
            $this->throwError($this->l('Error: image was not copied'));
        }

        foreach ($sizes as $type => $dimentions) {
            $path = $location.'/'.$type.'/';
            if (!file_exists($path)) {
                mkdir($path, 0755);
                Tools::copy($this->local_path.'index.php', $path.'index.php');
            }
            $path .= $new_img_name;
            $dimentions = explode('*', $dimentions);
            $w = $dimentions[0];
            $h = $dimentions[1];
            if (!$this->imageResizeModified($location.$new_img_name, $path, $w, $h, $ext)) {
                $this->throwError($this->l('Error: image was not resized'));
            }
        }
        if (!$keep_original) {
            unlink($location.$new_img_name);
        }
        return $new_img_name;
    }

    public function getPostImg($type, $id_post, $check_existence = true)
    {
        $sql = 'SELECT '.pSQL($type).' FROM '._DB_PREFIX_.'a_blog_post WHERE id_post = '.(int)$id_post;
        $img = $this->db->getValue($sql);
        if ($img && $check_existence && !is_file($this->img_dir_local.'posts/'.$id_post.'/'.$img)) {
            $img = false;
        }
        return $img;
    }

    public function ajaxSetPostImg()
    {
        $type = Tools::getValue('type');
        $id_post = Tools::getValue('id_post');
        $img = Tools::getValue('img');
        $ret = array(
            'success' => $this->setPostImg($type, $id_post, $img),
            $type => $img,
        );
        exit(Tools::jsonEncode($ret));
    }

    public function setPostImg($type, $id_post, $img)
    {
        return $this->db->execute(
            'UPDATE '._DB_PREFIX_.'a_blog_post SET '.pSQL($type).' = \''.pSQL($img).'\' WHERE id_post = '.(int)$id_post
        );
    }

    public function getPostImages($id_post, $add_path = false)
    {
        $sorted = array();
        $post_images = glob($this->img_dir_local.'posts/'.$id_post.'/*');
        foreach ($post_images as $img) {
            if (getimagesize($img)) {
                $img_name = basename($img);
                $key = current(explode('-', $img_name));
                $sorted[$key] = $img_name;
                if ($add_path) {
                    $sorted[$key] = $this->img_dir.'posts/'.$id_post.'/m/'.$sorted[$key];
                }
            }
        }
        ksort($sorted);
        return $sorted;
    }

    public function ajaxDeleteImg()
    {
        $id_post = Tools::getValue('id_post');
        $img = Tools::getValue('img');
        $deleted = $this->deleteImg($id_post, $img);
        $post_images = $this->getPostImages($id_post);
        $current = current($post_images);
        foreach (array_keys($this->special_img_types) as $type) {
            if ($this->getPostImg($type, $id_post, false) == $img && !empty($current)) {
                $this->setPostImg($type, $id_post, $current);
            }
        }
        $ret = array(
            'success' => $deleted,
            'cover' => $this->getPostImg('cover', $id_post),
            'main_img' => $this->getPostImg('main_img', $id_post),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function deleteImg($id_post, $img)
    {
        $res = true;
        $post_dir = $this->img_dir_local.'posts/'.$id_post.'/';
        $res &= unlink($post_dir.$img);
        if (empty($this->img_settings)) {
            $this->img_settings = $this->getImgSettings();
        }
        foreach (array_keys($this->img_settings) as $type) {
            $res &= unlink($post_dir.$type.'/'.$img);
        }
        return $res;
    }

    public function getNewFilename($location, $prefix = '')
    {
        $prefix = $prefix ? $prefix.'-' : '';
        do {
            $filename = uniqid($prefix);
        } while (file_exists($location.$filename));
        return $filename;
    }

    public function ajaxRegenerateThumbnails()
    {
        $type = Tools::getValue('type');
        $id_post = (int)Tools::getValue('id_post');
        $ret = array();

        // first run
        if (!$id_post) {
            $post_ids = $this->db->executeS('SELECT id_post FROM '._DB_PREFIX_.'a_blog_post');
            foreach ($post_ids as &$p) {
                $p = $p['id_post'];
            }
            $ret['post_ids'] = $post_ids;
        } else {
            $location = $this->img_dir_local.'posts/'.$id_post.'/';
            $post_images = glob($location.'*');
            $total = 0;
            foreach ($post_images as $src_img) {
                if (getimagesize($src_img)) {
                    $img_name = basename($src_img);
                    $ext = pathinfo($img_name, PATHINFO_EXTENSION);
                    $dest_img = $location.$type.'/'.$img_name;
                    $size = explode('*', $this->img_settings[$type]['value']);
                    $w = $size[0];
                    $h = $size[1];
                    $this->imageResizeModified($src_img, $dest_img, $w, $h, $ext);
                    $total++;
                }
            }
            $ret['id_post'] = $id_post;
            $ret['total_regenerated'] = $total;
        }
        exit(Tools::jsonEncode($ret));
    }

    public function unserialize($string)
    {
        $params = array();
        parse_str($string, $params);
        return $params;
    }

    public function getCategoryLink($id_category, $link_rewrite = false, $page = 1)
    {
        $url = $this->getBaseUri();
        if ($id_category != $this->root_id) {
            if ($this->friendly_url) {
                $link_rewrite = $link_rewrite ? $link_rewrite : $this->getLinkRewriteById('category', $id_category);
                $url .= $link_rewrite.'/';
            } else {
                $url .= (strpos($url, '?') ? '&' : '?').'id_category='.(int)$id_category;
            }
        }
        $url = $this->addPageNumber($url, $page);
        return $url;
    }

    public function getPostLink($id_post, $link_rewrite = false)
    {
        $url = $this->getBaseUri();
        if ($this->friendly_url) {
            $link_rewrite = $link_rewrite ? $link_rewrite : $this->getLinkRewriteById('post', $id_post);
            $url .= $link_rewrite;
        } else {
            $url .= (strpos($url, '?') ? '&' : '?').'id_post='.(int)$id_post;
        }
        return $url;
    }

    public function getTagLink($tag_url, $page = 1)
    {
        $url = $this->getBaseUri();
        $tag_url = is_array($tag_url) ? implode('+', $tag_url) : $tag_url;
        if ($this->friendly_url) {
            $url .= 'tags/'.$tag_url.'/';
        } else {
            $url .= (strpos($url, '?') ? '&' : '?').'tags='.$tag_url;
        }
        $url = $this->addPageNumber($url, $page);
        return $url;
    }

    public function addPageNumber($url, $page)
    {
        if ($page > 1) {
            $url = rtrim($url, '/');
            $url .= $this->friendly_url ? '/'.$page.'/' : (strpos($url, '?') ? '&' : '?').'page='.$page;
        }
        return $url;
    }

    public function getBaseUri($params = array())
    {
        if (empty($this->base_uri)) {
            $this->base_uri = $this->context->link->getModuleLink($this->name, 'blog');
        }
        if ($params) {
            $this->base_uri .= (strpos($this->base_uri, '?') ? '&' : '?').http_build_query($params);
        }
        return $this->base_uri;
    }

    public function getIdByLinkRewrite($resource_type, $link_rewrite)
    {
        $id = $this->db->getValue('
            SELECT id_'.pSQL($resource_type).' FROM '._DB_PREFIX_.'a_blog_'.pSQL($resource_type).'_lang
            WHERE link_rewrite = \''.pSQL($link_rewrite).'\'
            AND id_lang = '.(int)$this->id_lang.'
            AND id_shop = '.(int)$this->id_shop.'
        ');
        return $id;
    }

    public function getLinkRewriteById($resource_type, $id)
    {
        $link_rewrite = $this->db->getValue('
            SELECT link_rewrite FROM '._DB_PREFIX_.'a_blog_'.pSQL($resource_type).'_lang
            WHERE id_'.pSQL($resource_type).' = '.(int)$id.'
            AND id_lang = '.(int)$this->id_lang.'
            AND id_shop = '.(int)$this->id_shop.'
        ');
        return $link_rewrite;
    }

    public function getAuthorNameById($id)
    {
        $name = $this->db->getRow('
            SELECT firstname, lastname FROM '._DB_PREFIX_.'employee WHERE id_employee = '.(int)$id.'
        ');
        return $name['firstname'].' '.$name['lastname'];
    }

    public function getResourceTitleById($id, $resource_type)
    {
        $table_name = 'a_blog_'.$resource_type.'_lang';
        $title = $this->db->getValue('
            SELECT title FROM `'._DB_PREFIX_.bqSQL($table_name).'`
            WHERE `id_'.bqSQL($resource_type).'` = '.(int)$id.'
            AND `id_lang` = '.(int)$this->context->language->id.'
        ');
        return $title;
    }

    public function getPostTagsIds($id_post)
    {
        $query = 'SELECT id_tag FROM '._DB_PREFIX_.'a_blog_post_tag
        WHERE id_post = '.(int)$id_post;
        return $this->getSortedDataFromDb($query, 'id_tag');
    }

    public function getPostCategoriesIds($id_post)
    {
        $query = 'SELECT id_category FROM '._DB_PREFIX_.'a_blog_post_category
        WHERE id_post = '.(int)$id_post;
        return $this->getSortedDataFromDb($query, 'id_category');
    }

    public function getSortedDataFromDb($query, $value_col, $key_col = false)
    {
        $sorted = array();
        $raw_data = $this->db->executeS($query);
        foreach ($raw_data as $k => $d) {
            $key = $key_col ? $d[$key_col] : $k;
            $sorted[$key] = $d[$value_col];
        }
        return $sorted;
    }

    public function getBlockItems($settings)
    {
        $items = array();
        $resource_type = current(explode('_', $settings['type']));
        if ($resource_type == 'post') {
            $order_by = $settings['type'] == 'post_random' ? 'RAND()' : 'publish_from';
            $order_way = 'DESC';
            $additional_filters = array('active' => 1);
            if ($settings['type'] == 'post_mostviewed') {
                $order_by = 'views';
            } elseif ($settings['type'] == 'post_selected' && !empty($settings['post_ids'])) {
                $additional_filters['post_ids'] = $settings['post_ids'];
            } elseif ($settings['type'] == 'post_relatedtopost' && !empty($this->context->controller->id_post)) {
                $id_post = $this->context->controller->id_post;
                $related_ids = array();
                foreach (array('category', 'tag') as $key) {
                    if (!empty($settings['related'][$key])) {
                        $identifier = 'id_'.$key;
                        $query = 'SELECT '.pSQL($identifier).' FROM '._DB_PREFIX_.'a_blog_post_'.pSQL($key).'
                        WHERE id_post = '.(int)$id_post;
                        $key_ids = $this->getSortedDataFromDb($query, $identifier);
                        if ($key_ids) {
                            $imploded_ids = implode(', ', $key_ids);
                            $query = 'SELECT * FROM '._DB_PREFIX_.'a_blog_post_'.pSQL($key).'
                            WHERE '.pSQL($identifier).' IN ('.pSQL($imploded_ids).') AND id_post <> '.(int)$id_post;
                            $related_ids += $this->getSortedDataFromDb($query, 'id_post', 'id_post');
                        }
                    }
                }
                if ($related_ids) {
                    $additional_filters['post_ids'] = implode(',', $related_ids);
                } else {
                    $additional_filters['post_ids'] = '-1';
                }
            } elseif ($settings['type'] == 'post_relatedtoproduct') {
                if (!$related_ids = $this->formatIDs($this->getRelatedIDs('product', Tools::getValue('id_product')))) {
                    return array();
                }
                $additional_filters['post_ids'] = $related_ids;
                $order_by = 'FIELD(p.id_post, '.$related_ids.')';
                $order_way = 'ASC';
            }
            $pagination_settings = $this->getPaginationSettings('post');
            $pagination_settings['npp'] = $settings['num'];
            $pagination_settings['p'] = 1;
            $items = $this->getPostListInfos(
                $pagination_settings,
                $order_by,
                $order_way,
                $additional_filters
            );
        } elseif ($resource_type == 'product') {
            if (!empty($this->context->controller->id_post)) {
                $related_ids = $this->getRelatedIDs('post', $this->context->controller->id_post, false);
                $items = $this->getProductListInfos($related_ids, $settings);
            }
        } elseif ($resource_type == 'category') {
            $items = $this->getCategoryListInfos($settings);
        }
        return $items;
    }

    public function redirectIfTrailingSlashIsMissing()
    {
        $request = false;
        if (isset($_SERVER['REQUEST_URI'])) {
            $request = $_SERVER['REQUEST_URI'];
        } elseif (isset($_SERVER['HTTP_X_REWRITE_URL'])) {
            $request = $_SERVER['HTTP_X_REWRITE_URL'];
        }
        if ($request && Tools::substr($request, - (Tools::strlen($this->slug) + 1)) == '/'.$this->slug) {
            Tools::redirect($this->getBaseURI());
        }
    }

    public function hookDisplayHeader()
    {
        $this->redirectIfTrailingSlashIsMissing();
        $this->context->controller->addJqueryPlugin('bxslider');
        $this->addCSS('front.css');
        if (!empty($this->general_settings['load_icon_fonts'])) {
            $this->addCSS('icons.css');
        }
        $this->addJS('front.js');
        Media::addJsDef(array(
            'isMobile' => $this->isMobile(),
        ));
        if (!empty($this->context->controller->og_image)) {
            $og = '<meta property="og:image" content="'.$this->context->controller->og_image.'">';
            return $og;
        }
    }

    public function isMobile()
    {
        if (empty($this->is_mobile)) {
            if (is_callable(array($this->context, 'isMobile'))) {
                $this->is_mobile = $this->context->isMobile();
            } else {
                $this->is_mobile = $this->context->getMobileDetect()->isMobile();
            }
        }
        return $this->is_mobile;
    }

    public function addRoutesForOtherLanguages($resource_type, $resource_id)
    {
        if (empty($this->slug_other_languages)) {
            return;
        }
        $rewrite_data = $this->db->executeS('
            SELECT link_rewrite, id_lang
            FROM '._DB_PREFIX_.'a_blog_'.pSQL($resource_type).'_lang
            WHERE id_'.pSQL($resource_type).' = '.(int)$resource_id.'
            AND id_lang <> '.(int)$this->id_lang.'
            AND id_shop = '.(int)$this->id_shop.'
        ');
        $dispatcher = Dispatcher::getInstance();
        foreach ($rewrite_data as $data) {
            $link_rewrite = $data['link_rewrite'];
            if ($resource_type == 'category' && $resource_id == $this->root_id) {
                $link_rewrite = '';
            }
            $id_lang = $data['id_lang'];
            if (!empty($this->slug_other_languages[$id_lang])) {
                $slug = $this->slug_other_languages[$id_lang];
                $dispatcher->addRoute(
                    'module-amazzingblog-blog',
                    $slug.'/'.$link_rewrite,
                    'blog',
                    $id_lang,
                    array('rewrite' => array('regexp' => '[_a-zA-Z0-9-\pL]*')),
                    array('fc' => 'module', 'module' => $this->name),
                    $this->id_shop
                );
            }
        }
    }

    public function prepareHeaderData($resource_type, $resource_id)
    {
        $this->addRoutesForOtherLanguages($resource_type, $resource_id);
        $this->addJS($resource_type.'.js');
        $this->addCSS($resource_type.'.css');
        if ($resource_type == ' category') {
            if ($this->is_17) {
                $this->addCSS('category-17.css');
            }
        } elseif ($resource_type == 'post') {
            $this->addCSS('related-products.css');
        }
        Media::addJsDef(array(
            'ab_id_'.$resource_type => $resource_id,
            'ab_ajax_path' => $this->getBaseUri(),
        ));
    }

    public function addJS($file, $custom_path = '')
    {
        $path = ($custom_path ? $custom_path : 'modules/'.$this->name.'/views/js/').$file;
        if ($this->is_17) {
            $params = array('server' => $custom_path ? 'remote' : 'local');
            $this->context->controller->registerJavascript(sha1($path), $path, $params);
        } else {
            $path = $custom_path ? $path : __PS_BASE_URI__.$path;
            $this->context->controller->addJS($path);
            // $this->context->controller->js_files[] = $path.'?'.microtime(true); // debug
        }
    }

    public function addCSS($file, $custom_path = '', $media = 'all')
    {
        $path = ($custom_path ? $custom_path : 'modules/'.$this->name.'/views/css/').$file;
        if ($this->is_17) {
            $params = array('media' => $media, 'server' => $custom_path ? 'remote' : 'local');
            $this->context->controller->registerStylesheet(sha1($path), $path, $params);
        } else {
            $path = $custom_path ? $path : __PS_BASE_URI__.$path;
            $this->context->controller->addCSS($path, $media);
            // $this->context->controller->css_files[$path.'?'.microtime(true)] = $media; // debug
        }
    }

    public function addPostStats($id_post, $col, $value = false)
    {
        $value = $value !== false ? $value : $col.' + 1';
        $this->db->execute('
            INSERT INTO '._DB_PREFIX_.'a_blog_post_stats
            (`id_post`, `'.bqSQL($col).'`)
            VALUES ('.(int)$id_post.', '.pSQL($value).')
            ON DUPLICATE KEY UPDATE `'.bqSQL($col).'` = '.pSQL($value).'
        ');
    }

    public function getCommentUser($id_comment)
    {
        $sql = 'SELECT id_user FROM '._DB_PREFIX_.'a_blog_comment WHERE id_comment = '.(int)$id_comment;
        return $this->db->getValue($sql);
    }

    public function ajaxEditComment()
    {
        $comment_settings = $this->getSettings('comment');
        $id_comment = Tools::getValue('id_comment');
        $id_user = $this->getCommentUser($id_comment);
        $user_name = $this->getValueAndValidate('user_name', 'isLabel', true);
        $content = $this->getValueAndValidate('content', 'isCleanHtml', true, $comment_settings['max_chars']);
        if (!empty($this->errors)) {
            $this->throwError($this->errors, false);
        }
        $this->verifyUserName($user_name, $id_user);
        $saved = $this->db->execute('
            UPDATE '._DB_PREFIX_.'a_blog_comment bc, '._DB_PREFIX_.'a_blog_user u SET
            bc.content = \''.pSQL($content).'\',
            u.user_name = \''.pSQL($user_name).'\'
            WHERE bc.id_comment = '.(int)$id_comment.'
            AND u.id_user = bc.id_user
        ');
        if (isset($_FILES['avatar_file'])) {
            $sizes = array('avatars' => $comment_settings['avatar']);
            $new_avatar = $this->saveSubmittedImage($_FILES['avatar_file'], $this->img_dir_local, false, $sizes, false);
            if ($new_avatar) {
                $avatar_prev = $this->getCommentAvatar($id_comment);
                $this->db->execute('
                    UPDATE '._DB_PREFIX_.'a_blog_user SET
                    avatar = \''.pSQL($new_avatar).'\' WHERE avatar = \''.pSQL($avatar_prev).'\'
                ');
                $avatar_prev = $this->img_dir_local.'avatars/'.$avatar_prev;
                if (empty($this->errors) && is_file($avatar_prev)) {
                    unlink($avatar_prev);
                }
            }
        }
        $ret = array('updated_html' => $saved ? utf8_encode($this->renderCommentAdmin($id_comment)) : '');
        exit(Tools::jsonEncode($ret));
    }

    public function getCommentAvatar($id_comment)
    {
        $avatar = $this->db->getValue('
            SELECT u.avatar FROM '._DB_PREFIX_.'a_blog_comment c
            INNER JOIN '._DB_PREFIX_.'a_blog_user u ON u.id_user = c.id_user
            WHERE c.id_comment = '.(int)$id_comment.'
        ');
        return $avatar;
    }

    public function ajaxSendNotification()
    {
        $comment_settings = $this->getSettings('comment');
        $id_comment = Tools::getValue('id_comment');
        $comment_data = $this->db->getRow('
            SELECT pl.title, c.*, u.user_name
            FROM '._DB_PREFIX_.'a_blog_comment c
            LEFT JOIN '._DB_PREFIX_.'a_blog_user u ON c.id_user = u.id_user
            LEFT JOIN '._DB_PREFIX_.'a_blog_post_lang pl
                ON pl.id_post = c.id_post AND pl.id_lang = '.(int)$this->id_lang.'
            WHERE c.id_comment = '.(int)$id_comment.'
        ');
        if (!$comment_data['notif_sent'] && $comment_settings['notif_email']) {
            $subject = Configuration::get('PS_SHOP_NAME').': '.$this->l('New comment submitted');
            $content = strip_tags($this->bbCodeToHTML($comment_data['content'], false));
            $body = $comment_data['title']."\n\n".$comment_data['user_name'].":\n".$content;
            if ($sent = $this->sendEmailNotification($comment_settings['notif_email'], $subject, $body)) {
                $this->db->execute('
                    UPDATE '._DB_PREFIX_.'a_blog_comment SET notif_sent = 1 WHERE id_comment = '.(int)$id_comment.'
                ');
            }
        }
        $ret = array('sent' => $sent);
        exit(Tools::jsonEncode($ret));
    }

    public function sendEmailNotification($to, $subject, $body)
    {
        if (!Validate::isEmail($to)) {
            return false;
        }
        $from = 'noreply@'.str_replace('www.', '', $_SERVER['HTTP_HOST']);
        if (!Validate::isEmail($from)) {
            $from = Configuration::get('PS_SHOP_EMAIL');
        }
        $smtp = $smtp_server = $smtp_login = $smtp_pass = $smtp_encryption = false;
        $type = 'text/plain';
        $smtp_port = 25;
        return Mail::sendMailTest(
            $smtp,
            $smtp_server,
            $body,
            $subject,
            $type,
            $to,
            $from,
            $smtp_login,
            $smtp_pass,
            $smtp_port,
            $smtp_encryption
        );
    }

    public function verifyIp($ip)
    {
        $comment_settings = $this->getSettings('comment');
        $date_limit = date('Y-m-d H:i:s', strtotime('-1 hour', time()));
        $count = $this->db->getValue('
            SELECT COUNT(*) FROM '._DB_PREFIX_.'a_blog_comment
            WHERE ip = \''.$ip.'\' AND date_add > \''.pSQL($date_limit).'\'
            AND id_shop = '.(int)$this->context->shop->id.'
        ');
        if ($count >= $comment_settings['max_comments']) {
            $this->throwError($this->l('You cannot post comments so often'));
        }
    }

    public function verifyUserName($user_name, $id_user = false)
    {
        $sql = 'SELECT * FROM '._DB_PREFIX_.'a_blog_user WHERE user_name = \''.pSQL($user_name).'\'';
        if ($id_user) {
            $sql .= ' AND id_user <> '.(int)$id_user;
        }
        if ($this->db->getValue($sql)) {
            $err = array('user_name' => $this->l('This name is used by someone else'));
            $this->throwError($err, false);
        }
    }

    public function ajaxSubmitComment()
    {
        $comment_settings = $this->getSettings('comment');
        $ip = Tools::getRemoteAddr();
        $id_comment = 0;
        $id_shop = $this->context->shop->id;
        $id_post = Tools::getValue('id_post');
        $content = $this->getValueAndValidate('content', 'isCleanHtml', true, $comment_settings['max_chars']);
        $user_name = $this->getValueAndValidate('user_name', 'isLabel', true);
        if (!empty($this->errors)) {
            $this->throwError($this->errors, false);
        }
        $this->verifyIp($ip);

        if (empty($this->context->cookie->id_guest)) {
            Guest::setNewGuest($this->context->cookie);
        }
        $id_user = $this->saveUserData($this->context->cookie->id_guest, $user_name);
        $active = 1;
        $approved_by = $notif_sent = 0;
        $date = date('Y-m-d H:i:s');
        $answers = '';

        $saved = $this->db->execute('
            REPLACE INTO '._DB_PREFIX_.'a_blog_comment VALUES (
            '.(int)$id_comment.',
            '.(int)$id_shop.',
            '.(int)$id_post.',
            '.(int)$id_user.',
            '.(int)$active.',
            '.(int)$approved_by.',
            '.(int)$notif_sent.',
            \''.pSQL($content).'\',
            \''.pSQL($date).'\',
            \''.pSQL($date).'\',
            \''.pSQL($ip).'\',
            \''.pSQL($answers).'\')
        ');
        if (!$id_comment) {
            $id_comment = $this->db->Insert_ID();
        }
        $new_comment_html = '';
        if ($saved) {
            $this->addPostStats($id_post, 'comments');
            $comment = $this->db->getRow('
                SELECT * FROM '._DB_PREFIX_.'a_blog_comment c
                LEFT JOIN '._DB_PREFIX_.'a_blog_user bu ON bu.id_user = c.id_user
                WHERE c.id_comment = '.(int)$id_comment.'
            ');
            $this->context->smarty->assign(array(
                'comment' => $comment,
                'avatars_dir' => $this->img_dir.'avatars/',
                'blog' => $this,
            ));
            if (!empty($comment_settings['instant_publish'])) {
                $new_comment_html = $this->display(__FILE__, 'views/templates/front/comment.tpl');
            } else {
                $msg = $this->l('Thank you for your comment. It will be published soon');
                $new_comment_html = $this->displayConfirmation($msg);
            }
        }
        $ret = array(
            'new_comment_html' => utf8_encode($new_comment_html),
            'id_comment' => $id_comment,
        );
        exit(Tools::jsonEncode($ret));
    }

    public function saveUserData($id_guest, $user_name)
    {
        $comment_settings = $this->getSettings('comment');
        $user_data = $this->getUserData($id_guest);
        $this->verifyUserName($user_name, $user_data['id_user']);

        $requires_saving = !$user_data['id_user'] ? true : ($user_data['user_name'] != $user_name ? true : false);
        if (isset($_FILES['avatar_file'])) {
            $sizes = array('avatars' => $comment_settings['avatar']);
            $new_avatar = $this->saveSubmittedImage($_FILES['avatar_file'], $this->img_dir_local, false, $sizes, false);
            if ($new_avatar) {
                $avatar_prev = $this->img_dir_local.'avatars/'.$user_data['avatar'];
                if (empty($this->errors) && is_file($avatar_prev)) {
                    unlink($avatar_prev);
                }
                $user_data['avatar'] = $new_avatar;
                $requires_saving = true;
            }
        }

        if (!empty($this->errors)) {
            $this->throwError($this->errors, false);
        }

        if ($requires_saving) {
            $this->db->execute('
                REPLACE INTO '._DB_PREFIX_.'a_blog_user VALUES (
                '.(int)$user_data['id_user'].',
                '.(int)$id_guest.',
                \''.pSQL($user_name).'\',
                \''.pSQL($user_data['avatar']).'\')
            ');
            if (!$user_data['id_user']) {
                $user_data['id_user'] = $this->db->Insert_ID();
            }
        }
        return $user_data['id_user'];
    }

    public function getUserData($id_guest)
    {
        $user_data = $this->db->getRow('
            SELECT * FROM '._DB_PREFIX_.'a_blog_user
            WHERE id_guest = '.(int)$id_guest.'
        ');
        if (!$id_guest || !$user_data) {
            $user_data = array(
                'id_user' => '',
                'avatar' => '',
                'user_name' => $this->context->customer->firstname,
            );
        }
        return $user_data;
    }

    public function getValueAndValidate($val, $validate, $required = false, $max_chars = 256)
    {
        $value = Tools::getValue($val);
        if ($required && $value == '') {
            $this->errors[$val] = $this->l('Please, fill in this field');
        } elseif (!Validate::$validate($value)) {
            $this->errors[$val] = $this->l('Incorrect value');
        } elseif (is_string($value) && Tools::strlen(pSQL($value)) > $max_chars) {
            $this->errors[$val] = $this->l('Max characters limit exceeded');
        }
        return $value;
    }

    public function getFullControllerName()
    {
        if (!isset($this->full_controller_name)) {
            $controller = Tools::getValue('controller');
            if (Tools::getValue('fc') == 'module' && Tools::isSubmit('module')) {
                $controller = 'module-'.Tools::getValue('module').'-'.$controller;
            }
            $this->full_controller_name = $controller;
        }
        return $this->full_controller_name;
    }

    public function getCombinedIDs($ids_string)
    {
        $ids = $ids_string ? explode(',', $ids_string) : array();
        return array_combine($ids, $ids);
    }

    public function displayNativeHook($hook_name)
    {
        $current_controller = $this->getFullControllerName();
        $current_id = Tools::getValue('id_'.$current_controller);
        if ($current_controller == 'module-amazzingblog-blog') {
            if (isset($this->context->controller->id_post)) {
                $current_controller = 'ab_post';
                $current_id = $this->context->controller->id_post;
            } elseif (isset($this->context->controller->id_category)) {
                $current_controller = 'ab_category';
                $current_id = $this->context->controller->id_category;
            }
        }
        $hook_settings = $this->db->getRow('
            SELECT * FROM '._DB_PREFIX_.'a_blog_hook_settings
            WHERE hook_name = \''.pSQL($hook_name).'\'
        ');
        if (!empty($hook_settings['exc_type'])) {
            $type = $hook_settings['exc_type'];
            $controllers = array_flip(explode(',', $hook_settings['exc_controllers']));
            if (($type == 1 && isset($controllers[$current_controller])) ||
                ($type == 2 && !isset($controllers[$current_controller]))) {
                return;
            }
        }
        $blocks = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'a_blog_block b
            INNER JOIN '._DB_PREFIX_.'a_blog_block_lang bl
                ON b.id_block = bl.id_block
                AND bl.id_lang = '.(int)$this->id_lang.'
                AND bl.id_shop = '.(int)$this->context->shop->id.'
            WHERE active = 1 AND hook_name = \''.pSQL($hook_name).'\'
        ');

        foreach ($blocks as $k => &$block) {
            $block['settings'] = Tools::jsonDecode($block['settings'], true);

            if (!empty($block['settings']['exceptions'])) {
                if ($allowed_controller = str_replace('_all', '', $block['settings']['exceptions']['page']['type'])) {
                    $allowed_ids = $this->getCombinedIDs($block['settings']['exceptions']['page']['ids']);
                    if ($allowed_controller != $current_controller ||
                        ($allowed_ids && !isset($allowed_ids[$current_id]))) {
                        unset($blocks[$k]);
                        continue;
                    }
                }
                if ($customer_exceptions = $block['settings']['exceptions']['customer']['type']) {
                    $allowed_ids = $this->getCombinedIDs($block['settings']['exceptions']['customer']['ids']);
                    if ($customer_exceptions == 'customer' && !isset($allowed_ids[$this->context->customer->id])) {
                        unset($blocks[$k]);
                        continue;
                    } elseif ($customer_exceptions == 'group' &&
                        !array_intersect($this->context->customer->getGroups(), $allowed_ids)) {
                        unset($blocks[$k]);
                        continue;
                    }
                }
            }

            if ($block['settings']['display_type'] == 'carousel') {
                $block['encoded_carousel_settings'] = Tools::jsonEncode($block['settings']['carousel']);
            }
            if ($items = $this->getBlockItems($block['settings'])) {
                $block['items'] = $items;
            } else {
                unset($blocks[$k]);
            }
        }
        $this->context->smarty->assign(array(
            'hook_name' => $hook_name,
            'is_column_hook' => $this->isColumnHook($hook_name),
            'blocks' => $blocks,
            'all_link' => $this->getBaseUri(),
            'blog' => $this,
            'is_17' => $this->is_17,
            'currency_iso_code' => $this->context->currency->iso_code,
            'cart_page_url' => $this->context->link->getPageLink('cart', true),
        ));
        return $this->display(__FILE__, 'views/templates/hook/blocks.tpl');
    }

    public function isColumnHook($hook_name)
    {
        return Tools::substr($hook_name, -6) == 'Column';
    }

    public function hookDisplayLeftColumn()
    {
        return $this->displayNativeHook('displayLeftColumn');
    }

    public function hookDisplayRightColumn()
    {
        return $this->displayNativeHook('displayRighColumn');
    }

    public function hookDisplayHome()
    {
        return $this->displayNativeHook('displayHome');
    }

    public function hookDisplayPostFooter()
    {
        return $this->displayNativeHook('displayPostFooter');
    }

    public function hookDisplayPostAfterComments()
    {
        return $this->displayNativeHook('displayPostAfterComments');
    }

    public function hookDisplayFooterProduct()
    {
        return $this->displayNativeHook('displayFooterProduct');
    }

    public function hookDisplayBlog1()
    {
        return $this->displayNativeHook('displayBlog1');
    }

    public function hookDisplayBlog2()
    {
        return $this->displayNativeHook('displayBlog2');
    }

    public function hookDisplayBlog3()
    {
        return $this->displayNativeHook('displayBlog3');
    }

    public function prepareDate($date)
    {
        $month_names = $this->getMonthNames();
        $result = array(
            'd' => Tools::substr($date, 8, 2),
            'm' => $month_names[Tools::substr($date, 5, 2)],
            'y' => Tools::substr($date, 0, 4),
        );
        return $result;
    }

    public function getMonthNames()
    {
        $names = array(
            '01' => $this->l('JAN'),
            '02' => $this->l('FEB'),
            '03' => $this->l('MAR'),
            '04' => $this->l('APR'),
            '05' => $this->l('MAY'),
            '06' => $this->l('JUN'),
            '07' => $this->l('JUL'),
            '08' => $this->l('AUG'),
            '09' => $this->l('SEP'),
            '10' => $this->l('OCT'),
            '11' => $this->l('NOV'),
            '12' => $this->l('DEC'),
        );
        return $names;
    }

    public function isRegisteredInHookConsideringShop($hook_name, $id_shop)
    {
        $sql = 'SELECT COUNT(*)
            FROM '._DB_PREFIX_.'hook_module hm
            LEFT JOIN '._DB_PREFIX_.'hook h ON (h.id_hook = hm.id_hook)
            WHERE h.name = \''.pSQL($hook_name).'\'
            AND hm.id_shop = '.(int)$id_shop.'
            AND hm.id_module = '.(int)$this->id;
        return $this->db->getValue($sql);
    }

    public function bbCodeToHTML($bbtext, $nl2br = true)
    {
        $bbtags = array(
            '[b]' => '<span class="b">', '[/b]' => '</span>',
            '[i]' => '<span class="i">', '[/i]' => '</span>',
            '[u]' => '<span class="u">', '[/u]' => '</span>',
            '[img]' => '<img src="', '[/img]' => '" />',
        );
        $bbtext = html_entity_decode(str_ireplace(array_keys($bbtags), array_values($bbtags), $bbtext));
        if ($nl2br) {
            $bbtext = Tools::nl2br($bbtext);
        }
        return $bbtext;
    }

    /**
     * Copy of ImageMagager::resize with slight modifications for resizing without white borders
     */
    public function imageResizeModified(
        $src_file,
        $dst_file,
        $dst_width = null,
        $dst_height = null,
        $file_type = 'jpg',
        $force_type = false
    ) {
        if (PHP_VERSION_ID < 50300) {
            clearstatcache();
        } else {
            clearstatcache(true, $src_file);
        }

        if (!file_exists($src_file) || !filesize($src_file)) {
            $this->throwError($this->l('File doesn\'t exist'));
        }

        list($src_width, $src_height, $type) = getimagesize($src_file);

        // If PS_IMAGE_QUALITY is activated, the generated image will be a PNG with .jpg as a file extension.
        // This allow for higher quality and for transparency. JPG source files will also benefit from a higher quality
        // because JPG reencoding by GD, even with max quality setting, degrades the image.
        if (Configuration::get('PS_IMAGE_QUALITY') == 'png_all'
            || (Configuration::get('PS_IMAGE_QUALITY') == 'png' && $type == IMAGETYPE_PNG) && !$force_type) {
            $file_type = 'png';
        }

        if (!$src_width) {
            $this->throwError($this->l('Image dimentions could not be defined'));
        }
        if (!$dst_width) {
            $dst_width = $src_width;
        }
        if (!$dst_height) {
            $dst_height = $src_height;
        }

        $src_image = ImageManager::create($type, $src_file);

        $width_diff = $dst_width / $src_width;
        $height_diff = $dst_height / $src_height;

        if ($width_diff > 1 && $height_diff > 1) {
            $next_width = $src_width;
            $next_height = $src_height;
        } else {
            if ($width_diff < $height_diff) {
                $next_height = $dst_height;
                $next_width = round(($src_width * $next_height) / $src_height);
                // $dst_width = (int)(!Configuration::get('PS_IMAGE_GENERATION_METHOD') ? $dst_width : $next_width);
            } else {
                $next_width = $dst_width;
                $next_height = round($src_height * $dst_width / $src_width);
                // $dst_height = (int)(!Configuration::get('PS_IMAGE_GENERATION_METHOD') ? $dst_height : $next_height);
            }
        }

        if (!ImageManager::checkImageMemoryLimit($src_file)) {
            $this->throwError($this->l('Not enought memory to process image'));
        }

        $dest_image = imagecreatetruecolor($dst_width, $dst_height);

        // If image is a PNG and the output is PNG, fill with transparency. Else fill with white background.
        if ($file_type == 'png' && $type == IMAGETYPE_PNG) {
            imagealphablending($dest_image, false);
            imagesavealpha($dest_image, true);
            $transparent = imagecolorallocatealpha($dest_image, 255, 255, 255, 127);
            imagefilledrectangle($dest_image, 0, 0, $dst_width, $dst_height, $transparent);
        } else {
            $white = imagecolorallocate($dest_image, 255, 255, 255);
            imagefilledrectangle($dest_image, 0, 0, $dst_width, $dst_height, $white);
        }
        $w = ($dst_width - $next_width) / 2;
        $h = ($dst_height - $next_height) / 2;
        imagecopyresampled(
            $dest_image,
            $src_image,
            (int)$w,
            (int)$h,
            0,
            0,
            $next_width,
            $next_height,
            $src_width,
            $src_height
        );
        return (ImageManager::write($file_type, $dest_image, $dst_file));
    }

    public function clearFilesAndSetError($error)
    {
        $this->recursiveRemove($this->local_path.'tmp/', true);
        if (Tools::isSubmit('ajax')) {
            $this->throwError($error);
        }
        $this->context->controller->errors[] = $error;
        return false;
    }

    public function recursiveRemove($dir, $top_level = false, $files_to_keep = array())
    {
        if ($top_level) {
            $files_to_keep[] = 'index.php';
        }
        $structure = glob(rtrim($dir, '/').'/*');
        if (is_array($structure)) {
            foreach ($structure as $file) {
                if (is_dir($file)) {
                    $this->recursiveRemove($file);
                } elseif (is_file($file) && !in_array(basename($file), $files_to_keep)) {
                    unlink($file);
                }
            }
        }
        if (!$top_level) {
            rmdir($dir);
        }
    }

    public function throwError($errors, $render_html = true)
    {
        if (!is_array($errors)) {
            $errors = array($errors);
        }
        $html = '<div class="thrown-errors">'.$this->displayError(implode('<br>', $errors)).'</div>';
        if (!Tools::isSubmit('ajax')) {
            return $html;
        } elseif ($render_html) {
            $errors = utf8_encode($html);
        }
        die(Tools::jsonEncode(array('errors' => $errors)));
    }
}
