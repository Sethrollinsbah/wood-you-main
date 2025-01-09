{**
*
* @author    Amazzing <mail@amazzing.ru>
* @copyright 2007-2018 Amazzing
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*
* NOTE: this file is extendable. You can override only selected blocks in your template.
* Path for extending: 'modules/amazzingblog/views/templates/hook/product-list-item.tpl'
*
**}

{$product = $item}
{block name='product_item'}
<div class="product-container{if !empty($settings.price)} has-price{/if}" itemscope itemtype="http://schema.org/Product">
    <div class="product-image-container">

        {block name='product_image'}
        {if $settings.product_img_type != '--'}
            {$img_type = $settings.product_img_type}
            {if !empty($product.legend)}{$legend = $product.legend}{else}{$legend = $product.name}{/if}
            <a class="product-img-link" href="{$product.url|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url">
                <img class="replace-2x product-img{if !empty($product.second_img_src)} primary-image{/if}" src="{$product.img_src|escape:'html':'UTF-8'}" alt="{$legend|escape:'html':'UTF-8'}" itemprop="image" />
                {if !empty($product.second_img_src)}
                    <img class="replace-2x product-img secondary-image" src="{$product.second_img_src|escape:'html':'UTF-8'}" alt="{$legend|escape:'html':'UTF-8'}"/>
                {/if}
            </a>
        {/if}
        {/block}

        {block name='product_stickers'}
        {if $settings.stickers }
            <ul class="product-flags">
            {foreach $product.flags as $flag}
                <li class="{$flag.type|escape:'html':'UTF-8'}">{$flag.label|escape:'html':'UTF-8'}</li>
            {/foreach}
            </ul>
        {/if}
        {/block}

        {block name='product_buttons'}
        {if $settings.add_to_cart}
            <form type="post" action="{$cart_page_url|escape:'html':'UTF-8'}" class="product-item-buttons">
                {if $settings.add_to_cart}
                    <input type="hidden" name="id_product" value="{$product.id_product|intval}">
                    <input type="hidden" name="qty" value="{$product.minimal_quantity|intval}">
                    <button type="submit"
                    	class="btn ajax_add_to_cart_button"
                    	data-button-action="add-to-cart"
                    	{if !$is_17}
                    		data-id-product="{$product.id_product|intval}"
                    		data-id-product-attribute="{$product.id_product_attribute|intval}"
                    		data-minimal_quantity="{$product.minimal_quantity|intval}"
                    	{/if}
                    	{if !empty($product.customization_required) || (!$product.allow_oosp && !$product.quantity)} disabled{/if}>
                        {l s='Add to cart' mod='amazzingblog'}
                    </button>
                {/if}
            </form>
        {/if}
        {/block}

    </div>

    {block name='product_title'}
    {if !empty($settings.product_title)}
        <h5 class="product-name nowrap" itemprop="name" class="nowrap">
            {if !empty($product.pack_quantity)}{$product.pack_quantity|intval} x {/if}
            <a href="{$product.url|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}">
                {$product.name|truncate:$settings.product_title:'...'|escape:'html':'UTF-8'}
            </a>
        </h5>
    {/if}
    {/block}

    {block name='product_other_fields'}
    {if !empty($settings.reference)}
        <div class="prop-line product-reference nowrap"><span>{$product.reference|escape:'html':'UTF-8'}</span></div>
    {/if}
    {if !empty($settings.product_cat) && !empty($product.cat_url)}
        <div class="prop-line product-category nowrap">
            <a class="cat-name " href="{$product.cat_url|escape:'html':'UTF-8'}" title="{$product.cat_name|escape:'html':'UTF-8'}">{$product.cat_name|truncate:45:'...'|escape:'html':'UTF-8'}</a>
        </div>
    {/if}
    {if !empty($settings.product_man) && $product.id_manufacturer && $product.man_name && !empty($product.man_url)}
        <div class="prop-line product-manufacturer nowrap">
            <a class="man-name" href="{$product.man_url|escape:'html':'UTF-8'}" title="{$product.man_name|escape:'html':'UTF-8'}">
            {if !empty($product.man_img_src)}
                <img src="{$product.man_img_src|escape:'html':'UTF-8'}" class="product-manufacturer-img">
            {else}
                {$product.man_name|truncate:45:'...'|escape:'html':'UTF-8'}
            {/if}
            </a>
        </div>
    {/if}
    {if !empty($settings.description)}
        <div class="prop-line product-description-short" itemprop="description">
            {$product.description_short|strip_tags:'UTF-8'|truncate:$settings.description:'...'|escape:'html':'UTF-8'}
        </div>
    {/if}
    {/block}

    {block name='product_price'}
    {if $settings.price && $product.show_price}
        <div class="product-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
            {if $product.has_discount}
                {hook h='displayProductPriceBlock' product=$product type="old_price"}
                <span class="old-price">{$product.regular_price|escape:'html':'UTF-8'}</span>
            {/if}
            {hook h='displayProductPriceBlock' product=$product type="before_price"}
            <span class="price">{$product.price|escape:'html':'UTF-8'}</span>
            <meta itemprop="price" content="{$product.price_amount|escape:'html':'UTF-8'}" />
            <meta itemprop="priceCurrency" content="{$currency_iso_code|escape:'html':'UTF-8'}" />
            {if !empty($product.discount_value)}
                <span class="discount-value">{$product.discount_value|escape:'html':'UTF-8'}</span>
            {/if}
            {hook h='displayProductPriceBlock' product=$product type='unit_price'}
            {hook h='displayProductPriceBlock' product=$product type='weight'}
        </div>
    {/if}
    {/block}

</div>
{/block}
{* since 1.3.0 *}
