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
<h2>{l s='Wishlists' mod='comparewishlistpro'}</h2>

{if count($wishlists) > 0}
  <form id="listing" action="{$request_uri|escape:'html':'UTF-8'}" method="post">
    <span>{l s='Wishlist' mod='comparewishlistpro'}:</span>
    <select name="id_wishlist" onchange="$('#listing').submit();">
    {foreach from=$wishlists item=list}
      <option value="{$list.id_wishlist|intval}"{if $list.id_wishlist == $id_wishlist} selected="selected"{/if}>{$list.name|escape:'html':'UTF-8'}</option>
    {/foreach}
    </select>
    {$producs nofilter}{* Cannot be escaped *}
  </form>
{else}
  {$first_name|escape:'html':'UTF-8'} {$last_name|escape:'html':'UTF-8'} {l s='has no wishlists' mod='comparewishlistpro'}
{/if}
