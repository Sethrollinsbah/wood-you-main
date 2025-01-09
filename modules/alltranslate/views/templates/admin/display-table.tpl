{*
* 2007-2018 PrestaShop
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
*  @copyright 2007-2018 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div class="panel">
	<h3>{$at_title|escape:'html':'UTF-8'}</h3>
	<div class="dynamic-list">
		<table class="table resource-list">
			<tbody class="dynamic-rows">
			{if $at_items|count}
				{foreach $at_items as $item}
				<tr data-identifier="{$item|escape:'html':'UTF-8'}" data-type="{$at_type|escape:'html':'UTF-8'}">
					<td><input class="at-checkbox" type="checkbox" name="items[]">{$item|escape:'html':'UTF-8'}<span class="at-ajax-response"></span></td>
					<td width="200">
						<div class="btn-group pull-right">
							<a href="#" class="default btn btn-default at-translate-btn">
								<span class="at-stop-txt"><i class="icon-refresh icon-spin"></i> {l s='Stop' mod='alltranslate'}</span>
								<span class="at-translate-txt"><i class="icon-globe"></i> {l s='Translate' mod='alltranslate'}</span>
							</a>
						</div>
					</td>
				</tr>
				{/foreach}
			{else}
				<tr>
					<td class="list-empty" colspan="2">
						<div class="list-empty-msg">
							<i class="icon-warning-sign list-empty-icon"></i>
							{l s='No items found' mod='alltranslate'}
						</div>
					</td>
				</tr>
			{/if}
			</tbody>
		</table>
	</div>
	<div class="at-bulk-actions clearfix">
		<div class="pull-left">
			<div class="btn-group dropup">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					{l s='Bulk actions' mod='alltranslate'} <span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li><a href="#" class="at-checkbox-action"><i class="icon-check-sign"></i> {l s='Check all' mod='alltranslate'}</a></li>
					<li><a href="#" class="at-checkbox-action"><i class="icon-check-empty"></i> {l s='Uncheck all' mod='alltranslate'}</a></li>
					<li><a href="#" class="at-checkbox-action"><i class="icon-random"></i> {l s='Invert selection' mod='alltranslate'}</a></li>
					<li class="divider"></li>
					<li><a id="at-bulk-translate" href="#"><i class="icon-globe"></i> {l s='Translate selected' mod='alltranslate'}</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    var at_dir = '{$at_dir|escape:"html":"UTF-8"}';
</script>