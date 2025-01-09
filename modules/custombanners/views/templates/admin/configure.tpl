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

<div class="alert alert-danger general-ajax-errors" style="display:none;"></div>
{if $magic_quotes_warning}
	<div class="alert alert-danger">
		{l s='You are advised to turn OFF "magic quotes" in your server configuration. This directive is deprecated since 2009 (when PHP 5.3.0 was released)' mod='custombanners'}
		<i class="icon icon-times" data-dismiss="alert"></i>
	</div>
{/if}
{if $multishop_note}
	<div class="alert alert-warning">
		{l s='NOTE: All modifications will be applied to more than one shop' mod='custombanners'}
		<i class="icon icon-times" data-dismiss="alert"></i>
	</div>
{/if}
{if $files_update_warnings}
	<div class="alert alert-warning">
		{l s='Some of your customized files have been updated in the new version' mod='custombanners'}
		<ul>
		{foreach $files_update_warnings as $file => $identifier}
			<li>
				{$file|escape:'html':'UTF-8'}
				<span class="warning-advice">
					{l s='Make sure you update this file in your theme folder, and insert the following code to the last line' mod='custombanners'}:
					<span class="code">{$identifier|escape:'html':'UTF-8'}</span>
				</span>
			</li>
		{/foreach}
		</ul>
	</div>
{/if}
<div class="bootstrap custombanners panel clearfix">
	<h3><i class="icon icon-cogs"></i> {l s='General settings' mod='custombanners'}</h3>
	<div class="col-lg-6">
		{foreach $custom_files as $type => $name}
			<a href="#" class="custom-code" data-toggle="modal" data-target="#custom-{$type|escape:'html':'UTF-8'}-form" title="{$name|escape:'html':'UTF-8'}">
				<span class="monospace">{ldelim}{rdelim}</span> {$name|escape:'html':'UTF-8'}
			</a>
		{/foreach}
	</div>
	<div class="col-lg-6 importer pull-right text-right">
		<form action="" method="post">
			<input type="hidden" name="action" value="exportBannersData">
			<button type="submit" class="export btn btn-default">
				<i class="icon icon-cloud-download icon-lg"></i>
				{l s='Export all banners' mod='custombanners'}
			</button>
		</form>
		<button class="importBannersData btn btn-default">
			<i class="icon icon-cloud-upload icon-lg"></i>
			{l s='Import banners' mod='custombanners'}
		</button>
		<form class="zip-uploader" action="" method="post" enctype="multipart/form-data" style="display:none;">
			<input type="file" name="zipped_banners_data">
			<input type="hidden" name="action" value="importBannersData">
			<button type="submit" class="import btn btn-default">
				<span class="">{l s='GO' mod='custombanners'}</span>
				<i class="icon icon-refresh icon-spin" style="display:none;"></i>
			</button>
		</form>
		<a href="#" data-toggle="modal" data-target="#modal_importer_info" title="{l s='About the importer' mod='custombanners'}">
			<i class="icon-info-circle importer-info"></i>
		</a>
	</div>
