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

<div class="item clearfix" data-id="{$post.id_post|intval}">
<form method="post" action="" class="form-horizontal">
	<input type="hidden" name="id_post" value="{$post.id_post|intval}">
	<input type="hidden" name="active" value="{$post.active|intval}">
	<input type="hidden" name="author" value="{$post.author|intval}">
	{include file='./item-header.tpl' item=$post type='post'}
	{if !empty($full)}
	<div class="details" style="display:none;">
		<div class="tabs-wrapper clearfix">
			<ul class="post-tabs-list col-lg-offset-2">
			{foreach $post_tabs as $identifier => $display_name}
				<li><a href="#post_tab_{$identifier|escape:'html':'UTF-8'}" class="tab-trigger{if $current_tab == $identifier} current{/if}">{$display_name|escape:'html':'UTF-8'}</a></li>
			{/foreach}
			</ul>
		</div>
		<div class="post-tabs">
			{foreach array_keys($post_tabs) as $identifier}
				<div id="post_tab_{$identifier|escape:'html':'UTF-8'}" class="post-tab{if $current_tab == $identifier} current{/if}">
					{foreach $post.editable_fields as $k => $field}
					{if $field.tab != $identifier}{continue}{/if}
					{if $field.tab == 'related'}
						<div class="alert alert-info col-lg-offset-2">
							{l s='Related products will be displayed at the bottom of post page.' mod='amazzingblog'}
							<a href="{$blog->getConfigPagePath()|escape:'html':'UTF-8'}&tab=blocks&hook=displayPostFooter" target="_blank">
								{l s='Edit block "Related products"' mod='amazzingblog'} <i class="icon-external-link-sign"></i>
							</a>
						</div>
					{/if}
					{$name = $field.input_name}
					<div class="form-group{if !empty($field.class)} {$field.class|escape:'html':'UTF-8'}{/if}">
						<label class="control-label col-lg-2">
							{if $field.class|strstr:'autofill'}
								<a href="#" class="icon-repeat act generateFieldValue" title="{l s='Generate' mod='amazzingblog'}" data-name="{$k|escape:'html':'UTF-8'}"></a>
							{/if}
							<span{if !empty($field.tooltip)} class="label-tooltip" data-toggle="tooltip" title="{$field.tooltip|escape:'html':'UTF-8'}"{/if}>
								{$field.display_name|escape:'html':'UTF-8'}
							</span>
						</label>
						<div class="post-field col-lg-{if $identifier != 'publishing'}10{else}5{/if}">
						{if empty($field.multilang)}
							{if $k == 'categories'}
								<div class="post-categories open">
									{include file='./category-tree.tpl'
										type = 'checkbox'
										name = $field.input_name
										checked = $field.value
										id_category_default = $post.id_category_default
										post_categories = 1
									}
								</div>
							{else if $k == 'images'}
								<div class="post-images clearfix{if !$post.id_post} no-id{/if}">
									{if !$post.id_post}
										{* not used in current version *}
										<div class="alert alert-warning">
											<a href="#" class="getPostId" title="{l s='Save now' mod='amazzingblog'}">{l s='Save the post' mod='amazzingblog'}</a>
											{l s='before uploading images' mod='amazzingblog'}
										</div>
									{/if}
									<div class="img-list">
										{include file="./post-images.tpl" images=$field.value cover=$post.cover main_img=$post.main_img}
										<div class="img-set add-new">
											<div class="hidden">
												<div class="img-set upload-progress"><div class="img-holder"><div class="img-wrapper"><i class="icon-refresh icon-spin act spinner"></i></div></div></div>
												<input type="file" class="post-img" multiple>
											</div>
											<div class="img-holder">
												<div class="img-wrapper">
													<a href="#" class="add-img act" title="{l s='Browse or drag' mod='amazzingblog'}">+</a>
												</div>
											</div>
										</div>
									</div>
									<div class="drag-note">
										<span class="text">{l s='Drag' mod='amazzingblog'}</span>
										<div class="curved-arrow"></div>
									</div>
								</div>
							{else}
								{include file="./field.tpl" field=$field k=$k}
							{/if}
						{else}
							{include file="./multilang-field.tpl" field=$field k=$k}
						{/if}
						</div>
					</div>
					{/foreach}
				</div>
			{/foreach}
		</div>
		<div class="col-lg-offset-2 item-footer">
			<button type="button" class="btn btn-default btn save"><i class="icon-save"></i> {l s='Save post' mod='amazzingblog'}</button>
			{* if button type is not specified, it will be auto-clicked, when enter is pressed on focused input *}
			<button class="btn btn-default btn save dont-scroll-up"><i class="icon-save"></i> {l s='Save and stay' mod='amazzingblog'}</button>
			{if $post.active}
				<a href="{$blog->getPostLink($post.id_post)|escape:'html':'UTF-8'}" class="view-post-online" target="_blank">
					{l s='View post online' mod='amazzingblog'} <i class="icon-external-link-sign"></i>
				</a>
			{/if}
		</div>
	</div>
	{/if}
</form>
</div>
{* since 1.3.0 *}
