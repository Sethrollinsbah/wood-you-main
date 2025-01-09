<?php
/**
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
 */

if (!defined('_PS_VERSION_')) { exit; }
require_once(dirname(__FILE__).'/classes/MLS_Obj.php');
require_once(dirname(__FILE__).'/classes/MLS_Slide.php');
require_once(dirname(__FILE__).'/classes/MLS_Layer.php');
require_once(dirname(__FILE__).'/classes/MLS_Config.php');
require_once(dirname(__FILE__).'/classes/Ets_mls_defines.php');
if (!defined('_PS_ETS_MLS_IMG_DIR_')) {
    define('_PS_ETS_MLS_IMG_DIR_', _PS_IMG_DIR_ . 'ets_multilayerslider/');
}
if (!defined('_PS_ETS_MLS_IMG_')) {
    define('_PS_ETS_MLS_IMG_', __PS_BASE_URI__ . 'img/ets_multilayerslider/');
}
class Ets_multilayerslider extends Module
{    
    private $_html;   
    public $alerts;
    public $is17 = false;
    public $googlefonts = array();
	public $url_img_dir = _PS_IMG_DIR_ . 'ets_multilayerslider/';
    public function __construct()
	{
		$this->name = 'ets_multilayerslider';
		$this->tab = 'front_office_features';
		$this->version = '1.1.1';
		$this->author = 'PrestaHero';
		$this->need_instance = 0;
        $this->module_key = '8e65fd095f1c6401c164005e976f7675';
		$this->secure_key = Tools::encrypt($this->name);        
		$this->bootstrap = true;
		parent::__construct();        
        $this->displayName = $this->l('Multi-layer slider PRO');
		$this->description = $this->l('Visual drag and drop home page slideshow builder');
		$this->ps_versions_compliancy = array('min' => '1.6.0.0', 'max' => _PS_VERSION_);
        if(version_compare(_PS_VERSION_, '1.7', '>='))
            $this->is17 = true;
    }
    /**
	 * @see Module::install()
	 */
    public function install()
	{
        self::clearAllCache();
        Ets_mls_defines::clearUploadedImages();
        $this->_installImagesDefault();
        $config = new MLS_Config();
        $config->installConfigs();
        if($css = Configuration::get('ETS_MLS_CUSTOM_CSS'))
        {
            @file_put_contents(dirname(__FILE__).'/views/css/custom.cache.css',$css);
        }
        elseif(@file_exists(dirname(__FILE__).'/views/css/custom.cache.css'))
            @unlink(dirname(__FILE__).'/views/css/custom.cache.css');
        return parent::install()        
        && $this->registerHook('displayHeader')        
        && $this->registerHook('displayTopColumn')
        && $this->registerHook('displayHome')
        && $this->registerHook('displayBackOfficeHeader')
        && $this->registerHook('displayMLS')
        && Ets_mls_defines::installDatabases();
    }
    public function _installImagesDefault() {
	    if (!is_dir($this->url_img_dir)) {
		    mkdir($this->url_img_dir, 0777);
	    }
	    if (!is_file($this->url_img_dir . 'ajax-loader.gif'))
		    copy(dirname(__FILE__) . '/views/img/ajax-loader.gif', $this->url_img_dir . 'ajax-loader.gif');
	    if (!is_file($this->url_img_dir . 'loader.gif'))
		    copy(dirname(__FILE__) . '/views/img/loader.gif', $this->url_img_dir . 'loader.gif');
    }
    /**
	 * @see Module::uninstall()
	 */
	public function uninstall()
	{
        self::clearAllCache();
        Ets_mls_defines::clearUploadedImages();
        $this->_uninstallImagesDefault();
        return parent::uninstall() && Ets_mls_defines::uninstallDb();
    }
    public function _uninstallImagesDefault() {
	    if (is_dir($this->url_img_dir)) {
		    $files = glob($this->url_img_dir . '*', GLOB_MARK);
		    foreach ($files as $file) {
			    if (!is_dir($file) && file_exists($file)) {
				    unlink($file);
			    }
		    }
		    rmdir($this->url_img_dir);
	    }
    }
    public function getContent()
	{
		if (!Module::isInstalled($this->name) || !Module::isEnabled($this->name)) {
			return $this->displayWarning($this->l(sprintf('You must enable "%s" module to configure its features', $this->displayName)));
		}
	   $this->proccessPost();
       $this->requestForm();
       $this->context->controller->addJqueryUI('ui.sortable');
       $this->context->controller->addJqueryUI('ui.draggable');
       $this->_html .= $this->displayAdminJs();
       $this->_html .= $this->renderForm();
       return $this->_html;
    }
    public function renderForm()
    {
        $slide = new MLS_Slide();
        $layer = new MLS_Layer();
        $config = new MLS_Config();
        $this->smarty->assign(array(
            'slideForm' =>$slide->renderForm(),
            'layerForm'=> $layer->renderForm(),
            'configForm' => $config->renderForm(),
            'url_base_img' => _PS_ETS_MLS_IMG_,
            'mmBaseAdminUrl' => $this->context->link->getAdminLink('AdminModules', true).'&configure='.$this->name,          
            'layoutDirection' => $this->layoutDirection(),
            'mls_layout' => $this->context->language->is_rtl ? 'rtl' : 'ltr',
            'id_lang' => $this->context->language->id,
            'multiLayoutExist' => Ets_mls_defines::multiLayoutExist()?true:false,
            'mls_configs' => $this->getSliderConfigs(),  
            'width_slider' => Configuration::get('ETS_MLS_WIDTH_SLIDE') ? Configuration::get('ETS_MLS_WIDTH_SLIDE'): 1170,
            'height_slider' => Configuration::get('ETS_MLS_HEIGHT_SLIDE') ? Configuration::get('ETS_MLS_HEIGHT_SLIDE'):500,        
        ));        
        return $this->display(__FILE__,'admin-form.tpl');
    } 
    public function baseAdminUrl()
    {
        return $this->context->link->getAdminLink('AdminModules', true).'&configure='.$this->name;
    }
    public function proccessPost()
    {
        $this->alerts = array();
        $time = time();        
        if(Tools::isSubmit('mls_form_submitted') && ($mmObj = Tools::getValue('mls_object')) && in_array($mmObj,array('MLS_Slide','MLS_Layer')))
        {
            $obj = ($itemId = (int)Tools::getValue('itemId')) && $itemId > 0 ? new $mmObj($itemId) : new $mmObj();
            $this->alerts = $obj->saveData(); 
            $vals = $obj->getFieldVals();     
            $processResult = array(
                'alert' => $this->displayAlerts($time),
                'itemId' => (int)$obj->id,
                'title' => property_exists($obj,'title') && isset($obj->title[(int)$this->context->language->id]) ? $obj->title[(int)$this->context->language->id] : false,
                'images' => $obj->id && property_exists($obj,'image') && $obj->image ? array(array(
                    'name' => 'image',
                    'url' =>  _PS_ETS_MLS_IMG_DIR_.$obj->image,
                )) : false,
                'itemKey' => 'id_'.$obj->fields['form']['name'],
                'time' => $time,
                'mls_object' => $mmObj, 
                'vals' => $vals,
                'success' => isset($this->alerts['success']) && $this->alerts['success'],
            );
            if($mmObj == 'MLS_Layer' && (int)$obj->id)
            {
                $layer = Ets_mls_defines::getDataLayers(false,(int)$obj->id);
                $processResult['sortLayerHtml'] = $this->hookDisplayMLSLayerSort(array('layer' => $layer));
                $processResult['layerHtmlLTR'] = $this->hookDisplayMLSLayer(array('layer' => $layer,'layout' => 'ltr'));
                $processResult['layerHtmlRTL'] = $this->hookDisplayMLSLayer(array('layer' => $layer,'layout' => 'rtl'));
                $processResult['font'] = $layer['font_family'] && $layer['font_family']!='Times new roman' && $layer['font_family']!='Arial' ? 'https://fonts.googleapis.com/css?family='.urlencode($layer['font_family']) : false;   
            }
            if($mmObj == 'MLS_Slide' && (int)$obj->id)
            {
                $slide = Ets_mls_defines::getSlides(false,$obj->id);
                $processResult['slideHtml'] = $this->hookDisplayMLSSlide(array('slide' => $slide));
                $processResult['slideHtmlLTR'] = $this->hookDisplayMLSSlide(array('slide' => $slide,'layout' => 'ltr'));
                $processResult['slideHtmlRTL'] = $this->hookDisplayMLSSlide(array('slide' => $slide,'layout' => 'rtl')); 
            }                    
            die(json_encode($processResult));
        }
        if(($image = Tools::getValue('deleteimage')) && ($mmObj = Tools::getValue('mls_object')) && in_array($mmObj,array('MLS_Slide','MLS_Layer')) && ($itemId = (int)Tools::getValue('itemId')) && $itemId > 0)
        {
            $obj = new $mmObj($itemId);
            $this->alerts = $obj->clearImage('image');
            unset($image);
            die(json_encode(array(
                'alert' => $this->displayAlerts($time),
                'itemId' => (int)$obj->id,  
                'itemKey' => 'image',              
                'time' => $time,
                'mls_object' => $mmObj,
                'success' => isset($this->alerts['success']) && $this->alerts['success'],
            ))); 
        }
        if(($image = Tools::getValue('deleteobject')) && ($mmObj = Tools::getValue('mls_object')) && in_array($mmObj,array('MLS_Slide','MLS_Layer')) && ($itemId = (int)Tools::getValue('itemId')) && $itemId > 0)
        {
            $obj = new $mmObj($itemId);
            $this->alerts = $obj->deleteObj();
            die(json_encode(array(
                'alert' => $this->displayAlerts($time),                           
                'time' => $time,
                'itemId' => $itemId,
                'success' => isset($this->alerts['success']) && $this->alerts['success'],
                'successMsg' => isset($this->alerts['success']) && $this->alerts['success'] ? $this->l('Item deleted') : false,
                'mls_object' => $mmObj,
            ))); 
        }
        if(Tools::isSubmit('duplicatedbject') && ($mmObj = Tools::getValue('mls_object')) && in_array($mmObj,array('MLS_Slide','MLS_Layer')) && ($itemId = (int)Tools::getValue('itemId')) && $itemId > 0)
        {
            $obj = new $mmObj($itemId);  
            $newObj = $obj->duplicateItem(); 
            $result = array(
                'alert' => $this->displayAlerts($time),                           
                'time' => $time,
                'itemId' => $itemId,
                'newItemId' => $newObj->id ? $newObj->id : 0,                
                'success' => $newObj ? $this->l('Item duplicated') : false,
            );      
            if($mmObj=='MLS_Slide')
            {
                $result['html'] = $newObj->id ? $this->hookDisplayMLSSlide(array('slide' => Ets_mls_defines::getSlides(false,$newObj->id),'layout'=>in_array(Tools::getValue('layout'),array('rtl','ltr')) ? Tools::getValue('layout') : 'ltr')) : '';
            } 
            if($mmObj=='MLS_Layer')
            {
                $result['layerHtml'] = $newObj->id ? $this->hookDisplayMLSLayer(array('layer' => Ets_mls_defines::getDataLayers(false,$newObj->id),'layout'=>in_array(Tools::getValue('layout'),array('rtl','ltr')) ? Tools::getValue('layout') : 'ltr')) : '';
                $result['layerSortHtml'] = $newObj->id ? $this->hookDisplayMLSLayerSort(array('layer' => Ets_mls_defines::getDataLayers(false,$newObj->id))) : '';
                $result['id_slide'] = $newObj->id_slide;
            }   
            die(json_encode($result));
        }
        if(Tools::isSubmit('mls_config_submitted'))
        {
            $config = new MLS_Config();
            
            $this->alerts = $config->saveData();
            if(isset($this->alerts['success']))
            {
                if(trim(Tools::getValue('ETS_MLS_CUSTOM_CSS')))
                {
                    @file_put_contents(dirname(__FILE__).'/views/css/custom.cache.css',str_replace(array('[bg_color]','[button_color]'),array(Configuration::get('ETS_MLS_SLIDER_BACKGROUND'),Configuration::get('ETS_MLS_SLIDER_BUTTON_COLOR')),trim(Tools::getValue('ETS_MLS_CUSTOM_CSS'))));
                }
                elseif(@file_exists(dirname(__FILE__).'/views/css/custom.cache.css'))
                    @unlink(dirname(__FILE__).'/views/css/custom.cache.css');                    
            }        
            die(json_encode(array(
                'alert' => $this->displayAlerts($time),                           
                'time' => $time, 
                'layout_direction' => $this->layoutDirection(),               
                'success' => isset($this->alerts['success']) && $this->alerts['success'],
                'configs' => $this->getSliderConfigs(true),
                'slider_width' => Configuration::get('ETS_MLS_WIDTH_SLIDE'),
                'slider_height' => Configuration::get('ETS_MLS_HEIGHT_SLIDE'),
                'slider_type' => Tools::strtolower(Configuration::get('ETS_MLS_SLIDER_TYPE')),
            ))); 
        }
        if(Tools::isSubmit('updateOrder'))
        {
            $itemId = (int)Tools::getValue('itemId');
            $objName = 'MLS_'.Tools::ucfirst(Tools::strtolower(trim(Tools::getValue('obj'))));
            $parentId = (int)Tools::getValue('parentId');
            $parentObjName = 'MLS_'.Tools::ucfirst(Tools::strtolower(trim(Tools::getValue('parentObj'))));
            $previousId = (int)Tools::getValue('previousId');  
            $layout = Tools::getValue('layout') =='rtl' ? 'rtl' : 'ltr';  
            $processResult = array();
            if(in_array($objName,array('MLS_Slide','MLS_Layer')) && $itemId > 0)
            {
                /** @var MLS_Obj $obj */
                $obj = new $objName($itemId);
                $orderUpdated = $obj->updateOrder($previousId,$parentId);
                if($objName == 'MLS_Layer' && $parentId && $parentObjName=='MLS_Slide')
                {
                    $processResult['slideHtml'] = $this->hookDisplayMLSSlideInner(array('slide' => Ets_mls_defines::getSlides(false,$parentId),'layout' => $layout));
                    $processResult['id_slide'] = $parentId;
                }
            }
            $processResult['success'] = isset($orderUpdated) && $orderUpdated ? $this->l('Updated successfull'):false;
            die(json_encode($processResult));
        }
        if(Tools::isSubmit('updatePositionLayer'))
        {
            $itemId = (int)Tools::getValue('itemId');
            $objName = trim(Tools::getValue('obj'));
            if($objName=='MLS_Layer' && $itemId > 0)
            {
                die(json_encode(array(
                    'success' => Ets_mls_defines::updatePositionLayer(Tools::getValue('layout'), Tools::getValue('data_top'), $itemId, Tools::getValue('data_left'), Tools::getValue('data_right')) ? $this->l('Updated successfull'):false,
                )));
            }            
        }        
        if(Tools::getValue('updateLayout'))
        {
            $layout = Tools::getValue('layout') == 'rtl' ? 'rtl' : 'ltr';
            die(json_encode(array(
                'html' => $this->hookDisplayMLSSlider(array('layout' => $layout)),
                'currentSlideId' => (int)Tools::getValue('currentSlideId'),
                'success' => true,
                'layout' => $layout,
            )));
        }
        if(Tools::getValue('loadSlider'))
        {
            die(json_encode(array(
                'html' => $this->displaySlideFrontend(array('layout' => Tools::getValue('layout') == 'rtl' ? 'rtl' : 'ltr','backend_load' => true)),                
                'success' => true,
            )));
        }
        if(Tools::getValue('exportSlider'))
        {
            $this->generateArchive();
            die;
        }
        if(Tools::getValue('importslider'))
        {
            $errors = $this->processImport();   
            die(json_encode(array(
                'success' => !$errors ? $this->l('Slider was successfully imported. This page will be reloaded in 3 seconds') : false, 
                'error' => $errors ? implode('; ',$errors) : false,
            )));         
        }
    }
    private function processImport($zipfile = false)
    {
        $errors = array();
        if(!$zipfile)
        {
            $savePath = dirname(__FILE__).'/cache/';
            if(@file_exists($savePath.'mls_slider.data.zip'))
                @unlink($savePath.'mls_slider.data.zip');
            $uploader = new Uploader('sliderdata');
            $uploader->setCheckFileSize(false);
            $uploader->setAcceptTypes(array('zip'));        
            $uploader->setSavePath($savePath);
            $file = $uploader->process('mls_slider.data.zip'); 
            if ($file[0]['error'] === 0) {
                if (!Tools::ZipTest($savePath.'mls_slider.data.zip')) 
                    $errors[] = $this->l('Zip file seems to be broken');
            } else {
                $errors[] = $file[0]['error'];
            }
            $extractUrl = $savePath.'mls_slider.data.zip';
        }
        else      
            $extractUrl = $zipfile;
        if(!@file_exists($extractUrl))
            $errors[] = $this->l('Zip file doesn\'t exist');
        if(!$errors)
        {
            $zip = new ZipArchive();
            if($zip->open($extractUrl) === true)
            {
                if ($zip->locateName('Slider-Info.xml') === false)
                {
                    $errors[] = $this->l('Slider-Info.xml doesn\'t exist');                    
                    if($extractUrl && !$zipfile)
                    {
                        @unlink($extractUrl);                        
                    }                      
                }
            }
            else
                $errors[] = $this->l('Cannot open zip file. It might be broken or damaged');
        } 
        if(!$errors)
        {
            if(Tools::isSubmit('importoverride') && $zip->locateName('Data.xml') !== false)
            {
            	Ets_mls_defines::deleteDatabaseWhenImport();
	            Ets_mls_defines::clearUploadedImages();
            }
            if(!Tools::ZipExtract($extractUrl, dirname(__FILE__).'/views/'))
                $errors[] = $this->l('Cannot extract zip data');
            if(!@file_exists(dirname(__FILE__).'/views/Data.xml') && !@file_exists(dirname(__FILE__).'/views/Config.xml'))
                $errors[] = $this->l('Neither Data.xml nor Config.xml exist');
        }        
        if(!$errors)
        {            
            if(@file_exists(dirname(__FILE__).'/views/Data.xml'))
            {
                $this->importXmlTbl(@simplexml_load_file(dirname(__FILE__).'/views/Data.xml'));
                @unlink(dirname(__FILE__).'/views/Data.xml');
            } 
            if(@file_exists(dirname(__FILE__).'/views/Config.xml'))
            {
                $this->importXmlConfig(@simplexml_load_file(dirname(__FILE__).'/views/Config.xml'));
                @unlink(dirname(__FILE__).'/views/Config.xml');
            } 
            if(@file_exists(dirname(__FILE__).'/views/Slider-Info.xml'))
            {
                @unlink(dirname(__FILE__).'/views/Slider-Info.xml');
            }               
        }
        return $errors;        
    }
    private function importXmlConfig($xml)
    {
        if(!$xml)
            return false;
        $languages = Language::getLanguages(false);
        $configs = Ets_mls_defines::getConfigs();
        foreach($configs['configs'] as $key => $config)
        {
            if(property_exists($xml,$key))
            {
                if(isset($config['lang']) && $config['lang'])
                {
                    $temp = array();
                    foreach($languages as $lang)
                    {
                        $node = $xml->$key;
                        $temp[$lang['id_lang']] = isset($node['configValue']) ? (string)$node['configValue'] : (isset($config['default']) ? $config['default'] : '');
                    }
                    Configuration::updateValue($key,$temp);
                }
                else
                {
                    $node = $xml->$key;
                    Configuration::updateValue($key,isset($node['configValue']) ? (string)$node['configValue'] : (isset($config['default']) ? $config['default'] : ''));
                }                   
            }
        }        
        if(isset($xml->ETS_MLS_CUSTOM_CSS) && ($node = $xml->ETS_MLS_CUSTOM_CSS) && isset($node['configValue']) && trim((string)$node['configValue']))
            @file_put_contents(dirname(__FILE__).'/views/css/custom.cache.css',str_replace(array('[bg_color]','[button_color]'),array(Configuration::get('ETS_MLS_SLIDER_BACKGROUND'),Configuration::get('ETS_MLS_SLIDER_BUTTON_COLOR')),trim((string)$node['configValue'])));
        elseif(@file_exists(dirname(__FILE__).'/views/css/custom.cache.css'))
            @unlink(dirname(__FILE__).'/views/css/custom.cache.css');
    }
    private function importXmlTbl($xml)
    {       
        
        if(!$xml)
            return false;
        $id_slide = 0;
        if($xml && property_exists($xml,'slide') && $xml->slide)
        {
            foreach($xml->children() as $slide)
            {                
                if(($attr = $slide->attributes()) && ($id_slide = $this->addObj('slide',$attr)))
                {
                    if($slide->layers->children())
                    {
                        foreach($slide->layers->children() as $layer)
                        {                            
                            if($attr2 = $layer->attributes())
                            {                                
                                $attr2->id_slide = $id_slide;                                
                                $this->addObj('layer',$attr2);
                            }
                        }
                    }                
                }                
            }
        }
    }    
    private function addObj($obj, $data)
    {
        $realOjbect = ($obj == 'slide' ? new MLS_Slide() : new MLS_Layer());
        $languages = Language::getLanguages(false);
        if ($obj == 'slide') {
	        $attrs = Ets_mls_defines::getSliders((int)Tools::getValue('itemId'));
        } else {
	        $attrs = Ets_mls_defines::getLayers((int)Tools::getValue('itemId'), (int)Tools::isSubmit('id_slide'));
        }
        foreach($attrs['configs'] as $key => $val)
        {
            if(isset($val['lang']) && $val['lang'])
            {
                $temp = array();
                foreach($languages as $lang)
                {                    
                    $temp[$lang['id_lang']] = isset($data[$key]) ? (string)$data[$key] : (isset($val['default']) ? $val['default'] : '');                    
                }
                $realOjbect->$key = $temp;
            }
            else
            {
                if($data[$key])
                    $realOjbect->$key = (string)$data[$key];
                elseif(isset($val['default']))
                    $realOjbect->$key = $val['default'];
                else
                    $realOjbect->$key = '';
            }
        }
        if($realOjbect->add())
            return $realOjbect->id;                        
        return false;
    }
    private function archiveThisFile($obj, $file, $server_path, $archive_path)
    {
        if (is_dir($server_path.$file)) {
            $dir = scandir($server_path.$file);
            foreach ($dir as $row) {
                if ($row[0] != '.') {
                    $this->archiveThisFile($obj, $row, $server_path.$file.'/', $archive_path.$file.'/');
                }
            }
        } else $obj->addFile($server_path.$file, $archive_path.$file);
    }    
    public function renderConfigXml()
    {        
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><!-- Copyright PrestaHero --><config></config>');            
        if($configs = $this->getSliderConfigs())
        {
            foreach($configs as $key => $val)
            {
                $config = $xml->addChild($key);
                $config->addAttribute('configValue',Configuration::get($key, isset($val['lang']) && $val['lang'] ? (int)Configuration::get('PS_LANG_DEFAULT') : null));   
            }            
        }
        return $xml->asXML();
    }
    public function renderSliderDataXml()
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><!-- Copyright PrestaHero --><slides></slides>');            
        
