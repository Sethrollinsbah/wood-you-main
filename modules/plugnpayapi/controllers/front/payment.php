<?php



class plugnpayAPIPaymentModuleFrontController extends ModuleFrontController
{
    public $ssl = true;
    public $display_column_left = false;
    private $codigoAprobacion = "approved";

    public function initContent()
    {
        $this->display_column_left = false;//para que no se muestre la columna de la izquierda
        $this->db = Db::getInstance();
        parent::initContent();//llama al init() de FrontController, que es la clase padre
        $cart = $this->context->cart;
        $template = 'payment';
        if($cart->id == null && Tools::getValue('order') != null)
        {
            $order = new Order((int)Tools::getValue('order'));
            $cart = new Cart((int)$order->id_cart);
        }

        $total = $cart->getOrderTotal(true, Cart::BOTH);
        $cliente = new Customer($cart->id_customer);//recupera al objeto cliente
        $paso = (int) Tools::getValue('paso');

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
  
  
  
        $this->context->smarty->assign('pnp_orderid', $this->context->cart->id);
  
        $this->context->smarty->assign('cards', $cards);
        $this->context->smarty->assign('module_dir' , __PS_BASE_URI__.'modules/plugnpayapi/');

        $this->context->smarty->assign('isFailed', $isFailed);
  
        $this->context->smarty->assign('new_base_dir', $url);
  
        //return $this->display(__FILE__, 'plugnpayapi.tpl');
        $this->setTemplate('module:plugnpayapi/plugnpayapi.tpl');

        //$this->setTemplate('plugnpayapi.tpl');
    }
    
    protected function ExecutePayment($optionsData, $req_params_data, $connector, $cliente, $cart)
    {   

        try {

            $response = $connector->payment()->ExecutePayment($optionsData);

            $this->_saveToken($connector, $response, $cliente, $req_params_data, $optionsData);

            $now = new DateTime();
            $now->format('Y-m-d H:i:s');

            $responsetoJson = array();
            $responsetoJson['id'] = $response->getId();
            $responsetoJson['site_transaction_id'] = $response->getSiteTransactionId();
            $responsetoJson['amount'] = $response->getAmount();
            $responsetoJson['payment_type'] = $response->getPaymentType();
            $responsetoJson['status'] = $response->getStatus();
            $responsetoJson['bin'] = $response->getBin();

            $this->_tranUpdate($cart->id, array("user_id" => $cliente->id, "decidir_order_id" => $response->getSiteTransactionId(), "payment_response" => json_encode($responsetoJson), "marca" => $optionsData['payment_method_id'], "banco" => $req_params_data['entity'], "cuotas" => $optionsData['installments'], "date" => $now->format('Y-m-d H:i:s')));

            $this->module->log->info('Response: '.json_encode($responsetoJson));

            return $response;

        }catch(\Exception $e) {
            $response = $connector->payment()->ExecutePayment($optionsData);

            $this->module->log->info('Error en el pago: '.json_encode($e->getMessage()));

            if (version_compare(_PS_VERSION_, '1.7.0.0') >= 0){
                Tools::redirect($this->context->link->getModuleLink('decidir', 'errorpage', array('response'=> $response->getStatus(), 'responsea'=> $response->getStatusDetails())));
            }else{
                Tools::redirect($this->context->link->getModuleLink('decidir', 'errorpage', array('response'=> $response->getStatus(), 'responsea'=> $response->getStatusDetails()), true));
            }
        }
    }

    public function validatePayment($response)
    {   
        if($response->getStatus() == $this->codigoAprobacion){

            $param = array();
            $param['amount'] = $response->getAmount();
            $param['status'] = $response->getStatus();

            $this->module->log->info('Redireccionando al controller de validacion del pago');
            Tools::redirect($this->context->link->getModuleLink(strtolower($this->module->name), 'validation', $param, false));//redirijo al 
        }else{

            $responsetoJson = array();
            $responsetoJson['id'] = $response->getId();
            $responsetoJson['site_transaction_id'] = $response->getSiteTransactionId();
            $responsetoJson['status'] = $response->getStatus();
            $responsetoJson['statusdetails'] = $response->getStatusDetails();

            $this->module->log->info('Error en el pago:'.json_encode($responsetoJson));
//var_dump($response);
// exit;
            Tools::redirect($this->context->link->getModuleLink('decidir', 'errorpage', array('response'=> $response->getStatus(), 'responsea'=> $response->getStatusDetails())));
        }
    }

    protected function prepare_connector($prefijo)
    {   
        $keys_data = array('public_key' => Configuration::get($prefijo.'_ID_KEY_PUBLIC'), 
                           'private_key' => Configuration::get($prefijo.'_ID_KEY_PRIVATE'));

        $connector = new \Decidir\Connector($keys_data, $this->module->getEnvironment());

        return $connector;
    }
    
