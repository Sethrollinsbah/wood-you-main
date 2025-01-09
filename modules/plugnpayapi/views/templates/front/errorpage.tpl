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
<h3>{l s='An error ocurred' mod='decidir'}</h3>
<p>{l s='Please try again' mod='decidir'}</p>

<h2 class="alert">{l s='Error type' mod='decidir'}: {$response}</h2><br />
<h2 class="alert">{l s='Details' mod='decidir'}: {$responsea}</h2>

<p>{l s='Please try again' mod='decidir'}. </p>

<br />
<div class="cart_navigation clearfix">
	<a href="{$link->getPageLink('order', true, NULL, 'step=3')|escape:'html'}" style="padding:0px !important"
		class="button-exclusive btn btn-default">
		{l s='Back' mod='decidir'}
	</a>
</div>