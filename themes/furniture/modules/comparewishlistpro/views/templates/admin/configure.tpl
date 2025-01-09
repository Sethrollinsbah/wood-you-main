{*
* 2007-2021 PrestaShop
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
*  @author     PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2021 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{$comparewishlistpro.message nofilter}{* Cannot be escaped *}

{if $comparewishlistpro.promo_mode == 'top-logo' || $comparewishlistpro.promo_mode == 'top-no-logo'}
  {include file="./promo.tpl"}
{/if}

<div class="row">
  <div class="col-sm-3 col-md-3 col-lg-2">
    <nav class="list-group">
      <a class="list-group-item{if $comparewishlistpro.active_tab == 'settings'} active{/if}" href="#ppro-settings" data-toggle="tab"><i class="icon-wrench"></i> {l s='Product comparison settings' mod='comparewishlistpro'}</a>
      <a class="list-group-item{if $comparewishlistpro.active_tab == 'wishlist_settings'} active{/if}" href="#ppro-wishlist-settings" data-toggle="tab"><i class="icon-wrench"></i> {l s='Wishlist settings' mod='comparewishlistpro'}</a>
      <a class="list-group-item{if $comparewishlistpro.active_tab == 'appearance'} active{/if}" href="#ppro-appearance" data-toggle="tab"><i class="icon-eye"></i> {l s='Appearance' mod='comparewishlistpro'}</a>
      <a class="list-group-item{if $comparewishlistpro.active_tab == 'wishlists'} active{/if}" href="#ppro-wishlists" data-toggle="tab"><i class="icon-list"></i> {l s='Wishlists' mod='comparewishlistpro'}</a>
      <a class="list-group-item" href="#ppro-changelog" data-toggle="tab"><i class="icon-info-circle"></i> {l s='Changelog' mod='comparewishlistpro'}</a>
      <a class="list-group-item" href="#ppro-contact" data-toggle="tab"><i class="icon-envelope"></i> {l s='Contact us' mod='comparewishlistpro'}</a>
    </nav>

    <div class="list-group">
      <div class="list-group-item"><i class="icon-info-circle"></i> {l s='Version' mod='comparewishlistpro'} {$comparewishlistpro.version|escape:'htmlall':'UTF-8'}</div>
    </div>

    {if $comparewishlistpro.promo_mode != 'top-logo' && $comparewishlistpro.promo_mode != 'bottom-logo' && $comparewishlistpro.promo_mode != 'bottom-links'}
    <div class="panel">
      {include file="./promo-developer.tpl"}
    </div>
    {/if}
  </div>

  <div class="ppro-content tab-content col-sm-9 col-md-9 col-lg-10">
    <div id="ppro-settings" class="tab-pane{if $comparewishlistpro.active_tab == 'settings'} active{/if}">
      {$comparewishlistpro.configuration_form nofilter}{* Cannot be escaped *}
    </div>
    <div id="ppro-wishlist-settings" class="tab-pane{if $comparewishlistpro.active_tab == 'wishlist_settings'} active{/if}">
      {$comparewishlistpro.wishlist_configuration_form nofilter}{* Cannot be escaped *}
    </div>
    <div id="ppro-appearance" class="tab-pane{if $comparewishlistpro.active_tab == 'appearance'} active{/if}">
      {$comparewishlistpro.appearance_form nofilter}{* Cannot be escaped *}
    </div>

    <div id="ppro-wishlists" class="tab-pane{if $comparewishlistpro.active_tab == 'wishlists'} active{/if}">
      {$comparewishlistpro.wishlists_form nofilter}{* Cannot be escaped *}
    </div>

    <div id="ppro-changelog" class="tab-pane panel">
      {include file="./tab-changelog.tpl"}
    </div>

    <div id="ppro-contact" class="tab-pane panel">
      {include file="./tab-contact.tpl"}
    </div>
  </div>
</div>

{if $comparewishlistpro.promo_mode != 'top-logo' && $comparewishlistpro.promo_mode != 'top-no-logo'}
  {include file="./promo.tpl"}
{/if}

{* this button is dynamically moved to top *}
<a id="module-documentation" class="toolbar_btn hidden" href="{$comparewishlistpro.documentation_link|escape:'html':'UTF-8'}" target="_blank" title="{l s='Documentation' mod='comparewishlistpro'}">
  <i class="process-icon-t icon-file-text"></i>
  <div>{l s='Documentation' mod='comparewishlistpro'}</div>
</a>
<script type="text/javascript">
$(document).ready(function(){
  $('ul.nav.nav-pills').prepend('<li class="li-docs"></li>');
  $('#module-documentation').prependTo('.li-docs').removeClass('hidden');
  $('#id_customer, #id_wishlist').change(function() {
    $('#module_form').submit();
  });
});
</script>
