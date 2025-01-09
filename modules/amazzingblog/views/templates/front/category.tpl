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

{$category = $ab_category}
<div class="amazzingblog category-page">
{if $category && $category.active}
	{if !$blog->is_17}{include file = $blog->getTemplatePath('breadcrumbs.tpl') parents = $ab_cat_parents current_item = $category.title}{/if}
	<h2>{$category.title|escape:'html':'UTF-8'}</h2>
	{if !empty($category.description)}
		<div class="category-description">
			{$category.description nofilter} {* can not be escaped *}
		</div>
	{/if}
	{if !empty($ab_subcategories)}
		<div class="blog-subcategories">
		{foreach $ab_subcategories as $cat}
			<div class="blog-subcategory">
				<a href="{$cat.url|escape:'html':'UTF-8'}" title="{$cat.title|escape:'html':'UTF-8'}">
					<span class="blog-category-title">{$cat.title|escape:'html':'UTF-8'}</span>
				</a>
				<span class="posts-num">{l s='%d posts' mod='amazzingblog' sprintf=[$cat.posts_num]}</span>
			</div>
		{/foreach}
		</div>
	{/if}
	{if $ab_posts}
		<div class="dynamic-posts">
			{include file = $blog->getTemplatePath('post-list.tpl') posts = $ab_posts settings = $ab_post_list_settings}
		</div>
	{/if}
	<form action="" class="additional-filters hidden">
		{foreach $ab_additional_filters as $name => $value}
			{if $name == 'active'}{continue}{/if}{* no need for this filter here *}
			<input type="hidden" name="{$name|escape:'html':'UTF-8'}" value="{implode(',', $value)|escape:'html':'UTF-8'}">
		{/foreach}
	</form>
{else}
	<div class="alert alert-warning">{l s='Category not available' mod='amazzingblog'}</div>
{/if}
</div>
{* since 1.3.0 *}
