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
{extends file='customer/page.tpl'}

{block name='page_title'}
  {l s='Your addresses' d='Shop.Theme.Customeraccount'}
{/block}

{block name='page_content'}
  <div class="row">
  {foreach $customer.addresses as $address}
    <div class="col-lg-4 col-md-6 col-sm-6">
    {block name='customer_address'}
      {include file='customer/_partials/block-address.tpl' address=$address}
    {/block}
    </div>
  {/foreach}
  </div>
  <div class="addresses-footer">
    <a href="{$urls.pages.address}" data-link-action="add-address">
      <i class="material-icons">&#xE145;</i>
      <span>{l s='Create new address' d='Shop.Theme.Actions'}</span>
    </a>
  </div>
{/block}
