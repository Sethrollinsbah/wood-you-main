<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:52:01
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/lgcookieslaw/views/templates/hook/cookieslaw.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26518618a1_46040341',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '934f2b2167bd12a5dcaf4797f38fb05e42dea0e4' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/lgcookieslaw/views/templates/hook/cookieslaw.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c26518618a1_46040341 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="lgcookieslaw_banner" class="lgcookieslaw-banner<?php if ($_smarty_tpl->tpl_vars['lgcookieslaw_position']->value == 3) {?> lgcookieslaw-message-floating<?php }
if ((isset($_smarty_tpl->tpl_vars['lgcookieslaw_show_reject_all_button']->value)) && $_smarty_tpl->tpl_vars['lgcookieslaw_show_reject_all_button']->value) {?> lgcookieslaw-reject-all-button-enabled<?php }?>">
    <div class="container">
        <div class="lgcookieslaw-message">
            <?php echo $_smarty_tpl->tpl_vars['cookie_message']->value;?>
 
            <div class="lgcookieslaw-link-container">
                <a id="lgcookieslaw_info" class="lgcookieslaw-info lgcookieslaw-link-button" <?php if ((isset($_smarty_tpl->tpl_vars['cms_target']->value)) && $_smarty_tpl->tpl_vars['cms_target']->value) {?> target="_blank" <?php }?> href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cms_link']->value,'quotes','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" >
                    <?php echo htmlspecialchars(stripslashes(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['button2']->value,'quotes','UTF-8' ))), ENT_QUOTES, 'UTF-8');?>

                </a>

                <a id="lgcookieslaw_customize_cookies" class="lgcookieslaw-customize-cookies lgcookieslaw-link-button" onclick="customizeCookies()">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customize Cookies','mod'=>'lgcookieslaw'),$_smarty_tpl ) );?>

                </a>
            </div>
        </div>
        <div class="lgcookieslaw-button-container">
            <?php if ((isset($_smarty_tpl->tpl_vars['lgcookieslaw_show_reject_all_button']->value)) && $_smarty_tpl->tpl_vars['lgcookieslaw_show_reject_all_button']->value) {?>
                <button id="lgcookieslaw_reject_all" class="lgcookieslaw-btn lgcookieslaw-reject-all lgcookieslaw-link-button" onclick="closeinfo(true, 0)">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reject All','mod'=>'lgcookieslaw'),$_smarty_tpl ) );?>

                </button>
            <?php }?>

            <button id="lgcookieslaw_accept" class="lgcookieslaw-btn lgcookieslaw-accept lggoogleanalytics-accept" onclick="closeinfo(true, 1)"><?php echo htmlspecialchars(stripslashes(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['button1']->value,'quotes','UTF-8' ))), ENT_QUOTES, 'UTF-8');?>
</button>
        </div>
    </div>
</div>

<div id="lgcookieslaw_modal" class="lgcookieslaw-modal">
    <div class="lgcookieslaw-modal-body">
        <h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cookies configuration','mod'=>'lgcookieslaw'),$_smarty_tpl ) );?>
</h2>

        <?php if ((isset($_smarty_tpl->tpl_vars['lgcookieslaw_purposes']->value)) && !empty($_smarty_tpl->tpl_vars['lgcookieslaw_purposes']->value)) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lgcookieslaw_purposes']->value, 'lgcookieslaw_purpose');
$_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->value) {
$_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->do_else = false;
?>
                <div class="lgcookieslaw-section">
                    <div class="lgcookieslaw-section-name">
                        <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->value['technical']) {?> <small><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(technical)','mod'=>'lgcookieslaw'),$_smarty_tpl ) );?>
</small><?php }?>
                    </div>
                    <div class="lgcookieslaw-section-checkbox">
                        <label class="lgcookieslaw-switch">
                            <div class="lgcookieslaw-slider-option-left"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'lgcookieslaw'),$_smarty_tpl ) );?>
