{*
* 2007-2021 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2021 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if $comparison == 1}
<div class="easywishlist-block-nav d-xs-none d-md-flex">
  <a href="{$product_comparison_page_url|escape:'html':'UTF-8'}" title="{l s='Compare' mod='comparewishlistpro'}">
    {if $appearance == 'all' || $appearance == 'icon'}{include file="./comparison-icon.tpl"}{/if} {if $appearance == 'all' || $appearance == 'text'}<span>{l s='Compare' mod='comparewishlistpro'}</span>{/if}<span class="cwp-count compare-products-count">{$product_comparison_count|intval}</span>
  </a>
</div>
{/if}

{if $wishlists == 1}
{if $wishlist_product_count > 0}
  {$wishlist_icon_hidden = true}
{else}
  {$wishlist_icon_active_hidden = true}
{/if}
<div class="easywishlist-block-nav d-xs-none d-md-flex margin-left-big">
  <a href="{$wishlist_page_url|escape:'html':'UTF-8'}" title="{l s='Wishlist' mod='comparewishlistpro'}">
    {if $appearance == 'all' || $appearance == 'icon'}{include file="./wishlist-icon.tpl"}{include file="./wishlist-icon-active.tpl"}{/if} {if $appearance == 'all' || $appearance == 'text'}<span>{l s='Wishlist' mod='comparewishlistpro'}</span>{/if}<span class="cwp-count wishlist-products-count">{$wishlist_product_count|intval}</span>
  </a>
</div>
{/if}
