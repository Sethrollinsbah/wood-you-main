<?php
/* Smarty version 3.1.48, created on 2025-01-06 23:18:05
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/testimonialswithavatars/views/templates/front/twa.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677caafd43a876_90895816',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2e53d8e5124c5cf3f3363f851a4e83e2a4e694f0' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/testimonialswithavatars/views/templates/front/twa.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./post-list.tpl' => 1,
  ),
),false)) {
function content_677caafd43a876_90895816 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['is_17']->value) {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);?><span class="navigation_page"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['page_header']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span><?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
}?>

<div class="twa">
	<?php if (!empty($_smarty_tpl->tpl_vars['page_header']->value)) {?><h1 class="title_main_section"><span><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['page_header']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span></h1><?php }?>
	<div class="twa_posts clearfix <?php if ($_smarty_tpl->tpl_vars['twa_settings']->value['displayType'] == 2) {?>grid<?php } else { ?>list<?php }?>">
		<?php $_smarty_tpl->_subTemplateRender("file:./post-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('posts'=>$_smarty_tpl->tpl_vars['twa_posts']->value), 0, false);
?>
	</div>
	<?php if ($_smarty_tpl->tpl_vars['show_load_more']->value) {?>
	<div id="loadMore" class="middle-line">
		<a class="neat" href="#"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'More reviews...','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</a>
		<i class="loader" style="display:none;">...</i>
	</div>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['restrictions_warning']->value) {?>
	<div class="alert alert-warning restriction-warning">
		<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['restrictions_warning']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	<?php } else { ?>
	<button id="addNew" class="btn btn-primary">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add new','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>

	</button>
	<div id="thanks_message" class="alert alert-success text-center" style="display:none;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Thanks for the review! It will be published right after approval','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</div>
	<div class="addForm clearfix" style="display:none;">
		<form id="add_new_post" enctype="multipart/form-data">
			<div class="ajax_errors"></div>
			<div class="post_avatar text-center">
				<div class="imgholder">
					<div style="background-image:url(<?php ob_start();
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['avatar']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
$_prefixVariable1 = ob_get_clean();
echo htmlspecialchars($_smarty_tpl->tpl_vars['twa']->value->getAvatarPath($_prefixVariable1), ENT_QUOTES, 'UTF-8');?>
)" class="avatarImg"></div>
					<div class="hidden">
						<input id="postAvatar" type="file" name="avatar_file" class="hidden">
					</div>
				</div>
				<span class="centered_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Upload your avatar','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</span>
			</div>
			<div class="new_content_wrapper">
				<div class="customer_name field">
					<div class="field_error" style="display:none;"></div>
					<input type="text" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['customer_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" name="customer_name" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your Name','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
">
				</div>
				<div class="subject field">
					<div class="field_error" style="display:none;"></div>
					<input type="text" value="" name="subject" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Post subject','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
">
				</div>
				<div class="content field <?php if ($_smarty_tpl->tpl_vars['allow_html']->value == 1) {?>allow_html<?php }?>">
					<div class="field_error" style="display:none;"></div>
					<textarea id="post_content" class="" rows="7" name="content" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Post text','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
"></textarea>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['general_settings']->value['rating_num']) {?>
					<?php if (empty($_smarty_tpl->tpl_vars['general_settings']->value['rating_class'])) {
$_tmp_array = isset($_smarty_tpl->tpl_vars['general_settings']) ? $_smarty_tpl->tpl_vars['general_settings']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['rating_class'] = 'unicode-star';
$_smarty_tpl->_assignInScope('general_settings', $_tmp_array);
}?>
					<div class="field editable_rating">
						<div class="stars_holder">
							<input type="hidden" name="rating" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['general_settings']->value['rating_num']), ENT_QUOTES, 'UTF-8');?>
">
							<?php
$_smarty_tpl->tpl_vars['r'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['r']->step = 1;$_smarty_tpl->tpl_vars['r']->total = (int) ceil(($_smarty_tpl->tpl_vars['r']->step > 0 ? $_smarty_tpl->tpl_vars['general_settings']->value['rating_num']+1 - (1) : 1-($_smarty_tpl->tpl_vars['general_settings']->value['rating_num'])+1)/abs($_smarty_tpl->tpl_vars['r']->step));
if ($_smarty_tpl->tpl_vars['r']->total > 0) {
for ($_smarty_tpl->tpl_vars['r']->value = 1, $_smarty_tpl->tpl_vars['r']->iteration = 1;$_smarty_tpl->tpl_vars['r']->iteration <= $_smarty_tpl->tpl_vars['r']->total;$_smarty_tpl->tpl_vars['r']->value += $_smarty_tpl->tpl_vars['r']->step, $_smarty_tpl->tpl_vars['r']->iteration++) {
$_smarty_tpl->tpl_vars['r']->first = $_smarty_tpl->tpl_vars['r']->iteration === 1;$_smarty_tpl->tpl_vars['r']->last = $_smarty_tpl->tpl_vars['r']->iteration === $_smarty_tpl->tpl_vars['r']->total;?>
								<i class="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['general_settings']->value['rating_class'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 rating-star" data-rating="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['r']->value), ENT_QUOTES, 'UTF-8');?>
"></i>
							<?php }
}
?>
						</div>
						<br />
						<span class="centered_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Leave your rating','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</span>
					</div>
				<?php }?>
				<input type="hidden" name="ajaxAction" value="addPost">
				<button class="btn btn-primary" id="submitPost"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'OK','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</button>
			</div>
		</form>
	</div>
	<?php }?>
</div>
<?php }
}
