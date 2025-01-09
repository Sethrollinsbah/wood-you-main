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

{function renderCategoryLevel}
	{foreach $categories as $c}
        {if !empty($sorted_categories[$c.id_category])}{$children = $sorted_categories[$c.id_category]}{else}{$children = []}{/if}
		<div class="cat-level{if $c.level_depth} child{else} root{if !empty($class)} {$class|escape:'html':'UTF-8'}{/if}{/if}">
			{$is_checked = isset($checked[$c.id_category])}
			<div class="cat-item{if $children} has-children{/if}{if !empty($id_category_default)}{if $c.id_category == $id_category_default} is-default{/if}{if $is_checked} checked{/if}{/if}">
				<label>
					{if $type == 'radio' || $type == 'checkbox'}
						<input type="{$type|escape:'html':'UTF-8'}" name="{$name|escape:'html':'UTF-8'}" value="{$c.id_category|intval}"{if $is_checked} checked{/if}>
					{/if}
					<span class="cat-name"><span class="cat-id">{$c.id_category|intval}</span> {$c.title|escape:'html':'UTF-8'}</span>
					{if $c.level_depth}<a href="#" class="icon-folder-open toggleChildren"></a>{/if}
					{if $c.level_depth}<span class="checked-num">(<span class="dynamic-num"></span> {l s='checked' mod='amazzingblog'})</span>{/if}
				</label>
				{if $type == 'radio' || $type == 'checkbox'}
					<a href="#" class="icon-asterisk makeDefault" title="{l s='Default' mod='amazzingblog'}"></a>
				{/if}
				{if $type == 'full'}
				<div class="actions">
					<a href="#" class="addChild hidden" data-toggle="modal" data-target="#dynamic-popup" data-parent="{$c.id_category|intval}" title="{l s='New category' mod='amazzingblog'}">+ {l s='Add subcategory' mod='amazzingblog'}</a>
					<a href="#" class="act editCategory" data-toggle="modal" data-target="#dynamic-popup" data-id="{$c.id_category|intval}" title="{l s='Edit category' mod='amazzingblog'}"><i class="icon-pencil"></i> {l s='Edit' mod='amazzingblog'}</a>
					{if $c.id_category != $root_id}
						<a href="#" class="act deleteCategory" data-id="{$c.id_category|intval}" title="{l s='delete' mod='amazzingblog'}"><i class="icon-trash"></i>  {l s='Delete' mod='amazzingblog'}</a>
					{/if}
				</div>
				{/if}
			</div>
			{renderCategoryLevel categories = $children}
		</div>
	{/foreach}
{/function}

{function renderCategorySelectorLevel}
	{foreach $categories as $c}
		<option value="{$c.id_category|intval}"{if $c.id_category == $checked} selected{/if}>{for $i=0 to $c.level_depth}-{/for}{$c.title|escape:'html':'UTF-8'}</option>
		{if !empty($sorted_categories[$c.id_category])}
			{renderCategorySelectorLevel categories = $sorted_categories[$c.id_category]}
		{/if}
	{/foreach}
{/function}

{if $type == 'select'}
	<select name="{$name|escape:'html':'UTF-8'}" class="cat-selector{if !empty($class)} {$class|escape:'html':'UTF-8'}{/if}">
		{if $checked == ['-']}<option value="-">{l s='Filter by category' mod='amazzingblog'}</option>{/if}
		{renderCategorySelectorLevel categories = $sorted_categories[0]}
	</select>
{else}
	{if !empty($post_categories)}
		<div class="category-inline-data">
			<input id="id_category_default" type="hidden" name="id_category_default" value="{$id_category_default|intval}">
			<span class="default-cat-name u">{* filled dynamically *}</span><span class="other-cat-names">{* filled dynamically *}</span>
			{*<i class="icon-angle-down toggleIndicator"></i> currently not required *}
		</div>
	{/if}
	{renderCategoryLevel categories = $sorted_categories[0]}
{/if}
{* since 1.3.0 *}
