<?php
/* Smarty version 3.1.48, created on 2025-01-06 14:33:12
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/admin/javascript.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c2ff86d3fa1_36061631',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1193c5468d435cbd9c5d1da5b91ecb1cd3775461' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/admin/javascript.tpl',
      1 => 1736189402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c2ff86d3fa1_36061631 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
    state_token = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0], array( array('tab'=>'AdminStates'),$_smarty_tpl ) );?>
';
    address_token = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0], array( array('tab'=>'AdminAddresses'),$_smarty_tpl ) );?>
';
    var ets_abancart_changed_confirm = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Chosen email template has been modified. Do you want to continue replace email template?','mod'=>'ets_abandonedcart','js'=>1),$_smarty_tpl ) );?>
';
    var ets_abancart_btn_finish = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Finish','mod'=>'ets_abandonedcart','js'=>1),$_smarty_tpl ) );?>
';
    var ets_abancart_btn_sendmail = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send email','mod'=>'ets_abandonedcart','js'=>1),$_smarty_tpl ) );?>
';
    var ets_abancart_btn_continue = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Continue','mod'=>'ets_abandonedcart','js'=>1),$_smarty_tpl ) );?>
';
    var ets_abancart_validate = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'is invalid','mod'=>'ets_abandonedcart','js'=>1),$_smarty_tpl ) );?>
';
    var ets_abancart_required = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'is required','mod'=>'ets_abandonedcart','js'=>1),$_smarty_tpl ) );?>
';
    var ets_abancart_temp_required = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email template is required','mod'=>'ets_abandonedcart','js'=>1),$_smarty_tpl ) );?>
';

    var ETS_AB_HTML_PURIFIER = <?php echo intval($_smarty_tpl->tpl_vars['html_purifier']->value);?>
;
    <?php if (!empty($_smarty_tpl->tpl_vars['img_dir']->value)) {?>
    var ets_abancart_img_dir='<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
';
    <?php }?>
    var ETS_ABANCART_PS_VERSION_17 = <?php echo intval($_smarty_tpl->tpl_vars['is17']->value);?>
;
    if (ETS_ABANCART_PS_VERSION_17 && typeof $.fn.mColorPicker !== "undefined") {
        $.fn.mColorPicker.defaults.imageFolder = baseDir + 'img/admin/';
    }
    <?php if ((isset($_smarty_tpl->tpl_vars['campaign_url']->value)) && $_smarty_tpl->tpl_vars['campaign_url']->value) {?>
    var ETS_ABANCART_CAMPAIGN_URL='<?php echo $_smarty_tpl->tpl_vars['campaign_url']->value;?>
';
    <?php }
echo '</script'; ?>
>
<?php if (!empty($_smarty_tpl->tpl_vars['js_files']->value)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['js_files']->value, 'js_file');
$_smarty_tpl->tpl_vars['js_file']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['js_file']->value) {
$_smarty_tpl->tpl_vars['js_file']->do_else = false;
?>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js_file']->value;?>
"><?php echo '</script'; ?>
>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
}
