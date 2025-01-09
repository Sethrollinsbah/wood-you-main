<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:54:44
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/testimonialswithavatars/views/templates/hook/twa_hook.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26f4ea6d20_93346403',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5c6b81823b12460050d3a058b0e5664cd512ca1e' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/testimonialswithavatars/views/templates/hook/twa_hook.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./../front/post-list.tpl' => 1,
  ),
),false)) {
function content_677c26f4ea6d20_93346403 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="twa_in_hook<?php if ($_smarty_tpl->tpl_vars['in_column']->value) {?> block<?php }
if (!$_smarty_tpl->tpl_vars['in_column']->value) {?> twa-wrapper <?php }
if ($_smarty_tpl->tpl_vars['hook_settings']->value['displayType'] == 1) {?> carousel square_arrows<?php }?> <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
	<?php if (!empty($_smarty_tpl->tpl_vars['title']->value)) {?>
		<h2 class="<?php if ($_smarty_tpl->tpl_vars['in_column']->value) {?>title_block <?php } else { ?>title_main_section <?php }?>">
			<?php if (!empty($_smarty_tpl->tpl_vars['view_all_link']->value)) {?>
			<a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['view_all_link']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View all','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
">
			<?php }?>
				<span>
					<b><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['title']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</b>
				</span>
			<?php if (!empty($_smarty_tpl->tpl_vars['view_all_link']->value)) {?>
			</a>
			<?php }?>
		</h2>
	<?php }?>
	<div class="twa-inner">
		<div id="twa_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="twa_posts<?php if ($_smarty_tpl->tpl_vars['hook_settings']->value['displayType'] == 2 && !$_smarty_tpl->tpl_vars['in_column']->value) {?> grid<?php } else { ?> list<?php }?>">
			<?php $_smarty_tpl->_subTemplateRender("file:./../front/post-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('posts'=>$_smarty_tpl->tpl_vars['twa_hook_posts']->value), 0, false);
?>
		</div>
	</div>
	<?php if (!empty($_smarty_tpl->tpl_vars['view_all_link']->value)) {?>
		<?php }?>
</div>
<?php }
}
