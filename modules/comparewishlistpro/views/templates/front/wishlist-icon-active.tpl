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
{if !isset($wishlist_icon_active_hidden)}
  {$wishlist_icon_active_hidden = false}
{/if}
<svg class="cwp-wishlist-icon-active{if $wishlist_icon_active_hidden} wishlist-hidden{/if}" xmlns="http://www.w3.org/2000/svg" width="24" height="22" viewBox="0 0 24 22"><path d="M17.625,0.046875 C15.28125,0.046875 13.125,1.359375 12,3.421875 C10.640625,0.84375 7.6875,-0.46875 4.828125,0.234375 C1.96875,0.9375 0,3.515625 0,6.421875 L0,7.546875 C0,14.15625 12,21.046875 12,21.046875 C12,21.046875 24,14.15625 24,7.546875 L24,6.421875 C24,2.90625 21.140625,0.046875 17.625,0.046875 Z"/></svg>
