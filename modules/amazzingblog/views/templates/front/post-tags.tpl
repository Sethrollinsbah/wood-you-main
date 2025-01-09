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

{if !isset($fill)}{$fill = 1}{/if}
{$i = 0}{$total = $tags|count}
{foreach $tags as $tag_url => $tag_name}
    {$i = $i + 1}
    <a href="{$blog->getTagLink($tag_url)|escape:'html':'UTF-8'}" class="post-tag{if $fill} fill{/if}{if $i == 1} first{else if $i == $total} last{/if}" title="{l s='Other posts with same tag' mod='amazzingblog'}">{$tag_name|escape:'html':'UTF-8'}</a>{if !$fill && $i < $total},{/if}
{/foreach}
{* since 1.2.2 *}
