<?php
require_once(dirname(__FILE__).'../../../../../config/config.inc.php');

class AdminEntityController extends AdminController
{	
    public $modulesParams = "&configure=decidir&tab_module=payments_gateways&module_name=decidir";

    public $urlAddEntity = "";

    public $name = "";
    
    public $sectionTitle = "ENTIDAD";

    public function __construct()
    {
        //parent::__construct();
         if($_GET['controller'] == 'AdminModules' && $_GET['configure'] == 'decidir'){
            parent::__construct();
        }
    }    

    public function renderListEntities(){
        $list = $this->getAllEntities();

        $this->fields_list = array(
            'id_entidad' => array(
                'title' => $this->l('ID'),
                'width' => 140,
                'type' => 'text',
            ),
            'name' => array(
                'title' => $this->l('Entity name'),
                'width' => 140,
                'type' => 'text',
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
        $helper = new HelperList();
         
        $helper->shopLinkType = '';
         
        $helper->simple_header = true;
         
        //Actions to be displayed in the "Actions" column
        $helper->actions = array('edit', 'delete');
         
        $helper->identifier = 'id_entidad';

        //arreglar esto!!!!!!
        $urlAddEntity = AdminController::$currentIndex.'&configure=decidir&section=5&add_entidad&token='.Tools::getAdminTokenLite('AdminModules'); 
        
        $helper->title = $this->l('Financial entities');

        $helper->table = ((isset($this->name))? $this->name : "").'_entidad';
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure=decidir&section=5';

        return $helper->generateList($list, $this->fields_list);
    }

    public function getAllEntities(){
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'entidades';
        $result = Db::getInstance()->ExecuteS($sql);
        
        return $result;     
    }

    public function updateEntity($ArrayEntityfields){
        $query = 'UPDATE '._DB_PREFIX_.'entidades SET name="'.pSQL($ArrayEntityfields['name']).'", active='.pSQL($ArrayEntityfields['active']).' WHERE id_entidad='.pSQL($ArrayEntityfields['id_entity']);

        if(!Db::getInstance()->execute($query)){
            die('Error on update.');        
        }
    }

    public function updateEntityVisible($idEntity){

        $query = 'UPDATE '._DB_PREFIX_.'entidades SET active = IF (active, 0, 1) WHERE id_entidad='.pSQL($idEntity);
        if(!Db::getInstance()->execute($query)){
            die('Error on update.');        
        }
    }

    public function insertEntity($ArrayEntityfields){
        $query = 'INSERT INTO `'._DB_PREFIX_.'entidades` (name, active) VALUES("'.pSQL($ArrayEntityfields['name']).'",'.pSQL($ArrayEntityfields['active']).')';

        if(!Db::getInstance()->execute($query)){
            die('Error when insert.');        
        }
    }

    public function deleteEntity($idEntity){
        Db::getInstance()->delete('entidades', 'id_entidad='.$idEntity);
        Db::getInstance()->delete('promociones', 'entity='.$idEntity);
    }
}