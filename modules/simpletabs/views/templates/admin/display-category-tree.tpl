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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2018 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div class="categories-tree js-categories-tree">
    <fieldset class="form-group">
        <div class="ui-widget">
            <div class="categories-tree-actions js-categories-tree-actions">
                <span class="form-control-label" data-action="expand"><i class="material-icons">expand_more</i>Expand</span>
                <span class="form-control-label" data-action="reduce"><i class="material-icons">expand_less</i>Collapse</span>
                <hr class="category-hr">
            </div>
            <div id="form_simpletabs_categories">
                <ul class="category-tree">
                    {$category_tree}{* Cannot be escaped *}
                </ul>
            </div>
        </div>
    </fieldset>
</div>

<div class="panel-footer">
    <div class="btn-group bulk-actions dropup">
        <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown">
            Bulk actions <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a href="#" onclick="javascript:checkDelBoxes($(this).closest('form').get(0), 'simpletabs_categoryBox[]', true);return false;">
                    <i class="icon-check-sign"></i>&nbsp;{l s='Select All' mod='simpletabs'}
                </a>
            </li>
            <li>
                <a href="#" onclick="javascript:checkDelBoxes($(this).closest('form').get(0), 'simpletabs_categoryBox[]', false);return false;">
                    <i class="icon-check-empty"></i>&nbsp;{l s='Unselect All' mod='simpletabs'}
                </a>
            </li>
        </ul>
    </div>
</div>