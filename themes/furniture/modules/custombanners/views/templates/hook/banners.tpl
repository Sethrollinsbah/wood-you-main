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

{if $banners}
<div class="custombanners {$hook_name|escape:'html':'UTF-8'} clearfix" data-hook="{$hook_name|escape:'html':'UTF-8'}">
	{if $hook_name|escape:'html':'UTF-8' == 'displayHome'}
		<h2 class="title_main_section">
			<span>
			{l s='At your service' d='Shop.Custom'}
			</span>
		</h2>
	{/if}
	{foreach $banners as $id_wrapper => $w}
		{if empty($w.banners) || empty($w.settings)}{continue}{/if}
		{$settings = $w.settings.general}
		{$encoded_carousel_settings = $w.settings.carousel}
		<div class="cb-wrapper{if !empty($settings.custom_class)} {$settings.custom_class|escape:'html':'UTF-8'}{/if}" data-wrapper="{$id_wrapper|intval}">
		{if $hook_name|escape:'html':'UTF-8' == 'displayHome'}
		<ul class="tabs_list col-sm-3 col-xs-12">
			{foreach name=items from=$w.banners item=banner}
				<li class="row nav-item addition_{$smarty.foreach.items.iteration}">
					<a class="nav-link {if $smarty.foreach.items.iteration == 1}active{/if}" href="#addition_item{$smarty.foreach.items.iteration}" data-toggle="tab">
						{if $banner.title}
							{$banner.title}
						{else}

						{/if}
					</a>
				</li>
			{/foreach}
		</ul>
		<div class="tab-content tabs_additional clearfix col-sm-9 col-xs-12">
		{/if}
			{if $settings.display_type == 2}
			<div class="carousel" data-settings="{$encoded_carousel_settings|escape:'html':'UTF-8'}">
			{/if}
				{foreach name=items from=$w.banners item=banner}
					<div {if !empty($banner.img) && $hook_name|escape:'html':'UTF-8' == 'displayTopColumn'}style="background-image: url({$banner.img|escape:'html':'UTF-8'})"{/if} {if $hook_name|escape:'html':'UTF-8' == 'displayHome'} role="tabpanel" id="addition_item{$smarty.foreach.items.iteration}"{/if} class="banner-item{if !empty($banner.class)} {$banner.class|escape:'html':'UTF-8'}{/if} banner_{$smarty.foreach.items.iteration} {if $hook_name|escape:'html':'UTF-8' == 'displayHome'}{if $smarty.foreach.items.iteration == 1}active{/if} tab-pane {/if}">
						<div class="banner-item-content">
							{if !empty($banner.img)}
								{if !empty($banner.link.href)}
								<a class="{if $hook_name|escape:'html':'UTF-8' == 'displayCustomBanners3' || $hook_name|escape:'html':'UTF-8' == 'displayCustomBanners1' || $hook_name|escape:'html':'UTF-8' == 'displayCustomBanners2'}awesome-effect{/if}" href="{$banner.link.href|escape:'html':'UTF-8'}" href="{$banner.link.href|escape:'html':'UTF-8'}"{if isset($banner.link._blank)} target="_blank"{/if}>
								{elseif $hook_name|escape:'html':'UTF-8' == 'displayCustomBanners3' || $hook_name|escape:'html':'UTF-8' == 'displayCustomBanners1' || $hook_name|escape:'html':'UTF-8' == 'displayCustomBanners2'}
									<div class="awesome-effect">
								{/if}
								{if $hook_name|escape:'html':'UTF-8' != 'displayTopColumn'}
									<img src="{$banner.img|escape:'html':'UTF-8'}"{if isset($banner.title)} alt="{$banner.title|escape:'html':'UTF-8'}"{/if} class="banner-img{if !empty($banner.img_hover)} primary-image{/if}">
									{if !empty($banner.img_hover)}
										<img src="{$banner.img_hover|escape:'html':'UTF-8'}"{if isset($banner.title)} alt="{$banner.title|escape:'html':'UTF-8'}"{/if} class="banner-img secondary-image">
									{/if}
								{/if}
							{/if}
							{if !empty($banner.html)}
								<div class="custom-html">
									{$banner.html nofilter}{* can not be escaped *}
								</div>
							{/if}
							{if !empty($banner.img)}
							{if !empty($banner.link.href)}
								</a>
							{elseif $hook_name|escape:'html':'UTF-8' == 'displayCustomBanners3' ||$hook_name|escape:'html':'UTF-8' == 'displayCustomBanners1' ||$hook_name|escape:'html':'UTF-8' == 'displayCustomBanners2'}
								</div>
							{/if}
							{/if}
						</div>
					</div>
				{/foreach}
			{if $settings.display_type == 2}
			</div>
			{/if}
			{if $hook_name|escape:'html':'UTF-8' == 'displayHome'}
			</div>
			{/if}
		</div>
	{/foreach}
</div>
{/if}
{* since 2.9.1 *}
