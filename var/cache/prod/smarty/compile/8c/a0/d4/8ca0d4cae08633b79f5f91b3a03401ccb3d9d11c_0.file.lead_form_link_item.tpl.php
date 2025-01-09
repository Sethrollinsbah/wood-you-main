<?php
/* Smarty version 3.1.48, created on 2025-01-06 14:34:08
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/hook/lead_form_link_item.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c3030bef926_71922349',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ca0d4cae08633b79f5f91b3a03401ccb3d9d11c' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/hook/lead_form_link_item.tpl',
      1 => 1736189402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c3030bef926_71922349 (Smarty_Internal_Template $_smarty_tpl) {
?><a href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['leadFormUrl']->value,'quotes','UTF-8' ));?>
" class="ets-ac-lead-form-link-item" target="_blank"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['leadFormName']->value,'html','UTF-8' ));?>
</a><?php }
}
