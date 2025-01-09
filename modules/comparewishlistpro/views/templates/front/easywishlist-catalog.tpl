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

<div class="easywishlist-catalog-buttons wishlist-hidden{if $icons_on_hover == 1} icons-on-hover{/if}">
  {if $comparison_enabled == 1 && $comparison_catalog_enabled == 1}
  <button class="add-product-to-comparison easywishlist-button-icon{if in_array($id_product, $comparison_products)} easywishlist-active{/if}" type="button" title="{l s='Add product to comparison' mod='comparewishlistpro'}" data-id-product="{$id_product|intval}" data-product-name="{$product_name|escape:'html':'UTF-8'}" data-preview="{$image_preview|escape:'html':'UTF-8'}">{include file="./comparison-icon.tpl"}</button>
  {/if }

  {if $wishlists_enabled == 1 && $wishlists_catalog_enabled == 1}
    {*if isset($wishlists) && count($wishlists) > 1}
    <div class="buttons_bottom_block no-print">
      <div class="wishlist-button-container">
        <select class="existing-wishlists">
          {foreach $wishlists as $wishlist}
            <option value="{$wishlist.id_wishlist}"{if $wishlist.default == 1} selected="selected"{/if}>{$wishlist.name}</option>
          {/foreach}
        </select>
        <button class="btn btn-secondary" type="button" onclick="compareWishlistPro.WishlistCart('wishlist_block_list', 'add', '{$id_product|intval}', 0, 1, $(this).parent().find('.existing-wishlists').val()); return false;" title="{l s='Add to wishlist' mod='comparewishlistpro'}">
          {l s='Add to selected wishlist' mod='comparewishlistpro'}
        </button>
      </div>
    </div>
    {else*}
    <div class="buttons_bottom_block no-print">
      <a class="add-product-to-wishlist easywishlist-button-icon{if in_array($id_product, $wishlists_products)} easywishlist-active{/if}" href="#" data-id-product="{$id_product|intval}" data-product-name="{$product_name|escape:'html':'UTF-8'}" data-preview="{$image_preview|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to wishlist' mod='comparewishlistpro'}">
        {if in_array($id_product, $wishlists_products)}{include file="./wishlist-icon-active.tpl"}{else}{include file="./wishlist-icon.tpl"}{/if}
      </a>
    </div>
    {*/if*}
    <div class="wishlist-icons wishlist-hidden">
      {include file="./wishlist-icon.tpl"}
      {include file="./wishlist-icon-active.tpl"}
    </div>
  {/if}
</div>
