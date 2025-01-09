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

{if $files_update_warnings}
	<div class="alert alert-warning files-warning">
		{l s='Some of files, that you customized, have need updated in the new version' mod='testimonialswithavatars'}
		<ul>
		{foreach $files_update_warnings as $file => $identifier}
			<li>
				{$file|escape:'html':'UTF-8'}
				<span class="warning-advice">
					{l s='Make sure you update this file in your theme folder, and insert the following code to the last line' mod='testimonialswithavatars'}:
					<span class="code">{$identifier|escape:'html':'UTF-8'}</span>
				</span>
			</li>
		{/foreach}
		</ul>
		<a href="{$info_links.documentation|escape:'html':'UTF-8'}" class="more-info" target="_blank">{l s='More info' mod='testimonialswithavatars'}</a>
	</div>
{/if}

{function renderSaveBtn}
<div class="panel-footer">
	<button type="button" class="submitSettings btn btn-default">
		<i class="process-icon-save"></i> {l s='Save' mod='testimonialswithavatars'}
	</button>
</div>
{/function}

<div class="bootstrap testimonialswithavatars clearfix">
	<div class="menu-panel col-lg-2 col-md-3">
		<div class="list-group">
			<a href="#testimonials" class="list-group-item active"><i class="icon-smile"></i> {l s='Testimonials' mod='testimonialswithavatars'}</a>
			{$icons = ['controller' => 'th', 'seo' => 'search']}
			{foreach $settings as $type => $title}
				<a href="#{$type}_settings" class="list-group-item">
					<i class="icon-{if isset($icons.$type)}{$icons.$type|escape:'html':'UTF-8'}{else}cogs{/if}"></i>
					{$title|escape:'html':'UTF-8'}
				</a>
			{/foreach}
			<a href="#sub" class="list-group-item" data-sub="settings"><i class="icon-anchor"></i> {l s='Hook Settings' mod='testimonialswithavatars'} <i class="icon-caret-down pull-right"></i></a>
			{foreach $hooks as $hook_name}
				<a href="#{$hook_name|escape:'html':'UTF-8'}_settings" class="list-group-item sub-item settings">
					{$hook_name|escape:'html':'UTF-8'}
					<span class="icon-check pull-right hidden"></span>
				</a>
			{/foreach}
			<a href="#info" class="list-group-item"><i class="icon-info-circle"></i> {l s='Information' mod='testimonialswithavatars'}</a>
		</div>
	</div>
	<div class="panel col-lg-10 col-md-9">
		<div id="testimonials" class="tab-content active">
			<h3 class="panel-title"><span class="text">{l s='Testimonials' mod='testimonialswithavatars'}</span></h3>
			<div class="postList">
				{include file="./post-list.tpl" posts=$posts}
			</div>
			<div class="clearfix ">
				<button id="loadMore" class="btn btn-primary">
					<span>{l s='Load More' mod='testimonialswithavatars'}</span>
					<i class="icon-refresh icon-spin" style="display:none;"></i>
				</button>
				<span class="no_more_posts" style="display:none;">{l s='That is all' mod='testimonialswithavatars'}</span>
			</div>
		</div>
		{foreach $settings as $type => $title}
			<div id="{$type|escape:'html':'UTF-8'}_settings" class="tab-content">
				<h3 class="panel-title"><span class="text">{$title|escape:'html':'UTF-8'}</span></h3>
				<form class="form-horizontal">
					{foreach $twa->getSettingsFields($type) as $name => $field}
						{include file="./form-group.tpl" name=$name input_name=$name form_identifier=$type|cat:'_settings'}
					{/foreach}
					<input type="hidden" name="settings_type" value="{$type|escape:'html':'UTF-8'}">
					{renderSaveBtn}
				</form>
			</div>
		{/foreach}
		{foreach $hooks as $hook_name}
			<div id="{$hook_name|escape:'html':'UTF-8'}_settings" class="tab-content">
				<h3 class="panel-title"><span class="text">{l s='Settings for hook %s' mod='testimonialswithavatars' sprintf=[$hook_name]}</span></h3>
				{if $hook_name|substr:0:12 == 'testimonials'}
					<div class="alert alert-info">
						{l s='In order to display this hook, use the following code' mod='testimonialswithavatars'}:
						<span class="b">{literal}{hook h='{/literal}{$hook_name|escape:'html':'UTF-8'}{literal}'}{/literal}</span><br>
						{l s='You can insert this code anywhere you want - directly in any editable area (CMS page, product description etc), or in any tpl file' mod='testimonialswithavatars'}
					</div>
				{/if}
				<form class="form-horizontal" data-hook="{$hook_name|escape:'html':'UTF-8'}">
					{foreach $twa->getSettingsFields('hook', $hook_name) as $name => $field}
						{include file="./form-group.tpl" name=$name input_name=$name form_identifier=$hook_name|cat:'_settings'}
					{/foreach}
					<input type="hidden" name="settings_type" value="hook">
					<input type="hidden" name="hook_name" value="{$hook_name|escape:'html':'UTF-8'}">
					{renderSaveBtn}
				</form>
			</div>
		{/foreach}
		<div id="info" class="tab-content">
			<h3 class="panel-title"><span class="text">{l s='Information' mod='testimonialswithavatars'}</span></h3>
			<div class="info-row">
				{l s='Current version' mod='testimonialswithavatars'}: <b>{$twa->version|escape:'html':'UTF-8'}</b>
			</div>
			<div class="info-row">
				<a href="{$info_links.changelog|escape:'html':'UTF-8'}" target="_blank">
					<i class="icon-code-fork"></i> {l s='Changelog' mod='testimonialswithavatars'}
				</a>
			</div>
			<div class="info-row">
				<a href="{$info_links.documentation|escape:'html':'UTF-8'}" target="_blank">
					<i class="icon-file-text"></i> {l s='Documentation' mod='testimonialswithavatars'}
				</a>
			</div>
			<div class="info-row">
				<a href="{$info_links.contact|escape:'html':'UTF-8'}" target="_blank">
					<i class="icon-envelope"></i> {l s='Contact us' mod='testimonialswithavatars'}
				</a>
			</div>
			<div class="info-row">
				<a href="{$info_links.modules|escape:'html':'UTF-8'}" target="_blank">
					<i class="icon-download"></i> {l s='Our modules' mod='testimonialswithavatars'}
				</a>
			</div>
		</div>
	</div>
</div>
{* since 2.5.0 *}
