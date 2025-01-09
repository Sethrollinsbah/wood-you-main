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

{if $products}
  {if !$refresh}
  <div class="wishlistLinkTop">
    <ul class="clearfix display_list">
      <li>
        <a href="#" id="hideWishlist" class="btn btn-secondary button_account" onclick="compareWishlistPro.WishlistVisibility('wishlistLinkTop', 'Wishlist'); return false;" title="{l s='Close wishlist' mod='comparewishlistpro'}" rel="nofollow">{l s='Close wishlist' mod='comparewishlistpro'}</a>
      </li>
      <li>
        <a href="#" id="hideBoughtProducts" class="btn btn-secondary button_account"  onclick="compareWishlistPro.WishlistVisibility('wlp_bought', 'BoughtProducts'); return false;" title="{l s='Hide products' mod='comparewishlistpro'}">{l s='Hide products' mod='comparewishlistpro'}</a>
        <a href="#" id="showBoughtProducts" class="btn btn-secondary button_account"  onclick="compareWishlistPro.WishlistVisibility('wlp_bought', 'BoughtProducts'); return false;" title="{l s='Show products' mod='comparewishlistpro'}">{l s='Show products' mod='comparewishlistpro'}</a>
      </li>
      {if count($productsBoughts)}
      <li>
        <a href="#" id="hideBoughtProductsInfos" class="btn btn-secondary button_account" onclick="compareWishlistPro.WishlistVisibility('wlp_bought_infos', 'BoughtProductsInfos'); return false;" title="{l s="Hide products" mod='comparewishlistpro'}">{l s="Hide bought product info" mod='comparewishlistpro'}</a>
        <a href="#" id="showBoughtProductsInfos" class="btn btn-secondary button_account"  onclick="compareWishlistPro.WishlistVisibility('wlp_bought_infos', 'BoughtProductsInfos'); return false;" title="{l s="Show products" mod='comparewishlistpro'}">{l s="Show bought product info" mod='comparewishlistpro'}</a>
      </li>
      {/if}
    </ul>
  {/if}
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
            <h4 id="s_title" class="product_name"><a href="{$link->getProductlink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html':'UTF-8'}">{$product.name|truncate:30:'...'|escape:'html':'UTF-8'}</a></h4>
            <span class="wishlist_product_detail">
            {if isset($product.attributes_small)}
              <a href="{$link->getProductlink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html':'UTF-8'}" title="{l s='Product detail' mod='comparewishlistpro'}">{$product.attributes_small|escape:'html':'UTF-8'}</a>
            {/if}
              <br />{l s='Quantity' mod='comparewishlistpro'}:<input type="text" id="quantity_{$product.id_product|intval}_{$product.id_product_attribute|intval}" value="{$product.quantity|intval}" size="3"  />
              <br /><br />
              {l s='Priority' mod='comparewishlistpro'}:
              <select id="priority_{$product.id_product|intval}_{$product.id_product_attribute|intval}">
                <option value="0"{if $product.priority eq 0} selected="selected"{/if}>{l s='High' mod='comparewishlistpro'}</option>
                <option value="1"{if $product.priority eq 1} selected="selected"{/if}>{l s='Medium' mod='comparewishlistpro'}</option>
                <option value="2"{if $product.priority eq 2} selected="selected"{/if}>{l s='Low' mod='comparewishlistpro'}</option>
              </select>
              {if $wishlists|count > 1}
                <br /><br />
                {l s='Move' mod='comparewishlistpro'}:
                <br />
                {foreach name=wl from=$wishlists item=wishlist}
                  {if $smarty.foreach.wl.first}
                  <select class="wishlist_change_button">
                    <option>---</option>
                  {/if}
                  {if $id_wishlist != {$wishlist.id_wishlist}}
                    <option title="{$wishlist.name|escape:'html':'UTF-8'}" value="{$wishlist.id_wishlist|intval}" data-id-product="{$product.id_product|intval}" data-id-product-attribute="{$product.id_product_attribute|intval}" data-quantity="{$product.quantity|intval}" data-priority="{$product.priority|intval}" data-id-old-wishlist="{$id_wishlist|intval}" data-id-new-wishlist="{$wishlist.id_wishlist|intval}">{l s='Move to %s'|sprintf:$wishlist.name|escape:'html':'UTF-8' mod='comparewishlistpro'}</option>
                  {/if}
                  {if $smarty.foreach.wl.last}
                  </select>
                  <br />
                  {/if}
                {/foreach}
              {/if}
            </span>
          </div>
        </div>
        <br />
        <div class="btn_action">
          <a href="javascript:;" class="btn btn-primary exclusive lnksave" onclick="compareWishlistPro.WishlistProductManage('wlp_bought_{$product.id_product_attribute|intval}', 'update', '{$id_wishlist|intval}', '{$product.id_product|intval}', '{$product.id_product_attribute|intval}', $('#quantity_{$product.id_product|intval}_{$product.id_product_attribute|intval}').val(), $('#priority_{$product.id_product|intval}_{$product.id_product_attribute|intval}').val());" title="{l s='Save' mod='comparewishlistpro'}">{l s='Save' mod='comparewishlistpro'}</a>
          <a href="javascript:;" class="btn btn-secondary lnkdel" onclick="compareWishlistPro.WishlistProductManage('wlp_bought', 'delete', '{$id_wishlist|intval}', '{$product.id_product|intval}', '{$product.id_product_attribute|intval}', $('#quantity_{$product.id_product|intval}_{$product.id_product_attribute|intval}').val(), $('#priority_{$product.id_product|intval}_{$product.id_product_attribute|intval}').val());" title="{l s='Delete' mod='comparewishlistpro'}">{l s='Delete' mod='comparewishlistpro'}</a>
        </div>
      </li>
    {/foreach}
    </ul>
  </div>
  {if !$refresh}
  <p class="easywishlist-permalink">{l s='Permalink' mod='comparewishlistpro'}: <input id="wishlist-permalink" class="wishlist-permalink" type="text" value="{$link->getModuleLink('comparewishlistpro', 'view', ['token' => $token_wish])|escape:'html':'UTF-8'}" readonly="readonly" title="{l s='Click on the URL to copy it to clipboard' mod='comparewishlistpro'}" /></p>
  <p class="submit">
    <div id="showSendWishlist">
      <a href="#" class="btn btn-secondary button_account exclusive" onclick="compareWishlistPro.WishlistVisibility('wl_send', 'SendWishlist'); return false;" title="{l s='Send this wishlist' mod='comparewishlistpro'}">{l s='Send this wishlist' mod='comparewishlistpro'}</a>
    </div>
  </p>
  <form method="post" class="wl_send std" onsubmit="return (false);" style="display: none;">
    <a id="hideSendWishlist" class="button_account btn icon"  href="#" onclick="compareWishlistPro.WishlistVisibility('wl_send', 'SendWishlist'); return false;" rel="nofollow" title="{l s='Close this wishlist' mod='comparewishlistpro'}">
      <i class="icon-remove"></i>
    </a>
    <fieldset>
      <div class="required row">
        <label for="email1">{l s='Email' mod='comparewishlistpro'} 1 <sup>*</sup></label>
        <input type="text" name="email1" id="email1" />
      </div>
      {section name=i loop=11 start=2}
      <div class="row">
        <label for="email{$smarty.section.i.index|intval}">{l s='Email' mod='comparewishlistpro'} {$smarty.section.i.index|intval}</label>
        <input type="text" name="email{$smarty.section.i.index|intval}" id="email{$smarty.section.i.index|intval}" />
      </div>
      {/section}
      <div class="row"><input class="btn btn-primary" type="submit" value="{l s='Send' mod='comparewishlistpro'}" name="submitWishlist" onclick="compareWishlistPro.WishlistSend('wl_send', '{$id_wishlist|intval}', 'email');" /></div>
      <p class="required"><sup>*</sup> {l s='Required field' mod='comparewishlistpro'}</p>
    </fieldset>
  </form>
  {if count($productsBoughts)}
  <table class="wlp_bought_infos hidden std">
    <thead>
      <tr>
        <th class="first_item">{l s='Product' mod='comparewishlistpro'}</th>
        <th class="item">{l s='Quantity' mod='comparewishlistpro'}</th>
        <th class="item">{l s='Offered by' mod='comparewishlistpro'}</th>
        <th class="last_item">{l s='Date' mod='comparewishlistpro'}</th>
      </tr>
    </thead>
    <tbody>
    {foreach from=$productsBoughts item=product name=i}
      {foreach from=$product.bought item=bought name=j}
      {if $bought.quantity > 0}
        <tr>
          <td class="first_item">
            <span style="float:left;"><img src="{$link->getImageLink($product.link_rewrite, $product.cover, 'small')|escape:'html':'UTF-8'}" alt="{$product.name|escape:'html':'UTF-8'}" /></span>
            <span style="float:left;">
              {$product.name|truncate:40:'...'|escape:'html':'UTF-8'}
            {if isset($product.attributes_small)}
              <br /><i>{$product.attributes_small|escape:'html':'UTF-8'}</i>
            {/if}
            </span>
          </td>
          <td class="item align_center">{$bought.quantity|intval}</td>
          <td class="item align_center">{$bought.firstname|escape:'html':'UTF-8'} {$bought.lastname|escape:'html':'UTF-8'}</td>
          <td class="last_item align_center">{dateFormat date=$bought.date_add full=0}</td>
        </tr>
      {/if}
      {/foreach}
    {/foreach}
    </tbody>
  </table>
  {/if}
  {/if}
{else}
  <p class="warning">{l s='No products' mod='comparewishlistpro'}</p>
{/if}
