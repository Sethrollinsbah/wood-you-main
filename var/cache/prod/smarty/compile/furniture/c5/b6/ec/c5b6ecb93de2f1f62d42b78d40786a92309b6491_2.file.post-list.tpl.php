<?php
/* Smarty version 3.1.48, created on 2025-01-07 14:24:08
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/amazzingblog/views/templates/front/post-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d7f581c7af3_90493301',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c5b6ecb93de2f1f62d42b78d40786a92309b6491' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/amazzingblog/views/templates/front/post-list.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d7f581c7af3_90493301 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['posts']->value) {?>
	<?php if (!empty($_smarty_tpl->tpl_vars['ab_pagination_settings']->value) && empty($_smarty_tpl->tpl_vars['no_pagination']->value)) {?>
		<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['blog']->value->getTemplatePath('pagination.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('settings'=>$_smarty_tpl->tpl_vars['ab_pagination_settings']->value,'p_type'=>$_smarty_tpl->tpl_vars['settings']->value['p_type']), 0, true);
?>
	<?php }?>
    <?php $_smarty_tpl->_assignInScope('col', false);
if ($_smarty_tpl->tpl_vars['settings']->value['display_type'] == 'grid') {
$_smarty_tpl->_assignInScope('col', 12/$_smarty_tpl->tpl_vars['settings']->value['col_num']);
}?>
	<?php if (empty($_smarty_tpl->tpl_vars['settings']->value['compact'])) {
$_smarty_tpl->_assignInScope('item_tpl', 'post-list-item.tpl');
} else {
$_smarty_tpl->_assignInScope('item_tpl', 'post-list-item-compact.tpl');
}?>
	<?php $_smarty_tpl->_assignInScope('item_tpl_path', $_smarty_tpl->tpl_vars['blog']->value->getTemplatePath($_smarty_tpl->tpl_vars['item_tpl']->value));?>
	<?php $_smarty_tpl->_assignInScope('tags_tpl_path', $_smarty_tpl->tpl_vars['blog']->value->getTemplatePath('post-tags.tpl'));?>
	<div class="post-list item-list <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['settings']->value['display_type'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['col']->value) {?> row<?php }?>">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post', false, 'k');
$_smarty_tpl->tpl_vars['post']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->do_else = false;
?>
		<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['item_tpl_path']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('post'=>$_smarty_tpl->tpl_vars['post']->value,'col'=>$_smarty_tpl->tpl_vars['col']->value,'tags_tpl_path'=>$_smarty_tpl->tpl_vars['tags_tpl_path']->value), 0, true);
?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</div>
	<?php if (!empty($_smarty_tpl->tpl_vars['ab_pagination_settings']->value) && empty($_smarty_tpl->tpl_vars['no_pagination']->value)) {?>
		<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['blog']->value->getTemplatePath('pagination.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('settings'=>$_smarty_tpl->tpl_vars['ab_pagination_settings']->value,'p_type'=>$_smarty_tpl->tpl_vars['settings']->value['p_type']), 0, true);
?>
	<?php }
} else { ?>
	<div class="alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No posts','mod'=>'amazzingblog'),$_smarty_tpl ) );?>
</div>
<?php }
}
}
