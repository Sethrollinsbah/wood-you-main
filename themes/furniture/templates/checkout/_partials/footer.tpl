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
<div class="footer-container">
    <div class="pre-footer">
        <div class="container">
            <div class="row">
                {block name='hook_footer_before'}
                  {hook h='displayFooterBefore'}
                {/block}
            </div>
        </div>
    </div>
  <div class="footer-blocks container">
    <div class="row">
      {block name='hook_footer'}
        {hook h='displayFooter'}
      {/block}
    </div>
  </div>
  <div class="container">
    <div class="after-footer">
      <div class="row">
        <div class="copyright col-sm-4">
            {block name='copyright_link'}
              <a class="_blank" href="http://www.prestashop.com" target="_blank">
                {l s='%copyright% %year% - Ecommerce software by %prestashop%' sprintf=['%prestashop%' => 'PrestaShop™', '%year%' => 'Y'|date, '%copyright%' => '©'] d='Shop.Theme.Global'}
              </a>
            {/block}
        </div>
         {block name='hook_footer_after'}
           {hook h='displayFooterAfter'}
         {/block}
         </div>
      </div>
    </div>
</div>
<div id="back-top">
</div>
