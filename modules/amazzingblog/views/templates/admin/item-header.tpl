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

<div class="header clearfix">
	{$identifier = 'id_'|cat:$type}
	<label class="title">
		{if $item.$identifier}
			<input type="checkbox" value="{$item.$identifier|intval}" class="box hidden">
		{/if}
		{if $type == 'post'}
			{$img_url = $blog->getImgSrc('post', $item.$identifier, 's', $item.cover)}
			<span class="post-img"><span style="background-image:url('{$img_url|escape:'html':'UTF-8'}')"></span></span>
			{if $item.$identifier}
			<span class="post-id">{$item.$identifier|intval}</span>
			<span class="sub">
				<a href="#" class="post-author" data-author="{$item.author|intval}">
					<i class="icon-user"></i> {$item.firstname|escape:'html':'UTF-8'} {$item.lastname|escape:'html':'UTF-8'}
				</a>
				<a href="#" class="post-category" data-category="{$item.id_category_default|intval}">
					<i class="icon-sitemap"></i> {$item.cat_title|escape:'html':'UTF-8'}
				</a>
				<a href="#" class="post-comments user-comments"><i class="icon-comments"></i> {$item.comments|intval}</a>
				<span class="views"><i class="icon-eye"></i> {$item.views|intval}</span>
			</span>
			{/if}
		{/if}
		<span class="text" title="ID: {$item.$identifier|intval}">
			{$item.title|truncate:75|escape:'html':'UTF-8'}
			{if !empty($item.exc_note)}<span class="exc-note">{$item.exc_note|escape:'html':'UTF-8'}</span>{/if}
		</span>
	</label>
	<div class="actions pull-right">
		{if $type == 'post'}
			<span class="post-info">
				<span class="post-date">
					{if $item.publish_from == $blog->empty_date}{$item.publish_from = $item.date_add}{/if}
					{if $item.days_before_publish > 0}
						<span class="note alert-info">{l s='Will be published in %d days' mod='amazzingblog' sprintf=$item.days_before_publish}</span>
					{else if $item.days_expired > 0}
						<span class="note alert-warning">{l s='Expired on %s' mod='amazzingblog' sprintf=$item.publish_to|date_format:'j M'}</span>
					{/if}
					{if $order_by == 'date_add'}
						{l s='Created on %s' mod='amazzingblog' sprintf=$item.date_add|date_format:'d M, y'}
					{else if $order_by == 'date_upd'}
						{l s='Last update: %s' mod='amazzingblog' sprintf=$item.date_upd|date_format:'d M, y'}
					{else}
						{$item.publish_from|date_format:'d M, Y'|escape:'html':'UTF-8'}
					{/if}
					{* date_format:'d-m-y, H:i' *}
				</span>
			</span>
		{/if}
		<a class="activate list-action-enable action-{if $item.active}enabled{else}disabled{/if}" href="#" title="{l s='Active' mod='amazzingblog'}">
			<i class="icon-check"></i>
			<i class="icon-remove"></i>
			<input type="checkbox" name="active" value="1" class="toggleable_param hidden"{if $item.active} checked{/if}>
		</a>
		<i class="dragger ready act icon icon-arrows-v icon-2x"></i>
		<div class="btn-group pull-right list-view">
			<button type="button" title="{l s='Edit' mod='amazzingblog'}" class="edit btn btn-default">
				<i class="icon-pencil"></i> {l s='Edit' mod='amazzingblog'}
			</button>
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				<i class="icon-caret-down"></i>
			</button>
			<ul class="dropdown-menu">
				<li>
					<a class="act delete" href="#">
						<i class="icon icon-trash"></i>
						{l s='Delete' mod='amazzingblog'}
					</a>
				</li>
			</ul>
		</div>
		<div class="pull-right detail-view">
			<button type="button" title="{l s='Scroll Up' mod='amazzingblog'}" class="scrollUp btn btn-default">
				<i class="icon icon-minus"></i> {l s='Cancel' mod='amazzingblog'}
			</button>
		</div>
	</div>
</div>
{* since 1.3.0 *}
