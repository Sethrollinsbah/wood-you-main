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

*  @version  Release: $Revision: 16684 $

*  @license  http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)

*  International Registered Trademark & Property of PrestaShop SA

*/



if (!defined('_PS_VERSION_')) {

  exit;

}

use PrestaShop\PrestaShop\Core\Payment\PaymentOption;

class plugnpayAPI extends PaymentModule {

  public function __construct() {

    $this->name = 'plugnpayapi';

    $this->tab = 'payments_gateways';

    $this->version = '1.6.2';

    $this->author = 'PlugnPay Technologies';

    $this->need_instance = 0;

    /* $this->ps_versions_compliancy = array('min' => '1.4', 'max' => _PS_VERSION_); */



    parent::__construct();



    $this->displayName = 'PlugnPay.com API';

    $this->description = $this->l('Receive payment with PlugnPay.com');



    /* For 1.4.3 and less compatibility */

    $updateConfig = array(

      'PS_OS_CHEQUE' => 1,

      'PS_OS_PAYMENT' => 2,

      'PS_OS_PREPARATION' => 3,

      'PS_OS_SHIPPING' => 4,

      'PS_OS_DELIVERED' => 5,

      'PS_OS_CANCELED' => 6,

      'PS_OS_REFUND' => 7,

      'PS_OS_ERROR' => 8,

      'PS_OS_OUTOFSTOCK' => 9,

      'PS_OS_BANKWIRE' => 10,

      'PS_OS_PAYPAL' => 11,

      'PS_OS_WS_PAYMENT' => 12);



    foreach ($updateConfig as $u => $v) {

      if (!Configuration::get($u) || (int)Configuration::get($u) < 1) {

        if (defined('_'.$u.'_') && (int)constant('_'.$u.'_') > 0) {

          Configuration::updateValue($u, constant('_'.$u.'_'));

        }

        else {

          Configuration::updateValue($u, $v);

        }

      }

    }



    /* Check if cURL is enabled */

    if (!is_callable('curl_exec')) {

      $this->warning = $this->l('cURL extension must be enabled on your server to use this module.');

    }

    /* Backward compatibility */

  //  require(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/backward.php');

  }



  public function install() {

    return parent::install() &&

      $this->registerHook('orderConfirmation') &&

      $this->registerHook('payment') &&

      $this->registerHook('header') &&

      Configuration::updateValue('PLUGNPAY_API_HOLD_REVIEW_OS', _PS_OS_ERROR_);

  }



  public function uninstall() {

    Configuration::deleteByName('PLUGNPAY_API_LOGIN_ID');

    Configuration::deleteByName('PLUGNPAY_API_PASSWD');

    Configuration::deleteByName('PLUGNPAY_API_CARD_VISA');

    Configuration::deleteByName('PLUGNPAY_API_CARD_MASTERCARD');

    Configuration::deleteByName('PLUGNPAY_API_CARD_DISCOVER');

    Configuration::deleteByName('PLUGNPAY_API_CARD_AX');

    Configuration::deleteByName('PLUGNPAY_API_HOLD_REVIEW_OS');

    return parent::uninstall();

  }



  public function hookOrderConfirmation($params) {

    if ($params['order']->module != $this->name) {

      return;

    }

    if ($params['order']->getCurrentState() != Configuration::get('PS_OS_ERROR')) {

      $this->context->smarty->assign(array('status' => 'ok', 'shop_name' => Configuration::get('PS_SHOP_NAME'), 'id_order' => intval($params['order']->id)));

    }

    else {

      $this->context->smarty->assign('status', 'failed');

    }

    return $this->display(__FILE__, 'hookorderconfirmation.tpl');

  }



  public function getContent() {

    $html = '';

    if (Tools::isSubmit('submitModule')) {

      Configuration::updateValue('PLUGNPAY_API_LOGIN_ID', Tools::getvalue('plugnpayapi_login_id'));

      Configuration::updateValue('PLUGNPAY_API_PASSWD', Tools::getvalue('plugnpayapi_passwd'));

      Configuration::updateValue('PLUGNPAY_API_CARD_VISA', Tools::getvalue('plugnpayapi_card_visa'));

      Configuration::updateValue('PLUGNPAY_API_CARD_MASTERCARD', Tools::getvalue('plugnpayapi_card_mastercard'));

      Configuration::updateValue('PLUGNPAY_API_CARD_DISCOVER', Tools::getvalue('plugnpayapi_card_discover'));

      Configuration::updateValue('PLUGNPAY_API_CARD_AX', Tools::getvalue('plugnpayapi_card_ax'));

      Configuration::updateValue('PLUGNPAY_API_HOLD_REVIEW_OS', Tools::getvalue('plugnpayapi_hold_review_os'));

      $html .= $this->displayConfirmation($this->l('Configuration updated'));

    }



    // For Hold for Review

    $orderStates = OrderState::getOrderStates((int)$this->context->cookie->id_lang);



    $html .= '<h2>'.$this->displayName.'</h2>

    <fieldset><legend><img src="../modules/'.$this->name.'/logo.png" alt="" /> '.$this->l('Help').'</legend>

      <a href="https://www.plugnpay.com/" target="_blank" style="float: right;"><img src="../modules/'.$this->name.'/logo_plugnpay.png" alt="" /></a>

      <h3>'.$this->l('In your PrestaShop admin panel').'</h3>

      - '.$this->l('Fill the  Username provided by PlugnPay.com').'<br />

      - '.$this->l('Fill the Password field with the Remote Client Password provided by PlugnPay.com').'<br />

      <span style="color: red;" >- '.$this->l('Warning: Your website must possess a SSL certificate to use the PlugnPay.com API payment system. You are responsible for the safety of your customers\' bank information. PrestaShop cannot be blamed for any security issue on your website.').'</span><br />

