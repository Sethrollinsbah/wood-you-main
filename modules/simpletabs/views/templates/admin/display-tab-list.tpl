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
<div id="simpletabs-list">
    <table class="table table-striped">
        <thead>
            <tr class="text-uppercase">
                <th class="text-xs-center">
                    <span class="title_box">{l s='ID' mod='simpletabs'}</span>
                </th>
                <th>
                    <span class="title_box">{l s='Title' mod='simpletabs'}</span>
                </th>
                <th>
                    <span class="title_box">{l s='Content' mod='simpletabs'}</span>
                </th>
                <th class="text-xs-center">
                    <span class="title_box">{l s='Status' mod='simpletabs'}</span>
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {foreach $tab_list as $tab}
            <tr id="simpletabs-tab-{$tab.id_tab|intval}">
                <td class="text-xs-center">
                    {$tab.id_tab|intval}
                </td>
                <td>
                    {$tab.title|escape:'html':'UTF-8'}
                </td>
                <td>
                    {$tab.content|strip_tags:true|truncate:100:'...'|escape:'html':'UTF-8'}
                </td>
                <td class="text-xs-center">
                    <i class="material-icons">{if $tab.status == 1}check{else}clear{/if}</i>
                </td>
                <td class="text-xs-center attribute-actions">
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="#simpletabs-form" class="simpletabs-edit btn btn-open btn-invisible btn-sm" data-id-tab="{$tab.id_tab|intval}"><i class="material-icons">mode_edit</i></a>
                        <a href="#" class="simpletabs-delete btn btn-open btn-invisible btn-sm" data-id-tab="{$tab.id_tab|intval}" data-confirmation="{l s='Delete tab "%s"?' sprintf=$tab.title|escape:'html':'UTF-8' mod='simpletabs'}"><i class="material-icons">delete</i></a>
                    </div>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>

    <div class="panel-footer">
        <div class="pull-right">
            <a id="simpletabs-new-tab" class="btn btn-action" href="#"><i class="material-icons">add_circle</i> <span data-label-add="{l s='New tab' mod='simpletabs'}" data-label-cancel="{l s='Cancel editing' mod='simpletabs'}">{l s='New tab' mod='simpletabs'}</span></a>
            <button id="simpletabs-submit-button" class="btn btn-primary btn-submit" type="submit" value="1" name="submitAddproduct" disabled="disabled" data-redirect="">{l s='Save tab' mod='simpletabs'}</button>
        </div>
    </div>
</div>