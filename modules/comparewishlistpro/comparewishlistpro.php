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

include_once dirname(__FILE__).'/classes/WishList.php';

class CompareWishlistPro extends Module
{
    const INSTALL_SQL_FILE = 'sql/install.sql';

    private $html = '';

    public function __construct()
    {
        if (!defined('_PS_VERSION_')) {
            exit;
        }

        $this->name = 'comparewishlistpro';
        $this->tab = 'front_office_features';
        $this->version = '1.4.8';
        $this->author = 'Prestapro';
        $this->need_instance = 0;
        $this->controllers = array(
            'mywishlist',
            'view',
            'comparison',
            'buywishlistproduct',
            'cart',
            'comparisontools',
            'managewishlist',
            'sendwishlist'
        );
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        $this->bootstrap = true;
        $this->secure_key = Tools::encrypt($this->name);
        $this->settings = null;
        $this->settings_key = 'CWP_SETTINGS';
        $this->module_key = '49e4d7847a8ae7f735ab80ad4df7210f';
        $this->module_id = '51329';
        $this->prefix = 'cwp_';

        parent::__construct();

        $this->displayName = $this->l('Advanced Product Comparison and Wishlist Pro');
        $this->description = $this->l('Adds ability for customers to compare products and create wishlists.');
        $this->default_wishlist_name = $this->l('My wishlist');
        $this->html = '';
        $this->comparison_products = null;
        $this->wishlists_products = null;
        $this->customer_wishlists = null;
        $this->tpl_header = 'templates/_partials/header.tpl';
        $this->tpl_product = 'templates/catalog/_partials/product-add-to-cart.tpl';
    }

    private function displayChangelog()
    {
        $changelog_path = $this->local_path.'CHANGELOG.md';
        $result = $this->l('Changelog not found');

        if (file_exists($changelog_path)) {
            $changelog = trim(str_replace(
                array('# Changelog', '##'),
                array('', '####'),
                Tools::file_get_contents($changelog_path)
            ));

            if (!empty($changelog)) {
                require_once($this->local_path.'vendor/Parsedown/Parsedown.php');
                $parsedown = new Parsedown();
                $result = $parsedown->text($changelog);
            }
        }

        return $result;
    }

    private function getPublishedProducts($count = 6)
    {
        $result = array();
        $file_path = $this->local_path.'products.json';

        if (file_exists($file_path)) {
            $result = Tools::jsonDecode(Tools::file_get_contents($file_path), true);
        }

        shuffle($result);

        if (!is_numeric($count) || !in_array($count, array(3, 4, 5, 6))) {
            $count = 6;
        }

        return array_slice($result, 0, $count);
    }

    public function getSettings()
    {
        if ($this->settings === null) {
            $this->settings = Tools::jsonDecode(Configuration::get($this->settings_key), true);
        }

        return $this->settings;
    }

    public function saveSettings($settings)
    {
        $result = false;

        if (Configuration::updateValue($this->settings_key, Tools::jsonEncode($settings))) {
            $result = true;
            $this->settings = $settings;
        }

        return $result;
    }

    private function isClassName($string)
    {
        return preg_match('/^[a-zA-Z0-9_\-]+$/', $string);
    }

    public function prepareTemplate($action, $template, $class = 'js-top-menu-bottom', $type = 'menu')
    {
        $tpl = _PS_THEME_DIR_.$template;

        if (!file_exists($tpl)) {
            $tpl = _PS_PARENT_THEME_DIR_.$template;
        }

        $tpl_backup = $tpl.'.bak';

        if ($action == 'add') {
            if (!$this->isClassName($class)) {
                return false;
            }

            $written = false;

            if (file_exists($tpl) && is_writable($tpl)) {
                if (file_exists($tpl_backup)) {
                    if (!copy($tpl_backup, $tpl)) {
                        return false;
                    }
                } else {
                    if (!copy($tpl, $tpl_backup)) {
                        return false;
                    }
                }

                $original = array(
                    'PrestaShop SA <contact@prestashop.com>',
                    'Trademark & Property',
                    '&&',
                    ' > ',
                    ' < ',
                    '>=',
                    '<=',
                    '=>',
                    '&#xE8B6;',
                    '></',
                    '<p>',
                    '</p>',
                );

                $clean = array(
                    'PrestaShop SA contact@prestashop.com',
                    'Trademark and Property',
                    '__ampamp__',
                    '__gt__',
                    '__lt__',
                    '__gte__',
                    '__lte__',
                    '__egt__',
                    '__search__',
                    '> </',
                    '<paragraph>',
                    '</paragraph>',
                );

                $tpl_contents = Tools::file_get_contents($tpl);

                $dom = new DOMDocument();
                libxml_use_internal_errors(true);
                $dom->loadHTML(
                    str_replace($original, $clean, $tpl_contents),
                    LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
                );
                libxml_clear_errors();
                $dom->encoding = 'UTF-8';
                $xpath = new DOMXPath($dom);
                $class_found = false;

                $node_list = $xpath->query(sprintf(
                    '//*[contains(concat(" ", normalize-space(@class), " "), " %s ")]',
                    $class
                ));

                if ($node_list->length > 0) {
                    $class_found = true;
                    $element = $node_list->item(0);

                    if ($type == 'menu') {
                        $hook = '{hook h=\'displayCompareWishlistProMenu\'}';
                    } else {
                        $hook = '{hook h=\'displayCompareWishlistProButtons\' product=$product}';
                    }

                    $element->appendChild(
                        $dom->createTextNode($hook)
                    );
                }

                if ($class_found) {
                    $output = null;

                    foreach ($dom->getElementsByTagName('p')->item(0)->childNodes as $child) {
                        $output .= $dom->saveXML($child);
                    }

                    $output = str_replace(array('<p>', '</p>'), '', $output);
                    $written = file_put_contents($tpl, str_replace($clean, $original, $output));

                    if ($written !== false) {
                        $settings = $this->getSettings();
                        $settings['hook_installed'][$type] = true;
                        $this->saveSettings($settings);
                    }
                }
            }

            return true;
        } else {
            $result = false;

            if (file_exists($tpl_backup)) {
                $result = copy($tpl_backup, $tpl);
                $result = unlink($tpl_backup);
            }

            return $result;
        }
    }

