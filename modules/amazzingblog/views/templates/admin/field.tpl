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

{if empty($settings_identifier)}{$settings_identifier = uniqid()}{/if}{$id = $k|cat:'_'|cat:$settings_identifier}
{$type = 'text'}{if !empty($field.type)}{$type = $field.type}{/if}
{$name = $k}{if !empty($field.input_name)}{$name = $field.input_name}{/if}
{if !empty($field.options)}
	<select class="{$k|escape:'html':'UTF-8'}{if !empty($field.input_class)} {$field.input_class|escape:'html':'UTF-8'}{/if}" name="{$name|escape:'html':'UTF-8'}">
		{foreach $field.options as $i => $opt}
			<option value="{$i|escape:'html':'UTF-8'}"{if $field.value|cat:'' == $i|cat:''} selected{/if}>{$opt|escape:'html':'UTF-8'}</option>
		{/foreach}
	</select>
{else if $type == 'checkbox'}
	<div class="checkboxes-list">
	{foreach $field.boxes as $i => $label}
		<label class="checkbox-label"><input type="checkbox" name="{$name|escape:'html':'UTF-8'}" value="{$i|escape:'html':'UTF-8'}"{if in_array($i, $field.value)} checked{/if}> {$label|escape:'html':'UTF-8'}</label>
	{/foreach}
	</div>
{else if $type == 'switcher'}
	<span class="switch prestashop-switch">
		<input type="radio" id="{$id|escape:'html':'UTF-8'}" name="{$name|escape:'html':'UTF-8'}" value="1"{if !empty($field.value)} checked{/if} >
		<label for="{$id|escape:'html':'UTF-8'}">{l s='Yes' mod='amazzingblog'}</label>
		<input type="radio" id="{$id|escape:'html':'UTF-8'}_0" name="{$name|escape:'html':'UTF-8'}" value="0"{if empty($field.value)} checked{/if} >
		<label for="{$id|escape:'html':'UTF-8'}_0">{l s='No' mod='amazzingblog'}</label>
		<a class="slide-button btn"></a>
	</span>
{else if $name == 'related_products'}
	{include file='./related-items.tpl' type='product' input_name=$name imploded_ids=$field.value related_items=$field.related_items}
{else}
	<input type="text" name="{$name|escape:'html':'UTF-8'}" value="{$field.value|escape:'html':'UTF-8'}" class="{$k|escape:'html':'UTF-8'}{if !empty($field.input_class)} {$field.input_class|escape:'html':'UTF-8'}{/if}{if $type == 'datepicker'} datepicker{/if}"{if !empty($field.readonly)} readonly{/if}>
{/if}
{* since 1.3.0 *}
