{*
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
*}
<h2>{l s='Tabs' mod='simpletabs'}</h2>
{$tab_list}{* Cannot be escaped *}
{$tab_form}{* Cannot be escaped *}

<script type="text/javascript">
    var simpletabs_dir = '{$module_dir|escape:"html":"UTF-8"}',
        iso = '{$iso|escape:"htmlall":"UTF-8"}',
        pathCSS = '{$path_css|escape:"htmlall":"UTF-8"}',
        ad = '{$admin_dir|escape:"htmlall":"UTF-8"}',
        secure_key = '{$secure_key|escape:"html":"UTF-8"}',
        id_product = '{$id_product|intval}';
</script>
<script type="text/javascript" src="{$module_dir|escape:'html':'UTF-8'}views/js/back.js" ></script>