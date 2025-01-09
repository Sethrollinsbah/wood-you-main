<?php
require_once (dirname(__FILE__) . '../../../../../config/config.inc.php');

Class DecidirPaymentformModuleFrontController extends ModuleFrontController
{

	public function init()
	{
	    $this->page_name = 'Payment'; // page_name and body id
	    $this->display_column_left = false;
		$this->display_column_right = false;
	    parent::init();
	}

	public function initContent()
	{	
		global $smarty;
		
	    parent::initContent();

	    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
		    // SSL connection
		}

	    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    	$domainName = $_SERVER['HTTP_HOST'];

        $sql = 'SELECT id_entidad AS id, name FROM ' . _DB_PREFIX_ . 'entidades WHERE active=1';
        $ent = Db::getInstance()->ExecuteS($sql);
		$smarty->assign(array(
			'jsLinkForm' => $this->getJsForm(),
			'endpoint' => $this->getEndpoint(),
			'ent' => $ent,
			'module_dir' => __PS_BASE_URI__.'modules/decidir/',
			'publicKey' => $this->getPublicKey(),
			'email' => $this->getMail(),
            'ctfr'=> (boolean)Configuration::get($this->getPrefijo('CONFIG_CONTROLFRAUDE').'_STATUS'),
			'id_user' => $this->getUserId(),
			'name' => $this->getCompleteName(),
			'orderId' => "",
			'total' => $this->getTotal(),
			'currency' => $this->getCurrency(),
			'pmethod' => $this->getPaymentMethod(),
			'url_base' => $protocol.$domainName.__PS_BASE_URI__
		));

        if (version_compare(_PS_VERSION_, '1.7.0.0') >= 0 ) {
            $this->setTemplate('module:decidir/views/templates/front/formblock17.tpl');
        } else {
            $this->setTemplate('formblock16.tpl');
        }
    }
	public function getPrefijo($nombre)
	{
		$prefijo = 'DECIDIR';
		$variables = parse_ini_file('config.ini');
		
		if ( strcasecmp($nombre, 'PREFIJO_CONFIG') == 0)
			return $prefijo;
		
		foreach($variables as $key => $value){
			if ( strcasecmp($key, $nombre) == 0 )
				return $prefijo.'_'.$value;
		}
		return '';
	}
	public function getPublicKey()
	{	
		$prefijo = $this->module->getPrefijoModo();
		return (string) Configuration::get($prefijo.'_ID_KEY_PUBLIC');
	}
	
	public function getTotal(){
		$cart = $this->context->cart;
		$total = $cart->getOrderTotal(true, Cart::BOTH);

		return $total; 
	}

	public function getMail()
	{
		return $this->context->customer->email;
	}

	public function getUserId(){
		return $this->context->customer->id;
	}

	public function getCompleteName()
	{
		$completeName = $this->context->customer->firstname." ";
		$completeName .= $this->context->customer->lastname;

		return $completeName;
	}

	public function getPaymentMethod()
	{	
		$paymethod = Tools::getValue('method');
			
		return $paymethod;

	}

	public function getCurrency()
	{
		global $cookie;
		
		$currency = new CurrencyCore($cookie->id_currency);
		$currency_code = $currency->iso_code;

		return $currency_code;
	}

	public function getJsForm()
	{	
		//return "https://live.decidir.com/static/v2.5/decidir.js";
	}

	public function getEndpoint()
	{	
		$endpoint = "https://developers.decidir.com/api/v2";		

		if($this->module->getModo()){
			$endpoint = "https://live.decidir.com/api/v2";
		}

		return (string)$endpoint;
	}
}
