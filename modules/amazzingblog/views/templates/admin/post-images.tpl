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

{$cover = basename($cover)}
{$main_img = basename($main_img)}
{foreach $images as $k => $img}
	{$basename = basename($img)}
	<div class="img-set {if $basename == $cover} cover{/if}{if $basename == $main_img} main_img{/if}" data-img="{$basename|escape:'html':'UTF-8'}">

		<div class="img-holder">
			<div class="img-actions">
				<a href="#" class="set-cover act">{l s='Cover' mod='amazzingblog'}</a>
				<a href="#" class="set-main act">{l s='Main' mod='amazzingblog'}</a>
				<a href="#" class="delete-img act">{l s='Delete' mod='amazzingblog'}</a>
			</div>
			<div class="img-wrapper">
				<img src="{$img|escape:'html':'UTF-8'}">
				<div class="img-actions2 hidden">
					<a href="#" class="set-cover act" title="{l s='Cover' mod='amazzingblog'}"><i class="icon-th-list"></i></a>
					<a href="#" class="set-main act" title="{l s='Main' mod='amazzingblog'}"><i class="icon-image"></i></a>
					<a href="#" class="delete-img act" title="{l s='Delete' mod='amazzingblog'}"><i class="icon-trash"></i></a>
				</div>
			</div>
		</div>
		<div class="img-types">
			{l s='size' mod='amazzingblog'}: <a href="#" class="current-type">m</a>
			<div class="available-types">
				{foreach $image_types as $t => $type}
					<a href="#" data-type="{$t|escape:'html':'UTF-8'}" class="img-type">
						<span class="type-symbol">{$t|escape:'html':'UTF-8'}</span>: <span class="type-name">{$type.value|escape:'html':'UTF-8'} px</span>
					</a>
				{/foreach}
				<a href="#" data-type="orig" class="img-type">
					<span class="type-symbol">orig</span>: <span class="type-name">{l s='Original' mod='amazzingblog'}</span>
				</a>
			</div>
		</div>
	</div>
{/foreach}
{* since 1.3.0 *}
