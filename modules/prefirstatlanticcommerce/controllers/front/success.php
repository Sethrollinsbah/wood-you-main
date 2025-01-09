<?php
/**
 *  2014-2020 Prestashoppe
 *
 *  @author    Prestashoppe
 *  @copyright 2014-2020 Prestashoppe
 *  @license   Prestashoppe Commercial License
 */

class PreFirstAtlanticCommerceSuccessModuleFrontController extends ModuleFrontController
{

    public function __construct()
    {
        parent::__construct();
        $this->context = Context::getContext();
    }

    public function postProcess()
    {
        parent::postProcess();
        if ($this->isTokenValid()) {
            $cart = $this->context->cart;
            $currencyObj = new Currency($cart->id_currency);
            $customer = new Customer($cart->id_customer);
            $paymentdata = Tools::getAllValues();

            if (array_key_exists("ResponseCode", $paymentdata)) {
                $response_code = Tools::getValue('ResponseCode');
                if (!Tools::isEmpty($response_code) && $response_code == 1) {
                    $extra_vars = array(
                        'transaction_id' => Tools::getValue('ReferenceNo'),
                        'card_number' => Tools::getValue('PaddedCardNo'),
                    );
                    if ($this->module->faccapturepayment) {
                        $this->module->validateOrder($cart->id, Configuration::get('PS_OS_PAYMENT'), $cart->getOrderTotal(true, Cart::BOTH), $this->module->displayName, null, $extra_vars, (int) $currencyObj->id, false, $customer->secure_key);
                    } else {
                        $this->module->validateOrder($cart->id, Configuration::get('PRE_PS_OS_FAC'), $cart->getOrderTotal(true, Cart::BOTH), $this->module->displayName, null, $extra_vars, (int) $currencyObj->id, false, $customer->secure_key);
                    }

                    //Insert data here
                    $paymentData = array(
                        'id_order' => $this->module->currentOrder,
                        'order_number' => Tools::getValue('OrderID'),
                        'reference_number' => Tools::getValue('ReferenceNo'),
                        'padded_card_no' => Tools::getValue('PaddedCardNo'),
                        'auth_code' => Tools::getValue('AuthCode'),
                        'cavvv_value' => Tools::getValue('CAVVValue'),
                        'eci_indicator' => Tools::getValue('ECIIndicator'),
                        'transaction_stain' => Tools::getValue('TransactionStain'),
                    );
                    $this->module->setPreFacPaymentData($paymentData);
                    
                    Tools::redirect('index.php?controller=order-confirmation&id_cart=' . (int) $cart->id . '&id_module=' . (int) $this->module->id . '&id_order=' . $this->module->currentOrder . '&key=' . $customer->secure_key);
                } else {
                    $message = Tools::getValue('ReasonCodeDesc');
                    $this->errors[] = $message;
                    $this->redirectWithNotifications('index.php?controller=order&step=1');
                }
            } else {
                $message = $this->module->l('Unfortunately your order cannot be processed as an error has occured. Please attempt your purchase again.');
                $this->errors[] = $message;
                $this->redirectWithNotifications('index.php?controller=order&step=1');
            }
        } else {
            $message = $this->module->l('Token is not valid, hack stop');
            $this->errors[] = $message;
            $this->redirectWithNotifications('index.php?controller=order&step=1');
        }
    }
}
