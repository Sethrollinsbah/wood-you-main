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

<div id="_desktop_cart">
  <div class="blockcart cart-preview {if $cart.products_count > 0}active{else}inactive{/if}" data-refresh-url="{$refresh_url}">
    <div class="header">
      {if $cart.products_count > 0}
        <a class="link" rel="nofollow" href="{$cart_url}">
        {else}
        <span class="link">
      {/if}
        <i class="material-icons">&#xE8CB;</i>
        <span class="cart-products-count">{$cart.products_count}</span>
        <span class="cart-items">{l s='item(s)' d='Shop.Theme.Checkout'}</span>
        {*<span class="hidden-sm-down">{l s='Cart' d='Shop.Theme.Checkout'}</span>*}
      {if $cart.products_count > 0}
        </a>
        {else}
        </span>
      {/if}
    </div>
  </div>
</div>
