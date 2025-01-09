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

{*
 * Classic theme doesn't use this subtemplate, feel free to do whatever you need here.
 * This template is generated at each ajax calls.
 * See ProductListingFrontController::getAjaxProductSearchVariables()
 *}
<div id="js-product-list-bottom" class="row products-selection">
	{block name='display_view'}
       <div class="display-view hidden-sm-down">
            <label>{l s='View as' d='Shop.Theme.Catalog'}</label>
             <span class="material-icons view-item show_grid active">&#xE42A;</span>
             <span class="material-icons view-item show_list">&#xE8EF;</span>
       </div>
    {/block}
    <div class="sort-by-row">
      {block name='sort_by'}
        {include file='catalog/_partials/sort-orders.tpl' sort_orders=$listing.sort_orders}
      {/block}
    </div>
      {block name='pagination'}
        {include file='_partials/pagination.tpl' pagination=$listing.pagination}
      {/block}
</div>
