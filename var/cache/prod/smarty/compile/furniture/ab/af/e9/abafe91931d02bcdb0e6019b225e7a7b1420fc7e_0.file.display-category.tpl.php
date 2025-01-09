<?php
/* Smarty version 3.1.48, created on 2025-01-07 10:42:17
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-category.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d4b594e6c36_24869402',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'abafe91931d02bcdb0e6019b225e7a7b1420fc7e' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-category.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d4b594e6c36_24869402 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="checkbox">
    <label><input name="simpletabs_categoryBox[]" value="<?php echo intval($_smarty_tpl->tpl_vars['category']->value['id_category']);?>
" class="category" type="checkbox"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['category']->value['name'],'html','UTF-8' ));?>
</label>
</div><?php }
}
