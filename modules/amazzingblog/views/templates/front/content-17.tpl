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

{extends file='page.tpl'}
{block name='head_seo_title'}{$meta_title}{/block}
{block name='head_seo_description'}{$meta_description}{/block}
{block name='head_seo_keywords'}{$meta_keywords}{/block}
{block name='page_content'}{$html nofilter}{/block}
{* since 1.2.0 *}
