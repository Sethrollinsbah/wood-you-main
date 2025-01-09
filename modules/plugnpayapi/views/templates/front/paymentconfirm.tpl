{*
* 2007-2023 PrestaShop
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
*  @copyright  2007-2023 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if $version == '1.6'}
	{capture name=path}
		<span class="navigation-pipe">{$navigationPipe}</span>{l s='Payment confirmation' mod='decidir'}
	{/capture}
{/if}

<style>
	.button-small {
		padding: 6px 6px 7px 7px !important;
	}

	p {
		font-size: 17px;
		margin: 0 0 16px 0;
	}
</style>

{if $status == 'ok'}

	<!-- Block decidir -->
	<div id="mymodule_block_home" class="block">
		<h2>{l s='Thanks for your purchase' mod='decidir'} </h2><br>
		<p>{l s='Order reference code' mod='decidir'}: <strong>{$order_ref}</strong>. <a class="btn btn-link"
				href='{$url_orderdetails}'>{l s='View order details' mod='decidir'}</a></p>
	</div>
	<p>&nbsp;</p>

	<ul class="footer_links clearfix">
		<li>
			<a href="{$link->getPageLink('', true, NULL, "")|escape:'html'}" class="btn btn-secondary btn-lg">
				<i class="fa fa-shopping-bag" aria-hidden="true"></i>
				{l s='Continue shopping' mod='decidir'}
			</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="{$link->getPageLink('my-account', true, NULL, "")|escape:'html'}" class="btn btn-secondary btn-lg">
				<i class="fa fa-user" aria-hidden="true"></i>
				{l s='My account' mod='decidir'}
			</a>
		</li>
	</ul>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<!-- /Block decidir -->
{else}

	<p class="warning">{l s='Yout cart is empty.' mod='decidir'}</p>

{/if}