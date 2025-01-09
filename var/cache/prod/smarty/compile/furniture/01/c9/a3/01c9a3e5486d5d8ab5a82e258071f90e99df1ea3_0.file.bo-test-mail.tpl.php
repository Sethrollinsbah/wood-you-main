<?php
/* Smarty version 3.1.48, created on 2025-01-09 16:25:35
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/hook/bo-test-mail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_67803ecf1be7f8_23175139',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '01c9a3e5486d5d8ab5a82e258071f90e99df1ea3' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/hook/bo-test-mail.tpl',
      1 => 1736189402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67803ecf1be7f8_23175139 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="ets_abancart_wrapper_overload">
	<div class="table">
		<div class="table-cell">
			<div class="wrapper_form">
				<form id="ets_abancart_send_test_mail" class="defaultForm form-horizontal" action="<?php if ((isset($_smarty_tpl->tpl_vars['action']->value)) && $_smarty_tpl->tpl_vars['action']->value) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action']->value,'quotes','UTF-8' ));
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( ($_SERVER['HTTP_HOST']).($_SERVER['REQUEST_URI']),'quotes','UTF-8' ));
}?>" novalidate method="post" enctype="multipart/form-data">
					<div id="fieldset_1" class="panel">
						<div class="panel-heading">
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send test email','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

                            <span class="sendmail_cancel">+</span>
                        </div>
						<div class="form-wrapper">
							<div class="form-group form-group-email required isEmail">
								<label class="control-label col-lg-3 required">
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

								</label>
								<div class="col-lg-9">
									<input id="email" type="text" name="email" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email address','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
">
									<p class="help-block">
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter an email address to receive test email','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

									</p>
								</div>
							</div>
						</div>
						<div class="panel-footer">
                            <button type="button" class="btn btn-default sendmail_cancel">
								<i class="process-icon-cancel"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

							</button>
							<button type="submit" value="1" id="configuration_form_send_test_mail_btn" name="submitSendTestMail" class="btn btn-default pull-right">
								<i class="process-icon-envelope"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><?php }
}
