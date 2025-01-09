<?php
/**
 *  2014-2020 Prestashoppe
 *
 *  @author    Prestashoppe
 *  @copyright 2014-2020 Prestashoppe
 *  @license   Prestashoppe Commercial License
 */

use PrestaShop\PrestaShop\Core\Payment\PaymentOption;

if (!defined('_PS_VERSION_')) {
    exit;
}

class PreFirstAtlanticCommerce extends PaymentModule
{

    protected $output = '';
    protected $errors = array();

    public function __construct()
    {
        $this->name = 'prefirstatlanticcommerce';
        $this->tab = 'payments_gateways';
        $this->version = '1.1.0';
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        $this->author = 'Prestashoppe';
        $this->bootstrap = true;
        $this->module_key = 'de0f530ab7b22f38b9ffe7a20913e187';
        $this->author_address = '0xf92EE7dd42aA7035bbF12fe660dE675897A83726';
        parent::__construct();
        $this->languages = Language::getLanguages(false);
        $this->displayName = $this->l('First Atlantic Commerce');
        $this->description = $this->l('This module allows any merchant to accept payments with first atlantic commerce.');
        $this->facenablesandbox = Configuration::get('PRE_FAC_SANDBOX_MODE');
        $this->facmerchantid = Configuration::get('PRE_FAC_MERCHANT_ID');
        $this->facmerchantpassword = Configuration::get('PRE_FAC_MERCHANT_PASSWORD');
        $this->facpaymenttype = Configuration::get('PRE_FAC_PAYMENT_TYPE');
        $this->facpaymentpageset = Configuration::get('PRE_FAC_PAYMENT_PAGE_SET');
        $this->facpaymentpagename = Configuration::get('PRE_FAC_PAYMENT_PAGE_NAME');
        $this->faccapturepayment = Configuration::get('PRE_FAC_CAPTURE_PAYMENT');
        $this->fac3dsecurepayment = Configuration::get('PRE_FAC_3D_SECURE_PAYMENT');
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        
        require_once(_PS_MODULE_DIR_ . 'prefirstatlanticcommerce/sql/install.php');
        return parent::install() &&
            $this->registerHook('actionFrontControllerSetMedia') &&
            $this->registerHook('paymentOptions') &&
            $this->registerHook('displayPaymentReturn') &&
            $this->registerHook('displayAdminOrderLeft') &&
            $this->registerHook('displayOrderDetail') &&
            $this->installPreFacSettings() &&
            $this->addPreFacOrderState();
    }

    protected function installPreFacSettings()
    {
        Configuration::updateValue('PRE_FAC_SANDBOX_MODE', 0);
        Configuration::updateValue('PRE_FAC_MERCHANT_ID', '');
        Configuration::updateValue('PRE_FAC_MERCHANT_PASSWORD', '');
        Configuration::updateValue('PRE_FAC_PAYMENT_TYPE', 'hosted');
        Configuration::updateValue('PRE_FAC_PAYMENT_PAGE_SET', '');
        Configuration::updateValue('PRE_FAC_PAYMENT_PAGE_NAME', '');
        Configuration::updateValue('PRE_FAC_CAPTURE_PAYMENT', 1);
        Configuration::updateValue('PRE_FAC_3D_SECURE_PAYMENT', 1);
        return true;
    }

