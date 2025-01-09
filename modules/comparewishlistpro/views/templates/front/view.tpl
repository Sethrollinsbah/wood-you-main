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

{extends file='page.tpl'}

{block name='page_title'}
  {l s='Wishlist' mod='comparewishlistpro'}
{/block}

{block name='page_content'}
  <div id="view_wishlist">
    {if $wishlists}
    <p>
      {l s='Other wishlists of %1s %2s:' sprintf=[$current_wishlist.firstname, $current_wishlist.lastname] mod='comparewishlistpro'}
      {foreach from=$wishlists item=wishlist name=i}
        {if $wishlist.id_wishlist != $current_wishlist.id_wishlist}
          <a href="{$link->getModuleLink('comparewishlistpro', 'view', ['token' => $wishlist.token])|escape:'html':'UTF-8'}" title="{$wishlist.name|escape:'html':'UTF-8'}" rel="nofollow">{$wishlist.name|escape:'html':'UTF-8'}</a>
          {if !$smarty.foreach.i.last}
            /
          {/if}
        {/if}
      {/foreach}
    </p>
    {/if}

    {if !empty($products)}
    <h2>{l s='Products' mod='comparewishlistpro'}</h2>

    <div class="wlp_bought">
      <ul class="clearfix wlp_bought_list">
        {foreach from=$products item=product name=i}
          <li id="wlp_{$product.id_product|intval}_{$product.id_product_attribute|intval}" class="clearfix address {if $smarty.foreach.i.index % 2}alternate_{/if}item">
            <div class="clearfix">
              <div class="product_image">
                <a href="{$link->getProductlink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html':'UTF-8'}" title="{l s='Product detail' mod='comparewishlistpro'}">
                  <img src="{$link->getImageLink($product.link_rewrite, $product.cover, ImageType::getFormatedName('home'))|escape:'html':'UTF-8'}" alt="{$product.name|escape:'html':'UTF-8'}" />
                </a>
              </div>
              <div class="product_infos">
                <h3 id="s_title" class="product_name">{$product.name|truncate:30:'...'|escape:'html':'UTF-8'}</h3>
              <span class="wishlist_product_detail">
              {if isset($product.attributes_small)}
                <a href="{$link->getProductlink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html':'UTF-8'}" title="{l s='Product detail' mod='comparewishlistpro'}">{$product.attributes_small|escape:'html':'UTF-8'}</a>
              {/if}
                <br />{l s='Quantity' mod='comparewishlistpro'}:<input type="text" id="quantity_{$product.id_product|intval}_{$product.id_product_attribute|intval}" value="{$product.quantity|intval}" size="3"  />
                <br /><br />
                <span><strong>{l s='Priority' mod='comparewishlistpro'}:</strong> {$product.priority_name|escape:'html':'UTF-8'}</span>
              </span>
              </div>
            </div>
            <div class="btn_action">
              {if (isset($product.attribute_quantity) && $product.attribute_quantity >= 1) || (!isset($product.attribute_quantity) && $product.product_quantity >= 1) || $product.allow_oosp}
                <form id="addtocart_{$product.id_product|intval}_{$product.id_product_attribute|intval}" action="{$link->getPageLink('cart')|escape:'html':'UTF-8'}" method="post">
                  <input type="hidden" name="id_product" value="{$product.id_product|intval}" id="product_page_product_id"  />
                  <input type="hidden" name="add" value="1" />
                  <input type="hidden" name="token" value="{$token|escape:'html':'UTF-8'}" />
                  <input type="hidden" name="id_product_attribute" id="idCombination" value="{$product.id_product_attribute|intval}" />
                </form>
                <a href="javascript:;" class="btn btn-primary exclusive" onclick="compareWishlistPro.WishlistBuyProduct('{$token|escape:'html':'UTF-8'}', '{$product.id_product|intval}', '{$product.id_product_attribute|intval}', '{$product.id_product|intval}_{$product.id_product_attribute|intval}', this, {$ajax|intval});" title="{l s='Add to cart' mod='comparewishlistpro'}" rel="nofollow"><i class="material-icons shopping-cart"></i> {l s='Add to cart' mod='comparewishlistpro'}</a>
              {else}
                <button class="btn btn-primary exclusive" type="button" disabled="disabled">{l s='Add to cart' mod='comparewishlistpro'}</button>
              {/if}
              <a class="btn btn-secondary button_small clear" href="{$link->getProductLink($product.id_product,  $product.link_rewrite, $product.category_rewrite)|escape:'html':'UTF-8'}" title="{l s='View' mod='comparewishlistpro'}" rel="nofollow">{l s='View' mod='comparewishlistpro'}</a>
            </div>
          </li>
        {/foreach}
      </ul>
    </div>
    {else}
    <p>{l s='This wishlist is currently empty.' mod='comparewishlistpro'}</p>
    {/if}
  </div>
{/block}