</div>
                            <input type="checkbox" id="lgcookieslaw_purpose_enabled_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->value['id_lgcookieslaw_purpose']), ENT_QUOTES, 'UTF-8');?>
" class="lgcookieslaw-purpose-enabled<?php if ($_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->value['id_lgcookieslaw_purpose'] == LGCookiesLawPurpose::ANALYTICS_PURPOSE) {?> lgcookieslaw-analytics-purpose<?php }?>" data-id-lgcookieslaw-purpose="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->value['id_lgcookieslaw_purpose']), ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->value['technical']) {?> checked="checked" disabled="disabled"<?php } else {
if ($_smarty_tpl->tpl_vars['third_paries']->value) {?> checked="checked"<?php }
}?>>
                            <span class="lgcookieslaw-slider<?php if ($_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->value['technical']) {?> lgcookieslaw-slider-checked<?php } else {
if ($_smarty_tpl->tpl_vars['third_paries']->value) {?> lgcookieslaw-slider-checked<?php }
}?>"></span>
                            <div class="lgcookieslaw-slider-option-right"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'lgcookieslaw'),$_smarty_tpl ) );?>
</div>
                        </label>
                    </div>
                    <div class="lgcookieslaw-section-description">
                        <div class="lgcookieslaw-section-description-button card-header collapsed" data-toggle="collapse" href="#multi_collapse_lgwhatsapp_purpose_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->value['id_lgcookieslaw_purpose']), ENT_QUOTES, 'UTF-8');?>
" role="button" aria-expanded="false" aria-controls="multi_collapse_lgwhatsapp_purpose_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->value['id_lgcookieslaw_purpose']), ENT_QUOTES, 'UTF-8');?>
">
                            <a class="card-title-cookies"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Description','mod'=>'lgcookieslaw'),$_smarty_tpl ) );?>
</a>
                        </div>
                        <div class="lgcookieslaw-section-description-content collapse multi-collapse" id="multi_collapse_lgwhatsapp_purpose_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->value['id_lgcookieslaw_purpose']), ENT_QUOTES, 'UTF-8');?>
">
                            <?php echo $_smarty_tpl->tpl_vars['lgcookieslaw_purpose']->value['description'];?>
                         </div>
                    </div>
                </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php }?>
    </div>
    <div class="lgcookieslaw-modal-footer">
        <div class="lgcookieslaw-modal-footer-left">
            <button id="lgcookieslaw_cancel" class="btn lgcookieslaw-cancel"> > <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel','mod'=>'lgcookieslaw'),$_smarty_tpl ) );?>
</button>
        </div>
        <div class="lgcookieslaw-modal-footer-right">
            <?php if ((isset($_smarty_tpl->tpl_vars['lgcookieslaw_show_reject_all_button']->value)) && $_smarty_tpl->tpl_vars['lgcookieslaw_show_reject_all_button']->value) {?>
                <button id="lgcookieslaw_reject_all" class="btn lgcookieslaw-reject-all" onclick="closeinfo(true, 0)"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reject All','mod'=>'lgcookieslaw'),$_smarty_tpl ) );?>
</button>
            <?php }?>

            <button id="lgcookieslaw_save" class="btn lgcookieslaw-save<?php if ((isset($_smarty_tpl->tpl_vars['lgcookieslaw_enable_lggoogleanalytics_accept']->value)) && $_smarty_tpl->tpl_vars['lgcookieslaw_enable_lggoogleanalytics_accept']->value) {?> lggoogleanalytics-accept<?php }?>" onclick="closeinfo(true, 2)"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Accept Selection','mod'=>'lgcookieslaw'),$_smarty_tpl ) );?>
</button>
            <button id="lgcookieslaw_accept_all" class="btn lgcookieslaw-accept-all lggoogleanalytics-accept" onclick="closeinfo(true, 1)"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Accept All','mod'=>'lgcookieslaw'),$_smarty_tpl ) );?>
</button>
        </div>
    </div>
</div>

<div class="lgcookieslaw-overlay"></div>
<?php }
}
