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
{extends file='catalog/listing/product-list.tpl'}

{block name='product_list_header'}
    <div class="block-category card card-block">
      <h1 class="listing-title title_main_section"><span>{$category.name}</span></h1>
      {if $category.description}
        <div id="category-description" class="text-muted">{$category.description nofilter}</div>
      {/if}
      {if $category.image.large.url}
        <div class="category-cover">
          <img src="{$category.image.large.url}" alt="{$category.image.legend}">
        </div>
      {/if}
    </div>
    {*<div class="text-xs-center hidden-md-up">
      <h1 class="h1">{$category.name}</h1>
    </div>*}

    {if isset($subcategories)}
    <!-- Subcategories -->
    <div id="subcategories">
        <p class="subcategory-heading">{l s='Subcategories'}</p>
        <div class="">
        <ul class="clearfix">
            {foreach from=$subcategories item=subcategory}
                <li>
                    <div class="subcategory-image">
                        <a href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'html':'UTF-8'}" title="{$subcategory.name|escape:'html':'UTF-8'}" class="img">
                            {if $subcategory.id_image}
                                <img class="replace-2x" src="{$link->getCatImageLink($subcategory.link_rewrite, $subcategory.id_image, 'category_default')|escape:'html':'UTF-8'}" alt="{$subcategory.name|escape:'html':'UTF-8'}"/>
                            {else}
                                <img class="replace-2x" src="{$img_cat_dir}{$lang_iso}-default-category_default.jpg" alt="{$subcategory.name|escape:'html':'UTF-8'}"/>
                            {/if}
                        </a>
                    </div>
                    <h5><a class="subcategory-name" href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'html':'UTF-8'}">{$subcategory.name|truncate:25:'...'|escape:'html':'UTF-8'}</a></h5>
                    {if $subcategory.description}
                        <div class="cat_desc">{$subcategory.description}</div>
                    {/if}
                </li>
            {/foreach}
        </ul>
        </div>
    </div>
    {/if}


{/block}

