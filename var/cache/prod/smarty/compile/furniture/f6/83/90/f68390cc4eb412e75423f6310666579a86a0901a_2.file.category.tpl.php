<?php
/* Smarty version 3.1.48, created on 2025-01-07 14:24:08
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/amazzingblog/views/templates/front/category.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d7f581b6664_19539811',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f68390cc4eb412e75423f6310666579a86a0901a' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/amazzingblog/views/templates/front/category.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d7f581b6664_19539811 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('category', $_smarty_tpl->tpl_vars['ab_category']->value);?>
<div class="amazzingblog category-page">
<?php if ($_smarty_tpl->tpl_vars['category']->value && $_smarty_tpl->tpl_vars['category']->value['active']) {?>
	<?php if (!$_smarty_tpl->tpl_vars['blog']->value->is_17) {
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['blog']->value->getTemplatePath('breadcrumbs.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('parents'=>$_smarty_tpl->tpl_vars['ab_cat_parents']->value,'current_item'=>$_smarty_tpl->tpl_vars['category']->value['title']), 0, true);
}?>
	<h2><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['category']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</h2>
	<?php if (!empty($_smarty_tpl->tpl_vars['category']->value['description'])) {?>
		<div class="category-description">
			<?php echo $_smarty_tpl->tpl_vars['category']->value['description'];?>
 		</div>
	<?php }?>
	<?php if (!empty($_smarty_tpl->tpl_vars['ab_subcategories']->value)) {?>
		<div class="blog-subcategories">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ab_subcategories']->value, 'cat');
$_smarty_tpl->tpl_vars['cat']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->do_else = false;
?>
			<div class="blog-subcategory">
				<a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cat']->value['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cat']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
					<span class="blog-category-title"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cat']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
				</a>
				<span class="posts-num"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d posts','mod'=>'amazzingblog','sprintf'=>array($_smarty_tpl->tpl_vars['cat']->value['posts_num'])),$_smarty_tpl ) );?>
</span>
			</div>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['ab_posts']->value) {?>
		<div class="dynamic-posts">
			<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['blog']->value->getTemplatePath('post-list.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('posts'=>$_smarty_tpl->tpl_vars['ab_posts']->value,'settings'=>$_smarty_tpl->tpl_vars['ab_post_list_settings']->value), 0, true);
?>
		</div>
	<?php }?>
	<form action="" class="additional-filters hidden">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ab_additional_filters']->value, 'value', false, 'name');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['name']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
			<?php if ($_smarty_tpl->tpl_vars['name']->value == 'active') {
continue 1;
}?>			<input type="hidden" name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( implode(',',$_smarty_tpl->tpl_vars['value']->value),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</form>
<?php } else { ?>
	<div class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Category not available','mod'=>'amazzingblog'),$_smarty_tpl ) );?>
</div>
<?php }?>
</div>
<?php }
}
