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

{if ($comparison_enabled == 1 && $comparison_product_pages_enabled == 1) || ($wishlists_enabled == 1 && $wishlists_product_pages_enabled == 1)}
<div class="easywishlist-action-buttons{if $appearance == 'icon'} icon-only{/if}">
  {if $comparison_enabled == 1 && $comparison_product_pages_enabled == 1}
  <button class="btn btn-primary add-product-to-comparison{if in_array($id_product, $comparison_products)} easywishlist-active{/if}" type="button" data-id-product="{$id_product|intval}" data-product-name="{$product_name|escape:'html':'UTF-8'}" data-preview="{$image_preview|escape:'html':'UTF-8'}" data-label-add="{l s='Compare product' mod='comparewishlistpro'}" data-label-remove="{l s='Remove from comparison' mod='comparewishlistpro'}">{if $appearance == 'all' || $appearance == 'icon'}{include file="./comparison-icon.tpl"}{/if} {if $appearance == 'all' || $appearance == 'text'}<span id="comparison-button-label">{if in_array($id_product, $comparison_products)}{l s='Remove from comparison' mod='comparewishlistpro'}{else}{l s='Compare product' mod='comparewishlistpro'}{/if}</span>{/if}</button>
  {/if }

  {if $wishlists_enabled == 1 && $wishlists_product_pages_enabled == 1}
    {if isset($wishlists) && count($wishlists) > 1}
    <div class="buttons_bottom_block no-print">
      <div class="wishlist-button-container">
        <select id="idWishlist">
          {foreach $wishlists as $wishlist}
            <option value="{$wishlist.id_wishlist|intval}"{if $wishlist.default == 1} selected="selected"{/if}>{$wishlist.name|escape:'html':'UTF-8'}</option>
          {/foreach}
        </select>
        <button class="btn btn-primary add-product-to-wishlist{if in_array($id_product, $wishlists_products)} easywishlist-active{/if}" type="button" data-id-product="{$id_product|intval}" data-product-name="{$product_name|escape:'html':'UTF-8'}" data-preview="{$image_preview|escape:'html':'UTF-8'}" data-label-add="{l s='Add to wishlist' mod='comparewishlistpro'}" data-label-remove="{l s='Remove from wishlist' mod='comparewishlistpro'}">{if $appearance == 'all' || $appearance == 'icon'}{if in_array($id_product, $wishlists_products)}{include file="./wishlist-icon-active.tpl"}{else}{include file="./wishlist-icon.tpl"}{/if}{/if}{if $appearance == 'all' || $appearance == 'text'}<span id="wishlist-button-label">{if in_array($id_product, $wishlists_products)}{l s='Remove from wishlist' mod='comparewishlistpro'}{else}{l s='Add to wishlist' mod='comparewishlistpro'}{/if}</span>{/if}</button>
      </div>
    </div>
    {else}
    <div class="buttons_bottom_block no-print">
      <a class="btn btn-primary add-product-to-wishlist{if in_array($id_product, $wishlists_products)} easywishlist-active{/if}" href="#" rel="nofollow" data-id-product="{$id_product|intval}" data-product-name="{$product_name|escape:'html':'UTF-8'}" data-preview="{$image_preview|escape:'html':'UTF-8'}" data-label-add="{l s='Add to wishlist' mod='comparewishlistpro'}" data-label-remove="{l s='Remove from wishlist' mod='comparewishlistpro'}">{if $appearance == 'all' || $appearance == 'icon'}{if in_array($id_product, $wishlists_products)}{include file="./wishlist-icon-active.tpl"}{else}{include file="./wishlist-icon.tpl"}{/if}{/if}{if $appearance == 'all' || $appearance == 'text'}<span id="wishlist-button-label">{if in_array($id_product, $wishlists_products)}{l s='Remove from wishlist' mod='comparewishlistpro'}{else}{l s='Add to wishlist' mod='comparewishlistpro'}{/if}</span>{/if}</a>
    </div>
    {/if}
    <div class="wishlist-icons wishlist-hidden">
      {include file="./wishlist-icon.tpl"}
      {include file="./wishlist-icon-active.tpl"}
    </div>
  {/if}
</div>
{/if}
