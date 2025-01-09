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

{extends file='customer/page.tpl'}

{block name='page_title'}
  {l s='My wishlists' mod='comparewishlistpro'}
{/block}

{block name='page_content'}
  {if $id_customer|intval neq 0}
    <form method="post" class="std" id="form_wishlist">
      <fieldset>
        <h3>{l s='Add a new wishlist' mod='comparewishlistpro'}</h3>
        <div>
          <input type="hidden" name="token" value="{$token|escape:'html':'UTF-8'}" />
          <label class="align_right" for="name">{l s='Name' mod='comparewishlistpro'}</label>
          <input type="text" id="name" name="name" class="inputTxt" value="{if isset($smarty.post.name) and $errors|@count > 0}{$smarty.post.name|escape:'html':'UTF-8'}{/if}" />
        </div>
        <p class="submit">
          <input id="submitWishlist" class="btn btn-primary exclusive" type="submit" name="submitWishlist" value="{l s='Save' mod='comparewishlistpro'}" />
        </p>
      </fieldset>
    </form>

    {if !empty($wishlists)}
    <h3>{l s='Existing wishlists' mod='comparewishlistpro'}</h3>

    <div id="block-history" class="block-center wishlist-table">
      <table class="std">
        <thead>
          <tr>
            <th class="first_item">{l s='Name' mod='comparewishlistpro'}</th>
            <th class="item mywishlist_first">{l s='Qty' mod='comparewishlistpro'}</th>
            <th class="item mywishlist_first">{l s='Viewed' mod='comparewishlistpro'}</th>
            <th class="item mywishlist_second">{l s='Created' mod='comparewishlistpro'}</th>
            <th class="item mywishlist_second">{l s='Direct Link' mod='comparewishlistpro'}</th>
            <th class="item mywishlist_second mywishlist_center">{l s='Default' mod='comparewishlistpro'}</th>
            <th class="last_item mywishlist_first mywishlist_center">{l s='Delete' mod='comparewishlistpro'}</th>
          </tr>
        </thead>
        <tbody>
        {section name=i loop=$wishlists}
          <tr id="wishlist_{$wishlists[i].id_wishlist|intval}">
            <td style="width:200px;">
              <a href="javascript:;" onclick="compareWishlistPro.WishlistManage('block-order-detail', '{$wishlists[i].id_wishlist|intval}');">{$wishlists[i].name|truncate:30:'...'|escape:'html':'UTF-8'}</a>
            </td>
            <td class="bold align_center">
              {assign var=n value=0}
              {foreach from=$nbProducts item=nb name=i}
                {if $nb.id_wishlist eq $wishlists[i].id_wishlist}
                  {assign var=n value=$nb.nbProducts|intval}
                {/if}
              {/foreach}
              {if $n}
                {$n|intval}
              {else}
                0
              {/if}
            </td>
            <td>{$wishlists[i].counter|intval}</td>
            <td>{dateFormat date=$wishlists[i].date_add full=0}</td>
            <td><a href="javascript:;" onclick="compareWishlistPro.WishlistManage('block-order-detail', '{$wishlists[i].id_wishlist|intval}');">{l s='View' mod='comparewishlistpro'}</a></td>
            <td class="wishlist_default">
              {if isset($wishlists[i].default) && $wishlists[i].default == 1}
                <span class="is_wish_list_default"><i class="material-icons">check_box</i></span>
              {else}
                <a href="#" onclick="event.preventDefault();(compareWishlistPro.WishlistDefault('wishlist_{$wishlists[i].id_wishlist|intval}', '{$wishlists[i].id_wishlist|intval}'));" title="{l s='Make default' mod='comparewishlistpro'}">
                  <i class="material-icons">check_box_outline_blank</i>
                </a>
              {/if}
            </td>
            <td class="wishlist_delete">
              <a href="javascript:;" onclick="return (compareWishlistPro.WishlistDelete('wishlist_{$wishlists[i].id_wishlist|intval}', '{$wishlists[i].id_wishlist|intval}', '{l s='Do you really want to delete this wishlist?' mod='comparewishlistpro' js=1}'));" title="{l s='Delete' mod='comparewishlistpro'}">
                <i class="material-icons">delete</i>
              </a>
            </td>
          </tr>
        {/section}
        </tbody>
      </table>
    </div>
    <div id="block-order-detail">&nbsp;</div>
    {/if}
  {/if}
{/block}
