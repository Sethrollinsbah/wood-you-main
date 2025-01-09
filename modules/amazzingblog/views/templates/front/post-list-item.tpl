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
	<div class="post-item{if !empty($settings.show_date)} has-date{/if}">
		{if !empty($settings.cover_type)}
			{$cover_src = $blog->getImgSrc('post', $post.id_post, $settings.cover_type, $post.cover)}
			{if !empty($cover_src)}
				<div class="post-item-cover">
					{if !empty($settings.link_cover)}<a href="{$link|escape:'html':'UTF-8'}">{/if}
						<img src="{$cover_src|escape:'html':'UTF-8'}" alt="{$post.title|escape:'html':'UTF-8'}">
					{if !empty($settings.link_cover)}</a>{/if}
				</div>
			{/if}
		{/if}
		{if !empty($settings.show_date)}
			{if $post.publish_from == $blog->empty_date}{$post.publish_from = $post.date_add}{/if}
			{$split_date = $blog->prepareDate($post.publish_from)}
			<div class="post-item-date">
				{foreach $split_date as $i => $fragment}
					<div class="{$i|escape:'html':'UTF-8'}">{$fragment|escape:'html':'UTF-8'}</div>
				{/foreach}
			</div>
		{/if}
		{if !empty($settings.title_truncate)}
			<h3 class="post-item-title{if $settings.display_type == 'grid' || $settings.display_type == 'carousel'} overflow-ellipsis{/if}">
				{if !empty($settings.link_title)}<a href="{$link|escape:'html':'UTF-8'}">{/if}
					{$post.title|truncate:$settings.title_truncate:'...'|escape:'html':'UTF-8'}
				{if !empty($settings.link_title)}</a>{/if}
			</h3>
		{/if}
		{if !empty($settings.truncate)}
			<div class="post-item-content">{$post.content|strip_tags|truncate:$settings.truncate:'...'|escape:'html':'UTF-8'}</div>
		{/if}
		{if !empty($settings.show_author) || !empty($settings.show_views) || !empty($settings.show_comments) || !empty($settings.show_readmore) || !empty($settings.show_tags)}
			<div class="post-item-footer clearfix">
				<div class="post-item-infos pull-left">
					{if !empty($settings.show_author)}
						<span class="post-item-info author">
							<i class="icon-user"></i>
							{$post.firstname|escape:'html':'UTF-8'} {$post.lastname|escape:'html':'UTF-8'}
						</span>
					{/if}
					{if !empty($settings.show_views)}
						<span class="post-item-info views-num">
							<i class="icon-eye"></i>
							{$post.views|intval}
						</span>
					{/if}
					{if !empty($settings.show_comments)}
						<a href="{$link|escape:'html':'UTF-8'}#post-comments" class="post-item-info comments-num">
							<i class="icon-comment"></i>
							{$post.comments|intval}
						</a>
					{/if}
					{if !empty($settings.show_tags) && !empty($post.tags)}
						{include file = $tags_tpl_path tags = $post.tags}
					{/if}
				</div>
				{if !empty($settings.truncate) && !empty($settings.show_readmore)}
					<a href="{$link|escape:'html':'UTF-8'}" title="{l s='Read more' mod='amazzingblog'}" class="item-readmore pull-right">
						{l s='Read more' mod='amazzingblog'}
						<i class="icon-arrow-right"></i>
					</a>
				{/if}
			</div>
		{/if}
	</div>
</div>
{* since 1.3.0 *}
