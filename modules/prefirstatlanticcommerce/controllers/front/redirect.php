<?php
/**
 *  2014-2020 Prestashoppe
 *
 *  @author    Prestashoppe
 *  @copyright 2014-2020 Prestashoppe
 *  @license   Prestashoppe Commercial License
 */

class PreFirstAtlanticCommerceRedirectModuleFrontController extends ModuleFrontController
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

            // make a fac payment
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

            $trancationsDetails = $this->module->getPreFacHostedTransactionDetails($cart);
            $billingDetails = $this->module->getPreFacBillingDetails($cart);
            $shippingDetails = $this->module->getPreFacShippingDetails($cart);
            $responseUrl = $this->context->link->getModuleLink($this->module->name, 'response', array('token' => Tools::getToken(false)));

            $hostedPageRequest = array(
                'Request' => array(
                    'TransactionDetails' => $trancationsDetails,
                    'BillingDetails' => $billingDetails,
                    'ShippingDetails' => $shippingDetails,
                    'CardHolderResponseURL' => $responseUrl,
            ));

            $client = new SoapClient($wsdlurl, $options);
            $result = $client->HostedPageAuthorize($hostedPageRequest);
            if (is_soap_fault($result)) {
                $message = $this->module->l('Unfortunately your order cannot be processed as an error has occured. Please attempt your purchase again.');
                $this->errors[] = $message;
                $this->redirectWithNotifications('index.php?controller=order&step=1');
            } else {
                if (isset($result->HostedPageAuthorizeResult->ResponseCode)) {
                    if ($result->HostedPageAuthorizeResult->ResponseCode == 0) {
                        $token = $result->HostedPageAuthorizeResult->SingleUseToken;
                        if ($this->module->facenablesandbox) {
                            $paymentPageUrl = 'https://ecm.firstatlanticcommerce.com/MerchantPages/'.$this->module->facpaymentpageset.'/'.$this->module->facpaymentpagename.'/'.$token;
                        } else {
                            $paymentPageUrl = 'https://marlin.firstatlanticcommerce.com/MerchantPages/'.$this->module->facpaymentpageset.'/'.$this->module->facpaymentpagename.'/'.$token;
                        }
                        Tools::redirect($paymentPageUrl);
                    } else {
                        $message = $result->HostedPageAuthorizeResul->ResponseCodeDescription;
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
