<?php
/*
* 2007-2012 PrestaShop
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
*  @copyright  2007-2012 PrestaShop SA
*  @version  Release: $Revision: 16066 $
*  @license  http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

include(dirname(__FILE__). '/../../config/config.inc.php');
include(dirname(__FILE__). '/../../init.php');

/* will include backward file */
include(dirname(__FILE__). '/plugnpayapi.php');

$plugnpayapi = new plugnpayAPI();

/* Does the cart exist and is valid? */
$cart = Context::getContext()->cart;

if (!isset($_POST['pnp_orderid'])) {
    Logger::addLog('Missing pnp_orderid', 4);
    die('An unrecoverable error occured: Missing parameter');
}

if (!Validate::isLoadedObject($cart)) {
    Logger::addLog('Cart loading failed for cart '.(int)$_POST['pnp_orderid'], 4);
    die('An unrecoverable error occured with the cart '.(int)$_POST['pnp_orderid']);
}

if ($cart->id != $_POST['pnp_orderid']) {
    Logger::addLog('Conflit between cart id order and customer cart id');
    die('An unrecoverable conflict error occured with the cart '.(int)$_POST['pnp_orderid']);
}

$customer = new Customer((int)$cart->id_customer);
$invoiceAddress = new Address((int)$cart->id_address_invoice);

if (!Validate::isLoadedObject($customer) || !Validate::isLoadedObject($invoiceAddress)) {
    Logger::addLog('Issue loading customer and/or address data');
    die('An unrecoverable error occured while retrieving you data');
}

/* this is a bit of a hack, but it returns a proper US State value */
$card_state = State::getNameById($invoiceAddress->id_state);

$params = array(
    'publisher_name'     => Tools::safeOutput(Configuration::get('PLUGNPAY_API_LOGIN_ID')),
    'publisher_password' => Tools::safeOutput(Configuration::get('PLUGNPAY_API_PASSWD')),
    'client'             => 'PrestaShopAPI',
    'convert'            => 'underscores',
    'authtype'           => 'authpostauth',
    'ipaddress'          => $_SERVER['REMOTE_ADDR'],
    'order_id'           => (int)$_POST['pnp_orderid'],
    'acct_code'          => (int)$_POST['pnp_orderid'],
    'card_amount'        => number_format((float)$cart->getOrderTotal(true, 3), 2, '.', ''),
    'card_name'          => Tools::safeOutput($customer->firstname.' '.$customer->lastname),
    //'card_name'          => 'cardtest',
    'card_company'       => Tools::safeOutput($customer->company),
    'card_address1'      => Tools::safeOutput($invoiceAddress->address1),
    'card_address2'      => Tools::safeOutput($invoiceAddress->address2),
    'card_city'          => Tools::safeOutput($invoiceAddress->city),
    'card_state'         => Tools::safeOutput($card_state),
    'card_zip'           => Tools::safeOutput($invoiceAddress->postcode),
    'card_country'       => Tools::safeOutput($invoiceAddress->country),
    'email'              => Tools::safeOutput($customer->email),
    'phone'              => Tools::safeOutput($invoiceAddress->phone),
    'paymethod'          => 'credit',
    'card_number'        => Tools::safeOutput($_POST['pnp_card_num']),
    'card_exp'           => Tools::safeOutput($_POST['pnp_exp_date_m'].'/'.$_POST['pnp_exp_date_y']),
    'card_cvv'           => Tools::safeOutput($_POST['pnp_card_code']),
);

//var_dump($params); exit;

$postString = '';
foreach ($params as $key => $value) {
    $postString .= $key.'='.urlencode($value).'&';
}
$postString = trim($postString, '&');

$url = 'https://pay1.plugnpay.com/payment/pnpremote.cgi';

/* Do the CURL request to PlugnPay.com */
$request = curl_init();
curl_setopt($request, CURLOPT_URL, $url);
curl_setopt($request, CURLOPT_HEADER, 0);
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($request, CURLOPT_POST, 1);
curl_setopt($request, CURLOPT_POSTFIELDS, $postString);
curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($request, CURLOPT_VERBOSE, 0);
$postResponse = curl_exec($request);
curl_close($request);

# NOTE: windows server users, you must have 'register_globals' ON in your php.ini for parse_str to work correctly.
parse_str($postResponse);

// echo '<pre>';
// var_dump($params);
// var_dump($postResponse); exit;


