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

{if !$is_17}{capture name=path}<span class="navigation_page">{$page_header|escape:'html':'UTF-8'}</span>{/capture}{/if}

<div class="twa">
	{if !empty($page_header)}<h1 class="title_main_section"><span>{$page_header|escape:'html':'UTF-8'}</span></h1>{/if}
	<div class="twa_posts clearfix {if $twa_settings.displayType == 2}grid{else}list{/if}">
		{include file="./post-list.tpl" posts=$twa_posts}
	</div>
	{if $show_load_more}
	<div id="loadMore" class="middle-line">
		<a class="neat" href="#">{l s='More reviews...' d='Shop.Theme.Global'}</a>
		<i class="loader" style="display:none;">...</i>
	</div>
	{/if}
	{if $restrictions_warning}
	<div class="alert alert-warning restriction-warning">
		{$restrictions_warning|escape:'html':'UTF-8'}
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	{else}
	<button id="addNew" class="btn btn-primary">
		{l s='Add new' d='Shop.Theme.Global'}
	</button>
	<div id="thanks_message" class="alert alert-success text-center" style="display:none;">{l s='Thanks for the review! It will be published right after approval' d='Shop.Theme.Global'}</div>
	<div class="addForm clearfix" style="display:none;">
		<form id="add_new_post" enctype="multipart/form-data">
			<div class="ajax_errors"></div>
			<div class="post_avatar text-center">
				<div class="imgholder">
					<div style="background-image:url({$twa->getAvatarPath({$avatar|escape:'html':'UTF-8'})})" class="avatarImg"></div>
					<div class="hidden">
						<input id="postAvatar" type="file" name="avatar_file" class="hidden">
					</div>
				</div>
				<span class="centered_label">{l s='Upload your avatar' d='Shop.Theme.Global'}</span>
			</div>
			<div class="new_content_wrapper">
				<div class="customer_name field">
					<div class="field_error" style="display:none;"></div>
					<input type="text" value="{$customer_name|escape:'html':'UTF-8'}" name="customer_name" placeholder="{l s='Your Name' d='Shop.Theme.Global'}">
				</div>
				<div class="subject field">
					<div class="field_error" style="display:none;"></div>
					<input type="text" value="" name="subject" placeholder="{l s='Post subject' d='Shop.Theme.Global'}">
				</div>
				<div class="content field {if $allow_html == 1}allow_html{/if}">
					<div class="field_error" style="display:none;"></div>
					<textarea id="post_content" class="" rows="7" name="content" placeholder="{l s='Post text' d='Shop.Theme.Global'}"></textarea>
				</div>
				{if $general_settings.rating_num}
					{if empty($general_settings.rating_class)}{$general_settings.rating_class = 'unicode-star'}{/if}
					<div class="field editable_rating">
						<div class="stars_holder">
							<input type="hidden" name="rating" value="{$general_settings.rating_num|intval}">
							{for $r=1 to $general_settings.rating_num}
								<i class="{$general_settings.rating_class|escape:'html':'UTF-8'} rating-star" data-rating="{$r|intval}"></i>
							{/for}
						</div>
						<br />
						<span class="centered_label">{l s='Leave your rating' d='Shop.Theme.Global'}</span>
					</div>
				{/if}
				<input type="hidden" name="ajaxAction" value="addPost">
				<button class="btn btn-primary" id="submitPost">{l s='OK' d='Shop.Theme.Global'}</button>
			</div>
		</form>
	</div>
	{/if}
</div>
{* since 2.5.0 *}