    protected function prepareOrder($cart, $client)
    {  
        $data = array("user_id" => $client->id, "order_id" => $cart->id);

        if($this->tranEstado == 0){ 
            $this->_tranCrear($cart->id, $data);
        }
    }
    
    public function getPaydata($cart, $prefijo, $cliente, $params_data)
    {  
        $payment = new MediosCore();
        $pMethod = $payment->getById($params_data['pmethod']);

        $currency = new CurrencyCore($cart->id_currency);
        $currency_code = $currency->iso_code;

        $InstallmentInfo = explode("_",$params_data['installment']);

        if (intval($params_data['intallmenttype'])) {
            $instancePromos = new PromocionesCore();
            $promoCardData = $instancePromos->getById($InstallmentInfo[0]);            

            if(intval($promoCardData[0]["send_installment"]) <= 0){
                $installments = intval($InstallmentInfo[1]);
            }else{
                $installments = intval($promoCardData[0]["send_installment"]);
            }

        }else{
            $installments = intval($InstallmentInfo[1]);
        }

        $params = array( "site_transaction_id" => "dec_".time().$cart->id.rand(1,900),
                        "token" => $params_data['token'],
                        "customer" => array(
                                        "id" => strval($this->context->customer->id),
                                        "email" => strval($this->context->customer->email),
                                        "ip_address" => Tools::getRemoteAddr(),
                                    ),
                        "payment_method_id" => intval($pMethod[0]['id_decidir']),
                        "amount" => $cart->getOrderTotal(true),
                        "bin" => $params_data['bin'],
                        "currency" => $currency_code,
                        "installments" => $installments,
                        "description" => (string)$cart->id,
                        "establishment_name" => Configuration::get('PS_SHOP_NAME'),
                        "payment_type" => "single",
                        "sub_payments" => array(),
                        "fraud_detection" => array()
                    );

        return $params;
    }
    
    private function _paymentStep($cart, $prefijo, $cliente, $connector, $req_params_data)
    {
        $this->prepareOrder($cart, $cliente);

        //informacion de pago
        $optionsData = $this->getPaydata($cart, $prefijo, $cliente, $req_params_data);

        //calcula costo financiero
        $optionsData = $this->_calcFinancialCost($optionsData, $cart, $req_params_data);

        $this->module->log->info('payment params - '.json_encode($optionsData));

        //Cybersource
        if(Configuration::get('DECIDIR_CONTROLFRAUDE_ENABLE_CS'))
        {
            $segmento = $this->module->getSegmentoTienda(true);

            $dataCSVertical = DecControlFraudeFactory::get_controlfraude_extractor($segmento, $cliente, $cart, $optionsData['amount'])->getCSVertical();

            if($segmento == DecControlFraudeFactory::TRAVEL){
                $dataPassengers = DecControlFraudeFactory::get_controlfraude_extractor($segmento, $cliente, $cart, $optionsData['amount'])->getPassengers();
            }else{
                $dataProducst = DecControlFraudeFactory::get_controlfraude_extractor($segmento, $cliente, $cart, $optionsData['amount'])->getProducts();
            }

            switch ($segmento)
            {
                case DecControlFraudeFactory::RETAIL:
                    $cs = new \Decidir\Cybersource\Retail($dataCSVertical, $dataProducst);
                    
                    break;
                case DecControlFraudeFactory::DIGITAL_GOODS:
                    $cs = new \Decidir\Cybersource\DigitalGoods($dataCSVertical, $dataProducst);

                    break;
                case DecControlFraudeFactory::TICKETING:
                    $cs = new \Decidir\Cybersource\Ticketing($dataCSVertical, $dataProducst);

                    break;
                case DecControlFraudeFactory::SERVICE:
                    $cs = new \Decidir\Cybersource\Service($dataCSVertical, $dataProducst);

                    break;
                case DecControlFraudeFactory::TRAVEL:
                    $cs = new \Decidir\Cybersource\Travel($dataCSVertical, $dataPassengers);

                    break;
                default:
                    $cs = new \Decidir\Cybersource\Retail($dataCSVertical, $dataProducst);

                    break;
                
            }

            $this->module->log->info('params Cybersource - '.json_encode($cs->getData()));

            $connector->payment()->setCybersource($cs->getData());
        }
        
        $rta = $this->ExecutePayment($optionsData, $req_params_data, $connector, $cliente, $cart);

        $this->validatePayment($rta);
    }
    
    private function _tranEstado($cartId)
    {   
        $res = $this->db->executeS("SELECT * FROM "._DB_PREFIX_."decidir_transacciones WHERE order_id=".$cartId);

        if(!$res) {
            return 0;
        } else {

            if($res[0]['payment_response'] == "") {
                return 1;
            }else{
                return 2; 
            } 
        }
    }
    

    private function _tranCrear($cartId, $data)
    {   
        $this->db->insert("decidir_transacciones", $data);
        $this->tranEstado = $this->_tranEstado($cartId);
    }
    
