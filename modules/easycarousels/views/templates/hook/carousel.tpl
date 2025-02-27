{**
*
* @author    Amazzing <mail@amazzing.ru>
* @copyright 2007-2018 Amazzing
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*
**}

<div id="{$carousel.identifier|escape:'html':'UTF-8'}" class="easycarousel {$carousel.settings.tpl.custom_class|escape:'html':'UTF-8'}{if $in_tabs} ec-tab-pane{else} carousel_block{/if}{if !empty($custom_class)} {$custom_class|escape:'html':'UTF-8'}{/if}{if $is_17 && empty($carousel.name) && $carousel.settings.carousel.n} nav_without_name{/if}">
	{if !$in_tabs && !empty($carousel.name)}
		<h3 class="title_block carousel_title">{$carousel.name|escape:'html':'UTF-8'}</h3>
	{/if}
	{if !empty($carousel.description)}<div class="carousel-description">{$carousel.description nofilter}{* can not be escaped *}</div>{/if}
	{$c_settings = $carousel.settings.carousel}
	<div class="block_content{if $c_settings.type == 2} scroll-x-wrapper{/if}">
		<div class="c_container{if empty($c_settings.type)} simple-grid xl-{$c_settings.i|intval} l-{$c_settings.i_1200|intval} m-{$c_settings.i_992|intval} s-{$c_settings.i_768|intval} xs-{$c_settings.i_480|intval} clearfix{else if $c_settings.type == 1} carousel{else if $c_settings.type == 2} scroll-x{/if}" data-settings="{$c_settings|json_encode|escape:'html':'UTF-8'}">
			{$total = $carousel.items|count}
			{foreach array_values($carousel.items) as $k => $column_items}
				{* div from previous iteration is closed here in order to remove spaces among items *}
				{if $k}</div>{/if}<div class="c_col">
					{foreach $column_items as $i}
						<div class="c_item">
							{$type = $carousel.type}
							{if $type != 'suppliers' && $type != 'manufacturers' && $type != 'categories' && $type != 'subcategories'}
								{include file=$product_item_tpl product=$i settings=$carousel.settings.tpl}
							{else}
								{include file=$item_tpl item=$i type=$type settings=$carousel.settings.tpl}
							{/if}
						</div>
					{/foreach}
				{if $k + 1 == $total}</div>{/if}{* only last div is closed here *}
			{/foreach}
		</div>
	</div>
	{if !empty($carousel.view_all_link)}
		<div class="text-center">
			<a href="{$carousel.view_all_link|escape:'html':'UTF-8'}" class="view_all">{l s='View all' mod='easycarousels'}</a>
		</div>
	{/if}
</div>
{* since 2.5.1 *}
