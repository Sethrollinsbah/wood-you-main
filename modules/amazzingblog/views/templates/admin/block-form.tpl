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

<div class="item clearfix {$block.hook_name|escape:'html':'UTF-8'}" data-id="{$block.id_block|intval}">
<form method="post" action="" class="block-form">
	<input type="hidden" name="id_block" value="{$block.id_block|intval}">
	<input type="hidden" name="active" value="{$block.active|intval}">
	<input type="hidden" name="hook_name" value="{$block.hook_name|escape:'html':'UTF-8'}">
	{include file='./item-header.tpl' item=$block type='block'}
	{if !empty($full)}
	<div class="details clearfix" style="display:none;">
		<div class="block-fields clearfix">
			{foreach $block.editable_fields as $k => $field}
			{if !empty($field.group_begin)}
			<div class="field-group {$field.group_begin|escape:'html':'UTF-8'} clearfix clear-both">{if !empty($field.subtitle)}<div class="field-group-subtitle">{$field.subtitle|escape:'html':'UTF-8'}</div>{/if}
			{/if}
			<div class="field clearfix {$k|escape:'html':'UTF-8'}-field{if !empty($field.class)} {$field.class|escape:'html':'UTF-8'}{/if}">
	            <label class="field-label">
					<span>
						{if !empty($field.tooltip)}<span class="label-tooltip" data-toggle="tooltip" title="{$field.tooltip|escape:'html':'UTF-8'}">{/if}
						{$field.display_name} {* can not be escaped, because of html entities like lt *}
						{if !empty($field.tooltip)}</span>{/if}
					</span>
				</label>
				<div class="field-value">
					{if empty($field.multilang)}
						{include file="./field.tpl" field=$field k=$k settings_identifier='block'}
					{else}
						{include file="./multilang-field.tpl" field=$field k=$k settings_identifier='block'}
					{/if}
					{if !empty($field.input_class) && $field.input_class|strstr:'has-additional-settings'}
						<button type="button" class="btn btn-primary toggleSettings" data-settings="{$k|escape:'html':'UTF-8'}"><i class="icon-wrench"></i></button>
					{/if}
				</div>
			</div>
			{if !empty($field.group_end)}
			</div>
			{/if}
			{/foreach}
		</div>
		<div class="item-footer block-footer clearfix">
			<button type="button" class="btn btn-default save"><i class="icon-save"></i> {l s='Save block' mod='amazzingblog'}</button>
			<button class="btn btn-default save dont-scroll-up"><i class="icon-save"></i> {l s='Save and stay' mod='amazzingblog'}</button>
		</div>
	</div>
	{/if}
</form>
</div>
{* since 1.3.0 *}