    private function getDefaultSettings()
    {
        return array(
            'comparison' => 1,
            'comparison_catalog' => 1,
            'comparison_product_pages' => 1,
            'comparison_layout' => 1,
            'comparison_navigation' => 'buttons',
            'comparison_table_items_desktop' => 5,
            'comparison_table_items_tablet' => 4,
            'comparison_condition' => 1,
            'comparison_manufacturer' => 1,
            'comparison_hide_features' => 0,
            'comparison_show_email_block' => 1,
            'wishlists' => 1,
            'wishlists_catalog' => 1,
            'wishlists_product_pages' => 1,
            'icons_on_hover' => 0,
            'link_elements' => 'all',
            'menu_hook_container' => 'js-top-menu-bottom',
            'buttons_hook_container' => 'product-add-to-cart',
            'hook_installed' => array(
                'menu' => false,
                'buttons' => false,
            ),
        );
    }

    private function installSettings()
    {
        $settings = $default_settings = $this->getDefaultSettings();
        $file = $this->local_path.'settings.json';

        if (file_exists($file)) {
            $external_settings = Tools::jsonDecode(Tools::file_get_contents($file), true);
            $theme = basename(_THEME_DIR_);

            if (!empty($external_settings)
            && isset($external_settings['theme'])
            && isset($external_settings['settings'])
            && $external_settings['theme'] == $theme) {
                foreach (array_keys($default_settings) as $key) {
                    if (isset($external_settings['settings'][$key])) {
                        $settings[$key] = $external_settings['settings'][$key];
                    }
                }
            }
        }

        $this->saveSettings($settings);

        return $settings;
    }

    public function install($delete_params = true)
    {
        if ($delete_params) {
            if (!file_exists(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE)) {
                return false;
            } elseif (!$sql = Tools::file_get_contents(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE)) {
                return false;
            }

            $sql = str_replace(array('PREFIX_', 'ENGINE_TYPE'), array(_DB_PREFIX_, _MYSQL_ENGINE_), $sql);
            $sql = preg_split("/;\s*[\r\n]+/", $sql);

            foreach ($sql as $query) {
                if ($query) {
                    if (!Db::getInstance()->execute(trim($query))) {
                        return false;
                    }
                }
            }
        }

        if (!parent::install()
        || !$this->registerHook('displayBackOfficeHeader')
        || !$this->registerHook('rightColumn')
        || !$this->registerHook('cart')
        || !$this->registerHook('displayCustomerAccount')
        || !$this->registerHook('displayHeader')
        || !$this->registerHook('adminCustomers')
        || !$this->registerHook('displayProductPriceBlock')
        || !$this->registerHook('displayNav2')
        || !$this->registerHook('displayCompareWishlistProMenu')
        || !$this->registerHook('displayCompareWishlistProButtons')
        || !$this->registerHook('displayCustomerSignInMenuLinks')) {
            return false;
        }

        $settings = $this->installSettings();
        $this->registerHook('displayMyAccountBlock');
        $this->prepareTemplate('add', $this->tpl_header, $settings['menu_hook_container'], 'menu');
        $this->prepareTemplate('add', $this->tpl_product, $settings['buttons_hook_container'], 'buttons');

        return true;
    }

    public function uninstall($delete_params = true)
    {
        $this->prepareTemplate('remove', $this->tpl_header);
        $this->prepareTemplate('remove', $this->tpl_product);

        if (($delete_params && !$this->deleteTables()) || !parent::uninstall()) {
            return false;
        }

        return true;
    }

    private function deleteTables()
    {
        return Db::getInstance()->execute(
            'DROP TABLE IF EXISTS
            `'._DB_PREFIX_.'wishlist`,
            `'._DB_PREFIX_.'wishlist_email`,
            `'._DB_PREFIX_.'wishlist_product`,
            `'._DB_PREFIX_.'wishlist_product_cart`,
            `'._DB_PREFIX_.'comparison`,
            `'._DB_PREFIX_.'comparison_product`'
        );
    }

