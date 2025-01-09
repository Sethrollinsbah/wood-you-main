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

{if $posts}
	{if !empty($ab_pagination_settings) && empty($no_pagination)}
		{include file = $blog->getTemplatePath('pagination.tpl') settings = $ab_pagination_settings p_type = $settings.p_type}
	{/if}
    {$col = false}{if $settings.display_type == 'grid'}{$col = 12/$settings.col_num}{/if}
	{if empty($settings.compact)}{$item_tpl = 'post-list-item.tpl'}{else}{$item_tpl = 'post-list-item-compact.tpl'}{/if}
	{$item_tpl_path = $blog->getTemplatePath($item_tpl)}
	{$tags_tpl_path = $blog->getTemplatePath('post-tags.tpl')}
	<div class="post-list item-list {$settings.display_type|escape:'html':'UTF-8'}{if $col} row{/if}">
	{foreach $posts as $k => $post}
		{include file = $item_tpl_path post = $post col = $col tags_tpl_path = $tags_tpl_path}
	{/foreach}
	</div>
	{if !empty($ab_pagination_settings) && empty($no_pagination)}
		{include file = $blog->getTemplatePath('pagination.tpl') settings = $ab_pagination_settings p_type = $settings.p_type}
	{/if}
{else}
	<div class="alert-warning">{l s='No posts' mod='amazzingblog'}</div>
{/if}
{* since 1.3.0 *}
