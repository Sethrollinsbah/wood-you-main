<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:57:24
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c2794919470_43763543',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9cf72be6573c01cf2c268921ce4aa0ecf2df09d8' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/header.tpl',
      1 => 1736189423,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c2794919470_43763543 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
    var ETS_OPC_URL_OAUTH ='<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('ets_onepagecheckout','oauth');?>
';
    var ETS_OPC_CHECK_BOX_NEWSLETTER = <?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['ETS_OPC_CHECK_BOX_NEWSLETTER']->value), ENT_QUOTES, 'UTF-8');?>
;
    var ETS_OPC_CHECK_BOX_OFFERS =<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['ETS_OPC_CHECK_BOX_OFFERS']->value), ENT_QUOTES, 'UTF-8');?>
;
<?php echo '</script'; ?>
><?php }
}
