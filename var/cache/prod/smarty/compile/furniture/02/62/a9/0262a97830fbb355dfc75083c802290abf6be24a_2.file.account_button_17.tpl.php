<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:57:47
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/lgcookieslaw/views/templates/front/account_button_17.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c27ab116053_15175270',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0262a97830fbb355dfc75083c802290abf6be24a' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/lgcookieslaw/views/templates/front/account_button_17.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c27ab116053_15175270 (Smarty_Internal_Template $_smarty_tpl) {
?><a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="lgcookieslaw-link" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['lgcookieslaw_disallow_url']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Revoke my consent to cookies','mod'=>'lgcookieslaw'),$_smarty_tpl ) );?>
">
    <span class="link-item">
        <img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['lgcookieslaw_image_path']->value,'quotes','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="padding: 10px; float: left;">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Revoke my consent to cookies','mod'=>'lgcookieslaw'),$_smarty_tpl ) );?>

    </span>
</a>
<?php }
}
