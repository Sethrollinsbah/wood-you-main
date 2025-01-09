<?php
/**
* 2007-2018 Amazzing
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
*
*  @author    Amazzing <mail@amazzing.ru>
*  @copyright 2007-2018 Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/

class TestimonialsWithAvatarsAjaxModuleFrontController extends ModuleFrontControllerCore
{
    public function initContent()
    {
        $settings = $this->module->getSettings('controller');
        $action = Tools::getValue('ajaxAction');
        $ret = array();
        switch ($action) {
            case 'addPost':
                $id = '';
                $date_add = date('Y-m-d G:i:s');
                $ip = Tools::getRemoteAddr();
                $this->module->processPost($id, $date_add, $ip, 'front');
                break;
            case 'loadMore':
                $this->module->ajaxLoadMore($settings['num'], $settings['orderby'], 'front');
                break;
            case 'loadDynamicTestimonials':
                $hook_name = Tools::getValue('hook');
                $html = $this->module->displayNativeHook(Tools::strtoupper($hook_name));
                $ret = array (
                    'errors' => array(),
                    'html' => $html,
                    'hook' => Tools::strtoupper($hook_name)
                );
                break;
        }
        exit(Tools::jsonEncode($ret));
    }
}
