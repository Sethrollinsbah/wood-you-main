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
	<div class="alert alert-warning">
		{l s='Some of files, that you customized, have need updated in the new version' mod='amazzingblog'}
		<ul>
		{foreach $files_update_warnings as $file => $identifier}
			<li>
				{$file|escape:'html':'UTF-8'}
				<span class="warning-advice">
					{l s='Make sure you update this file in your theme folder, and insert the following code to the last line' mod='amazzingblog'}:
					<span class="code">{$identifier|escape:'html':'UTF-8'}</span>
				</span>
			</li>
		{/foreach}
		</ul>
	</div>
{/if}
<div class="bootstrap amazzingblog clearfix{if empty($blog->general_settings.user_comments)} no-comments{/if}">
	<div class="menu-panel col-lg-2 col-md-3">
		<div class="list-group">
			<a href="#posts" class="list-group-item active"><i class="icon-pencil"></i> {l s='Posts' mod='amazzingblog'}</a>
			<a href="#categories" class="list-group-item"><i class="icon-sitemap"></i> {l s='Categories' mod='amazzingblog'}</a>
			<a href="#comments" class="list-group-item user-comments"><i class="icon-comments"></i> {l s='Comments' mod='amazzingblog'}{if $new_comments_num} <span class="badge total">{$new_comments_num|intval}</span>{/if}</a>
			<a href="#blocks" class="list-group-item"><i class="icon-plus-square"></i> {l s='Blocks' mod='amazzingblog'}</a>
			<a href="#sub" class="list-group-item" data-sub="settings"><i class="icon-cogs"></i> {l s='Settings' mod='amazzingblog'} <i class="icon-caret-down pull-right"></i></a>
			{foreach $settings_types as $identifier => $type_name}
				<a href="#{$identifier|escape:'html':'UTF-8'}_settings" class="list-group-item sub-item settings hidden{if $identifier == 'comment'} user-comments{/if}">
					<i class="icon-angle-right"></i> {$type_name|escape:'html':'UTF-8'}
				</a>
			{/foreach}
			<a href="#import" class="list-group-item"><i class="icon-file-zip-o"></i> {l s='Import/Export' mod='amazzingblog'}</a>
			<a href="#info" class="list-group-item"><i class="icon-info-circle"></i> {l s='Information' mod='amazzingblog'}</a>
		</div>
	</div>
	<div class="panel col-lg-10 col-md-9">
		<div id="posts" class="tab-content active" data-resource="Post">
			<h3 class="panel-title">
				<span class="text">{l s='Posts' mod='amazzingblog'}</span>
				<span class="badge total">{$total_posts_num|intval}</span>
			</h3>
			<div class="filter-sort clearfix">
				<div class="pull-left">
					{include file="../front/sorting.tpl"}
				</div>
				<form class="filtering pull-left">
					<div class="inline-block">
						{include file="./category-tree.tpl" type = 'select' name = 'id_category' checked = ['-'] class = 'filter-by category'}
					</div>
					{if $tags_options}
					<div class="inline-block">
						<select name="id_tag" class="filter-by id_tag">
							<option value="-">{l s='Filter by tags' mod='amazzingblog'}</option>
							{foreach $tags_options as $lang_iso => $options}
								<optgroup label="{$lang_iso|escape:'html':'UTF-8'}">
									{foreach $options as $id_tag => $tag_name}
										<option value="{$id_tag|escape:'html':'UTF-8'}">{$tag_name|escape:'html':'UTF-8'}</option>
									{/foreach}
								</optgroup>
							{/foreach}
						</select>
					</div>
					{/if}
					<div class="inline-block">
						<select name="author" class="filter-by author">
							<option value="-">{l s='Filter by author' mod='amazzingblog'}</option>
							{foreach $authors as $id => $name}
								<option value="{$id|intval}">{$name|escape:'html':'UTF-8'}</option>
							{/foreach}
						</select>
					</div>
					<div class="inline-block">
						<select name="state" class="filter-by state">
							<option value="-">{l s='Filter by state' mod='amazzingblog'}</option>
							{foreach $state_options as $input_name => $name}
								<option value="{$input_name|escape:'html':'UTF-8'}">{$name|escape:'html':'UTF-8'}</option>
							{/foreach}
						</select>
					</div>
				</form>
				<button class="btn btn-primary pull-right add">
					<i class="icon-plus hidden-on-loading"></i>
					<i class="icon-refresh icon-spin hidden-on-static"></i>
					{l s='New post' mod='amazzingblog'}
				</button>
            </div>
			<div class="list">
			{foreach $posts as $post}
				{include file="./post-form.tpl" post=$post}
			{/foreach}
			</div>
			{$pagination_posts} {* can not be escaped *}
		</div>
		<div id="categories" class="tab-content" data-resource="Category">
			<h3 class="panel-title">
				<span class="text">{l s='Categories' mod='amazzingblog'}</span>
				<span class="badge total">{$total_cats_num|intval}</span>
			</h3>
			<button class="btn btn-primary pull-right add"><i class="icon-plus"></i> {l s='New category' mod='amazzingblog'}</button>
			{include file="./category-tree.tpl"
				type = 'full'
				name = 'cat_ids[]'
				checked = [$root_id]
			}
		</div>
		<div id="comments" class="tab-content" data-resource="Comment">
			<h3 class="panel-title">
				<span class="text">{l s='Comments' mod='amazzingblog'}</span>
				<span class="badge total">{$total_comments_num|intval}</span>
			</h3>
			<form class="filtering row">
				{foreach $comment_filters as $k => $filter}
					<div class="col-lg-2">
						<select name="{$k|escape:'html':'UTF-8'}" class="filter-by">
							<option value="-">{$filter.label|escape:'html':'UTF-8'}</option>
						{foreach $filter.options as $name => $opt}
							<option value="{$name|escape:'html':'UTF-8'}">{$opt|truncate:55|escape:'html':'UTF-8'}</option>
						{/foreach}
						</select>
					</div>
				{/foreach}
			</form>
			<div class="list">
			{foreach $comments as $comment}
				{include file="./comment-form.tpl" comment=$comment}
			{/foreach}
			</div>
			{$pagination_comments} {* can not be escaped *}
		</div>
		<div id="blocks" class="tab-content" data-resource="Block">
			<h3 class="panel-title"><span class="text">{l s='Blocks' mod='amazzingblog'}</span></h3>
			<div class="alert alert-info">
				{l s='Blocks are used to display posts in different places on your site' mod='amazzingblog'}.
				{l s='For example: [1]latest posts[/1] on main page, [1]related posts[/1] on product page, etc...' mod='amazzingblog' tags=['<b>']}
			</div>
			<form class="settings form-horizontal clearfix">
				<label class="inline-block" for="hookSelector">
					{l s='Select hook' mod='amazzingblog'}
				</label>
				<div class="inline-block">
					<select class="hookSelector">
						{foreach $hooks item=qty key=hk}
							<option value="{$hk|escape:'html':'UTF-8'}"> {$hk|escape:'html':'UTF-8'} ({$qty|intval}) </option>
						{/foreach}
					</select>
				</div>
				<div class="inline-block hook-settings">
					<button class="btn btn-default callHookSettings" data-settings="exceptions">
						<i class="icon-ban"></i> {l s='Exceptions' mod='amazzingblog'}
					</button>
					<button class="btn btn-default callHookSettings" data-settings="positions">
						<i class="icon-arrows-alt"></i> {l s='Module positions' mod='amazzingblog'}
					</button>
				</div>
				<button class="btn btn-primary pull-right add"><i class="icon-plus"></i> {l s='New block' mod='amazzingblog'}</button>
			</form>
			<div id="settings-content" style="display:none;">{* filled dinamically *}</div>
			<div class="alert alert-info hook-note hidden">
			{l s='In order to display this hook, insert the following code to any tpl' mod='amazzingblog'}: <strong></strong>
			</div>
			<div class="list">
			{foreach $blocks as $block}
				{include file="./block-form.tpl" block=$block}
			{/foreach}
			</div>
		</div>
		{foreach $settings_types as $identifier => $type_name}
			<div id="{$identifier|escape:'html':'UTF-8'}_settings" class="tab-content" data-resource="{Tools::ucfirst($identifier)|escape:'html':'UTF-8'}Settings">
				<h3 class="panel-title"><span class="text">{l s='%s settings' mod='amazzingblog' sprintf=[$type_name]}</span></h3>
				{if $identifier == 'img'}<div class="alert alert-info">{l s='Format: "width*height". For example: 55*55' mod='amazzingblog'}</div>{/if}
				{include file="./settings-form.tpl" settings=$blog->getSettingsFields($identifier, true) type=$identifier}
			</div>
		{/foreach}
		<div id="import" class="tab-content"  data-resource="Import">
			<h3 class="panel-title"><span class="text">{l s='Import/Export data' mod='amazzingblog'}</span></h3>
			<form action="" method="post">
				<input type="hidden" name="action" value="exportData">
				<div class="import-block">
					<label class="user-comments"><input type="checkbox" name="include_comments" checked> {l s='Include comments' mod='amazzingblog'}</label>
					<label><input type="checkbox" name="include_related_products" checked> {l s='Include related products' mod='amazzingblog'}</label>
					<button type="submit" class="export btn btn-default">
						<i class="icon icon-download icon-rotate-180 icon-lg"></i>
						{l s='Export blog data' mod='amazzingblog'}
					</button>
				</div>
				<div class="import-block">
					<label class="user-comments"><input type="checkbox" name="include_comments"> {l s='Include comments' mod='amazzingblog'}</label>
					<label><input type="checkbox" name="include_related_products"> {l s='Include related products' mod='amazzingblog'}</label>
					<button class="importData btn btn-default">
						<i class="icon icon-download icon-lg"></i>
						{l s='Import blog data' mod='amazzingblog'}
					</button>
					<div class="hidden"><input type="file" name="zipped_data"></div>
				</div>
				<span class="progress-notification grey-note hidden"> <i class="icon-refresh icon-spin"></i> {l s='Data is being imported. Please do not close/refresh this window' mod='amazzingblog'}</span>
			</form>
		</div>
		<div id="info" class="tab-content">
			<h3 class="panel-title"><span class="text">{l s='Information' mod='amazzingblog'}</span></h3>
			<div class="info-row">
				Current version: <b>{$blog->version|escape:'html':'UTF-8'}</b>
			</div>
			<div class="info-row">
				<a href="{$info_links.changelog|escape:'html':'UTF-8'}" target="_blank">
					<i class="icon-code-fork"></i> {l s='Changelog' mod='amazzingblog'}
				</a>
			</div>
			<div class="info-row">
				<a href="{$info_links.documentation|escape:'html':'UTF-8'}" target="_blank">
					<i class="icon-file-text"></i> {l s='Documentation' mod='amazzingblog'}
				</a>
			</div>
			<div class="info-row">
				<a href="{$info_links.contact|escape:'html':'UTF-8'}" target="_blank">
					<i class="icon-envelope"></i> {l s='Contact us' mod='amazzingblog'}
				</a>
			</div>
			<div class="info-row">
				<a href="{$info_links.modules|escape:'html':'UTF-8'}" target="_blank">
					<i class="icon-download"></i> {l s='Our modules' mod='amazzingblog'}
				</a>
			</div>
		</div>
	</div>
</div>
{* since 1.3.0 *}
