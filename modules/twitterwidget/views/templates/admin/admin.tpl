{*
* 2007-2018 Andrey & co
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0).
*
*  @author    Andrey <byalonovich@bk.ru>
*  @copyright 2015-2020 Andrey & co
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

{* this tooltip is dynamically appended to form, generated using helper *}
<span class="display-twitter-tooltip hidden">
	{l s='In order to display this hook, insert the following code to any tpl file' mod='twitterwidget'}: <b>{literal}{hook h='displayTwitter'}{/literal}</b>
</span>

{* this button is dynamically moved to top *}
<a id="module-documentation" class="toolbar_btn hidden" href="{$documentation_link|escape:'html':'UTF-8'}" target="_blank" title="{l s='Documentation' mod='twitterwidget'}">
	<i class="icon-file-text icon-large"></i>
	<div>{l s='Documentation' mod='twitterwidget'}</div>
</a>
