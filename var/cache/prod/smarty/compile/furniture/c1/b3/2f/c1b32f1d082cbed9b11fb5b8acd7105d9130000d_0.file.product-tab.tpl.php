<?php
/* Smarty version 3.1.48, created on 2025-01-07 10:42:17
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/amazzingblog/views/templates/admin/product-tab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d4b59493747_89664629',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1b32f1d082cbed9b11fb5b8acd7105d9130000d' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/amazzingblog/views/templates/admin/product-tab.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./related-items.tpl' => 1,
  ),
),false)) {
function content_677d4b59493747_89664629 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['is_17']->value) {?>
	<h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Related blog posts','mod'=>'amazzingblog'),$_smarty_tpl ) );?>
</h3>
	<?php if ($_smarty_tpl->tpl_vars['id_product']->value) {?>
		<div class="form-group">
			<label class="control-label">
				<span class="label-tooltip" data-toggle="tooltip" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'For example 1,2,3','mod'=>'amazzingblog'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Post IDs','mod'=>'amazzingblog'),$_smarty_tpl ) );?>
</span>
			</label>
			<input type="text" name="related_post_ids" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['imploded_post_ids']->value,'html','UTF-8' ));?>
">
		</div>
	<?php } else { ?>
		<div class="alert alert-warning">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please save product before adding related posts','mod'=>'amazzingblog'),$_smarty_tpl ) );?>

		</div>
	<?php }
} else { ?>
	<div id="product-relatedposts" class="panel product-tab">
	<?php if ($_smarty_tpl->tpl_vars['id_product']->value) {?>
		<input type="hidden" name="submitted_tabs[]" value="amazzingblogmodule" />
		<h3><i class="icon-AdminBlog"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Related blog posts','mod'=>'amazzingblog'),$_smarty_tpl ) );?>
</h3>
		<div class="alert alert-info">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Related posts will be displayed at the bottom of product page.','mod'=>'amazzingblog'),$_smarty_tpl ) );?>

				<a href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['ab_config_path']->value,'html','UTF-8' ));?>
&tab=blocks&hook=displayFooterProduct" target="_blank">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit block "Related posts"','mod'=>'amazzingblog'),$_smarty_tpl ) );?>
 <i class="icon-external-link-sign"></i>
				</a>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Start typing...','mod'=>'amazzingblog'),$_smarty_tpl ) );?>
</label>
			<div class="col-lg-5">
				<?php $_smarty_tpl->_subTemplateRender('file:./related-items.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'post','input_name'=>'related_post_ids','imploded_ids'=>$_smarty_tpl->tpl_vars['imploded_post_ids']->value,'related_items'=>$_smarty_tpl->tpl_vars['related_post_items']->value), 0, false);
?>
			</div>
		</div>
		<div class="panel-footer">
			<a href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminProducts'),'html','UTF-8' ));?>
" class="btn btn-default"><i class="process-icon-cancel"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel','mod'=>'amazzingblog'),$_smarty_tpl ) );?>
</a>
			<button type="submit" name="submitAddproduct" class="btn btn-default pull-right"><i class="process-icon-save"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save','mod'=>'amazzingblog'),$_smarty_tpl ) );?>
</button>
			<button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right"><i class="process-icon-save"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save and stay','mod'=>'amazzingblog'),$_smarty_tpl ) );?>
</button>
		</div>
	<?php } else { ?>
		<div class="alert alert-warning">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please save product before adding related posts','mod'=>'amazzingblog'),$_smarty_tpl ) );?>

		</div>
	<?php }?>
	</div>
<?php }
}
}
