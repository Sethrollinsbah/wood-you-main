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
{extends file='page.tpl'}

{block name='page_title'}
  <span class="sitemap-title">{l s='Sitemap' d='Shop.Theme.Global'}</span>
{/block}

{block name='page_content_container'}
    <div class="row sitemap">
        <div class="col-md-3 col-sm-6 col-12">
          <h2>{$our_offers}</h2>
          {include file='cms/_partials/sitemap-nested-list.tpl' links=$links.offers}
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <h2>{$categories}</h2>
          {include file='cms/_partials/sitemap-nested-list.tpl' links=$links.categories}
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <h2>{$your_account}</h2>
          {include file='cms/_partials/sitemap-nested-list.tpl' links=$links.user_account}
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <h2>{$pages}</h2>
          {include file='cms/_partials/sitemap-nested-list.tpl' links=$links.pages}
        </div>
    </div>
{/block}
