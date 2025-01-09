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
<table id="table-product" class="table product">
    <thead>
        <tr class="nodrag nodrop">
            <th></th>
            <th class="left">
                <span class="title_box">{l s='ID' mod='simpletabs'}</span>
            </th>
            <th class="left">
                <span class="title_box">{l s='Name' mod='simpletabs'}</span>
            </th>
        </tr>
    </thead>
    <tbody>
    {foreach $products as $product}
        <tr>
            <td class="row-selector text-center">
                <input id="simpletabs-product-{$product.id_product|intval}" type="checkbox" name="simpletabs_productBox[]" value="{$product.id_product|intval}" noborder"{if $product.status > 0}checked="checked"{/if}>
            </td>
            <td class="left">
                {$product.id_product|intval}
            </td>
            <td class="left">
                {$product.name|escape:'html':'UTF-8'}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>
<div class="panel-footer">
    <div class="btn-group bulk-actions dropup">
        <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown">
            Bulk actions <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a href="#" onclick="javascript:checkDelBoxes($(this).closest('form').get(0), 'simpletabs_productBox[]', true);return false;">
                    <i class="icon-check-sign"></i>&nbsp;{l s='Select All' mod='simpletabs'}
                </a>
            </li>
            <li>
                <a href="#" onclick="javascript:checkDelBoxes($(this).closest('form').get(0), 'simpletabs_productBox[]', false);return false;">
                    <i class="icon-check-empty"></i>&nbsp;{l s='Unselect All' mod='simpletabs'}
                </a>
            </li>
        </ul>
    </div>
</div>