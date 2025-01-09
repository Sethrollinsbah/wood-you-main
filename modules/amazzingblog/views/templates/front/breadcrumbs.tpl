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

{capture name=path}
	{foreach $parents as $parent}
		<a href="{$blog->getCategoryLink($parent.id_category, $parent.link_rewrite)|escape:'html':'UTF-8'}">{$parent.title|escape:'html':'UTF-8'}</a>
		{if !empty($navigationPipe)}<span class="navigation-pipe">{$navigationPipe|escape:'html':'UTF-8'}</span>{/if}
	{/foreach}
	<span>{$current_item|escape:'html':'UTF-8'}</span>
{/capture}
{* since 1.2.0 *}
