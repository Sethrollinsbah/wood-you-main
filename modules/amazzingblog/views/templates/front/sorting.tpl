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

<form class="sorting clearfix">
	{l s='Sort by' mod='amazzingblog'}:
	<div class="inline-block">
		<select name="order_by" class="order-by">
			{foreach $sorting_options as $k => $o}
				<option value="{$k|escape:'html':'UTF-8'}" class="{if $k == 'position'} position-option hidden{/if}{if $k == 'comments'} user-comments{/if}"{if $k == $order_by} selected{/if}>{$o|escape:'html':'UTF-8'}</option>
			{/foreach}
		</select>
	</div>
	{$way_options = ['DESC' => 'icon-long-arrow-down', 'ASC' => 'icon-long-arrow-up']}
	{foreach $way_options as $value => $icon_class}
		<a href="#" class="order-way-label{if $order_way == $value} active{/if}" data-way="{$value|escape:'html':'UTF-8'}">
			<i class="{$icon_class|escape:'html':'UTF-8'}"></i>
		</a>
	{/foreach}
	<input type="hidden" name="order_way" value="{$order_way|escape:'html':'UTF-8'}" class="order-way">
</form>
{* since 1.2.0 *}
