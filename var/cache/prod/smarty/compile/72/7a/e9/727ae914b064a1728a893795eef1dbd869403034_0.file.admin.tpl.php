<?php
/* Smarty version 3.1.48, created on 2025-01-06 14:33:12
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/admin/admin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c2ff871ffa3_77606215',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '727ae914b064a1728a893795eef1dbd869403034' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/admin/admin.tpl',
      1 => 1736189402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c2ff871ffa3_77606215 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
echo $_smarty_tpl->tpl_vars['header']->value;?>

<div class="ets_abancart_wrapper">
	<?php echo $_smarty_tpl->tpl_vars['menus']->value;?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1902879031677c2ff8717ef0_94876772', "main_form");
?>

</div><?php }
/* {block "after"} */
class Block_1825267069677c2ff871ed60_08015253 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<div class="ets_abancart_overload">
					<div class="ets_abancart_table">
						<div class="ets_abancart_table_cell">
							<div class="ets_abancart_popup_content">
								<span class="ets_abancart_close_form" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Close','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
"></span>
								<div class="ets_abancart_form"></div>
							</div>
						</div>
					</div>
				</div>
			<?php
}
}
/* {/block "after"} */
/* {block "main_form"} */
class Block_1902879031677c2ff8717ef0_94876772 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main_form' => 
  array (
    0 => 'Block_1902879031677c2ff8717ef0_94876772',
  ),
  'after' => 
  array (
    0 => 'Block_1825267069677c2ff871ed60_08015253',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<div class="ets_abancart_forms">
			<?php if ($_smarty_tpl->tpl_vars['controller_name']->value == ($_smarty_tpl->tpl_vars['slugTab']->value).('EmailTemplate')) {?>
				<?php $_smarty_tpl->_assignInScope('is_email_template', ($_smarty_tpl->tpl_vars['display']->value == 'add' || $_smarty_tpl->tpl_vars['display']->value == 'edit'));?>
			<?php } elseif ($_smarty_tpl->tpl_vars['controller_name']->value == ($_smarty_tpl->tpl_vars['slugTab']->value).('ReminderLeave')) {?>
				<?php $_smarty_tpl->_assignInScope('is_email_template', 1);?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('is_email_template', 0);?>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['is_email_template']->value) {?><div class="ets_abancart_forms_info"><div class="ets_abancart_form_fields"><?php }?>
				<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

			<?php if ($_smarty_tpl->tpl_vars['is_email_template']->value) {?></div>
				<div class="ets_abancart_form_preview">
					<h3 class="title"><i class="icon-eye"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Preview template','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</h3>
					<?php if ($_smarty_tpl->tpl_vars['controller_name']->value !== ($_smarty_tpl->tpl_vars['slugTab']->value).('ReminderLeave')) {?>
                        <div class="ets_abancart_responsive_mode">
                            <ul>
                                <li><a data-respon="desktop_mode" href="#" class="desktop_mode active">
                                        <i class="ets_svg_fill_gray ets_svg_hover_fill_white lh_16">
                                            <svg width="16" height="14" viewBox="0 0 2048 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1856 992v-832q0-13-9.5-22.5t-22.5-9.5h-1600q-13 0-22.5 9.5t-9.5 22.5v832q0 13 9.5 22.5t22.5 9.5h1600q13 0 22.5-9.5t9.5-22.5zm128-832v1088q0 66-47 113t-113 47h-544q0 37 16 77.5t32 71 16 43.5q0 26-19 45t-45 19h-512q-26 0-45-19t-19-45q0-14 16-44t32-70 16-78h-544q-66 0-113-47t-47-113v-1088q0-66 47-113t113-47h1600q66 0 113 47t47 113z"/></svg>
                                        </i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Desktop','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a></li>
                                <li><a data-respon="tablet_mode" href="#">
                                        <i class="tablet_mode ets_svg_fill_gray ets_svg_hover_fill_white lh_16">
                                            <svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M960 1408q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm384-160v-960q0-13-9.5-22.5t-22.5-9.5h-832q-13 0-22.5 9.5t-9.5 22.5v960q0 13 9.5 22.5t22.5 9.5h832q13 0 22.5-9.5t9.5-22.5zm128-960v1088q0 66-47 113t-113 47h-832q-66 0-113-47t-47-113v-1088q0-66 47-113t113-47h832q66 0 113 47t47 113z"/></svg>
                                        </i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tablet','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a></li>
                                <li><a data-respon="mobile_mode" href="#">
                                        <i class="mobile_mode ets_svg_fill_gray ets_svg_hover_fill_white lh_16">
                                            <svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M976 1408q0-33-23.5-56.5t-56.5-23.5-56.5 23.5-23.5 56.5 23.5 56.5 56.5 23.5 56.5-23.5 23.5-56.5zm208-160v-704q0-13-9.5-22.5t-22.5-9.5h-512q-13 0-22.5 9.5t-9.5 22.5v704q0 13 9.5 22.5t22.5 9.5h512q13 0 22.5-9.5t9.5-22.5zm-192-848q0-16-16-16h-160q-16 0-16 16t16 16h160q16 0 16-16zm288-16v1024q0 52-38 90t-90 38h-512q-52 0-90-38t-38-90v-1024q0-52 38-90t90-38h512q52 0 90 38t38 90z"/></svg>
                                        </i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mobile','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a></li>
                            </ul>
                        </div>
                    <?php }?>
					<div class="ets_abancart_preview_info">
						<div class="ets_abancart_preview"></div>
					</div>
					<div class="col-xs-12 col-sm-12">
						<div class="alert alert-info">
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customers will receive a reminder email with the same content like this email template. Please keep in mind that all the values such as logo, product list, discount information, etc. are just demo data for reference.','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

						</div>
					</div>
					<?php if ($_GET['controller'] !== 'AdminEtsACReminderLeave') {?>
					<div class="col-xs-12 col-sm-12 ets-ac-box-preview-footer">
						<button type="button" class="btn btn-default pull-right ets_ac_btn_send_test_email " name="sendTestMail">

                                <svg class="w_14 h_14" width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1664 1504v-768q-32 36-69 66-268 206-426 338-51 43-83 67t-86.5 48.5-102.5 24.5h-2q-48 0-102.5-24.5t-86.5-48.5-83-67q-158-132-426-338-37-30-69-66v768q0 13 9.5 22.5t22.5 9.5h1472q13 0 22.5-9.5t9.5-22.5zm0-1051v-24.5l-.5-13-3-12.5-5.5-9-9-7.5-14-2.5h-1472q-13 0-22.5 9.5t-9.5 22.5q0 168 147 284 193 152 401 317 6 5 35 29.5t46 37.5 44.5 31.5 50.5 27.5 43 9h2q20 0 43-9t50.5-27.5 44.5-31.5 46-37.5 35-29.5q208-165 401-317 54-43 100.5-115.5t46.5-131.5zm128-37v1088q0 66-47 113t-113 47h-1472q-66 0-113-47t-47-113v-1088q0-66 47-113t113-47h1472q66 0 113 47t47 113z"/></svg>
                             <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send test email','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

                        </button>
					</div>
					<?php }?>
				</div>
			</div>
			<?php }?>
		</div>
        <?php if (trim($_smarty_tpl->tpl_vars['controller_name']->value) === ($_smarty_tpl->tpl_vars['slugTab']->value).('Configs') || trim($_smarty_tpl->tpl_vars['controller_name']->value) === ($_smarty_tpl->tpl_vars['slugTab']->value).('Dashboard')) {?>
	        <?php echo (Module::getInstanceByName('ets_abandonedcart')->hookDisplayCronjobInfo());?>

        <?php }?>
		<?php if (preg_match('#Reminder(Email|Popup|Bar|Browser|Customer)|Cart|Tracking|ConvertedCarts|Campaign$#',$_smarty_tpl->tpl_vars['controller_name']->value)) {?>
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1825267069677c2ff871ed60_08015253', "after", $this->tplIndex);
?>

		<?php }?>
	<?php
}
}
/* {/block "main_form"} */
}