    private function _tranUpdate($cartId, $data)
    {   
        $this->db->update("decidir_transacciones", $data, "order_id = ".$cartId, 0, true);
        $this->tranEstado = $this->_tranEstado($cartId);
    }

    public function healthCheckService($connector)
    {
        $response = $connector->healthcheck()->getStatus();

        if(empty($response->getName())){
            return false;
        }

        return true;
    }

    public function getTokenList($connector, $user_id)
    {
        try {
            $response = $connector->cardToken()->tokensList(array(), $user_id);

        }catch(\Exception $e) {
            $this->module->log->info('Error al obtener el listado de tarjetas tokenizadas - '.json_encode($e->getMessage()));
            Tools::redirect($this->context->link->getModuleLink('decidir','errorpage',array(),true)); 
        }

        return $response->getTokens();
    }

    private function _tokensUpdate($data)
    {   
        $sql = 'UPDATE '._DB_PREFIX_.'decidir_tokens SET token="'.$data['token'].'", bin='.$data['bin'].', last_four_digits='.$data['last_four_digits'].', expiration_month='.$data['expiration_month'].', expiration_year="'.$data['expiration_year'].'" WHERE id="'.$data['id'].'"';

        if(!Db::getInstance()->execute($sql)){
            die('Error al actualizar el token de tarjeta.');        
        }
    }

    private function _tokensCreate($data)
    {   
        $this->db->insert("decidir_tokens", $data);
    }

    private function _saveToken($connector, $response, $cliente, $req_params_data, $optionsData){

        $tokens = array();
        $instPMethod = new MediosCore();

        $tokensListById = $instPMethod->getTokenByUserId($optionsData['customer']['id'], $response->getBin(), $response->getPaymentMethodId());

        $tokenList = $this->getTokenList($connector, $optionsData['customer']['id']);

        //search or insert new token
        foreach($tokenList as $index => $value){
            $tokensListById = $instPMethod->getTokenByUserId($optionsData['customer']['id'], $value['bin'], $value['payment_method_id']);

            $data = array();

            if(empty($tokensListById)){
                $data['user_id'] = strval($optionsData['customer']['id']);
                $data['name'] = $value['card_holder']['name'];
                $data['banco_id'] = $req_params_data['pmethod'];
                $data['marca_id'] =  $req_params_data['entity'];
                $data['token'] = $value['token'];
                $data['payment_method_id'] = $value['payment_method_id'];
                $data['bin'] = $value['bin'];
                $data['last_four_digits'] = $value['last_four_digits'];
                $data['expiration_month'] = $value['expiration_month'];
                $data['expiration_year'] = $value['expiration_year'];

                $this->_tokensCreate($data);
            }else{
                $data['id'] = $tokensListById[0]['id'];
                $data['token'] = $value['token'];
                $data['bin'] = $value['bin'];
                $data['last_four_digits'] = $value['last_four_digits'];
                $data['expiration_month'] = $value['expiration_month'];
                $data['expiration_year'] = $value['expiration_year'];

                $this->_tokensUpdate($data);
            }

        }    
    }

    private function _calcFinancialCost($optionsData, $cart, $req_params_data)
    {
        $installmentArray = explode("_", $req_params_data['installment']);

        $data = array();
        $data['id_interes'] = $installmentArray[0];
        $data['installment'] = $installmentArray[1];
        $data['payment_method'] = $optionsData['payment_method_id'];
        $data['active'] = 1;

        if($req_params_data['intallmenttype']){
            //$instancePromos = new AdminPromocionesController();
            
            $instancePromos = new PromocionesCore();
            

            $res = $instancePromos->getById($installmentArray[0]);
            $data['coeficient'] = $res[0]['coeficient'];
            $data['discount'] = $res[0]['discount'];

        }else{
            $instanceInteres = new AdminInteresController();
            $res = $instanceInteres->getById($installmentArray[0]);
            $data['coeficient'] = $res[0]['coeficient'];
            $data['discount'] = 0;
        }
        $calcRta = $this->module->calcFinancialCost($data,$optionsData['amount']);

        $optionsData['amount'] = round($calcRta['totalCost'],2,PHP_ROUND_HALF_DOWN);

        return $optionsData;
    }
    
    private function _refundExecute($data, $prefijo, $connector)
    {   
        $sql = 'SELECT payment_response FROM '._DB_PREFIX_.'decidir_transacciones WHERE decidir_order_id="'.$data['orderOperation'].'"';
        $res = $this->db->executeS($sql);

        $instanceRefund = new Refunds();
        $orderResponse = json_decode($res[0]['payment_response'], TRUE);

        if($data['type'])//type 1 = total refund
        {   
            $response = $instanceRefund->totalRefund($orderResponse['id'], $orderResponse['amount'], $data, $connector);
        }else{
            $response = $instanceRefund->partialRefund($orderResponse['id'], $data, $connector);
        }
        
        echo $response;  
    } 

}
