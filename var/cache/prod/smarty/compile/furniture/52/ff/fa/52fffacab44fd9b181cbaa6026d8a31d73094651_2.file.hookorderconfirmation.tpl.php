<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:43:51
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/plugnpayapi/hookorderconfirmation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d59c76a4eb3_74348034',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52fffacab44fd9b181cbaa6026d8a31d73094651' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/plugnpayapi/hookorderconfirmation.tpl',
      1 => 1709033582,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d59c76a4eb3_74348034 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['status']->value == 'ok') {?>
	<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your order on','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
 <span class="bold"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop_name']->value, ENT_QUOTES, 'UTF-8');?>
</span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'is complete.','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>

		<br /><br /><span class="bold"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your order will be sent as soon as possible.','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
</span>
		<br /><br /><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'For any questions or for further information, please contact our','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
 <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact',true), ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'customer support','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
</a>.
	</p>
<?php } else { ?>
	<p class="warning">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'We noticed a problem with your order. If you think this is an error, you can contact our','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
 
		<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact',true), ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'customer support','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
</a>.
	</p>
<?php }
}
}
