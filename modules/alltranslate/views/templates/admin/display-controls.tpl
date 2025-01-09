{*
* 2007-2018 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2018 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div class="panel">
	<form action="{$at_action|escape:'html':'UTF-8'}" method="post" class="at-inline-block">
		<div class="btn-group">
			<button type="submit" name="type" value="theme" class="btn btn-default {$at_theme_class|escape:'html':'UTF-8'}">
				{l s='Themes' mod='alltranslate'}
			</button>
			<button type="submit" name="type" value="module" class="btn btn-default {$at_module_class|escape:'html':'UTF-8'}">
				{l s='Modules' mod='alltranslate'}
			</button>
		</div>
	</form>
	<fieldset class="at-inline-block at-lang-list">
		<label class="at-lang-label" for="at-lang-from">{l s='Translate from' mod='alltranslate'}:</label>
		<select id="at-lang-from" class="at-lang-list" name="at-lang-from">
		{foreach $at_languages as $iso => $lang}
			<option value="{$iso|escape:'html':'UTF-8'}" data-locale="{$lang.locale|escape:'html':'UTF-8'}">{$lang.name|escape:'html':'UTF-8'}</option>
		{/foreach}
		</select>
	</fieldset>
	<fieldset class="at-inline-block at-lang-list">
		<label class="at-lang-label" for="at-lang-to">{l s='Translate into' mod='alltranslate'}:</label>
		<select id="at-lang-to" class="at-lang-list" name="at-lang-to">
		{foreach $at_languages as $iso => $lang}
			<option value="{$iso|escape:'html':'UTF-8'}" data-locale="{$lang.locale|escape:'html':'UTF-8'}">{$lang.name|escape:'html':'UTF-8'}</option>
		{/foreach}
		<option id="at-all" value="all">{l s='All' mod='alltranslate'}</option>
		</select>
	</fieldset>
	<label class="at-inline-block at-checkbox"><input id="at-multiple-lang" class="at-checkbox" type="checkbox">{l s='Translate into multiple languages' mod='alltranslate'}</label>
	<label class="at-inline-block at-checkbox"><input class="at-checkbox" type="checkbox" name="overwrite_existing" checked="checked">{l s='Overwrite existing translations' mod='alltranslate'}</label>
</div>