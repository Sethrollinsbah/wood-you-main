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

class AdminBlogController extends ModuleAdminController
{
    public function __construct()
    {
        parent::__construct();
        Tools::redirectAdmin($this->module->getConfigPagePath());
    }
}
