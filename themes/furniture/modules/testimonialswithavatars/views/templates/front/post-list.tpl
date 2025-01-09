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

{if empty($general_settings.rating_class)}{$general_settings.rating_class = 'unicode-star'}{/if}
{foreach $posts item=post}
<div class="post post-comment" data-idpost="{$post.id_post|intval}">
	<div class="post-inner">
		<div class="post_avatar">
			<div class="wrapper-ava font-quote-left-two">
				<div class="ava-img" style="background-image: url({$twa->getAvatarPath($post.avatar|escape:'html':'UTF-8')});"></div>
			</div>
			{if $general_settings.rating_num}
				<span class="post_rating">
					{for $r=1 to $general_settings.rating_num}
						<i class="{$general_settings.rating_class|escape:'html':'UTF-8'} font-star rating-star{if $post.rating >= $r} on{/if}"></i>
					{/for}
				</span>
			{/if}
		</div>
		<div class="content_wrapper">
			<div class="post_content">
				<h5>
					{$post.subject|escape:'html':'UTF-8'}
				</h5>
				{$twa->bbCodeToHTML($post.content|escape:'html':'UTF-8') nofilter}
			</div>
			{*<a href="#" class="expand middle-line">
				 <span class="more">{l s='more...' d='Shop.Theme.Global'}</span>
				 <span class="less">{l s='less' d='Shop.Theme.Global'}</span>
			</a>*}
			<div class="post_footer">
				<span class="customer_name b">{$post.customer_name|escape:'html':'UTF-8'}</span> - 
				<span class="date_add i"> {$post.date_add|date_format}</span>
			</div>
		</div>
	</div>
</div>
{/foreach}
{* since 2.5.0 *}
