<?php
/**
 *  2014-2020 Prestashoppe
 *
 *  @author    Prestashoppe
 *  @copyright 2014-2020 Prestashoppe
 *  @license   Prestashoppe Commercial License
 */

class PreFirstAtlanticCommerceResponseModuleFrontController extends ModuleFrontController
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
            parse_str($_SERVER['QUERY_STRING']);

            if ($this->module->facenablesandbox) {
                $wsdlurl = 'https://ecm.firstatlanticcommerce.com/PGService/HostedPage.svc?wsdl';
                $location = 'https://ecm.firstatlanticcommerce.com/PGService/HostedPage.svc';
            } else {
                $wsdlurl = 'https://marlin.firstatlanticcommerce.com/PGService/HostedPage.svc?wsdl';
                $location = 'https://marlin.firstatlanticcommerce.com/PGService/HostedPage.svc';
            }
            $options = array(
                'location' => $location,
                'soap_version' => SOAP_1_1,
                'exceptions' => 0,
                'trace' => 1,
                'cache_wsdl' => WSDL_CACHE_NONE
            );
            $client = new SoapClient($wsdlurl, $options);
            $result = $client->HostedPageResults(array('key' => $ID));
            if (is_soap_fault($result)) {
                $message = $this->module->l('Unfortunately your order cannot be processed as an error has occured. Please attempt your purchase again.');
                $this->errors[] = $message;
                $this->redirectWithNotifications('index.php?controller=order&step=1');
            } else {
                if (isset($result->HostedPageResultsResult->AuthResponse->CreditCardTransactionResults->ResponseCode)) {
                    if ($result->HostedPageResultsResult->AuthResponse->CreditCardTransactionResults->ResponseCode == 1) {
                        $extra_vars = array(
                            'transaction_id' => $result->HostedPageResultsResult->AuthResponse->CreditCardTransactionResults->ReferenceNumber,
                            'card_number' => $result->HostedPageResultsResult->AuthResponse->CreditCardTransactionResults->PaddedCardNumber,
                        );
                        if ($this->module->faccapturepayment) {
                            $this->module->validateOrder($cart->id, Configuration::get('PS_OS_PAYMENT'), $cart->getOrderTotal(true, Cart::BOTH), $this->module->displayName, null, $extra_vars, (int) $currencyObj->id, false, $customer->secure_key);
                        } else {
                            $this->module->validateOrder($cart->id, Configuration::get('PRE_PS_OS_FAC'), $cart->getOrderTotal(true, Cart::BOTH), $this->module->displayName, null, $extra_vars, (int) $currencyObj->id, false, $customer->secure_key);
                        }
                        //Insert data here
                        $paymentData = array(
                            'id_order' => $this->module->currentOrder,
                            'order_number' => $result->HostedPageResultsResult->AuthResponse->OrderNumber,
                            'reference_number' => $result->HostedPageResultsResult->AuthResponse->CreditCardTransactionResults->ReferenceNumber,
                            'padded_card_no' => $result->HostedPageResultsResult->AuthResponse->CreditCardTransactionResults->PaddedCardNumber,
                            'auth_code' => $result->HostedPageResultsResult->AuthResponse->CreditCardTransactionResults->AuthCode,
                            'cavvv_value' => $result->HostedPageResultsResult->ThreeDSResponse->CAVV,
                            'eci_indicator' => $result->HostedPageResultsResult->ThreeDSResponse->ECIIndicator,
                            'transaction_stain' => $result->HostedPageResultsResult->ThreeDSResponse->TransactionStain,
                        );
                        $this->module->setPreFacPaymentData($paymentData);
                        
                        Tools::redirect('index.php?controller=order-confirmation&id_cart=' . (int) $cart->id . '&id_module=' . (int) $this->module->id . '&id_order=' . $this->module->currentOrder . '&key=' . $customer->secure_key);
                    } else {
                        $message = $result->HostedPageResultsResult->AuthResponse->CreditCardTransactionResults->ReasonCodeDescription;
                        $this->errors[] = $message;
                        $this->redirectWithNotifications('index.php?controller=order&step=1');
                    }
                } else {
                    $message = $this->module->l('Unfortunately your order cannot be processed as an error has occured. Please attempt your purchase again.');
                    $this->errors[] = $message;
                    $this->redirectWithNotifications('index.php?controller=order&step=1');
                }
            }
        } else {
            $message = $this->module->l('Token is not valid, hack stop');
            $this->errors[] = $message;
            $this->redirectWithNotifications('index.php?controller=order&step=1');
        }
    }
}
