<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:57:47
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/hook/fo-block.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c27ab11b9a0_80085123',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f23316f1d7093a5a69ffb3a22be0a9269efe85f' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/hook/fo-block.tpl',
      1 => 1736189402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c27ab11b9a0_80085123 (Smarty_Internal_Template $_smarty_tpl) {
?><li class="<?php if ($_smarty_tpl->tpl_vars['is17']->value) {?>col-lg-4 col-md-6 col-sm-6 col-xs-12 <?php }?>ets_abancart_shopping_cart">
  <a class="" id="shopping-cart-link" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
    <span class="link-item">
      <i class="material-icons shopping-cart">shopping_cart</i>
      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My shopping carts','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

    </span>
  </a>
</li><?php }
}
