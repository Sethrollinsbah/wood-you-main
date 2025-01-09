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

import $ from 'jquery';

export default class ViewList {
    init(){
        this.productViewing();
    }
    productViewing() {
        //grid&list
        $('.show_list').click(function(){
            document.cookie = "show_list=true; expires=Thu, 30 Jan 2100 12:00:00 UTC; path=/";
            $('#js-product-list .products').removeClass('grid');
            $('#js-product-list .products').addClass('list');
            $('.show_grid').removeClass('active');
            $('.show_list').addClass('active');
        });
         
        $('.show_grid').click(function(){
            document.cookie = "show_list=; expires=Thu, 30 Jan 1970 12:00:00 UTC; path=/";
            $('#js-product-list .products').removeClass('list');
            $('#js-product-list .products').addClass('grid');
            $('.show_list').removeClass('active');
            $('.show_grid').addClass('active');
        });
         
        prestashop.on('updateProductList', function (event) {
            $('.show_list').click(function(){
                $('#js-product-list .products').removeClass('grid');
                $('#js-product-list .products').addClass('list');
                $('.show_grid').removeClass('active');
                $('.show_list').addClass('active');
            });
             
            $('.show_grid').click(function(){
                $('#js-product-list .products').removeClass('list');
                $('#js-product-list .products').addClass('grid');
                $('.show_list').removeClass('active');
                $('.show_grid').addClass('active');
            });
        });
    }
}