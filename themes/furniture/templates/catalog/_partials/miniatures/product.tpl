{**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{block name='product_miniature_item'}
  <article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
    <div class="thumbnail-container">
      <div class="left-block">
      {block name='product_thumbnail'}
        <a href="{$product.url}" class="thumbnail scale_image product-thumbnail">
          <img
            src = "{$product.cover.bySize.home_default.url}"
            alt = "{$product.cover.legend}"
            data-full-size-image-url = "{$product.cover.large.url}"
          >
        </a>
      {/block}
      {block name='product_flags'}
        <ul class="product-flags">
            {if $product.has_discount}
                {if $product.discount_type === 'percentage'}
                    <span class="discount-percentage">{$product.discount_percentage}</span>
                {/if}
            {/if}
          {foreach from=$product.flags item=flag}
            <li class="{$flag.type}">{$flag.label}</li>
          {/foreach}
        </ul>
      {/block}
      </div>
      <div class="right-block">
        <div class="product-description">
          {block name='product_name'}
            <h1 class="h3 product-title" itemprop="name"><a href="{$product.url}">{$product.name|truncate:30:'...'}</a></h1>
          {/block}
        {block name='product_reviews'}
          {hook h='displayProductListReviews' product=$product}
        {/block}
        <div class="prop-line product-description-short" itemprop="description">
              {$product.description_short|strip_tags:'UTF-8'|truncate:120:'...'}
        </div>
          {block name='product_price_and_shipping'}
            {if $product.show_price}
              <div class="product-price-and-shipping" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
              <link itemprop="availability" href="https://schema.org/InStock"/>
              <meta itemprop="priceCurrency" content="{if isset($currency)}{$currency.iso_code}{/if}">
                {if $product.has_discount}
                  {hook h='displayProductPriceBlock' product=$product type="old_price"}

                  <span class="regular-price">{$product.regular_price}</span>
                  {*{if $product.discount_type === 'percentage'}
                    <span class="discount-percentage">{$product.discount_percentage}</span>
                  {/if}*}
                {/if}

                {hook h='displayProductPriceBlock' product=$product type="before_price"}

                <span itemprop="price" content="{$product.price_amount}" class="price">{$product.price}</span>

                {hook h='displayProductPriceBlock' product=$product type='unit_price'}

              {hook h='displayProductPriceBlock' product=$product type='weight'}
            </div>
          {/if}
        {/block}
        <div class="highlighted-informations{if !$product.main_variants} no-variants{/if}">
        {block name='quick_view'}
          <a class="quick-view function-btn hidden-sm-down" href="#" data-link-action="quickview">
          </a>
           <a href="{$product.url}" class="lnk_view function-btn">
           </a>
        {/block}
        </div>
        {block name='product_variants'}
          {if $product.main_variants}
            {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
          {/if}
        {/block}
      </div>
    </div>
  </article>
{/block}
