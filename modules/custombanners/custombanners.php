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

class CustomBanners extends Module
{
    public function __construct()
    {
        if (!defined('_PS_VERSION_')) {
            exit;
        }
        $this->name = 'custombanners';
        $this->tab = 'front_office_features';
        $this->version = '2.9.3';
        $this->author = 'Amazzing';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->module_key = '89d38a87bea7e9c6b04e6c77b9cef1cf';

        parent::__construct();

        $this->displayName = $this->l('Custom banners');
        $this->description = $this->l('Add images, videos or other custom HTML content anywhere on your site');

        $this->banners_dir = $this->_path.'views/img/uploads/';
        $this->banners_dir_local = $this->local_path.'views/img/uploads/';

        $this->db = Db::getInstance();
        $this->is_17 = Tools::substr(_PS_VERSION_, 0, 3) === '1.7';
        $this->empty_date = '0000-00-00 00:00:00';
    }

    public function install()
    {
        if (!$this->prepareDatabase()) {
            $this->context->controller->errors[] = $this->l('Database table was not installed properly');
            return false;
        }
        if (!parent::install() ||
            !$this->registerHook('displayBackofficeHeader') ||
            !$this->registerHook('displayHeader')) {
            return false;
        }
        $this->prepareContent();
        return true;
    }

    public function prepareDatabase()
    {
        $sql = array();
        $sql[] = '
            CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'custombanners (
            id_banner int(10) unsigned NOT NULL,
            id_shop int(10) unsigned NOT NULL,
            id_lang int(10) unsigned NOT NULL,
            hook_name varchar(64) NOT NULL,
            id_wrapper int(10) unsigned NOT NULL,
            position int(10) NOT NULL,
            active tinyint(1) NOT NULL,
            publish_from datetime NOT NULL,
            publish_to datetime NOT NULL,
            content text NOT NULL,
            PRIMARY KEY (id_banner, id_shop, id_lang),
            KEY hook_name (hook_name),
            KEY active (active),
            KEY publish_from (publish_from),
            KEY publish_to (publish_to)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
        ';
        $sql[] = '
            CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'cb_wrapper_settings (
            id_wrapper int(10) unsigned NOT NULL AUTO_INCREMENT,
            general text NOT NULL,
            carousel text NOT NULL,
            PRIMARY KEY (id_wrapper)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
        ';
        $sql[] = '
            CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'cb_hook_settings (
            hook_name varchar(64) NOT NULL,
            id_shop int(10) unsigned NOT NULL,
            exc_type tinyint(1) NOT NULL DEFAULT 1 ,
            exc_controllers text NOT NULL,
            PRIMARY KEY (hook_name, id_shop)
          ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
        ';
        return $this->runSql($sql);
    }

    public function prepareContent()
    {
        $demo_file_path = $this->local_path.'defaults/data-custom.zip';
        if (!file_exists($demo_file_path)) {
            $file_name = $this->is_17 ? 'data-17.zip' : 'data.zip';
            $demo_file_path = $this->local_path.'defaults/'.$file_name;
        }
        if (file_exists($demo_file_path)) {
            $this->importBannersData($demo_file_path);
        }
    }

