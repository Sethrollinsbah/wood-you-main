<?php
/* Smarty version 3.1.48, created on 2025-01-07 14:24:08
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/amazzingblog/views/templates/front/pagination.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d7f581df7b1_18023649',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4660e4d4f7897bc326323b0e853ea3c04f0fe5e2' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/amazzingblog/views/templates/front/pagination.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d7f581df7b1_18023649 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'getPageLink' => 
  array (
    'compiled_filepath' => '/home/u695283169/domains/woodyoubahamas.com/public_html/var/cache/prod/smarty/compile/furniture/46/60/e4/4660e4d4f7897bc326323b0e853ea3c04f0fe5e2_2.file.pagination.tpl.php',
    'uid' => '4660e4d4f7897bc326323b0e853ea3c04f0fe5e2',
    'call_name' => 'smarty_template_function_getPageLink_277836854677d7f581cbf38_61528996',
  ),
));
$_smarty_tpl->_assignInScope('p_max', $_smarty_tpl->tpl_vars['settings']->value['npp'] == 'all' ? 0 : ceil($_smarty_tpl->tpl_vars['settings']->value['total']/$_smarty_tpl->tpl_vars['settings']->value['npp']));
$_smarty_tpl->_assignInScope('prev', $_smarty_tpl->tpl_vars['settings']->value['p']-1);
$_smarty_tpl->_assignInScope('next', $_smarty_tpl->tpl_vars['settings']->value['p']+1);?>



<div class="pagination">
	<div class="npp-holder pull-left<?php if (count($_smarty_tpl->tpl_vars['settings']->value['npp_options']) < 2) {?> hidden<?php }?>">
		<div class="inline-block">
			<select class="npp form-control">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['settings']->value['npp_options'], 'opt');
$_smarty_tpl->tpl_vars['opt']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['opt']->value) {
$_smarty_tpl->tpl_vars['opt']->do_else = false;
?>
					<option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['opt']->value), ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->tpl_vars['settings']->value['npp'] == $_smarty_tpl->tpl_vars['opt']->value) {?> selected<?php }?>><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['opt']->value), ENT_QUOTES, 'UTF-8');?>
</option>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<option value="all"<?php if ($_smarty_tpl->tpl_vars['settings']->value['npp'] == 'all') {?> selected<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All','mod'=>'amazzingblog'),$_smarty_tpl ) );?>
</option>
			</select>
		</div>
		<span class="total inline-block">
            <input type="hidden" name="posts_total" class="posts_total" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['settings']->value['total']), ENT_QUOTES, 'UTF-8');?>
">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'of %d','mod'=>'amazzingblog','sprintf'=>array($_smarty_tpl->tpl_vars['settings']->value['total'])),$_smarty_tpl ) );?>

        </span>
	</div>
	<?php if ($_smarty_tpl->tpl_vars['p_max']->value > 1) {?>
	<div class="pages pull-left<?php if (!empty($_smarty_tpl->tpl_vars['p_type']->value) && $_smarty_tpl->tpl_vars['p_type']->value == 'ajax') {?> ajax<?php }?>">
		<label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Pages:','d'=>'Shop.Modules.Amazzingblog'),$_smarty_tpl ) );?>
</label>
				<?php if ($_smarty_tpl->tpl_vars['prev']->value) {?>
			<a href="<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'getPageLink', array('page'=>1), true);?>
" class="go-to-page first" data-page="1">1</a>
			<?php if ($_smarty_tpl->tpl_vars['prev']->value > 1) {?>
				<?php if ($_smarty_tpl->tpl_vars['prev']->value > 2) {?>...<?php }?>
				<a href="<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'getPageLink', array('page'=>$_smarty_tpl->tpl_vars['prev']->value), true);?>
" class="go-to-page" data-page="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['prev']->value), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['prev']->value), ENT_QUOTES, 'UTF-8');?>
</a>
			<?php }?>
		<?php }?>
		<span class="current-page" data-page="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['settings']->value['p']), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['settings']->value['p']), ENT_QUOTES, 'UTF-8');?>
</span>
		<?php if ($_smarty_tpl->tpl_vars['next']->value <= $_smarty_tpl->tpl_vars['p_max']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['next']->value < $_smarty_tpl->tpl_vars['p_max']->value) {?>
				<a href="<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'getPageLink', array('page'=>$_smarty_tpl->tpl_vars['next']->value), true);?>
" class="go-to-page" data-page="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['next']->value), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['next']->value), ENT_QUOTES, 'UTF-8');?>
</a>
				<?php if ($_smarty_tpl->tpl_vars['next']->value < $_smarty_tpl->tpl_vars['p_max']->value-1) {?>...<?php }?>
			<?php }?>
			<a href="<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'getPageLink', array('page'=>$_smarty_tpl->tpl_vars['p_max']->value), true);?>
" class="go-to-page last" data-page="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['p_max']->value), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['p_max']->value), ENT_QUOTES, 'UTF-8');?>
</a>
		<?php } else { ?>
			<?php $_smarty_tpl->_assignInScope('next', $_smarty_tpl->tpl_vars['p_max']->value);?>
		<?php }?>
			</div>
	<?php }?>
</div>
<?php }
/* smarty_template_function_getPageLink_277836854677d7f581cbf38_61528996 */
if (!function_exists('smarty_template_function_getPageLink_277836854677d7f581cbf38_61528996')) {
function smarty_template_function_getPageLink_277836854677d7f581cbf38_61528996(Smarty_Internal_Template $_smarty_tpl,$params) {
$params = array_merge(array('page'=>1), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
if ((isset($_smarty_tpl->tpl_vars['ab_first_page_url']->value))) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['blog']->value->addPageNumber($_smarty_tpl->tpl_vars['ab_first_page_url']->value,$_smarty_tpl->tpl_vars['page']->value),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>#<?php }
}}
/*/ smarty_template_function_getPageLink_277836854677d7f581cbf38_61528996 */
}
