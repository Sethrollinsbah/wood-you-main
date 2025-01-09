<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:57:24
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/social.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c2794ba32a7_47192765',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '917f428779bdb8a8fd174aaf4314d1c3d68ccb67' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/social.tpl',
      1 => 1736189423,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c2794ba32a7_47192765 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['list_socials']->value) {?>
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
                    <li class="opc_social_item <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( strtolower($_smarty_tpl->tpl_vars['social']->value),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 active<?php if (strtolower($_smarty_tpl->tpl_vars['social']->value) == 'google') {
if ($_smarty_tpl->tpl_vars['ETS_OPC_GOOGLE_STYLE']->value) {?> <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['ETS_OPC_GOOGLE_STYLE']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?> light<?php }
}?>" data-auth="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['social']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                        title="<?php if (strtolower($_smarty_tpl->tpl_vars['social']->value) == 'paypal') {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign in with Paypal','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );
} elseif (strtolower($_smarty_tpl->tpl_vars['social']->value) == 'facebook') {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign in with Facebook','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );
} elseif (strtolower($_smarty_tpl->tpl_vars['social']->value) == 'google') {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign in with Google','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );
}?>">
                        <span class="opc_social_btn medium rounded custom">
                            <?php if (strtolower($_smarty_tpl->tpl_vars['social']->value) == 'paypal') {?>
                                <i class="ets_svg_icon">
                                    <svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1647 646q18 84-4 204-87 444-565 444h-44q-25 0-44 16.5t-24 42.5l-4 19-55 346-2 15q-5 26-24.5 42.5t-44.5 16.5h-251q-21 0-33-15t-9-36q9-56 26.5-168t26.5-168 27-167.5 27-167.5q5-37 43-37h131q133 2 236-21 175-39 287-144 102-95 155-246 24-70 35-133 1-6 2.5-7.5t3.5-1 6 3.5q79 59 98 162zm-172-282q0 107-46 236-80 233-302 315-113 40-252 42 0 1-90 1l-90-1q-100 0-118 96-2 8-85 530-1 10-12 10h-295q-22 0-36.5-16.5t-11.5-38.5l232-1471q5-29 27.5-48t51.5-19h598q34 0 97.5 13t111.5 32q107 41 163.5 123t56.5 196z"/></svg>
                                </i>
                            <?php } elseif (strtolower($_smarty_tpl->tpl_vars['social']->value) == 'facebook') {?>
                                <i class="ets_svg_icon">
                                    <svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1343 12v264h-157q-86 0-116 36t-30 108v189h293l-39 296h-254v759h-306v-759h-255v-296h255v-218q0-186 104-288.5t277-102.5q147 0 228 12z"/></svg>
                                </i>
                            <?php } elseif (strtolower($_smarty_tpl->tpl_vars['social']->value) == 'google') {?>
                                <i class="ets_svg_icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="16" height="16">
                                        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                                        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                                        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                                        <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                                    </svg>
                                </i>
                            <?php } else { ?>
                                <i class="icon icon-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( strtolower($_smarty_tpl->tpl_vars['social']->value),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 fa fa-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( strtolower($_smarty_tpl->tpl_vars['social']->value),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
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
<?php }
}
}