$response = explode('&', $postResponse);

if (!isset($order_id) || !isset($orderID) || !isset($card_amount)) {
    $msg = 'PlugnPay.com returned a malformed response for cart';
    if (isset($order_id)) {
        $msg .= ' '.(int)$order_id;
    }
    Logger::addLog($msg, 4);
    die("PlugnPay.com returned a malformed response, aborted. '$FinalStatus' '$MErrMsg' '$card_amount' '$orderID' '$order_id'");
}

$message = $MErrMsg;
$payment_method = 'PlugnPay.com API';
$resp = "";
if ($FinalStatus == 'success') {
    $resp = 1;
}
elseif ($FinalStatus == 'badcard') {
    $resp = 2;
}
elseif ($FinalStatus == 'fraud') {
    $resp = 2;
}
elseif ($FinalStatus == 'problem') {
    $resp = 3;
}
else {
    $resp == 3;
}


switch ($resp) { // Response code
    case 1: // Payment accepted
        #die("Success -- $resp '$FinalStatus' '$MErrMsg' '$card_amount' '$orderID' '$order_id'");
        $plugnpayapi->setTransactionDetail($response);
        $plugnpayapi->validateOrder((int)$cart->id, Configuration::get('PS_OS_PAYMENT'), (float)$card_amount,
            $payment_method, $message, NULL, NULL, false, $customer->secure_key);
        break ;

    case 3: // Hold for review
        #die("Problem -- $resp '$FinalStatus' '$MErrMsg' '$card_amount' '$orderID' '$order_id'");
       $plugnpayapi->validateOrder((int)$cart->id,
           Configuration::get('PLUGNPAY_API_HOLD_REVIEW_OS'), (float)$card_amount,
           $plugnpayapi->displayName, $MErrMsg, NULL, NULL, false, $customer->secure_key);
       break ;
        // $error_message = (isset($MErrMsg) && !empty($MErrMsg)) ? urlencode(Tools::safeOutput($MErrMsg)) : '';

        // $checkout_type = Configuration::get('PS_ORDER_PROCESS_TYPE') ?  'order-opc' : 'order';
        // $url = _PS_VERSION_ >= '1.5' ?  'index.php?controller='.$checkout_type.'&' : $checkout_type.'.php?';
        // $url .= 'step=3&cgv=1&aimerror=1&message='.$error_message;

        // if (!isset($_SERVER['HTTP_REFERER']) || strstr($_SERVER['HTTP_REFERER'], 'order')) {
        //     Tools::redirect($url);
        // }
        // else if (strstr($_SERVER['HTTP_REFERER'], '?')) {
        //     Tools::redirect($_SERVER['HTTP_REFERER'].'&aimerror=1&message='.$error_message, '');
        // }
        // else {
        //     Tools::redirect($_SERVER['HTTP_REFERER'].'?aimerror=1&message='.$error_message, '');
        // }
        exit;

    default:
        #die("Badcard -- $resp '$FinalStatus' '$MErrMsg' '$card_amount' '$orderID' '$order_id'");
        $error_message = (isset($MErrMsg) && !empty($MErrMsg)) ? urlencode(Tools::safeOutput($MErrMsg)) : '';

        $checkout_type = Configuration::get('PS_ORDER_PROCESS_TYPE') ?  'order-opc' : 'order';
        $url = _PS_VERSION_ >= '1.5' ?  'index.php?controller='.$checkout_type.'&' : $checkout_type.'.php?';
        $url .= 'step=3&cgv=1&aimerror=1&message='.$error_message;

        if (!isset($_SERVER['HTTP_REFERER']) || strstr($_SERVER['HTTP_REFERER'], 'order')) {
            Tools::redirect($url);
        }
        else if (strstr($_SERVER['HTTP_REFERER'], '?')) {
            Tools::redirect($_SERVER['HTTP_REFERER'].'&aimerror=1&message='.$error_message, '');
        }
        else {
            Tools::redirect($_SERVER['HTTP_REFERER'].'?aimerror=1&message='.$error_message, '');
        }
        exit;
}

$url = 'index.php?controller=order-confirmation&';
if (_PS_VERSION_ < '1.5') {
    $url = 'order-confirmation.php?';
}

Tools::redirect($url.'id_module='.(int)$plugnpayapi->id.'&id_cart='.(int)$cart->id.'&key='.$customer->secure_key);
