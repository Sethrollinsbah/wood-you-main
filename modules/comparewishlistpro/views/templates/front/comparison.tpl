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
  {l s='Product comparison' mod='comparewishlistpro'}
{/block}

{block name='page_content_container'}
  <div class="easywishlist-category-filter easywishlist-panel">
    <ul class="easywishlist-list-plain">
      <li><button class="easywishlist-category-filter-button easywishlist-button-plain active" type="button" data-id-category="0">{l s='All categories' mod='comparewishlistpro'}</button></li>
      {foreach from=$categories item=category}
      <li><button class="easywishlist-category-filter-button easywishlist-button-plain" type="button" data-id-category="{$category.id|intval}">{$category.name|escape:'html':'UTF-8'} <span class="easywishlist-category-product-count">{$category.count|intval}</span></button></li>
      {/foreach}
    </ul>
    <button id="comparison-remove-category" class="comparison-remove-category easywishlist-button-plain"><i class="material-icons">delete</i> {l s='Remove category' mod='comparewishlistpro'}</button>
  </div>

  <div class="easywishlist-row easywishlist-panel">
    <div class="easywishlist-feature-filter">
      <span>{l s='Show' mod='comparewishlistpro'}:</span>
      <ul class="easywishlist-list-plain hidden-sm-down">
        <li><button class="easywishlist-feature-filter-button easywishlist-button-plain" type="button" data-show="differing">{l s='Differing features' mod='comparewishlistpro'}</button></li>
        <li><button class="easywishlist-feature-filter-button easywishlist-button-plain active" type="button" data-show="all">{l s='All features' mod='comparewishlistpro'}</button></li>
      </ul>
      <div class="hidden-md-up">
        <select id="easywishlist-feature-filter" class="comparison-feature-filter-list">
          <option value="all">{l s='All features' mod='comparewishlistpro'}</option>
          <option value="differing">{l s='Differing features' mod='comparewishlistpro'}</option>
        </select>
        <i class="material-icons float-xs-right"></i>
      </div>
    </div>

    <div class="easywishlist-block comparison-sharing">
      <div class="dropdown">
        <button class="btn-unstyle comparison-button-share" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {l s='Share link' mod='comparewishlistpro'}
        </button>
        <div class="dropdown-menu">
          <a class="comparison-social select-list" href="https://www.facebook.com/sharer.php?u={$comparison_permalink|escape:'url':'UTF-8'}" rel="nofollow" target="_blank" data-link="https://www.facebook.com/sharer.php?u=%s">{l s='Facebook' mod='comparewishlistpro'}</a>
          <a class="comparison-social select-list" href="https://twitter.com/intent/tweet?url={$comparison_permalink|escape:'url':'UTF-8'}&text=&via=" rel="nofollow" target="_blank" data-link="https://twitter.com/intent/tweet?url=%s&text=&via=">{l s='Twitter' mod='comparewishlistpro'}</a>
          <a class="comparison-social select-list" href="https://www.pinterest.com/pin/create/button?url={$comparison_permalink|escape:'url':'UTF-8'}&media=&description=" rel="nofollow" target="_blank" data-link="https://www.pinterest.com/pin/create/button?url=%s&media=&description=">{l s='Pinterest' mod='comparewishlistpro'}</a>
          <a class="comparison-copy-permalink select-list" href="#" rel="nofollow" data-permalink="{$comparison_permalink|escape:'html':'UTF-8'}">{l s='Copy link' mod='comparewishlistpro'}</a>
        </div>
      </div>
    </div>
  </div>

  <section id="content" class="page-content card card-block comparison-content table-items-desktop-{$table_items_desktop|intval} table-items-tablet-{$table_items_tablet|intval}{if $comparison_layout == 2} comparison-columns{/if}">
    {if !empty($products)}
      {if $comparison_layout == 2}
      <div class="comparison-sidebar">
        <div class="comparison-permalink">
          <h2 class="comparison-send">{l s='Send link via email' mod='comparewishlistpro'}</h2>
          <input id="comparison-email" class="comparison-email" type="email" name="email" placeholder="{l s='Email' mod='comparewishlistpro'}" />
          <button id="comparison-send-permalink" class="comparison-send-permalink btn btn-primary" type="button" data-id-product="{$product_ids|escape:'html':'UTF-8'}">{l s='Send' mod='comparewishlistpro'}</button>
        </div>

        {if ($condition == 1 && !empty($condition_row)) || ($manufacturer == 1 && !empty($manufacturers_row))}
        <ul class="comparison-headers">
          {if $condition == 1 && !empty($condition_row)}<li class="comparison-row-basic comparison-alternate-color">{l s='Condition' mod='comparewishlistpro'}</li>{/if}
          {if $manufacturer == 1 && !empty($manufacturers_row)}<li class="comparison-row-basic">{l s='Brand' mod='comparewishlistpro'}</li>{/if}
        </ul>
        {/if}

        {if !empty($features)}
        <h3 class="comparison-section-heading">{l s='Features' mod='comparewishlistpro'} <button id="comparison-toggle-features" class="easywishlist-button-icon" type="button" data-state="{if $hide_features == 1}hide{else}show{/if}" data-icon-show="expand_less" data-icon-hide="expand_more"><i class="material-icons">{if $hide_features == 1}expand_more{else}expand_less{/if}</i></button></h3>

        <div class="comparison-features-container{if $hide_features == 1} easywishlist-hidden{/if}">
          <ul class="comparison-headers">
            {foreach from=$features item=feature name=loop}
            <li{if $smarty.foreach.loop.iteration is even} class="comparison-alternate-color"{/if} data-id-feature="{$feature[0].id_feature|intval}">{$feature[0].name|escape:'html':'UTF-8'}</li>
            {/foreach}
          </ul>
        </div>
        {/if}
      </div>
      {/if}

      <div class="comparison-table{if $navigation == 'scroll'} comparison-scroll{/if}{if $comparison_layout == 2} comparison-position-context{/if}">
        <div class="comparison-products">
          <div class="comparison-general">
          {foreach from=$products key=index item=product}
            <div class="comparison-item" data-id-product="{$product.id_product|intval}" data-id-category="{$product.id_category_default|intval}">
              <a class="comparison-image" href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url">
                <img class="replace-2x img-responsive" src="{$product.image_link|escape:'html':'UTF-8'}" alt="{if !empty($product.legend)}{$product.legend|escape:'html':'UTF-8'}{else}{$product.name|escape:'html':'UTF-8'}{/if}" title="{if !empty($product.legend)}{$product.legend|escape:'html':'UTF-8'}{else}{$product.name|escape:'html':'UTF-8'}{/if}"  itemprop="image" />
                <button class="comparison-quick-view easywishlist-button-plain" type="button" data-id-product="{$product.id_product|intval}"><i class="material-icons">search</i></button>
              </a>
              <h2><a href="{$product.link|escape:'html':'UTF-8'}">{$product.name|escape:'html':'UTF-8'}</a></h2>
              {if $product.show_availability == 1 && !empty($product.availability_message)}
              <div class="comparison-availability">
                <span class="comparison-availability-message">
                {if $product.availability == 'available'}
                  <i class="material-icons rtl-no-flip product-available">&#xE5CA;</i>
                {elseif $product.availability == 'last_remaining_items'}
                  <i class="material-icons product-last-items">&#xE002;</i>
                {else}
                  <i class="material-icons product-unavailable">&#xE14B;</i>
                {/if}
                {$product.availability_message|escape:'html':'UTF-8'}
                </span>
                <span class="comparison-oos easywishlist-hidden"><i class="material-icons product-unavailable">&#xE14B;</i>&nbsp;{l s='Not enough in stock' mod='comparewishlistpro'}</span>
              </div>
              {/if}
              {if $template_flags == 1}
                {include file='catalog/_partials/product-flags.tpl'}
              {/if}
              {if $product.main_variants}
              <div class="variant-links">
                {foreach from=$product.main_variants item=variant name=variants_array}
                  <a class="{$variant.type|escape:'html':'UTF-8'}" href="{$variant.url|escape:'html':'UTF-8'}" title="{$variant.name|escape:'html':'UTF-8'}" {if $variant.html_color_code} style="background-color: {$variant.html_color_code|escape:'html':'UTF-8'}" {/if}{if $variant.texture} style="background-image: url({$variant.texture|escape:'html':'UTF-8'})" {/if}><span class="sr-only">{$variant.name|escape:'html':'UTF-8'}</span></a>
                  {if $smarty.foreach.variants_array.index == 4}
                    <span class="comparison-hidden-variants-count">+{count($product.main_variants) - 5|intval}</span>
                    {break}
                  {/if}
                {/foreach}
                <span class="js-count count"></span>
              </div>
              {/if}

              <div class="comparison-price">{if $product.regular_price > $product.price}<span class="old-price">{$product.regular_price|escape:'html':'UTF-8'}</span>{/if}{$product.price|escape:'html':'UTF-8'}</div>

              <form class="comparison-add-to-cart" action="{$product.add_to_cart_url|escape:'html':'UTF-8'}" method="post">
                <input type="hidden" name="qty" value="{$product.minimal_quantity|intval}">
                <input class="comparison-remaining" type="hidden" value="{$product.quantity|intval}">

                {if $product.minimal_quantity > 1}
                <p>{l s='The minimum purchase order quantity for this product is %s' sprintf=[$product.minimal_quantity|intval] mod='comparewishlistpro'}</p>
                {/if}

                <button class="btn btn-primary add-to-cart" type="submit"{if !$product.add_to_cart_url || ($product.minimal_quantity > $product.quantity && $product.allow_oosp == 0)} disabled="disabled"{/if}><i class="material-icons shopping-cart">&#xE547;</i><span>{l s='Add to cart' mod='comparewishlistpro'}</span></button>
              </form>

              <div class="comparison-buttons{if $icons_on_hover == 1} icons-on-hover{/if}">
                <button class="remove-product-from-comparison easywishlist-button-icon" type="button" data-id-product="{$product.id_product|intval}" data-product-name="{$product.name|escape:'html':'UTF-8'}" data-preview="{$product.cover.bySize.small_default.url|escape:'html':'UTF-8'}"><i class="material-icons">delete</i></button>
              </div>
            </div>
          {/foreach}
          </div>

          {if $condition == 1 && !empty($condition_row)}
          <div class="comparison-row-basic comparison-row comparison-alternate-color">
            {if $comparison_layout == 1}<h4 class="comparison-row-label">{l s='Condition' mod='comparewishlistpro'}</h4>{/if}
            <ul class="comparison-list">
            {foreach from=$condition_row item=row}
              <li data-id-product="{$row.id_product|intval}">{$row.label|escape:'html':'UTF-8'}</li>
            {/foreach}
            </ul>
          </div>
          {/if}

          {if $manufacturer == 1 && !empty($manufacturers_row)}
          <div class="comparison-row-basic comparison-row">
            {if $comparison_layout == 1}<h4 class="comparison-row-label">{l s='Brand' mod='comparewishlistpro'}</h4>{/if}
            <ul class="comparison-list">
            {foreach from=$manufacturers_row item=row}
              <li data-id-product="{$row.id_product|intval}">{$row.name|escape:'html':'UTF-8'}</li>
            {/foreach}
            </ul>
          </div>
          {/if}

          {if !empty($features)}
          {if $comparison_layout == 1}<h3 class="comparison-section-heading">{l s='Features' mod='comparewishlistpro'} <button id="comparison-toggle-features" class="easywishlist-button-icon" type="button" data-state="{if $hide_features == 1}hide{else}show{/if}" data-icon-show="expand_less" data-icon-hide="expand_more"><i class="material-icons">{if $hide_features == 1}expand_more{else}expand_less{/if}</i></button></h3>{else}<div class="comparison-section-heading"></div>{/if}

          <div class="comparison-features-container{if $hide_features == 1} easywishlist-hidden{/if}">
            {foreach from=$features item=row name=loop}
            <div class="comparison-row{if $smarty.foreach.loop.iteration is even} comparison-alternate-color{/if}">
              {if $comparison_layout == 1}<h4 class="comparison-row-label" data-id-feature="{$row[0].id_feature|intval}">{$row[0].name|escape:'html':'UTF-8'}</h4>{/if}
              <ul class="comparison-list comparison-features">
                {foreach from=$row key=index item=feature}
                <li data-id-product="{$feature.id_product|intval}">{$feature.value|escape:'html':'UTF-8'}</li>
                {/foreach}
              </ul>
            </div>
            {/foreach}
          </div>
          {/if}
        </div>
        {if $navigation == 'buttons'}
        <button class="comparison-nav comparison-nav-prev easywishlist-button-plain easywishlist-hidden{if $comparison_layout == 2} comparison-inner{/if}" type="button"><i class="material-icons">arrow_back</i></button>
        <button class="comparison-nav comparison-nav-next easywishlist-button-plain easywishlist-hidden{if $comparison_layout == 2} comparison-inner{/if}" type="button"><i class="material-icons">arrow_forward</i></button>
        {/if}
      </div>

      <p class="empty-comparison wishlist-hidden">{l s='No products to compare. Select some products in the front office first.' mod='comparewishlistpro'}</p>
    {else}
      <p class="empty-comparison">{l s='No products to compare. Select some products in the front office first.' mod='comparewishlistpro'}</p>
    {/if}
  </section>

  {if $comparison_layout == 1 && $show_email_block == 1}
  <div class="comparison-permalink page-content card card-block">
    <h2 class="comparison-send">{l s='Send link via email' mod='comparewishlistpro'}</h2>
    <div class="easywishlist-form-row">
      <input id="comparison-email" class="comparison-email" type="email" name="email" placeholder="{l s='Email' mod='comparewishlistpro'}" />
      <button id="comparison-send-permalink" class="btn btn-primary" type="button" data-id-product="{$product_ids|escape:'html':'UTF-8'}">{l s='Send' mod='comparewishlistpro'}</button>
    </div>
  </div>
  {/if}
{/block}
