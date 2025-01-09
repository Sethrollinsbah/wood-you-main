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

<div id="comment_{$comment.id_comment|intval}" class="comment-item">
	<div class="user-avatar">
		<div class="avatar-img{if empty($comment.avatar)} empty{/if}"{if !empty($comment.avatar)} style="background-image:url({$avatars_dir|cat:$comment.avatar|escape:'html':'UTF-8'})"{/if}></div>
	</div>
	<div class="comment-info-block">
			<span class="b">{$comment.user_name|escape:'html':'UTF-8'}</span>
			<span class="comment-date">{$comment.date_add|date_format|escape:'html':'UTF-8'}</span>
	</div>
	<div class="comment-content">{$blog->bbCodeToHTML($comment.content|escape:'html':'UTF-8') nofilter}</div>
</div>
{* since 1.2.0 *}
