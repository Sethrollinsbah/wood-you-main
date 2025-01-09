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

{$link = $blog->getPostLink($post.id_post, $post.link_rewrite)}
<div class="post-item-wrapper{if $col} col-md-{$col|intval}{if $k % $settings.col_num == 0} first-in-line{/if}{/if}">
	<div class="post-item-compact{if !empty($settings.show_date)} has-date{/if}">
		{if !empty($settings.cover_type)}
			{$cover_src = $blog->getImgSrc('post', $post.id_post, $settings.cover_type, $post.cover)}
			{if !empty($cover_src)}
				<div class="post-item-cover-compact">
					{if !empty($settings.link_cover)}<a href="{$link|escape:'html':'UTF-8'}">{/if}
					<img src="{$cover_src|escape:'html':'UTF-8'}" alt="{$post.title|escape:'html':'UTF-8'}">
					{if !empty($settings.link_cover)}</a>{/if}
				</div>
			{/if}
		{/if}
        {if !empty($settings.title_truncate)}
			<h5 class="post-item-title-compact overflow-ellipsis b">
				{if !empty($settings.link_title)}<a href="{$link|escape:'html':'UTF-8'}">{/if}
					{$post.title|truncate:$settings.title_truncate:'...'|escape:'html':'UTF-8'}
				{if !empty($settings.link_title)}</a>{/if}
			</h5>
		{/if}
		{if !empty($settings.truncate)}
			<div class="post-item-content-compact">
				{$post.content|strip_tags|truncate:$settings.truncate:'...'|escape:'html':'UTF-8'}
				{if !empty($settings.show_readmore)}
					<a href="{$link|escape:'html':'UTF-8'}" title="{l s='Read more' mod='amazzingblog'}" class="item-readmore-compact">
						<i class="icon-angle-right"></i>
						<i class="icon-angle-right second"></i>
					</a>
				{/if}
			</div>
		{/if}
		{if !empty($settings.show_date) || !empty($settings.show_author) || !empty($settings.show_views) || !empty($settings.show_comments) || !empty($settings.show_tags)}
			<div class="post-item-infos-compact clearfix">
				{$has_author_or_date = !empty($settings.show_date) || !empty($settings.show_author)}
				{if !empty($settings.show_tags) && !empty($post.tags)}
					<div class="post-item-tags-compact{if !$has_author_or_date} inline-block{/if}">
					<i class="icon-tags"></i>
					{include file = $tags_tpl_path tags = $post.tags fill = false}
					</div>
				{/if}
				{if !empty($settings.show_date)}
					<span class="post-item-info date">
						{if $post.publish_from == $blog->empty_date}{$post.publish_from = $post.date_add}{/if}
						{$post.publish_from|date_format|escape:'html':'UTF-8'}
					</span>
				{/if}
				{if !empty($settings.show_author)}
					<span class="post-item-info author">
						<i class="icon-user"></i>
						{$post.firstname|escape:'html':'UTF-8'} {$post.lastname|escape:'html':'UTF-8'}
					</span>
				{/if}
				{if !empty($settings.show_views)}
					<span class="post-item-info views-num{if $has_author_or_date} pull-right{/if}">
						<i class="icon-eye"></i>
						{$post.views|intval}
					</span>
				{/if}
				{if !empty($settings.show_comments)}
					<a href="{$link|escape:'html':'UTF-8'}#post-comments" class="post-item-info comments-num{if $has_author_or_date} pull-right{/if}">
						<i class="icon-comment"></i>
						{$post.comments|intval}
					</a>
				{/if}
			</div>
		{/if}
	</div>
</div>
{* since 1.3.0 *}
