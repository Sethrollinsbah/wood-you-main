<?php
/**
 *  2014-2020 Prestashoppe
 *
 *  @author    Prestashoppe
 *  @copyright 2014-2020 Prestashoppe
 *  @license   Prestashoppe Commercial License
 */

if (!defined('_PS_VERSION_'))
	exit;

function upgrade_module_1_1_0($object)
{
    require_once(_PS_MODULE_DIR_ . 'prefirstatlanticcommerce/sql/install.php');
    Configuration::updateValue('PRE_FAC_3D_SECURE_PAYMENT', 1);
	return $object;
}
