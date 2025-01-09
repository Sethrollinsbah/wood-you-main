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
if (!defined('_PS_VERSION_')) {
    exit;
}

require realpath(dirname(__FILE__)) . '/config/config.inc.php';

class Lggoogleanalytics extends Module
{
    const LIMIT_LOG = 25;

    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'lggoogleanalytics';
        $this->tab = 'front_office_features';
        $this->version = '1.1.7';
        $this->author = 'Línea Gráfica';
        $this->need_instance = 0;
        $this->id_product = 51446;
        $this->module_key = 'af795d2fb7f191304c0ef61a5472dfa9';

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Google Analytics 4');
        $this->description = $this->l('It allows you to measure Google Analytics 4 events by adding additional events 
        related to e-commerce.');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        require_once dirname(__FILE__) . '/sql/install.php';

        $install = parent::install() &&
            $this->registerHook('displayBackOfficeHeader') &&
            $this->registerHook('displayHeader');

        Configuration::updateValue('LGGOOGLEANALYTICS_ID', '');
        Configuration::updateValue('LGGOOGLEANALYTICS_ENABLE_DEBUG', false);
        Configuration::updateValue('LGGOOGLEANALYTICS_PURCHASE', false);
        Configuration::updateValue('LGGOOGLEANALYTICS_BEGIN_CHECKOUT', false);
        Configuration::updateValue('LGGOOGLEANALYTICS_VIEW_ITEM', false);
        Configuration::updateValue('LGGOOGLEANALYTICS_VIEW_ITEM_LIST', false);
        Configuration::updateValue('LGGOOGLEANALYTICS_VIEW_CART', false);
        Configuration::updateValue('LGGOOGLEANALYTICS_ADD_TO_CART', false);

        Configuration::updateValue('LGGOOGLEANALYTICS_UA', '');

        Configuration::updateValue('LGGOOGLEANALYTICS_GADS_ID', '');
        Configuration::updateValue('LGGOOGLEANALYTICS_GADS_TAG', '');

        Configuration::updateValue('LGGOOGLEANALYTICS_ECOMM', false);
        Configuration::updateValue('LGGOOGLEANALYTICS_ECOMM_PRODID', 1);
        Configuration::updateValue('LGGOOGLEANALYTICS_ECOMM_PAGETYPE', 2);
        Configuration::updateValue('LGGOOGLEANALYTICS_ECOMM_TOTALVALUE', 3);
        Configuration::updateValue('LGGOOGLEANALYTICS_ECOMM_CATEGORY', 4);
        // Configuration::updateValue('LGGOOGLEANALYTICS_MC_PREFIX', '');
        // Configuration::updateValue('LGGOOGLEANALYTICS_MC_SUFIX', '');

        return $install;
    }

