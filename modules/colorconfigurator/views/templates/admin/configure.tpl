{*
* 2017-2027 PrestaShop
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
*  @copyright 2017-2027 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{* this button is dynamically moved to top *}
<a id="module-documentation" class="toolbar_btn hidden" href="{$documentation_link|escape:'html':'UTF-8'}" target="_blank" title="{l s='Documentation' mod='colorconfigurator'}">
	<i class="process-icon-t icon-file-text"></i>
	<div>{l s='Documentation' mod='colorconfigurator'}</div>
</a>
<script type="text/javascript">
$(document).ready(function(){
	$('ul.nav.nav-pills').prepend('<li class="li-docs"></li>');
	$('#module-documentation').prependTo('.li-docs').removeClass('hidden');
});
</script>

<div id="vue-app">
<div class="panel colorconfigurator">
  <div class="colorconfigurator alerts">
    <div class="colorconfigurator alert alert-success" v-show="savesuccess">
        <button type="button" class="close" @click="savesuccess = false">×</button>
        <span>{l s='Saved' mod='colorconfigurator'}</span>
    </div>
    <div class="colorconfigurator alert alert-danger" v-show="saveerror">
        <button type="button" class="close" @click="saveerror = false">×</button>
        <span>{l s='Error' mod='colorconfigurator'}</span>
    </div>
    <div class="colorconfigurator alert alert-danger" v-show="reqerror">
        <button type="button" class="close" @click="reqerror = false">×</button>
        <span>{l s='Fill required fields' mod='colorconfigurator'}</span>
    </div>
    <div class="colorconfigurator alert alert-danger" v-show="googleerror">
        <button type="button" class="close" @click="googleerror = false">×</button>
        <span>{l s='Invalid google fonts api key' mod='colorconfigurator'} <br />
          <a href="https://developers.google.com/console/help/generating-dev-keys" target="_blank">{l s='How to get api key' mod='colorconfigurator'}</a>
        </span>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4">
      <label class="">{l s='Enable front panel' mod='colorconfigurator'} </label>
      <switchcomp :value="settings.frontpanel" @change="settings.frontpanel = arguments[0]" />
    </div>
    <div class="col-lg-4 form-group">
      <label class="">{l s='Demo mode' mod='colorconfigurator'} </label>
      <switchcomp :value="settings.demo" @change="settings.demo = arguments[0]"></switchcomp>
      <span class="live-link" v-show="demo == 0">
        <a href="{$live_link|escape:'html':'UTF-8'}" target="_blank">{l s='Live edite' mod='colorconfigurator'}</a>
      </span>
    </div>
    <div class="col-lg-4">
      <label class="">{l s='Fixed menu' mod='colorconfigurator'} </label>
      <switchcomp :value="settings.fixedmenu" @change="settings.fixedmenu = arguments[0]" />
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4">
      <label class="">{l s='Site container class' mod='colorconfigurator'}</label>
      <input v-model="settings.container_class" />
    </div>
    <div class="col-lg-4">
      <label class="">{l s='Default container width' mod='colorconfigurator'}</label>
      <select  v-model="settings.width">
        <option v-for="opt in ['wide', 'box']" :value="opt">##opt##</option>
      </select>
    </div>
    <div class="col-lg-4">
      <label class="">{l s='Menu class' mod='colorconfigurator'}</label>
      <input v-model="settings.menu_class" />
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4">
      <label class="">{l s='Border radius' mod='colorconfigurator'} </label>
      <switchcomp :value="settings.borderradius" @change="settings.borderradius = arguments[0]" />
    </div>
    <div class="col-lg-4">
      <label class="">{l s='Box shadow' mod='colorconfigurator'} </label>
      <switchcomp :value="settings.boxshadow" @change="settings.boxshadow = arguments[0]" />
    </div>
		<div class="col-lg-4">
			<label class="">{l s='Fixed menu' mod='colorconfigurator'} </label>
			<switchcomp :value="settings.fixed_menu" @change="settings.fixed_menu = arguments[0]" />
		</div>
  </div>
  <div class="row">
    <div class="col-lg-3">
      <label class="">{l s='Border radius classes' mod='colorconfigurator'}</label>
      <textarea v-model="settings.radius_classes"></textarea>
    </div>
    <div class="col-lg-3">
      <label class="">{l s='Box shadow classes' mod='colorconfigurator'}</label>
      <textarea v-model="settings.shadow_classes"></textarea>
    </div>
		<div class="col-lg-3">
      <label class="">{l s='Fixed menu classes' mod='colorconfigurator'}</label>
      <textarea v-model="settings.fixed_menu_classes"></textarea>
    </div>

		<div class="col-lg-3">
				<div class="row">
					<div class="col-lg-5">
						<label class="">{l s='Fixed menu "z-index"' mod='colorconfigurator'}</label>
						<input v-model="settings.fix_menu_zindex" />
					</div>
					<div class="col-lg-5">
						<label class="">{l s='Fixed menu "top"' mod='colorconfigurator'}</label>
						<input v-model="settings.fix_menu_top" />
					</div>
				</div>
		</div>

  </div>
  <div class="row">
    <div class="col-lg-6">
      <label class="">{l s='Google fonts api key' mod='colorconfigurator'}</label>
      <input v-model="settings.google_fonts_key" @change="onGoogleKeyChange" class="google-api"/>
    </div>
  </div>
</div>

<groups></groups>
<div class="panel colorconfigurator">
  <a href="{$import_link|escape:'html':'UTF-8'}" class="btn btn-default" download><i class="process-icon-upload"></i>Export</a>
  <form action={$export_link|escape:'html':'UTF-8'} method="POST" enctype="multipart/form-data">
    <div class="btn btn-default file-input">
      <span>{l s='Choose config file...' mod='colorconfigurator'}</span>
      <input type="file" id="colors_data" name="colors_data" />
    </div>
    <button type="submit" id="submit-upload" class="btn btn-default" disabled/><i class="process-icon-download"></i>{l s='Import' mod='colorconfigurator'}</button>
  </form>
  <a class="btn btn-default save pull-right" @click="save" {literal}:class="{disabled: onsave}"{/literal}><i class="process-icon-save"></i>{l s='Save' mod='colorconfigurator'}</a>
</div>
</div>
