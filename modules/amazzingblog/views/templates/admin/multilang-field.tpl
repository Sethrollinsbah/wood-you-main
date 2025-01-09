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


{$type = 'text'}{if !empty($field.type)}{$type = $field.type}{/if}
{$name = $k}{if !empty($field.input_name)}{$name = $field.input_name}{/if}

<div class="multilang-wrapper">
{foreach $languages as $lang}
	{$id_lang = $lang.id_lang}
	{$value = ''}
	{if !empty($field.value)}
		{if (!is_array($field.value))}
			{$value = $field.value}
		{else if !empty($field.value.$id_lang)}
			{$value = $field.value.$id_lang}
		{/if}
	{/if}
	<div class="multilang lang-{$id_lang|intval}{if $id_lang != $id_lang_current} hidden{/if}{if !$value} empty{/if}" data-lang="{$id_lang|intval}">
		{if $type == 'mce'}
			{$id = $field.type|cat:'-'|cat:$id_lang|cat:'-'|cat:uniqid()}
			<textarea id="{$id|escape:'html':'UTF-8'}" name="{$name|escape:'html':'UTF-8'}[{$id_lang|intval}]" class="{$k|escape:'html':'UTF-8'} mce">{$value|escape:'html':'UTF-8'}</textarea>
		{else}
			<input type="text" name="{$name|escape:'html':'UTF-8'}[{$id_lang|intval}]" value="{$value|escape:'html':'UTF-8'}" class="{$k|escape:'html':'UTF-8'}{if !empty($field.input_class)} {$field.input_class|escape:'html':'UTF-8'}{/if}">
		{/if}
	</div>
{/foreach}
	<div class="multilang-selector pull-right">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			{foreach from=$languages item=lang}
				<span class="multilang lang-{$lang.id_lang|intval}{if $lang.id_lang != $id_lang_current} hidden{/if}">{$lang.iso_code|escape:'html':'UTF-8'}</span>
			{/foreach}
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			{foreach from=$languages item=lang}
			<li>
				<a href="#" onclick="event.preventDefault(); selectLanguage($(this), {$lang.id_lang|intval})">
					{$lang.name|escape:'html':'UTF-8'}
				</a>
			</li>
			{/foreach}
		</ul>
	</div>
</div>
{* since 1.2.0 *}
