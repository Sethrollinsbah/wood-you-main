<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:41:42
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/states.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d5946921578_28358608',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8d31392aedfa59dfee63fe44cf328c2b7592e58' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/states.tpl',
      1 => 1736189423,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d5946921578_28358608 (Smarty_Internal_Template $_smarty_tpl) {
?><select id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_id_state" class="form-control form-control-select" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[id_state]">
    <option value="0">-- <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'please choose','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 --</option>
    <?php if ($_smarty_tpl->tpl_vars['states']->value) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['states']->value, 'state');
$_smarty_tpl->tpl_vars['state']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->do_else = false;
?>
            <option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['state']->value['id_state']), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['state']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
</select><?php }
}
