/**
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
 */
import 'expose-loader?Tether!tether';
import 'bootstrap/dist/js/bootstrap.min';
import 'flexibility';
import 'bootstrap-touchspin';
import "bootstrap/scss/bootstrap";
import "../css/partials/_commons";

import "../css/override/_index";
import "../css/components/_typography";
import "../css/components/_page";
import "../css/components/_column";
import "../css/components/_breadcrumb";
import "../css/components/_card";
import "../css/components/_buttons";
import "../css/components/ui/_index";
import "../css/components/_forms";
import "../css/components/_bxslider";
import "../css/components/_revoslider";
import "../css/components/_header";
import "../css/components/_logo";
import "../css/components/_shopping-cart";
import "../css/components/_userinfo";
import "../css/components/_layer-cart";
import "../css/components/_localization-block";
import "../css/components/search-widget";
import "../css/components/mainmenu";
import "../css/components/checkout";
import "../css/components/customer";
import "../css/components/_sitemap";
import "../css/components/imageslider";
import "../css/components/product-list/_index";
import "../css/components/_price";
import "../css/components/custom-text";
import "../css/components/category/_index";
import "../css/components/product/_index";
import "../css/components/cart";
import "../css/components/block-reassurance";
import "../css/components/quickview";
import "../css/components/stores";
import "../css/components/_afterfooter";
import "../css/components/_prefooter";
import "../css/components/_footer";
import "../css/components/_social-block";
import "../css/components/_subscription";
import "../css/components/contact";
import "../css/components/_scroll-top";
import "../css/components/errors";
import "../css/components/customization-modal";
import "../css/components/custombanners/_index";
import "../css/components/easycarousels/_index";
import "../css/components/blog/_index";
import "../css/components/testimonialswithavatars/_index";
import "../css/components/_twitter";
import "../css/components/_signupreminder";

import "../css/animation/_index";

import '../css/theme';
import './responsive';
import './checkout';
import './customer';
import './listing';
import './product';
import './cart';


import DropDown from './components/drop-down';
import Form from './components/form';
import ProductMinitature from './components/product-miniature';
import ProductSelect from './components/product-select';
import TopMenu from './components/top-menu';
import ViewList from './components/product-view';
//import FixHeader from './components/fix-header';

import prestashop from 'prestashop';
import EventEmitter from 'events';

import './lib/bootstrap-filestyle.min';
import './lib/jquery.scrollbox.min';

import './components/block-cart';
import './components/custom';

// "inherit" EventEmitter
for (var i in EventEmitter.prototype) {
  prestashop[i] = EventEmitter.prototype[i];
}

$(document).ready(() => {
  let dropDownEl = $('.js-dropdown');
  const form = new Form();
  let topMenuEl = $('.js-top-menu ul[data-depth="0"]');
  let dropDown = new DropDown(dropDownEl);
  let topMenu = new TopMenu(topMenuEl);
  let productMinitature = new ProductMinitature();
  let productSelect  = new ProductSelect();
  let viewList = new ViewList();
  //let fixHeader = new FixHeader();
  dropDown.init();
  form.init();
  topMenu.init();
  productMinitature.init();
  productSelect.init();
  viewList.init();
  //fixHeader.init();
});
