{*
* 2007-2018 Amazzing
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
*
*  @author    Amazzing <mail@amazzing.ru>
*  @copyright 2007-2018 Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*
*}

{if empty($group_class)}{$group_class = 'form-group'}{/if}
{if empty($label_class)}{$label_class = 'control-label col-lg-3'}{/if}
{if empty($input_wrapper_class)}{$input_wrapper_class = 'col-lg-3'}{/if}
{if empty($input_class)}{$input_class = ''}{/if}

<div class="{$group_class|escape:'html':'UTF-8'}">
    <label class="{$label_class|escape:'html':'UTF-8'}">
        <span{if !empty($field.tooltip)} class="label-tooltip" data-toggle="tooltip" title="{$field.tooltip|escape:'html':'UTF-8'}"{/if}>
            {$field.display_name} {* can not be escaped, because some labels contain html entities *}
        </span>
    </label>
    <div class="{$input_wrapper_class|escape:'html':'UTF-8'}">
        {if !empty($field.input_class)}{$input_class = $input_class|cat:' '|cat:$field.input_class}{/if}
        {if $field.type == 'switcher'}
            {$id = Tools::str2url($name)|cat:'-'|cat:$form_identifier} {* some names may contain square brackets *}
            <span class="switch prestashop-switch {$input_class|escape:'html':'UTF-8'}">
                <input type="radio" id="{$id|escape:'html':'UTF-8'}" name="{$name|escape:'html':'UTF-8'}" value="1"{if !empty($field.value)} checked{/if} >
                <label for="{$id|escape:'html':'UTF-8'}">{l s='Yes' mod='custombanners'}</label>
                <input type="radio" id="{$id|escape:'html':'UTF-8'}_0" name="{$name|escape:'html':'UTF-8'}" value="0"{if empty($field.value)} checked{/if} >
                <label for="{$id|escape:'html':'UTF-8'}_0">{l s='No' mod='custombanners'}</label>
                <a class="slide-button btn"></a>
            </span>
        {else if $field.type == 'select'}
            <select class="{$input_class|escape:'html':'UTF-8'}" name="{$name|escape:'html':'UTF-8'}">
                {foreach $field.options as $i => $opt}
                    <option value="{$i|escape:'html':'UTF-8'}"{if $field.value == $i} selected{/if}>{$opt|escape:'html':'UTF-8'}</option>
                {/foreach}
            </select>
        {else}
            <input type="text" name="{$name|escape:'html':'UTF-8'}" value="{$field.value|escape:'html':'UTF-8'}" class="{$input_class|escape:'html':'UTF-8'}">
        {/if}
    </div>
</div>
