<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:40:02
  from 'module:etsonepagecheckoutviewste' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d58e2b85aa6_77128248',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11080e8b46e09d153ac81879599bc401b501d6ae' => 
    array (
      0 => 'module:etsonepagecheckoutviewste',
      1 => 1736189423,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d58e2b85aa6_77128248 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['customer_logged']->value) {?>
    <?php echo $_smarty_tpl->tpl_vars['customer_block']->value;?>

<?php } else { ?>
    <template id="password-feedback">
        <div class="password-strength-feedback mt-1" style="display: none;">
        <div class="progress-container">
            <div class="progress mb-1">
                <div class="progress-bar" role="progressbar" value="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <?php echo '<script'; ?>
 type="text/javascript" class="js-hint-password">
              {
                "0":
                "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Very weak','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "1":
                "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Weak','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "2":
                "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Average','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "3":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Strong','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "4":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Very strong','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Straight rows of keys are easy to guess":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Straight rows of keys are easy to guess','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Short keyboard patterns are easy to guess":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Short keyboard patterns are easy to guess','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Use a longer keyboard pattern with more turns":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Use a longer keyboard pattern with more turns','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Repeats like \"aaa\" are easy to guess":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Repeats like \"aaa\" are easy to guess','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Repeats like \"abcabcabc\" are only slightly harder to guess than \"abc\"":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Repeats like \"abcabcabc\" are only slightly harder to guess than \"abc\"','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Sequences like abc or 6543 are easy to guess":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sequences like \"abc\"or \"6543\" are easy to guess','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Recent years are easy to guess":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Recent years are easy to guess','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Dates are often easy to guess":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Dates are often easy to guess','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "This is a top-10 common password":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This is a top-10 common password','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "This is a top-100 common password":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This is a top-100 common password','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "This is a very common password":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This is a very common password','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "This is similar to a commonly used password":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This is similar to a commonly used password','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "A word by itself is easy to guess":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'A word by itself is easy to guess','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Names and surnames by themselves are easy to guess":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Names and surnames by themselves are easy to guess','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Common names and surnames are easy to guess":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Common names and surnames are easy to guess','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Use a few words, avoid common phrases":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Use a few words, avoid common phrases','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "No need for symbols, digits, or uppercase letters":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No need for symbols, digits, or uppercase letters','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Avoid repeated words and characters":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Avoid repeated words and characters','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Avoid sequences":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Avoid sequences','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Avoid recent years":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Avoid recent years','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Avoid years that are associated with you":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Avoid years that are associated with you','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Avoid dates and years that are associated with you":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Avoid dates and years that are associated with you','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Capitalization doesn't help very much":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Capitalization doesn\'t help very much','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "All-uppercase is almost as easy to guess as all-lowercase":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All-uppercase is almost as easy to guess as all-lowercase','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Reversed words aren't much harder to guess":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reversed words aren\'t much harder to guess','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Predictable substitutions like '@' instead of 'a' don't help very much":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Predictable substitutions like \"@\" instead of \"a\" don\'t help very much','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
",
                    "Add another word or two. Uncommon words are better.":"<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add another word or two. Uncommon words are better.','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
"} 
        <?php echo '</script'; ?>
>
    </div>
    </template>
    <div class="customer-information">
        <ul class="type-checkout-options">
            <?php if ($_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'create' || (!$_smarty_tpl->tpl_vars['PS_GUEST_CHECKOUT_ENABLED']->value && $_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'guest')) {?>
                <li>
                    <label for="type-checkout-options-3">
                        <input id="type-checkout-options-3" type="radio" name="type-checkout-options" value="create" data-type="create" <?php if (!$_smarty_tpl->tpl_vars['is_guest']->value && ($_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'create' || (!$_smarty_tpl->tpl_vars['PS_GUEST_CHECKOUT_ENABLED']->value && $_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'guest'))) {?> checked="checked"<?php }?> />
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Create account','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                    </label>
                </li>
                <li>
                    <label for="type-checkout-options-1">
                        <input id="type-checkout-options-1" type="radio" name="type-checkout-options" value="1" data-type="login"<?php if (!$_smarty_tpl->tpl_vars['is_guest']->value && $_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'login') {?> checked="checked"<?php }?> />
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                    </label>
                </li>
                <?php if ($_smarty_tpl->tpl_vars['PS_GUEST_CHECKOUT_ENABLED']->value) {?>
                    <li>
                        <label for="type-checkout-options-2">
                            <input id="type-checkout-options-2" type="radio" name="type-checkout-options" value="guest" data-type="guest"<?php if ($_smarty_tpl->tpl_vars['is_guest']->value || $_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'guest') {?> checked="checked"<?php }?> />
                            <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Guest order','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                        </label>
                    </li>
                <?php }?>
            <?php } elseif ($_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'login') {?>
                <li>
                    <label for="type-checkout-options-1">
                        <input id="type-checkout-options-1" type="radio" name="type-checkout-options" value="1" data-type="login"<?php if (!$_smarty_tpl->tpl_vars['is_guest']->value && $_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'login') {?> checked="checked"<?php }?> />
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                    </label>
                </li>
                <li>
                    <label for="type-checkout-options-3">
                        <input id="type-checkout-options-3" type="radio" name="type-checkout-options" value="create" data-type="create" <?php if (!$_smarty_tpl->tpl_vars['is_guest']->value && ($_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'create' || (!$_smarty_tpl->tpl_vars['PS_GUEST_CHECKOUT_ENABLED']->value && $_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'guest'))) {?> checked="checked"<?php }?> />
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Create account','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                    </label>
                </li>
                <?php if ($_smarty_tpl->tpl_vars['PS_GUEST_CHECKOUT_ENABLED']->value) {?>
                    <li>
                        <label for="type-checkout-options-2">
                            <input id="type-checkout-options-2" type="radio" name="type-checkout-options" value="guest" data-type="guest"<?php if ($_smarty_tpl->tpl_vars['is_guest']->value || $_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'guest') {?> checked="checked"<?php }?> />
                            <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Guest order','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                        </label>
                    </li>
                <?php }?>
            <?php } else { ?>
                <?php if ($_smarty_tpl->tpl_vars['PS_GUEST_CHECKOUT_ENABLED']->value) {?>
                    <li>
                        <label for="type-checkout-options-2">
                            <input id="type-checkout-options-2" type="radio" name="type-checkout-options" value="guest" data-type="guest"<?php if ($_smarty_tpl->tpl_vars['is_guest']->value || $_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'guest') {?> checked="checked"<?php }?> />
                            <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Guest order','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                        </label>
                    </li>
                <?php }?>
                <li>
                    <label for="type-checkout-options-1">
                        <input id="type-checkout-options-1" type="radio" name="type-checkout-options" value="1" data-type="login"<?php if (!$_smarty_tpl->tpl_vars['is_guest']->value && $_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'login') {?> checked="checked"<?php }?> />
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                    </label>
                </li>
                <li>
                    <label for="type-checkout-options-3">
                        <input id="type-checkout-options-3" type="radio" name="type-checkout-options" value="create" data-type="create" <?php if (!$_smarty_tpl->tpl_vars['is_guest']->value && ($_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'create' || (!$_smarty_tpl->tpl_vars['PS_GUEST_CHECKOUT_ENABLED']->value && $_smarty_tpl->tpl_vars['ETS_OPC_DEFAULT_ACCOUNT_FORM']->value == 'guest'))) {?> checked="checked"<?php }?> />
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Create account','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                    </label>
                </li>
            <?php }?>
        </ul>
    </div>
    <div class="form-group row type-checkout-option opc_hasaccount create sugguest" style="display:none;">
        <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Already have an account?','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 <label for="type-checkout-options-1"><a><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in instead!','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</a></label></p>
    </div>
    <div id="customer-login" class="type-checkout-option login guest create">
        <div class="form-group row type-checkout-option login" style="display:none;">
            <label class="form-control-label required <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?>"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
            <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                <input name="customer_login[email]" id="customer_login_email" class="form-control validate is_required" type="text" data-validate="isEmail" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
"/>
            </div>
        </div>
        <div class="form-group row type-checkout-option login" style="display:none;">
            <label class="form-control-label required <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?>"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
            <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                  <div class="input-group js-parent-focus ets-passw">
                      <input id="customer_login_password" class="js-child-focus js-visible-password form-control validate is_required" name="customer_login[password]" data-validate="isPasswd" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'At least 5 characters long','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
" value="" type="password" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                      <span class="input-group-btn">
                          <button class="btn ets_password" type="button">
                                <svg class="eye" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1664 960q-152-236-381-353 61 104 61 225 0 185-131.5 316.5t-316.5 131.5-316.5-131.5-131.5-316.5q0-121 61-225-229 117-381 353 133 205 333.5 326.5t434.5 121.5 434.5-121.5 333.5-326.5zm-720-384q0-20-14-34t-34-14q-125 0-214.5 89.5t-89.5 214.5q0 20 14 34t34 14 34-14 14-34q0-86 61-147t147-61q20 0 34-14t14-34zm848 384q0 34-20 69-140 230-376.5 368.5t-499.5 138.5-499.5-139-376.5-368q-20-35-20-69t20-69q140-229 376.5-368t499.5-139 499.5 139 376.5 368q20 35 20 69z"/></svg>
                                <svg class="un-eye" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M555 1335l78-141q-87-63-136-159t-49-203q0-121 61-225-229 117-381 353 167 258 427 375zm389-759q0-20-14-34t-34-14q-125 0-214.5 89.5t-89.5 214.5q0 20 14 34t34 14 34-14 14-34q0-86 61-147t147-61q20 0 34-14t14-34zm363-191q0 7-1 9-106 189-316 567t-315 566l-49 89q-10 16-28 16-12 0-134-70-16-10-16-28 0-12 44-87-143-65-263.5-173t-208.5-245q-20-31-20-69t20-69q153-235 380-371t496-136q89 0 180 17l54-97q10-16 28-16 5 0 18 6t31 15.5 33 18.5 31.5 18.5 19.5 11.5q16 10 16 27zm37 447q0 139-79 253.5t-209 164.5l280-502q8 45 8 84zm448 128q0 35-20 69-39 64-109 145-150 172-347.5 267t-419.5 95l74-132q212-18 392.5-137t301.5-307q-115-179-282-294l63-112q95 64 182.5 153t144.5 184q20 34 20 69z"/></svg>
                          </button>
                      </span>
                  </div>
            </div>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['PS_GUEST_CHECKOUT_ENABLED']->value) {?>
            <?php if (in_array('social_title',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row type-checkout-option social_title_field guest" style="display:none;">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('social_title',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Social title','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <div id="customer_guest_id_gender" class="form-control-valign">
                          <label class="radio-inline">
                              <span class="custom-radio">
                                <input name="customer_guest[id_gender]" value="1"<?php if ($_smarty_tpl->tpl_vars['is_guest']->value && $_smarty_tpl->tpl_vars['checkout_customer']->value->id_gender == 1) {?> checked="checked"<?php }?> type="radio" />
                                <span></span>
                              </span>
                              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mr.','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                          </label>
                          <label class="radio-inline">
                              <span class="custom-radio">
                                <input name="customer_guest[id_gender]" value="2"<?php if ($_smarty_tpl->tpl_vars['is_guest']->value && $_smarty_tpl->tpl_vars['checkout_customer']->value->id_gender == 2) {?> checked="checked"<?php }?> type="radio" />
                                <span></span>
                              </span>
                              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mrs.','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                          </label>
                        </div>
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>
                <div class="form-group row type-checkout-option guest" style="display:none;">
                    <div class="col-xs-12 col-sm-6">
                        <div class="row">
                            <label class="col-md-4 form-control-label required"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                            <div class="col-md-8 opc_field_right">
                                <input id="customer_guest_firstname" class="form-control validate is_required" name="customer_guest[firstname]" value="<?php if ($_smarty_tpl->tpl_vars['is_guest']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['checkout_customer']->value->firstname,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php }?>"  type="text" data-validate="isCustomerName" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="row">
                            <label class="col-md-4 form-control-label required"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                            <div class="col-md-8 opc_field_right">
                                <input id="customer_guest_lastname" class="form-control validate is_required" name="customer_guest[lastname]" value="<?php if ($_smarty_tpl->tpl_vars['is_guest']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['checkout_customer']->value->lastname,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php }?>" type="text" data-validate="isCustomerName" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="form-group row type-checkout-option guest" style="display:none;">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label required"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="customer_guest_firstname" class="form-control validate is_required" name="customer_guest[firstname]" value="<?php if ($_smarty_tpl->tpl_vars['is_guest']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['checkout_customer']->value->firstname,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php }?>"  type="text" data-validate="isCustomerName" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                    </div>
                </div>
                <div class="form-group row type-checkout-option guest" style="display:none;">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label required"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="customer_guest_lastname" class="form-control validate is_required" name="customer_guest[lastname]" value="<?php if ($_smarty_tpl->tpl_vars['is_guest']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['checkout_customer']->value->lastname,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php }?>" type="text" data-validate="isCustomerName" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                    </div>
                </div>
            <?php }?>

            <div class="form-group row type-checkout-option guest" style="display:none;">
                <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label required"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                    <input id="customer_guest_email" class="form-control validate is_required" name="customer_guest[email]" value="<?php if ($_smarty_tpl->tpl_vars['is_guest']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['checkout_customer']->value->email,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php }?>" type="email" data-validate="isEmail" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                </div>
            </div>
            <?php if (in_array('password',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD']->value)) {?>
                <?php if ((isset($_smarty_tpl->tpl_vars['isps18']->value)) && $_smarty_tpl->tpl_vars['isps18']->value) {?>
                    <div class="field-password-policy">
                        <div class="form-group row type-checkout-option guest" style="display:none;">
                            <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label <?php if (in_array('password',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>" for="field-password">
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                            </label>
                            <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right js-input-column">
                                <div class="input-group js-parent-focus">
                                    <input id="customer_guest_password" class="form-control js-child-focus js-visible-password validate <?php if (in_array('password',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }
if ((isset($_smarty_tpl->tpl_vars['isps18']->value)) && $_smarty_tpl->tpl_vars['isps18']->value) {?> is18<?php }?>" name="customer_guest[password]" aria-label="Password input"<?php if ((isset($_smarty_tpl->tpl_vars['PS_SECURITY_PASSWORD_POLICY_MINIMUM_LENGTH']->value))) {?> data-minlength="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['PS_SECURITY_PASSWORD_POLICY_MINIMUM_LENGTH']->value), ENT_QUOTES, 'UTF-8');?>
"<?php }
if ((isset($_smarty_tpl->tpl_vars['PS_SECURITY_PASSWORD_POLICY_MAXIMUM_LENGTH']->value))) {?> data-maxlength="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['PS_SECURITY_PASSWORD_POLICY_MAXIMUM_LENGTH']->value), ENT_QUOTES, 'UTF-8');?>
"<?php }
if ((isset($_smarty_tpl->tpl_vars['PS_SECURITY_PASSWORD_POLICY_MINIMUM_SCORE']->value))) {?> data-minscore="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['PS_SECURITY_PASSWORD_POLICY_MINIMUM_SCORE']->value), ENT_QUOTES, 'UTF-8');?>
"<?php }?> value="" pattern=".{5,}" type="password" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
">
                                </div>
                                <div>
                                    <div class="password-strength-feedback mt-3" style="display: none;">
                                        <div class="progress-container">
                                            <div class="progress mb-1">
                                                <div class="progress-bar" role="progressbar" value="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="password-strength-text"></div>
                                        <div class="password-requirements">
                                            <p class="password-requirements-length" data-translation="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter a password between %s and %s characters','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
">
                                                <i class="material-icons">check_circle</i>
                                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter a password between 8 and 72 characters','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                                            </p>
                                            <p class="password-requirements-score" data-translation="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The minimum score must be: %s','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
">
                                                <i class="material-icons">check_circle</i>
                                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The minimum score must be: Strong','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 form-control-comment">
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="form-group row type-checkout-option guest " style="display:none;">
                        <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('password',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                        <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                              <div class="input-group js-parent-focus ets-passw">
                                  <input id="customer_guest_password" class="form-control js-child-focus js-visible-password validate <?php if (in_array('password',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isPasswd" name="customer_guest[password]" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'At least 5 characters long','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
" value="" type="password" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                                  <span class="input-group-btn">
                                      <button class="btn ets_password" type="button">
                                            <svg class="eye" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1664 960q-152-236-381-353 61 104 61 225 0 185-131.5 316.5t-316.5 131.5-316.5-131.5-131.5-316.5q0-121 61-225-229 117-381 353 133 205 333.5 326.5t434.5 121.5 434.5-121.5 333.5-326.5zm-720-384q0-20-14-34t-34-14q-125 0-214.5 89.5t-89.5 214.5q0 20 14 34t34 14 34-14 14-34q0-86 61-147t147-61q20 0 34-14t14-34zm848 384q0 34-20 69-140 230-376.5 368.5t-499.5 138.5-499.5-139-376.5-368q-20-35-20-69t20-69q140-229 376.5-368t499.5-139 499.5 139 376.5 368q20 35 20 69z"/></svg>
                                            <svg class="un-eye" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M555 1335l78-141q-87-63-136-159t-49-203q0-121 61-225-229 117-381 353 167 258 427 375zm389-759q0-20-14-34t-34-14q-125 0-214.5 89.5t-89.5 214.5q0 20 14 34t34 14 34-14 14-34q0-86 61-147t147-61q20 0 34-14t14-34zm363-191q0 7-1 9-106 189-316 567t-315 566l-49 89q-10 16-28 16-12 0-134-70-16-10-16-28 0-12 44-87-143-65-263.5-173t-208.5-245q-20-31-20-69t20-69q153-235 380-371t496-136q89 0 180 17l54-97q10-16 28-16 5 0 18 6t31 15.5 33 18.5 31.5 18.5 19.5 11.5q16 10 16 27zm37 447q0 139-79 253.5t-209 164.5l280-502q8 45 8 84zm448 128q0 35-20 69-39 64-109 145-150 172-347.5 267t-419.5 95l74-132q212-18 392.5-137t301.5-307q-115-179-282-294l63-112q95 64 182.5 153t144.5 184q20 34 20 69z"/></svg>
                                      </button>
                                  </span>
                              </div>
                              <span class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter password to create an account for your next order','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
            <?php if (in_array('birthday',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row type-checkout-option guest" style="display:none;">
                    <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('birthday',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Birthday','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                        <input id="customer_guest_birthday" class="form-control validate <?php if (in_array('birthday',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate="isBirthDate" name="customer_guest[birthday]" value="<?php if ($_smarty_tpl->tpl_vars['is_guest']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['checkout_customer']->value->birthday,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php }?>" placeholder="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['date_format_lite']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Birthday is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Birthday is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                        <span class="form-control-comment"> (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'E.g.:','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['date_eg']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
) </span>
                    </div>
                </div>
            <?php }?>
            <?php if (Configuration::get('PS_CUSTOMER_OPTIN')) {?>
                <div class="form-group row type-checkout-option guest" style="display:none;">
                    <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>
                        <div class="col-md-4"></div>
                    <?php }?>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>col-md-8<?php } else { ?> col-md-12<?php }?>" id="customer_guest_optin">
                        <span class="checkbox">
                            <label for="customer_guest_optin_check" class="form-control-label<?php if (in_array('optin',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?> ets_checkinput">
                                <input id="customer_guest_optin_check" name="customer_guest[optin]" value="1" type="checkbox"<?php if (($_smarty_tpl->tpl_vars['is_guest']->value && $_smarty_tpl->tpl_vars['checkout_customer']->value->optin == 1) || $_smarty_tpl->tpl_vars['ETS_OPC_CHECK_BOX_OFFERS']->value) {?> checked="checked"<?php }?> /><i class="ets_checkbox"></i>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Receive offers from our partners','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                            </label>
                        </span>
                    </div>
                </div>
            <?php }?>
            <?php if (Module::isEnabled('ps_emailsubscription') && in_array('newsletter',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row type-checkout-option guest" style="display:none;">
                    <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>
                        <div class="col-md-4"></div>
                    <?php }?>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>col-md-8<?php } else { ?> col-md-12<?php }?>" id="customer_guest_newsletter">
                        <span class="checkbox">
                            <label for="customer_guest_newsletter_check" class="form-control-label<?php if (in_array('newsletter',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?> ets_checkinput">
                                <input id="customer_guest_newsletter_check" name="customer_guest[newsletter]" value="1" type="checkbox"<?php if (($_smarty_tpl->tpl_vars['is_guest']->value && $_smarty_tpl->tpl_vars['checkout_customer']->value->newsletter == 1) || $_smarty_tpl->tpl_vars['ETS_OPC_CHECK_BOX_NEWSLETTER']->value) {?> checked="checked"<?php }?> /><i class="ets_checkbox"></i>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign up for our newsletter','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
<br />
                            </label>
                            <p class="form_desc"><?php echo $_smarty_tpl->tpl_vars['NW_CONDITIONS']->value;?>
</p>
                        </span>
                    </div>
                </div>
            <?php }?>
            <?php if (Module::isEnabled('psgdpr') && Configuration::get('PSGDPR_CREATION_FORM_SWITCH')) {?>
                <div class="form-group row type-checkout-option guest " style="display:none;">
                    <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>
                        <div class="col-md-4"></div>
                    <?php }?>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>col-md-8<?php } else { ?> col-md-12<?php }?>" id="customer_guest_psgdpr">
                        <span class="checkbox ">
                            <label for="customer_guest_psgdpr_check" class="form-control-label<?php if (in_array('psgdpr',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?> ets_checkinput">
                                <input id="customer_guest_psgdpr_check" name="customer_guest[psgdpr]" value="1" type="checkbox" /><i class="ets_checkbox"></i>
                                <?php echo $_smarty_tpl->tpl_vars['gdpr_text']->value;?>

                            </label>
                        </span>
                    </div>
                </div>
            <?php }?>
            <?php if (Module::isEnabled('ps_dataprivacy') && in_array('customer_privacy',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD']->value)) {?>
                <div class="form-group row type-checkout-option guest " style="display:none;">
                    <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>
                        <div class="col-md-4"></div>
                    <?php }?>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>col-md-8<?php } else { ?> col-md-12<?php }?>" id="customer_guest_customer_privacy">
                        <span class="checkbox ">
                            <label for="customer_guest_customer_privacy_check" class="form-control-label<?php if (in_array('customer_privacy',$_smarty_tpl->tpl_vars['ETS_OPC_GUEST_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?> ets_checkinput">
                                <input id="customer_guest_customer_privacy_check" name="customer_guest[customer_privacy]" value="1" type="checkbox" /><i class="ets_checkbox"></i>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customer data privacy','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
<br />
                            </label>
                            <p class="form_desc"><?php echo $_smarty_tpl->tpl_vars['CUSTPRIV_MSG_AUTH']->value;?>
</p>
                        </span>
                    </div>
                </div>
            <?php }?>
        <?php }?>
        <?php if (in_array('social_title',$_smarty_tpl->tpl_vars['ETS_OPC_CREATEACC_DISPLAY_FIELD']->value)) {?>
            <div class="form-group row type-checkout-option social_title_field create" style="display:none;">
                <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('social_title',$_smarty_tpl->tpl_vars['ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Social title','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                    <div class="form-control-valign" id="customer_create_id_gender">
                      <label class="radio-inline">
                          <span class="custom-radio">
                            <input name="customer_create[id_gender]" value="1" type="radio" />
                            <span></span>
                          </span>
                          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mr.','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                      </label>
                      <label class="radio-inline">
                          <span class="custom-radio">
                            <input name="customer_create[id_gender]" value="2" type="radio" />
                            <span></span>
                          </span>
                          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mrs.','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                      </label>
                    </div>
                </div>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>
            <div class="form-group row type-checkout-option create " style="display:none;">
                <div class="col-xs-12 col-sm-6">
                    <div class="row">
                        <label class="col-md-4 form-control-label required"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                        <div class="col-md-8 opc_field_right">
                            <input id="customer_create_firstname" class="form-control validate is_required" data-validate="isCustomerName" name="customer_create[firstname]" value="" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="row">
                        <label class="col-md-4 form-control-label required"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                        <div class="col-md-8 opc_field_right">
                            <input id="customer_create_lastname" class="form-control validate is_required" name="customer_create[lastname]" data-validate="isCustomerName" value="" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="form-group row type-checkout-option create " style="display:none;">
                <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label required"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                    <input id="customer_create_firstname" class="form-control validate is_required" data-validate="isCustomerName" name="customer_create[firstname]" value="" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                </div>
            </div>
            <div class="form-group row type-checkout-option create " style="display:none;">
                <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label required"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
                <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                    <input id="customer_create_lastname" class="form-control validate is_required" name="customer_create[lastname]" data-validate="isCustomerName" value="" type="text" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" />
                </div>
            </div>
        <?php }?>

        <div class="form-group row type-checkout-option create " style="display:none;">
            <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label required"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</label>
            <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                <input id="customer_create_email" class="form-control validate is_required" data-validate="isEmail" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" name="customer_create[email]" value="" type="email" />
            </div>
        </div>
        <?php if ((isset($_smarty_tpl->tpl_vars['isps18']->value)) && $_smarty_tpl->tpl_vars['isps18']->value) {?>
        <div class="field-password-policy">
            <div class="form-group row type-checkout-option create " style="display:none;">
                <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label required" for="field-password">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                </label>
                <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right js-input-column">
                    <div class="input-group js-parent-focus">
                        <input id="customer_create_password" class="form-control js-child-focus js-visible-password validate is_required<?php if ((isset($_smarty_tpl->tpl_vars['isps18']->value)) && $_smarty_tpl->tpl_vars['isps18']->value) {?> is18<?php }?>" name="customer_create[password]" aria-label="Password input"<?php if ((isset($_smarty_tpl->tpl_vars['PS_SECURITY_PASSWORD_POLICY_MINIMUM_LENGTH']->value))) {?> data-minlength="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['PS_SECURITY_PASSWORD_POLICY_MINIMUM_LENGTH']->value), ENT_QUOTES, 'UTF-8');?>
"<?php }
if ((isset($_smarty_tpl->tpl_vars['PS_SECURITY_PASSWORD_POLICY_MAXIMUM_LENGTH']->value))) {?> data-maxlength="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['PS_SECURITY_PASSWORD_POLICY_MAXIMUM_LENGTH']->value), ENT_QUOTES, 'UTF-8');?>
"<?php }
if ((isset($_smarty_tpl->tpl_vars['PS_SECURITY_PASSWORD_POLICY_MINIMUM_SCORE']->value))) {?> data-minscore="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['PS_SECURITY_PASSWORD_POLICY_MINIMUM_SCORE']->value), ENT_QUOTES, 'UTF-8');?>
"<?php }?> value="" pattern=".{5,}" type="password" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
">
                    </div>
                    <div>
                        <div class="password-strength-feedback mt-3" style="display: none;">
                            <div class="progress-container">
                                <div class="progress mb-1">
                                    <div class="progress-bar" role="progressbar" value="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="password-strength-text"></div>
                            <div class="password-requirements">
                                <p class="password-requirements-length" data-translation="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter a password between %s and %s characters','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
">
                                    <i class="material-icons">check_circle</i>
                                    <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter a password between 8 and 72 characters','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                                </p>
                                <p class="password-requirements-score" data-translation="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The minimum score must be: %s','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
">
                                    <i class="material-icons">check_circle</i>
                                    <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The minimum score must be: Strong','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 form-control-comment">
                </div>
            </div>
        </div>
        <?php } else { ?>
            <div class="form-group row type-checkout-option create " style="display:none;">
                <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label required"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                    <div class="input-group js-parent-focus ets-passw">
                        <input id="customer_create_password" class="form-control js-child-focus js-visible-password validate is_required" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-validate="isPasswd" name="customer_create[password]" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'At least 5 characters long','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
" value="" type="password" />
                        <span class="input-group-btn">
                          <button class="btn ets_password" type="button" data-action="ets-show-password">
                                <svg class="eye" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1664 960q-152-236-381-353 61 104 61 225 0 185-131.5 316.5t-316.5 131.5-316.5-131.5-131.5-316.5q0-121 61-225-229 117-381 353 133 205 333.5 326.5t434.5 121.5 434.5-121.5 333.5-326.5zm-720-384q0-20-14-34t-34-14q-125 0-214.5 89.5t-89.5 214.5q0 20 14 34t34 14 34-14 14-34q0-86 61-147t147-61q20 0 34-14t14-34zm848 384q0 34-20 69-140 230-376.5 368.5t-499.5 138.5-499.5-139-376.5-368q-20-35-20-69t20-69q140-229 376.5-368t499.5-139 499.5 139 376.5 368q20 35 20 69z"/></svg>
                                <svg class="un-eye" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M555 1335l78-141q-87-63-136-159t-49-203q0-121 61-225-229 117-381 353 167 258 427 375zm389-759q0-20-14-34t-34-14q-125 0-214.5 89.5t-89.5 214.5q0 20 14 34t34 14 34-14 14-34q0-86 61-147t147-61q20 0 34-14t14-34zm363-191q0 7-1 9-106 189-316 567t-315 566l-49 89q-10 16-28 16-12 0-134-70-16-10-16-28 0-12 44-87-143-65-263.5-173t-208.5-245q-20-31-20-69t20-69q153-235 380-371t496-136q89 0 180 17l54-97q10-16 28-16 5 0 18 6t31 15.5 33 18.5 31.5 18.5 19.5 11.5q16 10 16 27zm37 447q0 139-79 253.5t-209 164.5l280-502q8 45 8 84zm448 128q0 35-20 69-39 64-109 145-150 172-347.5 267t-419.5 95l74-132q212-18 392.5-137t301.5-307q-115-179-282-294l63-112q95 64 182.5 153t144.5 184q20 34 20 69z"/></svg>
                          </button>
                      </span>
                    </div>
                </div>
            </div>
        <?php }?>
        <?php if (in_array('birthday',$_smarty_tpl->tpl_vars['ETS_OPC_CREATEACC_DISPLAY_FIELD']->value)) {?>
            <div class="form-group row type-checkout-option create " style="display:none;">
                <label class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-4<?php }?> form-control-label<?php if (in_array('birthday',$_smarty_tpl->tpl_vars['ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?>"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Birthday','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 </label>
                <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3') {?>col-md-12<?php } else { ?>col-md-8<?php }?> opc_field_right">
                    <input id="customer_create_birthday" class="form-control validate <?php if (in_array('birthday',$_smarty_tpl->tpl_vars['ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED']->value)) {?> is_required<?php }?>" data-validate-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Birthday is not valid','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-required-errors="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Birthday is required','mod'=>'ets_onepagecheckout','js'=>1),$_smarty_tpl ) );?>
" data-validate="isBirthDate" name="customer_create[birthday]" value="" placeholder="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['date_format_lite']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" type="text" />
                    <span class="form-control-comment"> (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'E.g.:','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['date_eg']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
) </span>
                </div>
            </div>
        <?php }?>
        <div class="row type-checkout-option create guest">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCustomerAccountForm'),$_smarty_tpl ) );?>

        </div>
        <?php if (Configuration::get('PS_CUSTOMER_OPTIN')) {?>
            <div class="form-group row type-checkout-option create" style="display:none;">
                <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>
                    <div class="col-md-4"></div>
                <?php }?>
                <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>col-md-8<?php } else { ?> col-md-12<?php }?>" id="customer_create_optin">
                    <span class="checkbox">
                        <label for="customer_create_optin_check" class="form-control-label<?php if (in_array('optin',$_smarty_tpl->tpl_vars['ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?> ets_checkinput">
                            <input id="customer_create_optin_check" name="customer_create[optin]" value="1" type="checkbox" <?php if ($_smarty_tpl->tpl_vars['ETS_OPC_CHECK_BOX_OFFERS']->value) {?> checked=""<?php }?> /><i class="ets_checkbox"></i>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Receive offers from our partners','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                        </label>
                    </span>
                </div>
            </div>
        <?php }?>
        <?php if (Module::isEnabled('ps_emailsubscription') && in_array('newsletter',$_smarty_tpl->tpl_vars['ETS_OPC_CREATEACC_DISPLAY_FIELD']->value)) {?>
            <div class="form-group row type-checkout-option create" style="display:none;">
                <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>
                    <div class="col-md-4"></div>
                <?php }?>
                <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>col-md-8<?php } else { ?> col-md-12<?php }?>" id="customer_create_newsletter">
                    <span class="checkbox">
                        <label for="customer_create_newsletter_check" class="form-control-label<?php if (in_array('newsletter',$_smarty_tpl->tpl_vars['ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?> ets_checkinput">
                            <input id="customer_create_newsletter_check" name="customer_create[newsletter]" value="1" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['ETS_OPC_CHECK_BOX_NEWSLETTER']->value) {?> checked=""<?php }?> /><i class="ets_checkbox"></i>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign up for our newsletter','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                        </label>
                        <p class="form_desc"><?php echo $_smarty_tpl->tpl_vars['NW_CONDITIONS']->value;?>
</p>
                    </span>
                </div>
            </div>
        <?php }?>
        <?php if (Module::isEnabled('psgdpr') && Configuration::get('PSGDPR_CREATION_FORM_SWITCH')) {?>
            <div class="form-group row type-checkout-option create " style="display:none;">
                <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>
                    <div class="col-md-4"></div>
                <?php }?>
                <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>col-md-8<?php } else { ?> col-md-12<?php }?>" id="customer_create_psgdpr">
                    <span class="checkbox ">
                        <label for="customer_create_psgdpr_check" class="form-control-label<?php if (in_array('psgdpr',$_smarty_tpl->tpl_vars['ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?> ets_checkinput">
                            <input id="customer_create_psgdpr_check" name="customer_create[psgdpr]" value="1" type="checkbox" /><i class="ets_checkbox"></i>
                            <?php echo $_smarty_tpl->tpl_vars['gdpr_text']->value;?>

                        </label>
                    </span>
                </div>
            </div>
        <?php }?>
        <?php if (Module::isEnabled('ps_dataprivacy') && in_array('customer_privacy',$_smarty_tpl->tpl_vars['ETS_OPC_CREATEACC_DISPLAY_FIELD']->value)) {?>
            <div class="form-group row type-checkout-option create agree_field" style="display:none;">
                <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>
                    <div class="col-md-4"></div>
                <?php }?>
                <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>col-md-8<?php } else { ?> col-md-12<?php }?>" id="customer_create_customer_privacy">
                    <span class="checkbox ">
                        <label for="customer_create_customer_privacy_check" class="form-control-label<?php if (in_array('customer_privacy',$_smarty_tpl->tpl_vars['ETS_OPC_CREATEACC_DISPLAY_FIELD_REQUIRED']->value)) {?> required<?php }?> ets_checkinput">
                            <input id="customer_create_customer_privacy_check" name="customer_create[customer_privacy]" value="1" type="checkbox" /><i class="ets_checkbox"></i>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customer data privacy','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                        </label>
                        <p class="form_desc"><?php echo $_smarty_tpl->tpl_vars['CUSTPRIV_MSG_AUTH']->value;?>
</p>
                    </span>
                </div>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['ETS_OPC_CAPTCHA_ENABLED']->value && ($_smarty_tpl->tpl_vars['ETS_OPC_LOGIN_CAPTCHA_ENABLED']->value || $_smarty_tpl->tpl_vars['ETS_OPC_GUEST_CAPTCHA_ENABLED']->value || $_smarty_tpl->tpl_vars['ETS_OPC_CREATEACC_CAPTCHA_ENABLED']->value)) {?>
            <div class="form-group row type-checkout-option catpcha_field <?php if ($_smarty_tpl->tpl_vars['ETS_OPC_LOGIN_CAPTCHA_ENABLED']->value) {?> login<?php }
if ($_smarty_tpl->tpl_vars['ETS_OPC_GUEST_CAPTCHA_ENABLED']->value) {?> guest<?php }
if ($_smarty_tpl->tpl_vars['ETS_OPC_CREATEACC_CAPTCHA_ENABLED']->value) {?> create<?php }?> " style="display:none;">
                <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>
                    <div class="col-md-4"></div>
                <?php }?>
                <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>col-md-8<?php } else { ?> col-xs-12 col-sm-12<?php }?>">
                    <?php if ($_smarty_tpl->tpl_vars['ETS_OPC_CAPTCHA_TYPE']->value == 'google-v3') {?>
                        <?php echo '<script'; ?>
 src="https://www.google.com/recaptcha/api.js?render=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['ETS_OPC_CAPTCHA_SITE_V3']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo '</script'; ?>
>
                        <?php echo '<script'; ?>
>
                            var login_google3_site_key='<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['ETS_OPC_CAPTCHA_SITE_V3']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
';
                        <?php echo '</script'; ?>
>
                        <input type="hidden" id="login-g-recaptcha-response-3" value="" name="g-recaptcha-response"/>
                    <?php } else { ?>
                        <div id="login_g_recaptcha_response_2"></div>
                        <?php echo '<script'; ?>
>
                            var login_google2_site_key='<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['ETS_OPC_CAPTCHA_SITE_V2']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
';
                            var login_captcha_loadCallback = function() {
                                login_g_recaptcha_response_2 =grecaptcha.render(document.getElementById('login_g_recaptcha_response_2'), {
                                    'sitekey':login_google2_site_key,
                                    'theme':'light'
                                });
                            }
                        <?php echo '</script'; ?>
>
                        <?php echo '<script'; ?>
 src="https://www.google.com/recaptcha/api.js?onload=login_captcha_loadCallback&render=explicit" async defer><?php echo '</script'; ?>
>
                    <?php }?>
                </div>
            </div>
        <?php }?>
        <div class="row type-checkout-option login opc_forgot_submit" style="display:none;">
            <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>
                <div class="col-md-4"></div>
            <?php }?>
            <div class="<?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_2') {?>col-md-8<?php } else { ?> col-xs-12 col-sm-12<?php }?>">
                <div class="forgot-password">
                    <a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getPageLink('password'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" rel="nofollow">
                      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Forgot your password?','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>

                    </a>
                </div>
                <button type="submit" name="submitCustomerLogin" class="btn-primary"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign In','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</button>
            </div>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['ETS_OPC_PAGE_ENABLED_SOCIAL']->value && in_array('checkout_page',$_smarty_tpl->tpl_vars['ETS_OPC_PAGE_ENABLED_SOCIAL']->value) && $_smarty_tpl->tpl_vars['list_socials']->value) {?>
            <div class="row type-checkout-option login create" style="display:none;">
                <div class="opc_social_form col-xs-12 col-sm-12">
                    <div class="opc_solo_or"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'OR log in with','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span></div>
                    <ul class="opc_social">
                        <?php if ($_smarty_tpl->tpl_vars['list_socials']->value) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_socials']->value, 'social');
$_smarty_tpl->tpl_vars['social']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['social']->value) {
$_smarty_tpl->tpl_vars['social']->do_else = false;
?>
                                <li class="opc_social_item <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( Tools::strtolower($_smarty_tpl->tpl_vars['social']->value),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 active<?php if (strtolower($_smarty_tpl->tpl_vars['social']->value) == 'google') {
if ($_smarty_tpl->tpl_vars['ETS_OPC_GOOGLE_STYLE']->value) {?> <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['ETS_OPC_GOOGLE_STYLE']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?> light<?php }
}?>" data-auth="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['social']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php if (Tools::strtolower($_smarty_tpl->tpl_vars['social']->value) == 'paypal') {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign in with Paypal','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );
} elseif (Tools::strtolower($_smarty_tpl->tpl_vars['social']->value) == 'facebook') {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign in with Facebook','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );
} elseif (Tools::strtolower($_smarty_tpl->tpl_vars['social']->value) == 'google') {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign in with Google','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );
}?>">
                                    <span class="opc_social_btn medium rounded custom">
                                        
                                        <?php if (Tools::strtolower($_smarty_tpl->tpl_vars['social']->value) == 'paypal') {?>
                                            <i class="ets_svg_icon">
                                                <svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1647 646q18 84-4 204-87 444-565 444h-44q-25 0-44 16.5t-24 42.5l-4 19-55 346-2 15q-5 26-24.5 42.5t-44.5 16.5h-251q-21 0-33-15t-9-36q9-56 26.5-168t26.5-168 27-167.5 27-167.5q5-37 43-37h131q133 2 236-21 175-39 287-144 102-95 155-246 24-70 35-133 1-6 2.5-7.5t3.5-1 6 3.5q79 59 98 162zm-172-282q0 107-46 236-80 233-302 315-113 40-252 42 0 1-90 1l-90-1q-100 0-118 96-2 8-85 530-1 10-12 10h-295q-22 0-36.5-16.5t-11.5-38.5l232-1471q5-29 27.5-48t51.5-19h598q34 0 97.5 13t111.5 32q107 41 163.5 123t56.5 196z"/></svg>
                                            </i>
                                        <?php } elseif (Tools::strtolower($_smarty_tpl->tpl_vars['social']->value) == 'facebook') {?>
                                            <i class="ets_svg_icon">
                                                <svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1343 12v264h-157q-86 0-116 36t-30 108v189h293l-39 296h-254v759h-306v-759h-255v-296h255v-218q0-186 104-288.5t277-102.5q147 0 228 12z"/></svg>
                                            </i>
                                        <?php } elseif (Tools::strtolower($_smarty_tpl->tpl_vars['social']->value) == 'google') {?>
                                            <i class="ets_svg_icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="16" height="16">
                                        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                                        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                                        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                                        <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                                    </svg>
                                            </i>
                                        <?php } else { ?>
                                            <i class="icon icon-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( Tools::strtolower($_smarty_tpl->tpl_vars['social']->value),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 fa fa-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( Tools::strtolower($_smarty_tpl->tpl_vars['social']->value),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"></i>
                                        <?php }?> <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['social']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                    </span>
                                </li>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>
                    </ul>
                </div>
            </div>
        <?php }?>
        <div class="form-group row type-checkout-option opc_hasaccount login sugguest" style="display:none;">
            <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No account?','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
 <label for="type-checkout-options-3"><a><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Create one here','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</a></label></p>
        </div>
        <div class="clearfix"></div>
    </div>
<?php }
}
}
