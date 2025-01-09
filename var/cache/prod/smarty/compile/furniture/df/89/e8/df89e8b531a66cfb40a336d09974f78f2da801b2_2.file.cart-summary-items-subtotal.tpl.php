<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:41:43
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/cart-summary-items-subtotal.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d59470d9ae4_64331955',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df89e8b531a66cfb40a336d09974f78f2da801b2' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/cart-summary-items-subtotal.tpl',
      1 => 1736189423,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d59470d9ae4_64331955 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="card-block cart-summary-line cart-summary-items-subtotal clearfix" id="items-subtotal">
    <span class="label"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['summary_string'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
    <span class="value"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['subtotals']['products']['amount'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
</div><?php }
}