    protected function addPreFacOrderState()
    {
        if (!Configuration::get('PRE_PS_OS_FAC')) {
            $orderStateObj = new OrderState();
            $orderStateObj->send_email = 0;
            $orderStateObj->module_name = $this->name;
            $orderStateObj->invoice = 0;
            $orderStateObj->color = '#4169E1';
            $orderStateObj->logable = 1;
            $orderStateObj->shipped = 0;
            $orderStateObj->unremovable = 1;
            $orderStateObj->delivery = 0;
            $orderStateObj->hidden = 0;
            $orderStateObj->paid = 0;
            $orderStateObj->pdf_delivery = 0;
            $orderStateObj->pdf_invoice = 0;
            $orderStateObj->deleted = 0;
            foreach ($this->languages as $language) {
                $orderStateObj->name[$language['id_lang']] = 'Awaiting first atlantic payment';
            }
            if ($orderStateObj->add()) {
                Configuration::updateValue('PRE_PS_OS_FAC', (int) $orderStateObj->id);
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    public function uninstall()
    {
        return parent::uninstall() &&
            $this->unregisterHook('actionFrontControllerSetMedia') &&
            $this->unregisterHook('paymentOptions') &&
            $this->unregisterHook('displayPaymentReturn') &&
            $this->unregisterHook('displayAdminOrderLeft') &&
            $this->unregisterHook('displayOrderDetail') &&
            $this->uninstallPreFacSettings();
    }

    protected function uninstallPreFacSettings()
    {
        Configuration::deleteByName('PRE_FAC_SANDBOX_MODE');
        Configuration::deleteByName('PRE_FAC_MERCHANT_ID');
        Configuration::deleteByName('PRE_FAC_MERCHANT_PASSWORD');
        Configuration::deleteByName('PRE_FAC_PAYMENT_TYPE');
        Configuration::deleteByName('PRE_FAC_PAYMENT_PAGE_SET');
        Configuration::deleteByName('PRE_FAC_PAYMENT_PAGE_NAME');
        Configuration::deleteByName('PRE_FAC_CAPTURE_PAYMENT');
        Configuration::deleteByName('PRE_FAC_3D_SECURE_PAYMENT');
        return true;
    }

    public function getContent()
    {
        if (((bool) Tools::isSubmit('submitPreFacForm')) == true) {
            $this->preFacFormPostValidation();
            if (!count($this->errors)) {
                $this->preFacFormPostProcess();
            } else {
                foreach ($this->errors as $err) {
                    $this->output .= $this->displayError($err);
                }
            }
        }
        if (!extension_loaded('soap')) {
            return $this->displayError($this->l('Please enable php soap extension for wroking this module.'));
        } else {
            $this->output .= $this->display(__FILE__, 'views/templates/admin/info.tpl');
            return $this->output . $this->renderPreFacForm();
        }
    }

    protected function renderPreFacForm()
    {
        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->default_form_language = (int) Configuration::get('PS_LANG_DEFAULT');
        $helper->module = $this;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitPreFacForm';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'uri' => $this->getPathUri(),
            'fields_value' => $this->getPreFacFormValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );
        return $helper->generateForm(array($this->getPreFacForm()));
    }

    protected function getPreFacForm()
    {
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('General Settings'),
                    'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Enable Sandbox Mode'),
                        'name' => 'PRE_FAC_SANDBOX_MODE',
                        'is_bool' => true,
                        'desc' => $this->l('If you choose YES then enable sandbox or test mode for first atlantic commerce payment.'),
                        'values' => array(
                            array(
                                'id' => 'PRE_FAC_SANDBOX_MODE_ON',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'PRE_FAC_SANDBOX_MODE_OFF',
                                'value' => 0,
                                'label' => $this->l('No')
                            ),
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Merchant Id'),
                        'name' => 'PRE_FAC_MERCHANT_ID',
                        'required' => true,
                        'desc' => $this->l('Enter a merchant id which is provided by first atlantic commerce.'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Merchant Password'),
                        'name' => 'PRE_FAC_MERCHANT_PASSWORD',
                        'required' => true,
                        'desc' => $this->l('Enter a merchant transaction processing password which is provided by first atlantic commerce.'),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Payment Type'),
                        'name' => 'PRE_FAC_PAYMENT_TYPE',
                        'required' => true,
                        'desc' => $this->l('If you choose Hosted Payment then customer redirect on first atlantic commerce hosted page. If you choose Direct Payment then customer pay on site with enter card details.'),
                        'options' => array(
                            'query' => array(
                                array('id' => 'hosted', 'name' => $this->l('Hosted Payment')),
                                array('id' => 'direct', 'name' => $this->l('Direct Payment')),
                            ),
                            'id' => 'id',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Page Set'),
                        'name' => 'PRE_FAC_PAYMENT_PAGE_SET',
                        'required' => true,
                        'desc' => $this->l('Enter a hosted page set value which is provided by first atlantic commerce. Required if payment type is Hosted Payment '),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Name'),
                        'name' => 'PRE_FAC_PAYMENT_PAGE_NAME',
                        'required' => true,
                        'desc' => $this->l('Enter a hosted name value which is provided by first atlantic commerce. Required if payment type is Hosted Payment '),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Capture Payment'),
                        'name' => 'PRE_FAC_CAPTURE_PAYMENT',
                        'is_bool' => true,
                        'desc' => $this->l('If you choose YES then immediately capture the charge.If you choose NO then charge issues an authorization and will need to be captured later.Uncaptured charges expire in 7 days.'),
                        'values' => array(
                            array(
                                'id' => 'PRE_FAC_CAPTURE_PAYMENT_ON',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'PRE_FAC_CAPTURE_PAYMENT_OFF',
                                'value' => 0,
                                'label' => $this->l('No')
                            ),
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('3D Secure Payment'),
                        'name' => 'PRE_FAC_3D_SECURE_PAYMENT',
                        'is_bool' => true,
                        'desc' => $this->l('If you choose YES then payment transaction made with 3D secure mode.'),
                        'values' => array(
                            array(
                                'id' => 'PRE_FAC_3D_SECURE_PAYMENT_ON',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'PPRE_FAC_3D_SECURE_PAYMENT_OFF',
                                'value' => 0,
                                'label' => $this->l('No')
                            ),
                        ),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
        return $fields_form;
    }

    protected function getPreFacFormValues()
    {
        return array(
            'PRE_FAC_SANDBOX_MODE' => Tools::getValue('PRE_FAC_SANDBOX_MODE', Configuration::get('PRE_FAC_SANDBOX_MODE')),
            'PRE_FAC_MERCHANT_ID' => Tools::getValue('PRE_FAC_MERCHANT_ID', Configuration::get('PRE_FAC_MERCHANT_ID')),
            'PRE_FAC_MERCHANT_PASSWORD' => Tools::getValue('PRE_FAC_MERCHANT_PASSWORD', Configuration::get('PRE_FAC_MERCHANT_PASSWORD')),
            'PRE_FAC_PAYMENT_TYPE' => Tools::getValue('PRE_FAC_PAYMENT_TYPE', Configuration::get('PRE_FAC_PAYMENT_TYPE')),
            'PRE_FAC_PAYMENT_PAGE_SET' => Tools::getValue('PRE_FAC_PAYMENT_PAGE_SET', Configuration::get('PRE_FAC_PAYMENT_PAGE_SET')),
            'PRE_FAC_PAYMENT_PAGE_NAME' => Tools::getValue('PRE_FAC_PAYMENT_PAGE_NAME', Configuration::get('PRE_FAC_PAYMENT_PAGE_NAME')),
            'PRE_FAC_CAPTURE_PAYMENT' => Tools::getValue('PRE_FAC_CAPTURE_PAYMENT', Configuration::get('PRE_FAC_CAPTURE_PAYMENT')),
            'PRE_FAC_3D_SECURE_PAYMENT' => Tools::getValue('PRE_FAC_3D_SECURE_PAYMENT', Configuration::get('PRE_FAC_3D_SECURE_PAYMENT')),
            'PRE_FAC_SEND_EMAIL' => Tools::getValue('PRE_FAC_SEND_EMAIL', Configuration::get('PRE_FAC_SEND_EMAIL')),
        );
    }

    protected function preFacFormPostValidation()
    {
        $prefacmerchantid = Tools::getValue('PRE_FAC_MERCHANT_ID');
        $prefacmerchantpassword = Tools::getValue('PRE_FAC_MERCHANT_PASSWORD');
        $prefacpaymenttype = Tools::getValue('PRE_FAC_PAYMENT_TYPE');
        $prefacpaymentpageset = Tools::getValue('PRE_FAC_PAYMENT_PAGE_SET');
        $prefacpaymentpagename = Tools::getValue('PRE_FAC_PAYMENT_PAGE_NAME');

        if (Tools::isEmpty($prefacmerchantid)) {
            $this->errors[] = $this->l('Merchant id is required.');
        }
        if (Tools::isEmpty($prefacmerchantpassword)) {
            $this->errors[] = $this->l('Merchant password is required.');
        }

        if ($prefacpaymenttype == 'hosted') {
            if (Tools::isEmpty($prefacpaymentpageset)) {
                $this->errors[] = $this->l('Page set value is required.');
            }
            if (Tools::isEmpty($prefacpaymentpagename)) {
                $this->errors[] = $this->l('Page name value is required.');
            }
        }
    }

    protected function preFacFormPostProcess()
    {
        $form_values = $this->getPreFacFormValues();
        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
        $this->output .= $this->displayConfirmation($this->l('General settings are updated.'));
    }

    public function hookPaymentOptions($params)
    {
        if (!$this->active) {
            return;
        }

        if (Tools::isEmpty($this->facmerchantid) || Tools::isEmpty($this->facmerchantpassword)) {
            return;
        }

        if($this->facpaymenttype == 'hosted') {
            if (Tools::isEmpty($this->facpaymentpageset) || Tools::isEmpty($this->facpaymentpagename)) {
                return;
            }
        }

        $payment_options = [
            $this->getFacPaymentOption(),
        ];

        return $payment_options;
    }

    protected function getFacPaymentOption()
    {
        $preFacOption = new PaymentOption();
        if($this->facpaymenttype == 'hosted') {
            $preFacOption->setCallToActionText($this->l('Pay by FAC'))
                ->setAction($this->context->link->getModuleLink($this->name, 'redirect', array(), true))
                ->setInputs(['token' => ['name' => 'token', 'type' => 'hidden', 'value' => Tools::getToken(false)]])
                ->setLogo(Media::getMediaPath(_PS_MODULE_DIR_ . 'prefirstatlanticcommerce/views/img/fac.png'))
                ->setAdditionalInformation($this->context->smarty->fetch('module:prefirstatlanticcommerce/views/templates/hook/facpaymentinfo.tpl'));
        } else {
            $preFacOption->setCallToActionText($this->l('Pay by FAC'))
                ->setLogo(Media::getMediaPath(_PS_MODULE_DIR_ . 'prefirstatlanticcommerce/views/img/fac.png'))
                ->setForm($this->generateFacPaymentForm());
        }

        return $preFacOption;
    }

    protected function generateFacPaymentForm()
    {
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = sprintf("%02d", $i);
        }

        $years = [];
        for ($i = 0; $i <= 10; $i++) {
            $halfyear = date('y', strtotime('+' . $i . ' years'));
            $fullyear = date('Y', strtotime('+' . $i . ' years'));
            $years[$halfyear] = $fullyear;
        }

        $this->context->smarty->assign([
            'action_url' => $this->context->link->getModuleLink($this->name, 'payment', array(), true),
            'months' => $months,
            'years' => $years,
            'token' => Tools::getToken(false)
        ]);

        return $this->context->smarty->fetch('module:prefirstatlanticcommerce/views/templates/hook/facpaymentform.tpl');
    }
    
    public function hookActionFrontControllerSetMedia($params)
    {
        $this->context->controller->registerStylesheet('pre-fac-style', 'modules/prefirstatlanticcommerce/views/css/prefirstatlanticcommerce.css', ['media' => 'all', 'priority' => 200,]);
        $this->context->controller->registerJavascript('pre-fac-payment', 'modules/prefirstatlanticcommerce/views/js/prefirstatlanticcommerce-payment.js', ['priority' => 200, 'attribute' => 'async',]);
        $this->context->controller->registerJavascript('pre-fac-script', 'modules/prefirstatlanticcommerce/views/js/prefirstatlanticcommerce.js', ['priority' => 200, 'attribute' => 'async',]);
    }

    public function getPreFacCardDetails($cardNumber, $cardExpiryDate, $cardCVV2)
    {
        $cardNumber = str_replace([' ', '-'], '', $cardNumber);
        $cardExpiryDate = $cardExpiryDate;
        $cardCVV2 = $cardCVV2;

        $cardData = array(
            'CardNumber' => $cardNumber,
            'CardExpiryDate' => $cardExpiryDate,
            'CardCVV2' => $cardCVV2,
            'IssueNumber' => '',
            'StartDate' => '',
        );
        return $cardData;
    }

    public function getPreFacHostedTransactionDetails($cart)
    {
        $acquirer_id = '464748';
        $merchant_id = $this->facmerchantid;
        $merchant_password = $this->facmerchantpassword;
        $order_number = $cart->id . (string) round(microtime(1) * 1000);
        $amount = $this->getFacFormatCartAmount($cart->getOrderTotal(TRUE, Cart::BOTH));
        $currencyObj = new Currency($cart->id_currency);
        if (Tools::version_compare(_PS_VERSION_, '1.7.6.0', '>=')) {
            $currency = ($currencyObj->numeric_iso_code) ? $currencyObj->numeric_iso_code : $currencyObj->iso_code_num;
            $currency_exponent = $currencyObj->precision;
        } else {
            $currency = ($currencyObj->iso_code_num) ? $currencyObj->iso_code_num : $currencyObj->iso_code_num;
            $currency_exponent = Configuration::get('PS_PRICE_DISPLAY_PRECISION');
        }
        $signature = $this->getFacSignature($merchant_password, $merchant_id, $acquirer_id, $order_number, $amount, $currency);

        if ($this->faccapturepayment) {
            $transaction_code = 8;
        } else {
            $transaction_code = 0;
        }
        if($this->fac3dsecurepayment && $this->facpaymenttype == 'hosted') {
            $transaction_code = $transaction_code + 256;
        }
        $trancationsData = array(
            'AcquirerId' => $acquirer_id,
            'Amount' => $amount,
            'Currency' => $currency,
            'CurrencyExponent' => $currency_exponent,
            'IPAddress' => Tools::getRemoteAddr(),
            'MerchantId' => $merchant_id,
            'OrderNumber' => $order_number,
            'Signature' => $signature,
            'SignatureMethod' => 'SHA1',
            'TransactionCode' => $transaction_code
        );
        return $trancationsData;
    }
    
    public function getPreFacDirectTransactionDetails($cart)
    {
        $acquirer_id = '464748';
        $merchant_id = $this->facmerchantid;
        $merchant_password = $this->facmerchantpassword;
        $order_number = $cart->id . (string) round(microtime(1) * 1000);
        $amount = $this->getFacFormatCartAmount($cart->getOrderTotal(TRUE, Cart::BOTH));
        $currencyObj = new Currency($cart->id_currency);
        if (Tools::version_compare(_PS_VERSION_, '1.7.6.0', '>=')) {
            $currency = ($currencyObj->numeric_iso_code) ? $currencyObj->numeric_iso_code : $currencyObj->iso_code_num;
            $currency_exponent = $currencyObj->precision;
        } else {
            $currency = ($currencyObj->iso_code_num) ? $currencyObj->iso_code_num : $currencyObj->iso_code_num;
            $currency_exponent = Configuration::get('PS_PRICE_DISPLAY_PRECISION');
        }
        $signature = $this->getFacSignature($merchant_password, $merchant_id, $acquirer_id, $order_number, $amount, $currency);

        if ($this->faccapturepayment) {
            $transaction_code = 8;
        } else {
            $transaction_code = 0;
        }
        if($this->fac3dsecurepayment && $this->facpaymenttype == 'direct') {
            //$transaction_code = $transaction_code + 64;
        }
        $trancationsData = array(
            'AcquirerId' => $acquirer_id,
            'Amount' => $amount,
            'Currency' => $currency,
            'CurrencyExponent' => $currency_exponent,
            'IPAddress' => Tools::getRemoteAddr(),
            'MerchantId' => $merchant_id,
            'OrderNumber' => $order_number,
            'Signature' => $signature,
            'SignatureMethod' => 'SHA1',
            'TransactionCode' => $transaction_code
        );
        return $trancationsData;
    }

    public function getFacFormatCartAmount($amount)
    {
        $amount = $amount * 100;
        $amount = str_pad($amount, 12, '0', STR_PAD_LEFT);
        return $amount;
    }

    public function getFacSignature($merchant_password, $merchant_id, $acquirer_id, $order_number, $amount, $currency)
    {
        $stringtohash = $merchant_password . $merchant_id . $acquirer_id . $order_number . $amount . $currency;
        $hash = sha1($stringtohash, true);
        $signature = base64_encode($hash);
        return $signature;
    }

    public function getPreFacBillingDetails($cart)
    {
        $customer = new Customer($cart->id_customer);
        $invoiceAddress = new Address($cart->id_address_invoice);
        $state = new State($invoiceAddress->id_state);
        $country = new Country($invoiceAddress->id_country);
        if ($country->iso_code == 'US') {
            $state_name = $state->iso_code;
        } else {
            $state_name = "";
        }
        $billingData = array(
            'BillToAddress' => $invoiceAddress->address1,
            'BillToAddress2' => $invoiceAddress->address2,
            'BillToAddress2' => $invoiceAddress->address2,
            'BillToZipPostCode' => $invoiceAddress->postcode,
            'BillToFirstName' => $invoiceAddress->firstname,
            'BillToLastName' => $invoiceAddress->lastname,
            'BillToCity' => $invoiceAddress->city,
            'BillToState' => $state_name,
            'BillToCounty' => $invoiceAddress->country,
            'BillToEmail' => $customer->email,
            'BillToTelephone' => $invoiceAddress->phone,
            'BillToMobile' => $invoiceAddress->phone_mobile,
        );
        return $billingData;
    }

    public function getPreFacShippingDetails($cart)
    {
        $customer = new Customer($cart->id_customer);
        $deliveryAddress = new Address($cart->id_address_delivery);
        $state = new State($deliveryAddress->id_state);
        $country = new Country($deliveryAddress->id_country);
        if ($country->iso_code == 'US') {
            $state_name = $state->iso_code;
        } else {
            $state_name = "";
        }
        $shippingData = array(
            'ShipToAddress' => $deliveryAddress->address1,
            'ShipToAddress2' => $deliveryAddress->address2,
            'ShipToAddress2' => $deliveryAddress->address2,
            'ShipToZipPostCode' => $deliveryAddress->postcode,
            'ShipToFirstName' => $deliveryAddress->firstname,
            'ShipToLastName' => $deliveryAddress->lastname,
            'ShipToCity' => $deliveryAddress->city,
            'ShipToState' => $state_name,
            'ShipToCounty' => $deliveryAddress->country,
            'ShipToEmail' => $customer->email,
            'ShipToTelephone' => $deliveryAddress->phone,
            'ShipToMobile' => $deliveryAddress->phone_mobile,
        );
        return $shippingData;
    }
    
    public function getPreFraudDetailsDetails($cart)
    {
        $fraudData = array(
            'AuthResponseCode' => '',
            'AVSResponseCode' => '',
            'CVVResponseCode' => '',
            'SessionId' => $this->context->cookie->session_id,
        );
        return $fraudData;
    }

    public function setPreFacPaymentData($paymentData)
    {
        $result = $this->getPreFacPaymentData($paymentData['id_order']);
        if ($result) {
            $data = array(
                'id_order' => pSQL($paymentData['id_order']),
                'order_number' => pSQL($paymentData['order_number']),
                'reference_number' => pSQL($paymentData['reference_number']),
                'padded_card_no' => pSQL($paymentData['padded_card_no']),
                'auth_code' => pSQL($paymentData['auth_code']),
                'cavvv_value' => pSQL($paymentData['cavvv_value']),
                'eci_indicator' => pSQL($paymentData['eci_indicator']),
                'transaction_stain' => pSQL($paymentData['transaction_stain']),
            );
            Db::getInstance()->update('prefac_order', $data, 'id_order = ' . (int) $id_order);
        } else {
            $data = array(
                'id_order' => pSQL($paymentData['id_order']),
                'order_number' => pSQL($paymentData['order_number']),
                'reference_number' => pSQL($paymentData['reference_number']),
                'padded_card_no' => pSQL($paymentData['padded_card_no']),
                'auth_code' => pSQL($paymentData['auth_code']),
                'cavvv_value' => pSQL($paymentData['cavvv_value']),
                'eci_indicator' => pSQL($paymentData['eci_indicator']),
                'transaction_stain' => pSQL($paymentData['transaction_stain']),
            );
            Db::getInstance()->insert('prefac_order', $data);
        }
    }

    public function getPreFacPaymentData($id_order)
    {
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'prefac_order WHERE id_order = ' . (int) $id_order;
        $result = Db::getInstance()->getRow($sql);
        return $result;
    }
    
    public function hookDisplayPaymentReturn($params)
    {
        $id_order = $params['order']->id;
        $prefacpaymentdata = $this->getPreFacPaymentData($id_order);
        if ($prefacpaymentdata) {
            $this->context->smarty->assign(array(
                'prefacpaymentdata' => $prefacpaymentdata,
            ));
            return $this->context->smarty->fetch('module:prefirstatlanticcommerce/views/templates/hook/displayPaymentReturn.tpl');
        }
    }
    
    public function hookDisplayOrderDetail($params)
    {
        $id_order = $params['order']->id;
        $prefacpaymentdata = $this->getPreFacPaymentData($id_order);
        if ($prefacpaymentdata) {
            $this->context->smarty->assign(array(
                'prefacpaymentdata' => $prefacpaymentdata,
            ));
            return $this->context->smarty->fetch('module:prefirstatlanticcommerce/views/templates/hook/displayOrderDetail.tpl');
        }
    }
}
