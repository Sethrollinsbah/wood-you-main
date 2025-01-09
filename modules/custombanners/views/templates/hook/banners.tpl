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
	{foreach $banners as $id_wrapper => $w}
		{if empty($w.banners) || empty($w.settings)}{continue}{/if}
		{$settings = $w.settings.general}
		{$encoded_carousel_settings = $w.settings.carousel}
		<div class="cb-wrapper{if !empty($settings.custom_class)} {$settings.custom_class|escape:'html':'UTF-8'}{/if}" data-wrapper="{$id_wrapper|intval}">
			{if $settings.display_type == 2}
			<div class="carousel" data-settings="{$encoded_carousel_settings|escape:'html':'UTF-8'}">
			{/if}
				{foreach $w.banners as $banner}
					<div class="banner-item{if !empty($banner.class)} {$banner.class|escape:'html':'UTF-8'}{/if}">
						<div class="banner-item-content">
							{if !empty($banner.img)}
								{if !empty($banner.link.href)}
								<a href="{$banner.link.href|escape:'html':'UTF-8'}"{if isset($banner.link._blank)} target="_blank"{/if}>
								{/if}
									<img src="{$banner.img|escape:'html':'UTF-8'}"{if isset($banner.title)} alt="{$banner.title|escape:'html':'UTF-8'}"{/if} class="banner-img{if !empty($banner.img_hover)} primary-image{/if}">
									{if !empty($banner.img_hover)}
										<img src="{$banner.img_hover|escape:'html':'UTF-8'}"{if isset($banner.title)} alt="{$banner.title|escape:'html':'UTF-8'}"{/if} class="banner-img secondary-image">
									{/if}
								{if !empty($banner.link.href)}
								</a>
								{/if}
							{/if}
							{if !empty($banner.html)}
								<div class="custom-html">
									{$banner.html nofilter}{* can not be escaped *}
								</div>
							{/if}
						</div>
					</div>
				{/foreach}
			{if $settings.display_type == 2}
			</div>
			{/if}
		</div>
	{/foreach}
</div>
{/if}
{* since 2.9.1 *}
