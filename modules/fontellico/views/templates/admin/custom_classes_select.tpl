{*
* 2007-2018 Andrey & co
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0).
*
*  @author    Andrey <byalonovich@bk.ru>
*  @copyright 2015-2020 Andrey & co
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}
<div id="fontellico-change-class-select">
<input id="icon-css-search-popup" placeholder="{l s='Search' mod='fontellico'}"/>
{if !empty($icons)}
	<div class="clearfix">
		{foreach name=icons_custom_class from=$icons item=icon_cc}
				<div class="fticon" >
					<span data-uid="{$icon_cc.uid|escape:'html':'UTF-8'}"
						  data-src="{$icon_cc.src|escape:'html':'UTF-8'}"
						  data-css="{$icon_cc.css|escape:'html':'UTF-8'}"
						  data-dismiss="modal"
						  {if !empty($icon.svg)}
						  data-path="{$icon_cc.svg.path|escape:'html':'UTF-8'}"
						  data-width="{$icon_cc.svg.width|escape:'html':'UTF-8'}"
						  {/if}
						  class="{if !empty($prefix)}{$prefix|escape:'html':'UTF-8'}{/if}{$icon_cc.css|escape:'html':'UTF-8'}"></span>
					<div class="hidden">
						<button class="del-icon btn btn-default" >x</button>
						<input size="5" class="code" value="{$icon_cc.code|escape:'html':'UTF-8'}" />
						<div>{l s='Change class' mod='fontellico'}</div>
						<table class="custom-class-table">
							<tr>
								<td>
									<input size="5" class="css" value="{$icon_cc.css|escape:'html':'UTF-8'}" />
								</td>
								<td>
									=
								</td>
								<td>
									<input size="15" class="custom_css" value="{$icon_cc.css|escape:'html':'UTF-8'}" />
								</td>

							</tr>
						</table>
					</div>
				</div>
		{/foreach}
	</div>
{/if}
</div>