{*
* 2007-2018 Andrey & co
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0).
*
*  @author    Andrey <byalonovich@bk.ru>
*  @copyright 2015-2020 Andrey & co
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}
<div id="fontellico-all">
<input id="icon-search-popup" placeholder="{l s='Search' mod='fontellico'}"/>
<button class="btn btn-default" id="add-icons-modal" data-dismiss="modal">{l s='Add icons' mod='fontellico'}</button>
{if !empty($iconsall)}
		{foreach name=iconsall from=$iconsall item=icon}
			<span data-uid="{$icon.uid|escape:'html':'UTF-8'}" data-code="{$icon.code|escape:'html':'UTF-8'}" data-css="{$icon.css|escape:'html':'UTF-8'}" data-src="{$icon.src|escape:'html':'UTF-8'}" class="ft-{$icon.css|escape:'html':'UTF-8'}"></span>
		{/foreach}
{/if}
</div>