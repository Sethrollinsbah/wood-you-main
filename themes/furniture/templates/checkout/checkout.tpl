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
     <main id="page">
    <input id="menu-checkbox" class="menu-checkbox not-styling" type="checkbox">
    <header id="header">
      {block name='header'}
        {include file='checkout/_partials/header.tpl'}
      {/block}
    </header>
    {block name='header_top'}
      <div class="header-top mobile-wrapper-menu">
        <div class="container mobile-inner-menu">
           <div class="inner-menu-cell">
                <div class="box-relative row">
                  <div class="header_logo col-md-2 hidden-sm-down" id="_desktop_logo">
                    <a href="{$urls.base_url}">
                      <img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}">
                    </a>
                  </div>
                  <div class="js-box-table box-table hidden-md-up">
                    <h4 class="mobile-title">{l s='Menu' d='Shop.Theme.Global'}</h4>
                    <div id="_mobile_currency_selector"></div>
                    <div id="_mobile_language_selector"></div>
                  </div>
                  <div id="_mobile_search-block" class="hidden-md-up"></div>
                  {hook h='displayTop'}
                  <div class="js-top-menu mobile hidden-md-up" id="_mobile_top_menu"></div>
                </div>
          </div>
        </div>
      </div>
      {hook h='displayNavFullWidth'}
    {/block}
    <div class="page-content-wrapper">
    {block name='hook_after_body_opening_tag'}
      {hook h='displayAfterBodyOpeningTag'}
    {/block}

    {block name='notifications'}
      {include file='_partials/notifications.tpl'}
    {/block}

    <section id="wrapper">
    {hook h="displayWrapperTop"}
      <div class="container">

      {block name='content'}
        <section id="content">
          <div class="wrapper-columns row">
            <div class="col-md-8">
              {block name='cart_summary'}
                {render file='checkout/checkout-process.tpl' ui=$checkout_process}
              {/block}
            </div>
            <div class="col-md-4">

              {block name='cart_summary'}
                {include file='checkout/_partials/cart-summary.tpl' cart = $cart}
              {/block}

              {hook h='displayReassurance'}
            </div>
          </div>
        </section>
      {/block}
      </div>
      {hook h="displayWrapperBottom"}
    </section>
    </div>
    <footer id="footer">
      {block name='footer'}
        {include file='checkout/_partials/footer.tpl'}
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
