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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2018 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<div class="block_newsletter col-md-3 links wrapper">
  <h3 class="hidden-sm-down">{l s='Newsletter' d='Shop.Theme.Global'}</h3>
  <div class="title clearfix hidden-md-up" data-target="#block_newsletter_list" data-toggle="collapse">
    <span class="h3">{l s='Newsletter' d='Shop.Theme.Global'}</span>
    <span class="pull-xs-right">
      <span class="navbar-toggler collapse-icons">
      <i class="material-icons add">&#xE313;</i>
      <i class="material-icons remove">&#xE316;</i>
      </span>
    </span>
  </div>
  <ul id="block_newsletter_list" class="collapse">
    {if $conditions}
      <p class="conditions">{$conditions}</p>
    {/if}
    {if $msg}
    <p class="alert {if $nw_error}alert-danger{else}alert-success{/if}">
      {$msg}
    </p>
    {/if}
    <form action="{$urls.pages.index}#footer" method="post">
      <div class="input-wrapper">
        <input
        class="form-control"
        name="email"
        type="text"
        value="{$value}"
        placeholder="{l s='Your email address' d='Shop.Forms.Labels'}">
        <input type="hidden" name="action" value="0">
        <button
          class="submit"
          name="submitNewsletter"
          type="submit"
        >
      </div>
    </form>
  </ul>

  <a href="https://www.instagram.com/woodyoubahamas/" target="_blank" class="footer-social"><i class= "fa fa-instagram"></i></a>
  <a href="https://www.facebook.com/realwoodforyou" target="_blank" class="footer-social"><i class= "fa fa-facebook"></i></a>


</div>
