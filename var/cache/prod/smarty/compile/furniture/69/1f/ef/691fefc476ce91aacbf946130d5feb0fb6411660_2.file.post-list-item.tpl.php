<?php
/* Smarty version 3.1.48, created on 2025-01-07 14:24:08
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/amazzingblog/views/templates/front/post-list-item.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d7f581fa716_50905281',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '691fefc476ce91aacbf946130d5feb0fb6411660' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/amazzingblog/views/templates/front/post-list-item.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d7f581fa716_50905281 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="post-item-wrapper<?php if ($_smarty_tpl->tpl_vars['col']->value) {?> col-sm-<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['col']->value), ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['k']->value%$_smarty_tpl->tpl_vars['settings']->value['col_num'] == 0) {?> first-in-line<?php }
}?>">
	<div class="post-item<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['show_date'])) {?> has-date<?php }?>">
		<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['show_date'])) {?>
			<?php if ($_smarty_tpl->tpl_vars['post']->value['publish_from'] == $_smarty_tpl->tpl_vars['blog']->value->empty_date) {
$_tmp_array = isset($_smarty_tpl->tpl_vars['post']) ? $_smarty_tpl->tpl_vars['post']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['publish_from'] = $_smarty_tpl->tpl_vars['post']->value['date_add'];
$_smarty_tpl->_assignInScope('post', $_tmp_array);
}?>
			<?php $_smarty_tpl->_assignInScope('split_date', $_smarty_tpl->tpl_vars['blog']->value->prepareDate($_smarty_tpl->tpl_vars['post']->value['publish_from']));?>
			<div class="post-item-date">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['split_date']->value, 'fragment', false, 'i');
$_smarty_tpl->tpl_vars['fragment']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['fragment']->value) {
$_smarty_tpl->tpl_vars['fragment']->do_else = false;
?>
					<div class="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fragment']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</div>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</div>
		<?php }?>
		<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['title_truncate'])) {?>
			<h3 class="post-item-title<?php if ($_smarty_tpl->tpl_vars['settings']->value['display_type'] == 'grid' || $_smarty_tpl->tpl_vars['settings']->value['display_type'] == 'carousel') {?> overflow-ellipsis<?php }?>">
				<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['link_title'])) {?><a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php }?>
					<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['title'],$_smarty_tpl->tpl_vars['settings']->value['title_truncate'],'...' )),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

				<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['link_title'])) {?></a><?php }?>
			</h3>
		<?php }?>
		<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['show_author']) || !empty($_smarty_tpl->tpl_vars['settings']->value['show_views']) || !empty($_smarty_tpl->tpl_vars['settings']->value['show_comments']) || !empty($_smarty_tpl->tpl_vars['settings']->value['show_readmore']) || !empty($_smarty_tpl->tpl_vars['settings']->value['show_tags'])) {?>
			<div class="post-item-footer clearfix">
				<div class="post-item-infos pull-left">
					<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['show_author'])) {?>
						<span class="post-item-info author">
							<i class="icon-user"></i>
							<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['firstname'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['lastname'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

						</span>
					<?php }?>
					<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['show_views'])) {?>
						<span class="post-item-info views-num">
							<i class="icon-eye"></i>
							<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['post']->value['views']), ENT_QUOTES, 'UTF-8');?>

						</span>
					<?php }?>
					<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['show_comments'])) {?>
						<a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
#post-comments" class="post-item-info comments-num">
							<i class="icon-comment"></i>
							<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['post']->value['comments']), ENT_QUOTES, 'UTF-8');?>

						</a>
					<?php }?>
					<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['show_tags']) && !empty($_smarty_tpl->tpl_vars['post']->value['tags'])) {?>
						<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['tags_tpl_path']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('tags'=>$_smarty_tpl->tpl_vars['post']->value['tags']), 0, true);
?>
					<?php }?>
				</div>
			</div>
		<?php }?>
		<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['cover_type'])) {?>
			<?php $_smarty_tpl->_assignInScope('cover_src', $_smarty_tpl->tpl_vars['blog']->value->getImgSrc('post',$_smarty_tpl->tpl_vars['post']->value['id_post'],$_smarty_tpl->tpl_vars['settings']->value['cover_type'],$_smarty_tpl->tpl_vars['post']->value['cover']));?>
			<?php if (!empty($_smarty_tpl->tpl_vars['cover_src']->value)) {?>
				<div class="post-item-cover">
					<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['link_cover'])) {?><a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php }?>
						<img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cover_src']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
					<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['link_cover'])) {?></a><?php }?>
				</div>
			<?php }?>

		<?php }?>
		<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['truncate'])) {?>
			<div class="post-item-content">
				<div class="post-item-content"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['post']->value['content']),$_smarty_tpl->tpl_vars['settings']->value['truncate'],'...' )),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

				</div>
				<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['truncate']) && !empty($_smarty_tpl->tpl_vars['settings']->value['show_readmore'])) {?>
					<a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Read more','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
" class="item-readmore butt btn_border mini">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Read more','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>

					</a>
				<?php }?>
			</div>
		<?php }?>
	</div>
</div>
<?php }
}
