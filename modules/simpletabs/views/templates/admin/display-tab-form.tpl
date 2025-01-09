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
<div id="simpletabs-form" class="m-t-3">
    <h2>{l s='Add or modify a tab' mod='simpletabs'}</h2>

    <div class="row form-group">
        <div class="col-lg-3">
            <label class="form-control-label required">{l s='Title' mod='simpletabs'}</label>
        </div>
        <div class="col-lg-8">
            <div class="translations tabbable" id="simpletabs-title">
                <div class="translationsFields tab-content">
                    {foreach $languages as $language}
                    <div class="translationsFields-simpletabs-title_{$language['id_lang']|intval} tab-pane translation-label-{$language['iso_code']|escape:'html':'UTF-8'}{if $language['id_lang'] == $default_form_language} active{/if}">
                        <input type="text" id="simpletabs-title_{$language['id_lang']|intval}" name="simpletabs_title_{$language['id_lang']|intval}" placeholder="{l s='Enter tab title' mod='simpletabs'}" class="simpletabs-title edit js-edit form-control{if $language['id_lang'] == $default_form_language} default{/if}" value="{if isset($values[$language['id_lang']]) && isset($values['title'][$language['id_lang']])}{$values['title'][$language['id_lang']]|escape:'html':'UTF-8'}{/if}" data-warning="{l s='Tab title field (%s) is required' sprintf=$language['iso_code']|escape:'html':'UTF-8' mod='simpletabs'}">
                    </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-3">
            <label class="form-control-label">{l s='Content' mod='simpletabs'}</label>
        </div>
        <div class="col-lg-8">
            <div class="translations tabbable" id="simpletabs-content">
                <div class="translationsFields tab-content">
                    {foreach $languages as $language}
                    <div class="translationsFields-simpletabs-content_{$language['id_lang']|intval} tab-pane translation-label-{$language['iso_code']|escape:'html':'UTF-8'}{if $language['id_lang'] == $default_form_language} active{/if}">
                        <textarea id="simpletabs-content_{$language['id_lang']|intval}" name="simpletabs_content_{$language['id_lang']|intval}" class="simpletabs-content autoload_rte form-control" aria-hidden="true">{if isset($values[$language['id_lang']]) && isset($values['title'][$language['id_lang']])}{$values['title'][$language['id_lang']]|escape:'html':'UTF-8'}{/if}</textarea>
                    </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-3">
            <label class="form-control-label">{l s='Enabled' mod='simpletabs'}</label>
        </div>
        <div class="col-lg-8">
            <div class="radio">
                <label><input type="radio" id="simpletabs-status-on" class="simpletabs-status" name="simpletabs_status" value="1"{if !isset($values.status) || $values.status == 1} checked="checked"{/if}>{l s='Yes' mod='simpletabs'}</label>
            </div>
            <div class="radio">
                <label><input type="radio" id="simpletabs-status-off" class="simpletabs-status" name="simpletabs_status" value="0"{if isset($values.status) && $values.status == 0} checked="checked"{/if}>{l s='No' mod='simpletabs'}</label>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-3">
            <label class="control-label">{l s='Additional products' mod='simpletabs'}</label>
        </div>
        <div class="col-lg-8">
            {$product_list}{* Cannot be escaped *}
        </div>

        <div class="alert alert-info col-lg-8 col-lg-offset-3" role="alert">
            <i class="material-icons">help</i><p class="alert-text">{l s='Select additional products this tab will be assigned to' mod='simpletabs'}</p>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-3">
            <label class="control-label">{l s='Additional categories' mod='simpletabs'}</label>
        </div>
        <div class="col-lg-8">
            {$categories}{* Cannot be escaped *}
        </div>

        <div class="alert alert-info col-lg-8 col-lg-offset-3" role="alert">
            <i class="material-icons">help</i><p class="alert-text">{l s='This tab will be assigned to all products in selected categories' mod='simpletabs'}</p>
        </div>
    </div>

    <button type="reset" name="ResetBtn" id="ResetBtn" onclick="$('#simpletabs-new-tab').click();" class="btn btn-action">{l s='Cancel' mod='simpletabs'}</button>

    <input id="simpletabs-id-tab" type="hidden" name="simpletabs_id_tab" value="" />
    <input id="simpletabs-submit" type="hidden" name="simpletabs_submit" value="" />
</div>