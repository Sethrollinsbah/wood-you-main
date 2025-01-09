<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:40:02
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/delivery_address.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d58e2988013_50510494',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b9dd5386b69bb7aae59958807ffab5076588902' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/delivery_address.tpl',
      1 => 1736189423,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d58e2988013_50510494 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="title yes_invoice_address" style="display:none"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delivery address','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</div>
<?php if ($_smarty_tpl->tpl_vars['list_address']->value) {?>
    <?php if ($_smarty_tpl->tpl_vars['use_address']->value) {?>
        <div class="form-group row p_0 ">
            <label class="col-md-4 form-control-label required"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Use address','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
            <div class="col-md-8 opc_field_right">
                <div class="shipping_address_form">
                        <div class="ets_opc_select">
                            <span class="ets_opc_select_arrow">
                                <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg>
                            </span>
                            <select id="use_shipping_address" name="shipping_address[id_address]" class="form-control" data-type="shipping_address">
                                <option value="" disabled="" selected="">-- <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'please choose','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 --</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_address']->value, 'address');
$_smarty_tpl->tpl_vars['address']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['address']->value) {
$_smarty_tpl->tpl_vars['address']->do_else = false;
?>
                                    <option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['address']->value['id_address']), ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->tpl_vars['address']->value['id_address'] == $_smarty_tpl->tpl_vars['id_address']->value) {?> selected="selected"<?php }?>><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address']->value['alias'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                <option value="new"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter new address','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</option>
                            </select>
                        </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <input id="use_shipping_address" type="hidden" name="shipping_address[id_address]" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['id_address']->value), ENT_QUOTES, 'UTF-8');?>
" data-type="shipping_address" />
    <?php }
}
echo $_smarty_tpl->tpl_vars['address_form']->value;?>

<?php if ($_smarty_tpl->tpl_vars['use_address_invoice']->value) {?>
    <p class="no_invoice_address"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The selected address will be used both as your personal address (for invoice) and as your delivery address.','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</p>
    <div class="form-group row ">
        <label for="use_another_address_for_invoice" class="ets_checkinput">
        <input type="checkbox" name="use_another_address_for_invoice" id="use_another_address_for_invoice" value="1" />&nbsp;<i class="ets_checkbox"></i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Use another address for invoice','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
        
    </div>
<?php }
}
}
