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

use Symfony\Component\Finder\Finder;
use Symfony\Component\Translation\Loader\XliffFileLoader;

class AllTranslate extends Module
{
    public function __construct()
    {
        if (!defined('_PS_VERSION_')) {
            exit;
        }

        $this->name = 'alltranslate';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Prestapro';
        $this->need_instance = 0;
        $this->secure_key = Tools::encrypt($this->name);
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('All Translate');
        $this->description = $this->l('Translates custom themes and modules into chosen languages.');
        $this->db = Db::getInstance();
        $this->shop_ids = Shop::getContextListShopID();
        $this->api_url = 'https://translate.yandex.net/api/v1.5/tr.json/translate';

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        $default_settings = Tools::jsonEncode(array(
            'api_key' => null,
        ));

        if (!parent::install()
        || !$this->registerHook('displayBackOfficeHeader')
        || !Configuration::updateValue('AT_SETTINGS', $default_settings)) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall()
        || !Configuration::deleteByName('AT_SETTINGS')) {
            return false;
        }

        return true;
    }

    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('controller') != 'AdminModules') {
            return;
        }

        $this->context->controller->addCSS($this->_path.'views/css/back.css');
        $this->context->controller->addJquery();
        $this->context->controller->addJS($this->_path.'views/js/back.js');
    }

    private function saveSettings($values)
    {
        Configuration::updateValue('AT_SETTINGS', Tools::jsonEncode($values));
    }

    private function error($array)
    {
        if (!is_array($array)) {
            $array = array($array);
        }

        exit(Tools::jsonEncode(array(
            'error' => true,
            'response' => utf8_encode($this->displayError(implode('<br>', $array))),
        )));
    }

    private function curlRequest($url, $data)
    {
        $session = curl_init($url);
        curl_setopt($session, CURLOPT_HTTPHEADER, array(
            'Expect: */*',
            'Content-Type: application/x-www-form-urlencoded',
        ));
        curl_setopt($session, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($session);
        curl_close($session);

        return $response;
    }

    private function validateApiKey($api_key)
    {
        $result = false;
        $data = array(
            'key'    => (string)$api_key,
            'lang'   => 'en-ru',
            'text'   => 'Test',
        );

        $response = Tools::jsonDecode($this->curlRequest($this->api_url, $data), true);

        if ($response['code'] !== 401 && $response['code'] !== 402) {
            $result = true;
        }

        return $result;
    }

    private function toggleWords($words, $string, $hide = true)
    {
        $replace = array();
        $words = explode(', ', $words);

        foreach ($words as $key => $word) {
            if ($hide) {
                $replace[$word] = sprintf('[|%d|]', $key);
            } else {
                $replace[sprintf('[|%d|]', $key)] = $word;
            }
        }

        return str_replace(array_keys($replace), $replace, $string);
    }

    private function unescape($string)
    {
        return preg_replace(sprintf('/%s/', preg_quote('[^\\]\\')), '', $string);
    }

    private function encodeStrings($message_catalogue)
    {
        if (!is_array($message_catalogue) || empty($message_catalogue)) {
            return false;
        }

        $strings_to_translate = $to_unhide = array();

        foreach ($message_catalogue as $domain => $strings) {
            foreach ($strings as $string) {
                $encoded_key = md5($domain.'_'.$string);
                $matches = array();

                if (preg_match_all('/(%\w+%|%[\w\$]+)/', $string, $matches) !== 0) {
                    $sprintf_words = implode(', ', $matches[0]);
                    $string = $this->toggleWords($sprintf_words, $string);
                    $to_unhide[$encoded_key] = $sprintf_words;
                }

                $strings_to_translate[$encoded_key] = $this->unescape($string);
            }
        }

        return array(
            'strings_to_translate' => $strings_to_translate,
            'to_unhide' => $to_unhide,
        );
    }

    private function saveStrings(
        $yandex_translated,
        $message_catalogue,
        $to_unhide,
        $id_lang = 0,
        $overwrite = null,
        $theme = null
    ) {
        if (!is_array($yandex_translated)
        || !is_array($message_catalogue)
        || empty($yandex_translated)
        || empty($message_catalogue)) {
            return false;
        }

        $translated_strings = $new_translations = array();

        if ($theme) {
            $theme_select_sql = '= "'.pSQL($theme).'"';
            $theme_insert_sql = '"'.pSQL($theme).'"';
        } else {
            $theme_select_sql = 'IS NULL';
            $theme_insert_sql = 'NULL';
        }

        foreach ($yandex_translated as $key => $translation) {
            if (isset($to_unhide[$key])) {
                $translated_strings[$key] = $this->toggleWords($to_unhide[$key], $translation, false);
            } else {
                $translated_strings[$key] = $translation;
            }
        }

        foreach ($message_catalogue as $domain => $strings) {
            foreach ($strings as $string) {
                $encoded_key = md5($domain.'_'.$string);

                if (isset($translated_strings[$encoded_key])) {
                    $row_to_translate = $this->db->getRow(
                        'SELECT id_translation
                        FROM `'._DB_PREFIX_.'translation`
                        WHERE `id_lang` = "'.(int)$id_lang.'"
                          AND `key` = "'.pSQL($string).'"
                          AND `domain` = "'.pSQL($domain).'"
                          AND `theme` '.$theme_select_sql
                    );

                    if ($row_to_translate != false) {
                        if ($overwrite) {
                            $this->db->update(
                                'translation',
                                array('translation' => pSQL($translated_strings[$encoded_key])),
                                'id_translation = '.(int)$row_to_translate['id_translation']
                            );
                        }
                    } else {
                        $new_translations[$domain][$string] = $translated_strings[$encoded_key];
                    }
                }
            }
        }

        if (!empty($new_translations)) {
            $insert = null;

            foreach ($new_translations as $domain => $strings) {
                foreach ($strings as $key => $translation) {
                    $insert[] = sprintf(
                        '("%d", "%s", "%s", "%s", %s)',
                        (int)$id_lang,
                        pSQL($key),
                        pSQL($translation),
                        pSQL($domain),
                        $theme_insert_sql
                    );
                }
            }

            if (!empty($insert)) {
                $this->db->execute(
                    'INSERT INTO `'._DB_PREFIX_.'translation`
                        (
                            `id_lang`,
                            `key`,
                            `translation`,
                            `domain`,
                            `theme`
                        )
                    VALUES '.implode(', ', $insert)
                );
            }
        }
    }

    private function yandexTranslator($strings_array, $from, $to)
    {
        $to = str_replace(array('gb', 'si', 'sh', 'tw'), array('en', 'sl', 'si', 'zh'), $to);
        $separator = '<br class="ch_s">';

        $strings_split = array_chunk($strings_array, 1000, true);
        $result = $errors = array();

        foreach ($strings_split as $strings_chunk) {
            $string_keys = array_keys($strings_chunk);
            $strings = implode($separator, $strings_chunk);
            $translation = null;

            $data = array(
                'key'    => (string)$this->api_key,
                'lang'   => sprintf('%s-%s', $from, $to),
                'text'   => $strings,
                'format' => 'html',
            );

            $response = Tools::jsonDecode($this->curlRequest($this->api_url, $data), true);

            if ($response['code'] !== 200) {
                $message = sprintf('%s %d (%s-%s)', $this->l('Error'), $response['code'], $from, $to);

                if (isset($response['message'])) {
                    $message .= sprintf(': %s', $response['message']);
                }

                $errors[] = $message;
            } elseif (!isset($response['text'][0])) {
                $errors[] = $this->l('Unknown error');
            } else {
                $translation = $response['text'][0];
                $translation = html_entity_decode($translation, ENT_QUOTES | ENT_XML1, 'UTF-8');

                if (isset($separator)) {
                    $exploded = explode($separator, $translation);

                    if (count($exploded) != count($string_keys)) {
                        $errors[] = $this->l('Translation failed');
                    }

                    $translation = array();

                    foreach ($exploded as $key => $translated_string) {
                        $translation[$string_keys[$key]] = $translated_string;
                    }
                }
            }

            if ($errors && Tools::isSubmit('action')) {
                $this->error($errors);
            } elseif ($errors) {
                return false;
            }

            $char_count = Tools::strlen($strings);
            $this->char_count += $char_count;
            $result = array_merge($result, $translation);
            sleep(1);
        }

        return $result;
    }

    private function translateMeta($from, $to, $overwrite = false)
    {
        if (!$overwrite) {
            return false;
        }

        $strings_to_translate = $config_to_translate = $encoded_strings = array();
        $from_id = Language::getIdByIso($from);
        $to_id = Language::getIdByIso($to);

        $tables = array(
            'cms_lang' => array(
                'name' => 'cms_lang',
                'id' => 'id_cms',
                'fields' => array(
                    'meta_title',
                    'meta_description',
                ),
                'id_shop' => true,
            ),
            'meta_lang' => array(
                'name' => 'meta_lang',
                'id' => 'id_meta',
                'fields' => array(
                    'title',
                    'description',
                    'url_rewrite',
                ),
                'id_shop' => true,
            ),
            'reassurance_lang' => array(
                'name' => 'reassurance_lang',
                'id' => 'id_reassurance',
                'fields' => array(
                    'text',
                ),
                'id_shop' => false,
            ),
            'info_lang' => array(
                'name' => 'info_lang',
                'id' => 'id_info',
                'fields' => array(
                    'text',
                ),
                'id_shop' => false,
            ),
            'homeslider_slides_lang' => array(
                'name' => 'homeslider_slides_lang',
                'id' => 'id_homeslider_slides',
                'fields' => array(
                    'title',
                    'description',
                ),
                'id_shop' => false,
            ),
            'link_block_lang' => array(
                'name' => 'link_block_lang',
                'id' => 'id_link_block',
                'fields' => array(
                    'name',
                    'custom_content',
                ),
                'id_shop' => false,
            ),
            'linksmenutop_lang' => array(
                'name' => 'linksmenutop_lang',
                'id' => 'id_linksmenutop',
                'fields' => array(
                    'label',
                ),
                'id_shop' => true,
            ),
        );

        foreach ($tables as $table) {
            $result = $this->db->executeS(
                'SELECT '.pSQL($table['id']).','.implode(',', array_map('pSQL', $table['fields'])).'
                FROM '._DB_PREFIX_.pSQL($table['name']).'
                WHERE id_lang = '.(int)$from_id.(($table['id_shop'] == true) ?
                ' AND id_shop IN ('.implode(',', array_map('intval', $this->shop_ids)).')' : null)
            );

            if (!empty($result)) {
                foreach ($result as $meta) {
                    foreach ($table['fields'] as $field) {
                        if (!empty($meta[$field])) {
                            if ($field == 'url_rewrite') {
                                $string = $meta['title'];
                            } else {
                                $string = $meta[$field];
                            }

                            $strings_to_translate[$table['name']][$meta[$table['id']]][$field] = $string;
                            $encoded_strings[md5($string)] = $string;
                        }
                    }
                }
            }
        }

        $config_table_entries = array(
            'NW_CONDITIONS',
            'BANK_WIRE_CUSTOM_TEXT',
        );

        $result = $this->db->executeS(
            'SELECT c.`id_configuration`, cl.`value`
            FROM '._DB_PREFIX_.'configuration c
            LEFT JOIN '._DB_PREFIX_.'configuration_lang cl ON (c.`id_configuration` = cl.`id_configuration`)
            WHERE c.`name` IN ("'.implode('","', array_map('pSQL', $config_table_entries)).'")
              AND cl.`id_lang` = '.(int)$from_id
        );

        if (!empty($result)) {
            foreach ($result as $config_entry) {
                if (!empty($config_entry['value'])) {
                    $config_to_translate[$config_entry['id_configuration']] = $config_entry['value'];
                    $encoded_strings[md5($config_entry['value'])] = $config_entry['value'];
                }
            }
        }

        if (!empty($encoded_strings)) {
            $yandex_translated = $this->yandexTranslator($encoded_strings, $from, $to);

            foreach ($strings_to_translate as $table_name => $row) {
                foreach ($row as $id => $fields) {
                    $update = array();

                    foreach ($fields as $field => $value) {
                        if (isset($yandex_translated[md5($value)])) {
                            if ($field == 'url_rewrite') {
                                $update[pSQL($field)] = pSQL(Tools::str2url($yandex_translated[md5($value)]));
                            } else {
                                $update[pSQL($field)] = pSQL($yandex_translated[md5($value)], true);
                            }
                        }
                    }

                    if (!empty($update)) {
                        $id_shop = ($tables[$table_name]['id_shop'] == true) ? ' AND id_shop IN ('.
                        implode(',', array_map('intval', $this->shop_ids)).')' : null;
                        $this->db->update(
                            pSQL($table_name),
                            $update,
                            pSQL($tables[$table_name]['id']).' = '.(int)$id.
                            ' AND id_lang = '.(int)$to_id.$id_shop
                        );
                    }
                }
            }

            foreach ($config_to_translate as $id_configuration => $value) {
                if (isset($yandex_translated[md5($value)])) {
                    $this->db->update(
                        'configuration_lang',
                        array(
                            'value' => pSQL($yandex_translated[md5($value)], true),
                            'date_upd' => date('Y-m-d H:i:s'),
                        ),
                        'id_configuration = '.(int)$id_configuration.
                        ' AND id_lang = '.(int)$to_id
                    );
                }
            }
        }
    }

    private function clearTranslationCache()
    {
        $cache_dir = _PS_ROOT_DIR_.'/app/cache/prod/';
        $cache_files = glob('{'.$cache_dir.'translations/*,'.$cache_dir.'ps_mainmenu/*}', GLOB_BRACE);

        foreach ($cache_files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    private function translate($type = 'theme')
    {
        $target_lang = $target_label = array();
        $identifier = Tools::getValue('identifier');
        $type = Tools::getValue('type');
        $from = Tools::getValue('from');
        $from_locale = Tools::getValue('from_locale');
        $to = Tools::getValue('to');

        if (is_array($to)) {
            foreach ($to as $lang) {
                if ($from == $lang || $lang == 'all') {
                    continue;
                }

                $target_lang[] = array(
                    'iso' => $lang,
                    'id' => Language::getIdByIso($lang),
                );
                $target_label[] = $lang;
            }
        } elseif ($to == 'all') {
            foreach (Language::getLanguages(true) as $lang) {
                if ($from == $lang['iso_code']) {
                    continue;
                }

                $target_lang[] = array(
                    'iso' => $lang['iso_code'],
                    'id' => $lang['id_lang'],
                );
                $target_label[] = $lang;
            }
        } elseif ($from != $to) {
            $target_lang[] = array(
                'iso' => $to,
                'id' => Language::getIdByIso($to),
            );
            $target_label[] = $to;
        }

        $overwrite_existing = Tools::getValue('overwrite_existing');
        $time = microtime(true);

        if (!empty($target_lang)) {
            foreach ($target_lang as $target) {
                switch ($type) {
                    case 'module':
                        $message_catalogue = $this->context->getTranslator()->getCatalogue($from_locale)->all();
                        $domains = array_keys($message_catalogue);
                        $domains_to_translate = $translation_data = $new_system_modules = array();

                        $clean_module_name = preg_replace('/^ps_(\w+)/', '$1', $identifier);

                        foreach ($domains as $domain) {
                            if (false !== stripos($domain, $clean_module_name)) {
                                if (!in_array($identifier, $new_system_modules)) {
                                    $new_system_modules[] = $identifier;
                                }

                                $domains_to_translate[$domain] = $message_catalogue[$domain];
                            }
                        }

                        $translation_data = $this->encodeStrings($domains_to_translate);

                        if (!empty($translation_data['strings_to_translate'])) {
                            $yandex_translated = $this->yandexTranslator(
                                $translation_data['strings_to_translate'],
                                $from,
                                $target['iso']
                            );
                            $this->saveStrings(
                                $yandex_translated,
                                $domains_to_translate,
                                $translation_data['to_unhide'],
                                $target['id'],
                                $overwrite_existing
                            );
                        }

                        break;

                    default:
                        $message_catalogue = $translation_data = array();
                        $theme_dir = _PS_ROOT_DIR_.'/themes/'.$identifier;
                        $domain = null;

                        $xliff_finder = Finder::create()
                            ->files()
                            ->name('*.'.$from_locale.'.xlf')
                            ->in($theme_dir);
                        $xliff_loader = new XliffFileLoader();

                        foreach ($xliff_finder as $xlf_file) {
                            $domain = explode('.', basename($xlf_file->getPathname()))[0];
                            $message_catalogue = array_merge(
                                $message_catalogue,
                                $xliff_loader->load($xlf_file->getPathname(), $from, $domain)->all()
                            );
                        }

                        $tpl_finder = Finder::create()
                            ->files()
                            ->name('*.tpl')
                            ->in($theme_dir);

                        foreach ($tpl_finder as $tpl_file) {
                            $matches = array();
                            $pattern = array(
                                '{l[ \n\t]+s=(\'|")(.+?)(\'|")[ \n\t]*',
                                '(sprintf=(\[.+?\]|\$[\w_]+))?[ \n\t]*',
                                '(d|mod)=(\'|")([\w\.]+)(\'|")',
                            );
                            if (preg_match_all(
                                sprintf('/%s/m', implode('', $pattern)),
                                $tpl_file->getContents(),
                                $matches,
                                PREG_SET_ORDER
                            ) !== 0) {
                                foreach ($matches as $match) {
                                    if ($match[6] == 'd') {
                                        $domain = str_replace('.', '', $match[8]);
                                    } else { // Translation of modules using legacy translation system
                                        $domain = 'messages';
                                    }

                                    $string = $this->unescape($match[2]);

                                    if (!in_array($string, $message_catalogue[$domain])) {
                                        $message_catalogue[$domain][] = $string;
                                    }
                                }
                            };
                        }

                        $translation_data = $this->encodeStrings($message_catalogue);

                        if (!empty($translation_data['strings_to_translate'])) {
                            $yandex_translated = $this->yandexTranslator(
                                $translation_data['strings_to_translate'],
                                $from,
                                $target['iso']
                            );

                            $this->saveStrings(
                                $yandex_translated,
                                $message_catalogue,
                                $translation_data['to_unhide'],
                                $target['id'],
                                $overwrite_existing,
                                $identifier
                            );
                        }

                        $this->translateMeta($from, $target['iso'], $overwrite_existing);

                        break;
                }
            }

            $error = false;
            $response = sprintf(
                $this->l('%s: Processed %d characters in %s seconds'),
                implode(', ', array_map('strtoupper', $target_label)),
                $this->char_count,
                round(microtime(true) - $time, 2)
            );
        } else {
            $error = true;
            $response = $this->l('Source and target languages are the same');
        }

        $output = array(
            'error' => $error,
            'response' => utf8_encode($response),
        );

        $this->clearTranslationCache();
        exit(Tools::jsonEncode($output));
    }

    private function displayApiKey($key = null)
    {
        $this->context->smarty->assign(array('at_api_key' => $key));
        return $this->display($this->local_path, 'views/templates/admin/display-api-key.tpl');
    }

    private function displayControls()
    {
        $type = (Tools::getValue('type') == 'module') ? 'module' : 'theme';
        $class = 'active';
        $languages = array();

        foreach (Language::getLanguages(true) as $lang) {
            $languages[$lang['iso_code']] = array(
                'locale' => $lang['locale'],
                'name' => $lang['name'],
            );
        }

        $this->context->smarty->assign(
            array(
                'at_action' => AdminController::$currentIndex.
                    '&configure='.$this->name.
                    '&token='.Tools::getAdminTokenLite('AdminModules'),
                'at_theme_class' => ($type == 'theme') ? $class : '',
                'at_module_class' => ($type == 'module') ? $class : '',
                'at_languages' => $languages,
            )
        );

        return $this->display($this->local_path, 'views/templates/admin/display-controls.tpl');
    }

    private function getThemes()
    {
        $themes = array();
        $suffix = 'config/theme.yml';
        $theme_directories = glob(_PS_ALL_THEMES_DIR_.'*/'.$suffix);

        foreach ($theme_directories as $path) {
            $themes[] = basename(Tools::substr($path, 0, - Tools::strlen($suffix)));
        }

        return $themes;
    }

    private function getModules()
    {
        $modules = $domains = $result = array();
        $modules = Module::getModulesInstalled();
        $domains = array_keys($this->context->getTranslator()->getCatalogue()->all());

        foreach ($modules as $module) {
            $module_name = preg_replace('/^ps_(\w+)/', '$1', $module['name']);

            foreach ($domains as $domain) {
                if (false !== stripos($domain, $module_name)) {
                    $result[] = $module['name'];
                }
            }
        }

        return $result;
    }

    private function displayTable()
    {
        $items = array();
        $type = Tools::getValue('type');

        switch ($type) {
            case 'module':
                $items = $this->getModules();
                $title = $this->l('Installed modules');
                $type_edit = 'modules';
                break;

            default:
                $items = $this->getThemes();
                $title = $this->l('Themes');
                $type_edit = 'themes';
                break;
        }

        sort($items);

        $this->context->smarty->assign(array(
            'at_type' => $type,
            'at_title' => $title,
            'at_items' => $items,
            'at_dir' => _MODULE_DIR_.$this->name,
            'at_edit_url' => __PS_BASE_URI__.
                basename(_PS_ADMIN_DIR_).
                '/index.php/international/translations?_token='.
                Tools::getAdminTokenLite(false).'&type='.$type_edit,
        ));
        return $this->display($this->local_path, 'views/templates/admin/display-table.tpl');
    }

    public function getContent()
    {
        $this->context->smarty->assign(array('at_documentation_link' => $this->_path.'readme_en.pdf'));
        $output = $this->display(__FILE__, 'views/templates/admin/configure.tpl');

        if (!function_exists('curl_init')) {
            $output .= $this->displayError($this->l('cURL PHP extension is required for the module to work properly'));
            return $output;
        }

        $this->api_key = $output = null;
        $settings = Tools::jsonDecode(Configuration::get('AT_SETTINGS'));
        $this->api_key = $settings->api_key;

        if ($action = Tools::getValue('action')) {
            switch ($action) {
                case 'translate':
                    $this->translate();
                    break;

                default:
                    break;
            }
        }

        if (Tools::isSubmit('at_update_api_key') && $this->validateApiKey(Tools::getValue('at_api_key'))) {
            $settings->api_key = Tools::getValue('at_api_key');
            $this->saveSettings($settings);
            $output .= $this->displayConfirmation($this->l('API key updated'));
        }

        if (!$settings->api_key) {
            $output .= $this->displayError($this->l('Please enter a valid API key'));
            $output .= $this->displayApiKey();
        } else {
            $output .= $this->display($this->local_path, 'views/templates/admin/display-warnings.tpl');
            $output .= $this->displayApiKey($settings->api_key);
            $output .= $this->displayControls();
            $output .= $this->displayTable();
        }

        return $output;
    }
}
