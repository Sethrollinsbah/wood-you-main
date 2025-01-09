<?php
/**
* 2007-2018 PrestaShop
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2018 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

function upgrade_module_2_8_0($module_obj)
{
    if (!defined('_PS_VERSION_')) {
        exit;
    }

    $all_banners_data = $module_obj->db->executeS('
        SELECT * FROM '._DB_PREFIX_.'custombanners
    ');
    $rows = array();
    foreach ($all_banners_data as $d) {
        $content = Tools::jsonDecode($d['content'], true);
        if (isset($content['restricted'])) {
            $type = $content['restricted']['type'];
            $ids = $content['restricted']['ids'];
            unset($content['restricted']);
            if ($ids) {
                $imploded_ids = implode(', ', $ids);
                $content['exceptions'] = array(
                    'page' => array( 'type' => $type, 'ids' => $imploded_ids),
                    'customer' => array( 'type' => '0', 'ids' => ''),
                );
                $content = Tools::jsonEncode($content);
                $row = '('.(int)$d['id_banner'].', '.(int)$d['id_shop'].', '.(int)$d['id_lang'];
                $row .= ', \''.pSQL($content).'\')';
                $rows[] = $row;
            }
        }
    }
    if ($rows) {
        $module_obj->db->execute('
            INSERT INTO '._DB_PREFIX_.'custombanners (id_banner, id_shop, id_lang, content)
            VALUES '.implode(', ', $rows).' ON DUPLICATE KEY UPDATE content = VALUES(content)
        ');
    }
    return true;
}
