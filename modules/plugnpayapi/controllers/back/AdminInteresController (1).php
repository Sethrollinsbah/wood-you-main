<?php
require_once (dirname(__FILE__) . '/../../../../config/config.inc.php');
include_once(dirname(__FILE__) .'/../../classes/Medios.php');

class AdminInteresController extends AdminController
{   
    public $modulesParams = "&configure=decidir&tab_module=payments_gateways&module_name=decidir";

    public $urlAddBank = "";

    public $name = "";

    public $sectionTitle = "INTERES";

    public function __construct()
    {
        //parent::__construct();
         if($_GET['controller'] == 'AdminModules' && $_GET['configure'] == 'decidir'){
            parent::__construct();
        }
    }    

    public function renderListInteres($idPaymentMethod){

        $list = $this->getAllInteres($idPaymentMethod);

        $this->fields_list = array(
            'id_interes' => array(
                'title' => $this->l('Id'),
                'width' => 140,
                'type' => 'text',
                'align' => 'center',
            ),
            'installment' => array(
                'title' => $this->l('Installments'),
                'width' => 140,
                'type' => 'text',
                'align' => 'center',
            ),
            'payment_method' => array(
                'title' => $this->l('Payment method'),
                'width' => 140,
                'type' => 'text',
                'align' => 'center',
            ),    
            'coeficient' => array(
                'title' => $this->l('Coefficient'),
                'width' => 140,
                'type' => 'text',
                'align' => 'center',
            ),
            'active' => array(
                'title' => $this->l('Enabled'),
                'align' => 'center',
                'active' => 'status',
                'type' => 'bool',
                'orderby' => false,
                'class' => 'fixed-width-sm'
            )
        );

        $this->_defaultOrderWay = 'ASC';

        $helper = new HelperList();
         
        $helper->shopLinkType = '';
         
        $helper->simple_header = true;
         
        // Actions to be displayed in the "Actions" column
        $helper->actions = array('edit', 'delete');
         
        $helper->identifier = 'id_interes';

        //arreglar esto!!!!!!
        $urlAddInteres = AdminController::$currentIndex.'&configure=decidir&section=7&add_interes&token='.Tools::getAdminTokenLite('AdminModules').$this->modulesParams; 


        $helper->title = 'Interes';

        $helper->table =  ((isset($this->name))? $this->name : "").'_interes';
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure=decidir&section=7';

        return $helper->generateList($list, $this->fields_list);
    }
   

    public function renderSelect(){  
        $intancePayment = new MediosCore();
        $CreditCardList = $intancePayment->getAllPMethods();
        $selectFieldOptions = "";

        if(!empty($CreditCardList)){
            foreach($CreditCardList as $index => $value){
                $selectFieldOptions .="<option value='".$value['id']."'>".$value['name']."</option>";
            }    
        }

        //render select of payment methods
        $selectField = "<div id='pmethod_select_interes'>"
                            ."<span>Seleccionar Tarjeta:</span>"
                            ."<select name='vertical' class='fixed-width-xl' id='interest_pmethod_field'>"
                            .$selectFieldOptions
                            ."</select>"
                       ."</div>";

        return $selectField;
    } 

    public function getAllInteres($idPaymentMethod){
        $sql = 'SELECT interes.id_interes, interes.installment,  medio.name AS payment_method, interes.coeficient, interes.active 
        FROM ' . _DB_PREFIX_ . 'interes AS interes 
        INNER JOIN ' . _DB_PREFIX_ . 'medios AS medio ON interes.payment_method = medio.id_decidir 
        WHERE interes.payment_method ='.pSQL($idPaymentMethod).' ORDER BY interes.installment';          

        $result = Db::getInstance()->ExecuteS($sql);

        return $result;     
    }

    public function getById($idInteres){
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'interes WHERE id_interes='.pSQL($idInteres);
        $result = Db::getInstance()->ExecuteS($sql);
        
        return $result;     
    }
    
    public function getAllPMethods(){
        $sql = 'SELECT id_medio AS id, name, id_decidir FROM ' . _DB_PREFIX_ . 'medios WHERE type="Tarjeta" AND active=1';
        $result = Db::getInstance()->ExecuteS($sql);
        
        return $result;     

    }

    public function updateInteres($ArrayInteresfields){
        $queryIdDecidir = 'SELECT id_decidir FROM ' . _DB_PREFIX_ . 'medios WHERE id_medio='.pSQL($ArrayInteresfields['payment_method']);
        $result = Db::getInstance()->ExecuteS($queryIdDecidir);

        $query = 'UPDATE `'._DB_PREFIX_.'interes` SET installment='.pSQL($ArrayInteresfields['installment']).', payment_method='.pSQL($result[0]['id_decidir']).', coeficient='.pSQL($ArrayInteresfields['coeficient']).', active='.pSQL($ArrayInteresfields['active']).' WHERE id_interes = '.pSQL($ArrayInteresfields['id_interes']);  

        if(!Db::getInstance()->execute($query)){
            die('Error de actualizacion.');        
        }
    }

    public function updateInteresVisible($idInteres){

        $query = 'UPDATE '._DB_PREFIX_.'interes SET active = IF (active, 0, 1) WHERE id_interes='.pSQL($idInteres);
        
        if(!Db::getInstance()->execute($query)){
            die('Error de actualizacion.');        
        }
    }

    public function insertInteres($ArrayInteresfields){

        $queryIdDecidir = 'SELECT id_decidir FROM ' . _DB_PREFIX_ . 'medios WHERE id_medio='.pSQL($ArrayInteresfields['payment_method']);
        $result = Db::getInstance()->ExecuteS($queryIdDecidir);

        $query = 'INSERT INTO `'._DB_PREFIX_.'interes` (installment, payment_method, coeficient, active) VALUES("'.pSQL($ArrayInteresfields['installment']).'","'.pSQL($result[0]['id_decidir']).'",'.pSQL($ArrayInteresfields['coeficient']).','.pSQL($ArrayInteresfields['active']).')';

        if(!Db::getInstance()->execute($query)){
            die('Error al insertar el interes de tarjeta.');        
        }
    }

    public function deleteInteres($idInteres){  
        Db::getInstance()->delete('interes', 'id_interes='.$idInteres);
    }
}