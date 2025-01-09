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

<form method="post" action="" class="settings-form">
	{foreach $settings as $k => $field}
	{if !empty($field.subtitle)}
		<div class="subtitle clear-both">{$field.subtitle|escape:'html':'UTF-8'}</div>
	{/if}
	<div class="field clearfix{if !empty($field.class)} {$field.class|escape:'html':'UTF-8'}{/if}">
		<label class="field-label">
			<span>
				{if !empty($field.tooltip)}<span class="label-tooltip" data-toggle="tooltip" title="{$field.tooltip|escape:'html':'UTF-8'}">{/if}
				{$field.display_name|escape:'html':'UTF-8'}
				{if !empty($field.tooltip)}</span>{/if}
			</span>
		</label>
		<div class="field-value">
		{if empty($field.multilang)}
			{include file="./field.tpl" field=$field k=$k settings_identifier=$type}
		{else}
			{include file="./multilang-field.tpl" field=$field k=$k settings_identifier=$type}
		{/if}
		{if !empty($field.help_box)}
			<div class="help-box">
				{if (!is_array($field.help_box))}{$field.help_box = [$field.help_box]}{/if}
				{foreach $field.help_box as $k => $line}
					{if $k}<br>{/if}{$line|escape:'html':'UTF-8'}.
				{/foreach}
			</div>
		{/if}
		</div>
	</div>
	{if !empty($field.regenerate)}
		<div class="field-additional-block">
			<div class="progress hidden"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0"
			  aria-valuemin="0" aria-valuemax="100" style="width:0%"></div></div>
			<a href="#" class="regenerate-thumbnails" data-type="{$k|escape:'html':'UTF-8'}">{l s='Regenerate' mod='amazzingblog'}</a>
		</div>
	{/if}
	{/foreach}
	<div class="form-footer clear-both">
		<button class="btn btn-default saveSettings" data-type="{$type|escape:'html':'UTF-8'}">
			<i class="process-icon-save icon-save"></i>
			{l s='Save' mod='amazzingblog'}
		</button>
	</div>
</form>
{* since 1.3.0 *}
