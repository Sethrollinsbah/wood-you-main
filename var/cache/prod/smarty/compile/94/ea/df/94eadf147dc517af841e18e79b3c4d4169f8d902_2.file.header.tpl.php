<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:52:01
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/lggoogleanalytics/views/templates/hook/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26517392a8_92289017',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '94eadf147dc517af841e18e79b3c4d4169f8d902' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/lggoogleanalytics/views/templates/hook/header.tpl',
      1 => 1720095542,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c26517392a8_92289017 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['LGGOOGLEANALYTICS_ID']->value)) {?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<?php echo '<script'; ?>
 type="text/javascript" async src="https://www.googletagmanager.com/gtag/js?id=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['LGGOOGLEANALYTICS_ID']->value,'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['LGGOOGLEANALYTICS_ID']->value,'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
', {
    <?php if ((isset($_smarty_tpl->tpl_vars['LGGOOGLEANALYTICS_ENABLE_DEBUG']->value)) && $_smarty_tpl->tpl_vars['LGGOOGLEANALYTICS_ENABLE_DEBUG']->value) {?>'debug_mode': true,<?php }?>
  });
<?php echo '</script'; ?>
>
<?php }
}
}
