<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:53:56
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/giftcard/views/templates/hook/blockgiftcard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26c4c10423_53021848',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '536d9c36efb5f9ec6acf2696cbca1250044a041a' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/giftcard/views/templates/hook/blockgiftcard.tpl',
      1 => 1735772756,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c26c4c10423_53021848 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="giftcard_block" class="block-giftcard hidden-sm-down">
  <h4 class="text-uppercase h6 hidden-sm-down"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Offer a gift card','mod'=>'giftcard'),$_smarty_tpl ) );?>
</h4>
  <p class="block_content link_gift_cards list-block">
		<a  href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link_choicegiftcard']->value,'quotes','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"  title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Offer a gift card','mod'=>'giftcard'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Gift cards','mod'=>'giftcard'),$_smarty_tpl ) );?>
</a>
  </p>
</div><?php }
}