    public function uninstall()
    {
        $sql = array(
            'DROP TABLE IF EXISTS '._DB_PREFIX_.'custombanners',
            'DROP TABLE IF EXISTS '._DB_PREFIX_.'cb_wrapper_settings',
            'DROP TABLE IF EXISTS '._DB_PREFIX_.'cb_hook_settings',
        );
        if ($dropped = $this->runSql($sql)) {
            $this->recursiveRemove($this->banners_dir_local, true);
        }
        return $dropped && parent::uninstall();
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

    public function getAvailableHooks()
    {
        $methods = get_class_methods(__CLASS__);
        $methods_to_exclude = array('hookDisplayBackOfficeHeader' => 0, 'hookDisplayHeader' => 0);

        if ($this->is_17) {
            // some hooks are not available in 1.7
            $methods_to_exclude['hookDisplayMyAccountBlockFooter'] = 0;
            $methods_to_exclude['hookDisplayNav'] = 0;
            $methods_to_exclude['hookDisplayPayment'] = 0;
            $methods_to_exclude['hookDisplayProductComparison'] = 0;
            $methods_to_exclude['hookDisplayProductTab'] = 0;
            $methods_to_exclude['hookDisplayProductTabContent'] = 0;
            $methods_to_exclude['hookDisplayTopColumn'] = 0;
        } else {
            $methods_to_exclude['displayWrapperTop'] = 0;
            $methods_to_exclude['hookDisplayNav1'] = 0;
            $methods_to_exclude['hookDisplayNav2'] = 0;
            $methods_to_exclude['hookDisplayNavFullWidth'] = 0;
            $methods_to_exclude['hookDisplayFooterBefore'] = 0;
            $methods_to_exclude['hookDisplayFooterAfter'] = 0;
        }

        $available_hooks = array();
        foreach ($methods as $m) {
            if (Tools::substr($m, 0, 11) === 'hookDisplay' && !isset($methods_to_exclude[$m])) {
                $available_hooks[str_replace('hookDisplay', 'display', $m)] = 0;
            }
        }
        ksort($available_hooks);
        return $available_hooks;
    }

    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('configure') != $this->name) {
            return;
        }
        $this->context->controller->addJquery();
        $this->context->controller->addJqueryUI('ui.sortable');
        $this->context->controller->addJQueryUI('ui.datetimepicker');
        $this->context->controller->js_files[] = $this->_path.'views/js/back.js?v='.$this->version;
        $this->context->controller->css_files[$this->_path.'views/css/common-classes.css?v='.$this->version] = 'all';
        $this->context->controller->css_files[$this->_path.'views/css/back.css?v='.$this->version] = 'all';
        // tinyMCE
        $this->context->controller->addJS(__PS_BASE_URI__.'js/tiny_mce/tiny_mce.js');
        if (file_exists(_PS_ROOT_DIR_.'/js/admin/tinymce.inc.js')) {
            $this->context->controller->addJS(__PS_BASE_URI__.'js/admin/tinymce.inc.js');
        } else { // retro-compatibility
            $this->context->controller->addJS(__PS_BASE_URI__.'js/tinymce.inc.js');
        }
    }

    public function getContent()
    {
        $this->failed_txt = $this->l('Failed');
        $this->saved_txt = $this->l('Saved');
        $this->shop_ids = Shop::getContextListShopID();

        if (Tools::isSubmit('ajax') && Tools::isSubmit('action')) {
            $action_method = 'ajax'.Tools::getValue('action');
            $this->$action_method();
        }

        $iso = $this->context->language->iso_code;
        // Plain js for retro-compatibility
        $html = '
            <script type="text/javascript">
                var iso = \''.(file_exists(_PS_ROOT_DIR_.'/js/tiny_mce/langs/'.$iso.'.js') ? $iso : 'en').'\';
                var pathCSS = \''._THEME_CSS_DIR_.'\';
                var ad = \''.dirname($_SERVER['PHP_SELF']).'\';
                var failedTxt = \''.$this->failed_txt.'\';
                var savedTxt = \''.$this->saved_txt.'\';
                var areYouSureTxt = \''.$this->l('Are you sure?').'\';
            </script>
        ';
        if (Tools::getValue('action') == 'exportBannersData') {
            if (class_exists('ZipArchive')) {
                $html .= $this->exportBannersData();
            } else {
                $html .= $this->displayError($this->l('Ask your hosting provider to install zip extension'));
            }
        }
        if (Tools::getValue('action') == 'importBannersData') {
            $this->importBannersData();
            $html .= $this->import_response;
        }
        $html .= $this->displayForm();
        return $html;
    }

    private function displayForm()
    {
        $banners = $this->getAllBannersData();
        $hooks = $this->getAvailableHooks();
        $this->deleteUnusedWrappers();

        $sorted_hooks = array();
        foreach (array_keys($banners) as $hook_name) {
            $total = 0;
            foreach ($banners[$hook_name] as $banners_in_wrapper) {
                $total += count($banners_in_wrapper);
            }
            if (isset($hooks[$hook_name])) {
                $sorted_hooks[$hook_name] = $total;
            }
        }
        arsort($sorted_hooks);

        foreach ($hooks as $hook_name => $count) {
            if (!isset($sorted_hooks[$hook_name])) {
                $sorted_hooks[$hook_name] = $count;
            }
        }

        $custom_files = array(
            'css' => $this->l('Add custom CSS'),
            'js' => $this->l('Add custom JS'),
        );

        $this->context->smarty->assign(array(
            'banners' => $banners,
            'hooks' => $sorted_hooks,
            'input_fields' => $this->getBannerFieldNames(),
            'bs_classes' => $this->getBSClasses(),
            'languages' => Language::getLanguages(false),
            'id_lang_current' => $this->context->language->id,
            'iso_lang_current' => $this->context->language->iso_code,
            'multishop_note' => count(Shop::getContextListShopID()) > 1,
            'magic_quotes_warning' => _PS_MAGIC_QUOTES_GPC_,
            'files_update_warnings' => $this->getFilesUpdadeWarnings(),
            'custom_files' => $custom_files,
            'cb' => $this,
            'documentation_link' => $this->_path.'readme_en.pdf',
        ));

        $modals = array(
            array(
                'id' => 'modal_importer_info',
                'class' => 'modal-md',
                'title' => $this->l('How to use the importer'),
                'title_icon' => 'file-zip-o',
                'content' => $this->display($this->local_path, 'views/templates/admin/importer-how-to.tpl'),
            ),
        );
        foreach ($custom_files as $type => $name) {
            $file_path = $this->local_path.'views/'.$type.'/custom/shop'.$this->context->shop->id.'.'.$type;
            $code = file_exists($file_path) ? Tools::file_get_contents($file_path) : '';
            $shop_names = array();
            if (Shop::isFeatureActive()) {
                foreach (Shop::getContextListShopID() as $id_shop) {
                    $shop_names[] = $this->db->getValue('
                        SELECT name FROM '._DB_PREFIX_.'shop WHERE id_shop = '.(int)$id_shop.'
                    ');
                }
            }
            $shop_names = implode(', ', $shop_names);
            $this->context->smarty->assign(array(
                'type' => $type,
                'code' => $code,
                'shop_names' => $shop_names,
            ));
            $modals[] = array(
                'id' => 'custom-'.$type.'-form',
                'class' => 'modal-lg file-form',
                'title' => $name,
                'content' => $this->display($this->local_path, 'views/templates/admin/custom-file-form.tpl'),
            );
        }
        $this->context->smarty->assign(array('modals' => $modals));

        return $this->display($this->local_path, 'views/templates/admin/configure.tpl');
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

    public function getBannerFieldNames()
    {
        $fields = array(
            'title' => array(
                'display_name' => $this->l('Title'),
                'tooltip' => $this->l('Displayed next to cursor on hovering the image'),
            ),
            'img' => array(
                'display_name' => $this->l('Image'),
            ),
            'img_hover' => array(
                'display_name' => $this->l('Hover image'),
                'tooltip' => $this->l('Visible on hover'),
            ),
            'link' => array(
                'display_name' => $this->l('Link'),
                'selector' =>  array(
                    'custom' => $this->l('Custom link'),
                    'Product' => $this->l('Link to product'),
                    'Category' => $this->l('Link to Category'),
                    'Manufacturer' => $this->l('Link to Manufacturer'),
                    'Supplier' => $this->l('Link to Supplier'),
                    'CMS' => $this->l('Link to CMS page'),
                    'CMSCategory' => $this->l('Link to CMS category'),
                ),
            ),
            'html' => array(
                'display_name' => $this->l('HTML'),
            ),
            'class' => array(
                'display_name' => $this->l('Custom class'),
                'all_langs' => 1,
            ),
            'exceptions' => array(
                'display_name' => $this->l('Display banner'),
                'selectors' => array(
                    'page' => $this->getPageExceptionsOptions(),
                    'customer' => array(
                        '0' => $this->l('For all customers'),
                        'group' => $this->l('Only for selected customer groups'),
                        'customer' => $this->l('Only for selected customers'),
                    ),
                ),
                'all_langs' => 1,
                'always_visible' => 1,
            ),
            'publish_from' => array(
                'display_name' => $this->l('Start publication'),
                'datepicker' => 1,
                'all_langs' => 1,
                'always_visible' => 1,
            ),
            'publish_to' => array(
                'display_name' => $this->l('End publication'),
                'datepicker' => 1,
                'all_langs' => 1,
                'always_visible' => 1,
            ),
        );
        return $fields;
    }

    public function getPageExceptionsOptions()
    {
        $pages = array(
            'product' => $this->l('product'),
            'category' => $this->l('category'),
            'manufacturer' => $this->l('manufacturer'),
            'supplier' => $this->l('supplier'),
            'cms' => $this->l('cms'),
        );
        $options = array('0' => $this->l('On all available pages'));
        foreach ($pages as $k => $page) {
            $options[$k.'_all'] = sprintf($this->l('On all %s pages'), $page);
            $options[$k] = sprintf($this->l('On selected %s pages'), $page);
        }
        return $options;
    }

    public function getBSClasses()
    {
        $classes = array(
            'lg' => '1199',
            'md' => '991',
            'sm' => '767',
            'xs' => '479',
            'xxs' => '480',
        );
        return $classes;
    }

    public function exportBannersData()
    {
        $languages = Language::getLanguages(false);
        $lang_id_iso = array();
        foreach ($languages as $lang) {
            $lang_id_iso[$lang['id_lang']] = $lang['iso_code'];
        }

        $id_shop_default = Configuration::get('PS_SHOP_DEFAULT');
        $id_lang_default = Configuration::get('PS_LANG_DEFAULT');
        $tables_to_export = array(
            'custombanners',
            'cb_hook_settings',
            'cb_wrapper_settings',
            'hook_module'
        );
        $export_data = $export_images = array();
        foreach ($tables_to_export as $table_name) {
            $data_from_db = $this->db->executeS('SELECT * FROM '._DB_PREFIX_.pSQL($table_name));
            $ret = $data_from_db;
            switch ($table_name) {
                case 'custombanners':
                    $ret = array();
                    foreach ($data_from_db as $d) {
                        $id_shop = $d['id_shop'] == $id_shop_default ? 'ID_SHOP_DEFAULT' : $d['id_shop'];
                        $iso = $d['id_lang'] == $id_lang_default ? 'LANG_ISO_DEFAULT' : $lang_id_iso[$d['id_lang']];
                        // if ($id_shop != 'ID_SHOP_DEFAULT' || $iso != 'LANG_ISO_DEFAULT') continue;
                        $content = Tools::jsonDecode($d['content'], true);
                        if (!$content) {
                            continue;
                        }
                        $export_images[$content['img']] = $content['img'];
                        $ret[$id_shop][$d['id_banner']][$iso] = $d;
                    }
                    break;
                case 'cb_hook_settings':
                    $ret = array();
                    foreach ($data_from_db as $d) {
                        $id_shop = $d['id_shop'] == $id_shop_default ? 'ID_SHOP_DEFAULT' : $d['id_shop'];
                        // if ($id_shop != 'ID_SHOP_DEFAULT') continue;
                        $ret[$id_shop][$d['hook_name']] = $d;
                    }
                    break;
                case 'hook_module':
                    $ret = array();
                    foreach ($data_from_db as $d) {
                        if ($d['id_module'] != $this->id) {
                            continue;
                        }
                        $id_shop = $d['id_shop'] == $id_shop_default ? 'ID_SHOP_DEFAULT' : $d['id_shop'];
                        // if ($id_shop != 'ID_SHOP_DEFAULT') continue;
                        $hook_name = Hook::getNameByid($d['id_hook']);
                        $ret[$id_shop][$hook_name] = $d['position'];
                    }
                    break;
            }
            $export_data[$table_name] = $ret;
        }

        $tmp_zip_file = tempnam($this->local_path.'tmp', 'zip');
        $zip = new ZipArchive();
        $zip->open($tmp_zip_file, ZipArchive::OVERWRITE);
        $zip->addFromString('data.txt', Tools::jsonEncode($export_data));

        foreach ($export_images as $img_name) {
            $path = $this->banners_dir_local.$img_name;
            if (is_file($path)) {
                $zip->addFile($path, 'img/'.$img_name);
            }
        }

        foreach (array('css', 'js') as $type) {
            foreach (glob($this->local_path.'views/'.$type.'/custom/*') as $file) {
                $filename = basename($file, '.'.$type);
                if (!is_file($file) || strpos($filename, 'shop') === false) {
                    continue;
                }
                $id_shop = str_replace('shop', '', $filename);
                if (!Validate::isInt($id_shop) || $id_shop < 1) {
                    continue;
                }
                if ($id_shop == $id_shop_default) {
                    $id_shop = 'id_shop_default';
                }
                // if ($id_shop != 'id_shop_default') continue;
                $zip->addFile($file, $type.'/shop'.$id_shop.'.'.$type);
            }
        }

        $zip->close();
        $archive_name = 'backup-'.date('d-m-Y').'.zip';
        header('Content-Type: application/zip');
        header('Content-Length: '.filesize($tmp_zip_file));
        header('Content-Disposition: attachment; filename="'.$archive_name.'"');
        readfile($tmp_zip_file);
        unlink($tmp_zip_file);
        return '';
    }

    public function ajaxImportBannersData()
    {
        if ($this->importBannersData()) {
            $ret = array('upd_html' => utf8_encode($this->import_response.$this->displayForm()));
        } else {
            $ret = array('errors' => $this->import_response);
        }
        exit(Tools::jsonEncode($ret));
    }

    public function importBannersData($zip_file = false)
    {
        $tmp_zip_file = $this->local_path.'tmp/uploaded.zip';

        if (!$zip_file) {
            if (!isset($_FILES['zipped_banners_data'])) {
                return $this->clearFilesAndSetError($this->l('File not uploaded'));
            }

            $uploaded_file = $_FILES['zipped_banners_data'];

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

        $exctracted_contents_dir = $this->local_path.'tmp/uploaded_extracted/';
        if (!Tools::ZipExtract($tmp_zip_file, $exctracted_contents_dir)) {
            return $this->clearFilesAndSetError($this->l('An error occured while unzipping archive'));
        }
        if (!file_exists($exctracted_contents_dir.'data.txt')) {
            return $this->clearFilesAndSetError($this->l('This is not a valid backup file'));
        }

        $imported_data = Tools::jsonDecode(Tools::file_get_contents($exctracted_contents_dir.'data.txt'), true);
        $languages = Language::getLanguages(false);
        $lang_iso_id = array();
        foreach ($languages as $lang) {
            $lang_iso_id[$lang['iso_code']] = $lang['id_lang'];
        }

        $tables_to_fill = $images_to_copy = $hooks_data = $custom_files = array();
        $shop_ids = Shop::getShops(false, null, true);
        foreach ($shop_ids as $id_shop) {
            // custombanners
            if (isset($imported_data['custombanners'][$id_shop])) {
                $shop_banners = $imported_data['custombanners'][$id_shop];
            } else {
                $shop_banners = $imported_data['custombanners']['ID_SHOP_DEFAULT'];
            }
            foreach ($shop_banners as $banner_multilang) {
                foreach ($lang_iso_id as $iso => $id_lang) {
                    if (isset($banner_multilang[$iso])) {
                        $banner_data = $banner_multilang[$iso];
                    } else {
                        $banner_data = $banner_multilang['LANG_ISO_DEFAULT'];
                    }
                    $banner_data['id_shop'] = $id_shop;
                    $banner_data['id_lang'] = $id_lang;

                    // scheduled publication retro compatibility
                    foreach (array('publish_from', 'publish_to') as $key) {
                        if (!isset($banner_data[$key])) {
                            $banner_data[$key] = '';
                        }
                    }

                    $tables_to_fill['custombanners'][] = $banner_data;

                    // mark images that need to be copied
                    $content = Tools::jsonDecode($banner_data['content'], true);
                    if (isset($content['img']) && $content['img']) {
                        $img_orig_path = $exctracted_contents_dir.'img/'.$content['img'];
                        if (file_exists($img_orig_path)) {
                            $images_to_copy[$img_orig_path] = $this->banners_dir_local.$content['img'];
                        }
                    }
                }
            }

            // hook settings
            if ($imported_data['cb_hook_settings']) {
                if (isset($imported_data['cb_hook_settings'][$id_shop])) {
                    $settings_rows = $imported_data['cb_hook_settings'][$id_shop];
                } else {
                    $settings_rows = $imported_data['cb_hook_settings']['ID_SHOP_DEFAULT'];
                }

                // retro-compatibility for incorrect exported exceptions data
                if (isset($settings_rows['hook_name']) && count($settings_rows) == 4) {
                    $settings_rows = array($settings_rows['hook_name'] => $settings_rows);
                }

                foreach ($settings_rows as $row) {
                    $row['id_shop'] = $id_shop;
                    $tables_to_fill['cb_hook_settings'][] = $row;
                }
            }

            // wrapper settings
            if ($imported_data['cb_wrapper_settings']) {
                $tables_to_fill['cb_wrapper_settings'] = $imported_data['cb_wrapper_settings'];
            }

            // hooks & positions
            if ($imported_data['hook_module']) {
                if (isset($imported_data['hook_module'][$id_shop])) {
                    $hooks_data[$id_shop] = $imported_data['hook_module'][$id_shop];
                } else {
                    $hooks_data[$id_shop] = $imported_data['hook_module']['ID_SHOP_DEFAULT'];
                }
            }

            // custom files
            foreach (array('css', 'js') as $type) {
                $dest = $this->local_path.'views/'.$type.'/custom/shop'.$id_shop.'.'.$type;
                if (file_exists($exctracted_contents_dir.$type.'/shop'.$id_shop.'.'.$type)) {
                    $custom_files[$dest] = $exctracted_contents_dir.$type.'/shop'.$id_shop.'.'.$type;
                } elseif (file_exists($exctracted_contents_dir.$type.'/shopid_shop_default.'.$type)) {
                    $custom_files[$dest] = $exctracted_contents_dir.$type.'/shopid_shop_default.'.$type;
                }
            }
        }

        $sql = array();
        foreach ($tables_to_fill as $table_name => $rows_to_insert) {
            $db_columns = $this->db->executeS('SHOW COLUMNS FROM '._DB_PREFIX_.pSQL($table_name));
            foreach ($db_columns as &$col) {
                $col = $col['Field'];
            }

            $sql[] = 'DELETE FROM '._DB_PREFIX_.pSQL($table_name);

            $rows = array();
            foreach ($rows_to_insert as $row) {
                $verified_row = array();
                foreach ($db_columns as $col_name) {
                    if (!isset($row[$col_name])) {
                        $err = $this->l('This file can not be used for import.').' '.
                        $this->l('Reason: Database tables don\'t match (%s).');
                        return $this->throwError(sprintf($err, _DB_PREFIX_.$table_name));
                    } else {
                        $allow_html = $col_name == 'content' ? true : false;
                        $verified_row[$col_name] = pSQL($row[$col_name], $allow_html);
                    }
                }
                $rows[] = '(\''.implode('\', \'', $verified_row).'\')';
            }
            if (!$rows || !$db_columns) {
                continue;
            }
            $sql[] = '
                INSERT INTO '._DB_PREFIX_.pSQL($table_name).'
                ('.implode(', ', array_map('pSQL', $db_columns)).')
                VALUES '.implode(', ', $rows).'
            ';
        }

        if (!$sql) {
            return $this->clearFilesAndSetError($this->l('Nothing to import'));
        }

        if ($imported = $this->runSql($sql)) {
            $this->updateAllWrappersSettings();

            $this->deleteShopContextImages($shop_ids);
            foreach ($images_to_copy as $original_path => $destination_path) {
                Tools::copy($original_path, $destination_path);
            }
            foreach ($custom_files as $destination_path => $original_path) {
                Tools::copy($original_path, $destination_path);
            }

            $this->recursiveRemove($this->local_path.'tmp/', true);

            // save original shop context, because it will be changed while setting up hooks
            $original_shop_context = Shop::getContext();
            $original_shop_context_id = null;
            if ($original_shop_context == Shop::CONTEXT_GROUP) {
                $original_shop_context_id = $this->context->shop->id_shop_group;
            } elseif ($original_shop_context == Shop::CONTEXT_SHOP) {
                $original_shop_context_id = $this->context->shop->id;
            }
            foreach ($hooks_data as $id_shop => $hook_list) {
                foreach ($hook_list as $hook_name => $cb_position) {
                    if ($id_shop != $this->context->shop->id) {
                        Cache::clean('hook_module_list');
                        Shop::setContext(Shop::CONTEXT_SHOP, $id_shop);
                    }
                    $id_hook = Hook::getIdByName($hook_name);
                    $this->registerHook($hook_name, array($id_shop));
                    $this->updatePosition($id_hook, 0, $cb_position);
                }
            }
            Shop::setContext($original_shop_context, $original_shop_context_id);
            $this->import_response = $this->displayConfirmation($this->l('Data was successfully  imported'));
        } else {
            $this->import_response = $this->displayError($this->l('An error occured while importing data'));
        }
        return $imported;
    }

    public function updateAllWrappersSettings()
    {
        $saved_wrapper_settings = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'cb_wrapper_settings
        ');
        $standard_settings_fields = array(
            'general' => $this->getWrapperSettingsFields(false, 'general'),
            'carousel' => $this->getWrapperSettingsFields(false, 'carousel'),
        );
        $updated_rows = array();
        foreach ($saved_wrapper_settings as $row) {
            foreach ($standard_settings_fields as $type => $standard_fields) {
                $row[$type] = Tools::jsonDecode($row[$type], true);
                foreach ($standard_fields as $name => $field) {
                    if (!isset($row[$type][$name])) {
                        $row[$type][$name] = $field['value'];
                    }
                }
                $row[$type] = Tools::jsonEncode($row[$type]);
            }
            $updated_rows[] = '(\''.implode('\', \'', array_map('pSQL', $row)).'\')';
        }
        return $this->db->execute('
            REPLACE INTO '._DB_PREFIX_.'cb_wrapper_settings
            VALUES '.implode(', ', $updated_rows).'
        ');
    }

    public function deleteShopContextImages($shop_ids = false)
    {
        if (!$shop_ids) {
            $shop_ids = $this->shop_ids;
        }
        $out_of_context = $this->db->executeS('
            SELECT content FROM '._DB_PREFIX_.'custombanners
            WHERE id_shop NOT IN ('.implode(', ', array_map('intval', $shop_ids)).')
        ');
        $imgs_to_keep = array();
        foreach ($out_of_context as $ooc) {
            $content = Tools::jsonDecode($ooc['content']);
            if (isset($content->img) && $content->img) {
                $imgs_to_keep[] = $content->img;
            }
        }
        $this->recursiveRemove($this->banners_dir_local, true, $imgs_to_keep);
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

    public function formatIDs($ids, $return_string = true)
    {
        $ids = is_array($ids) ? $ids : explode(',', $ids);
        $ids = array_map('intval', $ids);
        $ids = array_combine($ids, $ids);
        unset($ids[0]);
        return $return_string ? implode(',', $ids) : $ids;
    }

    public function getBannersDataFromDB($shop_ids = array(), $id_banner = false)
    {
        $now = date('Y-m-d H:i:s');
        $imploded_shop_ids = $this->formatIDs($shop_ids);
        $data = $this->db->executeS('
            SELECT *,
            DATEDIFF(publish_from, \''.pSQL($now).'\') AS days_before_publish,
            DATEDIFF(\''.pSQL($now).'\', publish_to) AS days_expired
            FROM '._DB_PREFIX_.'custombanners
            WHERE 1 '.($id_banner ? ' AND id_banner = '.(int)$id_banner : '').'
            '.($imploded_shop_ids ? ' AND id_shop IN ('.pSQL($imploded_shop_ids).')' : '').'
            ORDER BY position, id_wrapper
        ');
        return $data;
    }

    public function getSingleBannerMultilangData($id_banner)
    {
        if ($id_banner) {
            $banner_data = $this->getBannersDataFromDB(array($this->context->shop->id), $id_banner);
            // if banner is not available in current shop->id
            if (!$banner_data) {
                $banner_data = $this->getBannersDataFromDB($this->shop_ids, $id_banner);
            }
        } else {
            $banner_data = array();
        }
        $sorted = array();
        foreach ($banner_data as $b) {
            $content = Tools::jsonDecode($b['content'], true);

            foreach (array('img', 'img_hover') as $img_field) {
                if (isset($content[$img_field])) {
                    $content[$img_field] = $this->getBannerSrc($content[$img_field]);
                }
            }

            // scheduled publication
            $content['publish_from'] = ($b['publish_from'] == $this->empty_date) ? '' : $b['publish_from'];
            $content['publish_to'] = ($b['publish_to'] == $this->empty_date) ? '' : $b['publish_to'];

            foreach ($content as $name => $value) {
                $sorted['content'][$name][$b['id_lang']] = $value;
            }

            if ($b['id_lang'] == $this->context->language->id) {
                if (empty($content['title'])) {
                    $content['title'] = sprintf($this->l('Banner %d'), $b['id_banner']);
                }
                $sorted['title'] = $content['title'];
                if ($exc_note = $this->getExceptionsNote($content)) {
                    $sorted['exc_note'] = $exc_note;
                }
                foreach ($b as $name => $value) {
                    if ($name != 'content') {
                        $sorted[$name] = $value;
                    }
                }
                if (isset($content['img'])) {
                    $sorted['header_img'] = $content['img'];
                } elseif (isset($content['html'])) {
                    $sorted['header_html'] = 1;
                }
            }
        }
        if (!$sorted) {
            $sorted = array(
                'title' => $this->l('New banner'),
                'active' => 1,
                'hook_name' => Tools::getValue('hook_name'),
                'id_wrapper' => Tools::getValue('id_wrapper'),
            );
        }
        return $sorted;
    }

    public function getAllBannersData()
    {
        $banners_db = $this->getBannersDataFromDB($this->shop_ids);
        $sorted = array();
        $id_shop = $this->context->shop->id;
        $id_lang = $this->context->language->id;
        $already_included = array();
        foreach ($banners_db as $b) {
            if ($b['id_shop'] == $id_shop || !isset($already_included[$b['id_banner']][$b['id_lang']])) {
                if (!$b['content']) {
                    continue;
                }

                // remove possible duplicates in sorted list
                // if a banner is wrapped by different wrappers in different shops
                if (isset($already_included[$b['id_banner']][$b['id_lang']])) {
                    $included_data = explode('-', $already_included[$b['id_banner']][$b['id_lang']]);
                    $b['hook_name'] = $included_data[0];
                    $b['id_wrapper'] = $included_data[1];
                }
                $already_included[$b['id_banner']][$b['id_lang']] = $b['hook_name'].'-'.$b['id_wrapper'];

                $content = Tools::jsonDecode($b['content'], true);
                if (!$content) {
                    continue;
                }

                foreach (array('img', 'img_hover') as $img_field) {
                    if (isset($content[$img_field])) {
                        $content[$img_field] = $this->getBannerSrc($content[$img_field]);
                    }
                }

                // scheduled publication
                $content['publish_from'] = ($b['publish_from'] == $this->empty_date) ? '' : $b['publish_from'];
                $content['publish_to'] = ($b['publish_to'] == $this->empty_date) ? '' : $b['publish_to'];

                foreach ($content as $k => $val) {
                    $sorted[$b['hook_name']][$b['id_wrapper']][$b['id_banner']]['content'][$k][$b['id_lang']] = $val;
                }
                if ($b['id_lang'] == $id_lang
                    || !isset($sorted[$b['hook_name']][$b['id_wrapper']][$b['id_banner']]['title'])) {
                    if (empty($content['title'])) {
                        $content['title'] = sprintf($this->l('Banner %d'), $b['id_banner']);
                    }
                    $sorted[$b['hook_name']][$b['id_wrapper']][$b['id_banner']]['title'] = $content['title'];
                    if ($exc_note = $this->getExceptionsNote($content)) {
                        $sorted[$b['hook_name']][$b['id_wrapper']][$b['id_banner']]['exc_note'] = $exc_note;
                    }
                    foreach ($b as $name => $value) {
                        if ($name != 'content') {
                            $sorted[$b['hook_name']][$b['id_wrapper']][$b['id_banner']][$name] = $value;
                        }
                    }
                    if (isset($content['img'])) {
                        $sorted[$b['hook_name']][$b['id_wrapper']][$b['id_banner']]['header_img'] = $content['img'];
                    } elseif (isset($content['html'])) {
                        $sorted[$b['hook_name']][$b['id_wrapper']][$b['id_banner']]['header_html'] = 1;
                    }
                }
            }
        }
        // d($empty);
        return $sorted;
    }

    public function getExceptionsNote($content)
    {
        $exc_note = '';
        if (isset($content['exceptions'])) {
            $exceptions = array();
            if (!empty($content['exceptions']['page']['type'])) {
                $exceptions[] = $this->l('on selected pages');
            }
            if (!empty($content['exceptions']['customer']['type'])) {
                $exceptions[] = $this->l('for selected customers');
            }
            if ($exceptions) {
                $exc_note = sprintf($this->l('Displayed %s'), implode('/', $exceptions));
            }
        }
        return $exc_note;
    }

    public function getBannerSrc($img_name)
    {
        $src = '';
        if ($img_name != '' && file_exists($this->banners_dir_local.$img_name)) {
            $src = $this->banners_dir.$img_name;
        }
        return $src;
    }

    public function callBannerForm($id_banner, $encode = true)
    {
        $this->context->smarty->assign(array(
            'id_banner' => $id_banner,
            'banner' => $this->getSingleBannerMultilangData($id_banner),
            'input_fields' => $this->getBannerFieldNames(),
            'bs_classes' => $this->getBSClasses(),
            'languages' => Language::getLanguages(false),
            'id_lang_current' => $this->context->language->id,
            'multishop_note' => count($this->shop_ids) > 1,
        ));
        $banner_form_html = $this->display($this->local_path, 'views/templates/admin/banner-form.tpl');
        if ($encode) {
            $banner_form_html = utf8_encode($banner_form_html);
        }
        return $banner_form_html;
    }

    public function ajaxCallSettingsForm()
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
            FROM '._DB_PREFIX_.'cb_hook_settings
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

        $front_controllers = array_keys(Dispatcher::getControllers(_PS_FRONT_CONTROLLER_DIR_));
        $retro_compatibility = array(
            'auth' => 'authentication',
            'compare' => 'productscomparison'
        );
        foreach ($front_controllers as $fc) {
            $fc = isset($retro_compatibility[$fc]) ? $retro_compatibility[$fc] : $fc;
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
            $exc_controllers = implode(',', Tools::getValue('exceptions'));
            $rows = array();
            foreach ($this->shop_ids as $id_shop) {
                $row = '\''.pSQL($hook_name).'\', '.(int)$id_shop.', '.
                (int)$exc_type.', \''.pSQL($exc_controllers).'\'';
                $rows[] = '('.$row.')';
            }
            $saved = $this->db->execute('
                INSERT INTO '._DB_PREFIX_.'cb_hook_settings
                (hook_name, id_shop, exc_type, exc_controllers)
                VALUES '.implode(', ', $rows).'
                ON DUPLICATE KEY UPDATE
                exc_type = VALUES(exc_type),
                exc_controllers = VALUES(exc_controllers)
            ');
        } elseif ($settings_type == 'position') {
            $id_module = Tools::getValue('id_module');
            $new_position = Tools::getValue('new_position');
            $way = Tools::getValue('way');
            if ($module = Module::getInstanceById($id_module)) {
                $saved = $module->updatePosition($id_hook, $way, $new_position);
            }
        }
        $ret = array('saved' => $saved);
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
                    $saved = $module->unregisterHook(Hook::getIdByName($hook_name), $this->shop_ids);
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
        $ret = array('saved' => $saved);
        exit(Tools::jsonEncode($ret));
    }

    public function ajaxGetCustomCode()
    {
        $file_type = Tools::getValue('file_type');
        $file_path = $this->local_path.'views/'.$file_type.'/custom/shop'.$this->context->shop->id.'.'.$file_type;
        $code = file_exists($file_path) ? Tools::file_get_contents($file_path) : '';
        $ret = array('code' => $code);
        exit(Tools::jsonEncode($ret));
    }

    public function ajaxSaveCustomFile()
    {
        $file_type = Tools::getValue('file_type');
        $code = Tools::getValue('code');
        $saved = true;
        foreach (Shop::getContextListShopID() as $id_shop) {
            $file_path = $this->local_path.'views/'.$file_type.'/custom/shop'.$id_shop.'.'.$file_type;
            if ($code) {
                $saved &= file_put_contents($file_path, $code);
            } elseif (file_exists($file_path)) {
                $saved &= unlink($file_path);
            }
        }
        $ret = array('saved' => $saved !== false);
        exit(Tools::jsonEncode($ret));
    }

    public function ajaxAddWrapper()
    {
        $id_wrapper = $this->addWrapper();
        $ret = array(
            'wrapper_html' => $this->callWrapperForm($id_wrapper),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function callWrapperForm($id_wrapper, $encode = true)
    {
        $this->context->smarty->assign(array(
            'id_wrapper' => $id_wrapper,
            'banners' => array(),
            'wrapper_settings' => $this->getWrapperSettingsFields($id_wrapper),
            'cb' => $this,
        ));
        $form_html = $this->display($this->local_path, 'views/templates/admin/wrapper-form.tpl');
        if ($encode) {
            $form_html = utf8_encode($form_html);
        }
        return $form_html;
    }

    public function addWrapper()
    {
        $settings = array();
        $fields = array(
            'general' => $this->getWrapperSettingsFields(),
            'carousel' => $this->getWrapperSettingsFields(false, 'carousel'),
        );
        foreach ($fields as $k => $f) {
            foreach ($f as $name => $field) {
                $settings[$k][$name] = $field['value'];
            }
            $settings[$k] = Tools::jsonEncode($settings[$k]);
        }
        $added = $this->db->execute('
            INSERT INTO '._DB_PREFIX_.'cb_wrapper_settings
            VALUES (0, \''.pSQL($settings['general']).'\', \''.pSQL($settings['carousel']).'\')
        ');
        return $added ? $this->db->insert_ID() : false;
    }

    public function ajaxDeleteWrapper()
    {
        $id_wrapper = Tools::getValue('id_wrapper');
        $ret = array(
            'deleted' => $this->deleteWrapper($id_wrapper),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function deleteWrapper($id_wrapper)
    {
        $deleted = $this->db->execute('
            DELETE FROM '._DB_PREFIX_.'cb_wrapper_settings WHERE id_wrapper = '.(int)$id_wrapper.'
        ');
        return $deleted;
    }

    public function deleteUnusedWrappers()
    {
        $wrappers_data = $this->db->executeS('
            SELECT cb.id_banner, w.id_wrapper
            FROM '._DB_PREFIX_.'cb_wrapper_settings w
            LEFT JOIN '._DB_PREFIX_.'custombanners cb
                ON cb.id_wrapper = w.id_wrapper
        ');
        $to_delete = array();
        foreach ($wrappers_data as $w) {
            if (!$w['id_banner']) {
                $to_delete[] = $w['id_wrapper'];
            }
        }
        if ($to_delete) {
            $this->db->execute('
                DELETE FROM '._DB_PREFIX_.'cb_wrapper_settings
                WHERE id_wrapper IN ('.implode(', ', array_map('intval', $to_delete)).')
            ');
        }
    }

    public function getWrapperSettingsFields($id_wrapper = false, $settings_type = 'general')
    {
        $fields = array();
        switch ($settings_type) {
            case 'general':
                $fields = array(
                    'custom_class' => array(
                        'display_name'  => $this->l('Wrapper class'),
                        'value' => '',
                        'validate' => 'isLabel',
                        'type'  => 'text',
                    ),
                    'display_type' => array(
                        'display_name'  => $this->l('Display type'),
                        'value' => 1,
                        'validate' => 'isInt',
                        'type'  => 'select',
                        'options' => array(
                            1 => $this->l('Regular'),
                            2 => $this->l('Carousel'),
                            3 => $this->l('Random banner')
                        ),
                        'input_class' => 'display-type',
                    ),
                );
                break;
            case 'carousel':
                $fields = array(
                    'p' => array(
                        'display_name'  => $this->l('Pagination'),
                        'value' => 0,
                        'type'  => 'switcher',
                    ),
                    'n' => array(
                        'display_name'  => $this->l('Navigation arrows'),
                        'value' => 1,
                        'type'  => 'select',
                        'options' => array(
                            0 => $this->l('Hide'),
                            1 => $this->l('Show'),
                            2 => $this->l('Show on hover')
                        ),
                    ),
                    'a' => array(
                        'display_name'  => $this->l('Autoplay'),
                        'value' => 1,
                        'type'  => 'switcher',
                    ),
                    'ah' => array(
                        'display_name'  => $this->l('Pause autoplay on hover'),
                        'value' => 1,
                        'type'  => 'switcher',
                    ),
                    'ps' => array(
                        'display_name'  => $this->l('Autoplay interval (ms)'),
                        'tooltip'  => $this->l('Time (in ms) between each auto transition'),
                        'value' => 4000,
                        'type'  => 'text',
                    ),
                    's' => array(
                        'display_name'  => $this->l('Animation speed'),
                        'value' => 250,
                        'type'  => 'text',
                    ),
                    'l' => array(
                        'display_name'  => $this->l('Loop'),
                        'value' => 1,
                        'type'  => 'switcher',
                    ),
                    't' => array(
                        'display_name'  => $this->l('Ticker mode'),
                        'value' => 0,
                        'type'  => 'switcher',
                    ),
                    'm' => array(
                        'display_name'  => $this->l('Slides moved per transition'),
                        'tooltip'  => $this->l('Set 0 to move all visible slides'),
                        'value' => 1,
                        'type'  => 'text',
                    ),
                    'i' => array(
                        'display_name'  => $this->l('Visible items (default)'),
                        'value' => 5,
                        'type'  => 'text',
                    ),
                );
                $resolutions = array(1200 => 4, 992 => 3, 768 => 2, 480 => 1);
                foreach ($resolutions as $res => $num) {
                    $fields['i_'.$res] = array(
                        'display_name'  => sprintf($this->l('Visible items on displays < %spx'), $res),
                        'value' => $num,
                        'type'  => 'text',
                    );
                }
                foreach ($fields as &$f) {
                    $f['validate'] = 'isInt';
                }
                break;
        }
        if ($id_wrapper) {
            $saved_data = $this->db->getValue('
                SELECT `'.bQSQL($settings_type).'` FROM '._DB_PREFIX_.'cb_wrapper_settings
                WHERE id_wrapper = '.(int)$id_wrapper.'
            ');
            $saved_data = Tools::jsonDecode($saved_data, true);
            foreach (array_keys($fields) as $name) {
                if (isset($saved_data[$name])) {
                    $fields[$name]['value'] = $saved_data[$name];
                }
            }
        }
        return $fields;
    }

    public function ajaxSaveWrapperSettings()
    {
        $id_wrapper = Tools::getValue('id_wrapper');
        $save_single_value = Tools::getValue('save_single_value');
        $settings_type = Tools::getValue('settings_type');
        $fields = $this->getWrapperSettingsFields($id_wrapper, $settings_type);
        $data_to_save = array();
        foreach ($fields as $name => $field) {
            if (!$save_single_value || $name == $save_single_value) {
                if (Tools::isSubmit($name)) {
                    $value = Tools::getValue($name);
                    $validate = $field['validate'];
                    if (Validate::$validate($value)) {
                        $field['value'] = $value;
                    } else {
                        $txt = sprintf($this->l('Incorrect value for "%s"'), $field['display_name']);
                        $this->throwError($txt);
                    }
                }
            }
            $data_to_save[$name] = $field['value'];
        }
        $ret = array(
            'saved' => $this->saveWrapperSettings($id_wrapper, $data_to_save, $settings_type),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function saveWrapperSettings($id_wrapper, $settings, $settings_type = 'settings')
    {
        if (!Validate::isString($settings)) {
            $settings = Tools::jsonEncode($settings);
        }
        $saved = $this->db->execute('
            INSERT INTO '._DB_PREFIX_.'cb_wrapper_settings (`id_wrapper`, `'.bQSQL($settings_type).'`)
            VALUES ('.(int)$id_wrapper.', \''.pSQL($settings).'\')
            ON DUPLICATE KEY UPDATE
            `'.bQSQL($settings_type).'` = VALUES(`'.bQSQL($settings_type).'`)
        ');
        return $saved;
    }

    public function ajaxAddBanner()
    {
        $ret = array('banner_form_html' => $this->callBannerForm(0));
        exit(Tools::jsonEncode($ret));
    }

    public function ajaxCopyToAnotherHook()
    {
        $id_banner = Tools::getValue('id_banner');
        $to_hook = Tools::getValue('to_hook');
        if (!$id_banner || !$to_hook) {
            $this->throwError($this->l('Error'));
        }
        $delete_original = Tools::getValue('delete_original');
        $append_to_wrapper_id = $this->db->getValue('
            SELECT id_wrapper FROM '._DB_PREFIX_.'custombanners
            WHERE hook_name = \''.pSQL($to_hook).'\'
            ORDER BY position DESC
        ');
        if (!$append_to_wrapper_id) {
            $append_to_wrapper_id = $this->addWrapper();
        }
        $new_banner_id = $this->copyToAnotherHook($id_banner, $to_hook, $append_to_wrapper_id, $delete_original);
        $ret = array(
            'append_to_wrapper_id' => $append_to_wrapper_id,
            'new_wrapper_form' => $this->callWrapperForm($append_to_wrapper_id),
            'new_banner_form' => $new_banner_id ? $this->callBannerForm($new_banner_id) : false,
            'reponseText' => isset($this->response_text) ? $this->response_text :  $this->l('Failed'),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function copyToAnotherHook($id_banner, $to_hook, $new_wrapper_id, $delete_original = false)
    {
        $banner_shop_lang = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'custombanners WHERE id_banner = '.(int)$id_banner.'
        ');
        $new_id = $this->getNewId();
        $position = $this->getNextPosition($to_hook);
        $to_insert = array();
        foreach ($banner_shop_lang as $bsl) {
            $bsl['id_banner'] = $new_id;
            $bsl['hook_name'] = $to_hook;
            $bsl['position'] = $position;
            $bsl['id_wrapper'] = $new_wrapper_id;
            $content = Tools::jsonDecode($bsl['content'], true);
            if (isset($content['img']) && $content['img']) {
                $ext = pathinfo($content['img'], PATHINFO_EXTENSION);
                $new_img_name = $this->getNewFilename().'.'.$ext;
                Tools::copy($this->banners_dir_local.$content['img'], $this->banners_dir_local.$new_img_name);
                $content['img'] = $new_img_name;
            }
            $bsl['content'] = Tools::jsonEncode($content);
            foreach ($bsl as &$b) {
                $b = pSQL($b, true);
            }
            $to_insert[] = '(\''.implode('\', \'', $bsl).'\')';
        }
        if ($to_insert) {
            $copied = $this->db->execute('
                INSERT INTO '._DB_PREFIX_.'custombanners
                VALUES '.implode(', ', $to_insert).'
            ');
        } else {
            $copied = false;
        }

        if ($copied) {
            $this->response_text = sprintf($this->l('Copied to %s'), $to_hook);
            foreach ($this->shop_ids as $id_shop) {
                if (!$this->isRegisteredInHookConsideringShop($to_hook, $id_shop)) {
                    $this->registerHook($to_hook, array($id_shop));
                }
            }
            if ($delete_original) {
                $copied &= $this->deleteBanner($id_banner);
                $this->response_text = sprintf($this->l('Moved to %s'), $to_hook);
            }
        } else {
            $new_id = false;
        }
        return $new_id;
    }

    public function ajaxBulkAction()
    {
        $action = Tools::getValue('act');
        $banner_ids = Tools::getValue('ids');
        if ($action == 'deleteAll') {
            $banners = $this->db->executeS('
                SELECT id_banner FROM '._DB_PREFIX_.'custombanners
                WHERE id_shop IN ('.implode(', ', array_map('intval', $this->shop_ids)).')
                GROUP BY id_banner
            ');
            $banner_ids = array();
            foreach ($banners as $b) {
                $banner_ids[] = $b['id_banner'];
            }
        }
        if (!$banner_ids && $action != 'deleteAll') {
            $this->throwError($this->l('Please make a selection'));
        }
        $success = true;
        $this->response_text = $this->saved_txt;
        switch ($action) {
            case 'enable':
            case 'disable':
                $active = $action == 'enable';
                $success &= $this->db->execute('
                    UPDATE '._DB_PREFIX_.'custombanners SET active = '.(int)$active.'
                    WHERE id_banner IN ('.implode(', ', array_map('intval', $banner_ids)).')
                    AND id_shop IN ('.implode(', ', array_map('intval', $this->shop_ids)).')
                ');
                break;
            case 'move':
            case 'copy':
                $additional_params = Tools::getValue('additionalParams');
                if (isset($additional_params['to_hook'])) {
                    $to_hook = $additional_params['to_hook'];
                    $delete_original = $action == 'move';

                    $wrapper_id = $this->db->getValue('
                        SELECT id_wrapper FROM '._DB_PREFIX_.'custombanners
                        WHERE hook_name = \''.pSQL($to_hook).'\'
                        ORDER BY position DESC
                    ');
                    if (!$wrapper_id) {
                        $wrapper_id = $this->addWrapper();
                    }

                    $html = '';
                    foreach ($banner_ids as $id_banner) {
                        if ($new_id = $this->copyToAnotherHook($id_banner, $to_hook, $wrapper_id, $delete_original)) {
                            $html .= $this->callBannerForm($new_id);
                        } else {
                            $this->response_text = $this->failed_txt;
                            $success = false;
                            break;
                        }
                    }
                }
                break;
            case 'delete':
            case 'deleteAll':
                foreach ($banner_ids as $id_banner) {
                    $success &= $this->deleteBanner($id_banner);
                }
                break;
        }
        $ret = array(
            'success' => $success,
            'reponseText' => $this->response_text,
            'responseHTML' => isset($html) ? $html : false,
            'append_to_wrapper_id' => isset($wrapper_id) ? $wrapper_id : false,
            'new_wrapper_form' => isset($wrapper_id) ? $this->callWrapperForm($wrapper_id) : false,
        );
        exit(Tools::jsonEncode($ret));
    }

    public function ajaxSaveBannerData()
    {
        $data_multilang = Tools::getValue('banner_data');
        if (!$data_multilang) {
            $this->throwError($this->l('Please fill in at least one field'));
        }
        $saved_id = $this->saveBannerData($data_multilang);
        $ret = array(
            'banner_form_html' => $saved_id ? $this->callBannerForm($saved_id) : false,
        );
        exit(Tools::jsonEncode($ret));
    }

    /**
    * custombanners table has a composite KEY that cannot be autoincremented
    **/
    public function getNewId()
    {
        $max_id = $this->db->getValue('SELECT MAX(id_banner) FROM '._DB_PREFIX_.'custombanners');
        return (int)$max_id + 1;
    }

    public function getNextPosition($hook_name)
    {
        $position = $this->db->getValue('
            SELECT MAX(position) FROM '._DB_PREFIX_.'custombanners WHERE hook_name = \''.pSQL($hook_name).'\'
        ');
        return (int)$position + 1;
    }

    public function saveBannerData($data_multilang)
    {
        $id_banner = $keep_positions = Tools::getValue('id_banner');
        $hook_name = Tools::getValue('hook_name');
        $id_wrapper = Tools::getValue('id_wrapper');
        $active = Tools::getValue('active');
        $position = Tools::getValue('position');
        if (!$id_banner) {
            $id_banner = $this->getNewId();
        }

        $lang_shop_rows = array();
        $already_uploaded = array();
        $imgs_to_delete = Tools::getValue('imgs_to_delete', array());

        $this->validateUploadedImageSizes($data_multilang);

        foreach ($this->shop_ids as $id_shop) {
            foreach ($data_multilang as $id_lang => $content) {
                $id_lang_source = Tools::getValue('lang_source', $id_lang);
                $content = $data_multilang[$id_lang_source];
                if (isset($content['link']) &&
                    $content['link']['type'] != 'custom' &&
                    !(int)$content['link']['href']) {
                    $lang_name = Language::getIsoById($id_lang);
                    $error = $this->l('Please specify a proper ID for the link field (%s)');
                    if (Tools::isSubmit('ajax')) {
                        $this->throwError(sprintf($error, $lang_name));
                    } else {
                        unset($content['link']);
                    }
                }

                if (isset($content['exceptions'])) {
                    foreach ($content['exceptions'] as &$exc) {
                        $exc['ids'] = $exc['type'] ? $this->formatIDs($exc['ids']) : '';
                    }
                }

                // TODO: optimize saving scheduled publication fields.
                // See comments "scheduled publication" in this file
                $publish_from = (!empty($content['publish_from']) && Validate::isDate($content['publish_from']))
                ? $content['publish_from'] : '';
                $publish_to = (!empty($content['publish_to']) && Validate::isDate($content['publish_to']))
                ? $content['publish_to'] : '';
                unset($content['publish_from']);
                unset($content['publish_to']);

                foreach (array('img', 'img_hover') as $img_field) {
                    if (isset($_FILES['banner_'.$img_field.'_'.$id_lang_source])) {
                        if (isset($already_uploaded[$img_field][$id_lang_source])) {
                            $img_name = $already_uploaded[$img_field][$id_lang_source];
                        } else {
                            $file = $_FILES['banner_'.$img_field.'_'.$id_lang_source];
                            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                            $img_name = $this->getNewFilename().'.'.$ext;
                            $this->saveSubmittedBannerImage($file, $img_name);
                            $content[$img_field] = $img_name;
                            $already_uploaded[$img_field][$id_lang_source] = $img_name;
                        }
                        if ($data_multilang[$id_lang][$img_field]) {
                            $imgs_to_delete[$data_multilang[$id_lang][$img_field]] = 1;
                        }
                        $content[$img_field] = $img_name;
                    }
                }

                $content = Tools::jsonEncode($content);

                $row = '('.(int)$id_banner;
                $row .= ', '.(int)$id_shop;
                $row .= ', '.(int)$id_lang;
                $row .= ', \''.pSQL($hook_name).'\'';
                $row .= ', '.(int)$id_wrapper;
                $row .= ', '.(int)$position;
                $row .= ', '.(int)$active;
                $row .= ', \''.pSQL($publish_from).'\'';
                $row .= ', \''.pSQL($publish_to).'\'';
                $row .= ', \''.pSQL($content, true).'\')';
                $lang_shop_rows[] = $row;
            }
        }

        $insert_query = '
            INSERT INTO '._DB_PREFIX_.'custombanners
            VALUES '.implode(', ', $lang_shop_rows).'
            ON DUPLICATE KEY UPDATE
            content = VALUES(content),
            publish_from = VALUES(publish_from),
            publish_to = VALUES(publish_to)
        ';

        if ($this->db->execute($insert_query)) {
            foreach (array_keys($imgs_to_delete) as $img_name) {
                $banner_shop_lang = $this->db->executeS('
                    SELECT content FROM '._DB_PREFIX_.'custombanners WHERE id_banner = '.(int)$id_banner.'
                ');
                $image_is_used = false;
                foreach ($banner_shop_lang as $bsl) {
                    if (!$bsl['content']) {
                        continue;
                    }
                    $content = Tools::jsonDecode($bsl['content'], true);
                    foreach (array('img', 'img_hover') as $img_field) {
                        if (isset($content[$img_field]) && $content[$img_field] == $img_name) {
                            $image_is_used = true;
                            break 2;
                        }
                    }
                }
                if (!$image_is_used) {
                    unlink($this->banners_dir_local.$img_name);
                }
            }
            foreach ($this->shop_ids as $id_shop) {
                if (!$this->isRegisteredInHookConsideringShop($hook_name, $id_shop)) {
                    $this->registerHook($hook_name, array($id_shop));
                }
            }
            if (!$keep_positions) {
                $this->db->execute('
                    UPDATE '._DB_PREFIX_.'custombanners
                    SET position = position + 1
                    WHERE hook_name = \''.pSQL($hook_name).'\'
                ');
            }
        } else {
            $id_banner = false;
        }

        return $id_banner;
    }

    public function validateUploadedImageSizes($multilang_content)
    {
        foreach ($multilang_content as $id_lang => $content) {
            if (isset($_FILES['banner_img_hover_'.$id_lang])) {
                $hover_image_size = $this->getImageSize($id_lang, 'img_hover', $content);
                $main_image_size = $this->getImageSize($id_lang, 'img', $content);
                if ($hover_image_size != $main_image_size) {
                    $txt = $this->l('Hover image (%s) is supposed to be same size as main image: %s');
                    $this->throwError(sprintf($txt, Language::getIsoById($id_lang), $main_image_size));
                }
            }
        }
    }

    public function getImageSize($id_lang, $type, $content, $check_saved_path = true)
    {
        if (isset($_FILES['banner_'.$type.'_'.$id_lang])) {
            $img_size = getimagesize($_FILES['banner_'.$type.'_'.$id_lang]['tmp_name']);
        } elseif ($check_saved_path && isset($content[$type]) && $this->getBannerSrc($content[$type])) {
            $img_size = getimagesize($this->banners_dir_local.$content[$type]);
        } else {
            $img_size = array(0,0);
        }
        return $img_size[0].'x'.$img_size[1];
    }


    public function isRegisteredInHookConsideringShop($hook_name, $id_shop)
    {
        $sql = 'SELECT COUNT(*)
            FROM '._DB_PREFIX_.'hook_module hm
            LEFT JOIN '._DB_PREFIX_.'hook h ON (h.id_hook = hm.id_hook)
            WHERE h.name = \''.pSQL($hook_name).'\'
            AND hm.id_shop = '.(int)$id_shop.' AND hm.id_module = '.(int)$this->id;
        return $this->db->getValue($sql);
    }

    public $already_uploaded = array();

    public function saveSubmittedBannerImage($file, $banner_name)
    {
        if (!isset($file['tmp_name']) ||
            empty($file['tmp_name']) ||
            isset($this->already_uploaded[$file['tmp_name']])) {
            return;
        }

        $max_size = 10485760; // 10 mb

        // Check image validity
        if ($error = ImageManager::validateUpload($file, Tools::getMaxUploadSize($max_size))) {
            $this->errors[] = $error;
        }

        // move file directly, without any resizing for preserving max quality
        if (!$this->errors && !move_uploaded_file($file['tmp_name'], $this->banners_dir_local.$banner_name)) {
            $this->errors[] = Tools::displayError('An error occurred while uploading the image.');
        }

        if ($this->errors) {
            $this->throwError($this->errors);
        }
        $this->already_uploaded[$file['tmp_name']] = 1;
        return true;
    }

    public function getNewFilename()
    {
        do {
            $filename = sha1(microtime());
        } while (file_exists($this->banners_dir_local.$filename));
        return $filename;
    }

    public function ajaxToggleBannerParam()
    {
        $id_banner = Tools::getValue('id_banner');
        $param_name = Tools::getValue('param_name');
        $param_value = Tools::getValue('param_value');
        if (!$param_name) {
            $this->throwError($this->l('Parameters not provided correctly'));
        }

        $update_query = '
            UPDATE '._DB_PREFIX_.'custombanners
            SET '.pSQL($param_name).' = '.(int)$param_value.'
            WHERE id_banner = '.(int)$id_banner.'
            AND id_shop IN ('.implode(', ', array_map('intval', $this->shop_ids)).')
        ';
        if (!$this->db->execute($update_query)) {
            $this->throwError($this->l('Not saved'));
        }
        $ret = array('success' => 1);
        exit(Tools::jsonEncode($ret));
    }

    public function ajaxDeleteBanner()
    {
        $id_banner = Tools::getValue('id_banner');
        $deleted = $this->deleteBanner($id_banner);
        $result = array (
            'deleted' => $deleted,
            'responseText' => isset($this->response_text)? $this->response_text : $this->failed_txt,
        );
        exit(Tools::jsonEncode($result));
    }

    public function deleteBanner($id_banner)
    {
        $banner_shop_lang = $this->db->executeS('
            SELECT id_shop, content FROM '._DB_PREFIX_.'custombanners
            WHERE id_banner = '.(int)$id_banner.'
        ');
        $hook_name = $this->db->getValue('
            SELECT hook_name FROM '._DB_PREFIX_.'custombanners
            WHERE id_banner = '.(int)$id_banner.'
        ');
        $imgs_to_remove = array();
        $imgs_to_keep = array();
        foreach ($banner_shop_lang as $bsl) {
            $content = Tools::jsonDecode($bsl['content'], true);
            if (!isset($content['img'])) {
                continue;
            }
            if (in_array($bsl['id_shop'], $this->shop_ids)) {
                $imgs_to_remove[$content['img']] = $content['img'];
            } else {
                $imgs_to_keep[$content['img']] = $content['img'];
            }
        }
        $imgs_to_remove = array_diff($imgs_to_remove, $imgs_to_keep);
        $deleted = $this->db->execute('
            DELETE FROM '._DB_PREFIX_.'custombanners
            WHERE id_banner = '.(int)$id_banner.'
            AND id_shop IN ('.implode(', ', array_map('intval', $this->shop_ids)).')
        ');
        if ($deleted) {
            $this->response_text = $this->l('Deleted');
            foreach ($imgs_to_remove as $img_name) {
                unlink($this->banners_dir_local.$img_name);
            }
            foreach ($this->shop_ids as $id_shop) {
                $hook_is_used = $this->db->getValue('
                    SELECT hook_name FROM '._DB_PREFIX_.'custombanners
                    WHERE hook_name = \''.pSQL($hook_name).'\' AND id_shop = '.(int)$id_shop.'
                ');
                if (!$hook_is_used) {
                    $this->unregisterHook(Hook::getIdByName($hook_name), array($id_shop));
                }
            }
        }
        return $deleted;
    }

    public function ajaxUpdatePositionsInHook()
    {
        $ordered_ids = Tools::getValue('ordered_ids');
        if (!$ordered_ids) {
            $this->throwError($this->failed_txt);
        }

        if (Tools::getValue('moved_element_is_banner')) {
            $id_wrapper = Tools::getValue('moved_element_wrapper_id');
            $id_banner = Tools::getValue('moved_element_id');
            if ($id_wrapper && $id_banner) {
                $this->db->execute('
                    UPDATE '._DB_PREFIX_.'custombanners
                    SET id_wrapper = '.(int)$id_wrapper.'
                    WHERE id_banner = '.(int)$id_banner.'
                    AND id_shop IN ('.pSQL(implode(', ', $this->shop_ids)).')
                ');
            }
        }

        $languages = Language::getLanguages(false);
        $update_rows = array();
        foreach ($this->shop_ids as $id_shop) {
            foreach ($languages as $lang) {
                foreach ($ordered_ids as $k => $id_banner) {
                    $pos = $k + 1;
                    $row = (int)$id_banner.', '.(int)$id_shop.', '.(int)$lang['id_lang'].', '.(int)$pos;
                    $update_rows[] = '('.$row.')';
                }
            }
        }

        // no need to specify hook here, because rows contain only banners from one hook
        $update_query = '
            INSERT INTO '._DB_PREFIX_.'custombanners (id_banner, id_shop, id_lang, position)
            VALUES '.implode(', ', $update_rows).'
            ON DUPLICATE KEY UPDATE
            position = VALUES(position)
        ';
        $ret = array();
        if ($this->db->execute($update_query)) {
            $ret['successText'] = $this->l('Saved');
        }
        exit(Tools::jsonEncode($ret));
    }

    public function throwError($errors)
    {
        if (!is_array($errors)) {
            $errors = array($errors);
        }
        $ret = array('errors' => utf8_encode($this->displayError(implode('<br>', $errors))));
        die(Tools::jsonEncode($ret));
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

    public function getBannersInHook($hook_name)
    {
        $current_controller = $this->getFullControllerName();
        $current_id = Tools::getValue('id_'.$current_controller);
        $hook_settings = $this->db->getRow('
            SELECT * FROM '._DB_PREFIX_.'cb_hook_settings
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

        $now = date('Y-m-d H:i:s');
        $banners_db = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'custombanners
            WHERE hook_name = \''.pSQL($hook_name).'\'
            AND id_shop = '.(int)$this->context->shop->id.'
            AND id_lang = '.(int)$this->context->language->id.'
            AND active = 1
            AND publish_from <= \''.pSQL($now).'\'
            AND (publish_to = \''.pSQL($this->empty_date).'\' OR publish_to >= \''.pSQL($now).'\')
            ORDER BY position ASC
        ');

        $sorted = $wrappers_with_random_banners = array();
        foreach ($banners_db as $b) {
            $content = Tools::jsonDecode($b['content'], true);
            if (!$content) {
                continue;
            }
            if (isset($content['exceptions'])) {
                if ($allowed_controller = str_replace('_all', '', $content['exceptions']['page']['type'])) {
                    if ($allowed_controller != $current_controller) {
                        continue;
                    }
                    $ids = $this->formatIDs($content['exceptions']['page']['ids'], false);
                    $type = $allowed_controller != $content['exceptions']['page']['type'] ? 1 : 2;
                    if (($type == 1 && isset($ids[$current_id])) || ($type == 2 && !isset($ids[$current_id]))) {
                        continue;
                    }
                }
                if ($customer_exceptions = $content['exceptions']['customer']['type']) {
                    $allowed_ids = $this->formatIDs($content['exceptions']['customer']['ids'], false);
                    if ($customer_exceptions == 'customer' && !isset($allowed_ids[$this->context->customer->id])) {
                        continue;
                    } elseif ($customer_exceptions == 'group' &&
                        !array_intersect($this->context->customer->getGroups(), $allowed_ids)) {
                        continue;
                    }
                }
            }
            foreach (array('img', 'img_hover') as $img_field) {
                if (isset($content[$img_field])) {
                    $content[$img_field] = $this->getBannerSrc($content[$img_field]);
                }
            }
            if (isset($content['link']['type']) && $content['link']['type'] != 'custom') {
                $get_link_method = 'get'.$content['link']['type'].'Link';
                $id_resource = $content['link']['href'];
                if ((int)$id_resource) {
                    $content['link']['href'] = $this->context->link->$get_link_method($id_resource);
                } else {
                    unset($content['link']);
                }
            }
            if (!empty($content['link']) && !empty($content['html'])) {
                $content['html'] = str_replace('{link}', $content['link']['href'], $content['html']);
            }
            $sorted[$b['id_wrapper']]['banners'][$b['id_banner']] = $content;
            if (empty($sorted[$b['id_wrapper']]['settings'])) {
                $settings = $this->getWrapperSettings($b['id_wrapper']);
                $sorted[$b['id_wrapper']]['settings'] = $settings;
                if ($settings['general']['display_type'] == 3) {
                    $wrappers_with_random_banners[$b['id_wrapper']] = $b['id_wrapper'];
                }
            }
        }
        foreach ($wrappers_with_random_banners as $id_wrapper) {
            if (isset($sorted[$id_wrapper]['banners'])) {
                $banners = $sorted[$id_wrapper]['banners'];
                $random_key = array_rand($banners);
                $sorted[$id_wrapper]['banners'] = array($random_key => $banners[$random_key]);
            }
        }
        return $sorted;
    }

    public function getWrapperSettings($id_wrapper)
    {
        $settings = $this->db->getRow('
            SELECT general, carousel
            FROM '._DB_PREFIX_.'cb_wrapper_settings
            WHERE id_wrapper = '.(int)$id_wrapper.'
        ');
        if (!empty($settings)) {
            $settings['general'] = Tools::jsonDecode($settings['general'], true);
            // carousel settings stay encoded. If empty, fill default values
            if (empty($settings['carousel']) && $settings['general']['display_type'] == 2) {
                $default_settings = array(
                    'p' => 0,
                    'n' => 2,
                    'a' => 1,
                    's' => 250,
                    'm' => 1,
                    'i' => 5,
                    'i_1200' => 4,
                    'i_992' => 3,
                    'i_768' => 2,
                    'i_480' => 1,
                );
                $settings['carousel'] = Tools::jsonEncode($default_settings);
            }
        }
        return $settings;
    }

    public function addJS($file, $custom_path = '')
    {
        $path = ($custom_path ? $custom_path : 'modules/'.$this->name.'/views/js/').$file;
        if ($this->is_17) {
            $params = array('server' => $custom_path ? 'remote' : 'local');
            $this->context->controller->registerJavascript(sha1($path), $path, $params);
        } else {
            $path = $custom_path ? $path : __PS_BASE_URI__.$path;
            // $path .= '?'.microtime('true'); // debug
            $this->context->controller->addJS($path);
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
        }
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addJqueryPlugin('bxslider');
        $this->addCSS('front.css');
        $this->addJS('front.js');
        $this->addCSS('custom/shop'.$this->context->shop->id.'.css');
        $this->addJS('custom/shop'.$this->context->shop->id.'.js');
        Media::addJsDef(array(
            'isMobile' =>$this->isMobile(),
        ));
    }

    public function isMobile()
    {
        if (!isset($this->is_mobile)) {
            if (is_callable(array($this->context, 'isMobile'))) {
                $this->is_mobile = $this->context->isMobile();
            } else {
                $this->is_mobile = $this->context->getMobileDetect()->isMobile();
            }
        }
        return $this->is_mobile;
    }

    // public function __call($method, $arguments)
    // {
    //     $available_hooks = $this->getAvailableHooks();
    //     $hook_name = ltrim($method, 'hook');
    //     if (isset($available_hooks[$hook_name])) {
    //         $this->context->smarty->assign(array(
    //             'banners' => $this->getBannersInHook($hook_name),
    //             'hook_name' => $hook_name,
    //         ));
    //         return $this->display($this->local_path, 'banners.tpl');
    //     }
    // }

    public function displayNativeHook($hook_name)
    {
        $this->context->smarty->assign(array(
            'banners' => $this->getBannersInHook($hook_name),
            'hook_name' => $hook_name,
        ));
        return $this->display($this->local_path, 'banners.tpl');
    }

    public function hookDisplayBanner()
    {
        return $this->displayNativeHook('displayBanner');
    }

    public function hookDisplayBeforeCarrier()
    {
        return $this->displayNativeHook('displayBeforeCarrier');
    }

    public function hookDisplayBeforePayment()
    {
        return $this->displayNativeHook('displayBeforePayment');
    }

    public function hookDisplayCarrierList()
    {
        return $this->displayNativeHook('displayCarrierList');
    }

    public function hookDisplayCompareExtraInformation()
    {
        return $this->displayNativeHook('displayCompareExtraInformation');
    }

    public function hookDisplayCustomerAccount()
    {
        return $this->displayNativeHook('displayCustomerAccount');
    }

    public function hookDisplayCustomerAccountForm()
    {
        return $this->displayNativeHook('displayCustomerAccountForm');
    }

    public function hookDisplayCustomerAccountFormTop()
    {
        return $this->displayNativeHook('displayCustomerAccountFormTop');
    }

    public function hookDisplayFooter()
    {
        return $this->displayNativeHook('displayFooter');
    }

    public function hookDisplayFooterProduct()
    {
        return $this->displayNativeHook('displayFooterProduct');
    }

    public function hookDisplayHome()
    {
        return $this->displayNativeHook('displayHome');
    }

    public function hookDisplayHomeTab()
    {
        return $this->displayNativeHook('displayHomeTab');
    }

    public function hookDisplayHomeTabContent()
    {
        return $this->displayNativeHook('displayHomeTabContent');
    }

    public function hookDisplayInvoice()
    {
        return $this->displayNativeHook('displayInvoice');
    }

    public function hookDisplayLeftColumn()
    {
        return $this->displayNativeHook('displayLeftColumn');
    }

    public function hookDisplayLeftColumnProduct()
    {
        return $this->displayNativeHook('displayLeftColumnProduct');
    }

    public function hookDisplayMaintenance()
    {
        return $this->displayNativeHook('displayMaintenance');
    }

    public function hookDisplayMobileTopSiteMap()
    {
        return $this->displayNativeHook('displayMobileTopSiteMap');
    }

    public function hookDisplayMyAccountBlock()
    {
        return $this->displayNativeHook('displayMyAccountBlock');
    }

    public function hookDisplayMyAccountBlockfooter()
    {
        return $this->displayNativeHook('displayMyAccountBlockfooter');
    }

    public function hookDisplayNav()
    {
        return $this->displayNativeHook('displayNav');
    }

    public function hookDisplayOrderConfirmation()
    {
        return $this->displayNativeHook('displayOrderConfirmation');
    }

    public function hookDisplayOrderDetail()
    {
        return $this->displayNativeHook('displayOrderDetail');
    }

    public function hookDisplayPayment()
    {
        return $this->displayNativeHook('displayPayment');
    }

    public function hookDisplayPaymentReturn()
    {
        return $this->displayNativeHook('displayPaymentReturn');
    }

    public function hookDisplayPaymentTop()
    {
        return $this->displayNativeHook('displayPaymentTop');
    }

    public function hookDisplayPDFInvoice()
    {
        return $this->displayNativeHook('displayPDFInvoice');
    }

    public function hookDisplayProductButtons()
    {
        return $this->displayNativeHook('displayProductButtons');
    }

    public function hookDisplayProductComparison()
    {
        return $this->displayNativeHook('displayProductComparison');
    }

    public function hookDisplayProductListReviews()
    {
        return $this->displayNativeHook('displayProductListReviews');
    }

    public function hookDisplayProductTab()
    {
        return $this->displayNativeHook('displayProductTab');
    }

    public function hookDisplayProductTabContent()
    {
        return $this->displayNativeHook('displayProductTabContent');
    }

    public function hookDisplayRightColumn()
    {
        return $this->displayNativeHook('displayRightColumn');
    }

    public function hookDisplayRightColumnProduct()
    {
        return $this->displayNativeHook('displayRightColumnProduct');
    }

    public function hookDisplayShoppingCart()
    {
        return $this->displayNativeHook('displayShoppingCart');
    }

    public function hookDisplayShoppingCartFooter()
    {
        return $this->displayNativeHook('displayShoppingCartFooter');
    }

    public function hookDisplayTop()
    {
        return $this->displayNativeHook('displayTop');
    }

    public function hookDisplayTopColumn()
    {
        return $this->displayNativeHook('displayTopColumn');
    }

    public function hookDisplayCustomBanners1()
    {
        return $this->displayNativeHook('displayCustomBanners1');
    }

    public function hookDisplayCustomBanners2()
    {
        return $this->displayNativeHook('displayCustomBanners2');
    }

    public function hookDisplayCustomBanners3()
    {
        return $this->displayNativeHook('displayCustomBanners3');
    }

    public function hookDisplayCustomBanners4()
    {
        return $this->displayNativeHook('displayCustomBanners4');
    }

    public function hookDisplayCustomBanners5()
    {
        return $this->displayNativeHook('displayCustomBanners5');
    }

    public function hookDisplayCustomBanners6()
    {
        return $this->displayNativeHook('displayCustomBanners6');
    }

    public function hookDisplayCustomBanners7()
    {
        return $this->displayNativeHook('displayCustomBanners7');
    }

    /*
    * since PS 1.7
    */
    public function hookDisplayWrapperTop()
    {
        return $this->displayNativeHook('displayWrapperTop');
    }

    public function hookDisplayNav1()
    {
        return $this->displayNativeHook('displayNav1');
    }

    public function hookDisplayNav2()
    {
        return $this->displayNativeHook('displayNav2');
    }

    public function hookDisplayNavFullWidth()
    {
        return $this->displayNativeHook('displayNavFullWidth');
    }

    public function hookDisplayFooterBefore()
    {
        return $this->displayNativeHook('displayFooterBefore');
    }

    public function hookDisplayFooterAfter()
    {
        return $this->displayNativeHook('displayFooterAfter');
    }
}
