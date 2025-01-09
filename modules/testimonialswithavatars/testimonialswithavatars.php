<?php
/**
* 2007-2019 Amazzing
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
*
*  @author    Amazzing <mail@amazzing.ru>
*  @copyright 2007-2019 Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/

class TestimonialsWithAvatars extends Module
{
    public $errors = array();

    public function __construct()
    {
        if (!defined('_PS_VERSION_')) {
            exit;
        }
        $this->name = 'testimonialswithavatars';
        $this->tab = 'front_office_features';
        $this->version = '2.5.0';
        $this->author = 'Amazzing';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->module_key = 'ddeb59fa8a4bb313b2e676fb25ad5f58';

        parent::__construct();

        $this->displayName = $this->l('Testimonials with avatars');
        $this->description = $this->l('Testimonials (customer reviews) with uploadable avatars and rating.');

        $this->general_settings = $this->getSettings('general');
        $this->controller_page = 'module-testimonialswithavatars-testimonials';
        $this->db = Db::getInstance();
        $this->is_17 = Tools::substr(_PS_VERSION_, 0, 3) === '1.7';
    }

    public function install()
    {
        if (isset($this->reserve_config)) {
            foreach ($this->reserve_config as $id_shop => $config_data) {
                foreach ($config_data as $key => $value) {
                    Configuration::updateValue($key, $value, false, null, $id_shop);
                }
            }
        }
        if (!parent::install() ||
            !$this->prepareDatabase() ||
            !$this->prepareDemoContent()) {
            return false;
        }
        return true;
    }

    public function prepareDatabase()
    {
        $sql = array();
        $sql[] = '
            CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'testimonialswithavatars (
            id_post int(10) unsigned NOT NULL AUTO_INCREMENT,
            id_shop int(10) NOT NULL,
            position int(10) NOT NULL,
            avatar varchar(128) DEFAULT \'0\',
            customer_name varchar(128) DEFAULT NULL,
            subject varchar(128) DEFAULT NULL,
            rating int(2) DEFAULT \'5\',
            content text,
            active tinyint(1) unsigned NOT NULL DEFAULT \'0\',
            visitor_ip varchar(128) NOT NULL,
            date_add datetime NOT NULL,
            PRIMARY KEY (id_post),
            KEY visitor_ip (visitor_ip),
            KEY avatar (avatar)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';
        $this->runSql($sql);
        $this->registerHook(array('displayHeader', 'displayBackOfficeHeader'));
        $this->saveAllSettings();
        return true;
    }

    public function saveAllSettings()
    {
        if (Shop::isFeatureActive()) {
            $original_shop_context = Shop::getContext();
            $original_shop_context_id = null;
            if ($original_shop_context == Shop::CONTEXT_GROUP) {
                $original_shop_context_id = $this->context->shop->id_shop_group;
            } elseif ($original_shop_context == Shop::CONTEXT_SHOP) {
                $original_shop_context_id = $this->context->shop->id;
            }
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        $all_shop_ids = Shop::getShops(false, null, true);
        $basic_types = array('general', 'controller', 'seo');
        foreach ($all_shop_ids as $id_shop) {
            foreach ($basic_types as $type) {
                $this->saveSettings($type, '', array(), $id_shop);
            }
            foreach ($this->getAvailableHooks() as $hook_name) {
                $default_settings = array('active' => $hook_name == 'displayHomeCustom' ? 1 : 0);
                $this->saveSettings('hook', $hook_name, $default_settings, $id_shop);
            }
        }

        if (isset($original_shop_context)) {
            Shop::setContext($original_shop_context, $original_shop_context_id);
        }
    }

    public function prepareDemoContent()
    {
        $post_data = array(
            '1' => array('Smith Vazovsky', 'High for this', 'Typesetting, remainally unchanged.
            It wantly elease of Letraset sheets containing Lorem IpsuIpsum passages hing typeare incl'),
            '2' => array('Pat Libertson', 'Simply Amazing', 'With desktop dolor repellendus.
            Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet
            ut et voluptates repudiandae'),
            '3' => array('John Till', 'Like it very much!', 'ofessen tiadus sum, ally ucnd recently dktop publishtting,
            remainingdus. Pntly with des[img]//tinymce.cachefly.net/4/plugins/emoticons/img/smiley-cool.gif[/img]'),
            '4' => array('Pretty lady', 'Remainally unchanged', 'It wantly Leatrre includus sum sages,
            and more recently with desktop publre inclu ding Aldus sum passages, and more recently
            [u]with desktop puet[/u]'),
            '5' => array('Star Parov', 'So fantastic', 'Tell them who voluptatem sequi nesciunt.
            Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
            sed quia non numquam eius'),
            '6' => array('Feri Vergi', 'What is see is what you get', 'Nulla in ligula ut diam consectetur bibendum.
            Quisque posuere ligula id purus luctus, non pharetra ex semper.'),
        );
        $rows = array();
        $sorted_dates = array();
        foreach (array_keys($post_data) as $k) {
            $sorted_dates[$k] = $this->getRandomDate();
        }
        asort($sorted_dates);
        $position = 0;
        $shop_ids = Shop::getContextListShopID();
        foreach ($shop_ids as $id_shop) {
            foreach ($sorted_dates as $k => $date) {
                $position++;
                $data = $post_data[$k];
                $rows[] = '(\'\', '.(int)$id_shop.', '.(int)$position.', \'a'.(int)$k.'-'.(int)$id_shop.'\',
                \''.pSQL($data[0]).'\', \''.pSQL($data[1]).'\', 5, \''.pSQL($data[2]).'\', 1, \'11.11.111.111\',
                \''.pSQL($date).'\')';
                $source_path = $this->local_path.'views/img/avatars/defaults/a'.$k.'.jpg';
                $dest_path = $this->local_path.'views/img/avatars/a'.$k.'-'.(int)$id_shop.'.jpg';
                Tools::copy($source_path, $dest_path);
            }
        }
        Tools::copy($this->local_path.'views/img/avatars/defaults/0.jpg', $this->local_path.'views/img/avatars/0.jpg');
        $sql = array('
            INSERT INTO '._DB_PREFIX_.'testimonialswithavatars
            VALUES '.implode(', ', $rows).'
        ');
        return $this->runSql($sql);
    }

    public function getRandomDate()
    {
        return date('Y-m-d G:i:s', strtotime('-'.mt_rand(0, 2592000).' seconds'));
    }

    public function getAvailableHooks()
    {
        $hooks = array(
            'displayHome',
            'displayHomeCustom',
            'displayLeftColumn',
            'displayRightColumn',
            'testimonials1',
            'testimonials2',
            'testimonials3',
        );
        return $hooks;
    }

    public function uninstall()
    {
        $shop_ids = Shop::getContextListShopID();
        $all_shop_ids = Shop::getShops(false, null, true);
        $this->deleteAvatarFiles($shop_ids);
        $this->db->execute('
            DELETE FROM '._DB_PREFIX_.'testimonialswithavatars
            WHERE id_shop IN ('.implode(', ', array_map('intval', $shop_ids)).')
        ');
        if (!$this->db->getRow('SELECT * FROM '._DB_PREFIX_.'testimonialswithavatars')) {
            $this->db->execute('DROP TABLE '._DB_PREFIX_.'testimonialswithavatars');
        }

        $config_keys = $this->getAvailableHooks();
        $config_keys[]= 'general';
        $config_keys[]= 'controller';

        // deleteByName erases data from all shops
        // so we prepare a reserve copy for shops out of context and recover it after reset
        $this->reserve_config = array();
        foreach ($all_shop_ids as $id_shop) {
            if (!in_array($id_shop, $shop_ids)) {
                foreach ($config_keys as $key) {
                    $key = 'TWA_SETTINGS_'.Tools::strtoupper($key);
                    $this->reserve_config[$id_shop][$key] = Configuration::get($key, null, null, $id_shop);
                }
            }
        }

        foreach ($config_keys as $key) {
            Configuration::deleteByName('TWA_SETTINGS_'.Tools::strtoupper($key));
        }

        return parent::uninstall();
    }

    public function deleteAvatarFiles($shop_ids)
    {
        $imgs_to_keep = array();
        if ($this->db->executeS('SHOW TABLES LIKE \''._DB_PREFIX_.'testimonialswithavatars\'')) {
            $out_of_context = $this->db->executeS('
                SELECT avatar FROM '._DB_PREFIX_.'testimonialswithavatars
                WHERE id_shop NOT IN ('.implode(', ', array_map('intval', $shop_ids)).')
            ');
            foreach ($out_of_context as $data) {
                $imgs_to_keep[] = $data['avatar'].'.jpg';
            }
        }
        $imgs = glob($this->local_path.'views/img/avatars/*.jpg');
        foreach ($imgs as $img) {
            if (file_exists($img) && !in_array(basename($img), $imgs_to_keep)) {
                unlink($img);
            }
        }
        return true;
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

    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('configure') != $this->name) {
            return;
        }
        $this->context->controller->addJquery();
        $this->context->controller->addJqueryUI('ui.sortable');
        $this->context->controller->addJQueryUI('ui.datetimepicker');
        $this->context->controller->css_files[$this->_path.'views/css/back.css?'.$this->version] = 'all';
        $this->context->controller->js_files[] = $this->_path.'views/js/back.js?'.$this->version;
        $this->context->controller->js_files[] = '//cdn.tiny.cloud/1/ugmu8unckgdhevdhz6c3mfakw8xfkkwb8yy1wp8sitvpkwa9/tinymce/5/tinymce.min.js';
    }

    public function ajaxAction()
    {
        $action = Tools::getValue('ajaxAction');
        $ret = array();
        switch ($action) {
            case 'updatePost':
                $id = $this->getValueAndValidate('id_post', 'isInt');
                $date_add = $this->getValueAndValidate('date_add', 'isDate');
                $ip = $this->getPostIpById($id);
                $this->processPost($id, $date_add, $ip, 'admin');
                break;
            case 'toggleActiveStatus':
                $this->toggleActiveStatus();
                break;
            case 'loadMore':
                $this->ajaxLoadMore();
                break;
            case 'deletePost':
                $this->deletePost();
                break;
            case 'updatePositions':
                $this->updatePositions();
                break;
            case 'saveSettings':
                $type = Tools::getValue('settings_type');
                $hook_name = Tools::getValue('hook_name');
                if ($ret['saved'] = $this->saveSettings($type, $hook_name)) {
                    $ret['successText'] = utf8_encode($this->l('Saved'));
                }
                break;
        }
        exit(Tools::jsonEncode($ret));
    }

    public function getSettings($type, $id_shop = null)
    {
        if ($id_shop == Configuration::get('PS_SHOP_DEFAULT')) {
            $id_shop = null;
        }
        $key = 'TWA_SETTINGS_'.Tools::strtoupper($type);
        $settings = Configuration::get($key, null, null, $id_shop);
        $settings = $settings ? Tools::jsonDecode($settings, true) : array();
        return $settings;
    }

    public function getContent()
    {
        // need to define it here in order to get proper value for current shop
        $this->general_settings = $this->getSettings('general');
        if (Tools::isSubmit('ajaxAction')) {
            $this->ajaxAction();
        }
        return $this->displayForm();
    }

    public function getAvailableLanguages($only_ids = false)
    {
        $available_languages = array();
        foreach (Language::getLanguages(false) as $lang) {
            if ($lang['id_lang'] == $this->context->language->id) {
                $lang['current'] = 1;
            }
            $available_languages[$lang['id_lang']] = $lang;
        }
        return $only_ids ? array_keys($available_languages) : $available_languages;
    }

    private function displayForm()
    {
        $this->context->smarty->assign(array(
            'posts' => $this->getPosts(),
            'twa' => $this,
            'settings' => array(
                'controller' => $this->l('Display settings'),
                'seo' => $this->l('SEO settings'),
                'general' => $this->l('General settings'),
            ),
            'hooks' => $this->getAvailableHooks(),
            'general_settings' => $this->general_settings,
            'languages' => $this->getAvailableLanguages(),
            'info_links' => array(
                'changelog' => $this->_path.'Readme.md?v='.$this->version,
                'documentation' => $this->_path.'readme_en.pdf?v='.$this->version,
                'contact' => 'https://addons.prestashop.com/en/contact-us?id_product=18197',
                'modules' => 'https://addons.prestashop.com/en/2_community-developer?contributor=64815',
            ),
            'files_update_warnings' => $this->getFilesUpdadeWarnings(),
        ));
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
                $file_name = basename($file);
                if ($file_name == 'custom.css' || $file_name == 'custom.js') {
                    continue;
                }
                $customizable_layout_files[] = '/'.$loc.$file_name;
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

    public function getSettingsFields($type, $hook_name = '', $default_values = array(), $id_shop = null)
    {
         if ($id_shop == Configuration::get('PS_SHOP_DEFAULT')) {
            $id_shop = null;
        }
        $fields = $saved_values = array();
        $method_name = 'get'.Tools::ucfirst($type).'SettingsFields';
        if (method_exists($this, $method_name) && is_callable(array($this, $method_name))) {
            $fields = $this->$method_name();
            if ($type == 'seo') {
                $saved_values = $this->getSavedMetaValues($id_shop);
            } else {
                $identifier = $hook_name ? $hook_name : $type;
                $saved_values = $this->getSettings($identifier, $id_shop);
            }
            $this->fillValues($fields, $saved_values, $default_values);
        }
        return $fields;
    }

    public function fillValues(&$fields, $saved_values, $default_values)
    {
        $id_lang_default = Configuration::get('PS_LANG_DEFAULT');
        foreach ($fields as $name => $field) {
            if (!empty($field['multilang'])) {
                $multilang_value = array();
                foreach ($this->getAvailableLanguages(true) as $id_lang) {
                    $multilang_value[$id_lang] = (!empty($field['required']) || $id_lang == $id_lang_default) ?
                    $field['value'] : '';
                    if (isset($saved_values[$name][$id_lang])) {
                        $multilang_value[$id_lang] = $saved_values[$name][$id_lang];
                    } elseif (isset($default_values[$name][$id_lang])) {
                        $multilang_value[$id_lang] = $default_values[$name][$id_lang];
                    }
                }
                $fields[$name]['value'] = $multilang_value;
            } else {
                if (isset($saved_values[$name])) {
                    $fields[$name]['value'] = $saved_values[$name];
                } elseif (isset($default_values[$name])) {
                    $fields[$name]['value'] = $default_values[$name];
                }
            }
        }
    }

    public function getGeneralSettingsFields()
    {
        $fields = array(
            'notif_email' => array(
                'label' => $this->l('E-mail for notifications'),
                'tooltip' => $this->l('Leave it empty if you want to disable notifications'),
                'value' => Configuration::get('PS_SHOP_EMAIL'),
                'validate' => 'isEmail',
            ),
            'restrictions' => array(
                'label' => $this->l('Who can post comments'),
                'options' => array(
                    0 => $this->l('Any guest'),
                    1 => $this->l('Registered customers'),
                    2 => $this->l('Customers, who placed at least one order'),
                ),
                'value' => 0,
                'validate' => 'isInt',
            ),
            'rating_num' => array(
                'label' => $this->l('Number of rating sars'),
                'tooltip' => $this->l('Use 0 to disable rating'),
                'value' => 5,
                'validate' => 'isInt',
            ),
            'rating_class' => array(
                'label' => $this->l('Custom rating star class'),
                'tooltip' => $this->l('Leave it empty to use default star'),
                'value' => '',
                'validate' => 'isLabel',
            ),
            'max_chars' => array(
                'label' => $this->l('Max characters in review'),
                'value' => 1000,
                'validate' => 'isInt',
            ),
            'ip_interval' => array(
                'label' => $this->l('Time interval between reviews'),
                'tooltip' => $this->l('Allow posting second review after this time (in seconds)'),
                'value' => 86400,
                'validate' => 'isInt',
            ),
            'allow_html' => array(
                'label' => $this->l('Allow basic HTML in reviews?'),
                'tooltip' => $this->l('bold, italic, underline and smileys'),
                'switcher' => 1,
                'value' => 1,
                'validate' => 'isInt',
            ),
            'instant_publish' => array(
                'label' => $this->l('Reviews published instantly?'),
                'tooltip' => $this->l('If set to NO, reviews will be published only after your approval'),
                'switcher' => 1,
                'value' => 1,
                'validate' => 'isInt',
            ),
        );
        return $fields;
    }

    public function getControllerSettingsFields()
    {
        $fields = array(
            'display_column_left' => array(
                'label' => $this->l('Show left column'),
                'switcher' => 1,
                'value' => 0,
                'validate' => 'isInt',
            ),
            'display_column_right' => array(
                'label' => $this->l('Show right column'),
                'switcher' => 1,
                'value' => 0,
                'validate' => 'isInt',
            ),
        );
        $fields += $this->getHookSettingsFields();
        $fields['title']['label'] = $this->l('Page heading');
        $fields['displayType']['value'] = 2;
        unset($fields['displayType']['options']['1']);
        unset($fields['active']);
        unset($fields['view_all_link']);
        return $fields;
    }

    public function getHookSettingsFields()
    {
         $fields = array(
            'active' => array(
                'label' => $this->l('Use this hook'),
                'switcher' => 1,
                'value' => 0,
                'validate' => 'isInt',
            ),
            'title' => array(
                'label' => $this->l('Title'),
                'value' => $this->l('Clients say'),
                'multilang' => 1,
                'validate' => 'isGenericName',
            ),
            'displayType' => array(
                'label' => $this->l('Display type'),
                'options' => array(
                    1 => $this->l('Carousel'),
                    2 => $this->l('Grid'),
                    3 => $this->l('Simple list'),
                ),
                'value' => 1,
                'validate' => 'isInt',
            ),
            'num' => array(
                'label' => $this->l('Number of visible posts'),
                'value' => 10,
                'validate' => 'isInt',
            ),
            'orderby' => array(
                'label' => $this->l('Order by'),
                'options' => array(
                    1 => $this->l('Forced positions'),
                    2 => $this->l('Date added'),
                    3 => $this->l('Random'),
                ),
                'value' => 2,
                'validate' => 'isInt',
            ),
            'view_all_link' => array(
                'label' => $this->l('View all link'),
                'switcher' => 1,
                'value' => 1,
                'validate' => 'isInt',
            ),
        );
        return $fields;
    }

    public function getSeoSettingsFields()
    {
        $fields = array(
            'meta_url_rewrite' => array(
                'label' => $this->l('User friendly URL'),
                'value' => 'testimonials',
                'multilang' => 1,
                'required' => 1,
                'validate' => 'isLinkRewrite',
            ),
            'meta_title' => array(
                'label' => $this->l('Meta title'),
                'value' => '',
                'multilang' => 1,
                'validate' => 'isGenericName',
            ),
            'meta_description' => array(
                'label' => $this->l('Meta description'),
                'value' => '',
                'multilang' => 1,
                'validate' => 'isGenericName',
            ),
            'meta_keywords' => array(
                'label' => $this->l('Meta keywords'),
                'value' => '',
                'multilang' => 1,
                'validate' => 'isGenericName',
            ),
        );
        return $fields;
    }

    public function getSavedMetaValues($id_shop = null)
    {
        $id_shop = $id_shop ? $id_shop : $this->context->shop->id;
        $data = $this->db->executeS('
            SELECT id_lang,
            title AS meta_title,
            description AS meta_description,
            keywords AS meta_keywords,
            url_rewrite AS meta_url_rewrite
            FROM '._DB_PREFIX_.'meta m
            LEFT JOIN '._DB_PREFIX_.'meta_lang ml
                ON ml.id_meta = m.id_meta AND ml.id_shop = '.(int)$id_shop.'
            WHERE m.page = \''.pSQL($this->controller_page).'\'
        ');
        $metas = array();
        foreach ($data as $row) {
            $id_lang = $row['id_lang'];
            unset($row['id_lang']);
            foreach ($row as $meta_name => $meta_value) {
                $metas[$meta_name][$id_lang] = $meta_value;
            }
        }
        return $metas;
    }

    public function saveSettings($type, $hook_name = '', $default_values = array(), $id_shop = null)
    {
        if ($id_shop == Configuration::get('PS_SHOP_DEFAULT')) {
            $id_shop = null;
        }
        $saved = true;
        switch ($type) {
            case 'general':
            case 'controller':
            case 'seo':
            case 'hook':
                $settings_to_save = array();
                $language_ids = $this->getAvailableLanguages(true);
                $required_fields = $this->getSettingsFields($type, $hook_name, $default_values, $id_shop);
                foreach ($required_fields as $name => $field) {
                    $value = Tools::isSubmit($name) ? Tools::getValue($name) : $field['value'];
                    if (!empty($field['multilang'])) {
                        foreach ($language_ids as $id_lang) {
                            $multilang_value = isset($value[$id_lang]) ? $value[$id_lang] : '';
                            $this->validateFieldValue($field, $name, $multilang_value, $id_lang);
                        }
                    } else {
                        $this->validateFieldValue($field, $name, $value);
                    }
                    if (empty($this->errors[$name])) {
                        $settings_to_save[$name] = $value;
                    }
                }
                if ($this->errors) {
                    $this->throwError($this->errors);
                } elseif ($type == 'seo') {
                    $saved &= $this->saveMetaValues($settings_to_save, $id_shop);
                } else {
                    $encoded_settings = Tools::jsonEncode($settings_to_save);
                    $key = 'TWA_SETTINGS_'.Tools::strtoupper($hook_name ? $hook_name : $type);
                    $saved &= Configuration::updateValue($key, $encoded_settings, false, null, $id_shop);
                    if (!empty($hook_name) && isset($settings_to_save['active'])) {
                        if ($settings_to_save['active']) {
                            $this->registerHook($hook_name);
                        } else {
                            $this->unregisterHook($hook_name);
                        }
                    }
                }
                break;
        }
        return $saved;
    }

    public function saveMetaValues($settings_to_save, $id_shop)
    {
        $id_meta = $this->db->getValue('
            SELECT id_meta FROM '._DB_PREFIX_.'meta WHERE page = \''.pSQL($this->controller_page).'\'
        ');
        $meta = new Meta($id_meta, null, $id_shop);
        foreach (array('title', 'description', 'keywords', 'url_rewrite') as $meta_field_name) {
            if (isset($settings_to_save['meta_'.$meta_field_name])) {
                foreach ($settings_to_save['meta_'.$meta_field_name] as $id_lang => $meta_field_value) {
                    $meta->{$meta_field_name}[$id_lang] = $meta_field_value;
                }
            }
        }
        try {
            $meta->page = $this->controller_page;
            $saved = $meta->save();
        } catch (Exception $e) {
            $msg = $this->l('Meta fields').': '.$e->getMessage();
            $this->throwError($msg);
        }
        return $saved;
    }

    public function getPosts($active = false, $start = 0, $limit = 10, $orderby = 1, $additional_q = '')
    {
        $orderby_q = ' ORDER BY position DESC';
        $limit_q = '';
        if ($orderby == 2) {
            $orderby_q = ' ORDER BY date_add DESC';
        } elseif ($orderby == 3) {
            $orderby_q = ' ORDER BY RAND()';
        }
        if ($limit > 0) {
            $limit_q = ' LIMIT '.(int)$start.', '.(int)$limit;
        }
        $shop_ids = Shop::getContextListShopID();
        $all_posts = $this->db->executeS('
            SELECT *
            FROM '._DB_PREFIX_.'testimonialswithavatars
            WHERE 1 '.($active ? 'AND active = 1' : '').'
            AND id_shop IN ('.implode(', ', $shop_ids).')
            '.$additional_q.'
            '.$orderby_q.'
            '.$limit_q.'
        ');
        return $all_posts;
    }

    public function addJS($file, $custom_path = '')
    {
        $path = ($custom_path ? $custom_path : 'modules/'.$this->name.'/views/js/').$file;
        if ($this->is_17) {
            $params = array('server' => $custom_path ? 'remote' : 'local');
            // if (!$custom_path) $path = __PS_BASE_URI__.$path.'?'.microtime(true); $params['server'] = 'remote';
            $this->context->controller->registerJavascript(sha1($path), $path, $params);
        } else {
            $path = $custom_path ? $path : __PS_BASE_URI__.$path;
            $this->context->controller->addJS($path);
            // $this->context->controller->js_files[] = $path.'?'.microtime(true);
        }
    }

    public function addCSS($file, $custom_path = '', $media = 'all')
    {
        $path = ($custom_path ? $custom_path : 'modules/'.$this->name.'/views/css/').$file;
        if ($this->is_17) {
            $params = array('media' => $media, 'server' => $custom_path ? 'remote' : 'local');
            // if (!$custom_path) $path = __PS_BASE_URI__.$path.'?'.microtime(true); $params['server'] = 'remote';
            $this->context->controller->registerStylesheet(sha1($path), $path, $params);
        } else {
            $path = $custom_path ? $path : __PS_BASE_URI__.$path;
            $this->context->controller->addCSS($path, $media);
            // $this->context->controller->css_files[$path.'?'.microtime(true)] = $media;
        }
    }

    public function hookDisplayHeader()
    {
        $this->addCSS('front_simple.css');
        $this->addCSS('custom.css');
        $this->addJS('front_simple.js');
        $this->addJS('custom.js');
        $this->context->controller->addJqueryPlugin('bxslider');
        Media::addJsDef(array('twa_ajax_path' => $this->context->link->getModuleLink($this->name, 'ajax')));
        if (Tools::getValue('controller') == 'testimonials') {
            $this->addCSS('front.css');
            $this->addJS('front.js');
            $this->addJS('tinymce.min.js', '//cdn.tiny.cloud/1/ugmu8unckgdhevdhz6c3mfakw8xfkkwb8yy1wp8sitvpkwa9/tinymce/5/');
        }
    }

    public function displayNativeHook($hook_name_uppercase, $in_column = false)
    {
        $hook_settings = $this->getSettings($hook_name_uppercase);
        if (empty($hook_settings['active'])) {
            return;
        }
        $posts = $this->getPosts(true, 0, $hook_settings['num'], $hook_settings['orderby']);
        if ($view_all_link = !empty($hook_settings['view_all_link'])) {
            $view_all_link = $this->context->link->getModuleLink($this->name, 'testimonials');
        }
        $this->context->smarty->assign(array(
            'twa_hook_posts' => $posts,
            'hook_settings' => $hook_settings,
            'title' => $this->getLangValue($hook_settings, 'title', $this->l('Testimonials')),
            'twa' => $this,
            'general_settings' => $this->general_settings,
            'in_column' => $in_column,
            'view_all_link' => $view_all_link,
            'hook_name' => $hook_name_uppercase,
        ));
        return $this->display($this->local_path, 'twa_hook.tpl');
    }

    public function getLangValue($settings, $name, $default_value = '')
    {
        $value = isset($settings[$name][$this->context->language->id]) ?
        $settings[$name][$this->context->language->id] : $default_value;
        return $value;
    }

    public function hookDisplayHome()
    {
        return $this->displayNativeHook('DISPLAYHOME');
    }

    public function hookDisplayLeftColumn()
    {
        return $this->displayNativeHook('DISPLAYLEFTCOLUMN', true);
    }

    public function hookDisplayRightColumn()
    {
        return $this->displayNativeHook('DISPLAYRIGHTCOLUMN', true);
    }

    public function hookTestimonials1()
    {
        return $this->displayNativeHook('TESTIMONIALS1');
    }

    public function hookTestimonials2()
    {
        return $this->displayNativeHook('TESTIMONIALS2');
    }

    public function hookTestimonials3()
    {
        return $this->displayNativeHook('TESTIMONIALS3');
    }

    public function hookDisplayHomeCustom()
    {
        return $this->displayNativeHook('DISPLAYHOMECUSTOM');
    }

    public function getAvatarPath($id_avatar)
    {
        $file_location = 'views/img/avatars/'.$id_avatar.'.jpg';
        if (file_exists($this->local_path.$file_location)) {
            $src = $this->_path.$file_location.'?'.filemtime($this->local_path.$file_location);
        } else {
            $src = $this->_path.'views/img/avatars/0.jpg';
        }
        return $src;
    }

    public function getAvatarName()
    {
        if ($this->context->customer->id) {
            $avatar_name = $this->context->customer->id;
        } else {
            $avatar_name = 'g_'.round(microtime(true));
        }
        return $avatar_name;
    }

    public function ajaxLoadMore($num = 10, $orderby = 1, $mode = 'admin')
    {
        $additional_q = '';
        $ids_to_exclude = Tools::getValue('ids_to_exclude');
        if (is_array($ids_to_exclude)) {
            $additional_q = 'AND id_post NOT IN ('.implode(', ', array_map('intval', $ids_to_exclude)).')';
        }
        $active = false;
        if ($mode == 'front') {
            $active = true;
        }
        $posts = $this->getPosts($active, 0, $num + 1, $orderby, $additional_q);
        if ($show_load_more = (count($posts) == $num + 1)) {
            array_pop($posts);
        }
        $this->context->smarty->assign(array(
            'posts' => $posts,
            'twa' => $this,
            'general_settings' => $this->general_settings,
        ));
        $post_list = $this->display($this->local_path, 'views/templates/'.$mode.'/post-list.tpl');

        $ret = array(
            'errors' => array(),
            'posts' => !$posts ? false : utf8_encode($post_list),
            'show_load_more' => $show_load_more,
        );
        exit(Tools::jsonEncode($ret));
    }

    public function isPostingRestricted()
    {
        $restricted = '';
        if (!empty($this->general_settings['restrictions'])) {
            if ($this->general_settings['restrictions'] == 1) {
                if (!$this->context->customer->isLogged()) {
                    $restricted = $this->l('Only registered customers can add reviews');
                }
            } elseif ($this->general_settings['restrictions'] == 2) {
                if (!$this->context->customer->isLogged() ||
                    !Order::getCustomerNbOrders($this->context->customer->id)) {
                    $restricted = $this->l('Only customers, who placed at least one order can add reviews');
                }
            }
        }
        return $restricted;
    }


    /*
    * @param mode 'front' or 'admin'
    */
    public function processPost($id, $date_add, $ip, $mode)
    {
        $ret = array('errors' => array());

        $active = (int)Tools::getValue('active');
        $avatar = $this->getValueAndValidate('avatar', 'isLabel');
        if ($mode == 'front') {
            $active = $this->general_settings['instant_publish'];
            $avatar = $this->getAvatarName();
        }
        $max_chars = $this->general_settings['max_chars'];
        $fields = array(
            'id_post' => $id,
            'id_shop' => Tools::getValue('id_shop', $this->context->shop->id),
            'position' => $this->getPostPosition($id),
            'avatar' => $avatar,
            'customer_name' => $this->getValueAndValidate('customer_name', 'isName', true),
            'subject' => $this->getValueAndValidate('subject', 'isCleanHtml', true),
            'rating' => (int)Tools::getValue('rating'),
            'content' => $this->getValueAndValidate('content', 'isCleanHtml', true, $max_chars),
            'active' => $active,
            'visitor_ip' => $ip,
            'date_add' => $date_add,
        );

        if ($mode == 'front') {
            if ($restricted = $this->isPostingRestricted()) {
                $this->errors[] = $restricted;
            }
            $this->ipCheck($fields['visitor_ip']);
        }

        if ($this->errors) {
            $this->throwError($this->errors);
        }

        $this->saveAvatar($fields['avatar']);

        $values = array();
        $upd = array();
        $values_for_smarty = array();
        foreach ($fields as $k => $field) {
            $values[] = '\''.pSQL($field).'\'';
            $values_for_smarty[$k] = strip_tags($field);
            $upd[] = pSQL($k).' = VALUES('.pSQL($k).')';
        }

        $query = '
            INSERT INTO '._DB_PREFIX_.'testimonialswithavatars
            VALUES ('.implode(', ', $values).')
            ON DUPLICATE KEY UPDATE '.implode(', ', $upd).'
        ';

        $this->db->execute($query);

        // for autoincremented ids
        if ($id == '') {
            $values_for_smarty['id_post'] = $this->db->Insert_ID();
        }
        $this->updateNameInAllPosts($fields['avatar'], $fields['customer_name']);

        if ($id == '' && $this->general_settings['notif_email'] != '') {
            $this->sendEmailNotification($this->general_settings['notif_email'], $values_for_smarty);
        }

        $this->context->smarty->assign(array(
            'posts' => array($values_for_smarty),
            'twa' => $this,
            'general_settings' => $this->general_settings,
        ));

        $new_post = $this->display($this->local_path, 'views/templates/'.$mode.'/post-list.tpl');

        $ret = array();
        $ret['errors'] = array();
        $ret['instant_publish'] = (bool)$this->general_settings['instant_publish'];
        $ret['new_post'] = utf8_encode($new_post);
        $ret['successText'] = $this->l('Saved');
        exit(Tools::jsonEncode($ret));
    }

    public function getPostPosition($id_post)
    {
        if ((int)$id_post < 1) {
            $current_max_position = $this->db->getValue('
                SELECT MAX(position) FROM '._DB_PREFIX_.'testimonialswithavatars
            ');
            $position = (int)$current_max_position + 1;
        } else {
            $position = (int)Tools::getValue('post_position');
        }
        return $position;
    }

    public function ipCheck($ip)
    {
        $date_limit = date(
            'Y-m-d G:i:s',
            strtotime('-'.(int)$this->general_settings['ip_interval'].' seconds', time())
        );
        $latest_post_from_this_ip = $this->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'testimonialswithavatars
            WHERE visitor_ip = \''.pSQL($ip).'\' AND date_add > \''.pSQL($date_limit).'\'
            AND id_shop = '.(int)$this->context->shop->id.'
        ');
        if ($latest_post_from_this_ip) {
            $this->throwError($this->l('You cannot publish posts so often'));
        }
    }

    public function saveAvatar($avatar_name, $width = 75, $height = 75)
    {
        //if file is uploaded
        if (isset($_FILES['avatar_file']['tmp_name']) && !empty($_FILES['avatar_file']['tmp_name'])) {
            $path = $this->local_path.'views/img/avatars/';
            $max_size = 2097152; // 2 mb
            // Check image validity
            if ($error = ImageManager::validateUpload($_FILES['avatar_file'], Tools::getMaxUploadSize($max_size))) {
                $this->errors[] = $error;
            }
            if (!$tmp_name = tempnam($path, 'tmp')) {
                return false;
            }
            if (!move_uploaded_file($_FILES['avatar_file']['tmp_name'], $tmp_name)) {
                return false;
            }
            // Copy new image
            if (!$this->errors && !$this->imageResizeModified($tmp_name, $path.$avatar_name.'.jpg', $width, $height)) {
                $this->errors[] = Tools::displayError('An error occurred while uploading the image.');
            }
            unlink($tmp_name);
            if ($this->errors) {
                $this->throwError($this->errors);
            }
        }
        return true;
    }

    public function updateNameInAllPosts($avatar, $customer_name)
    {
        $query = '
            UPDATE '._DB_PREFIX_.'testimonialswithavatars
            SET customer_name = \''.pSQL($customer_name).'\'
            WHERE avatar = \''.pSQL($avatar).'\'
        ';
        return $this->db->execute($query);
    }

    public function getPostIpById($id_post)
    {
        $ip = $this->db->getValue('
            SELECT visitor_ip FROM '._DB_PREFIX_.'testimonialswithavatars
            WHERE id_post = '.(int)$id_post.'
        ');
        return $ip;
    }

    public function toggleActiveStatus()
    {
        $id_post = Tools::getValue('id_post');
        $active = Tools::getValue('active');
        $shop_ids = Shop::getContextListShopID();
        $query = '
            UPDATE '._DB_PREFIX_.'testimonialswithavatars
            SET active = '.(int)$active.'
            WHERE id_post = '.(int)$id_post.'
            AND id_shop IN ('.implode(', ', $shop_ids).')
        ';
        $ret = array(
            'success' => $this->db->execute($query),
            'errors' => array(),
            'active' => (int)$active);
        exit(Tools::jsonEncode($ret));
    }

    public function deletePost()
    {
        $id_post = Tools::getValue('id_post');
        $shop_ids = Shop::getContextListShopID();
        $query = '
            DELETE FROM '._DB_PREFIX_.'testimonialswithavatars
            WHERE id_post = '.(int)$id_post.'
            AND id_shop IN ('.implode(', ', $shop_ids).')
        ';
        $ret = array(
            'errors' => array(),
            'deleted' => $this->db->execute($query),
        );
        exit(Tools::jsonEncode($ret));
    }

    public function updatePositions()
    {
        $ordered_ids = Tools::getValue('ordered_ids');
        if (!$ordered_ids) {
            $this->throwError($this->l('Ordering failed'));
        }
        $update_rows = array();
        foreach ($ordered_ids as $id => $position) {
            if ($id < 1) {
                continue;
            }
            $update_rows[] = '('.(int)$id.', '.(int)$position.')';
        }
        $update_query = '
            INSERT INTO '._DB_PREFIX_.'testimonialswithavatars (id_post, position)
            VALUES '.implode(', ', $update_rows).'
            ON DUPLICATE KEY UPDATE
            position = VALUES(position)
        ';
        if (!$this->db->execute($update_query)) {
            $this->throwError($this->l('Ordering failed'));
        }
        $ret = array('errors' => array(), 'successText' => $this->l('Saved'));
        exit(Tools::jsonEncode($ret));
    }

    public function sendEmailNotification($notif_email, $values_for_smarty)
    {
        if (!Validate::isEmail($notif_email)) {
            return false;
        }

        $subject = Configuration::get('PS_SHOP_NAME').': '.$this->l('New review submitted');
        $body = '';
        $email_values = array('customer_name', 'subject', 'content');
        foreach ($email_values as $val_name) {
            if (isset($values_for_smarty[$val_name])) {
                $body .= $val_name.': '.pSQL($this->bbCodeToHTML($values_for_smarty[$val_name]))."\n";
            }
        }
        $from = 'noreply@'.str_replace('www.', '', $_SERVER['HTTP_HOST']);
        if (!Validate::isEmail($from)) {
            $from = Configuration::get('PS_SHOP_EMAIL');
        }
        $smtp = $smtp_server = $smtp_login = $smtp_pass = $smtp_encryption = $smtp_port = false;
        $configuration = Configuration::getMultiple(
            array(
                'PS_MAIL_METHOD',
                'PS_MAIL_SERVER',
                'PS_MAIL_USER',
                'PS_MAIL_PASSWD',
                'PS_MAIL_SMTP_ENCRYPTION',
                'PS_MAIL_SMTP_PORT'
            ),
            null,
            null,
            $this->context->shop->id
        );
        if ($configuration['PS_MAIL_METHOD'] == 2) {
            $smtp = true;
            $smtp_server = $configuration['PS_MAIL_SERVER'];
            $smtp_login = $configuration['PS_MAIL_USER'];
            $smtp_pass = $configuration['PS_MAIL_PASSWD'];
            $smtp_encryption = $configuration['PS_MAIL_SMTP_ENCRYPTION'];
            $smtp_port = $configuration['PS_MAIL_SMTP_PORT'] || 25;
        }
        $type = 'text/plain';
        return Mail::sendMailTest(
            $smtp,
            $smtp_server,
            $body,
            $subject,
            $type,
            $notif_email,
            $from,
            $smtp_login,
            $smtp_pass,
            $smtp_port,
            $smtp_encryption
        );
    }

    public function validateFieldValue($field, $name, $value, $id_lang = false)
    {
        $validate = $field['validate'];
        if (!empty($field['required']) && !trim($value)) {
            $error = $this->l('Please, fill this field');
        } elseif ($value && !Validate::$validate($value)) {
            $error = $this->l('Incorrect value');
        }
        if (!empty($error)) {
            $this->errors[$name] = $error.($id_lang ? ' ('.Language::getIsoById($id_lang).')' : '');
        }
    }

    public function getValueAndValidate($name, $validate, $required = false, $max_chars = 256)
    {
        $value = Tools::getValue($name);
        if ($required && $value == '') {
            $this->errors[$name] = $this->l('Please, fill in this field');
        } elseif (!Validate::$validate($value)) {
            $this->errors[$name] = $this->l('Incorrect value');
        } elseif (is_string($value) && Tools::strlen(pSQL($value)) > $max_chars) {
            $this->errors[$name] = $this->l('Max characters limit exceeded');
        }
        return $value;
    }

    public function throwError($errors)
    {
        if (!is_array($errors)) {
            $errors = array($errors);
        }
        $ret = array(
            'errors' => array_map('utf8_encode', $errors),
        );
        die(Tools::jsonEncode($ret));
    }

    public function bbCodeToHTML($bbtext)
    {
        $bbtags = array(
            '[b]' => '<span class="b">', '[/b]' => '</span>',
            '[i]' => '<span class="i">', '[/i]' => '</span>',
            '[u]' => '<span class="u">', '[/u]' => '</span>',
            '[img]http://' => '<img src="//', '[img]https://' => '<img src="//',
            '[img]//' => '<img src="//', '[/img]' => '" alt=" " />',
        );
        $bbtext = html_entity_decode(str_ireplace(array_keys($bbtags), array_values($bbtags), $bbtext));
        return Tools::nl2br($bbtext);
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
        if (Configuration::get('PS_IMAGE_QUALITY') == 'png_all' ||
            (Configuration::get('PS_IMAGE_QUALITY') == 'png' && $type == IMAGETYPE_PNG) &&
            !$force_type) {
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
        $w = (int)$w;
        $h = ($dst_height - $next_height) / 2;
        $h = (int)$h;
        imagecopyresampled($dest_image, $src_image, $w, $h, 0, 0, $next_width, $next_height, $src_width, $src_height);
        return (ImageManager::write($file_type, $dest_image, $dst_file));
    }

    public function getShopNameById($id_shop)
    {
        return $this->db->getValue('SELECT name FROM '._DB_PREFIX_.'shop WHERE id_shop = '.(int)$id_shop);
    }
}