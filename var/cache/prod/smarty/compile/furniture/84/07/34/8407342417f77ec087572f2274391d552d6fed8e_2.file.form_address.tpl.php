<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:40:02
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/form_address.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d58e2976b43_14530194',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8407342417f77ec087572f2274391d552d6fed8e' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/form_address.tpl',
      1 => 1736189423,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d58e2976b43_14530194 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="js-address-form <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
    <input name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[id_address]" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['class_address']->value->id), ENT_QUOTES, 'UTF-8');?>
" type="hidden" />
    <?php if ($_smarty_tpl->tpl_vars['field_address']->value) {?>
        <?php if (!in_array('country',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
            <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_id_country" class="form-control form-control-select ets-onepage-js-country" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[id_country]" type="hidden" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['id_country']->value), ENT_QUOTES, 'UTF-8');?>
" />
        <?php }?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['field_address']->value, 'field', false, 'key');
$_smarty_tpl->tpl_vars['field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['field']->value) {
$_smarty_tpl->tpl_vars['field']->do_else = false;
?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'alias' && in_array('alias',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row ">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('alias',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Alias','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_alias" class="form-control validate<?php if (in_array('alias',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isGenericName" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[alias]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( trim($_smarty_tpl->tpl_vars['class_address']->value->alias),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="32" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Alias is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Alias is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'firstname' && in_array('firstname',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row firstname">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label <?php if (in_array('firstname',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_firstname" class="form-control validate <?php if (in_array('firstname',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isCustomerName" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[firstname]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( trim($_smarty_tpl->tpl_vars['class_address']->value->firstname),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="255"  type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
"/> 
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'lastname' && in_array('lastname',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row lastname">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label <?php if (in_array('lastname',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_lastname" class="form-control validate <?php if (in_array('lastname',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isCustomerName" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[lastname]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( trim($_smarty_tpl->tpl_vars['class_address']->value->lastname),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="255" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'company' && in_array('company',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_customer_type_invoice">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label <?php if (in_array('company',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Company','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right ">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_company" class="form-control validate<?php if (in_array('company',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isGenericName" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[company]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( trim($_smarty_tpl->tpl_vars['class_address']->value->company),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="255" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Company is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Company is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'address' && in_array('address',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row ">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label <?php if (in_array('address',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Address','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_address1" class="form-control validate <?php if (in_array('address',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isAddress" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[address1]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( trim($_smarty_tpl->tpl_vars['class_address']->value->address1),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="128" type="text" id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_address1" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Address is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Address is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'address2' && in_array('address2',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row ">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('address2',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Address Complement','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_address2" class="form-control validate<?php if (in_array('address2',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isAddress" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[address2]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( trim($_smarty_tpl->tpl_vars['class_address']->value->address2),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="128" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Address Complement is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Address Complement is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'other' && in_array('other',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row ">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('other',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Other','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_other" class="form-control validate<?php if (in_array('other',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isMessage" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[other]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( trim($_smarty_tpl->tpl_vars['class_address']->value->other),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="128" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Other is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Other is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'city' && in_array('city',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row ">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('city',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'City','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_city" class="form-control validate<?php if (in_array('city',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isCityName" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[city]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( trim($_smarty_tpl->tpl_vars['class_address']->value->city),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="64" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'City is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'City is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
"/>
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'state' && in_array('state',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row address_state" <?php if (!$_smarty_tpl->tpl_vars['states']->value) {?> style="display:none"<?php }?>>
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label <?php if (in_array('state',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'State','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <?php if ($_smarty_tpl->tpl_vars['states']->value) {?>
                            <div class="ets_opc_select">
                                <span class="ets_opc_select_arrow">
                                    <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg>
                                </span>
                                <select id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_id_state" class="form-control form-control-select" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[id_state]" id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_id_state">
                                    <option value="0">-- <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'please choose','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 --</option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['states']->value, 'state');
$_smarty_tpl->tpl_vars['state']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->do_else = false;
?>
                                        <option data-iso-code="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['state']->value['iso_code'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['state']->value['id_state']), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['id_state_selected']->value) {
if ($_smarty_tpl->tpl_vars['id_state_selected']->value == $_smarty_tpl->tpl_vars['state']->value['id_state']) {?> selected="selected"<?php }
} else { ?> <?php if ($_smarty_tpl->tpl_vars['class_address']->value->id_state == $_smarty_tpl->tpl_vars['state']->value['id_state']) {?> selected="selected"<?php }
}?>><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['state']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select>
                            </div>
                        <?php }?>
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'postcode' && in_array('post_code',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row ">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('post_code',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Zip Code','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_postal_code" class="form-control validate<?php if (in_array('post_code',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isPostCode" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[postcode]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['class_address']->value->postcode,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="12" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Zip code is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Zip code is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
"/>
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'country' && in_array('country',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row ">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('country',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Country','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <div class="ets_opc_select">
                            <span class="ets_opc_select_arrow">
                                    <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg>
                                </span>
                            <select id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_id_country" class="form-control form-control-select ets-onepage-js-country" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[id_country]" data-type="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_country">
                                <option value="">-- <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'please choose','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 --</option>
                                <?php if ($_smarty_tpl->tpl_vars['countries']->value) {?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countries']->value, 'country');
$_smarty_tpl->tpl_vars['country']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['country']->value) {
$_smarty_tpl->tpl_vars['country']->do_else = false;
?>
                                        <option data-iso-code="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['country']->value['iso_code'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['country']->value['id_country']), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['country']->value['id_country'] == $_smarty_tpl->tpl_vars['id_country']->value) {?> selected="selected"<?php }?> ><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['country']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'phone' && in_array('phone',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('phone',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Phone','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_phone" class="form-control validate<?php if (in_array('phone',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isPhoneNumber" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[phone]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['class_address']->value->phone,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="32" type="tel" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Phone is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Phone is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'phonemobile' && in_array('phone_mobile',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('phone_mobile',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mobile phone','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_phone_mobile" class="form-control validate<?php if (in_array('phone_mobile',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isPhoneNumber" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[phone_mobile]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['class_address']->value->phone_mobile,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="32" type="tel" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mobile phone is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mobile phone is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'dni' && in_array('dni',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row ">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('dni',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Identification number','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_dni" class="form-control validate<?php if (in_array('dni',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isDniLite" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[dni]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['class_address']->value->dni,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="128" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Identification number is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Identification number is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
"/>
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'vatnumber' && in_array('vat_number',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row ">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('vat_number',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'VAT number','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_vat_number" class="form-control validate<?php if (in_array('vat_number',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isGenericName" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[vat_number]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['class_address']->value->vat_number,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="128" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'VAT number is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'VAT number is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'eicustomertype' && in_array('company',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label" for="field-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
-eicustomertype">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customer type','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                    </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> form-control-valign opc_field_right">
                        <label class="radio-inline">
                            <span class="custom-radio">
                              <input class="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
-eicustomertype" data-type="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[eicustomertype]" type="radio" value="0" <?php if (!(isset($_smarty_tpl->tpl_vars['class_address']->value->company)) || !$_smarty_tpl->tpl_vars['class_address']->value->company) {?>checked<?php }?>>
                              <span></span>
                            </span>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Private','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                        </label>
                        <label class="radio-inline">
                            <span class="custom-radio">
                              <input class="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
-eicustomertype" data-type="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[eicustomertype]" type="radio" value="1" <?php if ((isset($_smarty_tpl->tpl_vars['class_address']->value->company)) && $_smarty_tpl->tpl_vars['class_address']->value->company) {?>checked<?php }?>>
                              <span></span>
                            </span>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Company','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                        </label>
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'eisdi' && in_array('eisdi',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value) && in_array('eicustomertype',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_customer_type_invoice">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('eisdi',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'SDI code','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_eisdi" class="form-control validate<?php if (in_array('eisdi',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isGenericName" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[eisdi]" value="<?php if ((isset($_smarty_tpl->tpl_vars['class_address']->value->eisdi))) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['class_address']->value->eisdi,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" maxlength="128" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'SDI code is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'SDI code is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'eipec' && in_array('eipec',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value) && in_array('eicustomertype',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_customer_type_invoice">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('eipec',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'PEC address','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_eipec" class="form-control validate<?php if (in_array('eipec',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isEmail" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[eipec]" value="<?php if ((isset($_smarty_tpl->tpl_vars['class_address']->value->eipec))) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['class_address']->value->eipec,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" maxlength="128" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'PEC address is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'EPC address is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'eipa' && in_array('eipa',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value) && in_array('eicustomertype',$_smarty_tpl->tpl_vars['ETS_OPC_ADDRESS_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_customer_type_invoice">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label" for="field-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
-eipa">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Public Administration','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                    </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> form-control-valign opc_field_right">
                        <label class="radio-inline">
                            <span class="custom-radio">
                              <input data-type="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[eipa]" type="radio" value="0" <?php if (!(isset($_smarty_tpl->tpl_vars['class_address']->value->eipa)) || !$_smarty_tpl->tpl_vars['class_address']->value->eipa) {?>checked<?php }?>>
                              <span></span>
                            </span>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                        </label>
                        <label class="radio-inline">
                            <span class="custom-radio">
                              <input data-type="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['address_type']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[eipa]" type="radio" value="1" <?php if ((isset($_smarty_tpl->tpl_vars['class_address']->value->eipa)) && $_smarty_tpl->tpl_vars['class_address']->value->eipa) {?>checked<?php }?>>
                              <span></span>
                            </span>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                        </label>
                    </div>
                </div>
            <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
</div><?php }
}
