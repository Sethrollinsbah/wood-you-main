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

{foreach $posts item=post}
	<div class="postRow clearfix" data-id="{$post.id_post|intval}" data-position="{$post.position|intval}">
	<form class="form-horizontal">
		<div class="ajax_errors alert alert-danger" style="display:none;"></div>
		<input type="hidden" name="id_post" value="{$post.id_post|intval}">
		<input type="hidden" name="id_shop" value="{$post.id_shop|intval}">
		<input type="hidden" name="post_position" value="{$post.position|intval}">
		<i class="dragger icon icon-arrows" title="{l s='Drag it' mod='testimonialswithavatars'}"></i>
		<div class="avatar editable">
			<div class="imgholder">
				<div style="background-image:url({$twa->getAvatarPath($post.avatar|escape:'html':'UTF-8')})" class="avatarImg"></div>
				<div class="hidden">
					<input id="av_{$post.id_post|intval}" type="file" name="avatar_file">
					<input type="hidden" name="avatar" value="{$post.avatar|escape:'html':'UTF-8'}">
				</div>
			</div>
			<span class="help-block">{$post.visitor_ip|escape:'html':'UTF-8'}</span>
			{$shop_ids = Shop::getContextListShopID()}
			{if count($shop_ids) > 1}
				<span class="help-block">{l s='Posted in %s' sprintf=$twa->getShopNameById($post.id_shop) mod='testimonialswithavatars'}</span>
			{/if}
		</div>
		<div class="actions col-lg-3 pull-right">
			<div class="btn-group pull-right">
				<button class="editPost btn btn-default current_val" title="{l s='Edit' mod='testimonialswithavatars'}">
					<i class="icon-pencil"></i> {l s='Edit' mod='testimonialswithavatars'}
				</button>
				<button class="savePost btn btn-default new_val" title="{l s='Save' mod='testimonialswithavatars'}" >
					<i class="icon icon-save"></i> {l s='Save' mod='testimonialswithavatars'}
				</button>
				<button class="cancelEditing btn btn-default new_val" title="{l s='Cancel' mod='testimonialswithavatars'}" >
					<i class="icon icon-times"></i> {l s='Cancel' mod='testimonialswithavatars'}
				</button>
				<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<i class="icon-caret-down"></i>
				</button>
				<ul class="dropdown-menu">
					<li>
						<a class="deletePost" href="#" onclick="event.preventDefault();">
							<i class="icon icon-trash"></i>
							{l s='Delete' mod='testimonialswithavatars'}
						</a>
					</li>
				</ul>
			</div>
			<a class="activatePost list-action-enable action-{if $post.active}enabled{else}disabled{/if} pull-right" href="#" title="{l s='Activate/Deactivate' mod='testimonialswithavatars'}">
				<i class="icon-check"></i>
				<i class="icon-remove"></i>
				<input type="hidden" name="active" value="{$post.active|intval}">
			</a>
		</div>
		<div class="data_row clearfix row-customer_name">
			<label class="control-label col-lg-1">
				{l s='Name' mod='testimonialswithavatars'}:
			</label>
			<div class="col-lg-7 customer_name field editable">
				<div class="current_val">{$post.customer_name|escape:'html':'UTF-8'}</div>
				<div class="new_val">
					<input class="input" type="text" value="{$post.customer_name|escape:'html':'UTF-8'}" name="customer_name">
				</div>
			</div>
		</div>
		<div class="data_row clearfix row-subject">
			<label class="control-label col-lg-1">
				{l s='Subject' mod='testimonialswithavatars'}:
			</label>
			<div class="col-lg-7 subject field editable">
				<div class="current_val">{$post.subject|escape:'html':'UTF-8'}</div>
					<div class="new_val">
					<input class="input" type="text" value="{$post.subject|escape:'html':'UTF-8'}" name="subject">
				</div>
			</div>
		</div>
		<div class="data_row clearfix row-content">
			<label class="control-label col-lg-1">
				{l s='Content' mod='testimonialswithavatars'}:
			</label>
			<div class="col-lg-7 content field editable ta">
				<div class="current_val">{$twa->bbCodeToHTML($post.content|escape:'html':'UTF-8')}</div>
				<div class="new_val">
					<div id="content_{$post.id_post|intval}" class="inline_edit">{$twa->bbCodeToHTML($post.content|escape:'html':'UTF-8')}</div>
				</div>
			</div>
		</div>
		{if $general_settings.rating_num}
		<div class="data_row clearfix row-rating">
			<label class="control-label col-lg-1">
				{l s='Rating' mod='testimonialswithavatars'}:
			</label>
			<div class="col-lg-7 field editable">
				<div class="post_rating stars_holder">
					<input type="hidden" name="rating" value="{$post.rating|intval}">
					{for $r=1 to $general_settings.rating_num}
						<i class="rating-star{if $post.rating >= $r} on{/if}" data-rating="{$r|intval}"></i>
					{/for}
				</div>
			</div>
		</div>
		{/if}
		<div class="data_row clearfix row-date">
			<label class="control-label col-lg-1">
				{l s='Date' mod='testimonialswithavatars'}:
			</label>
			<div class="col-lg-7 date_add field editable">
				<div class="current_val">{$post.date_add|escape:'html':'UTF-8'}</div>
				<div class="new_val">
					<input class="input datepicker" type="text" value="{$post.date_add|escape:'html':'UTF-8'}" name="date_add">
				</div>
			</div>
		</div>
	</form>
	</div>
{/foreach}
{* since 2.5.0 *}
