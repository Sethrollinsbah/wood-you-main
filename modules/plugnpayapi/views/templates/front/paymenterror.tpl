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
{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}

{capture name=path}
	<a href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html':'UTF-8'}"
		title="{l s='Go back to the Checkout' mod='decidir'}">{l s='Checkout' mod='decidir'}</a><span
		class="navigation-pipe">{$navigationPipe}</span>Decidir
{/capture}


<h3 class="warning">{l s='Checkout' mod='decidir'}</h3>
{if isset($nbProducts) && $nbProducts <= 0}
	<p class="warning">{l s='Your shopping cart is empty.' mod='decidir'}</p>
	</br>
	</br>
	<div class="cart_navigation clearfix">
		<a href="{$link->getPageLink('index', true, NULL, "")|escape:'html'}" class="button-exclusive btn btn-default">
			<i class="icon-chevron-left"></i>
			{l s='Continue shopping' mod='decidir'}
		</a>
	</div>
{else}
	<p class="warning">{l s='Please try again' mod='decidir'}. </p>
	</br>
	</br>
	<div class="cart_navigation clearfix">
		<a href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html'}"
			class="button-exclusive btn btn-default">
			<i class="icon-chevron-left"></i>
			{l s='Back to payment methods' mod='decidir'}
		</a>
	</div>
{/if}