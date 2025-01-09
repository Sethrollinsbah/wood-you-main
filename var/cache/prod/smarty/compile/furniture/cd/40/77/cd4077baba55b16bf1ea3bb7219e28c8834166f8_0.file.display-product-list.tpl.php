<?php
/* Smarty version 3.1.48, created on 2025-01-07 10:42:17
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-product-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d4b594c6637_61226871',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd4077baba55b16bf1ea3bb7219e28c8834166f8' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-product-list.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d4b594c6637_61226871 (Smarty_Internal_Template $_smarty_tpl) {
?><table id="table-product" class="table product">
    <thead>
        <tr class="nodrag nodrop">
            <th></th>
            <th class="left">
                <span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'ID','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</span>
            </th>
            <th class="left">
                <span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</span>
            </th>
        </tr>
    </thead>
    <tbody>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
        <tr>
            <td class="row-selector text-center">
                <input id="simpletabs-product-<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" type="checkbox" name="simpletabs_productBox[]" value="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" noborder"<?php if ($_smarty_tpl->tpl_vars['product']->value['status'] > 0) {?>checked="checked"<?php }?>>
            </td>
            <td class="left">
                <?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>

            </td>
            <td class="left">
                <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8' ));?>

            </td>
        </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>
<div class="panel-footer">
    <div class="btn-group bulk-actions dropup">
        <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown">
            Bulk actions <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a href="#" onclick="javascript:checkDelBoxes($(this).closest('form').get(0), 'simpletabs_productBox[]', true);return false;">
                    <i class="icon-check-sign"></i>&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select All','mod'=>'simpletabs'),$_smarty_tpl ) );?>

                </a>
            </li>
            <li>
                <a href="#" onclick="javascript:checkDelBoxes($(this).closest('form').get(0), 'simpletabs_productBox[]', false);return false;">
                    <i class="icon-check-empty"></i>&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unselect All','mod'=>'simpletabs'),$_smarty_tpl ) );?>

                </a>
            </li>
        </ul>
    </div>
</div><?php }
}
