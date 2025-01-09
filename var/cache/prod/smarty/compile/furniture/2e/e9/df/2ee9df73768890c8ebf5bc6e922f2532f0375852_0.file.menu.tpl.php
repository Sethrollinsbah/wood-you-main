<?php
/* Smarty version 3.1.48, created on 2025-01-06 14:33:12
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/admin/menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c2ff8707979_00872155',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2ee9df73768890c8ebf5bc6e922f2532f0375852' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/admin/menu.tpl',
      1 => 1736189402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c2ff8707979_00872155 (Smarty_Internal_Template $_smarty_tpl) {
?>
<a class="ets_abancart_menu_title ets_abancart_title menu_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['icon'],'html','UTF-8' ));?>
" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getAdminLink(($_smarty_tpl->tpl_vars['slugTab']->value).($_smarty_tpl->tpl_vars['menu']->value['class']),true),'html','UTF-8' ));?>
" data-slug="<?php echo $_smarty_tpl->tpl_vars['slugTab']->value;?>
" data-class="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['class'],'html','UTF-8' ));?>
">
	<img class="ets_abancart_icon <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['icon'],'html','UTF-8' ));?>
" src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['path']->value,'quotes','UTF-8' ));?>
views/img/origin/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['icon'],'html','UTF-8' ));?>
.png" alt="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['label'],'html','UTF-8' ));?>
">
	<span class="ets_abancart_submenu_content">
		<span><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['label'],'html','UTF-8' ));?>
</span>
		<?php if ((isset($_smarty_tpl->tpl_vars['menu']->value['desc'])) && $_smarty_tpl->tpl_vars['menu']->value['desc']) {?><span class="ets_abancart_help_block"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['desc'],'html','UTF-8' ));?>
</span><?php }?>
		<?php if (!empty($_smarty_tpl->tpl_vars['menu']->value['sub_menus'])) {?>
		<span class="ets_abancart_menu_li_arrow"></span>
		<?php }?>
	</span>
</a><?php }
}
