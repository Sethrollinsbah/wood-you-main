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

/*
 * Custom code goes here.
 * A template should always ship with an empty custom.js
 */
$(document).ready(function() {
    renderFacetsReadMore();

    $(document).on('click', '.filter-read-more', function(e) {
        e.preventDefault();
        $(this).hide();
        $(this).closest('.facet').find('.filter-read-less').show();
        $(this).closest('.facet').addClass('show-all');
    });

    $(document).on('click', '.filter-read-less', function(e) {
        e.preventDefault();
        $(this).hide();
        $(this).closest('.facet').find('.filter-read-more').show();
        $(this).closest('.facet').removeClass('show-all');
    });
});

function renderFacetsReadMore() {
    if ($('.facet').length) {
        $('.facet').each(function() {
            if ($(this).find('ul li').length > 3) {
                $(this).closest('.facet').find('.filter-read-more').show();
            }
        });
    }
}
prestashop.on('updateFacets', function (event) {
    setTimeout(renderFacetsReadMore, 1000);
});
prestashop.on('updateProductList', function (event) {
    setTimeout(renderFacetsReadMore, 1000);
});
