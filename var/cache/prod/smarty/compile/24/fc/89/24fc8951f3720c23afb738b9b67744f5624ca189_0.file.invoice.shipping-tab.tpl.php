<?php
/* Smarty version 3.1.48, created on 2025-01-09 14:47:28
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/pdf/invoice.shipping-tab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_678027d004e445_41057032',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '24fc8951f3720c23afb738b9b67744f5624ca189' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/pdf/invoice.shipping-tab.tpl',
      1 => 1716896617,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_678027d004e445_41057032 (Smarty_Internal_Template $_smarty_tpl) {
?><table id="shipping-tab" width="100%">
	<tr>
		<td class="shipping center small grey bold" width="44%"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Carrier','d'=>'Shop.Pdf','pdf'=>'true'),$_smarty_tpl ) );?>
</td>
		<td class="shipping center small white" width="56%"><?php echo $_smarty_tpl->tpl_vars['carrier']->value->name;?>
</td>
	</tr>
</table>
<?php }
}
