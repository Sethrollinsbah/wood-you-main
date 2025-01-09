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

{capture name=path}
	<a href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html':'UTF-8'}"
		title="{l s='Go back to the Checkout' mod='decidir'}">{l s='Checkout' mod='decidir'}</a><span
		class="navigation-pipe">{$navigationPipe}</span>{l s=$nombre mod='decidir'}
{/capture}


{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}

{if isset($nbProducts) && $nbProducts <= 0}
	<p class="warning">{l s='Your shopping cart is empty.' mod='decidir'}</p>
{else}
	<h1>{l s='Exception' mod='decidir'}</h1>
	<b>{l s='MEssage' mod='decidir'}: </b> {l s='%s' sprintf=$exception mod='decidir'}
	<br />
	<br />

	<h4>{l s='Sent data' mod='decidir'}</h4>
	<b>{l s='Mode' mod='decidir'}: </b> {var_dump($variablesPaso['modo'])}
	<br />
	<b>{l s='Authorization' mod='decidir'}: </b> {var_dump($variablesPaso['authorization'])}
	<br />
	<b>WSDLs </b> {var_dump($variablesPaso['wsdls'])}
	<br />
	<b>Endpoint</b> {var_dump($variablesPaso['endpoint'])}
	<br />
	<b>var_dump($opciones) </b> {var_dump($variablesPaso['opciones'])}
	<br />

	<h4>{l s='Response' mod='decidir'}</h4>
	<b>var_dump($respuesta) </b> {var_dump($variablesPaso['respuesta'])}
	<br />
	<br />

	<h4>Status</h4>
	<b>var_dump($connector->getStatus)</b> {var_dump($variablesPaso['info'])}
	<br />
	<br />

	<h4>{l s='Purchase details:' mod='decidir'}</h4>
	<ul>
		<li>{l s='Cart id: %s' sprintf=$cart_id mod='decidir'}</li>
		<li>{l s='Total:' mod='decidir'} <span id="amount" class="price">{displayPrice price=$total}</span></li>
		<li>{l s='Customer email: %s' sprintf=$cliente mod='decidir'}</li>
	</ul>
	<form action="{$link->getModuleLink('decidir', 'validation', [], false)|escape:'html'}" method="post">
		<p class="cart_navigation" id="cart_navigation">
			{if ($status == true) && !isset($exception)}
				<input type="submit" value="{l s='Quantity discount' mod='decidir'}"
					class="button btn btn-default button-medium" />
			{/if}
			<a
				href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html'}">{l s='Other payment method' mod='decidir'}</a>
		</p>
	</form>
{/if}