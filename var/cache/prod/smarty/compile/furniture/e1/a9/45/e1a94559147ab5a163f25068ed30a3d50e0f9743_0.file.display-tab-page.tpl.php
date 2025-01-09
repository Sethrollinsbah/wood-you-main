<?php
/* Smarty version 3.1.48, created on 2025-01-07 10:42:17
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-tab-page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d4b595d3ef9_43897722',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e1a94559147ab5a163f25068ed30a3d50e0f9743' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-tab-page.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d4b595d3ef9_43897722 (Smarty_Internal_Template $_smarty_tpl) {
?><h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tabs','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</h2>
<?php echo $_smarty_tpl->tpl_vars['tab_list']->value;
echo $_smarty_tpl->tpl_vars['tab_form']->value;?>

<?php echo '<script'; ?>
 type="text/javascript">
    var simpletabs_dir = '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module_dir']->value,"html","UTF-8" ));?>
',
        iso = '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['iso']->value,"htmlall","UTF-8" ));?>
',
        pathCSS = '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['path_css']->value,"htmlall","UTF-8" ));?>
',
        ad = '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['admin_dir']->value,"htmlall","UTF-8" ));?>
',
        secure_key = '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['secure_key']->value,"html","UTF-8" ));?>
',
        id_product = '<?php echo intval($_smarty_tpl->tpl_vars['id_product']->value);?>
';
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module_dir']->value,'html','UTF-8' ));?>
views/js/back.js" ><?php echo '</script'; ?>
><?php }
}
