<?php
/* Smarty version 3.1.48, created on 2025-01-07 10:42:17
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-tab-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d4b594a96b2_64289125',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '62b40f8741b1748ca8ae3780e8d6daaf2aeeef27' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-tab-list.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d4b594a96b2_64289125 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="simpletabs-list">
    <table class="table table-striped">
        <thead>
            <tr class="text-uppercase">
                <th class="text-xs-center">
                    <span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'ID','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</span>
                </th>
                <th>
                    <span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Title','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</span>
                </th>
                <th>
                    <span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Content','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</span>
                </th>
                <th class="text-xs-center">
                    <span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</span>
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tab_list']->value, 'tab');
$_smarty_tpl->tpl_vars['tab']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->do_else = false;
?>
            <tr id="simpletabs-tab-<?php echo intval($_smarty_tpl->tpl_vars['tab']->value['id_tab']);?>
">
                <td class="text-xs-center">
                    <?php echo intval($_smarty_tpl->tpl_vars['tab']->value['id_tab']);?>

                </td>
                <td>
                    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['title'],'html','UTF-8' ));?>

                </td>
                <td>
                    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['tab']->value['content']),100,'...' )),'html','UTF-8' ));?>

                </td>
                <td class="text-xs-center">
                    <i class="material-icons"><?php if ($_smarty_tpl->tpl_vars['tab']->value['status'] == 1) {?>check<?php } else { ?>clear<?php }?></i>
                </td>
                <td class="text-xs-center attribute-actions">
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="#simpletabs-form" class="simpletabs-edit btn btn-open btn-invisible btn-sm" data-id-tab="<?php echo intval($_smarty_tpl->tpl_vars['tab']->value['id_tab']);?>
"><i class="material-icons">mode_edit</i></a>
                        <a href="#" class="simpletabs-delete btn btn-open btn-invisible btn-sm" data-id-tab="<?php echo intval($_smarty_tpl->tpl_vars['tab']->value['id_tab']);?>
" data-confirmation="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete tab "%s"?','sprintf'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['title'],'html','UTF-8' )),'mod'=>'simpletabs'),$_smarty_tpl ) );?>
"><i class="material-icons">delete</i></a>
                    </div>
                </td>
            </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </tbody>
    </table>

    <div class="panel-footer">
        <div class="pull-right">
            <a id="simpletabs-new-tab" class="btn btn-action" href="#"><i class="material-icons">add_circle</i> <span data-label-add="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'New tab','mod'=>'simpletabs'),$_smarty_tpl ) );?>
" data-label-cancel="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel editing','mod'=>'simpletabs'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'New tab','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</span></a>
            <button id="simpletabs-submit-button" class="btn btn-primary btn-submit" type="submit" value="1" name="submitAddproduct" disabled="disabled" data-redirect=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save tab','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</button>
        </div>
    </div>
</div><?php }
}
