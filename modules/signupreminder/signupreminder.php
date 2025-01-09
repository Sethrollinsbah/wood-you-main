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

class SignUpReminder extends Module
{
    public function __construct()
    {
        if (!defined('_PS_VERSION_')) {
            exit;
        }

        $this->name = 'signupreminder';
        $this->tab = 'front_office_features';
        $this->version = '1.2.0';
        $this->author = 'Prestapro';
        $this->need_instance = 0;
        $this->secure_key = Tools::encrypt($this->name);
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;
        $this->module_key = 'bb3330cf471973f484a1234e7e4ccaa1';

        parent::__construct();

        $this->displayName = $this->l('Sign-Up Reminder');
        $this->description = $this->l('Adds a configurable pop-up window inviting visitors to subscribe.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        $logo = $this->name.'/img/logo.jpg';
        $this->image_path = _MODULE_DIR_.$logo;
        $this->image_save_path = _PS_MODULE_DIR_.$logo;
    }

    public function install()
    {
        $default_settings = Tools::jsonEncode(array(
            'delay' => 5,
            'start_date' => null,
            'end_date' => null,
            'confirmation' => 1,
            'width' => 690,
            'height' => 520,
            'image_enabled' => 1,
            'image_position' => 'left',
            'title' => array(
                'text' => array(
                    (int)$this->context->language->id => $this->l('Sign up for our newsletter and promotions!'),
                ),
                'color' => '#ffffff',
                'size' => 20,
            ),
            'message' => array(
                'text' => array(
                    (int)$this->context->language->id => $this->l('and get 25% OFF on your next purchase'),
                ),
                'color' => '#ffffff',
                'size' => 12,
            ),
            'fields' => array(
                'name' => array(
                    'enabled' => 0,
                    'required' => 0,
                ),
                'gender' => array(
                    'enabled' => 0,
                ),
                'birthdate' => array(
                    'enabled' => 0,
                    'required' => 0,
                ),
            ),
        ));

        if (!parent::install()
        || !$this->registerHook('displayHeader')
        || !$this->registerHook('displayFooter')
        || !Configuration::updateValue('SUR_SETTINGS', $default_settings)) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall()
        || !Configuration::deleteByName('SUR_SETTINGS')) {
            return false;
        }

        return true;
    }

    private function convertImage($resource, $save_path, $quality = 90)
    {
        imagejpeg($resource, $save_path, (int)$quality);
        imagedestroy($resource);
    }

