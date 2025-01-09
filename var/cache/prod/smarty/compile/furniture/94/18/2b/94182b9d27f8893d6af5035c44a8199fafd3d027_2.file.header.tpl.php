<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:52:01
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/ets_megamenu/views/templates/hook/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26516fa7e8_70014427',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '94182b9d27f8893d6af5035c44a8199fafd3d027' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/ets_megamenu/views/templates/hook/header.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c26516fa7e8_70014427 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['mm_css']->value)) && $_smarty_tpl->tpl_vars['mm_css']->value) {?>
<style><?php echo $_smarty_tpl->tpl_vars['mm_css']->value;?>
</style>
<?php }
echo '<script'; ?>
 type="text/javascript">
    var Days_text = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Day(s)','mod'=>'ets_megamenu','js'=>1),$_smarty_tpl ) );?>
';
    var Hours_text = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hr(s)','mod'=>'ets_megamenu','js'=>1),$_smarty_tpl ) );?>
';
    var Mins_text = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Min(s)','mod'=>'ets_megamenu','js'=>1),$_smarty_tpl ) );?>
';
    var Sec_text = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sec(s)','mod'=>'ets_megamenu','js'=>1),$_smarty_tpl ) );?>
';
<?php echo '</script'; ?>
><?php }
}