        if($slides = Ets_mls_defines::getSlides(false,false,(int)Configuration::get('PS_LANG_DEFAULT')))
        {
            foreach($slides as $slide)
            {                
                $slideNode = $xml->addChild('slide');
                $slideNode->addAttribute('obj','MLS_Slide');
                $layersNode = $slideNode->addChild('layers');                 
                if(isset($slide['layers']) && $slide['layers'])
                {
                    foreach($slide['layers'] as $layer)
                    {
                            $layerNode = $layersNode->addChild('layer');
                            $layerNode->addAttribute('obj','MLS_Layer');
                            foreach($layer as $key=>$val)
                            {
                                if($key!='id_layer')
                                    $layerNode->addAttribute($key,$val);
                            }
                    }
                }
                foreach($slide as $field => $val)
                {                    
                    if($field!='id_slide')
                        $slideNode->addAttribute($field,$val);                    
                    
                }                   
            }            
        }
        return $xml->asXML();
    }
    public function renderInfoXml()
    {        
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><!-- Copyright PrestaHero --><info></info>'); 
        $xml->addAttribute('export_time',date('l jS \of F Y h:i:s A'));
        $xml->addAttribute('export_source',$this->context->link->getPageLink('index', Configuration::get('PS_SSL_ENABLED')));
        $xml->addAttribute('module_version',$this->version);        
        return $xml->asXML();
    }
    private function generateArchive()
    {
        $zip = new ZipArchive();
        $cacheDir = dirname(__FILE__).'/cache/';
        $zip_file_name = 'mls_slider_'.date('dmYHis').'.zip';
        if ($zip->open($cacheDir.$zip_file_name, ZipArchive::OVERWRITE | ZipArchive::CREATE) === true) {
            if (!$zip->addFromString('Slider-Info.xml', $this->renderInfoXml())) {
                $this->errors[] = $this->l('Cannot create Menu-Info.xml');
            }
            if (!$zip->addFromString('Config.xml', $this->renderConfigXml())) {
                $this->errors[] = $this->l('Cannot create config xml file.');
            }
            if (!$zip->addFromString('Data.xml', $this->renderSliderDataXml())) {
                $this->errors[] = $this->l('Cannot create data xml file.');
            }
            $this->archiveThisFile($zip,'upload', dirname(__FILE__).'/views/img/', 'img/');
            $zip->close();

            if (!is_file($cacheDir.$zip_file_name)) {
                $this->errors[] = $this->l(sprintf('Could not create %1s', _PS_CACHE_DIR_.$zip_file_name));
            }

            if (!$this->errors) {
                if (ob_get_length() > 0) {
                    ob_end_clean();
                }

                ob_start();
                header('Pragma: public');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Cache-Control: public');
                header('Content-Description: File Transfer');
                header('Content-type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.$zip_file_name.'"');
                header('Content-Transfer-Encoding: binary');
                ob_end_flush();
                readfile($cacheDir.$zip_file_name);
                @unlink($cacheDir.$zip_file_name);
                exit;
            }
        }
        {
            echo $this->l('An error occurred during the archive generation');
            die;
        }
    }
    public function requestForm()
    {
        if(Tools::isSubmit('request_form') && ($mmObj = Tools::getValue('mls_object')) && in_array($mmObj,array('MLS_Slide','MLS_Layer')))
        {
            $obj = ($itemId = (int)Tools::getValue('itemId')) && $itemId > 0 ? new $mmObj($itemId) : new $mmObj();
            die(json_encode(array(
                'form' => $obj->renderForm(),
                'itemId' => $itemId,
            )));
        }
    }
    public function displayAdminJs()
    {
	    $cache_id = $this->_getCacheId(['admin-js']);
	    if (!$this->isCached('admin-js.tpl', $cache_id)) {
		    $this->smarty->assign(array(
			    'js_dir_path' => $this->_path.'views/js/',
		    ));
	    }
        return $this->display(__FILE__,'admin-js.tpl', $cache_id);
    }
    public function displayAlerts($time)
    {
        $this->smarty->assign(array(
            'alerts' => $this->alerts,
            'time' => $time,
        ));
        return $this->display(__FILE__,'admin-alerts.tpl');
    }
    private function renderOrderString($ids)
    {
        $argIds = explode(',',$ids);
        $str = '';
        if($argIds)
        {            
            foreach($argIds as $id)
            {                
                $str .= ' p.id_product='.(int)$id.' DESC,';
            }
        }
        return trim($str,',');
    }
    public function hookDisplayHeader()
    {
    	if (Tools::getIsset('controller') && Tools::getValue('controller') == 'index') {
		    $this->addGoogleFonts(true);
		    $this->context->controller->addCSS($this->_path.'views/css/multilayerslider.css');
		    if(@file_exists(dirname(__FILE__).'/views/css/custom.cache.css'))
			    $this->context->controller->addCSS($this->_path.'views/css/custom.cache.css');
		    $this->context->controller->addCSS($this->_path.'views/css/animate.css');
		    if($this->is17){
			    $this->context->controller->addCSS($this->_path.'views/css/fix17.css');
		    }
		    $this->context->controller->addJS($this->_path.'views/js/mls_slider.pack.js');
		    $this->context->controller->addJS($this->_path.'views/js/multilayerslider.js');
	    }
        
    }
    public function hookDisplayBackOfficeHeader()
    {
        if(Tools::getValue('configure')=='ets_multilayerslider')
        {
            $this->addGoogleFonts();
            $this->context->controller->addCSS($this->_path.'views/css/multilayerslider-admin.css');
            $this->context->controller->addCSS($this->_path.'views/css/animate.css');
            $this->context->controller->addCSS($this->_path.'views/css/mlsslider.pack.backend.css');
            if($this->is17){
                    $this->context->controller->addCSS($this->_path.'views/css/fix17_bo.css');
            }
        }        
    }
    public function addGoogleFonts($frontend = false)
    {
        if($fonts = Ets_mls_defines::getFonts())
        { 
            $ik = 0;
            foreach($fonts as $font)
            {
                if($font['font_family'] && $font['font_family']!='Times new roman' && $font['font_family']!='Arial')
                {
                    $ik++;
                    if($this->is17 && $frontend)
                        $this->addCss17('https://fonts.googleapis.com/css?family='.urlencode($font['font_family']),'mls_gfont_'.$ik,false);
                    else
                        $this->context->controller->addCSS('https://fonts.googleapis.com/css?family='.urlencode($font['font_family']));   
                }                
            }
        }
    }
    public function addCss17($cssFile,$id = false,$local = true)
    {
        $this->context->controller->registerStylesheet($id ? $id : '', $cssFile, array('media' => 'all', 'priority' => 150,'server' => $local ? 'local' : 'remote'));
    }
    public function strToIds($str)
    {
        $ids = array();
        if($str && ($arg = explode(',',$str)))
        {
            foreach($arg as $id)
                if(!in_array((int)$id, $ids))
                    $ids[] = (int)$id;
        }
        return $ids;
    }    
    public static function clearAllCache()
    {
        if(@file_exists(dirname(__FILE__).'/views/css/custom.cache.css'))
            @unlink(dirname(__FILE__).'/views/css/custom.cache.css');
        if($files = glob(dirname(__FILE__).'/cache/*'))
        {
            foreach($files as $file)
                if(@file_exists($file) && strpos($file,'index.php')===false)
                    @unlink($file);
        }
    }
    public function modulePath()
    {
        return $this->_path;
    }
    public function layoutDirection()
    {        
        return $this->context->language->is_rtl ? 'ets-dir-rtl' : 'ets-dir-ltr';   
    }

    public function hex2rgb($hex,$opacity = false) {
       if(!Validate::isColor($hex))
            return $hex;
       $hex = str_replace("#", "", $hex);    
       if(Tools::strlen($hex) == 3) {
          $r = hexdec(Tools::substr($hex,0,1).Tools::substr($hex,0,1));
          $g = hexdec(Tools::substr($hex,1,1).Tools::substr($hex,1,1));
          $b = hexdec(Tools::substr($hex,2,1).Tools::substr($hex,2,1));
       } else {
          $r = hexdec(Tools::substr($hex,0,2));
          $g = hexdec(Tools::substr($hex,2,2));
          $b = hexdec(Tools::substr($hex,4,2));
       }
       return 'rgba('.$r.','.$g.','.$b.($opacity ? ','.$opacity : '').')';
    }
    public function getSliderConfigs($forJs = false)
    {
        $configs = array();
        $_configs = Ets_mls_defines::getConfigs();
        foreach($_configs['configs'] as $key => $val)
        {
            if($forJs)
                $configKey = 'data-'.Tools::strtolower(str_replace('_','-',str_replace('ETS_MLS_','',$key)));
            else
                $configKey = $key;
            $configs[$configKey] = Tools::strtolower(Configuration::get($key,isset($val['lang']) && $val['lang'] ? $this->context->language->id : null));
        }
        return $configs;
    }  
    public function displaySlideFrontend($params)
    {
        if (!isset($params['backend_load']) && (!isset($this->context->controller->php_self) || $this->context->controller->php_self != 'index'))
			return;
        $isMultiLayoutExit = Ets_mls_defines::multiLayoutExist();
        $mls_layout = isset($params['layout']) && in_array($params['layout'],array('rtl','ltr')) ? $params['layout'] : ($this->context->language->is_rtl && $isMultiLayoutExit ? 'rtl' : 'ltr');
        $cache_id = $this->_getCacheId(['multilayerslider', $mls_layout, isset($params['backend_load']) ? 1 : 0, $isMultiLayoutExit ? 1 : 0]);
        if (!$this->isCached('multilayerslider.tpl', $cache_id)) {
	        $this->smarty->assign(
		        array(
			        'mls_slides' => Ets_mls_defines::getSlides(true),
			        'mls_img_base_dir' => $this->_path.'views/img/',
			        'mls_layout' => $mls_layout,
			        'mls_multilayout' => $isMultiLayoutExit ? true : false,
			        'mls_width' => Configuration::get('ETS_MLS_WIDTH_SLIDE') ? Configuration::get('ETS_MLS_WIDTH_SLIDE') : 1170,
			        'mls_height' => Configuration::get('ETS_MLS_HEIGHT_SLIDE') ? Configuration::get('ETS_MLS_HEIGHT_SLIDE') : 500,
			        'mls_configs' => $this->getSliderConfigs(),
			        'mls_max_slide_time' => Ets_mls_defines::maxSlideTime()+(int)Configuration::get('ETS_MLS_MOVE_IN')+(int)Configuration::get('ETS_MLS_MOVE_OUT'),
			        'mls_backend_load' => isset($params['backend_load']),
		        )
	        );
        }
		return $this->display(__FILE__, 'multilayerslider.tpl', $cache_id);
    }  
	public function hookDisplayTopColumn($params)
	{
        if($this->is17 && Configuration::get('ETS_MLS_HOOK_TO')!='customhook')
            return $this->displaySlideFrontend($params);
	}
	public function hookDisplayHome($params)
	{	   
		if($this->is17 && Configuration::get('ETS_MLS_HOOK_TO')!='customhook')
            return $this->displaySlideFrontend($params);
	}
    public function hookDisplayMLS($params)
	{	   
		if(Configuration::get('ETS_MLS_HOOK_TO')=='customhook')
            return $this->displaySlideFrontend($params);
	}
    public function hookDisplayMLSSlider($params)
    {
    	$mls_layout = isset($params['layout']) ? $params['layout'] : 'ltr';
    	$cache_id = $this->_getCacheId(['item-slider', $mls_layout]);
    	if (!$this->isCached('item-slider.tpl', $cache_id)) {
		    $this->smarty->assign(array(
			    'slides' => Ets_mls_defines::getSlides(),
			    'mls_layout' => $mls_layout,
		    ));
	    }
        return $this->display(__FILE__,'item-slider.tpl', $cache_id);
    }    
    public function hookDisplayMLSSlide($params)
    {       
        $mls_layout = isset($params['layout']) ? $params['layout'] : 'ltr';
        $cache_id = $this->_getCacheId(['item-slide', isset($params['slide']) && $params['slide'] ? $params['slide']['id_slide'] : '',  $mls_layout]);
        if (!$this->isCached('item-slide.tpl', $cache_id)) {
	        $this->smarty->assign(array(
		        'slide' => isset($params['slide']) ? $params['slide'] : false,
		        'mls_layout' => $mls_layout,
	        ));
        }
        return $this->display(__FILE__,'item-slide.tpl', $cache_id);
    } 
    public function hookDisplayMLSSlideInner($params)
    {
    	$mls_layout = isset($params['layout']) ? $params['layout'] : 'ltr';
    	$cache_id = $this->_getCacheId(['', isset($params['slide']) && $params['slide'] ? $params['slide']['id_slide'] : '', $mls_layout]);
    	if (!$this->isCached('item-slide-inner.tpl', $cache_id)) {
		    $this->smarty->assign(array(
			    'slide' => isset($params['slide']) ? $params['slide'] : false,
			    'mls_layout' => $mls_layout,
			    'sliderWidth' => Configuration::get('ETS_MLS_WIDTH_SLIDE') ? Configuration::get('ETS_MLS_WIDTH_SLIDE'): 1170,
			    'sliderHeight' => Configuration::get('ETS_MLS_HEIGHT_SLIDE') ? Configuration::get('ETS_MLS_HEIGHT_SLIDE'):500,
		    ));
	    }
        return $this->display(__FILE__,'item-slide-inner.tpl', $cache_id);
    }
    public function hookDisplayMLSLayer($params)
    {
        if(isset($params['layer']['layer_type']) && $params['layer']['layer_type']=='text_background' && isset($params['layer']['background_opacity']) && (float)$params['layer']['background_opacity']<1)
        {
            $params['layer']['background_color'] = $this->hex2rgb($params['layer']['background_color'],$params['layer']['background_opacity']);   
        }
        $this->smarty->assign(array(
            'layer' => isset($params['layer']) ? $params['layer'] : false,
            'mls_layout' => isset($params['layout']) ? $params['layout'] : 'ltr',
            'mls_multilayout' => Ets_mls_defines::multiLayoutExist() ? true : false,
        ));
        return $this->display(__FILE__,'item-layer.tpl');
    }
    public function hookDisplayMLSLayerSort($params)
    {
    	$cache_id = $this->_getCacheId(['item-layer-sort', isset($params['layer']) && $params['layer'] ? $params['layer']['id_layer'] : '']);
    	if (!$this->isCached('item-layer-sort.tpl', $cache_id)) {
		    $this->smarty->assign(array(
			    'layer' => isset($params['layer']) ? $params['layer'] : false,
		    ));
	    }
        return $this->display(__FILE__,'item-layer-sort.tpl', $cache_id);
    }
    public function hookDisplayMLSConfigs()
    {
        $configStr = '';
        if($configs = $this->getSliderConfigs())
        {
            foreach($configs as $key => $val)
            {
                if($key!='ETS_MLS_CUSTOM_CSS')
                {
                    $configStr .= 'data-'.Tools::strtolower(str_replace('_','-',str_replace('ETS_MLS_','',$key))).'='.Tools::strtolower($val).' ';
                }
            }
        }  
        return $configStr;  
    }
    public function copy_directory($src, $dst,$typeImage = true)
    {
        if (is_dir($src)) {
            $dir = opendir($src);
            if (!file_exists($dst))
                @mkdir($dst);
            while (false !== ($file = readdir($dir))) {
                if (($file != '.') && ($file != '..')) {
                    if (is_dir($src . '/' . $file)) {
                        $this->copy_directory($src . '/' . $file, $dst . '/' . $file);
                    } elseif (!file_exists($dst . '/' . $file)) {
                        $type = Tools::strtolower(Tools::substr(strrchr($file, '.'), 1));
                        if(!$typeImage || in_array($type,array('jpg', 'gif', 'jpeg', 'png')))
                        {
                            copy($src . '/' . $file, $dst . '/' . $file);
                        }
                    }
                }
            }
            closedir($dir);
        }
    }
    public function rrmdir($dir)
    {
        $dir = rtrim($dir, '/');
        if ($dir && is_dir($dir)) {
            if ($objects = scandir($dir)) {
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (is_dir($dir . "/" . $object) && !is_link($dir . "/" . $object))
                            $this->rrmdir($dir . "/" . $object);
                        elseif(file_exists($dir . "/" . $object))
                            @unlink($dir . "/" . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }

	public function _getCacheId($params = null,$parentID = true)
	{
		$cacheId = $this->getCacheId($this->name);
		$cacheId = str_replace($this->name, '', $cacheId);
		$suffix ='';
		if($params)
		{
			if(is_array($params))
				$suffix .= '|'.implode('|',$params);
			else
				$suffix .= '|'.$params;
		}
		return $this->name . $suffix .($parentID ? $cacheId:'');
	}

	public function _clearCacheWhenUpdateConfigs() {
		$this->_clearSmartyCache('*', $this->_getCacheId(['multilayerslider'], false));
		$this->_clearSmartyCache('*', $this->_getCacheId(['item-slide-inner'], false));
	}

	public function _clearCacheWhenUpdateLayer($id_item = null) {
		if ($id_item) {
			$this->_clearSmartyCache('*', $this->_getCacheId(['item-layer-sort', $id_item], false));
		} else {
			$this->_clearSmartyCache('*', $this->_getCacheId(['item-layer-sort'], false));
		}
	}

	public function _clearCacheWhenUpdateSlide($id_item = null) {
		if ($id_item) {
			$this->_clearSmartyCache('*', $this->_getCacheId(['item-slide', $id_item], false));
			$this->_clearSmartyCache('*', $this->_getCacheId(['item-slide-inner', $id_item], false));
		} else {
			$this->_clearSmartyCache('*', $this->_getCacheId(['item-slide'], false));
			$this->_clearSmartyCache('*', $this->_getCacheId(['item-slide-inner'], false));
		}
		$this->_clearSmartyCache('*', $this->_getCacheId(['multilayerslider'], false));
		$this->_clearSmartyCache('*', $this->_getCacheId(['item-slider'], false));
	}

	public function _clearSmartyCache($template,$cache_id = null, $compile_id = null)
	{
		if($cache_id===null)
			$cache_id = $this->name;
		if($template=='*')
		{
			Tools::clearCache(Context::getContext()->smarty,null, $cache_id, $compile_id);
		}
		else
		{
			Tools::clearCache(Context::getContext()->smarty, $this->getTemplatePath($template), $cache_id, $compile_id);
		}
	}
    public function getDefaultCompileId()
    {
        return Context::getContext()->shop->theme->getName();
    }
	public function display($file, $template, $cache_id = null, $compile_id = null)
	{
		if (($overloaded = Module::_isTemplateOverloadedStatic(basename($file, '.php'), $template)) === null) {
			return $this->l('No template found for module').' '.basename($file, '.php').(_PS_MODE_DEV_ ? ' (' . $template . ')' : '');
		} else {
			$this->smarty->assign([
				'module_dir' => __PS_BASE_URI__ . 'modules/' . basename($file, '.php') . '/',
				'module_template_dir' => ($overloaded ? _THEME_DIR_ : __PS_BASE_URI__) . 'modules/' . basename($file, '.php') . '/',
				'allow_push' => isset($this->allow_push) ? $this->allow_push : false,
			]);
			if ($cache_id !== null) {
				Tools::enableCache();
			}
			if ($compile_id === null) {
				$compile_id = $this->getDefaultCompileId();
			}
			$result = $this->getCurrentSubTemplate($template, $cache_id, $compile_id);
			if ($cache_id !== null) {
				Tools::restoreCacheSettings();
			}
			$result = $result->fetch();
			$this->resetCurrentSubTemplate($template, $cache_id, $compile_id);
			return $result;
		}
	}
}