    private function displayConfigurationForm()
    {
        $fields_form = array();

        $fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->l('General Settings'),
                'icon' => 'icon-wrench',
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Delay'),
                    'name' => 'delay',
                    'class' => 'col-lg-4',
                    'desc' => $this->l('Delay in seconds between visitor coming to the site and pop-up appearing'),
                    'suffix' => $this->l('sec'),
                    'required' => true,
                ),
                array(
                    'type' => 'date',
                    'label' => $this->l('Start date'),
                    'name' => 'start_date',
                ),
                array(
                    'type' => 'date',
                    'label' => $this->l('End date'),
                    'name' => 'end_date',
                    'desc' => $this->l('Leave empty for pop-up to appear indefinitely'),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Confirmation'),
                    'name' => 'confirmation',
                    'desc' => $this->l('Whether to send an email confirmation to the user after they sign up'),
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
                    'type' => 'text',
                    'label' => $this->l('Width'),
                    'name' => 'width',
                    'class' => 'col-lg-4',
                    'desc' => $this->l('Width of the pop-up window in pixels'),
                    'suffix' => $this->l('px'),
                    'required' => true,
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Height'),
                    'name' => 'height',
                    'class' => 'col-lg-4',
                    'desc' => $this->l('Height of the pop-up window in pixels'),
                    'suffix' => $this->l('px'),
                    'required' => true,
                ),
                array(
                    'type' => 'file',
                    'label' => $this->l('Image'),
                    'name' => 'image',
                    'desc' => $this->l('JPG, PNG or GIF file'),
                    'thumb' => null,
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Show image'),
                    'name' => 'image_enabled',
                    'values' => array(
                        array(
                          'value' => 1,
                        ),
                        array(
                          'value' => 0,
                        ),
                    ),
                    'is_bool' => true,
                ),
                array(
                    'type' => 'radio',
                    'label' => $this->l('Image position'),
                    'name' => 'image_position',
                    'desc' => $this->l(''),
                    'values' => array(
                        array(
                          'id' => 'image_position_left',
                          'value' => 'left',
                          'label' => $this->l('Left')
                        ),
                        array(
                          'id' => 'image_position_right',
                          'value' => 'right',
                          'label' => $this->l('Right')
                        ),
                    ),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Title'),
                    'name' => 'title_text',
                    'desc' => $this->l(''),
                    'lang' => true,
                ),
                array(
                    'type' => 'color',
                    'label' => $this->l('Title color'),
                    'name' => 'title_color',
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Title size'),
                    'name' => 'title_size',
                    'class' => 'col-lg-4',
                    'desc' => $this->l('Font size of the title in pixels'),
                    'suffix' => $this->l('px'),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Message'),
                    'name' => 'message_text',
                    'desc' => $this->l(''),
                    'lang' => true,
                ),
                array(
                    'type' => 'color',
                    'label' => $this->l('Message color'),
                    'name' => 'message_color',
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Message size'),
                    'name' => 'message_size',
                    'class' => 'col-lg-4',
                    'desc' => $this->l('Font size of the message in pixels'),
                    'suffix' => $this->l('px'),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Show name field'),
                    'name' => 'name_enabled',
                    'desc' => $this->l(''),
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
                    'label' => $this->l('Name field required'),
                    'name' => 'name_required',
                    'desc' => $this->l(''),
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
                    'label' => $this->l('Show gender field'),
                    'name' => 'gender_enabled',
                    'desc' => $this->l(''),
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
                    'label' => $this->l('Show birthdate field'),
                    'name' => 'birthdate_enabled',
                    'desc' => $this->l(''),
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
                    'label' => $this->l('Birthdate field required'),
                    'name' => 'birthdate_required',
                    'desc' => $this->l(''),
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
                'class' => 'btn btn-default pull-right'
            ),
        );

        $helper = new HelperForm();

        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;
        $helper->languages = $this->context->controller->getLanguages();
        $helper->id_language = $this->context->language->id;

        $helper->title = $this->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = array(
            'save' => array(
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
                '&token='.Tools::getAdminTokenLite('AdminModules'),
            ),
            'back' => array(
                'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            ),
        );

        $current_settings = Tools::jsonDecode(Configuration::get('SUR_SETTINGS'));

        $helper->fields_value = array(
            'delay' => $current_settings->delay,
            'start_date' => $current_settings->start_date,
            'end_date' => $current_settings->end_date,
            'confirmation' => $current_settings->confirmation,
            'width' => $current_settings->width,
            'height' => $current_settings->height,
            'image_enabled' => $current_settings->image_enabled,
            'image_position' => $current_settings->image_position,
            'title_color' => $current_settings->title->color,
            'title_size' => $current_settings->title->size,
            'message_color' => $current_settings->message->color,
            'message_size' => $current_settings->message->size,
            'name_enabled' => $current_settings->fields->name->enabled,
            'name_required' => $current_settings->fields->name->required,
            'gender_enabled' => $current_settings->fields->gender->enabled,
            'birthdate_enabled' => $current_settings->fields->birthdate->enabled,
            'birthdate_required' => $current_settings->fields->birthdate->required,
        );

        foreach ($this->context->controller->getLanguages() as $lang) {
            $title = $message = null;

            if (isset($current_settings->title->text->{$lang['id_lang']})) {
                $title = $current_settings->title->text->{$lang['id_lang']};
            }

            if (isset($current_settings->message->text->{$lang['id_lang']})) {
                $message = $current_settings->message->text->{$lang['id_lang']};
            }

            $helper->fields_value['title_text'][$lang['id_lang']] = $title;
            $helper->fields_value['message_text'][$lang['id_lang']] = $message;
        }

        return $helper->generateForm($fields_form);
    }

    public function getContent()
    {
        $output = $errors = null;

        if (Tools::isSubmit('submit'.$this->name)) {
            $values = array(
                'delay' => (int)Tools::getValue('delay'),
                'start_date' => Tools::getValue('start_date'),
                'end_date' => Tools::getValue('end_date'),
                'confirmation' => (int)Tools::getValue('confirmation'),
                'width' => (int)Tools::getValue('width'),
                'height' => (int)Tools::getValue('height'),
                'image_enabled' => (int)Tools::getValue('image_enabled'),
                'image_position' => Tools::getValue('image_position'),
                'title' => array(
                    'color' => Tools::getValue('title_color'),
                    'size' => (int)Tools::getValue('title_size'),
                ),
                'message' => array(
                    'color' => Tools::getValue('message_color'),
                    'size' => (int)Tools::getValue('message_size'),
                ),
                'fields' => array(
                    'name' => array(
                        'enabled' => (int)Tools::getValue('name_enabled'),
                        'required' => (int)Tools::getValue('name_required'),
                    ),
                    'gender' => array(
                        'enabled' => (int)Tools::getValue('gender_enabled'),
                    ),
                    'birthdate' => array(
                        'enabled' => (int)Tools::getValue('birthdate_enabled'),
                        'required' => (int)Tools::getValue('birthdate_required'),
                    ),
                ),
            );

            if (!Validate::isInt(Tools::getValue('delay'))) {
                $errors[] = $this->l('Delay must be a number');
            }

            if (!empty(Tools::getValue('start_date')) && !Validate::isDate(Tools::getValue('start_date'))) {
                $errors[] = $this->l('Start date must be a valid date');
            }

            if (!empty(Tools::getValue('end_date')) && !Validate::isDate(Tools::getValue('end_date'))) {
                $errors[] = $this->l('End date must be a valid date');
            }

            if (!Validate::isInt(Tools::getValue('width'))) {
                $errors[] = $this->l('Width must be a number');
            }

            if (!Validate::isInt(Tools::getValue('height'))) {
                $errors[] = $this->l('Height must be a number');
            }

            if (!Validate::isColor(Tools::getValue('title_color'))) {
                $errors[] = $this->l('Title color must be a hexadecimal number');
            }

            if (!Validate::isInt(Tools::getValue('title_size'))) {
                $errors[] = $this->l('Title size must be a number');
            }

            if (!Validate::isColor(Tools::getValue('message_color'))) {
                $errors[] = $this->l('Message color must be a hexadecimal number');
            }

            if (!Validate::isInt(Tools::getValue('message_size'))) {
                $errors[] = $this->l('Message size must be a number');
            }

            if (isset($_FILES['image'])
            && isset($_FILES['image']['tmp_name'])
            && !empty($_FILES['image']['tmp_name'])) {
                if ($error = ImageManager::validateUpload(
                    $_FILES['image'],
                    Tools::convertBytes(ini_get('upload_max_filesize'))
                )) {
                    $errors[] = $error;
                } else {
                    $ext = Tools::strtolower(Tools::substr(
                        $_FILES['image']['name'],
                        strrpos($_FILES['image']['name'], '.') + 1
                    ));

                    if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif'))) {
                        switch ($ext) {
                            case 'png':
                                $src = imagecreatefrompng($_FILES['image']['tmp_name']);
                                $this->convertImage($src, $this->image_save_path);
                                break;

                            case 'gif':
                                $src = imagecreatefromgif($_FILES['image']['tmp_name']);
                                $this->convertImage($src, $this->image_save_path);
                                break;

                            default:
                                if (!move_uploaded_file($_FILES['image']['tmp_name'], $this->image_save_path)) {
                                    $errors[] = $this->l('Image upload error');
                                }

                                break;
                        }
                    } else {
                        $errors[] = $this->l('Wrong image file type');
                    }
                }
            }

            foreach ($this->context->controller->getLanguages() as $lang) {
                $values['title']['text'][(int)$lang['id_lang']] = Tools::getValue('title_text_'.(int)$lang['id_lang']);
                $values['message']['text'][(int)$lang['id_lang']] = Tools::getValue(
                    'message_text_'.(int)$lang['id_lang']
                );
            }

            if (!$errors) {
                $new_settings = Tools::jsonEncode($values);
                Configuration::updateValue('SUR_SETTINGS', $new_settings);
                $output .= $this->displayConfirmation($this->l('Settings updated'));
            } else {
                $output .= $this->displayError(implode(' • ', $errors));
            }
        }

        $this->context->smarty->assign(array(
            'documentation_link' => $this->_path.'readme_en.pdf',
        ));
        $output .= $this->display(__FILE__, 'views/templates/admin/configure.tpl');

        return $output.$this->displayConfigurationForm();
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path.'views/css/signupreminder.css');
        $this->context->controller->addJquery();
        $this->context->controller->addJqueryUI('ui.datepicker');
        $this->context->controller->addJS($this->_path.'views/js/front.js');
    }

    public function hookDisplayFooter()
    {
        $settings = Tools::jsonDecode(Configuration::get('SUR_SETTINGS'));
        $title = isset($settings->title->text->{(int)$this->context->language->id})
            ? $settings->title->text->{(int)$this->context->language->id} : null;
        $message = isset($settings->message->text->{(int)$this->context->language->id})
            ? $settings->message->text->{(int)$this->context->language->id} : null;

        $this->context->smarty->assign(array(
            'width' => $settings->width,
            'height' => $settings->height,
            'image' => $this->image_path,
            'image_enabled' => $settings->image_enabled,
            'image_position' => $settings->image_position,
            'title' => $title,
            'title_color' => $settings->title->color,
            'title_size' => $settings->title->size,
            'message' => $message,
            'message_color' => $settings->message->color,
            'message_size' => $settings->message->size,
            'name_enabled' => $settings->fields->name->enabled,
            'name_required' => $settings->fields->name->required,
            'gender_enabled' => $settings->fields->gender->enabled,
            'birthdate_enabled' => $settings->fields->birthdate->enabled,
            'birthdate_required' => $settings->fields->birthdate->required,
            'delay' => $settings->delay,
            'module_dir' => _MODULE_DIR_,
            'secure_key' => $this->secure_key,
        ));

        if ((empty($settings->start_date) || time() >= strtotime($settings->start_date))
        && (empty($settings->end_date) || time() <= strtotime($settings->end_date))
        && !$this->context->customer->isLogged()) {
            return $this->display(__FILE__, 'display-footer.tpl');
        }
    }

    private function sendConfirmation($email)
    {
        return Mail::Send(
            $this->context->language->id,
            'confirmation',
            Mail::l('Subscription confirmation', $this->context->language->id),
            array(),
            pSQL($email),
            null,
            null,
            null,
            null,
            null,
            dirname(__FILE__).'/mails/',
            false,
            $this->context->shop->id
        );
    }

    public function saveCustomer($data)
    {
        $errors = array();

        if (!Validate::isName($data['firstname'])) {
            $errors[] = 'firstname';
        }

        if (!Validate::isName($data['lastname'])) {
            $errors[] = 'lastname';
        }

        if (!Validate::isBirthDate($data['birthdate'])) {
            $errors[] = 'birthdate';
        }

        if (!Validate::isEmail($data['email'])) {
            $errors[] = 'email';
        }

        if (!empty($errors)) {
            return $errors;
        }

        $db = Db::getInstance();

        $sql = 'SELECT COUNT(*) FROM '._DB_PREFIX_.'customer WHERE email = "'.pSQL($data['email']).'"';
        $duplicates = Db::getInstance()->getValue($sql);

        if ($duplicates == 0) {
            $db->insert('customer', array(
                'id_shop_group' => 1,
                'id_shop' => (int)$this->context->shop->id,
                'id_gender' => (int)$data['gender'],
                'id_default_group' => 1,
                'id_risk' => 0,
                'id_lang' => (int)$this->context->language->id,
                'firstname' => pSQL($data['firstname']),
                'lastname' => pSQL($data['lastname']),
                'email' => pSQL($data['email']),
                'birthday' => pSQL($data['birthdate']),
                'newsletter' => 1,
                'optin' => 0,
                'max_payment_days' => 0,
                'active' => 1,
                'date_add' => date('Y-m-d H:i:s'),
                'date_upd' => date('Y-m-d H:i:s'),
            ));

            $current_settings = Tools::jsonDecode(Configuration::get('SUR_SETTINGS'));

            if ($current_settings->confirmation == 1) {
                $this->sendConfirmation($data['email']);
            }
        }
    }
}
