<?php
/**
 *  2014-2020 Prestashoppe
 *
 *  @author    Prestashoppe
 *  @copyright 2014-2020 Prestashoppe
 *  @license   Prestashoppe Commercial License
 */

class PreFirstAtlanticCommercePaymentModuleFrontController extends ModuleFrontController
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

            if ($cart->id_customer == 0 || $cart->id_address_delivery == 0 || $cart->id_address_invoice == 0 || !$this->module->active) {
                Tools::redirect('index.php?controller=order&step=1');
            }

            $authorized = false;
            foreach (Module::getPaymentModules() as $module) {
                if ($module['name'] == 'prefirstatlanticcommerce') {
                    $authorized = true;
                    break;
                }
            }
            if (!$authorized) {
                $message = $this->module->l('This payment method is not available.');
                $this->errors[] = $message;
                $this->redirectWithNotifications('index.php?controller=order&step=1');
            }

            $customer = new Customer($cart->id_customer);
            if (!Validate::isLoadedObject($customer)) {
                $message = $this->module->l('Customer is not valid.');
                $this->errors[] = $message;
                $this->redirectWithNotifications('index.php?controller=order&step=1');
            }

            //card validations here
            $faccardnumber = Tools::getValue('fac-card-number');
            $faccardcvc = Tools::getValue('fac-card-cvc');
            $cardexpirydate = Tools::getValue('fac-card-expiry-month') . Tools::getValue('fac-card-expiry-year');

            if (Tools::isEmpty($faccardnumber) || Tools::isEmpty($faccardcvc)) {
                if (Tools::isEmpty($faccardnumber)) {
                    $this->errors[] = $this->module->l('Enter you card number.');
                }
                if (Tools::isEmpty($faccardcvc)) {
                    $this->errors[] = $this->module->l('Enter you card cvc.');
                }
                $this->redirectWithNotifications('index.php?controller=order&step=1');
            }

            // make a fac payment
            if ($this->module->facenablesandbox) {
                $wsdlurl = 'https://ecm.firstatlanticcommerce.com/PGService/Services.svc?wsdl';
                $location = 'https://ecm.firstatlanticcommerce.com/PGService/Services.svc';
            } else {
                $wsdlurl = 'https://marlin.firstatlanticcommerce.com/PGService/Services.svc?wsdl';
                $location = 'https://marlin.firstatlanticcommerce.com/PGService/Services.svc';
            }

            $options = array(
                'location' => $location,
                'soap_version' => SOAP_1_1,
                'exceptions' => 0,
                'trace' => 1,
                'cache_wsdl' => WSDL_CACHE_NONE
            );

            $cardDetails = $this->module->getPreFacCardDetails($faccardnumber, $cardexpirydate, $faccardcvc);
            $trancationsDetails = $this->module->getPreFacDirectTransactionDetails($cart);
            $billingDetails = $this->module->getPreFacBillingDetails($cart);
            $shippingDetails = $this->module->getPreFacShippingDetails($cart);
            $fraudDetails = $this->module->getPreFraudDetailsDetails($cart);
            $responseUrl = $this->context->link->getModuleLink($this->module->name, 'success', array('token' => Tools::getToken(false)));

            if ($this->module->fac3dsecurepayment) {
                $authorizeRequest = array(
                    'Request' => array(
                        'CardDetails' => $cardDetails,
                        'TransactionDetails' => $trancationsDetails,
                        'BillingDetails' => $billingDetails,
                        'MerchantResponseURL' => $responseUrl,
                ));
                $client = new SoapClient($wsdlurl, $options);
                $result = $client->Authorize3DS($authorizeRequest);
                if (is_soap_fault($result)) {
                    $message = $this->module->l('Unfortunately your order cannot be processed as an error has occured. Please attempt your purchase again.');
                    $this->errors[] = $message;
                    $this->redirectWithNotifications('index.php?controller=order&step=1');
                } else {
                    if (isset($result->Authorize3DSResult->ResponseCode)) {
                        if ($result->Authorize3DSResult->ResponseCode == 0) {
                            echo $result->Authorize3DSResult->HTMLFormData;
                        } else {
                            $message = $result->Authorize3DSResult->ResponseCodeDescription;
                            $this->errors[] = $message;
                            $this->redirectWithNotifications('index.php?controller=order&step=1');
                        }
                    }
                }
            } else {
                $authorizeRequest = array(
                    'Request' => array(
                        'CardDetails' => $cardDetails,
                        'TransactionDetails' => $trancationsDetails,
                        'BillingDetails' => $billingDetails,
                        'ShippingDetails' => $shippingDetails,
                ));
                $client = new SoapClient($wsdlurl, $options);
                $result = $client->Authorize($authorizeRequest);
                if (is_soap_fault($result)) {
                    $message = $this->module->l('Unfortunately your order cannot be processed as an error has occured. Please attempt your purchase again.');
                    $this->errors[] = $message;
                    $this->redirectWithNotifications('index.php?controller=order&step=1');
                } else {
                    if (isset($result->AuthorizeResult->CreditCardTransactionResults->ResponseCode)) {
                        if ($result->AuthorizeResult->CreditCardTransactionResults->ResponseCode == 1) {
                            $extra_vars = array(
                                'transaction_id' => $result->AuthorizeResult->CreditCardTransactionResults->ReferenceNumber,
                                'card_number' => $result->AuthorizeResult->CreditCardTransactionResults->PaddedCardNumber,
                            );
                            if ($this->module->faccapturepayment) {
                                $this->module->validateOrder($cart->id, Configuration::get('PS_OS_PAYMENT'), $cart->getOrderTotal(true, Cart::BOTH), $this->module->displayName, null, $extra_vars, (int) $currencyObj->id, false, $customer->secure_key);
                            } else {
                                $this->module->validateOrder($cart->id, Configuration::get('PRE_PS_OS_FAC'), $cart->getOrderTotal(true, Cart::BOTH), $this->module->displayName, null, $extra_vars, (int) $currencyObj->id, false, $customer->secure_key);
                            }
                            //Insert data here
                            $paymentData = array(
                                'id_order' => $this->module->currentOrder,
                                'order_number' => $result->AuthorizeResult->OrderNumber,
                                'reference_number' => $result->AuthorizeResult->CreditCardTransactionResults->ReferenceNumber,
                                'padded_card_no' => $result->AuthorizeResult->CreditCardTransactionResults->PaddedCardNumber,
                                'auth_code' => $result->AuthorizeResult->CreditCardTransactionResults->AuthCode,
                                'cavvv_value' => '',
                                'eci_indicator' => '',
                                'transaction_stain' => '',
                            );
                            $this->module->setPreFacPaymentData($paymentData);

                            Tools::redirect('index.php?controller=order-confirmation&id_cart=' . (int) $cart->id . '&id_module=' . (int) $this->module->id . '&id_order=' . $this->module->currentOrder . '&key=' . $customer->secure_key);
                        } else {
                            $message = $result->AuthorizeResult->CreditCardTransactionResults->ReasonCodeDescription;
                            $this->errors[] = $message;
                            $this->redirectWithNotifications('index.php?controller=order&step=1');
                        }
                    } else {
                        $message = $this->module->l('Unfortunately your order cannot be processed as an error has occured. Please attempt your purchase again.');
                        $this->errors[] = $message;
                        $this->redirectWithNotifications('index.php?controller=order&step=1');
                    }
                }
            }
        } else {
            $message = $this->module->l('Token is not valid, hack stop');
            $this->errors[] = $message;
            $this->redirectWithNotifications('index.php?controller=order&step=1');
        }
    }
}
