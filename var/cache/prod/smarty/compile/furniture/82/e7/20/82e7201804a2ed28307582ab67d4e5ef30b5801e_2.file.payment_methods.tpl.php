<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:40:02
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/payment_methods.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d58e2a02f51_14085488',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '82e7201804a2ed28307582ab67d4e5ef30b5801e' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/payment_methods.tpl',
      1 => 1736189423,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d58e2a02f51_14085488 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="checkout-personal-information-step" class="checkout-step -reachable -complete -clickable"></div>
<section id="checkout-payment-step" class="checkout-step -current -reachable js-current-step">
    <div class="content">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayPaymentTop'),$_smarty_tpl ) );?>

        <div class="payment-options">
            <form></form>
            <?php if ($_smarty_tpl->tpl_vars['payment_methods']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payment_methods']->value, 'payment_method', false, 'module_name');
$_smarty_tpl->tpl_vars['payment_method']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['module_name']->value => $_smarty_tpl->tpl_vars['payment_method']->value) {
$_smarty_tpl->tpl_vars['payment_method']->do_else = false;
?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payment_method']->value, 'module');
$_smarty_tpl->tpl_vars['module']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->do_else = false;
?>
                        <div class="ets_payment_method">
                            <div id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
-container" class="payment-option clearfix">
                                <span class="custom-radio float-xs-left">
                                     <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                            class="ps-shown-by-js <?php if ($_smarty_tpl->tpl_vars['module']->value['module_name']) {
if ($_smarty_tpl->tpl_vars['payment_selected']->value == $_smarty_tpl->tpl_vars['module']->value['module_name']) {?>checked<?php }
} else {
if ($_smarty_tpl->tpl_vars['payment_selected']->value == $_smarty_tpl->tpl_vars['module_name']->value) {?>checked<?php }
}?>"
                                            data-module-name="<?php if ($_smarty_tpl->tpl_vars['module']->value['module_name']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['module_name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" name="payment-option" type="radio"
                                            value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                     />
                                    <span></span>
                                </span>
                                <form method="GET" class="ps-hidden-by-js" style="display:none;">
                                    <button class="ps-hidden-by-js" type="submit" name="select_payment_option" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Choose','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                                    </button>
                                </form>
                                <label for="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                    <span>
                                        <?php if ($_smarty_tpl->tpl_vars['ETS_OPC_PAYMENT_LOGO_ENABLED']->value) {
if ((isset($_smarty_tpl->tpl_vars['module']->value['logo'])) && $_smarty_tpl->tpl_vars['module']->value['logo']) {?><img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['logo'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="width:40px" /><?php }
}?>
                                        <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['call_to_action_text'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                    </span>
                                </label>
                            </div>
                            <div id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
-additional-information" class="js-additional-information definition-list additional-information ps-hidden " <?php if ($_smarty_tpl->tpl_vars['payment_selected']->value == $_smarty_tpl->tpl_vars['module']->value['module_name']) {?> style="display:block"<?php } else { ?>style="display: none;"<?php }?>>
                                <?php echo $_smarty_tpl->tpl_vars['module']->value['additionalInformation'];?>

                            </div>
                            <div id="pay-with-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
-form" class="js-payment-option-form ps-hidden " <?php if ($_smarty_tpl->tpl_vars['payment_selected']->value == $_smarty_tpl->tpl_vars['module']->value['module_name']) {?>  style="color:red; display:block"<?php } else { ?>style="display: none;"<?php }?>>
                                <?php if ($_smarty_tpl->tpl_vars['module']->value['form']) {?>
                                    <?php echo $_smarty_tpl->tpl_vars['module']->value['form'];?>

                                <?php } else { ?>
                                    <form id="payment-form" method="POST" action="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['action'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                        <?php if ((isset($_smarty_tpl->tpl_vars['module']->value['inputs'])) && $_smarty_tpl->tpl_vars['module']->value['inputs']) {?>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['module']->value['inputs'], 'input');
$_smarty_tpl->tpl_vars['input']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['input']->value) {
$_smarty_tpl->tpl_vars['input']->do_else = false;
?>
                                                <input<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['input']->value, 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?> <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['key']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['value']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> />
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        <?php }?>
                                        <button id="pay-with-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="display:none" type="submit"></button>
                                    </form>
                                <?php }?>
                            </div>
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
                <div class="alert alert-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unfortunately, there are no payment methods available.','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</div>
            <?php }?>
        </div>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayPaymentByBinaries'),$_smarty_tpl ) );?>

    </div>
</section><?php }
}
