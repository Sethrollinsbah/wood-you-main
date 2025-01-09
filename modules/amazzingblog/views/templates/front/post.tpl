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
*}

{$post = $ab_post}
{$settings = $ab_post_settings}
<div class="amazzingblog post-page">
{if $post && $post.active}
	{if !$blog->is_17}{include file = $blog->getTemplatePath('breadcrumbs.tpl') parents = $ab_cat_parents current_item = $post.title}{/if}
	<h1>{$post.title|escape:'html':'UTF-8'}</h1>
	{if !empty($settings.show_author) || !empty($settings.show_date) || !empty($settings.show_views)}
		<div class="post-info info-block">
			{if !empty($settings.show_author)}
				{$author_name = $blog->getAuthorNameById($post.author)}
				<div class="post-author inline-block">
					{l s='Posted by' mod='amazzingblog'}
					<span><i class="icon-user"></i> {$author_name|escape:'html':'UTF-8'}</span>
				</div>
			{/if}
			{if !empty($settings.show_date)}
				{if $post.publish_from == $blog->empty_date}{$post.publish_from = $post.date_add}{/if}
				<div class="post-date inline-block"><i class="icon-calendar"></i> {$post.publish_from|date_format|escape:'html':'UTF-8'}</div>
			{/if}
			{if !empty($settings.show_views)}
				<div class="post-views inline-block"><i class="icon-eye"></i> {$post.views|intval}</div>
			{/if}
			{if !empty($post.tags)}
				<div class="post-tags inline-block">
					{include file = $blog->getTemplatePath('post-tags.tpl') tags = $post.tags no_commas = true}
				</div>
			{/if}
		</div>
	{/if}
	{if $post.main_img}
		<div class="post-main-image">
			<img src="{$post.main_img|escape:'html':'UTF-8'}" alt="{$post.title|escape:'html':'UTF-8'}">
		</div>
	{/if}
	<div class="post-content">{$post.content nofilter}{* can not be escaped *}</div>
	{if !empty($settings.social_sharing)}
		<div class="post-after-content clearfix">
			<div class="post-sharing pull-right">
				{l s='Share' mod='amazzingblog'}
				<div class="sharing-icons inline-block">
					{foreach $settings.social_sharing as $sn}
						<a href="#" class="social-share" data-network="{$sn|escape:'html':'UTF-8'}">
							<i class="icon-{$sn|escape:'html':'UTF-8'}"></i>
						</a>
					{/foreach}
				</div>
			</div>
		</div>
	{/if}
	{if !empty($settings.show_footer_hook)}
		{hook h='displayPostFooter'}
	{/if}
	{if !empty($blog->general_settings.user_comments)}
		<div id="post-comments" class="post-comments">
			<h4><span class="comments-num">{$ab_comments|count|intval}</span> {l s='comments' mod='amazzingblog'}</h4>
			<div class="comments-list">
				{foreach $ab_comments as $comment}
					{include file = $blog->getTemplatePath('comment.tpl') comment = $comment}
				{/foreach}
			</div>
			{include file = $blog->getTemplatePath('comment-form.tpl') id_post = $post.id_post user_data = $ab_user_data}
		</div>
	{/if}
	{if !empty($settings.show_aftercomments_hook)}
		{hook h='displayPostAfterComments'}
	{/if}
{else}
	{include file = $blog->getTemplatePath('breadcrumbs.tpl') current_item = ''}
	<div class="alert alert-warning">{l s='This post is not available' mod='amazzingblog'}</div>
{/if}
</div>
{* since 1.3.0 *}
