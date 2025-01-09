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

{if empty($group_class)}{$group_class = 'form-group clearfix'}{/if}
{if empty($label_class)}{$label_class = 'control-label col-lg-3'}{/if}
{if empty($input_wrapper_class)}{$input_wrapper_class = 'col-lg-3'}{/if}
{if empty($input_class)}{$input_class = ''}{/if}

<div class="{$group_class|escape:'html':'UTF-8'} {$name|escape:'html':'UTF-8'}">
	<label class="{$label_class|escape:'html':'UTF-8'}">
		<span{if !empty($field.tooltip)} class="label-tooltip" data-toggle="tooltip" title="{$field.tooltip|escape:'html':'UTF-8'}"{/if}>
			{$field.label|escape:'html':'UTF-8'}
		</span>
	</label>
	<div class="input-field {$input_wrapper_class|escape:'html':'UTF-8'}{if !empty($field.multilang)} has_tail{/if}">
		{if !empty($field.input_class)}{$input_class = $input_class|cat:' '|cat:$field.input_class}{/if}
		{if isset($field.switcher)}
			{$id = Tools::str2url($input_name)|cat:'-'|cat:$form_identifier} {* some names may contain square brackets *}
			<span class="switch prestashop-switch {$input_class|escape:'html':'UTF-8'}">
				<input type="radio" id="{$id|escape:'html':'UTF-8'}" name="{$input_name|escape:'html':'UTF-8'}" value="1"{if !empty($field.value)} checked{/if} >
				<label for="{$id|escape:'html':'UTF-8'}">{l s='Yes' mod='testimonialswithavatars'}</label>
				<input type="radio" id="{$id|escape:'html':'UTF-8'}_0" name="{$input_name|escape:'html':'UTF-8'}" value="0"{if empty($field.value)} checked{/if} >
				<label for="{$id|escape:'html':'UTF-8'}_0">{l s='No' mod='testimonialswithavatars'}</label>
				<a class="slide-button btn"></a>
			</span>
		{else if isset($field.options)}
			<select class="{$input_class|escape:'html':'UTF-8'}" name="{$input_name|escape:'html':'UTF-8'}">
				{foreach $field.options as $i => $opt}
					<option value="{$i|escape:'html':'UTF-8'}"{if $field.value == $i} selected{/if}>{$opt|escape:'html':'UTF-8'}</option>
				{/foreach}
			</select>
		{else}
			{if !empty($field.multilang)}
				{foreach $languages as $id_lang => $lang}
					{$value = ''}{if isset($field.value.$id_lang)}{$value = $field.value.$id_lang}{/if}
					<input type="text" name="{$input_name|escape:'html':'UTF-8'}[{$lang.id_lang|intval}]" class="multilang lang-{$lang.id_lang|intval}{if empty($lang.current)} hidden{/if}" value="{$value|escape:'html':'UTF-8'}">
				{/foreach}
				<div class="multilang-selector">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						{foreach $languages as $id_lang => $lang}
							<span class="multilang lang-{$id_lang|intval}{if empty($lang.current)} hidden{/if}">{$lang.iso_code|escape:'html':'UTF-8'}</span>
						{/foreach}
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						{foreach $languages as $id_lang => $lang}
							<li><a href="#" class="selectLanguage" data-lang="{$id_lang|intval}">{$lang.name|escape:'html':'UTF-8'}</a></li>
						{/foreach}
					</ul>
				</div>
			{else}
				<input type="text" name="{$input_name|escape:'html':'UTF-8'}" value="{$field.value|escape:'html':'UTF-8'}" class="{$input_class|escape:'html':'UTF-8'}">
			{/if}
		{/if}
	</div>
</div>
{* since 2.5.0 *}
