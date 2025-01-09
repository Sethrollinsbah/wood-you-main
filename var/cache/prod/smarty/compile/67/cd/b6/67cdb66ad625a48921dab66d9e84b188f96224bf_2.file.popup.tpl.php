<?php
/* Smarty version 3.1.48, created on 2025-01-07 21:22:34
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/front/popup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677de16a6abad9_36440416',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '67cdb66ad625a48921dab66d9e84b188f96224bf' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/front/popup.tpl',
      1 => 1736189402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677de16a6abad9_36440416 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="ets_abancart_shopping_cart">
	<span class="ets_abancart_close" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Close','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
"></span>
	<div class="ets_abancart_form_save_cart">
		<div class="front front_login panel">
			<h4>
				<i class="svg_fill_gray lh_18">
				<svg class="w_16 h_16" width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1596 380q28 28 48 76t20 88v1152q0 40-28 68t-68 28h-1344q-40 0-68-28t-28-68v-1600q0-40 28-68t68-28h896q40 0 88 20t76 48zm-444-244v376h376q-10-29-22-41l-313-313q-12-12-41-22zm384 1528v-1024h-416q-40 0-68-28t-28-68v-416h-768v1536h1280z"/></svg>
				</i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save your shopping cart?','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</h4>
			<p class="alert alert-info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You have %d items in your shopping cart, do you want to save your shopping to checkout later?','sprintf'=>array($_smarty_tpl->tpl_vars['product_count']->value),'mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</p>
			<form action="<?php echo $_smarty_tpl->tpl_vars['link_action']->value;?>
" id="save_cart_form" method="post">
				<input type="hidden" name="id_customer" id="id_customer" value="<?php if ((isset($_smarty_tpl->tpl_vars['id_customer']->value))) {
echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['id_customer']->value), ENT_QUOTES, 'UTF-8');
}?>"/>
				<input type="hidden" name="submitCart" id="submitCart" value="1"/>
				<div class="form-group">
					<label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cart name','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
<span class="required">*</span></label>
					<input name="cart_name" type="text" id="cart_name" class="form-control" value="" autofocus="autofocus" tabindex="1" required />
				</div>
				<div class="form-group row-padding-top">
					<button id="submit_cart" class="submit_cart btn btn-primary" tabindex="2" name="submitCart">
                       <i class="svg_fill_white svg_fill_hover_white lh_18">
                        <svg class="w_16 h_16" width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M512 1536h768v-384h-768v384zm896 0h128v-896q0-14-10-38.5t-20-34.5l-281-281q-10-10-34-20t-39-10v416q0 40-28 68t-68 28h-576q-40 0-68-28t-28-68v-416h-128v1280h128v-416q0-40 28-68t68-28h832q40 0 68 28t28 68v416zm-384-928v-320q0-13-9.5-22.5t-22.5-9.5h-192q-13 0-22.5 9.5t-9.5 22.5v320q0 13 9.5 22.5t22.5 9.5h192q13 0 22.5-9.5t9.5-22.5zm640 32v928q0 40-28 68t-68 28h-1344q-40 0-68-28t-28-68v-1344q0-40 28-68t68-28h928q40 0 88 20t76 48l280 280q28 28 48 76t20 88z"/></svg>
                       </i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save cart','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

                    </button>
										<a class="ets_abancart_checkout btn btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['link_checkout']->value;?>
">
						<i class="svg_fill_white svg_fill_hover_white lh_18">
							<svg class="w_18 h_18" width="18" height="18" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M704 1536q0 52-38 90t-90 38-90-38-38-90 38-90 90-38 90 38 38 90zm896 0q0 52-38 90t-90 38-90-38-38-90 38-90 90-38 90 38 38 90zm128-1088v512q0 24-16.5 42.5t-40.5 21.5l-1044 122q13 60 13 70 0 16-24 64h920q26 0 45 19t19 45-19 45-45 19h-1024q-26 0-45-19t-19-45q0-11 8-31.5t16-36 21.5-40 15.5-29.5l-177-823h-204q-26 0-45-19t-19-45 19-45 45-19h256q16 0 28.5 6.5t19.5 15.5 13 24.5 8 26 5.5 29.5 4.5 26h1201q26 0 45 19t19 45z"/></svg>
						</i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Checkout now','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

					</a>
				</div>
			</form>
		</div>
	</div>
	<div class="ets_abancart_form_login" style="display: none;">
		<div class="front front_login panel">
			<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Oops! You have not logged in. Please log in to complete saving your cart','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</p>
			<h4><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</h4>
			<form action="<?php echo $_smarty_tpl->tpl_vars['link_action']->value;?>
" id="login_form" method="post">
				<input id="submitLogin" name="submitLogin" type="hidden" value="1">
				<div class="form-group">
					<label class="control-label" for="email2"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email address','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</label>
					<input name="email2" type="email" id="email2" class="form-control" value="" autofocus="autofocus" autocomplete="email" tabindex="1" placeholder="test@example.com" />
				</div>
				<div class="form-group">
					<label class="control-label" for="passwd2"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</label>
					<input name="passwd2" type="password" id="passwd2" class="form-control" value="" tabindex="2" autocomplete="password" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
" />
				</div>
				<div class="form-group row-padding-top">
					<button id="submit_login" name="submitLogin" type="submit" tabindex="3" class="btn btn-primary btn-lg btn-block ladda-button" data-style="slide-up" data-spinner-color="white" >
						<span class="ladda-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in and save cart','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</span>
					</button>
				</div>
				<div class="form-group text-center">
					<a href="#" class="ets_abancart_create_account">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Do not have account? Register now','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

					</a>
				</div>
			</form>
		</div>
	</div>
	<div class="ets_abancart_form_create" style="display: none;">
		<div class="front front_create panel">
			<h4><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Register','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</h4>
			<form action="<?php echo $_smarty_tpl->tpl_vars['link_action']->value;?>
" id="create_form" method="post">
				<input id="submitCreate" name="submitCreate" type="hidden" value="1">
				<div class="form-group">
					<label class="control-label" for="firstname3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</label>
					<input name="firstname3" type="text" id="firstname3" class="form-control" value="" autofocus="autofocus" tabindex="1" />
				</div>
				<div class="form-group">
					<label class="control-label" for="lastname3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</label>
					<input name="lastname3" type="text" id="lastname3" class="form-control" value="" autofocus="autofocus" tabindex="2" />
				</div>
				<div class="form-group">
					<label class="control-label" for="email3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email address','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</label>
					<input name="email3" type="email" id="email3" class="form-control" value="" autofocus="autofocus" autocomplete="email" tabindex="3" placeholder="test@example.com" />
				</div>
				<div class="form-group">
					<label class="control-label" for="passwd3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</label>
					<input name="passwd3" type="password" id="passwd3" class="form-control" value="" tabindex="4" autocomplete="password" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
"/>
				</div>
				<div class="form-group row-padding-top">
					<button id="submit_create" name="submitCreate" type="submit" tabindex="5" class="btn btn-primary btn-lg btn-block ladda-button" data-style="slide-up" data-spinner-color="white" >
						<span class="ladda-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Register and save cart','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div><?php }
}
