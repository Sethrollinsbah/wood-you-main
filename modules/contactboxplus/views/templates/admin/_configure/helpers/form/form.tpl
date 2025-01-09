{*
* 2007-2015 PrestaShop
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2020 Chimon Sultan
*  @license    All right reserved
*}

{extends file="helpers/form/form.tpl"}

{block name="input_row"}
    {if $input.type == 'cbp_fields'}
        <div class="row">
            <script type="text/javascript">
                var come_from = "{$name_controller|escape:'htmlall':'UTF-8'}";
                var token = "{$token|escape:'htmlall':'UTF-8'}";
                var alternate = 1;
            </script>
            {assign var=cbp_fields_positions value=$input.values}
            {if isset($cbp_fields_positions) && count($cbp_fields_positions) > 0}
                {foreach $cbp_fields_positions as $key => $cbp_fields_position}
                    <div class="col-lg-12">
                        <div class="panel">
                            <div class="panel-heading">
                                {l s='Custom fields' mod='contactboxplus'}

                            </div>
                            <table class="table tableDnD cms" id="table-module-contactboxplus">
                                <thead>
                                <tr class="nodrag nodrop">
                                    <th>{l s='ID' mod='contactboxplus'}</th>
                                    <th>{l s='Label' mod='contactboxplus'}</th>
                                    <th>{l s='Description' mod='contactboxplus'}</th>
                                    <th>{l s='Position' mod='contactboxplus'}</th>
                                    <th>{l s='Status' mod='contactboxplus'}</th>
                                    <th>{l s='Is name' mod='contactboxplus'}</th>
                                    <th>{l s='Is e-mail' mod='contactboxplus'}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                {foreach $cbp_fields_position as $key => $cbp_field}
                                    <tr class="{if $key|escape:'htmlall':'UTF-8'%2}alt_row{else}not_alt_row{/if} row_hover"
                                        id="tr_{$key|escape:'htmlall':'UTF-8'%2}_{$cbp_field['id_cbp_field']|escape:'htmlall':'UTF-8'}_{$cbp_field['position']|escape:'htmlall':'UTF-8'}">
                                        <td>{$cbp_field['id_cbp_field']|escape:'htmlall':'UTF-8'}</td>
                                        <td>{$cbp_field['label']|escape:'htmlall':'UTF-8'}</td>
                                        <td>{$cbp_field['description']|escape:'htmlall':'UTF-8'}</td>
                                        <td class="center pointer dragHandle"
                                            id="td_{$key|escape:'htmlall':'UTF-8'%2}_{$cbp_field['id_cbp_field']|escape:'htmlall':'UTF-8'}">
                                            <div class="dragGroup">
                                                <div class="positions">
                                                    {$cbp_field['position']|escape:'htmlall':'UTF-8' + 1}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {if $cbp_field['enabled'] == 1}
                                                <i class="icon-check"></i>
                                            {else}
                                                <i class="icon-remove"></i>
                                            {/if}
                                        </td>
                                        <td>
                                            {if $cbp_field['iscustomername'] == 1}
                                                <i class="icon-check"></i>
                                            {else}
                                                <i class="icon-remove"></i>
                                            {/if}
                                        </td>

                                        <td>
                                            {if $cbp_field['iscustomeremail'] == 1}
                                                <i class="icon-check"></i>
                                            {else}
                                                <i class="icon-remove"></i>
                                            {/if}
                                        </td>
                                        <td>
                                            <div class="btn-group-action">
                                                <div class="btn-group pull-right">
                                                    <a class="btn btn-default"
                                                       href="{$current|escape:'htmlall':'UTF-8'}&amp;token={$token|escape:'htmlall':'UTF-8'}&amp;editcontactboxplus&amp;id_cbp_field={(int)$cbp_field['id_cbp_field']|escape:'htmlall':'UTF-8'}"
                                                       title="{l s='Edit' mod='contactboxplus'}">
                                                        <i class="icon-edit"></i> {l s='Edit' mod='contactboxplus'}
                                                    </a>
                                                    <button class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <i class="icon-caret-down"></i>&nbsp;
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{$current|escape:'htmlall':'UTF-8'}&amp;token={$token|escape:'htmlall':'UTF-8'}&amp;deletecontactboxplus&amp;id_cbp_field={(int)$cbp_field['id_cbp_field']|escape:'htmlall':'UTF-8'}"
                                                               title="{l s='Delete' mod='contactboxplus'}">
                                                                <i class="icon-trash"></i> {l s='Delete' mod='contactboxplus'}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>
                {/foreach}
            {/if}
        </div>
    {else}
        {$smarty.block.parent}
    {/if}
{/block}
