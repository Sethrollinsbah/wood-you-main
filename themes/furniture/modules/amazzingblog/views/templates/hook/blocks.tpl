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

<div class="amazzingblog blocks {$hook_name|escape:'html':'UTF-8'}{if $is_column_hook} column-hook{/if}">
{foreach $blocks as $block}
	{$settings = $block.settings}
	{$resource_type = current(explode('_', $settings.type))}
	<div class="ab block {$settings.display_type|escape:'html':'UTF-8'}-view{if !empty($settings.compact)} compact{/if}{if !empty($settings.class)} {$settings.class|escape:'html':'UTF-8'}{/if}" data-id="{$block.id_block|intval}"{if !empty($block.encoded_carousel_settings)} data-carousel-settings="{$block.encoded_carousel_settings|escape:'html':'UTF-8'}"{/if}>
		<div class="block-title">
			<h2 class="{if $is_column_hook} title_block{else} title_main_section{/if}">
			{if $resource_type == 'post' && !$settings.type|strstr:'related' && !empty($settings.all_link)}
				<a href="{$all_link|escape:'html':'UTF-8'}" title="{l s='View all' d='Shop.Theme.Global'}">
			{/if}
				<span>{$block.title|escape:'html':'UTF-8'}</span>
			{if $resource_type == 'post' && !$settings.type|strstr:'related' && !empty($settings.all_link)}
				</a>
			{/if}
			</h2>
		</div>
		<div class="{if $is_column_hook && $settings.display_type != 'carousel'}block_content{/if} {if $settings.display_type == 'carousel'}theme-carousel grid_arrow{/if}">
			{if $resource_type == 'post'}
				{if $settings.display_type == 'presentation'}
					{include file= $blog->getTemplatePath('post-list-presentation.tpl') posts = $block.items settings = $settings}
				{else}
					{include file= $blog->getTemplatePath('post-list.tpl') posts = $block.items settings = $settings no_pagination = true}
				{/if}
			{else}
				{include file= $blog->getTemplatePath('item-list.tpl') items = $block.items settings = $settings}
			{/if}
		</div>
			{if $resource_type == 'post' && !$settings.type|strstr:'related' && !empty($settings.all_link)}
				<div class="text-cente">
					<a class="block-viewall" href="{$all_link|escape:'html':'UTF-8'}" title="{l s='View all' d='Shop.Theme.Global'}">
						{l s='View all' d='Shop.Theme.Global'}
					</a>
				</div>
			{/if}
	</div>
{/foreach}
</div>
{* since 1.3.0 *}