      <br />

    </fieldset><br />

    <form action="'.Tools::htmlentitiesutf8($_SERVER['REQUEST_URI']).'" method="post">

      <fieldset class="width2">

        <legend><img src="../img/admin/contact.gif" alt="" />'.$this->l('Settings').'</legend>

        <label for="plugnpayapi_login_id">'.$this->l('Username').'</label>

        <div class="margin-form"><input type="text" size="20" id="plugnpayapi_login_id" name="plugnpayapi_login_id" value="'.Tools::safeOutput(Configuration::get('PLUGNPAY_API_LOGIN_ID')).'" /></div>

        <label for="plugnpayapi_passwd">'.$this->l('Password').'</label>

        <div class="margin-form"><input type="text" size="20" id="plugnpayapi_login_id" name="plugnpayapi_passwd" value="'.Tools::safeOutput(Configuration::get('PLUGNPAY_API_PASSWD')).'" /></div>

        <label for="plugnpayapi_cards">'.$this->l('Cards:').'</label>

        <div class="margin-form" id="plugnpayapi_cards">

          <input type="checkbox" name="plugnpayapi_card_visa" '.(Configuration::get('PLUGNPAY_API_CARD_VISA') ? 'checked="checked"' : '').' />

            <img src="../modules/'.$this->name.'/cards/visa.png" alt="visa" />

          <p><input type="checkbox" name="plugnpayapi_card_mastercard" '.(Configuration::get('PLUGNPAY_API_CARD_MASTERCARD') ? 'checked="checked"' : '').' />

            <img src="../modules/'.$this->name.'/cards/mastercard.png" alt="mastercard" />

          <p><input type="checkbox" name="plugnpayapi_card_discover" '.(Configuration::get('PLUGNPAY_API_CARD_DISCOVER') ? 'checked="checked"' : '').' />

            <img src="../modules/'.$this->name.'/cards/discover.png" alt="discover" />

          <p><input type="checkbox" name="plugnpayapi_card_ax" '.(Configuration::get('PLUGNPAY_API_CARD_AX') ? 'checked="checked"' : '').' />

            <img src="../modules/'.$this->name.'/cards/ax.png" alt="amex" />

        </div>



        <label for="plugnpayapi_hold_review_os">'.$this->l('Order status:  "Hold for Review" ').'</label>

        <div class="margin-form">

          <select id="plugnpayapi_hold_review_os" name="plugnpayapi_hold_review_os">';

    // Hold for Review order state selection

    foreach ($orderStates as $os)

      $html .= '<option value="'.(int)$os['id_order_state'].'"'.((int)$os['id_order_state'] == (int)Configuration::get('PLUGNPAY_API_HOLD_REVIEW_OS') ? ' selected' : '').'>'.

      Tools::stripslashes($os['name']).

      '</option>'."\n";

    return $html.'</select></div>

        <br /><center><input type="submit" name="submitModule" value="'.$this->l('Update settings').'" class="button" /></center>

      </fieldset>

