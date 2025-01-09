<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:52:09
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/hook/admin_head.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c265981ad06_34409836',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '013589dcac1eabdc9fd8b5826ed039fcce8cf1e1' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/hook/admin_head.tpl',
      1 => 1736189402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c265981ad06_34409836 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
    var ETS_AC_LINK_REMINDER_ADMIN = "<?php echo $_smarty_tpl->tpl_vars['linkReminderEmail']->value;?>
";
    var ETS_AC_LINK_CAMPAIGN_TRACKING = "<?php echo $_smarty_tpl->tpl_vars['linkCampaignTracking']->value;?>
";
    var ETS_AC_LOGO_LINK = "<?php echo $_smarty_tpl->tpl_vars['logoLink']->value;?>
";
    var ETS_AC_IMG_MODULE_LINK = "<?php echo $_smarty_tpl->tpl_vars['imgModuleDir']->value;?>
";
    var ETS_AC_FULL_BASE_URL = "<?php echo $_smarty_tpl->tpl_vars['fullBaseUrl']->value;?>
";
    var ETS_AC_ADMIN_CONTROLLER= "<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_GET['controller'],'html','UTF-8' ));?>
";
    var ETS_AC_TRANS = {};
    ETS_AC_TRANS['clear_tracking'] = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Clear tracking','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
";
    ETS_AC_TRANS['email_temp_setting'] = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email template settings','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
";
    ETS_AC_TRANS['confirm_clear_tracking'] = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Clear tracking will also delete all data of Campaign tracking table and statistic data of Dashboard. Do you want to clear tracking?','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
";
    ETS_AC_TRANS['confirm_delete_lead_field'] = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Do you want to delete this field?','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
";
    ETS_AC_TRANS['lead_form_not_found'] = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Lead form does not exist','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
";
    ETS_AC_TRANS['lead_form_disabled'] = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Lead form is disabled','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
";
<?php echo '</script'; ?>
>
<?php }
}
