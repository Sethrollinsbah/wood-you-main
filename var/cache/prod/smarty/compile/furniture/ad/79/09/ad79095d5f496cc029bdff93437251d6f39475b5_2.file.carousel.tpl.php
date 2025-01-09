<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:53:01
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/easycarousels/views/templates/hook/carousel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c268d108e89_18868323',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad79095d5f496cc029bdff93437251d6f39475b5' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/easycarousels/views/templates/hook/carousel.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c268d108e89_18868323 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('c_settings', $_smarty_tpl->tpl_vars['carousel']->value['settings']['carousel']);?>
<div id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['carousel']->value['identifier'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="easycarousel theme-carousel <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['carousel']->value['settings']['tpl']['custom_class'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['in_tabs']->value) {?> ec-tab-pane<?php } else { ?> carousel_block<?php }
if (!empty($_smarty_tpl->tpl_vars['custom_class']->value)) {?> <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['custom_class']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['is_17']->value && empty($_smarty_tpl->tpl_vars['carousel']->value['name']) && $_smarty_tpl->tpl_vars['carousel']->value['settings']['carousel']['n']) {?> nav_without_name<?php }?> <?php if ($_smarty_tpl->tpl_vars['c_settings']->value['type'] == 2) {?> scroll-wrapper<?php }?>">
	<?php if (!$_smarty_tpl->tpl_vars['in_tabs']->value && !empty($_smarty_tpl->tpl_vars['carousel']->value['name'])) {?>
		<div class="col-12">
			<h3 class="title_main_section title_block carousel_title">
				<span><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['carousel']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
			</h3>
		</div>
	<?php }?>
	<?php if (!empty($_smarty_tpl->tpl_vars['carousel']->value['description'])) {?><div class="carousel-description"><?php echo $_smarty_tpl->tpl_vars['carousel']->value['description'];?>
</div><?php }?>
	<div class="block_content <?php if ($_smarty_tpl->tpl_vars['c_settings']->value['type'] == 2) {?> scroll-x-wrapper<?php }?>">
		<div class="c_container<?php if (empty($_smarty_tpl->tpl_vars['c_settings']->value['type'])) {?> simple-grid xl-<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['c_settings']->value['i']), ENT_QUOTES, 'UTF-8');?>
 l-<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['c_settings']->value['i_1200']), ENT_QUOTES, 'UTF-8');?>
 m-<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['c_settings']->value['i_992']), ENT_QUOTES, 'UTF-8');?>
 s-<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['c_settings']->value['i_768']), ENT_QUOTES, 'UTF-8');?>
 xs-<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['c_settings']->value['i_480']), ENT_QUOTES, 'UTF-8');?>
 clearfix<?php } elseif ($_smarty_tpl->tpl_vars['c_settings']->value['type'] == 1) {?> carousel<?php } elseif ($_smarty_tpl->tpl_vars['c_settings']->value['type'] == 2) {?> scroll-x<?php }?>" data-settings="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['c_settings']->value )),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
			<?php $_smarty_tpl->_assignInScope('total', count($_smarty_tpl->tpl_vars['carousel']->value['items']));?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, array_values($_smarty_tpl->tpl_vars['carousel']->value['items']), 'column_items', false, 'k');
$_smarty_tpl->tpl_vars['column_items']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['column_items']->value) {
$_smarty_tpl->tpl_vars['column_items']->do_else = false;
?>
								<?php if ($_smarty_tpl->tpl_vars['k']->value) {?></div><?php }?><div class="c_col">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['column_items']->value, 'i');
$_smarty_tpl->tpl_vars['i']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->do_else = false;
?>
						<?php $_smarty_tpl->_assignInScope('type', $_smarty_tpl->tpl_vars['carousel']->value['type']);?>
						<div class="c_item <?php if ($_smarty_tpl->tpl_vars['type']->value != 'suppliers' && $_smarty_tpl->tpl_vars['type']->value != 'manufacturers' && $_smarty_tpl->tpl_vars['type']->value != 'categories' && $_smarty_tpl->tpl_vars['type']->value != 'subcategories') {?>product-item<?php }?>">
							<?php if ($_smarty_tpl->tpl_vars['type']->value != 'suppliers' && $_smarty_tpl->tpl_vars['type']->value != 'manufacturers' && $_smarty_tpl->tpl_vars['type']->value != 'categories' && $_smarty_tpl->tpl_vars['type']->value != 'subcategories') {?>
								<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['product_item_tpl']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['i']->value,'settings'=>$_smarty_tpl->tpl_vars['carousel']->value['settings']['tpl']), 0, true);
?>
							<?php } else { ?>
								<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['item_tpl']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('item'=>$_smarty_tpl->tpl_vars['i']->value,'type'=>$_smarty_tpl->tpl_vars['type']->value,'settings'=>$_smarty_tpl->tpl_vars['carousel']->value['settings']['tpl']), 0, true);
?>
							<?php }?>
						</div>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<?php if ($_smarty_tpl->tpl_vars['k']->value+1 == $_smarty_tpl->tpl_vars['total']->value) {?></div><?php }?>			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div>
	</div>
	<?php if (!empty($_smarty_tpl->tpl_vars['carousel']->value['view_all_link'])) {?>
		<div class="text-center">
			<a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['carousel']->value['view_all_link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="view_all"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View all','d'=>'Shop.Modules.Easycarousels'),$_smarty_tpl ) );?>
</a>
		</div>
	<?php }?>
</div>
<?php }
}
