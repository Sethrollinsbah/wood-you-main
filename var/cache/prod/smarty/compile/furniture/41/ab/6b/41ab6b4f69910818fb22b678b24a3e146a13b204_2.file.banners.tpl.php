<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:52:01
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/custombanners/views/templates/hook/banners.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c2651837227_91659792',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '41ab6b4f69910818fb22b678b24a3e146a13b204' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/custombanners/views/templates/hook/banners.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c2651837227_91659792 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['banners']->value) {?>
<div class="custombanners <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 clearfix" data-hook="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
	<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayHome') {?>
		<h2 class="title_main_section">
			<span>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'At your service','d'=>'Shop.Custom'),$_smarty_tpl ) );?>

			</span>
		</h2>
	<?php }?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['banners']->value, 'w', false, 'id_wrapper');
$_smarty_tpl->tpl_vars['w']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id_wrapper']->value => $_smarty_tpl->tpl_vars['w']->value) {
$_smarty_tpl->tpl_vars['w']->do_else = false;
?>
		<?php if (empty($_smarty_tpl->tpl_vars['w']->value['banners']) || empty($_smarty_tpl->tpl_vars['w']->value['settings'])) {
continue 1;
}?>
		<?php $_smarty_tpl->_assignInScope('settings', $_smarty_tpl->tpl_vars['w']->value['settings']['general']);?>
		<?php $_smarty_tpl->_assignInScope('encoded_carousel_settings', $_smarty_tpl->tpl_vars['w']->value['settings']['carousel']);?>
		<div class="cb-wrapper<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['custom_class'])) {?> <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['settings']->value['custom_class'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" data-wrapper="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['id_wrapper']->value), ENT_QUOTES, 'UTF-8');?>
">
		<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayHome') {?>
		<ul class="tabs_list col-sm-3 col-xs-12">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['w']->value['banners'], 'banner', false, NULL, 'items', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['banner']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['banner']->value) {
$_smarty_tpl->tpl_vars['banner']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration']++;
?>
				<li class="row nav-item addition_<?php echo htmlspecialchars((isset($_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration'] : null), ENT_QUOTES, 'UTF-8');?>
">
					<a class="nav-link <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration'] : null) == 1) {?>active<?php }?>" href="#addition_item<?php echo htmlspecialchars((isset($_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration'] : null), ENT_QUOTES, 'UTF-8');?>
" data-toggle="tab">
						<?php if ($_smarty_tpl->tpl_vars['banner']->value['title']) {?>
							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['banner']->value['title'], ENT_QUOTES, 'UTF-8');?>

						<?php } else { ?>

						<?php }?>
					</a>
				</li>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ul>
		<div class="tab-content tabs_additional clearfix col-sm-9 col-xs-12">
		<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['settings']->value['display_type'] == 2) {?>
			<div class="carousel" data-settings="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['encoded_carousel_settings']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
			<?php }?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['w']->value['banners'], 'banner', false, NULL, 'items', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['banner']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['banner']->value) {
$_smarty_tpl->tpl_vars['banner']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration']++;
?>
					<div <?php if (!empty($_smarty_tpl->tpl_vars['banner']->value['img']) && call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayTopColumn') {?>style="background-image: url(<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['banner']->value['img'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
)"<?php }?> <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayHome') {?> role="tabpanel" id="addition_item<?php echo htmlspecialchars((isset($_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration'] : null), ENT_QUOTES, 'UTF-8');?>
"<?php }?> class="banner-item<?php if (!empty($_smarty_tpl->tpl_vars['banner']->value['class'])) {?> <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['banner']->value['class'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?> banner_<?php echo htmlspecialchars((isset($_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration'] : null), ENT_QUOTES, 'UTF-8');?>
 <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayHome') {
if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration'] : null) == 1) {?>active<?php }?> tab-pane <?php }?>">
						<div class="banner-item-content">
							<?php if (!empty($_smarty_tpl->tpl_vars['banner']->value['img'])) {?>
								<?php if (!empty($_smarty_tpl->tpl_vars['banner']->value['link']['href'])) {?>
								<a class="<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayCustomBanners3' || call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayCustomBanners1' || call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayCustomBanners2') {?>awesome-effect<?php }?>" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['banner']->value['link']['href'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['banner']->value['link']['href'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php if ((isset($_smarty_tpl->tpl_vars['banner']->value['link']['_blank']))) {?> target="_blank"<?php }?>>
								<?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayCustomBanners3' || call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayCustomBanners1' || call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayCustomBanners2') {?>
									<div class="awesome-effect">
								<?php }?>
								<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) != 'displayTopColumn') {?>
									<img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['banner']->value['img'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php if ((isset($_smarty_tpl->tpl_vars['banner']->value['title']))) {?> alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['banner']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php }?> class="banner-img<?php if (!empty($_smarty_tpl->tpl_vars['banner']->value['img_hover'])) {?> primary-image<?php }?>">
									<?php if (!empty($_smarty_tpl->tpl_vars['banner']->value['img_hover'])) {?>
										<img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['banner']->value['img_hover'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php if ((isset($_smarty_tpl->tpl_vars['banner']->value['title']))) {?> alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['banner']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php }?> class="banner-img secondary-image">
									<?php }?>
								<?php }?>
							<?php }?>
							<?php if (!empty($_smarty_tpl->tpl_vars['banner']->value['html'])) {?>
								<div class="custom-html">
									<?php echo $_smarty_tpl->tpl_vars['banner']->value['html'];?>
								</div>
							<?php }?>
							<?php if (!empty($_smarty_tpl->tpl_vars['banner']->value['img'])) {?>
							<?php if (!empty($_smarty_tpl->tpl_vars['banner']->value['link']['href'])) {?>
								</a>
							<?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayCustomBanners3' || call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayCustomBanners1' || call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayCustomBanners2') {?>
								</div>
							<?php }?>
							<?php }?>
						</div>
					</div>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php if ($_smarty_tpl->tpl_vars['settings']->value['display_type'] == 2) {?>
			</div>
			<?php }?>
			<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hook_name']->value,'html','UTF-8' )) == 'displayHome') {?>
			</div>
			<?php }?>
		</div>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>
<?php }
}
}
