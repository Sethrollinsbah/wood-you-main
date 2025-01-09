{**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<!doctype html>
<html lang="{$language.iso_code}">

  <head>
    {block name='head'}
      {include file='_partials/head.tpl'}
    {/block}
  </head>

  <body id="{$page.page_name}" class="{$page.body_classes|classnames}">

    {block name='hook_after_body_opening_tag'}
      {hook h='displayAfterBodyOpeningTag'}
    {/block}

    <main id="page">
      <input id="menu-checkbox" class="menu-checkbox not-styling" type="checkbox">
      <header id="header">
        {block name='header'}
          {include file='_partials/header.tpl'}
        {/block}
      </header>
      {block name='header_top'}
        <div class="header-top mobile-wrapper-menu">
          <div class="container mobile-inner-menu">
             <div class="inner-menu-cell">
                  <div class="box-relative row">
                    <div class="header_logo col-md-3 hidden-sm-down" id="_desktop_logo">
                      <a href="{$urls.base_url}">
                        <img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}">
                      </a>
                    </div>
                    <div class="js-box-table box-table hidden-md-up">
                      <h4 class="mobile-title">{l s='Menu' d='Shop.Theme.Global'}</h4>
                      <div id="_mobile_currency_selector"></div>
                      <div id="_mobile_language_selector"></div>
                    </div>
                    {hook h='displayTop'}
                    <div class="js-top-menu mobile hidden-md-up" id="_mobile_top_menu"></div>
                  </div>
            </div>
          </div>
        </div>
        <div id="_mobile_search-block" class="hidden-md-up"></div>
        {hook h='displayNavFullWidth'}
      {/block}
      <div class="page-content-wrapper">
      {block name='product_activation'}
        {include file='catalog/_partials/product-activation.tpl'}
      {/block}

      {block name='notifications'}
        {include file='_partials/notifications.tpl'}
      {/block}

      <section id="wrapper">
      {hook h="displayWrapperTop"}
          {if $page.page_name == 'index'}
                {block name="top_column"}
                  <div class="top-column">
                    {hook h='displayCustomBanners4'}
                    {hook h='displayTopColumn'}
                  </div>
                {/block}
          {/if}
            {block name='breadcrumb'}
              {include file='_partials/breadcrumb.tpl'}
            {/block}
          <div class="container">
            <div class="wrapper-columns row">
              {block name="left_column"}
                <div id="left-column" class="sidebar col-md-3">
                  {if $page.page_name == 'product'}
                    {hook h='displayLeftColumnProduct'}
                  {else}
                    {hook h="displayLeftColumn"}
                  {/if}
                </div>
              {/block}
              {block name="content_wrapper"}
                <div id="content-wrapper" class="left-column right-column col-md-6">
                  {hook h="displayContentWrapperTop"}
                  {block name="content"}
                    <p>Hello world! This is HTML5 Boilerplate.</p>
                  {/block}
                  {hook h="displayContentWrapperBottom"}
                </div>
              {/block}

              {block name="right_column"}
                <div id="right-column" class="sidebar col-md-3">
                  {if $page.page_name == 'product'}
                    {hook h='displayRightColumnProduct'}
                  {else}
                    {hook h="displayRightColumn"}
                  {/if}
                </div>
              {/block}
          </div>
        </div>
        {hook h="displayWrapperBottom"}
      </section>
      </div>
      <footer id="footer">
        {block name="footer"}
          {include file="_partials/footer.tpl"}
        {/block}
      </footer>
      
    </main>

    {block name='javascript_bottom'}
      {include file="_partials/javascript.tpl" javascript=$javascript.bottom}
    {/block}

    {block name='hook_before_body_closing_tag'}
      {hook h='displayBeforeBodyClosingTag'}
    {/block}
  </body>

</html>
