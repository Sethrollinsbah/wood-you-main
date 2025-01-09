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

{if $items}
    {$col = false}{if $settings.display_type == 'grid'}{$col = 12/$settings.col_num}{/if}
	<div class="item-list {$settings.display_type|escape:'html':'UTF-8'}{if $col} row{/if}">
	{if $resource_type == 'product'}{$item_tpl_path = $blog->getTemplatePath('product-list-item.tpl')}{/if}
	{foreach $items as $k => $item}
		<div class="item-wrapper {$resource_type|escape:'html':'UTF-8'}{if $col} col-md-{$col|intval}{if $k % $settings.col_num == 0} first-in-line{/if}{/if}">
			{if !empty($item_tpl_path)}
				{include file = $item_tpl_path item = $item}
			{else}
				<a href="{$item.url|escape:'html':'UTF-8'}">{$item.title|escape:'html':'UTF-8'}</a>
			{/if}
		</div>
	{/foreach}
	</div>
{/if}
{* since 1.3.0 *}
