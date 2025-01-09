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
{extends file='page.tpl'}
{block name="page_content"}

	<h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i>{l s='An error ocurred' mod='decidir'}</h3>

	<h2 class="alert">{l s='Error type' mod='decidir'}: {$response}<br />
		{l s='Details' mod='decidir'}: {$responsea}</h2>

	<p>{l s='Please try again' mod='decidir'}. </p>



	<br />
	<div class="cart_navigation clearfix">
		<a href="{$urls.pages.cart}?action=show" class="btn btn-primary btn-lg">
			{l s='Back' mod='decidir'}
		</a>
	</div>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
{/block}