</div>
<div class="custombanners all-banners panel">
	<h3><i class="icon icon-image"></i> {l s='Banners' mod='custombanners'}</h3>
	<form class="settings form-horizontal row">
		<label class="control-label col-lg-1" for="hookSelector">
			{l s='Select hook' mod='custombanners'}
		</label>
		<div class="col-lg-3">
			<select class="hookSelector">
				{foreach $hooks item=qty key=hk}
					<option value="{$hk|escape:'html':'UTF-8'}"{if Tools::getValue('hook') == $hk} selected{/if}> {$hk|escape:'html':'UTF-8'} ({$qty|intval}) </option>
				{/foreach}
			</select>
		</div>
		<div class="col-lg-8 hook-settings">
			<button class="btn btn-default callSettings" data-settings="exceptions">
				<i class="icon-ban"></i> {l s='Exceptions' mod='custombanners'}
			</button>
			<button class="btn btn-default callSettings" data-settings="positions">
				<i class="icon-arrows-alt"></i> {l s='Module positions' mod='custombanners'}
			</button>

			<div class="quick-search inline-block absolute transparent">
				<a href="#" class="toggleSearch inline-block"><i class="icon-search"></i> {l s='Quick search' mod='custombanners'}</a>
				<div class="quick-search-content inline-block">
					<div class="inline-block">
						<select class="searchBy">
							<option value="banner_name">{l s='By Banner name' mod='custombanners'}</option>
							<option value="product">{l s='By Product associations' mod='custombanners'}</option>
							<option value="category">{l s='By Category associations' mod='custombanners'}</option>
							<option value="manufacturer">{l s='By Manufacturer associations' mod='custombanners'}</option>
							<option value="supplier">{l s='By Supplier associations' mod='custombanners'}</option>
							<option value="cms">{l s='By CMS associations' mod='custombanners'}</option>
					</select>
					</div>
					<div class="inline-block">
						<input type="text" class="searchByValue">
					</div>
					<a href="#" class="icon-times closeSearch toggleSearch"></a>
				</div>
			</div>


			<button class="addWrapper btn btn-default pull-right">
				<span class="custom-wrapper-icon">
					<i class="t-l"></i><i class="t-r"></i><i class="b-r"></i><i class="b-l"></i>
				</span>
					{l s='New Wrapper' mod='custombanners'}
			</button>
		</div>
	</form>
	<div id="settings-content" style="display:none;">{* filled dinamically *}</div>
	{foreach $hooks item=qty key=hk}
	<div id="{$hk|escape:'html':'UTF-8'}" class="hook-content{if $hk == 'displayHome'} active{/if}">
		{if $hk|substr:0:20 == 'displayCustomBanners'}
		<div class="alert alert-info">
			{l s='In order to display this hook, insert the following code to any tpl' mod='custombanners'}: <strong>{literal}{hook h='{/literal}{$hk|escape:'html':'UTF-8'}{literal}'}{/literal}</strong>
		</div>
		{/if}
		<div class="wrappers-container">
			{if isset($banners.$hk)}
				{foreach $banners.$hk as $id_wrapper => $banners_in_wrapper}
					{include file="./wrapper-form.tpl" banners=$banners_in_wrapper id_wrapper=$id_wrapper}
				{/foreach}
			{/if}
		</div>
	</div>
	{/foreach}
	<div class="alert alert-warning no-matches hidden">
		{l s='No matches' mod='custombanners'}
	</div>
	<div class="classes-wrapper" style="display:none;">
	<div class="predefined-classes round-border">
		<i class="caret-t"></i>
		<div class="col-md-6">
			{foreach $bs_classes as $class => $width}
			<div class="row">
				<label class="control-label grey-note col-md-11">
					{l s='Banner width for displays, wider than %d' mod='custombanners' sprintf=$width}:
				</label>
				<div class="col-md-1">
					<div class="multiclass">
						<i class="icon-bars cursor-pointer"></i>
						<div class="list" style="display:none;">
							<i class="caret-l"></i>
							<ul>
							{for $col=1 to 12}
								<li class="" data-class="col-{$class|escape:'html':'UTF-8'}-{$col|intval}">
									<span class="cl"><span class="fragment">col-{$class|escape:'html':'UTF-8'}-</span>{$col|intval}</span>
									<span class="grey-note">{($col*100/12)|round:2|floatval}%</span>
								</li>
							{/for}
							</ul>
						</div>
					</div>
				</div>
			</div>
			{/foreach}
		</div>
		<div class="col-md-6">
			<div class="row">
				<label class="control-label grey-note col-md-8">
					<span class="label-tooltip" data-toggle="tooltip" title="{l s='Use this class if you want to place a caption over the image' mod='custombanners'}">{l s='Place HTML over the image' mod='custombanners'}:</span>
				</label>
				<div class="col-md-4">
					<div class="cl" data-class="html-over">html-over</div>
				</div>
			</div>
			<div class="row">
				<label class="control-label grey-note col-md-8">
					<span class="label-tooltip" data-toggle="tooltip" title="{l s='Affects all images within banner container if no other overrides are applied' mod='custombanners'}">
					{l s='Round borders for the images' mod='custombanners'}:
					</span>
				</label>
				<div class="col-md-4">
					<div class="cl" data-class="img-rb">img-rb</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<div class="config-footer">
		<div class="btn-group bulk-actions dropup">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				{l s='Bulk actions' mod='custombanners'} <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a href="#"	class="bulk-select"><i class="icon-check-sign"></i> {l s='Check all' mod='custombanners'}</a></li>
				<li><a href="#" class="bulk-unselect"><i class="icon-check-empty"></i> {l s='Uncheck all' mod='custombanners'}</a></li>
				<li class="divider"></li>
				<li><a href="#" data-bulk-act="enable"><i class="icon-check on"></i> {l s='Enable' mod='custombanners'}</a></li>
				<li><a href="#" data-bulk-act="disable"><i class="icon-times off"></i> {l s='Disable' mod='custombanners'}</a></li>
				<li class="dont-hide">
					<a href="#" class="toggle-hook-list"><i class="icon icon-copy"></i> {l s='Copy to hook' mod='custombanners'}</a>
					<div class="dynamic-hook-list" style="display:none;">
						<button class="btn btn-default" data-bulk-act="copy">{l s='OK' mod='custombanners'}</button>
					</div>
				</li>
				<li class="dont-hide">
					<a href="#" class="toggle-hook-list"><i class="icon icon-arrow-left"></i> {l s='Move to hook' mod='custombanners'}</a>
					<div class="dynamic-hook-list" style="display:none;">
						<button class="btn btn-default" data-bulk-act="move">{l s='OK' mod='custombanners'}</button>
					</div>
				</li>
				<li class="divider"></li>
				<li><a href="#" data-bulk-act="delete"><i class="icon-trash"></i> {l s='Delete' mod='custombanners'}</a></li>
			</ul>
		</div>
		<button type="button" class="deleteAll btn btn-default pull-right" data-bulk-act="deleteAll">
			<i class="icon icon-trash"></i> {l s='Delete all banners' mod='custombanners'}
		</button>
	</div>
</div>

{foreach $modals as $modal}
<div class="modal fade" id="{$modal.id|escape:'html':'UTF-8'}" tabindex="-1">
	<div class="modal-dialog {$modal.class|escape:'html':'UTF-8'}">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">
					{if !empty($modal.title_icon)}<i class="icon-{$modal.title_icon|escape:'html':'UTF-8'}"></i>{/if}
					{$modal.title|escape:'html':'UTF-8'}
				</h4>
			</div>
			<div class="clearfix">{$modal.content} {* can not be escaped *}</div>
		</div>
	</div>
</div>
{/foreach}

{* this button is dynamically moved to top *}
<a id="module-documentation" class="toolbar_btn hidden" href="{$documentation_link|escape:'html':'UTF-8'}" target="_blank" title="{l s='Documentation' mod='custombanners'}">
	<i class="process-icon-t icon-file-text"></i>
	<div>{l s='Documentation' mod='custombanners'}</div>
</a>
{literal}
<script type="text/javascript">
	$(document).ready(function(){
		$('ul.nav.nav-pills').prepend('<li class="li-docs"></li>');
		$('#module-documentation').prependTo('.li-docs').removeClass('hidden');
	});
</script>
{/literal}
{* since 2.9.0 *}
