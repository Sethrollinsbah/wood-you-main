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
{if !isset($wishlist_icon_hidden)}
  {$wishlist_icon_hidden = false}
{/if}
<svg class="cwp-wishlist-icon{if $wishlist_icon_hidden} wishlist-hidden{/if}" xmlns="http://www.w3.org/2000/svg" width="24" height="22" viewBox="0 0 24 22"><path d="M17.625,1.546875 C20.296875,1.546875 22.5,3.75 22.5,6.421875 L22.5,7.546875 C22.5,8.71875 21.984375,10.078125 20.90625,11.578125 C20.015625,12.84375 18.703125,14.203125 17.0625,15.609375 C15.09375,17.296875 13.03125,18.65625 12,19.3125 C10.96875,18.65625 8.90625,17.296875 6.9375,15.609375 C5.296875,14.203125 3.984375,12.84375 3.09375,11.578125 C2.015625,10.078125 1.5,8.71875 1.5,7.546875 L1.5,6.421875 C1.5,4.171875 3,2.25 5.203125,1.6875 C7.359375,1.125 9.609375,2.15625 10.6875,4.125 C10.921875,4.59375 11.4375,4.921875 12,4.921875 C12.5625,4.921875 13.078125,4.59375 13.3125,4.125 C14.15625,2.53125 15.84375,1.546875 17.625,1.546875 M17.625,0.046875 C15.28125,0.046875 13.125,1.359375 12,3.421875 C10.640625,0.84375 7.6875,-0.46875 4.828125,0.234375 C1.96875,0.9375 0,3.515625 0,6.421875 L0,7.546875 C0,14.15625 12,21.046875 12,21.046875 C12,21.046875 24,14.15625 24,7.546875 L24,6.421875 C24,2.90625 21.140625,0.046875 17.625,0.046875 Z"/></svg>