    public function reset()
    {
        if (!$this->uninstall(false)) {
            return false;
        }

        if (!$this->install(false)) {
            return false;
        }

        return true;
    }

    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('controller') == 'AdminModules' && Tools::getValue('configure') == $this->name) {
            $css = array(
                $this->_path.'views/css/back.css',
            );

            $js = array(
                $this->_path.'views/js/back.js',
            );

            $this->context->controller->addCSS($css);
            $this->context->controller->addJquery();
            $this->context->controller->addJS($js);
        }
    }

    private function displayForm($form_action, $fields, $values)
    {
        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');

        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;
        $helper->languages = $this->context->controller->getLanguages();
        $helper->id_language = $this->context->language->id;
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = $form_action.$this->name;
        $helper->fields_value = $values;

        return $helper->generateForm(array(array('form' => $fields)));
    }

    private function assignSettings($settings)
    {
        if (!empty($settings)) {
            $result = array();

            foreach ($settings as $key => $value) {
                $result[$this->prefix.$key] = $value;
            }

            return $result;
        }
    }

    private function displayConfigurationForm($settings = null)
    {
        $fields_form = array(
            'legend' => array(
                'title' => $this->l('Product comparison settings'),
                'icon' => 'icon-wrench',
            ),
            'input' => array(
                array(
                    'type' => 'switch',
                    'label' => $this->l('Enable product comparison'),
                    'name' => $this->prefix.'comparison',
                    'values' => array(
                        array(
                          'value' => 1,
                        ),
                        array(
                          'value' => 0,
                        ),
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Show compare product buttons on catalog pages'),
                    'name' => $this->prefix.'comparison_catalog',
                    'values' => array(
                        array(
                          'value' => 1,
                        ),
                        array(
                          'value' => 0,
                        ),
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Show compare product buttons on product pages'),
                    'name' => $this->prefix.'comparison_product_pages',
                    'values' => array(
                        array(
                          'value' => 1,
                        ),
                        array(
                          'value' => 0,
                        ),
                    ),
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Comparison page layout'),
                    'name' => $this->prefix.'comparison_layout',
                    'options' => array(
                        'query' => array(
                            array(
                                'name' => $this->l('Single column'),
                                'value' => 1,
                            ),
                            array(
                                'name' => $this->l('Two columns'),
                                'value' => 2,
                            ),
                        ),
                        'id' => 'value',
                        'name' => 'name',
                    ),
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Comparison table navigation'),
                    'name' => $this->prefix.'comparison_navigation',
                    'options' => array(
                        'query' => array(
                            array(
                                'name' => $this->l('Buttons'),
                                'value' => 'buttons',
                            ),
                            array(
                                'name' => $this->l('Scroll'),
                                'value' => 'scroll',
                            ),
                        ),
                        'id' => 'value',
                        'name' => 'name',
                    ),
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Products per view (desktop)'),
                    'name' => $this->prefix.'comparison_table_items_desktop',
                    'desc' => $this->l('Select the maximum number of products that will be shown at once (i.e. without scrolling) in the comparison table in desktop browsers.'),
                    'options' => array(
                        'query' => array(
                            array(
                                'name' => 2,
                                'value' => 2,
                            ),
                            array(
                                'name' => 3,
                                'value' => 3,
                            ),
                            array(
                                'name' => 4,
                                'value' => 4,
                            ),
                            array(
                                'name' => 5,
                                'value' => 5,
                            ),
                        ),
                        'id' => 'value',
                        'name' => 'name',
                    ),
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Products per view (tablets)'),
                    'name' => $this->prefix.'comparison_table_items_tablet',
                    'desc' => $this->l('Select the maximum number of products that will be shown at once (i.e. without scrolling) in the comparison table on tablet computers.'),
                    'options' => array(
                        'query' => array(
                            array(
                                'name' => 2,
                                'value' => 2,
                            ),
                            array(
                                'name' => 3,
                                'value' => 3,
                            ),
                            array(
                                'name' => 4,
                                'value' => 4,
                            ),
                            array(
                                'name' => 5,
                                'value' => 5,
                            ),
                        ),
                        'id' => 'value',
                        'name' => 'name',
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Show product condition in comparison table'),
                    'name' => $this->prefix.'comparison_condition',
                    'values' => array(
                        array(
                          'value' => 1,
                        ),
                        array(
                          'value' => 0,
                        ),
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Show product brand in comparison table'),
                    'name' => $this->prefix.'comparison_manufacturer',
                    'values' => array(
                        array(
                          'value' => 1,
                        ),
                        array(
                          'value' => 0,
                        ),
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Hide features by default in comparison table'),
                    'name' => $this->prefix.'comparison_hide_features',
                    'values' => array(
                        array(
                          'value' => 1,
                        ),
                        array(
                          'value' => 0,
                        ),
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Show link sending form'),
                    'name' => $this->prefix.'comparison_show_email_block',
                    'desc' => $this->l('Show a form for sending comparison link via email below comparison table in single-column mode.'),
                    'values' => array(
                        array(
                          'value' => 1,
                        ),
                        array(
                          'value' => 0,
                        ),
                    ),
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right',
            ),
        );

        if ($settings == null || !is_array($settings)) {
            $settings = $this->getSettings();
        }

        return $this->displayForm('save_configuration', $fields_form, $this->assignSettings($settings));
    }

    private function displayWishlistConfigurationForm($settings = null)
    {
        $fields_form = array(
            'legend' => array(
                'title' => $this->l('Wishlist settings'),
                'icon' => 'icon-wrench',
            ),
            'input' => array(
                array(
                    'type' => 'switch',
                    'label' => $this->l('Enable wishlists'),
                    'name' => $this->prefix.'wishlists',
                    'values' => array(
                        array(
                          'value' => 1,
                        ),
                        array(
                          'value' => 0,
                        ),
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Show Add to wishlist buttons on catalog pages'),
                    'name' => $this->prefix.'wishlists_catalog',
                    'values' => array(
                        array(
                          'value' => 1,
                        ),
                        array(
                          'value' => 0,
                        ),
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Show Add to wishlist buttons on product pages'),
                    'name' => $this->prefix.'wishlists_product_pages',
                    'values' => array(
                        array(
                          'value' => 1,
                        ),
                        array(
                          'value' => 0,
                        ),
                    ),
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right',
            ),
        );

        if ($settings == null || !is_array($settings)) {
            $settings = $this->getSettings();
        }

        return $this->displayForm('save_wishlist_configuration', $fields_form, $this->assignSettings($settings));
    }

    private function displayAppearanceForm($settings = null)
    {
        $fields_form = array(
            'legend' => array(
                'title' => $this->l('Appearance'),
                'icon' => 'icon-eye',
            ),
            'input' => array(
                array(
                    'type' => 'switch',
                    'label' => $this->l('Show action icons on hover only'),
                    'name' => $this->prefix.'icons_on_hover',
                    'values' => array(
                        array(
                          'value' => 1,
                        ),
                        array(
                          'value' => 0,
                        ),
                    ),
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Action buttons appearance'),
                    'name' => $this->prefix.'link_elements',
                    'options' => array(
                        'query' => array(
                            array(
                                'name' => $this->l('Text and icon'),
                                'value' => 'all',
                            ),
                            array(
                                'name' => $this->l('Text only'),
                                'value' => 'text',
                            ),
                            array(
                                'name' => $this->l('Icon only'),
                                'value' => 'icon',
                            ),
                        ),
                        'id' => 'value',
                        'name' => 'name',
                    ),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Mobile menu items container class'),
                    'name' => $this->prefix.'menu_hook_container',
                    'class' => 'fixed-width-xxl',
                    'desc' => $this->l('Specify the class name of the element in page header template (header.tpl) that will contain mobile menu links to product comparison and wishlist. A custom hook will be added inside this element.'),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Product page buttons container class'),
                    'name' => $this->prefix.'buttons_hook_container',
                    'class' => 'fixed-width-xxl',
                    'desc' => $this->l('Specify the class name of the element in product page template (product-add-to-cart.tpl) that will contain product comparison and wishlist buttons. A custom hook will be added inside this element.'),
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right',
            ),
        );

        if ($settings == null || !is_array($settings)) {
            $settings = $this->getSettings();
        }

        return $this->displayForm('save_appearance_configuration', $fields_form, $this->assignSettings($settings));
    }

    private function validateSwitches($switches)
    {
        if (!is_array($switches)) {
            $switches = array();
        }

        foreach ($switches as $switch_name => $value) {
            if (!Validate::isBool($value)) {
                $switches[$switch_name] = 0;
            }
        }

        return $switches;
    }

    public function getContent()
    {
        $message = $active_tab = null;
        $values = $errors = array();

        if (Tools::isSubmit('view'.$this->name) && $id = Tools::getValue('id_product')) {
            Tools::redirect($this->context->link->getProductLink($id));
        } elseif (Tools::isSubmit('submitSettings')) {
            $activated = Tools::getValue('activated');

            if ($activated != 0 && $activated != 1) {
                $this->html .= $this->displayError($this->l('Activate module : Invalid choice.'));
            }

            $this->html .= $this->displayConfirmation($this->l('Settings updated'));
        } elseif (Tools::isSubmit('save_configuration'.$this->name)) {
            $active_tab = 'settings';
            $values = array(
                'comparison' => (int)Tools::getValue($this->prefix.'comparison'),
                'comparison_catalog' => (int)Tools::getValue($this->prefix.'comparison_catalog'),
                'comparison_product_pages' => (int)Tools::getValue($this->prefix.'comparison_product_pages'),
                'comparison_condition' => (int)Tools::getValue($this->prefix.'comparison_condition'),
                'comparison_manufacturer' => (int)Tools::getValue($this->prefix.'comparison_manufacturer'),
                'comparison_hide_features' => (int)Tools::getValue($this->prefix.'comparison_hide_features'),
                'comparison_show_email_block' => (int)Tools::getValue($this->prefix.'comparison_show_email_block'),
            );

            $values = $this->validateSwitches($values);
            $values['comparison_layout'] = (int)Tools::getValue($this->prefix.'comparison_layout');
            $values['comparison_navigation'] = Tools::getValue($this->prefix.'comparison_navigation');
            $values['comparison_table_items_desktop'] = (int)Tools::getValue(
                $this->prefix.'comparison_table_items_desktop'
            );
            $values['comparison_table_items_tablet'] = (int)Tools::getValue(
                $this->prefix.'comparison_table_items_tablet'
            );

            if (!in_array($values['comparison_layout'], array(1, 2))) {
                $values['comparison_layout'] = 1;
            }

            if (!in_array($values['comparison_table_items_desktop'], array(2, 3, 4, 5))) {
                $values['comparison_table_items_desktop'] = 5;
            }

            if (!in_array($values['comparison_table_items_tablet'], array(2, 3, 4, 5))) {
                $values['comparison_table_items_tablet'] = 4;
            }

            if (!in_array($values['comparison_navigation'], array('buttons', 'scroll'))) {
                $values['comparison_navigation'] = 'buttons';
            }
        } elseif (Tools::isSubmit('save_wishlist_configuration'.$this->name)) {
            $active_tab = 'wishlist_settings';
            $values = array(
                'wishlists' => (int)Tools::getValue($this->prefix.'wishlists'),
                'wishlists_catalog' => (int)Tools::getValue($this->prefix.'wishlists_catalog'),
                'wishlists_product_pages' => (int)Tools::getValue($this->prefix.'wishlists_product_pages'),
            );

            $values = $this->validateSwitches($values);
            $values['comparison_layout'] = (int)Tools::getValue($this->prefix.'comparison_layout');
            $values['comparison_navigation'] = Tools::getValue($this->prefix.'comparison_navigation');

            if (!in_array($values['comparison_layout'], array(1, 2))) {
                $values['comparison_layout'] = 1;
            }

            if (!in_array($values['comparison_navigation'], array('buttons', 'scroll'))) {
                $values['comparison_navigation'] = 'buttons';
            }
        } elseif (Tools::isSubmit('save_appearance_configuration'.$this->name)) {
            $active_tab = 'appearance';
            $values = array(
                'icons_on_hover' => (int)Tools::getValue($this->prefix.'icons_on_hover'),
            );

            $values = $this->validateSwitches($values);
            $values['link_elements'] = Tools::getValue($this->prefix.'link_elements');
            $values['menu_hook_container'] = Tools::getValue($this->prefix.'menu_hook_container');
            $values['buttons_hook_container'] = Tools::getValue($this->prefix.'buttons_hook_container');

            if (!in_array($values['link_elements'], array('all', 'text', 'icon'))) {
                $values['link_elements'] = 'all';
            }

            if (!$this->isClassName($values['menu_hook_container'])) {
                $values['menu_hook_container'] = null;
                $errors[] = $this->l('Please specify a valid mobile menu items container class.');
            }

            if (!$this->isClassName($values['buttons_hook_container'])) {
                $values['buttons_hook_container'] = null;
                $errors[] = $this->l('Please specify a valid product page buttons container class.');
            }
        }

        if (!empty($values)) {
            if (empty($errors)) {
                $settings = $this->getSettings();

                if (!empty($values['menu_hook_container'])
                && $values['menu_hook_container'] != $settings['menu_hook_container']) {
                    $this->prepareTemplate('remove', $this->tpl_header);
                    $this->prepareTemplate('add', $this->tpl_header, $values['menu_hook_container'], 'menu');
                }

                if (!empty($values['buttons_hook_container'])
                && $values['buttons_hook_container'] != $settings['buttons_hook_container']) {
                    $this->prepareTemplate('remove', $this->tpl_product);
                    $this->prepareTemplate('add', $this->tpl_product, $values['buttons_hook_container'], 'buttons');
                }

                foreach ($values as $key => $value) {
                    $settings[$key] = $value;
                }

                $this->saveSettings($settings);
                $message = $this->displayConfirmation($this->l('Settings updated'));
            } else {
                $message = $this->displayError(implode(' • ', $errors));
            }
        }

        $this->html .= $this->renderForm();

        $id_customer = Tools::getValue('id_customer', false);
        $id_wishlist = Tools::getValue('id_wishlist', false);

        if ($id_customer || $id_wishlist) {
            $active_tab = 'wishlists';

            if ($id_customer && $id_wishlist) {
                $this->html .= $this->renderList((int)$id_wishlist);
            }
        } elseif (!$active_tab) {
            $active_tab = 'settings';
        }

        $this->context->smarty->assign(array($this->name => array(
            'documentation_link' => $this->_path.'readme_en.pdf',
            'message' => $message,
            'active_tab' => $active_tab,
            'configuration_form' => $this->displayConfigurationForm(),
            'wishlist_configuration_form' => $this->displayWishlistConfigurationForm(),
            'appearance_form' => $this->displayAppearanceForm(),
            'wishlists_form' => $this->html,
            'changelog' => $this->displayChangelog(),
            'version' => $this->version,
            'module_id' => $this->module_id,
            'products' => $this->getPublishedProducts(Tools::getValue('promo_product'), 0),
            'module_path' => $this->_path,
            'promo_mode' => Tools::getValue('promo_mode'),
        )));

        return $this->display($this->local_path, 'views/templates/admin/configure.tpl');
    }

    public function hookDisplayHeader($params)
    {
        $path_css = 'modules/'.$this->name.'/views/css/';
        $path_js = 'modules/'.$this->name.'/views/js/';

        $this->context->controller->registerStylesheet(
            $this->name.'-awn',
            $path_css.'awn.css'
        );
        $this->context->controller->registerStylesheet(
            $this->name.'-front',
            $path_css.'front.css'
        );

        $this->context->controller->addJquery();
        $this->context->controller->registerJavascript(
            $this->name.'-awn',
            $path_js.'awn.js'
        );
        $this->context->controller->registerJavascript(
            $this->name.'-front',
            $path_js.'front.js'
        );

        $is_logged = $wishlist_products = $wishlists = false;
        $template_vars = array(
            'wishlist_link' => $this->context->link->getModuleLink($this->name, 'mywishlist'),
        );

        if ($this->context->customer->isLogged()) {
            $wishlists = Wishlist::getByIdCustomer($this->context->customer->id);

            if (empty($this->context->cookie->id_wishlist) === true
            || WishList::exists($this->context->cookie->id_wishlist, $this->context->customer->id) === false) {
                if (!count($wishlists)) {
                    $id_wishlist = false;
                } else {
                    $id_wishlist = (int)$wishlists[0]['id_wishlist'];
                    $this->context->cookie->id_wishlist = (int)$id_wishlist;
                }
            } else {
                $id_wishlist = $this->context->cookie->id_wishlist;
            }

            $is_logged = true;
            $wishlist_products = ($id_wishlist == false) ? false : WishList::getProductByIdCustomer(
                $id_wishlist,
                $this->context->customer->id,
                $this->context->language->id,
                null,
                true
            );

            $template_vars['id_wishlist'] = $id_wishlist;
            $template_vars['ptoken'] = Tools::getToken(false);
        }

        $this->smarty->assign($template_vars);
        $settings = $this->getSettings();

        Media::addJsDef(array($this->name => array(
            'ModuleDir' => sprintf('%s%s/', _MODULE_DIR_, $this->name),
            'wishlistProductsIds' => $wishlist_products,
            'loggin_required' => $this->l('You must be logged in to manage your wishlist.'),
            'added_to_wishlist' => $this->l('%s has been successfully added to your wishlist.'),
            'added_to_comparison' => $this->l('%s has been successfully added to comparison.'),
            'removed_from_wishlist' => $this->l('%s has been successfully removed from your wishlist.'),
            'removed_from_comparison' => $this->l('%s has been successfully removed from comparison.'),
            'comparison_login_required' => $this->l('You must be logged in to compare products.'),
            'comparison_link' => sprintf(
                '<a class="comparison-link" href="%s">%s</a>',
                $this->context->link->getModuleLink($this->name, 'comparison'),
                $this->l('Compare products')
            ),
            'comparison_image' => '<img class="comparison-preview" src="%s" />',
            'comparison_table_items_desktop' => $settings['comparison_table_items_desktop'],
            'comparison_table_items_tablet' => $settings['comparison_table_items_tablet'],
            'mywishlist_url' => $this->context->link->getModuleLink($this->name, 'mywishlist', array(), true),
            'controller' => array(
                'buywishlistproduct' => $this->context->link->getModuleLink($this->name, 'buywishlistproduct'),
                'cart' => $this->context->link->getModuleLink($this->name, 'cart'),
                'comparisontools' => $this->context->link->getModuleLink($this->name, 'comparisontools'),
                'managewishlist' => $this->context->link->getModuleLink($this->name, 'managewishlist'),
                'sendwishlist' => $this->context->link->getModuleLink($this->name, 'sendwishlist'),
            ),
            'isLoggedWishlist' => $is_logged,
            'isLogged' => $is_logged,
            'static_token' => Tools::getToken(false),
            'icons_on_hover' => $settings['icons_on_hover'],
        )));
    }

    public function hookRightColumn($params)
    {
        if ($this->context->customer->isLogged()) {
            $wishlists = Wishlist::getByIdCustomer($this->context->customer->id);

            if (empty($this->context->cookie->id_wishlist) === true
            || WishList::exists($this->context->cookie->id_wishlist, $this->context->customer->id) === false) {
                if (!count($wishlists)) {
                    $id_wishlist = false;
                } else {
                    $id_wishlist = (int)$wishlists[0]['id_wishlist'];
                    $this->context->cookie->id_wishlist = (int)$id_wishlist;
                }
            } else {
                $id_wishlist = $this->context->cookie->id_wishlist;
            }

            $this->smarty->assign(array(
                'id_wishlist' => $id_wishlist,
                'isLogged' => true,
                'wishlist_products' => ($id_wishlist == false) ? false : WishList::getProductByIdCustomer(
                    $id_wishlist,
                    $this->context->customer->id,
                    $this->context->language->id,
                    null,
                    true
                ),
                'wishlists' => $wishlists,
                'ptoken' => Tools::getToken(false),
            ));
        } else {
            $this->smarty->assign(array('wishlist_products' => false, 'wishlists' => false));
        }

        return ($this->display(__FILE__, 'views/templates/front/easywishlist.tpl'));
    }

    public function hookLeftColumn($params)
    {
        return $this->hookRightColumn($params);
    }

    public function hookDisplayCompareWishlistProButtons($params)
    {
        $cookie = $params['cookie'];
        $settings = $this->getSettings();

        $this->smarty->assign(array(
            'id_product' => (int)Tools::getValue('id_product'),
            'product_name' => $params['product']->name,
            'image_preview' => $params['product']->cover['bySize'][ImageType::getFormattedName('small')]['url'],
            'comparison_enabled' => $settings['comparison'],
            'comparison_product_pages_enabled' => $settings['comparison_product_pages'],
            'comparison_products' => $this->getComparisonProducts(),
            'wishlists_enabled' => $settings['wishlists'],
            'wishlists_product_pages_enabled' => $settings['wishlists_product_pages'],
            'wishlists_products' => $this->getWishlistsProducts($this->context->customer->id),
            'appearance' => $settings['link_elements'],
        ));

        if (isset($cookie->id_customer)) {
            $this->smarty->assign(array(
                'wishlists' => WishList::getByIdCustomer($cookie->id_customer),
            ));
        }

        return ($this->display(__FILE__, 'views/templates/front/easywishlist-extra.tpl'));
    }

    private function displayModuleLinks($position)
    {
        $this->smarty->assign(array(
            'link' => $this->context->link,
        ));

        if ($position == 'account') {
            $template = 'my-account.tpl';
        } else {
            $template = 'my-account-links.tpl';
        }

        return $this->display(__FILE__, 'views/templates/front/'.$template);
    }

    public function hookDisplayCustomerAccount($params)
    {
        return $this->displayModuleLinks('account');
    }

    public function hookDisplayMyAccountBlock($params)
    {
        return $this->displayModuleLinks('footer');
    }

    private function displayProducts($id_wishlist)
    {
        include_once(dirname(__FILE__).'/classes/WishList.php');

        $wishlist = new WishList($id_wishlist);
        $products = WishList::getProductByIdCustomer(
            $id_wishlist,
            $wishlist->id_customer,
            $this->context->language->id
        );
        $nb_products = count($products);
        $priority = array($this->l('High'), $this->l('Medium'), $this->l('Low'));
        $image_type = ImageType::getFormatedName('small');

        for ($i = 0; $i < $nb_products; ++$i) {
            $obj = new Product((int)$products[$i]['id_product'], false, $this->context->language->id);

            if (!Validate::isLoadedObject($obj)) {
                continue;
            } else {
                $images = $obj->getImages($this->context->language->id);

                foreach ($images as $image) {
                    if ($image['cover']) {
                        $products[$i]['cover'] = $obj->id.'-'.$image['id_image'];
                        break;
                    }
                }

                if (!isset($products[$i]['cover'])) {
                    $products[$i]['cover'] = $this->context->language->iso_code.'-default';
                }

                $products[$i]['image_link'] = $this->context->link->getImageLink(
                    $products[$i]['link_rewrite'],
                    $products[$i]['cover'],
                    $image_type
                );
            }

            $products[$i]['priority'] = $priority[(int)$products[$i]['priority'] % 3];
        }

        $this->context->smarty->assign(array(
            'products' => $products,
        ));

        return $this->display($this->local_path, 'views/templates/hook/display-wishlist-products.tpl');
    }

    public function hookAdminCustomers($params)
    {
        $customer = new Customer((int)$params['id_customer']);

        if (!Validate::isLoadedObject($customer)) {
            die(Tools::displayError());
        }

        $wishlists = WishList::getByIdCustomer((int)$customer->id);
        $id_wishlist = $products = null;

        if (count($wishlists)) {
            $id_wishlist = (int)Tools::getValue('id_wishlist');

            if (!$id_wishlist) {
                $id_wishlist = $wishlists[0]['id_wishlist'];
            }

            $products = $this->displayProducts($id_wishlist);
        }

        $this->context->smarty->assign(array(
            'wishlists' => $wishlists,
            'id_wishlist' => $id_wishlist,
            'request_uri' => $_SERVER['REQUEST_URI'],
            'products' => $products,
            'first_name' => $customer->firstname,
            'last_name' => $customer->lastname,
        ));

        return $this->display($this->local_path, 'views/templates/hook/display-admin-customers.tpl');
    }

    public function errorLogged()
    {
        return $this->l('You must be logged in to manage your wishlists.');
    }

    public function renderForm()
    {
        $customers = array();

        foreach (WishList::getCustomers() as $c) {
            $customers[$c['id_customer']]['id_customer'] = $c['id_customer'];
            $customers[$c['id_customer']]['name'] = $c['firstname'].' '.$c['lastname'];
        }

        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Listing'),
                    'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'select',
                        'label' => $this->l('Customers :'),
                        'name' => 'id_customer',
                        'options' => array(
                            'default' => array('value' => 0, 'label' => $this->l('Choose customer')),
                            'query' => $customers,
                            'id' => 'id_customer',
                            'name' => 'name',
                        ),
                    )
                ),
            ),
        );

        if ($id_customer = Tools::getValue('id_customer')) {
            $wishlists = WishList::getByIdCustomer($id_customer);
            $fields_form['form']['input'][] = array(
                'type' => 'select',
                'label' => $this->l('Wishlist :'),
                'name' => 'id_wishlist',
                'options' => array(
                    'default' => array('value' => 0, 'label' => $this->l('Choose wishlist')),
                    'query' => $wishlists,
                    'id' => 'id_wishlist',
                    'name' => 'name',
                ),
            );
        }

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ?
            Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name
            .'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($fields_form));
    }

    public function getConfigFieldsValues()
    {
        return array(
            'id_customer' => Tools::getValue('id_customer'),
            'id_wishlist' => Tools::getValue('id_wishlist'),
        );
    }

    public function renderList($id_wishlist)
    {
        $wishlist = new WishList($id_wishlist);
        $products = WishList::getProductByIdCustomer(
            $id_wishlist,
            $wishlist->id_customer,
            $this->context->language->id
        );

        foreach ($products as $key => $val) {
            $image = Image::getCover($val['id_product']);
            $products[$key]['image'] = $this->context->link->getImageLink(
                $val['link_rewrite'],
                $image['id_image'],
                ImageType::getFormatedName('small')
            );
        }

        $fields_list = array(
            'image' => array(
                'title' => $this->l('Image'),
                'type' => 'image',
            ),
            'name' => array(
                'title' => $this->l('Product'),
                'type' => 'text',
            ),
            'attributes_small' => array(
                'title' => $this->l('Combination'),
                'type' => 'text',
            ),
            'quantity' => array(
                'title' => $this->l('Quantity'),
                'type' => 'text',
            ),
            'priority' => array(
                'title' => $this->l('Priority'),
                'type' => 'priority',
                'values' => array($this->l('High'), $this->l('Medium'), $this->l('Low')),
            ),
        );

        $helper = new HelperList();
        $helper->shopLinkType = '';
        $helper->simple_header = true;
        $helper->no_link = true;
        $helper->actions = array('view');
        $helper->show_toolbar = false;
        $helper->module = $this;
        $helper->identifier = 'id_product';
        $helper->title = $this->l('Product list');
        $helper->table = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
        $helper->tpl_vars = array('priority' => array($this->l('High'), $this->l('Medium'), $this->l('Low')));

        return $helper->generateList($products, $fields_list);
    }

    public function getFeatures()
    {
        return Db::getInstance()->executeS(sprintf(
            'SELECT f.`id_feature`, fl.`name`
            FROM `%1$sfeature` f
            LEFT JOIN `%1$sfeature_lang` fl ON (f.`id_feature` = fl.`id_feature`)
            WHERE fl.`id_lang` = %2$d
            ORDER BY f.`position` ASC',
            _DB_PREFIX_,
            (int)$this->context->language->id
        ));
    }

    private function getComparisonProducts()
    {
        if ($this->comparison_products === null) {
            if (isset($this->context->cookie->product_comparison)) {
                $this->comparison_products = Tools::jsonDecode($this->context->cookie->product_comparison, true);
            } else {
                $this->comparison_products = array();
            }
        }

        return $this->comparison_products;
    }

    private function getWishlistsProducts($id_customer, $default_wishlist = false)
    {
        if ($this->wishlists_products === null) {
            $this->wishlists_products = WishList::getProductIdsByIdCustomer($id_customer, $default_wishlist);
        }

        return $this->wishlists_products;
    }

    private function getCustomerWishlists($id_customer)
    {
        if ($this->customer_wishlists === null) {
            $this->customer_wishlists = WishList::getByIdCustomer($id_customer);
        }

        return $this->customer_wishlists;
    }

    public function hookDisplayProductPriceBlock($params)
    {
        if ($params['type'] == 'unit_price') {
            $settings = $this->getSettings();

            if (($settings['comparison'] == 1 && $settings['comparison_catalog'] == 1)
            || ($settings['wishlists'] == 1 && $settings['wishlists_catalog'] == 1)) {
               if (isset($params['product'])) {
                    $template_vars = array(
                        'id_product' => ((isset($params['product']['id']))?(int)$params['product']['id']:(int)$params['product']['id_product']),
                        'product_name' => $params['product']['name'],
                        'image_preview' =>
                            ((isset($params['product']['cover']))?$params['product']['cover']['bySize'][ImageType::getFormattedName('small')]['url']:''),
                        'comparison_enabled' => $settings['comparison'],
                        'comparison_catalog_enabled' => $settings['comparison_catalog'],
                        'comparison_products' => $this->getComparisonProducts(),
                        'wishlists_enabled' => $settings['wishlists'],
                        'wishlists_catalog_enabled' => $settings['wishlists_catalog'],
                        'wishlists_products' => $this->getWishlistsProducts($this->context->customer->id, true),
                        'icons_on_hover' => $settings['icons_on_hover'],
                    );

                    $this->smarty->assign($template_vars);

                    return $this->display(__FILE__, 'views/templates/front/easywishlist-catalog.tpl');
               }
            }
        }
    }

    private function displayNav($tpl = 'display-nav.tpl', $folder = 'front')
    {
        $settings = $this->getSettings();
        $template_vars = array(
            'comparison' => $settings['comparison'],
            'wishlists' => $settings['wishlists'],
            'appearance' => $settings['link_elements'],
        );

        if ($settings['comparison'] == 1) {
            $product_count = 0;

            if (isset($this->context->cookie->product_comparison)) {
                $product_ids = Tools::jsonDecode($this->context->cookie->product_comparison, true);

                if (!empty($product_ids)) {
                    $product_count = count($product_ids);
                }
            }

            $template_vars['product_comparison_page_url'] = $this->context->link->getModuleLink(
                $this->name,
                'comparison'
            );
            $template_vars['product_comparison_count'] = $product_count;
        }

        if ($settings['wishlists'] == 1) {
            $product_count = 0;

            if ($this->context->customer->isLogged()) {
                $product_count = Wishlist::getProductCountByIdCustomer($this->context->customer->id);
            }

            $template_vars['wishlist_page_url'] = $this->context->link->getModuleLink($this->name, 'mywishlist');
            $template_vars['wishlist_product_count'] = $product_count;
        }

        if (!empty($template_vars)) {
            $this->smarty->assign($template_vars);

            return $this->display(__FILE__, sprintf('views/templates/%s/%s', $folder, $tpl));
        }
    }

    public function hookDisplayNav2()
    {
        return $this->displayNav('display-nav.tpl');
    }

    public function hookDisplayCompareWishlistProMenu()
    {
        return $this->displayNav('display-nav-mobile.tpl');
    }

    public function hookDisplayCustomerSignInMenuLinks()
    {
        return $this->displayNav('display-customer-sign-in-menu-links.tpl', 'hook');
    }
}