    </form>';

  }

  public function hookPaymentOptions($params)
	{

       /* if (!$this->checkCurrency($params['cart'])) {
            return;
        }*/

        $cart = $this->context->cart;

        $newOption = new PrestaShop\PrestaShop\Core\Payment\PaymentOption();

        $ModuleName = 'plugnpayapi';//nombre que se muestra al momento de elegir los metodos de pago

        $urlForm = $this->context->link->getModuleLink('plugnpayapi', 'payment', array('paso' => '1'), true);
        $isFailed = Tools::getValue('aimerror');



        $cards = array();
  
        $cards['visa'] = Configuration::get('PLUGNPAY_API_CARD_VISA') == 'on';
  
        $cards['mastercard'] = Configuration::get('PLUGNPAY_API_CARD_MASTERCARD') == 'on';
  
        $cards['discover'] = Configuration::get('PLUGNPAY_API_CARD_DISCOVER') == 'on';
  
        $cards['ax'] = Configuration::get('PLUGNPAY_API_CARD_AX') == 'on';
  
  
  
        if (method_exists('Tools', 'getShopDomainSsl')) {
  
          $url = 'https://'.Tools::getShopDomainSsl().__PS_BASE_URI__.'/modules/'.$this->name.'/';
  
        }
  
        else {
  
          $url = 'https://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/'.$this->name.'/';
  
        }
        
  
        $this->context->smarty->assign('pnp_orderid', (int)$params['cart']->id);
  
        $this->context->smarty->assign('cards', $cards);
  
        $this->context->smarty->assign('isFailed', $isFailed);
  
        $this->context->smarty->assign('new_base_dir', $url);
        $urlForm = $this->context->link->getModuleLink('plugnpayapi', 'payment', array('paso' => '1'), true);

        $newOption->setCallToActionText($ModuleName)
                    ->setAction($urlForm )
					->setInputs([])
					->setLogo(Media::getMediaPath(_PS_MODULE_DIR_.$this->name.'/logo.png'))
           ->setAdditionalInformation($this->context->smarty->fetch('module:plugnpayapi/views/templates/hook/payment_option.tpl'));
        
  
        $payment_options = [
        	$newOption
        ];

        return $payment_options;
	}

  public function hookPayment($params) {

    $currency = Currency::getCurrencyInstance($this->context->cookie->id_currency);

    if (!Validate::isLoadedObject($currency) || $currency->iso_code != 'USD') {

      return false;

    }



    if (Configuration::get('PS_SSL_ENABLED') || (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off')) {

      $isFailed = Tools::getValue('aimerror');



      $cards = array();

      $cards['visa'] = Configuration::get('PLUGNPAY_API_CARD_VISA') == 'on';

      $cards['mastercard'] = Configuration::get('PLUGNPAY_API_CARD_MASTERCARD') == 'on';

      $cards['discover'] = Configuration::get('PLUGNPAY_API_CARD_DISCOVER') == 'on';

      $cards['ax'] = Configuration::get('PLUGNPAY_API_CARD_AX') == 'on';



      if (method_exists('Tools', 'getShopDomainSsl')) {

        $url = 'https://'.Tools::getShopDomainSsl().__PS_BASE_URI__.'/modules/plugnpayapi/';

      }

      else {

        $url = 'https://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/plugnpayapi/';

      }



      $this->context->smarty->assign('pnp_orderid', (int)$params['cart']->id);

      $this->context->smarty->assign('cards', $cards);
      $this->context->smarty->assign('cards', $cards);

      $this->context->smarty->assign('isFailed', $isFailed);
      $this->context->smarty->assign('publisherpassword', 'a4MQPYV3LS6qzstV');

      
      $this->context->smarty->assign('new_base_dir', $url);

      return $this->display(__FILE__, 'plugnpayapi.tpl');

    }

  }


  public function hookdisplayPaymentReturnPage($params)
  {


      return Tools::redirect('index.php?fc=module&module=plugnpayapi&controller=paymentconfirm&order='.$params['cart']->id);
  }
  public function hookDisplayPaymentReturn($params)
  {
      return $this->hookdisplayPaymentReturnPage($params);
  }
  // public function hookPaymentOptions($params)
  // {

  //   //return false;

  //     $cart = $this->context->cart;

  //     $newOption = new PrestaShop\PrestaShop\Core\Payment\PaymentOption();

  //     $ModuleName = 'plugnpayapi'; // nombre que se muestra al momento de elegir los metodos de pago

  //     $urlForm = $this->context->link->getModuleLink('plugnpayapi', 'payment', ['paso' => '1'], true);

  //     $newOption->setCallToActionText('PlugnPay')
  //                 ->setAction($urlForm)
  //                 ->setInputs([])
  //                 ->setLogo(Media::getMediaPath(_PS_MODULE_DIR_.$this->name.'/views/img/logo2.jpg'))
  //                 ->setAdditionalInformation($this->context->smarty->fetch('module:plugnpayapi/payment_option.tpl'));

  //     $payment_options = [
  //         $newOption,
  //     ];

  //     return $payment_options;
  // }

  public function hookHeader() {

    if (_PS_VERSION_ < '1.5') {

      Tools::addJS(_PS_JS_DIR_.'jquery/jquery.validate.creditcard2-1.0.1.js');

    }

    else {

      $this->context->controller->addJqueryPlugin('validate-creditcard');

    }

  }



  /**

   * Set the detail of a payment - Call before the validate order init

   * correctly the pcc object

   * See PlugnPay documentation to know the associated key => value

   * @param array fields

   */

  public function setTransactionDetail($response) {

    // If Exist we can store the details

    if (isset($this->pcc)) {

      $this->pcc->transaction_id = (string)$response[6];



      // 50 => Card number (XXXX0000)

      $this->pcc->card_number = (string)substr($response[50], -4);



      // 51 => Card Mark (Visa, Master card)

      $this->pcc->card_brand = (string)$response[51];



      $this->pcc->card_expiration = (string)Tools::getValue('pnp_exp_date');



      // 68 => Owner name

      $this->pcc->card_holder = (string)$response[68];

    }

  }

}

