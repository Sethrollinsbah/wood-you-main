{*
* 2007-2015 PrestaShop
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2020 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<div class="panel">
	<h3><i class="icon icon-tags"></i> {l s='Troubleshooting' mod='contactboxplus'}</h3>
	<p>
		<ol>
			<li>
				<b>{l s='The "Contact us" button is not displayed on the product page' mod='contactboxplus'}</b>
				<ul>
					<li>{l s='Make sure you have enabled the button on the appropriate category' mod='contactboxplus'}</li>
					<li>{l s='Make sure your theme implement the hook HOOK_PRODUCT_ACTIONS in product.tpl file. You can manually add this code' mod='contactboxplus'} <code>{literal}{if $HOOK_PRODUCT_ACTIONS}{$HOOK_PRODUCT_ACTIONS}{/if}{/literal}</code> {l s='to your product.tpl file if it is missing.' mod='contactboxplus'}</li>
				</ul>
			</li>
			<li>
				<b>{l s='I am getting the following error' mod='contactboxplus'} <i>The requested content cannot be loaded. Please try again later.</i> {l s='when clicking on the "Contact us" button' mod='contactboxplus'}</b>
				<ul>
					<li>{l s='Your theme is missing the hook HOOK_PRODUCT_FOOTER in product.tpl file. You can manually add this code' mod='contactboxplus'} <code>{literal}{if $HOOK_PRODUCT_FOOTER}{$HOOK_PRODUCT_FOOTER}{/if}{/literal}</code> {l s='at the bottom of your product.tpl file.' mod='contactboxplus'}</li>
				</ul>
			</li>
		</ol>
		<h4>
			Need help? Please <a href="https://addons.prestashop.com/contact-community.php?id_product=16762" target="_blank">{l s='Contact the support' mod='contactboxplus'}</a>
		</h4>
		<h4>
			{l s='Like this module? Please ' mod='contactboxplus'}<a href="https://addons.prestashop.com/ratings.php" target="_blank">{l s='Leave a comment' mod='contactboxplus'}</a>
		</h4>
	</p>
	<!--
	<p>
		<img style="max-width:25%; margin-right:25px; border:2px solid grey;" src="{$module_dir|escape:'htmlall':'UTF-8'}/views/img/help1.png" />
		<img style="max-width:25%; margin-right:25px; border:2px solid grey;" src="{$module_dir|escape:'htmlall':'UTF-8'}/views/img/help2.png" />
	</p>
     -->
</div>
