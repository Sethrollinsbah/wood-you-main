{*
* 2007-2018 Amazzing
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
*
*  @author    Amazzing <mail@amazzing.ru>
*  @copyright 2007-2018 Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*
*}

<div class="twa_in_hook{if $in_column} block{/if}{if !$in_column} twa-wrapper {/if}{if $hook_settings.displayType == 1} carousel square_arrows{/if} {$hook_name|escape:'html':'UTF-8'}">
	{if !empty($title)}
		<h2 class="{if $in_column}title_block {else}title_main_section {/if}">
			{if !empty($view_all_link)}
			<a href="{$view_all_link|escape:'html':'UTF-8'}" title="{l s='View all' d='Shop.Theme.Global'}">
			{/if}
				<span>
					<b>{$title|escape:'html':'UTF-8'}</b>
				</span>
			{if !empty($view_all_link)}
			</a>
			{/if}
		</h2>
	{/if}
	<div class="twa-inner">
		<div id="twa_{$hook_name|escape:'html':'UTF-8'}" class="twa_posts{if $hook_settings.displayType == 2 && !$in_column} grid{else} list{/if}">
			{include file="./../front/post-list.tpl" posts=$twa_hook_posts}
		</div>
	</div>
	{if !empty($view_all_link)}
	{*<div class="button-wrap">
		<a class="view_all neat btn" href="{$view_all_link|escape:'html':'UTF-8'}" title="{l s='View all' d='Shop.Theme.Global'}">
			{l s='View all' d='Shop.Theme.Global'}
		</a>
	</div>*}
	{/if}
</div>
{* since 2.5.0 *}
