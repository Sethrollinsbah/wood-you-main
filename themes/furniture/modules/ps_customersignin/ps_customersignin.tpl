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

<div id="_desktop_user_info">
  <div class="dropdown js-dropdown">
     <span class="expand-more hidden-md-up" data-toggle="dropdown">
          <i class="material-icons">&#xE7FD;</i>
     </span>
    <div class="user-info dropdown-menu">
      {if $logged}
        <a
          class="logout dropdown-item"
          href="{$logout_url}"
          rel="nofollow"
        >
          <i class="material-icons">lock_open</i>
          {l s='Sign out' d='Shop.Theme.Actions'}
        </a>
        <a
          class="account dropdown-item"
          href="{$my_account_url}"
          title="{l s='View my customer account' d='Shop.Theme.Customeraccount'}"
          rel="nofollow"
        >
          <i class="material-icons hidden-sm-down">&#xE898;</i>
          <span>{$customerName}</span>
        </a>
      {else}
        <a
          class="account dropdown-item"
          href="{$my_account_url}"
          title="{l s='View my customer account' d='Shop.Theme.Customeraccount'}"
          rel="nofollow"
        >
          <i class="material-icons">&#xE7FD;</i>
          {l s='My account' d='Shop.Theme.Actions'}
        </a>
        <a
          class="dropdown-item"
          href="{$my_account_url}"
          title="{l s='Log in to your customer account' d='Shop.Theme.Customeraccount'}"
          rel="nofollow"
        >
          <i class="material-icons">lock_outline</i>
          <span>{l s='Sign in' d='Shop.Theme.Actions'}</span>
        </a>
      {/if}
    </div>
  </div>
</div>
