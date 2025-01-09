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

{$p_max = ($settings.npp == 'all') ? 0 : ceil($settings.total/$settings.npp)}
{$prev = $settings.p - 1}
{$next = $settings.p + 1}

{* single line for better html layout *}
{function getPageLink page = 1}{if isset($ab_first_page_url)}{$blog->addPageNumber($ab_first_page_url, $page)|escape:'html':'UTF-8'}{else}#{/if}{/function}

<div class="pagination">
	<div class="npp-holder pull-left{if $settings.npp_options|count < 2} hidden{/if}">
		<div class="inline-block">
			<select class="npp form-control">
				{foreach $settings.npp_options as $opt}
					<option value="{$opt|intval}"{if $settings.npp == $opt} selected{/if}>{$opt|intval}</option>
				{/foreach}
				<option value="all"{if $settings.npp == 'all'} selected{/if}>{l s='All' mod='amazzingblog'}</option>
			</select>
		</div>
		<span class="total inline-block">
            <input type="hidden" name="posts_total" class="posts_total" value="{$settings.total|intval}">
            {l s='of %d' mod='amazzingblog' sprintf=[$settings.total]}
        </span>
	</div>
	{if $p_max > 1}
	<div class="pages pull-left{if !empty($p_type) && $p_type == 'ajax'} ajax{/if}">
		<label>{l s='Pages:' d='Shop.Modules.Amazzingblog'}</label>
		{*<a href="{getPageLink page = $prev}" class="go-to-page" data-page="{if $prev}{$prev|intval}{else}1{/if}"><i class="icon-angle-left"></i></a>*}
		{if $prev}
			<a href="{getPageLink page = 1}" class="go-to-page first" data-page="1">1</a>
			{if $prev > 1}
				{if $prev > 2}...{/if}
				<a href="{getPageLink page = $prev}" class="go-to-page" data-page="{$prev|intval}">{$prev|intval}</a>
			{/if}
		{/if}
		<span class="current-page" data-page="{$settings.p|intval}">{$settings.p|intval}</span>
		{if $next <= $p_max}
			{if $next < $p_max}
				<a href="{getPageLink page = $next}" class="go-to-page" data-page="{$next|intval}">{$next|intval}</a>
				{if $next < $p_max - 1}...{/if}
			{/if}
			<a href="{getPageLink page = $p_max}" class="go-to-page last" data-page="{$p_max|intval}">{$p_max|intval}</a>
		{else}
			{$next = $p_max}
		{/if}
		{*<a href="{getPageLink page = $next}" class="go-to-page" data-page="{$next|intval}"><i class="icon-angle-right"></i></a>*}
	</div>
	{/if}
</div>
{* since 1.5.0 *}
