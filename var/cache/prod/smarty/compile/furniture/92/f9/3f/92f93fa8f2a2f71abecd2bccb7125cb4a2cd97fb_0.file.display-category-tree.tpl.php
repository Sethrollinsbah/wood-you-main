<?php
/* Smarty version 3.1.48, created on 2025-01-07 10:42:17
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-category-tree.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d4b5959ebd6_09104495',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92f93fa8f2a2f71abecd2bccb7125cb4a2cd97fb' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-category-tree.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d4b5959ebd6_09104495 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="categories-tree js-categories-tree">
    <fieldset class="form-group">
        <div class="ui-widget">
            <div class="categories-tree-actions js-categories-tree-actions">
                <span class="form-control-label" data-action="expand"><i class="material-icons">expand_more</i>Expand</span>
                <span class="form-control-label" data-action="reduce"><i class="material-icons">expand_less</i>Collapse</span>
                <hr class="category-hr">
            </div>
            <div id="form_simpletabs_categories">
                <ul class="category-tree">
                    <?php echo $_smarty_tpl->tpl_vars['category_tree']->value;?>
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
                    <i class="icon-check-sign"></i>&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select All','mod'=>'simpletabs'),$_smarty_tpl ) );?>

                </a>
            </li>
            <li>
                <a href="#" onclick="javascript:checkDelBoxes($(this).closest('form').get(0), 'simpletabs_categoryBox[]', false);return false;">
                    <i class="icon-check-empty"></i>&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unselect All','mod'=>'simpletabs'),$_smarty_tpl ) );?>

                </a>
            </li>
        </ul>
    </div>
</div><?php }
}
