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

{if $file_warnings}
<div class="easycarousels">
	<div class="alert-warning">
		{l s='Some of files, that you customized, have been updated in the new version' mod='easycarousels'}
		<ul>
		{foreach $file_warnings as $file => $identifier}
			<li>
				{$file|escape:'html':'UTF-8'}
				<span class="warning-advice">
					{l s='Make sure you update this file in your theme folder, and insert the following code to the last line' mod='easycarousels'}:
					<span class="code">{$identifier|escape:'html':'UTF-8'}</span>
					<a href="{$info_links.documentation|escape:'html':'UTF-8'}" title="{l s='More info' mod='easycarousels'}" target="_blank" class="icon-question-circle"></a>
				</span>
			</li>
		{/foreach}
		</ul>
	</div>
</div>
{/if}
{* since 2.5.0 *}
