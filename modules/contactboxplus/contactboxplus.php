<?php
/**
 * 2007-2014 PrestaShop
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 Chimon Sultan
 * @license   All right reserved
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

include_once(dirname(__FILE__).'/sql/ContactBoxPlusModel.php');


class ContactBoxPlus extends Module
{
    protected $messages;

    public function __construct()
    {
        $this->name = 'contactboxplus';
        $this->tab = 'front_office_features';
        $this->version = '3.8.0';
        $this->author = 'Chimon Sultan';
        $this->need_instance = 0;
        $this->module_key = '2248d21687828e27781fc0f67efd5587';

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('ContactBox: Customizable Contact Form for product pages');
        $this->description = $this->l('Adds a link to a Message Box that lets customers ask questions about a product');
        $this->ps_versions_compliancy = array('min' => '1.7.0.2', 'max' => _PS_VERSION_);
        $this->messages = "";

        $this->ps_version = '17';
    }

    public function install()
    {
        $this->_clearCache('cboxplus_button'.$this->ps_version.'.tpl');
        $this->_clearCache('cboxplus_form'.$this->ps_version.'.tpl');

        $shop_email = Configuration::get('PS_SHOP_EMAIL');
        Configuration::updateValue('CBOXPLUS_SELLER_EMAIL', $shop_email);
        Configuration::updateValue('CBOXPLUS_SEND_CONFIRMATION', true);
        Configuration::updateValue('CBOXPLUS_RECAPTCHA_ENABLED', false);
        Configuration::updateValue('CBOXPLUS_DISPLAY_ONLY_IF_NOT_AVAILABLE', false);
        Configuration::updateValue('CBOXPLUS_RECAPTCHA_SECRET_KEY', '');
        Configuration::updateValue('CBOXPLUS_RECAPTCHA_SITE_KEY', '');
        Configuration::updateValue('CBOXPLUS_IMPERSONATE_CLIENT_EMAIL', '');
        Configuration::updateValue('CBOXPLUS_DISPLAY_GDPR_CONSENT', false);
        Configuration::updateValue('CBOXPLUS_PRIVACY_POLICY_URL', '');

        $categories = ContactBoxPlusModel::getCategoriesId();
        $categories_list = array();
        foreach ($categories as $cat) {
            array_push($categories_list, $cat['id_category']);
        }
        Configuration::updateValue('CBOXPLUS_ACTIVE_CATEGORIES', Tools::jsonEncode($categories_list));

        return parent::install() && $this->registerHook('displayProductButtons')
        && $this->registerHook('header')
        && $this->registerHook('displayHeader')
        && $this->registerHook('displayFooterProduct')
        && ContactBoxPlusModel::createTables()
        && $this->createDemoFields();
    }

    protected function createDemoFields()
    {
        //insertCBPField($type, $validation, $position, $enabled, $required, $width, $iscustomername,
        //$iscustomeremail, $minimaldate, $maximaldate)
        ContactBoxPlusModel::insertCBPField('text', 'isName', 0, 1, 1, 6, 1, 0);
        ContactBoxPlusModel::insertCBPField('text', 'isEmail', 1, 1, 1, 6, 0, 1);
        ContactBoxPlusModel::insertCBPField('checkbox', 'none', 2, 1, 0, 6, 0, 0);
        ContactBoxPlusModel::insertCBPField('select', 'none', 3, 1, 1, 6, 0, 0);
        ContactBoxPlusModel::insertCBPField('textarea', 'isMessage', 4, 1, 1, 12, 0, 0);
        ContactBoxPlusModel::insertCBPField('date', 'none', 5, 1, 0, 6, 0, 0);
        ContactBoxPlusModel::insertCBPField('file', 'none', 6, 1, 0, 6, 0, 0, null, null, 0, 'jpg png jpeg gif');
        $this->context->controller->getLanguages();
        foreach ($this->context->controller->_languages as $language) {
            // ddd("inserting fields");
            //insertCBPFieldLang($id_cbp_field, $id_lang, $label, $description, $options)
            ContactBoxPlusModel::insertCBPFieldLang(1, $language['id_lang'], 'Name', '', '');
            ContactBoxPlusModel::insertCBPFieldLang(2, $language['id_lang'], 'Email', 'We will never spam you', '');
            ContactBoxPlusModel::insertCBPFieldLang(3, $language['id_lang'], 'Quick request', '', 'Please call me back\r\nPlease send me a quote');
            ContactBoxPlusModel::insertCBPFieldLang(4, $language['id_lang'], 'Color', '', 'Red\r\nGreen\r\nBlue\r\nYellow');
            ContactBoxPlusModel::insertCBPFieldLang(5, $language['id_lang'], 'Message', 'What can we do for you?', '');
            ContactBoxPlusModel::insertCBPFieldLang(6, $language['id_lang'], 'Date', '', '');
            ContactBoxPlusModel::insertCBPFieldLang(7, $language['id_lang'], 'Attachment', '', '');
        }
        return true;
    }

    public function uninstall()
    {
        ContactBoxPlusModel::dropTables();
        return parent::uninstall();
    }

    protected function buttonHook()
    {
        if (!$this->isHidden()) {
            return $this->display(__FILE__, 'cboxplus_button'.$this->ps_version.'.tpl');
        }
    }

    public function hookDisplayProductButtons()
    {
        return $this->buttonHook();
    }

    public function hookDisplayLeftColumnProduct()
    {
        return $this->buttonHook();
    }

    public function hookDisplayRightColumnProduct()
    {
        return $this->buttonHook();
    }

    public function hookDisplayProductContent()
    {
        return $this->buttonHook();
    }

    protected function isHidden()
    {
        $only_oos = (int)Configuration::get('CBOXPLUS_DISPLAY_ONLY_IF_NOT_AVAILABLE');
        $product = $this->context->controller->getProduct();
        $isHidden = !$this->isProductPage() || !$this->isActiveCategory();
        $isCatalogMode = (bool)Configuration::get('PS_CATALOG_MODE') || (Group::isFeatureActive() && !(bool)Group::getCurrent()->show_prices);

        if ($only_oos && $product->available_for_order  && $product->quantity > 0 && !$isCatalogMode) {
            $isHidden = true;
        }
        return $isHidden || $this->isQuickView();
    }

    protected function isQuickView()
    {
        return Tools::getValue('action') == 'quickview' || Tools::getValue('content_only') == 1;
    }

    protected function isProductPage()
    {
        if (isset($this->context->controller->php_self)) {
            return $this->context->controller->php_self == 'product';
        }
        return false;
    }

    protected function isActiveCategory()
    {
        $categories = Tools::jsonDecode(Configuration::get('CBOXPLUS_ACTIVE_CATEGORIES'));

        if (!is_array($categories)) {
            return false;
        }

        $category = $this->context->controller->getProduct()->id_category_default;
        return in_array($category, $categories);
    }

    public function hookDisplayFooterProduct()
    {
        if (!$this->isHidden()) {
            $product = $this->context->controller->getProduct();
            $cover = $product->getCover($product->id);
            $phone = '';
            $fields = ContactBoxPlusModel::getCBPFields(true);
            $link = new Link();
            $cbp_url = $link->getProductLink($product);
            $mediumSize = Image::getSize(ImageType::getFormattedName('medium'));

            $max_filesize = $this->fileUploadMaxSize();
            $max_filesize_mb = (int)$max_filesize / 1024 / 1024;

            $this->context->smarty->assign(array(
                'logged' => $this->context->customer->isLogged(true),
                'product' => $product,
                'cover' => $cover,
                'customer_company' => ($this->context->customer->company ? $this->context->customer->company : ''),
                'customer_email' => ($this->context->customer->email ? $this->context->customer->email : ''),
                'customer_phone' => $phone,
                'mediumSize' => $mediumSize,
                'controller' => 'index.php?fc=module&module=contactboxplus&controller=contact&ajax&action=contactform',
                'cbp_fields' => $fields,
                'recaptcha_site_key' => Configuration::get('CBOXPLUS_RECAPTCHA_SITE_KEY'),
                'recaptcha_enabled' => Configuration::get('CBOXPLUS_RECAPTCHA_ENABLED'),
                'gdpr_enabled' => Configuration::get('CBOXPLUS_DISPLAY_GDPR_CONSENT'),
                'privacy_policy_url' => Configuration::get('CBOXPLUS_PRIVACY_POLICY_URL'),

                'cbp_url' => $cbp_url,
                'max_filesize' => $max_filesize_mb,
            ));



            return $this->display(__FILE__, 'cboxplus_form'.$this->ps_version.'.tpl');
        }
    }

    public function hookHeader()
    {
        $max_filesize = $this->fileUploadMaxSize();

        Media::addJsDefL('ctbx_max_filesize', $max_filesize * 1024 * 1024);
        Media::addJsDefL('ctbx_file_too_large', $this->l('The file you have submitted is too large'));

        Media::addJsDefL('ctbx_productmessage_ok', $this->l('OK'));
        Media::addJsDefL('ctbx_message_text', $this->l('Your message have been succesfully sent. You will get an answer soon.'));
        Media::addJsDefL('ctbx_message_title', $this->l('Message sent'));
        Media::addJsDefL('ctbx_m_send', $this->l('Send'));
        Media::addJsDefL('ctbx_m_sending', $this->l('Sending'));
        Media::addJsDefL('ctbx_controller', $this->context->link->getPageLink('index', true).'?fc=module&module=contactboxplus&controller=contact&ajax&action=contactform');


        if (isset($this->context->controller->php_self)
            && $this->context->controller->php_self === 'product'
            && !$this->isHidden()
        ) {
            $this->context->controller->registerStylesheet(
                'module-contactboxplus-core-style',
                'modules/'.$this->name.'/views/css/contactbox'.$this->ps_version.'.css',
                array(
                  'media' => 'all',
                  'priority' => 200,
                )
            );

            $this->context->controller->registerStylesheet(
                'module-contactboxplus-facybox-style',
                'modules/'.$this->name.'/views/css/fancybox.css',
                array(
                  'media' => 'all',
                  'priority' => 200,
                )
            );

            $this->context->controller->registerJavascript(
                'module-contactboxplus-recaptcha',
                'https://www.google.com/recaptcha/api.js',
                array(
                  'priority' => 200,
                  'attribute' => 'async',
                  'server' => 'remote',
                  'position' => 'head',
                )
            );

            $this->context->controller->registerJavascript(
                'module-contactboxplus-core',
                'modules/'.$this->name.'/views/js/contactbox'.$this->ps_version.'.js',
                array(
                  'priority' => 200,
                  'attribute' => 'async',
                )
            );

            $this->context->controller->registerJavascript(
                'module-contactboxplus-fancybox',
                'modules/'.$this->name.'/views/js/fancybox.js',
                array(
                  'priority' => 200,
                  'attribute' => 'async',
                )
            );
        }
    }


    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        $this->postProcess();

        $this->context->smarty->assign('module_dir', $this->_path);

        if (Tools::isSubmit('addcontactboxplus') || Tools::isSubmit('editcontactboxplus')) {
            return $this->displayAddForm();
        }

        if (Tools::isSubmit('deleteFieldConfirmation')) {
            $this->messages .= $this->displayConfirmation($this->l('Deletion successful.'));
        }

        //$output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');
        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/help.tpl');

        return $this->messages.$this->renderForm().$output;
    }

    protected function getMultiLanguageInfoMsg()
    {
        return '<p class="alert alert-warning">'.
                    $this->l('Since multiple languages are activated on your shop, please mind to set the field label and description for all of them').
                '</p>';
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $this->_errors = array();
        if (((bool)Tools::isSubmit('submitContactBoxPlusModule')) == true) {
            $form_values = $this->getConfigFormValues();

            foreach (array_keys($form_values) as $key) {
                Configuration::updateValue($key, Tools::getValue($key));
            }

            if (Tools::getValue('categoryBox')) {
                $categories = Tools::getValue('categoryBox');
            } else {
                $categories = array();
            }

            Configuration::updateValue('CBOXPLUS_ACTIVE_CATEGORIES', Tools::jsonEncode($categories));



            $this->messages .= $this->displayConfirmation($this->l('Configuration saved.'));
        } else {
            if (((bool)Tools::isSubmit('submitAddField')) == true) {
                $position = Tools::getvalue('position');
                $this->context->controller->getLanguages();
                $enabled = (int)Tools::getvalue('enabled');
                $required = (int)Tools::getvalue('required');
                $type = Tools::getvalue('type');
                $validation = Tools::getvalue('validation');
                $width = (int)Tools::getvalue('width');
                $iscustomeremail = (int)Tools::getvalue('iscustomeremail');
                $iscustomername = (int)Tools::getvalue('iscustomername');
                $minimaldate = Tools::getvalue('minimaldate');
                $maximaldate = Tools::getvalue('maximaldate');
                $displaydatehint = Tools::getvalue('displaydatehint');
                $allowedextensions = Tools::getvalue('allowedextensions');

                if (Tools::isSubmit('newField')) {
                    $position = ContactBoxPlusModel::getMaxPosition();
                    $id_cbp_field = ContactBoxPlusModel::insertCBPField(
                        $type,
                        $validation,
                        $position,
                        $enabled,
                        $required,
                        $width,
                        $iscustomername,
                        $iscustomeremail,
                        $minimaldate,
                        $maximaldate,
                        $displaydatehint,
                        $allowedextensions
                    );

                    if ($id_cbp_field !== false) {
                        foreach ($this->context->controller->_languages as $language) {
                            $label = Tools::getValue('label_'.$language['id_lang']);
                            $description = Tools::getValue('description_'.$language['id_lang']);
                            $options = Tools::getValue('options_'.$language['id_lang']);
                            ContactBoxPlusModel::insertCBPFieldLang(
                                $id_cbp_field,
                                $language['id_lang'],
                                $label,
                                $description,
                                $options
                            );
                        }
                        $this->messages .= $this->displayConfirmation($this->l('Successfuly added.'));
                    } else {
                        $this->_errors[] = $this->l('Cannot create a block!');
                    }
                } elseif (Tools::isSubmit('updateField')) {
                    $id_cbp_field = Tools::getvalue('id_cbp_field');

                    $updated = ContactBoxPlusModel::updateCBPField(
                        $id_cbp_field,
                        $type,
                        $validation,
                        $position,
                        $enabled,
                        $required,
                        $width,
                        $iscustomername,
                        $iscustomeremail,
                        $minimaldate,
                        $maximaldate,
                        $displaydatehint,
                        $allowedextensions
                    );

                    foreach ($this->context->controller->_languages as $language) {
                        $label = Tools::getValue('label_'.$language['id_lang']);
                        $description = Tools::getValue('description_'.$language['id_lang']);
                        $options = Tools::getValue('options_'.$language['id_lang']);
                        ContactBoxPlusModel::updateCBPFieldLang(
                            $id_cbp_field,
                            $label,
                            $description,
                            $language['id_lang'],
                            $options
                        );
                    }
                    if ($updated !== false) {
                        $this->messages .= $this->displayConfirmation($this->l('Successfuly updated.'));
                    }
                }
            } else {
                if (Tools::isSubmit('deletecontactboxplus') && Tools::getValue('id_cbp_field')) {
                    $id_cbp_field = Tools::getvalue('id_cbp_field');

                    if ($id_cbp_field) {
                        ContactBoxPlusModel::deleteCBPField((int)$id_cbp_field);

                        Tools::redirectAdmin(
                            AdminController::$currentIndex.'&configure='.$this->name.
                            '&token='.Tools::getAdminTokenLite('AdminModules').
                            '&deleteFieldConfirmation'
                        );
                    } else {
                        $this->messages .= $this->displayError(
                            $this->l('Error: You are trying to delete a non-existing Field.')
                        );
                    }
                } elseif (Tools::isSubmit('updatePositions')) {
                    $this->updatePositionsDnd();
                }
            }
        }
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        $shop_email = Configuration::get('PS_SHOP_EMAIL');
        return array(
            'CBOXPLUS_SELLER_EMAIL' => Configuration::get('CBOXPLUS_SELLER_EMAIL', $shop_email),
            'CBOXPLUS_RECAPTCHA_ENABLED' => Configuration::get('CBOXPLUS_RECAPTCHA_ENABLED', false),
            'CBOXPLUS_RECAPTCHA_SECRET_KEY' => Configuration::get('CBOXPLUS_RECAPTCHA_SECRET_KEY', ''),
            'CBOXPLUS_RECAPTCHA_SITE_KEY' => Configuration::get('CBOXPLUS_RECAPTCHA_SITE_KEY', ''),
            'CBOXPLUS_DISPLAY_ONLY_IF_NOT_AVAILABLE' => Configuration::get('CBOXPLUS_DISPLAY_ONLY_IF_NOT_AVAILABLE', false),
            //'CBOXPLUS_SELLER_EMAIL_FROM' => Configuration::get('CBOXPLUS_SELLER_EMAIL_FROM', $shop_email),
            'CBOXPLUS_SEND_CONFIRMATION' => Configuration::get('CBOXPLUS_SEND_CONFIRMATION', ''),
            'CBOXPLUS_DISPLAY_GDPR_CONSENT' => Configuration::get('CBOXPLUS_DISPLAY_GDPR_CONSENT', ''),
            'CBOXPLUS_PRIVACY_POLICY_URL' => Configuration::get('CBOXPLUS_PRIVACY_POLICY_URL', ''),
            'CBOXPLUS_IMPERSONATE_CLIENT_EMAIL' => Configuration::get('CBOXPLUS_IMPERSONATE_CLIENT_EMAIL', ''),
            //'CBOXPLUS_PRODUCTS_ACTIVE_LIST' => Configuration::get('CBOXPLUS_PRODUCTS_ACTIVE_LIST',''),
            // 'CBOXPLUS_CATEGORIES_ACTIVE_LIST' => Configuration::get('CBOXPLUS_CATEGORIES_ACTIVE_LIST',''),
            //'CBOXPLUS_PRODUCTS_HIDE_LIST' => Configuration::get('CBOXPLUS_PRODUCTS_HIDE_LIST',''),
            //'CBOXPLUS_CATEGORIES_HIDE_LIST' => Configuration::get('CBOXPLUS_CATEGORIES_HIDE_LIST',''),
        );
    }

    protected function updatePositionsDnd()
    {
        if (Tools::getValue('module-contactboxplus')) {
            $positions = Tools::getValue('module-contactboxplus');
        } else {
            $positions = array();
        }

        foreach ($positions as $position => $value) {
            $pos = explode('_', $value);
            if (isset($pos[2])) {
                ContactBoxPlusModel::updateCBPFieldPosition($pos[2], $position);
            }
        }
    }

    protected function displayAddForm()
    {
        $this->context->controller->addJS(($this->_path).'views/js/contactbox_admin.js');

        $token = Tools::getAdminTokenLite('AdminModules');
        $back = Tools::safeOutput(Tools::getValue('back', ''));
        $current_index = AdminController::$currentIndex;
        if (!isset($back) || empty($back)) {
            $back = $current_index.'&amp;configure='.$this->name.'&token='.$token;
        }

        if (Tools::isSubmit('editcontactboxplus') && Tools::getValue('id_cbp_field')) {
            $display = 'edit';
            $id_cbp_field = (int)Tools::getValue('id_cbp_field');
            $cbpField = ContactBoxPlusModel::getField($id_cbp_field);
            //ddd($cbpField);
        } else {
            $display = 'add';
        }

        $this->fields_form[0]['form'] = array(
            'tinymce' => false,
            'legend' => array(
                'title' => isset($cbpField) ? $this->l('Edit the custom field') : $this->l('New custom field'),
                'icon' => isset($cbpField) ? 'icon-edit' : 'icon-plus-square'
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Label'),
                    'name' => 'label',
                    'lang' => true,
                    'required' => true,
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Description'),
                    'name' => 'description',
                    'lang' => true,
                    'desc' => $this->l('Will be displayed just below the field')
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Type'),
                    'name' => 'type',
                    'options' => array(
                        'query' => array(
                            array(
                                'id' => 'text',
                                'name' => $this->l('Text')
                            ),
                            array(
                                'id' => 'date',
                                'name' => $this->l('Date')
                            ),
                            array(
                                'id' => 'file',
                                'name' => $this->l('File upload')
                            ),
                            array(
                                'id' => 'textarea',
                                'name' => $this->l('Textarea')
                            ),
                            array(
                                'id' => 'password',
                                'name' => $this->l('Password')
                            ),
                            array(
                                'id' => 'select',
                                'name' => $this->l('Dropdown list')
                            ),
                            array(
                                'id' => 'radio',
                                'name' => $this->l('Radio buttons')
                            ),
                            array(
                                'id' => 'checkbox',
                                'name' => $this->l('Checkbox(es)')
                            ),
                        ),
                        'id' => 'id',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Options'),
                    'name' => 'options',
                    'lang' => true,
                    'desc' => $this->l('Describe the field. For checkboxes and radio buttons add choices here. One choice per line'),
                    'class' => 'opttxt',
                    'height' => '80px',
                    'empty_message' => $this->l('Options here. One per line'),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('File types'),
                    'name' => 'allowedextensions',
                    'desc' => $this->l('You can add a space separated list of extensions here').'<br>'.
                    $this->l('Uppercase and lowercase variant are automatically handeled').'<br>'.
                    $this->l('Exemple').': jpeg jpg PNG gif',
                ),
                array(
                    'type' => 'date',
                    'label' => $this->l('Starting date'),
                    'name' => 'minimaldate',
                    'lang' => true,
                    'desc' => $this->l('Minimal date to allow. Clear the field to disable date enforcement')
                ),
                array(
                    'type' => 'date',
                    'label' => $this->l('End date'),
                    'name' => 'maximaldate',
                    'lang' => true,
                    'desc' => $this->l('Maximal date to allow. Clear the field to disable date enforcement')
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Validation'),
                    'name' => 'validation',
                    'options' => array(
                        'query' => array(
                            array(
                                'id' => 'none',
                                'name' => $this->l('None')
                            ),
                            array(
                                'id' => 'isName',
                                'name' => $this->l('Name')
                            ),
                            array(
                                'id' => 'isGenericName',
                                'name' => $this->l('Generic name')
                            ),
                            array(
                                'id' => 'isEmail',
                                'name' => $this->l('E-mail')
                            ),
                            array(
                                'id' => 'isPhoneNumber',
                                'name' => $this->l('Phone number')
                            ),
                            array(
                                'id' => 'isMessage',
                                'name' => $this->l('Message')
                            ),
                            array(
                                'id' => 'isAddress',
                                'name' => $this->l('Address')
                            ),
                            array(
                                'id' => 'isPostCode',
                                'name' => $this->l('Post code')
                            ),
                            array(
                                'id' => 'isCityName ',
                                'name' => $this->l('City name')
                            ),
                            array(
                                'id' => 'isPasswd',
                                'name' => $this->l('Password')
                            ),

                        ),
                        'id' => 'id',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Display date hint'),
                    'name' => 'displaydatehint',
                    'values' => array(
                        array(
                            'id' => 'yes',
                            'value' => 1,
                            'label' => $this->l('Yes')
                        ),
                        array(
                            'id' => 'no',
                            'value' => 0,
                            'label' => $this->l('No')
                        ),
                    ),
                    'desc' => $this->l('Display a hint below the date field with the minimal and maximal allowed date')
                ),
                array(
                    'type' => 'radio',
                    'label' => $this->l('Width'),
                    'name' => 'width',
                    'values' => array(
                        array(
                            'id' => 'full',
                            'value' => 12,
                            'label' => $this->l('Full width')
                        ),
                        array(
                            'id' => 'half',
                            'value' => 6,
                            'label' => $this->l('Half width')
                        ),
                    ),
                    'desc' => $this->l('Field width')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Required'),
                    'name' => 'required',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'yes',
                            'value' => 1,
                            'label' => $this->l('Yes')
                        ),
                        array(
                            'id' => 'no',
                            'value' => 0,
                            'label' => $this->l('No')
                        ),
                    ),
                    'desc' => $this->l('Required fields have an asterisk (*) beside the label, and will ensure the field is filled')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Bind to customer name'),
                    'name' => 'iscustomername',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'yes',
                            'value' => 1,
                            'label' => $this->l('Yes')
                        ),
                        array(
                            'id' => 'no',
                            'value' => 0,
                            'label' => $this->l('No')
                        ),
                    ),
                    'desc' => $this->l('Enable this if this field should be considered as the customer name. Useful to customize the response to the client')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Bind to customer e-mail address'),
                    'name' => 'iscustomeremail',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'yes',
                            'value' => 1,
                            'label' => $this->l('Yes')
                        ),
                        array(
                            'id' => 'no',
                            'value' => 0,
                            'label' => $this->l('No')
                        ),
                    ),
                    'desc' => $this->l('Enable this if this field should be considered as the customer e-mail address. If there is no e-mail address in the form, the customer will not recieve any confirmation.')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Enabled'),
                    'name' => 'enabled',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'enabled',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'disabled',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        ),
                    ),
                    'desc' => $this->l('Enable this custom field')
                ),

            ),
            'buttons' => array(
                'cancelBlock' => array(
                    'title' => $this->l('Cancel'),
                    'href' => $back,
                    'icon' => 'process-icon-cancel'
                )
            ),
            'submit' => array(
                'name' => 'submitAddField',
                'title' => $this->l('Save'),
            )
        );

        $this->context->controller->getLanguages();
        foreach ($this->context->controller->_languages as $language) {
            if (Tools::getValue('label_'.$language['id_lang'])) {
                $this->fields_value['label'][$language['id_lang']] = Tools::getValue('label_'.$language['id_lang']);
            } else {
                if (isset($cbpField) && isset($cbpField[$language['id_lang']]['label'])) {
                    $this->fields_value['label'][$language['id_lang']] = $cbpField[$language['id_lang']]['label'];
                } else {
                    $this->fields_value['label'][$language['id_lang']] = '';
                }
            }

            if (Tools::getValue('description_'.$language['id_lang'])) {
                $this->fields_value['description'][$language['id_lang']] = Tools::getValue(
                    'description_'.$language['id_lang']
                );
            } else {
                if (isset($cbpField) && isset($cbpField[$language['id_lang']]['description'])) {
                    $this->fields_value['description'][$language['id_lang']] =
                        $cbpField[$language['id_lang']]['description'];
                } else {
                    $this->fields_value['description'][$language['id_lang']] = '';
                }
            }

            if (Tools::getValue('options_'.$language['id_lang'])) {
                $this->fields_value['options'][$language['id_lang']] =
                    Tools::getValue('options_'.$language['id_lang']);
            } else {
                if (isset($cbpField) && isset($cbpField[$language['id_lang']]['options'])) {
                    $this->fields_value['options'][$language['id_lang']] =
                        $cbpField[$language['id_lang']]['options'];
                } else {
                    $this->fields_value['options'][$language['id_lang']] = '';
                }
            }
        }

        if (Tools::getValue('position')) {
            $this->fields_value['position'] = Tools::getValue('position');
        } else {
            if (isset($cbpField) && isset($cbpField[1]['position'])) {
                $this->fields_value['position'] = $cbpField[1]['position'];
            } else {
                $this->fields_value['position'] = '';
            }
        }

        if (Tools::getValue('type')) {
            $this->fields_value['type'] = Tools::getValue('type');
        } else {
            if (isset($cbpField) && isset($cbpField[1]['type'])) {
                $this->fields_value['type'] = $cbpField[1]['type'];
            } else {
                $this->fields_value['type'] = 'text';
            }
        }

        if (Tools::getValue('validation')) {
            $this->fields_value['validation'] = Tools::getValue('validation');
        } else {
            if (isset($cbpField) && isset($cbpField[1]['validation'])) {
                $this->fields_value['validation'] = $cbpField[1]['validation'];
            } else {
                $this->fields_value['validation'] = 'string';
            }
        }

        if (Tools::getValue('enabled')) {
            $this->fields_value['enabled'] = Tools::getValue('enabled');
        } else {
            if (isset($cbpField) && isset($cbpField[1]['enabled'])) {
                $this->fields_value['enabled'] = $cbpField[1]['enabled'];
            } else {
                $this->fields_value['enabled'] = 'enabled';
            }
        }

        if (Tools::getValue('required')) {
            $this->fields_value['required'] = Tools::getValue('required');
        } else {
            if (isset($cbpField) && isset($cbpField[1]['required'])) {
                $this->fields_value['required'] = $cbpField[1]['required'];
            } else {
                $this->fields_value['required'] = 'required';
            }
        }

        if (Tools::getValue('width')) {
            $this->fields_value['width'] = Tools::getValue('width');
        } else {
            if (isset($cbpField) && isset($cbpField[1]['width'])) {
                $this->fields_value['width'] = $cbpField[1]['width'];
            } else {
                $this->fields_value['width'] = 12;
            }
        }


        if (Tools::getValue('iscustomername')) {
            $this->fields_value['iscustomername'] = Tools::getValue('iscustomername');
        } else {
            if (isset($cbpField) && isset($cbpField[1]['iscustomername'])) {
                $this->fields_value['iscustomername'] = $cbpField[1]['iscustomername'];
            } else {
                $this->fields_value['iscustomername'] = 0;
            }
        }

        if (Tools::getValue('iscustomeremail')) {
            $this->fields_value['iscustomeremail'] = Tools::getValue('iscustomeremail');
        } else {
            if (isset($cbpField) && isset($cbpField[1]['iscustomeremail'])) {
                $this->fields_value['iscustomeremail'] = $cbpField[1]['iscustomeremail'];
            } else {
                $this->fields_value['iscustomeremail'] = 0;
            }
        }

        if (Tools::getValue('minimaldate')) {
            $this->fields_value['minimaldate'] = Tools::getValue('minimaldate');
        } else {
            if (isset($cbpField) && isset($cbpField[1]['minimaldate'])) {
                $this->fields_value['minimaldate'] = $cbpField[1]['minimaldate'];
            } else {
                $this->fields_value['minimaldate'] = "";
            }
        }

        if (Tools::getValue('maximaldate')) {
            $this->fields_value['maximaldate'] = Tools::getValue('maximaldate');
        } else {
            if (isset($cbpField) && isset($cbpField[1]['maximaldate'])) {
                $this->fields_value['maximaldate'] = $cbpField[1]['maximaldate'];
            } else {
                $this->fields_value['maximaldate'] = "";
            }
        }

        if (Tools::getValue('displaydatehint')) {
            $this->fields_value['displaydatehint'] = Tools::getValue('displaydatehint');
        } else {
            if (isset($cbpField) && isset($cbpField[1]['displaydatehint'])) {
                $this->fields_value['displaydatehint'] = $cbpField[1]['displaydatehint'];
            } else {
                $this->fields_value['displaydatehint'] = "";
            }
        }


        $helper = $this->initForm();
        if (isset($id_cbp_field)) {
            $helper->currentIndex = AdminController::$currentIndex.
                '&configure='.$this->name.'&id_cbp_field='.$id_cbp_field;
            $helper->submit_action = 'updateField';
            $this->fields_value['id_cbp_field'] = $id_cbp_field;
        } else {
            $helper->submit_action = 'newField';
        }

        if (Tools::getValue('allowedextensions')) {
            $this->fields_value['allowedextensions'] = Tools::getValue('allowedextensions');
        } else {
            if (isset($cbpField) && isset($cbpField[1]['allowedextensions'])) {
                $this->fields_value['allowedextensions'] = $cbpField[1]['allowedextensions'];
            } else {
                $this->fields_value['allowedextensions'] = "";
            }
        }

        $helper->fields_value = isset($this->fields_value) ? $this->fields_value : array();


        $languages = Language::getLanguages(false);

        if (count($languages) > 1) {
            return $this->getMultiLanguageInfoMsg().$helper->generateForm($this->fields_form);
        }

        return $helper->generateForm($this->fields_form);
    }

    protected function initForm()
    {
        $helper = new HelperForm();

        $helper->module = $this;
        $helper->submit_action = 'submitAddField';
        $helper->name_controller = 'blockcms';
        $helper->identifier = $this->identifier;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->languages = $this->context->controller->_languages;
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
        $helper->default_form_language = $this->context->controller->default_form_language;
        $helper->allow_employee_form_lang = $this->context->controller->allow_employee_form_lang;
        $helper->toolbar_scroll = true;

        return $helper;
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $this->context->controller->addJqueryPlugin('tablednd');

        $this->context->controller->addJS(_PS_JS_DIR_.'admin/dnd.js');

        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitContactBoxPlusModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm(), $this->getCustomFieldsForm()));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        $tree_categories_helper = new HelperTreeCategories('categories-treeview');
        $tree_categories_helper->setRootCategory(
            (Shop::getContext() == Shop::CONTEXT_SHOP ? Category::getRootCategory()->id_category : 0)
        )->setUseCheckBox(true);

        $categories = Tools::jsonDecode(Configuration::get('CBOXPLUS_ACTIVE_CATEGORIES', ''));
        if (!is_array($categories)) {
            $categories = array();
        }

        $tree_categories_helper->setSelectedCategories($categories);
        $this->tree_tpl = $tree_categories_helper->render();

        $recipients = Configuration::get('CBOXPLUS_SELLER_EMAIL');
        $recipients = array_map('trim', (explode(',', $recipients)));
        $invalid_email_message = "";
        foreach ($recipients as $r) {
            if (!Validate::isEmail($r)) {
                $invalid_email_message = '<p class="btn-danger">'.$this->l('This field seems invalid. Please use valid email addresses, separated by a comma').'</p>';
            }
        }

        return array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs',
                ),
                'tinymce' => true,
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Send confirmation email'),
                        'name' => 'CBOXPLUS_SEND_CONFIRMATION',
                        'is_bool' => true,
                        'desc' => $this->l('Send a confirmation email to customer ?'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Send emails with customer email address'),
                        'name' => 'CBOXPLUS_IMPERSONATE_CLIENT_EMAIL',
                        'is_bool' => true,
                        'desc' => $this->l('Use customer email address to send the email to the merchant. Disable this only if you are not receiving the emails'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Display only if product not available'),
                        'name' => 'CBOXPLUS_DISPLAY_ONLY_IF_NOT_AVAILABLE',
                        'is_bool' => true,
                        'desc' => $this->l('The contact button will be displayed only if the product is out of stock or is not available for sell'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'col' => 4,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $invalid_email_message.$this->l('Email address to receive the message from the customer. You can add several email addresses, separated by a comma (,)'),
                        'name' => 'CBOXPLUS_SELLER_EMAIL',
                        'label' => $this->l('Customer Service Email'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Display GDPR Consent'),
                        'name' => 'CBOXPLUS_DISPLAY_GDPR_CONSENT',
                        'is_bool' => true,
                        'desc' => $this->l('Display GDPR Consent checkbox (and require it to be checked)'),
                        'values' => array(
                            array(
                                'id' => 'gdpr_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'gdpr_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'col' => 4,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-link"></i>',
                        'desc' => $this->l(''),
                        'name' => 'CBOXPLUS_PRIVACY_POLICY_URL',
                        'label' => $this->l('Privacy Policy URL'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Enable reCAPTCHA protection'),
                        'name' => 'CBOXPLUS_RECAPTCHA_ENABLED',
                        'is_bool' => true,
                        'desc' => $this->l('reCAPTCHA helps to protect your form against spammers and bots. To use reCAPTCHA, you need to').
                            '<a target="_blank" href="http://www.google.com/recaptcha/admin">'.
                            $this->l('sign up for an API key pair').'</a>'.
                            $this->l(' for your site. The key pair consists of a site key and secret. Please visit '),
                        'values' => array(
                            array(
                                'id' => 'recaptcha_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'recaptcha_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'col' => 4,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-key"></i>',
                        'desc' => $this->l(''),
                        'name' => 'CBOXPLUS_RECAPTCHA_SECRET_KEY',
                        'label' => $this->l('reCAPTCHA secret key'),
                    ),
                    array(
                        'col' => 4,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-key"></i>',
                        'desc' => $this->l(''),
                        'name' => 'CBOXPLUS_RECAPTCHA_SITE_KEY',
                        'label' => $this->l('reCAPTCHA site key'),
                    ),

                    /*array(
                        'col' => 8,
                        'type' => 'textarea',
                        'lang' => true,
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $this->l('Confirmation alert text'),
                        'name' => 'CBOXPLUS_CONFIRMATION_ALERT',
                        'label' => $this->l('Customer Service Email'),
                        'class' => 'rte',
                        'autoload_rte' => true,
                    ),*/
                    array(
                        'col' => 8,
                        'type' => 'html',
                        'desc' => $this->l('Display the button on checked categories only'),
                        'name' => $this->tree_tpl,
                        'id' => 'cbp_categ_tree',
                        'label' => $this->l('Active categories'),
                    ),


                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /**
     * Create the structure of your form.
     */
    protected function getCustomFieldsForm()
    {
        $current_index = AdminController::$currentIndex;
        $token = Tools::getAdminTokenLite('AdminModules');

        $form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Custom fields configuration'),
                    'icon' => 'icon-list-alt'
                ),
                'input' => array(
                    array(
                        'type' => 'cbp_fields',
                        'label' => $this->l('ContactBox Plus Custom fields'),
                        'name' => 'cbp_fields',
                        'values' => array(
                            0 => ContactBoxPlusModel::getCBPFields(),
                        )

                    )
                ),
                'buttons' => array(
                    'newBField' => array(
                        'title' => $this->l('New field'),
                        'href' => $current_index.'&amp;configure='.$this->name.'&amp;token='.$token.
                            '&amp;addcontactboxplus',
                        'class' => 'pull-right',
                        'icon' => 'process-icon-new'
                    )
                )
            )
        );
        return $form;
    }

    /**
     * Set values for the inputs.
     */
    protected function getAddFormValues()
    {
        if (Tools::isSubmit('editcontactboxplus') && Tools::getValue('id_cbp_field')) {
            $id_cbp_field = (int)Tools::getValue('id_cbp_field');
            $cbpField = ContactBoxPlusModel::getField($id_cbp_field);

            $fields_value = array();

            foreach ($cbpField as $cbpFieldLang) {
                foreach ($cbpFieldLang as $key => $value) {
                    $fields_value[$key] = $value;
                }
            }
            return $fields_value;
        }
        return array();
    }

    // Returns a file size limit in bytes based on the PHP upload_max_filesize
    // and post_max_size
    private function fileUploadMaxSize()
    {
        static $max_size = -1;

        if ($max_size < 0) {
            // Start with post_max_size.
            $post_max_size = $this->parseSize(ini_get('post_max_size'));
            if ($post_max_size > 0) {
                $max_size = $post_max_size;
            }

            // If upload_max_size is less, then reduce. Except if upload_max_size is
            // zero, which indicates no limit.
            $upload_max = $this->parseSize(ini_get('upload_max_filesize'));
            if ($upload_max > 0 && $upload_max < $max_size) {
                $max_size = $upload_max;
            }
        }
        return $max_size;
    }

    private function parseSize($size)
    {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
        $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
        if ($unit) {
            // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
            return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
        } else {
            return round($size);
        }
    }
}
