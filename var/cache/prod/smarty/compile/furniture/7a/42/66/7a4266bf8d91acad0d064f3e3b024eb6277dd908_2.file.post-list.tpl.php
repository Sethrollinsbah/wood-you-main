<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:54:44
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/testimonialswithavatars/views/templates/front/post-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26f4eb4b03_40176068',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7a4266bf8d91acad0d064f3e3b024eb6277dd908' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/testimonialswithavatars/views/templates/front/post-list.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c26f4eb4b03_40176068 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/u695283169/domains/woodyoubahamas.com/public_html/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<?php if (empty($_smarty_tpl->tpl_vars['general_settings']->value['rating_class'])) {
$_tmp_array = isset($_smarty_tpl->tpl_vars['general_settings']) ? $_smarty_tpl->tpl_vars['general_settings']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['rating_class'] = 'unicode-star';
$_smarty_tpl->_assignInScope('general_settings', $_tmp_array);
}
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
$_smarty_tpl->tpl_vars['post']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->do_else = false;
?>
<div class="post post-comment" data-idpost="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['post']->value['id_post']), ENT_QUOTES, 'UTF-8');?>
">
	<div class="post-inner">
		<div class="post_avatar">
			<div class="wrapper-ava font-quote-left-two">
				<div class="ava-img" style="background-image: url(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['twa']->value->getAvatarPath(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['avatar'],'html','UTF-8' ))), ENT_QUOTES, 'UTF-8');?>
);"></div>
			</div>
			<?php if ($_smarty_tpl->tpl_vars['general_settings']->value['rating_num']) {?>
				<span class="post_rating">
					<?php
$_smarty_tpl->tpl_vars['r'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['r']->step = 1;$_smarty_tpl->tpl_vars['r']->total = (int) ceil(($_smarty_tpl->tpl_vars['r']->step > 0 ? $_smarty_tpl->tpl_vars['general_settings']->value['rating_num']+1 - (1) : 1-($_smarty_tpl->tpl_vars['general_settings']->value['rating_num'])+1)/abs($_smarty_tpl->tpl_vars['r']->step));
if ($_smarty_tpl->tpl_vars['r']->total > 0) {
for ($_smarty_tpl->tpl_vars['r']->value = 1, $_smarty_tpl->tpl_vars['r']->iteration = 1;$_smarty_tpl->tpl_vars['r']->iteration <= $_smarty_tpl->tpl_vars['r']->total;$_smarty_tpl->tpl_vars['r']->value += $_smarty_tpl->tpl_vars['r']->step, $_smarty_tpl->tpl_vars['r']->iteration++) {
$_smarty_tpl->tpl_vars['r']->first = $_smarty_tpl->tpl_vars['r']->iteration === 1;$_smarty_tpl->tpl_vars['r']->last = $_smarty_tpl->tpl_vars['r']->iteration === $_smarty_tpl->tpl_vars['r']->total;?>
						<i class="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['general_settings']->value['rating_class'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 font-star rating-star<?php if ($_smarty_tpl->tpl_vars['post']->value['rating'] >= $_smarty_tpl->tpl_vars['r']->value) {?> on<?php }?>"></i>
					<?php }
}
?>
				</span>
			<?php }?>
		</div>
		<div class="content_wrapper">
			<div class="post_content">
				<h5>
					<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['subject'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

				</h5>
				<?php echo $_smarty_tpl->tpl_vars['twa']->value->bbCodeToHTML(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['content'],'html','UTF-8' )));?>

			</div>
						<div class="post_footer">
				<span class="customer_name b"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['customer_name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span> - 
				<span class="date_add i"> <?php echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value['date_add']), ENT_QUOTES, 'UTF-8');?>
</span>
			</div>
		</div>
	</div>
</div>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