    public function uninstall()
    {
        Configuration::deleteByName('LGGOOGLEANALYTICS_ID');
        Configuration::deleteByName('LGGOOGLEANALYTICS_PURCHASE');
        Configuration::deleteByName('LGGOOGLEANALYTICS_BEGIN_CHECKOUT');
        Configuration::deleteByName('LGGOOGLEANALYTICS_VIEW_ITEM');
        Configuration::deleteByName('LGGOOGLEANALYTICS_VIEW_ITEM_LIST');
        Configuration::deleteByName('LGGOOGLEANALYTICS_VIEW_CART');
        Configuration::deleteByName('LGGOOGLEANALYTICS_ADD_TO_CART');

        Configuration::deleteByName('LGGOOGLEANALYTICS_UA');

        Configuration::deleteByName('LGGOOGLEANALYTICS_GADS_ID');
        Configuration::deleteByName('LGGOOGLEANALYTICS_GADS_TAG');

        Configuration::deleteByName('LGGOOGLEANALYTICS_ECOMM');
        Configuration::deleteByName('LGGOOGLEANALYTICS_ECOMM_PRODID');
        Configuration::deleteByName('LGGOOGLEANALYTICS_ECOMM_PAGETYPE');
        Configuration::deleteByName('LGGOOGLEANALYTICS_ECOMM_TOTALVALUE');
        Configuration::deleteByName('LGGOOGLEANALYTICS_ECOMM_CATEGORY');
        // Configuration::deleteByName('LGGOOGLEANALYTICS_MC_PREFIX');
        // Configuration::deleteByName('LGGOOGLEANALYTICS_MC_SUFIX');

        require_once dirname(__FILE__) . '/sql/uninstall.php';

        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        $lg_help_url = is_dir(dirname(__FILE__) . '/views/img/help/' . $this->context->language->iso_code)
            ? _MODULE_DIR_ . $this->name . '/views/img/help/' . $this->context->language->iso_code
            : _MODULE_DIR_ . $this->name . '/views/img/help/en';
        LGGoogleAnalyticsPubli::setModule($this);

        $params = array(
            'lg_id_product' => $this->id_product,
            'lg_module_dir' => $this->_path,
            'lg_module_name' => $this->name,
            'lg_base_url' => _MODULE_DIR_ . $this->name . '/',
            'lg_help_url' => $lg_help_url . '/',
            'lg_iso_code' => $this->context->language->iso_code,
        );

        $this->context->smarty->assign($params);

        switch (Tools::getValue('tab_lg')) {
            case 'remarketing':
                $this->postProcessRemarketing();
                $form = $this->renderFormRemarketing();
                $extra_params = array(
                    'lg_form' => $form,
                );
                $this->context->smarty->assign($extra_params);

                $body = $this->context->smarty->fetch($this->local_path . 'views/templates/admin/body.tpl');
                break;
            case 'ads':
                $this->postProcessAds();
                $form = $this->renderFormAds();
                $extra_params = array(
                    'lg_form' => $form,
                );
                $this->context->smarty->assign($extra_params);

                $body = $this->context->smarty->fetch($this->local_path . 'views/templates/admin/body.tpl');
                break;
            case 'help':
                $body = $this->context->smarty->fetch($this->local_path . 'views/templates/admin/help.tpl');
                break;
            case 'debug':
                $list_event = $this->renderDebugListEvent();
                $list_assign = $this->renderDebugListLogAssign();
                $list_unassign = $this->renderDebugListLogUnassign();
                $extra_params = array(
                    'lg_list_debug' => $list_event,
                    'lg_list_assign' => $list_assign,
                    'lg_list_unassign' => $list_unassign,
                );
                $this->context->smarty->assign($extra_params);

                $body = $this->context->smarty->fetch($this->local_path . 'views/templates/admin/debug.tpl');
                break;
            default:
                $this->postProcess();
                $form = $this->renderForm();
                $extra_params = array(
                    'lg_form' => $form,
                );
                $this->context->smarty->assign($extra_params);

                $body = $this->context->smarty->fetch($this->local_path . 'views/templates/admin/body.tpl');
                break;
        }

        $params = array(
            'lg_menu' => $this->getMenu(),
        );

        $this->context->smarty->assign($params);

        $header = LGGoogleAnalyticsPubli::renderHeader();
        $footer = LGGoogleAnalyticsPubli::renderFooter();

        return $header . $body . $footer;
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submit' . Tools::ucfirst($this->name) . 'Module';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', true) .
        '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name .
        '&tab_lg=' . Tools::getValue('tab_lg');
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderFormRemarketing()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submit' . Tools::ucfirst($this->name) . 'Module';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', true) .
            '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name .
            '&tab_lg=' . Tools::getValue('tab_lg');
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValuesRemarketing(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigFormRemarketing()));
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderFormAds()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submit' . Tools::ucfirst($this->name) . 'Module';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', true) .
            '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name .
            '&tab_lg=' . Tools::getValue('tab_lg');
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValuesAds(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigFormAds()));
    }

    /**
     * Create the list of log events.
     */
    protected function renderDebugListEvent()
    {
        $helper = new HelperList();

        $list_events = LggoogleanalyticsEvent::getList(self::LIMIT_LOG);

        $fields_events = array(
            'date_add' => array(
                'title' => $this->l('Date'),
                'type' => 'datetime',
                'align' => 'text-center',
            ),
            'event' => array(
                'title' => $this->l('Event'),
                'type' => 'text',
            ),
            'event_id' => array(
                'title' => $this->l('Object ID'),
                'type' => 'text',
                'align' => 'text-center',
            ),
            'params' => array(
                'title' => $this->l('Params'),
                'type' => 'text',
            ),
        );



        $helper->show_toolbar = false;
        $helper->shopLinkType = '';
        $helper->simple_header = true;
        $helper->actions = array();
        $helper->module = $this;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
//        $helper->listTotal = count($list_events);
//        $helper->_default_pagination = 20;

        $helper->tpl_vars = array(
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        $helper->identifier =  LggoogleanalyticsEvent::$definition['primary'];
        $helper->title = $this->l('Last Submit GA4 events');
        $helper->table = LggoogleanalyticsEvent::$definition['table'];
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name.
            '&module_name='.$this->name.'&tab_name='.$this->tab.'&tab_lg=debug';
        $helper->orderBy = 'date_add';
        $helper->orderBy = 'desc';

        $list = $helper->generateList($list_events, $fields_events);

        return $list;
    }

    protected function renderDebugListLogAssign()
    {
        $helper = new HelperList();

        $list_events = LggoogleanalyticsLog::getList(true, self::LIMIT_LOG);

        $fields_events = array(
            'date_add' => array(
                'title' => $this->l('Date'),
                'type' => 'datetime',
                'align' => 'text-center',
            ),
            'controller' => array(
                'title' => $this->l('Controller'),
                'type' => 'text',
            ),
            'event' => array(
                'title' => $this->l('Event'),
                'type' => 'text',
            ),
            'params' => array(
                'title' => $this->l('Params'),
                'type' => 'text',
            ),
        );



        $helper->show_toolbar = false;
        $helper->shopLinkType = '';
        $helper->simple_header = true;
        $helper->actions = array();
        $helper->show_toolbar = false;
        $helper->module = $this;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        $helper->identifier =  LggoogleanalyticsLog::$definition['primary'];
        $helper->title = $this->l('Last Events Detected');
        $helper->table = LggoogleanalyticsLog::$definition['table'];
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name.
            '&module_name='.$this->name.'&tab_name='.$this->tab.'&tab_lg=debug';
        $helper->orderBy = 'date_add';
        $helper->orderBy = 'desc';
        $helper->limit = self::LIMIT_LOG;

        $list = $helper->generateList($list_events, $fields_events);

        return $list;
    }

    protected function renderDebugListLogUnassign()
    {
        $helper = new HelperList();

        $list_events = LggoogleanalyticsLog::getList(false, self::LIMIT_LOG);

        $fields_events = array(
            'date_add' => array(
                'title' => $this->l('Date'),
                'type' => 'datetime',
                'align' => 'text-center',
            ),
            'controller' => array(
                'title' => $this->l('Controller'),
                'type' => 'text',
            ),
            'params' => array(
                'title' => $this->l('Params'),
                'type' => 'text',
            ),
        );



        $helper->show_toolbar = false;
        $helper->shopLinkType = '';
        $helper->simple_header = true;
        $helper->actions = array();
        $helper->show_toolbar = false;
        $helper->module = $this;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        $helper->identifier =  LggoogleanalyticsLog::$definition['primary'];
        $helper->title = $this->l('Last Events no Detected');
        $helper->table = LggoogleanalyticsLog::$definition['table'];
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name.
            '&module_name='.$this->name.'&tab_name='.$this->tab.'&tab_lg=debug';
        $helper->orderBy = 'date_add';
        $helper->orderBy = 'desc';
        $helper->limit = self::LIMIT_LOG;

        $list = $helper->generateList($list_events, $fields_events);

        return $list;
    }

    protected function getMenu()
    {
        $tab = Tools::getValue('tab_lg');
        $tab_link = $this->context->link->getAdminLink('AdminModules', true)
        . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&tab_lg=';

        $menu = array();
        $menu[] = array(
            'label' => $this->l('Google Analytics 4'),
            'link' => $tab_link . 'settings',
            'active' => ($tab == 'settings' || empty($tab) ? 1 : 0),
        );

/* OCULTAMOS NUEVAS OPCIONES HASTA ESTAR CONCLUIDO

        $menu[] = array(
            'label' => $this->l('Google Ads'),
            'link' => $tab_link . 'ads',
            'active' => ($tab == 'ads'  ? 1 : 0),
        );
        $menu[] = array(
            'label' => $this->l('Dinamic Remarketing'),
            'link' => $tab_link . 'remarketing',
            'active' => ($tab == 'remarketing'  ? 1 : 0),
        );

*/
        $menu[] = array(
            'label' => $this->l('Help'),
            'link' => $tab_link . 'help',
            'active' => ($tab == 'help' ? 1 : 0),
        );

        if (Configuration::get('LGGOOGLEANALYTICS_LOGGING')) {
            $menu[] = array(
                'label' => $this->l('Debug'),
                'link' => $tab_link . 'debug',
                'active' => ($tab == 'debug' ? 1 : 0),
            );
        }

        return $menu;
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'col' => 6,
                        'type' => 'alert-warning',
                        'name' => '',
                        'value' => $this->l('To insert the gtag code and begin to mesure, insert your Google Analytics 4 ID in the following input. Follow instrucctions on "Help" tab to get your ID. Then have to enable the e-commerce events you want to register in your shop. If no enable e-commerce events, only automatic events will be registered.'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Your Google Analytics ID'),
                        'name' => 'LGGOOGLEANALYTICS_ID',
                        'required' => true,
                        'col' => '3',
                        'hint' => $this->l('Example:') . ' GTM-XXXXXX / G-XXXXXX',
                        'desc' => $this->l('Example:') . ' GTM-XXXXXX / G-XXXXXX',
                    ),
                    array(
                        'col' => 6,
                        'type' => 'switch',
                        'label' => $this->l('purchase'),
                        'name' => 'LGGOOGLEANALYTICS_PURCHASE',
                        'values' => array(
                            array('value' => 1, 'id' => 'LGGOOGLEANALYTICS_PURCHASE_on', 'name' => $this->l('Yes')),
                            array('value' => 0, 'id' => 'LGGOOGLEANALYTICS_PURCHASE_off', 'name' => $this->l('No')),
                        ),
                        'desc' => $this->l('This event indicates that a user has purchased one or more items.'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'switch',
                        'label' => $this->l('begin_checkout'),
                        'name' => 'LGGOOGLEANALYTICS_BEGIN_CHECKOUT',
                        'values' => array(
                            array('value' => 1,
                                'id' => 'LGGOOGLEANALYTICS_BEGIN_CHECKOUT_on',
                                'name' => $this->l('Yes')
                            ),
                            array('value' => 0,
                                'id' => 'LGGOOGLEANALYTICS_BEGIN_CHECKOUT_off',
                                'name' => $this->l('No')
                            ),
                        ),
                        'desc' => $this->l('This event indicates that the user has started the processing of a purchase.'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'switch',
                        'label' => $this->l('view_item'),
                        'name' => 'LGGOOGLEANALYTICS_VIEW_ITEM',
                        'values' => array(
                            array('value' => 1, 'id' => 'LGGOOGLEANALYTICS_VIEW_ITEM_on', 'name' => $this->l('Yes')),
                            array('value' => 0, 'id' => 'LGGOOGLEANALYTICS_VIEW_ITEM_off', 'name' => $this->l('No')),
                        ),
                        'desc' => $this->l('This event indicates that some of the content has been shown to the user. Use it to discover the articles with the most views.'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'switch',
                        'label' => $this->l('view_item_list'),
                        'name' => 'LGGOOGLEANALYTICS_VIEW_ITEM_LIST',
                        'values' => array(
                            array('value' => 1,
                                'id' => 'LGGOOGLEANALYTICS_VIEW_ITEM_LIST_on',
                                'name' => $this->l('Yes')
                            ),
                            array('value' => 0,
                                'id' => 'LGGOOGLEANALYTICS_VIEW_ITEM_LIST_off',
                                'name' => $this->l('No')
                            ),
                        ),
                        'desc' => $this->l('Log this event when the user is shown a list of articles from a certain category.'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'switch',
                        'label' => $this->l('view_cart'),
                        'name' => 'LGGOOGLEANALYTICS_VIEW_CART',
                        'values' => array(
                            array('value' => 1, 'id' => 'LGGOOGLEANALYTICS_VIEW_CART_on', 'name' => $this->l('Yes')),
                            array('value' => 0, 'id' => 'LGGOOGLEANALYTICS_VIEW_CART_off', 'name' => $this->l('No')),
                        ),
                        'desc' => $this->l('This event indicates that a user has viewed your cart.'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'switch',
                        'label' => $this->l('add_to_cart'),
                        'name' => 'LGGOOGLEANALYTICS_ADD_TO_CART',
                        'values' => array(
                            array('value' => 1, 'id' => 'LGGOOGLEANALYTICS_ADD_TO_CART_on', 'name' => $this->l('Yes')),
                            array('value' => 0, 'id' => 'LGGOOGLEANALYTICS_ADD_TO_CART_off', 'name' => $this->l('No')),
                        ),
                        'desc' => $this->l('This event indicates that an item has been added to the cart.'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'switch',
                        'label' => $this->l('Enable debug (in the DebugView interface)'),
                        'name' => 'LGGOOGLEANALYTICS_ENABLE_DEBUG',
                        'values' => array(
                            array('value' => 1, 'id' => 'LGGOOGLEANALYTICS_ENABLE_DEBUG_on', 'name' => $this->l('Yes')),
                            array('value' => 0, 'id' => 'LGGOOGLEANALYTICS_ENABLE_DEBUG_off', 'name' => $this->l('No')),
                        ),
                        'desc' => $this->l('Enable data from the DebugView interface.'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'alert-warning',
                        'name' => '',
                        'value' => $this->l('Section bellows corresponding to "Debug Mode". Enables logs of events and actions.'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'switch',
                        'label' => $this->l('Debug Mode'),
                        'name' => 'LGGOOGLEANALYTICS_LOGGING',
                        'values' => array(
                            array('value' => 1, 'id' => 'LGGOOGLEANALYTICS_LOGGING_on', 'name' => $this->l('Yes')),
                            array('value' => 0, 'id' => 'LGGOOGLEANALYTICS_LOGGING_off', 'name' => $this->l('No')),
                        ),
                        'desc' => $this->l('With this option enables register controller access to debug.'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        $values = array(
            'LGGOOGLEANALYTICS_ID' => Configuration::get('LGGOOGLEANALYTICS_ID', ''),
            'LGGOOGLEANALYTICS_ENABLE_DEBUG' => Configuration::get('LGGOOGLEANALYTICS_ENABLE_DEBUG', ''),
            'LGGOOGLEANALYTICS_PURCHASE' => Configuration::get('LGGOOGLEANALYTICS_PURCHASE', ''),
            'LGGOOGLEANALYTICS_BEGIN_CHECKOUT' => Configuration::get('LGGOOGLEANALYTICS_BEGIN_CHECKOUT', ''),
            'LGGOOGLEANALYTICS_VIEW_ITEM' => Configuration::get('LGGOOGLEANALYTICS_VIEW_ITEM', ''),
            'LGGOOGLEANALYTICS_VIEW_ITEM_LIST' => Configuration::get('LGGOOGLEANALYTICS_VIEW_ITEM_LIST', ''),
            'LGGOOGLEANALYTICS_VIEW_CART' => Configuration::get('LGGOOGLEANALYTICS_VIEW_CART', ''),
            'LGGOOGLEANALYTICS_ADD_TO_CART' => Configuration::get('LGGOOGLEANALYTICS_ADD_TO_CART', ''),
            'LGGOOGLEANALYTICS_LOGGING' => Configuration::get('LGGOOGLEANALYTICS_LOGGING', ''),
        );
        return $values;
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submit' . Tools::ucfirst($this->name) . 'Module')) == true) {
            $errors = array();

            if (Tools::getValue('LGGOOGLEANALYTICS_ID')=='') {
                $errors[] =
                    $this->l('Google Analytics ID is a mandatory field. Please, insert your Google Analytics ID');
            }

            $form_values = $this->getConfigFormValues();
            foreach (array_keys($form_values) as $key) {
                Configuration::updateValue($key, Tools::getValue($key));
                $this->context->smarty->assign('show_message', 1);
            }

            if ((int)Tools::getValue('LGGOOGLEANALYTICS_LOGGING')==0) {
                $this->cleanDebug(true);
            }

            $this->context->smarty->assign('show_errors', $errors);
        }
    }

    protected function getConfigFormRemarketing()
    {
        $select_position = array();

        for($i = 1; $i<18; $i++)
        {
            $select_position[] = array('name'=>$i, 'value'=>$i);
        }

        return array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Dinamic remarketing'),
                    'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'col' => 6,
                        'type' => 'alert-warning',
                        'name' => '',
                        'value' => $this->l('This functionality is currently only available for Universal Analytics (GA3).'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'switch',
                        'label' => $this->l('Active Remarketing'),
                        'name' => 'LGGOOGLEANALYTICS_ECOMM',
                        'values' => array(
                            array('value' => 1, 'name' => $this->l('Yes')),
                            array('value' => 0, 'name' => $this->l('No')),
                        ),
                        'desc' => $this->l('This active your remarketing with Merchant center.'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Your Universal Google Analytics ID'),
                        'name' => 'LGGOOGLEANALYTICS_UA',
                        'required' => true,
                        'col' => '3',
                        'hint' => $this->l('Example:') . ' UA-XXXXXX',
                        'desc' => $this->l('Example:') . ' UA-XXXXXX',
                    ),

                    array(
                        'col' => 6,
                        'type' => 'select',
                        'label' => $this->l('"ecomm_prodid" index'),
                        'name' => 'LGGOOGLEANALYTICS_ECOMM_PRODID',
                        'options' => array(
                            'query' => $select_position,
                            'id' => 'name',
                            'name' => 'value',
                        ),
                        'desc' => $this->l('Custom dimensión on Google Analytics to "ecomm_prodid" index'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'select',
                        'label' => $this->l('"ecomm_pagetype" index'),
                        'name' => 'LGGOOGLEANALYTICS_ECOMM_PAGETYPE',
                        'options' => array(
                            'query' => $select_position,
                            'id' => 'name',
                            'name' => 'value',
                        ),
                        'desc' => $this->l('Custom dimensión on Google Analytics to "ecomm_pagetype" index'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'select',
                        'label' => $this->l('"ecomm_totalvalue" index'),
                        'name' => 'LGGOOGLEANALYTICS_ECOMM_TOTALVALUE',
                        'options' => array(
                            'query' => $select_position,
                            'id' => 'name',
                            'name' => 'value',
                        ),
                        'desc' => $this->l('Custom dimensión on Google Analytics to "ecomm_totalvalue" index'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'select',
                        'label' => $this->l('"ecomm_category" index'),
                        'name' => 'LGGOOGLEANALYTICS_ECOMM_CATEGORY',
                        'options' => array(
                            'query' => $select_position,
                            'id' => 'name',
                            'name' => 'value',
                        ),
                        'desc' => $this->l('Custom dimensión on Google Analytics to "ecomm_category" index'),
                    ),
//                    array(
//                        'type' => 'text',
//                        'label' => $this->l('Prefix Merchant Center'),
//                        'name' => 'LGGOOGLEANALYTICS_MC_PREFIX',
//                        'col' => '3',
//                    ),
//                    array(
//                        'type' => 'text',
//                        'label' => $this->l('Sufix Merchant Center'),
//                        'name' => 'LGGOOGLEANALYTICS_MC_SUFIX',
//                        'col' => '3',
//                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }


    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValuesRemarketing()
    {
        $values = array(
            'LGGOOGLEANALYTICS_ECOMM'           => Configuration::get('LGGOOGLEANALYTICS_ECOMM', ''),
            'LGGOOGLEANALYTICS_UA'              => Configuration::get('LGGOOGLEANALYTICS_UA', ''),
            'LGGOOGLEANALYTICS_ECOMM_PRODID'    => Configuration::get('LGGOOGLEANALYTICS_ECOMM_PRODID', ''),
            'LGGOOGLEANALYTICS_ECOMM_PAGETYPE'  => Configuration::get('LGGOOGLEANALYTICS_ECOMM_PAGETYPE', ''),
            'LGGOOGLEANALYTICS_ECOMM_TOTALVALUE' => Configuration::get('LGGOOGLEANALYTICS_ECOMM_TOTALVALUE', ''),
            'LGGOOGLEANALYTICS_ECOMM_CATEGORY'  => Configuration::get('LGGOOGLEANALYTICS_ECOMM_CATEGORY', ''),
//            'LGGOOGLEANALYTICS_MC_PREFIX'       => Configuration::get('LGGOOGLEANALYTICS_MC_PREFIX', ''),
//            'LGGOOGLEANALYTICS_MC_SUFIX'        => Configuration::get('LGGOOGLEANALYTICS_MC_SUFIX', ''),
        );
        return $values;
    }

    protected function postProcessRemarketing()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submit' . Tools::ucfirst($this->name) . 'Module')) == true) {
            $errors = array();

            if (Tools::getValue('LGGOOGLEANALYTICS_ECOMM') && Tools::getValue('LGGOOGLEANALYTICS_UA')=='') {
                $errors[] =
                    $this->l('Universal Google Analytics ID is a mandatory field if you use dinamic remarketing');
            }

            $form_values = $this->getConfigFormValuesRemarketing();
            foreach (array_keys($form_values) as $key) {
                Configuration::updateValue($key, Tools::getValue($key));
                $this->context->smarty->assign('show_message', 1);
            }

            $this->context->smarty->assign('show_errors', $errors);
        }
    }

    protected function getConfigFormAds()
    {
        $select_position = array();

        for($i = 1; $i<18; $i++)
        {
            $select_position[] = array('name'=>$i, 'value'=>$i);
        }

        return array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Google Ads'),
                    'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Your Google Ads ID'),
                        'name' => 'LGGOOGLEANALYTICS_GADS_ID',
                        'required' => false,
                        'col' => '3',
                        'hint' => $this->l('Example:') . ' AW-XXXXXX',
                        'desc' => $this->l('Example:') . ' AW-XXXXXX',
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Your purchase conversion label'),
                        'name' => 'LGGOOGLEANALYTICS_GADS_TAG',
                        'required' => true,
                        'col' => '3',
                        'desc' => $this->l('Conversion label to event purchase'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }


    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValuesAds()
    {
        $values = array(
            'LGGOOGLEANALYTICS_GADS_ID'     => Configuration::get('LGGOOGLEANALYTICS_GADS_ID', ''),
            'LGGOOGLEANALYTICS_GADS_TAG'    => Configuration::get('LGGOOGLEANALYTICS_GADS_TAG', ''),
        );
        return $values;
    }

    protected function postProcessAds()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submit' . Tools::ucfirst($this->name) . 'Module')) == true) {
            $errors = array();

            $form_values = $this->getConfigFormValuesAds();
            foreach (array_keys($form_values) as $key) {
                Configuration::updateValue($key, Tools::getValue($key));
                $this->context->smarty->assign('show_message', 1);
            }

            $this->context->smarty->assign('show_errors', $errors);
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be loaded in the BO.
     */
    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name || Tools::getValue('configure') == $this->name) {
            $this->context->controller->addJS($this->_path . 'views/js/back.js');
            $this->context->controller->addCSS($this->_path . 'views/css/back.css');
            $this->context->controller->addCSS($this->_path . 'views/css/publi/lgpubli.css');
        }
    }


    private function isOrderConfirmation($ctrl, $params=array()){

        if(($ctrl == 'order-confirmation' ||
        (
            stripos($_SERVER['REQUEST_URI'], 'paypal') != false &&
            stripos($_SERVER['REQUEST_URI'], 'submit') != false
        )
                ) && (Tools::getValue('id_order') || Tools::getValue('id_cart')))
        {
            return true;
        }
        if($ctrl == 'stripe_officialOrderSuccessModuleFrontController')
        {
            if (isset($params['cart']))
            {
                $_POST['id_cart'] = $params['cart']->id;

                $i = 0;
                do {    // Consultamos el id de pedido hasta que tengamos uno o hayamos esperado 10 segundos.
                    sleep(1);
                    $id_order = (int)self::getIdByCartId((int) ($params['cart']->id));
                    $i++;
                } while ($id_order == 0 && $i<10);

                $_POST['id_order'] = $id_order;
            }
            return true;
        }

        return false;
    }

    public function headerContent($params)
    {
        $template = '';

        $ctrl = $this->context->controller->php_self;

        if (!$ctrl) {
            $ctrl = $this->getOtherController($this->context->controller);
        }

        if (Configuration::get('LGGOOGLEANALYTICS_ID') && !Tools::getValue('ajax')) {
            // $name = $this->context->cookie->__get('PHPSESSID');
            $events = array();

            // TO LOG
            $event_name = "";

            // purchase
            if ($this->isOrderConfirmation($ctrl,$params) &&
                Configuration::get('LGGOOGLEANALYTICS_PURCHASE')
            ) {
                $id_order = (int)Tools::getValue('id_order');

                if (!$id_order) {
                    $id_order = self::getIdByCartId((int)(Tools::getValue('id_cart')));
                }

                $data = array_merge($_POST, $_GET, $params);
                $data['url'] = $_SERVER['REQUEST_URI'];

                if (!empty($id_order)) {
                    try {
                        $events[] = $this->eventPurchase($id_order);

                        $event_name = "Purchase";

                    } catch (Exception $e) {
                        LggoogleanalyticsLog::register($ctrl, "PURCHASE-ERROR", $data);
                    }
                } else {
                    LggoogleanalyticsLog::register($ctrl, "PURCHASE-IGNORE", $data);
                }
                // view_item
            } elseif ($ctrl == 'product' &&
                Tools::getValue('id_product') &&
                Configuration::get('LGGOOGLEANALYTICS_VIEW_ITEM')
            ) {
                $id_product = (int)Tools::getValue('id_product');
                $id_product_attribute = (int)Tools::getValue('id_product_attribute');
                if (!empty($id_product)) {
                    try {
                        $events[] = $this->eventViewItem($id_product, $id_product_attribute);
                        $event_name = "ViewItem";
                    } catch (Exception $e) {
                        LggoogleanalyticsLog::register($ctrl, "VIEW_ITEM-ERROR", $_SERVER['REQUEST_URI']);
                    }
                }
            } elseif ($ctrl == 'cart' &&
                isset($this->context->cart) &&
                Configuration::get('LGGOOGLEANALYTICS_VIEW_CART')
            ) {
                try {
                    $products = $this->context->cart->getProducts();
                    if (!empty($products)) {
                        $events[] = $this->eventViewCart($products);
                        $event_name = "ViewCart";
                    }
                } catch (Exception $e) {
                    LggoogleanalyticsLog::register($ctrl, "VIEW-CART-ERROR", $_SERVER['REQUEST_URI']);
                }
            } elseif (in_array($ctrl, array('order', 'order-opc')) &&
                !empty($this->context->cart->id) &&
                Configuration::get('LGGOOGLEANALYTICS_BEGIN_CHECKOUT')
            ) {
                if (isset($this->context->cart)) {
                    try {
                        $events[] = $this->eventBeginCheckout($this->context->cart);
                        $event_name = "BeginCheckout";
                    } catch (Exception $e) {
                        LggoogleanalyticsLog::register($ctrl, "BEGIN-CHECKOUT-ERROR", $_SERVER['REQUEST_URI']);
                    }
                }
            } elseif ($ctrl == 'category' &&
                Configuration::get('LGGOOGLEANALYTICS_VIEW_ITEM_LIST') &&
                !isset($this->context->controller->page_name)
            ) {
                $p = empty($this->context->controller->p)
                    ? 1
                    : $this->context->controller->p;
                $n = empty($this->context->controller->n)
                    ? Configuration::get('PS_PRODUCTS_PER_PAGE')
                    : $this->context->controller->n;
                $products = $this->context->controller->getCategory()->getProducts(
                    $this->context->language->id,
                    (int)$p,
                    (int)$n
                );
                if (!empty($products)) {
                    try {
                        $events[] = $this->eventViewItemList($products);
                        $event_name = "ViewItemList";
                    } catch (Exception $e) {
                        LggoogleanalyticsLog::register($ctrl, "VIEW-ITEM_LIST-ERROR", $_SERVER['REQUEST_URI']);
                    }
                }
            }

            if (Configuration::get('LGGOOGLEANALYTICS_LOGGING')) {
                $data = array_merge($_POST, $_GET, $params);
                $data['url'] = $_SERVER['REQUEST_URI'];
                LggoogleanalyticsLog::register($ctrl, $event_name, $data);
            }

            $this->context->smarty->assign('LGGOOGLEANALYTICS_ID', Configuration::get('LGGOOGLEANALYTICS_ID'));
            $this->context->smarty->assign('LGGOOGLEANALYTICS_ENABLE_DEBUG', Configuration::get('LGGOOGLEANALYTICS_ENABLE_DEBUG'));

            $template = $this->context->smarty->fetch($this->local_path . 'views/templates/hook/header.tpl');
            $template .= implode("\n\n", $events);
        }

        // Config Dinamic Marketing
        if (Configuration::get('LGGOOGLEANALYTICS_ECOMM') && Configuration::get('LGGOOGLEANALYTICS_UA')) {
            $ecomm_id = Configuration::get('LGGOOGLEANALYTICS_UA');
            $ecomm_prodid_index = (int)Configuration::get('LGGOOGLEANALYTICS_ECOMM_PRODID');
            $ecomm_pagetype_index = (int)Configuration::get('LGGOOGLEANALYTICS_ECOMM_PAGETYPE');
            $ecomm_totalvalue_index = (int)Configuration::get('LGGOOGLEANALYTICS_ECOMM_TOTALVALUE');
            $ecomm_category_index = (int)Configuration::get('LGGOOGLEANALYTICS_ECOMM_CATEGORY');

            $remarketing_feature = (int)Configuration::get('LGGOOGLEANALYTICS_ECOMM');
            $analytics_id = Configuration::get('LGGOOGLEANALYTICS_UA');

            // Tracking Features

            $lggtag_tracking_features = array(
                // gtag Ids
                'analyticsId' => $analytics_id,
               // 'adwordsId' => $adwords_id,
               // 'adwordsCl' => $adwords_cl,

                // basic
               // 'productSendRate' => $product_send_rate,
               // 'merchantPrefix' => $ga_merchant_acronyms['prefix'],
               // 'merchantSuffix' => $ga_merchant_acronyms['suffix'],
               // 'merchantVariant' => $ga_merchant_variant,
               // 'businessDataPrefix' => $ga_business_data_acronyms['prefix'],
               // 'businessDataVariant' => $ga_business_data_variant,
               // 'currency' => $currency_iso,
               // 'idShop' => $id_shop,

               // // related to tracking
               // 'productsPerPage' => $products_per_page,
               // 'cartAjax' => $cart_ajax,
               // 'token' => $token,
               // 'disableInternalTracking' => $disable_internal_tracking,
               // 'signUpTypes' => $sign_up_types,
               // 'isNewSignUp' => $is_new_sign_up,
               // 'isGuest' => $is_guest,
               // 'checkDoNotTrack' => $check_do_not_track,

                // tracking config
                'config' => array(
                   // 'optimizeId' => $optimize_id,
                   // 'simpleSpeedSampleRate' => $simple_speed_sample_rate,
                   // 'anonymizeIp' => $anonymize_ip_feature,
                   // 'linkAttribution' => $link_attribution,
                   // 'userIdFeature' => $user_id_feature,
                   // 'userIdValue' => $user_id,
                    'remarketing' => $remarketing_feature,
                   // 'crossDomainList' => $domain_list,
                   // 'clientId' => $client_id,
                   // 'businessData' => $business_data_feature,
                   // 'customDimensions' => array(
                   //     'ecommProdId' => $ecomm_prodid_index,
                   //     'ecommPageType' => $ecomm_pagetype_index,
                   //     'ecommTotalValue' => $ecomm_totalvalue_index,
                   //     'ecommCategory' => $ecomm_category_index,
                   //     'dynxItemId' => $dynx_itemid_index,
                   //     'dynxItemId2' => $dynx_itemid2_index,
                   //     'dynxPageType' => $dynx_pagetype_index,
                   //     'dynxTotalValue' => $dynx_totalvalue_index,
                   // )
                ),
               // 'goals' => array(
               //     'signUp' => $goal_sign_up,
               //     'socialAction' => $goal_social_action
               // ),
               // 'eventValues' => array(
               //     'signUp' => $event_value_sign_up,
               //     'socialAction' => $event_value_social_action
               // )
            );

            $this->context->smarty->assign(array(
               // 'analytics_id' => $analytics_id,
               // 'optimize_id' => $optimize_id,
               // 'optimize_class_name' => $optimize_class_name,
               // 'optimize_time_out' => $optimize_time_out,
               // 'is_client_id' => $is_client_id,
            ));

            $this->context->smarty->assign(array(
                'lggtag_tracking_features' => $lggtag_tracking_features,
                'ecomm_id' => $ecomm_id,
                'ecomm_prodid_index' => $ecomm_prodid_index,
                'ecomm_pagetype_index' => $ecomm_pagetype_index,
                'ecomm_totalvalue_index' => $ecomm_totalvalue_index,
                'ecomm_category_index' => $ecomm_category_index,
            ));

            $template .= $this->context->smarty->fetch($this->local_path . 'views/templates/hook/header_ecomm.tpl');
        }

        // Send Google Ads report
        if(Configuration::get('LGGOOGLEANALYTICS_GADS_ID')) {

            // AdWords Conversion
            $adwords_id = (string)Configuration::get('LGGOOGLEANALYTICS_GADS_ID');
            $adwords_cl = (string)Configuration::get('LGGOOGLEANALYTICS_GADS_TAG');

            if (($ctrl == 'order-confirmation' ||
                    (
                        stripos($_SERVER['REQUEST_URI'], 'paypal') != false &&
                        stripos($_SERVER['REQUEST_URI'], 'submit') != false
                    )
                ) && (Tools::getValue('id_order') || Tools::getValue('id_cart'))) {
                $order = new Order((int)Tools::getValue('id_order'));

                $id_shop = (int)$order->id_shop;

                $tagorder = LggoogleanalyticsTools::tagOrder($order);

                $this->context->smarty->assign(array(
                    'id_shop' => $id_shop,
                    'lgGaOrder' => $tagorder,
                    'adwordsId' => $adwords_id,
                    'adwordsCl' => $adwords_cl,
                ));

                $template .= $this->context->smarty->fetch($this->local_path . 'views/templates/hook/header_ads.tpl');
            }
            else{
                $this->context->smarty->assign(array(
                    'adwordsId' => $adwords_id,
                ));
                $template .= $this->context->smarty->fetch($this->local_path . 'views/templates/hook/header_ads.tpl');
            }
        }

        return $template;
    }

    public function hookDisplayHeader($params)
    {
        $template = '';

        if (Configuration::get('LGGOOGLEANALYTICS_ID')) {
            $this->context->controller->addJS($this->_path . 'views/js/front.js');

            $token = Tools::getAdminToken($this->name);
            $link = Context::getContext()->link->getModuleLink(
                $this->name,
                'gtag',
                [
                    'token' => $token,
                ]
            );

            if (version_compare(_PS_VERSION_, '1.6.1.0', '>=')) {
                Media::addJsDef([
                    'lggoogleanalytics_token' => $token,
                    'lggoogleanalytics_link' => $link,
                ]);
            } else {
                $this->context->smarty->assign([
                    'lggoogleanalytics_token' => $token,
                    'lggoogleanalytics_link' => $link,
                ]);

                $template .= $this->context->smarty->fetch(
                    _PS_MODULE_DIR_ . $this->name
                    . DIRECTORY_SEPARATOR . 'views'
                    . DIRECTORY_SEPARATOR . 'templates'
                    . DIRECTORY_SEPARATOR . 'front'
                    . DIRECTORY_SEPARATOR . 'javascript.tpl'
                );
            }

            $template .=  $this->headerContent($params);
        }

        return $template;
    }

    public function hookDisplayAfterBody($params)
    {
        $TAG_MANAGER_ID = Configuration::get('TAG_MANAGER_ID');
        $this->context->smarty->assign('TAG_MANAGER_ID', $TAG_MANAGER_ID);
        return $this->display(__FILE__, '/views/templates/front/after-body.tpl');
    }

    // public function hookOrderConfirmation($params)
    // {
    //     $order = $params['order'];
    //     $invalid_statuses = explode(',', Configuration::get('RC_PGANALYTICS_IOS'));

    //     if (Validate::isLoadedObject($order)) {
    //         // Validate all orders except invalid statuses
    //         if (!in_array($order->current_state, $invalid_statuses)) {
    //             // convert object to array

    //             $order_id = (int)$order->id;
    //             $id_shop = (int)$order->id_shop;
    //             $id_lang = (int)$order->id_lang;

    //             // TODO
    //             $order_sent = (bool)Rc_PgAnalyticsOrderSent::getOrderReport($order_id, $id_shop);

    //             // common value to know the order status
    //             $this->context->smarty->assign(array(
    //                 'order_sent' => $order_sent
    //             ));

    //             if (!$order_sent) {
    //                 $order_products = $order->getProducts();
    //                 $order_products = LggoogleanalyticsTools::getNamesBasicProduct($order_products, $id_lang, $id_shop);
    //                 $order_products = LggoogleanalyticsTools::getGaCategories($order_products);
    //                 $order_products = LggoogleanalyticsTools::getManufacturerNames($order_products);
    //                 $order_products = LggoogleanalyticsTools::getProductVariants($order_products);

    //                 // Get affiliation name
    //                 $affiliation = LggoogleanalyticsTools::getAffiliation();

    //                 // Get coupon name
    //                 $coupon = LggoogleanalyticsTools::getCoupon($order);

    //                 $products = LggoogleanalyticsTools::tagProducts($order_products, null, null, true);
    //                 $order = LggoogleanalyticsTools::tagOrder($order);

    //                 $this->context->smarty->assign(array(
    //                     'id_shop' => $id_shop,
    //                     'ga_order' => $order,
    //                     'ga_products' => $products
    //                 ));
    //             }
    //         }
    //     }
    // }

    /**
     * Hook for category product list change >= 1.7
     *
     * @param $params
     */
    public function hookFilterProductSearch($params)
    {
        if (!Configuration::get('LGGOOGLEANALYTICS_VIEW_ITEM_LIST') ||
            !$this->context->controller instanceof CategoryController
        ) {
            return null;
        }
        $affiliation = Configuration::get('PS_SHOP_NAME');
        $id_currency = isset($this->context->cart->id_currency)
        ? $this->context->cart->id_currency
        : Configuration::get('PS_CURRENCY_DEFAULT');
        $currency = new Currency((int) $id_currency);
        $currency = $currency->iso_code;
        $items = array();
        if (version_compare(_PS_VERSION_, '1.7.0', '>=')) {
            if (!empty($params['searchVariables']['products'])) {
                foreach ($params['searchVariables']['products'] as $index => $product) {
                    $item_id = $params['searchVariables']['products'][$index]['id_product'];
                    $item_name = $params['searchVariables']['products'][$index]['name'];
                    $discount = $params['searchVariables']['products'][$index]['reduction'];
                    $price = $params['searchVariables']['products'][$index]['price_amount'];
                    $item_category = $params['searchVariables']['products'][$index]['category_name'];
                    $quantity = $params['searchVariables']['products'][$index]['quantity'];
                    $item_list_id = $params['searchVariables']['products'][$index]['id_category_default'];
                    if (!empty($params['searchVariables']['products'][$index]['id_manufacturer'])) {
                        $item_brand = Manufacturer::getNameById(
                            $params['searchVariables']['products'][$index]['id_manufacturer']
                        );
                    } else {
                        $item_brand = '';
                    }
                    if (!empty($params['searchVariables']['products'][$index]['attributes'])) {
                        $attr_part = array();
                        $attributes = $params['searchVariables']['products'][$index]['attributes'];
                        foreach ($attributes as $attr) {
                            $attr_part[] = $attr['group'] . ' - ' . $attr['name'];
                        }
                        $item_variant = implode(', ', $attr_part);
                    } else {
                        $item_variant = '';
                    }

                    $index = (int) Db::getInstance()->getValue(
                        'SELECT position FROM `' . _DB_PREFIX_ . 'category_product`
                        WHERE id_category = ' . (int) $item_list_id . '
                        AND id_product = ' . (int) $item_id
                    );

                    $items[] = array(
                        'item_id' => $item_id,
                        'item_name' => $item_name,
                        'discount' => Tools::ps_round((float) $discount, 2),
                        'index' => $index,
                        'item_list_name' => $item_category,
                        'item_list_id' => 'category_list',
                        'affiliation' => $affiliation,
                        'item_brand' => $item_brand,
                        'item_category' => $item_category,
                        'item_variant' => $item_variant,
                        'price' => Tools::ps_round((float) $price, 2),
                        'currency' => $currency,
                        'quantity' => $quantity,
                    );
                    unset($product);
                }
            }
        }
        if (!empty($items)) {
            $event = array(
                'items' => $items,
                'item_list_name' => $this->context->controller->getCategory()->name,
                'item_list_id' => $this->context->controller->getCategory()->id,
            );
            $this->context->smarty->assign('event', $event);
            return $this->display(__FILE__, '/views/templates/hook/eventViewItemList.tpl');
        }
        return null;
    }

    /**
     * Event purchase
     */
    public function eventPurchase($id_order = null)
    {
        $id_lang = Configuration::get('PS_LANG_DEFAULT');
        $order = new Order($id_order);

        if (!Validate::isLoadedObject($order)){
            $id_order = self::getIdByCartId((int)(Tools::getValue('id_cart')));
            $order = new Order($id_order);
        }

        if (Validate::isLoadedObject($order) && !LggoogleanalyticsEvent::exists('Purchase', $id_order)) {
            if ($order->id_currency != Configuration::get('PS_CURRENCY_DEFAULT')) {
                $currency = new Currency((int) $order->id_currency);
            } else {
                $currency = new Currency((int) Configuration::get('PS_CURRENCY_DEFAULT'));
            }
            $conversion_rate = empty($currency->conversion_rate) ? 1 : (float) $currency->conversion_rate;
            $currency = $currency->iso_code;
            // Order general information
            $affiliation = Configuration::get('PS_SHOP_NAME');
            $tax = $order->total_paid_tax_incl - $order->total_paid_tax_excl;
            $event = array(
                'transaction_id' => (int) $order->id,
                'affiliation' => $affiliation,
                'value' => Tools::ps_round((float) $order->total_paid / (float) $conversion_rate, 2),
                'tax' => Tools::ps_round((float) $tax / (float) $conversion_rate, 2),
                'shipping' => Tools::ps_round((float) $order->total_shipping / (float) $conversion_rate, 2),
                'currency' => $currency,
            );
            // Product information
            $products = $order->getProducts();
            foreach ($products as $p) {
                $product = new Product($p['id_product']);
                $category = new Category($p['id_category_default']);
                $item_category = $category->getName($id_lang);
                $item_variant = '';
                if (!empty($p['product_attribute_id'])) {
                    $attributes = $product->getAttributeCombinationsById(
                        $p['product_attribute_id'],
                        $id_lang
                    );
                    if (!empty($attributes)) {
                        $attr_part = array();
                        foreach ($attributes as $attr) {
                            $attr_part[] = $attr['group_name'] . ' - ' . $attr['attribute_name'];
                        }
                        $item_variant = implode(', ', $attr_part);
                    }
                }
                if (!empty($p['id_manufacturer'])) {
                    $item_brand = Manufacturer::getNameById($p['id_manufacturer']);
                } else {
                    $item_brand = '';
                }
                $event['items'][] = array(
                    'item_id' => $p['product_id'],
                    'item_name' => $p['product_name'],
                    'discount' => Tools::ps_round((float) $p['reduction_amount_tax_incl'], 2),
                    'affiliation' => $affiliation,
                    'item_brand' => $item_brand,
                    'item_category' => $item_category,
                    'item_variant' => $item_variant,
                    'price' => Tools::ps_round((float) $p['product_price_wt'] / (float) $conversion_rate, 2),
                    'currency' => $currency,
                    'quantity' => $p['product_quantity'],
                );
            }
            $this->context->smarty->assign('event', $event);
            $buffer = $this->display(__FILE__, '/views/templates/hook/eventPurchase.tpl');

            // To not show the event more than one time
            LggoogleanalyticsEvent::register('Purchase', $id_order, $event);

            $this->cleanDebug(true);

            return $buffer;
        }
        return null;
    }

    /**
     * Event view_item
     */

    public function eventViewItem($id_product = null, $id_product_attribute = null)
    {
        if (!empty($id_product)) {
            $id_lang = Configuration::get('PS_LANG_DEFAULT');
            $affiliation = Configuration::get('PS_SHOP_NAME');
            $currency = new Currency((int) Configuration::get('PS_CURRENCY_DEFAULT'));
            $currency = $currency->iso_code;
            $product = new Product($id_product);
            $price = $product->getPrice(true, $id_product_attribute, 2);
            $priceWithoutReduction = $product->getPriceWithoutReduct(false, $id_product_attribute, 2);
            if ($priceWithoutReduction > $price) {
                $discount = ($priceWithoutReduction - $price);
            } else {
                $discount = 0;
            }
            $category = new Category($product->id_category_default);
            $item_category = $category->getName($id_lang);
            if (!empty($product->id_manufacturer)) {
                $item_brand = Manufacturer::getNameById($product->id_manufacturer);
            } else {
                $item_brand = '';
            }
            if (!empty($id_product_attribute)) {
                $attributes = $product->getAttributeCombinationsById(
                    $id_product_attribute,
                    $id_lang
                );
                if (!empty($attributes)) {
                    $attr_part = array();
                    foreach ($attributes as $attr) {
                        $attr_part[] = $attr['group_name'] . ' - ' . $attr['attribute_name'];
                    }
                    $item_variant = implode(', ', $attr_part);
                }
            } else {
                $item_variant = '';
            }
            $event = array(
                'currency' => $currency,
                'items' => array(
                    array(
                        'item_id' => $product->id,
                        'item_name' => $product->name[$id_lang],
                        'discount' => Tools::ps_round((float) $discount, 2),
                        'affiliation' => $affiliation,
                        'item_brand' => $item_brand,
                        'item_category' => $item_category,
                        'item_variant' => $item_variant,
                        'price' => Tools::ps_round((float) $price, 2),
                        'currency' => $currency,
                        'quantity' => 1,
                    ),
                ),
                'value' => Tools::ps_round((float) $price, 2),
            );
            $this->context->smarty->assign('event', $event);
            $buffer = $this->display(__FILE__, '/views/templates/hook/eventViewItem.tpl');
            LggoogleanalyticsEvent::register('ViewItem', $id_product, $event);
            return $buffer;
        }
    }

    public function eventBeginCheckout($cart = null)
    {
        if (!empty($cart->id) && !LggoogleanalyticsEvent::exists('BeginCheckout', $cart->id)) {
            $products = $cart->getProducts();
            if (!empty($products)) {
                $affiliation = Configuration::get('PS_SHOP_NAME');
                $currency = new Currency((int) Configuration::get('PS_CURRENCY_DEFAULT'));
                $currency = $currency->iso_code;
                $value = $cart->getOrderTotal();
                $event = array(
                    'currency' => $currency,
                    'value' => Tools::ps_round((float) $value, 2),
                    //'coupon' => 'COUPON'
                );
                foreach ($products as $product) {
                    if (empty($product['manufacturer_name'])) {
                        $item_brand = Manufacturer::getNameById($product['id_manufacturer']);
                    } else {
                        $item_brand = $product['manufacturer_name'];
                    }
                    $discount =
                        $product['price_without_reduction'] -
                        $product['price_with_reduction'];
                    $event['items'][] = array(
                        'item_id' => $product['id_product'],
                        'item_name' => $product['name'],
                        //'coupon' => 'COUPON',
                        'discount' => Tools::ps_round((float) $discount, 2),
                        'affiliation' => $affiliation,
                        'item_brand' => $item_brand,
                        'item_category' => $product['category'],
                        'item_variant' => $product['attributes'],
                        'price' => Tools::ps_round((float) $product['price_wt'], 2),
                        'currency' => $currency,
                        'quantity' => $product['cart_quantity'],
                    );
                }
                $this->context->smarty->assign('event', $event);
                $buffer = $this->display(__FILE__, '/views/templates/hook/eventBeginCheckout.tpl');
                LggoogleanalyticsEvent::register('BeginCheckout', $cart->id, $event);
                return $buffer;
            }
        }
    }

    public function eventViewCart($products)
    {
        $id_lang = Configuration::get('PS_LANG_DEFAULT');
        $affiliation = Configuration::get('PS_SHOP_NAME');
        $id_cart = (int)$this->context->cart->id;
        $currency = new Currency((int) $this->context->cart->id_currency);
        $currency = $currency->iso_code;
        $event = array(
            'currency' => $currency,
            'items' => array(),
        );
        $value = 0;

        foreach ($products as $product) {
            $value += $product['total_wt'];
            $category = new Category($product['id_category_default']);
            $item_category = $category->getName($id_lang);
            if (empty($product['manufacturer_name'])) {
                $item_brand = Manufacturer::getNameById($product['id_manufacturer']);
            } else {
                $item_brand = $product['manufacturer_name'];
            }
            $event['items'][] = array(
                'item_id' => $product['id_product'],
                'item_name' => $product['name'],
                //'coupon' => 'COUPON',
                'discount' => Tools::ps_round((float) $product['reduction'], 2),
                'affiliation' => $affiliation,
                'item_brand' => $item_brand,
                'item_category' => $item_category,
                'item_variant' => isset($product['attributes'])?$product['attributes']:'',
                'price' => Tools::ps_round((float) $product['price_wt'], 2),
                'currency' => $currency,
                'quantity' => $product['cart_quantity'],
            );
        }
        $event['value'] = $value;
        $this->context->smarty->assign('event', $event);

        $debug = $this->display(__FILE__, '/views/templates/hook/eventViewCart.tpl');
        LggoogleanalyticsEvent::register('ViewCart', $id_cart, $event);
        return $debug;
    }

    public function eventViewItemList($products = array())
    {
        if (!Configuration::get('LGGOOGLEANALYTICS_VIEW_ITEM_LIST') || empty($products)) {
            return null;
        }

        $affiliation = Configuration::get('PS_SHOP_NAME');
        $id_currency = isset($this->context->cart->id_currency)
            ? $this->context->cart->id_currency
            : Configuration::get('PS_CURRENCY_DEFAULT');

        $currency = new Currency((int) $id_currency);
        $currency = $currency->iso_code;
        $items = array();
        foreach ($products as $product) {
            $item_id = $product['id_product'];
            $item_name = $product['name'];
            $item_category = isset($product['category_name'])
                ? $product['category_name']
                : (isset($product['category_default']) // It's not used form generated images is used  as id_category
                    ? $product['category_default']
                    : ''
            );
            $discount = $product['reduction'];
            $price = $product['price'];
            $quantity = $product['quantity'];
            $item_list_id = $product['id_category_default'];
            if (!empty($product['id_manufacturer'])) {
                $item_brand = Manufacturer::getNameById($product['id_manufacturer']);
            } else {
                $item_brand = '';
            }
            if (!empty($product['attributes'])) {
                $attr_part = array();
                foreach ($product['attributes'] as $attr) {
                    $attr_part[] = $attr['group'] . ' - ' . $attr['name'];
                }
                $item_variant = implode(', ', $attr_part);
            } else {
                $item_variant = '';
            }

            $index = (int) Db::getInstance()->getValue(
                'SELECT position FROM `' . _DB_PREFIX_ . 'category_product`
                WHERE id_category = ' . (int) $item_list_id . '
                AND id_product = ' . (int) $item_id
            );

            $items[] = array(
                'item_id' => $item_id,
                'item_name' => $item_name,
                'discount' => Tools::ps_round((float) $discount, 2),
                'index' => $index,
                'item_list_name' => $item_category,
                'item_list_id' => 'category_list',
                'affiliation' => $affiliation,
                'item_brand' => $item_brand,
                'item_category' => $item_category,
                'item_variant' => $item_variant,
                'price' => Tools::ps_round((float) $price, 2),
                'currency' => $currency,
                'quantity' => $quantity,
            );
        }

        if (!empty($items)) {
            $event = array(
                'items' => $items,
                'item_list_name' => $this->context->controller->getCategory()->name,
                'item_list_id' => $this->context->controller->getCategory()->id,
            );
            $this->context->smarty->assign('event', $event);
            $buffer = $this->display(__FILE__, '/views/templates/hook/eventViewItemList.tpl');
            LggoogleanalyticsEvent::register('ViewItemList', null, $event);
            return $buffer;
        }
        return null;
    }

    /**
     * Event add_payment_info
     */
    public function eventAddPaymentInfo()
    {
        return $this->display(__FILE__, '/views/templates/hook/eventAddPaymentInfo.tpl');
    }

    private function getOtherController($controller)
    {
        $class_controller = get_class($controller);

        $ctrl = $class_controller;
        switch ($class_controller) {
            case 'Bestkit_OpcCheckoutModuleFrontController':
            case 'RedsyspaymentModuleFrontController':
                $ctrl = 'order';
                break;
        }
        return $ctrl;
    }

    private function cleanDebug($full = false)
    {
        if ($full) {
            $sql = 'TRUNCATE TABLE `' . _DB_PREFIX_.LggoogleanalyticsLog::$definition['table'].'`;';
            $date = date("Y-m-d H:i:s", strtotime("-5 day"));
            $sql .= 'DELETE FROM `' . _DB_PREFIX_.LggoogleanalyticsEvent::$definition['table'].'` WHERE
                `event`!="Purchase" AND `date_add` < "'. $date .'";';
            $date2 = date("Y-m-d H:i:s", strtotime("-10 day"));
            $sql .= 'DELETE FROM `' . _DB_PREFIX_.LggoogleanalyticsEvent::$definition['table'].'` WHERE
                `date_add` < "'. $date2 .'";';
            DB::getInstance()->execute($sql);
        } else {
            $sql = 'SELECT count(*) FROM `' . _DB_PREFIX_. LggoogleanalyticsLog::$definition['table'].'` ';
            $count = (int)DB::getInstance()->getValue($sql);

            $limit = $count - self::LIMIT_LOG;

            if ($limit<0) {
                $limit = 0;
            }

            $sql = 'DELETE FROM `' . _DB_PREFIX_. LggoogleanalyticsLog::$definition['table'].'` 
                ORDER BY `' . LggoogleanalyticsLog::$definition['primary'].'` DESC 
                LIMIT ' . $limit.' ';
            DB::getInstance()->execute($sql);
        }
    }

    private static function getIdByCartId($id_cart){

        if (method_exists('Order','getIdByCartId')) {
            return Order::getIdByCartId($id_cart);
        } else {
            $sql = 'SELECT `id_order`
            FROM `' . _DB_PREFIX_ . 'orders`
            WHERE `id_cart` = ' . (int) $id_cart;

            $result = Db::getInstance()->getValue($sql);

            return !empty($result) ? (int) $result : false;
        }
    }

    public static function jsonEncode($data, $options = 0, $depth = 512)
    {
        return method_exists('Tools', 'jsonEncode') ?
            Tools::jsonEncode($data) :
            json_encode($data, $options, $depth);
    }

    public static function jsonDecode($data, $assoc = false, $depth = 512, $options = 0)
    {
        return method_exists('Tools', 'jsonDecode') ?
            Tools::jsonDecode($data, $assoc) :
            json_decode($data, $assoc, $depth, $options);
    }
}
