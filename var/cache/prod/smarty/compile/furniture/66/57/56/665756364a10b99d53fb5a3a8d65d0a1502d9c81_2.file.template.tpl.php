<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:52:01
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/whatsappchat/views/templates/hook/template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c2651d09a22_10009756',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '665756364a10b99d53fb5a3a8d65d0a1502d9c81' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/whatsappchat/views/templates/hook/template.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c2651d09a22_10009756 (Smarty_Internal_Template $_smarty_tpl) {
if (($_smarty_tpl->tpl_vars['custom_js']->value != '' && $_smarty_tpl->tpl_vars['from_bo']->value != '1')) {
echo '<script'; ?>
>
    <?php echo $_smarty_tpl->tpl_vars['custom_js']->value;?>

<?php echo '</script'; ?>
>
<?php }
if (($_smarty_tpl->tpl_vars['custom_css']->value != '' && $_smarty_tpl->tpl_vars['from_bo']->value != '1')) {?>
<style id="whatsappchat_custom_css" type="text/css">
    <?php echo $_smarty_tpl->tpl_vars['custom_css']->value;?>

</style>
<?php }
if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.5','<')) {?>
    
    <?php echo '<script'; ?>
>
    $(document).ready(function() {
        $("a.whatsappchat-anchor").click(function(event) {
            event.preventDefault();
            window.open($(this).attr("href"), this.target);
        });
    });
    <?php echo '</script'; ?>
>
    
<?php }
if ($_smarty_tpl->tpl_vars['agents']->value !== false && $_smarty_tpl->tpl_vars['from_bo']->value != '1' && $_smarty_tpl->tpl_vars['offline_message']->value == '') {?>
    <?php echo '<script'; ?>
>
        <?php if (($_smarty_tpl->tpl_vars['whatsapp_action']->value === 'quickview' || $_smarty_tpl->tpl_vars['whatsapp_action']->value === 1)) {?>
            $('.jBox-wrapper').each(function(){
                $(this).remove();
            });
            $('.whatsappchat-agents-container').last().remove();
            setAgentsBox("<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
");
            $('#whatsappchat-agents<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
if (($_smarty_tpl->tpl_vars['whatsapp_action']->value === 'quickview' || $_smarty_tpl->tpl_vars['whatsapp_action']->value === 1)) {?>quickview<?php }?>').click(function(){
                if ($('.jBox-wrapper').size() > 1) {
                    $('.jBox-wrapper').last().remove();
                }
            });
        <?php } else { ?>
            <?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.7','>=')) {?>
                if (document.addEventListener) {
                    //window.addEventListener('load', setAgentsBox("<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"), false);
                    window.addEventListener('load', setAgentsBox, false);
                } else {
                    //window.attachEvent('onload', setAgentsBox("<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"));
                    window.attachEvent('onload', setAgentsBox);
                }
            <?php } elseif (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.5','>=')) {?>
                $(document).ready(function() {
                    setAgentsBox("<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
");
                });
            <?php }?>
        <?php }?>
        
        function setAgentsBox() {
            //var whatsappchat_id = $("div").data("whatsappchat-agent-id");
            var whatsappchat_id = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
";
            var test = new jBox('Tooltip', {
                id: 'agent_box_' + whatsappchat_id,
                attach: '#whatsappchat-agents' + whatsappchat_id + '<?php if (($_smarty_tpl->tpl_vars['whatsapp_action']->value === 'quickview' || $_smarty_tpl->tpl_vars['whatsapp_action']->value === 1)) {?>quickview<?php }?>',
                position: {
                    x: 'center',
                    y: 'top'
                },
                content: $('.whatsappchat-agents-container' + whatsappchat_id + '<?php if (($_smarty_tpl->tpl_vars['whatsapp_action']->value === 'quickview' || $_smarty_tpl->tpl_vars['whatsapp_action']->value === 1)) {?>quickview<?php }?>'),
                trigger: 'click',
                animation: {open: 'move', close: 'move'},
                closeButton: true,
                closeOnClick: true,
                closeOnEsc: true,
                adjustPosition: true,
                adjustTracker: true,
                adjustDistance: {top: 45, right: 5, bottom: 5, left: 5},
                zIndex: 8000,
                preventDefault: true
            });
        }
        
    <?php echo '</script'; ?>
>
    <div class="whatsappchat-agents-container <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsapp_theme']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 whatsappchat-agents-container<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
if (($_smarty_tpl->tpl_vars['whatsapp_action']->value === 'quickview' || $_smarty_tpl->tpl_vars['whatsapp_action']->value === 1)) {?>quickview<?php }?>" data-whatsappchat-agent-id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="display: none;">
        <div class="whatsappchat-agents-title<?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.7','>=')) {?> whatsappchat-agents-title17<?php }?>" style="background-color: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['color']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Hi! Click one of our agents below and we will get back to you as soon as possible.",'mod'=>'whatsappchat'),$_smarty_tpl ) );?>
</div>
        <div class="whatsappchat-agents-content">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['agents']->value, 'agent');
$_smarty_tpl->tpl_vars['agent']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['agent']->value) {
$_smarty_tpl->tpl_vars['agent']->do_else = false;
?>
                <a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['agent']->value['url'],'quotes' )), ENT_QUOTES, 'UTF-8');?>
" target="_blank" class="whatsappchat-agents-content-agent" rel="noopener noreferrer">
                    <div class="whatsappchat-agents-content-image">
                        <img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['agents_img_src']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['agent']->value['image'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['agent']->value['department'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 - <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['agent']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" referrerpolicy="no-referrer">
                    </div>
                    <div class="whatsappchat-agents-content-info<?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.7','>=')) {?> whatsappchat-agents-content-info17<?php }?>">
                        <span class="whatsappchat-agents-content-department"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['agent']->value['department'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
                        <span class="whatsappchat-agents-content-name<?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.7','>=')) {?> whatsappchat-agents-content-name17<?php }?>"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['agent']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    </div>
<?php }
if ($_smarty_tpl->tpl_vars['whatsapp_class']->value != 'floating') {?>
    <?php if ($_smarty_tpl->tpl_vars['open_chat']->value && $_smarty_tpl->tpl_vars['from_bo']->value != '1' && $_smarty_tpl->tpl_vars['offline_link']->value != '') {?><a class="whatsappchat-anchor <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsapp_theme']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 whatsappchat-anchor<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['offline_link']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php }?>
    <?php if ($_smarty_tpl->tpl_vars['open_chat']->value && $_smarty_tpl->tpl_vars['from_bo']->value != '1' && $_smarty_tpl->tpl_vars['offline_message']->value == '') {?><a class="whatsappchat-anchor <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsapp_theme']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 whatsappchat-anchor<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" target="_blank" <?php if ($_smarty_tpl->tpl_vars['agents']->value !== false && $_smarty_tpl->tpl_vars['from_bo']->value != '1' && version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.5','>=')) {?>href="javascript:void(0);" rel="nofollow noopener noreferrer" <?php } else { ?>href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['url']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" rel="noopener noreferrer"<?php }?>><?php }?>
        <div class="whatsapp whatsapp_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 whatsapp-<?php if ((isset($_smarty_tpl->tpl_vars['from_bo']->value)) && $_smarty_tpl->tpl_vars['from_bo']->value != '1') {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsapp_class']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['position']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['offline_message']->value != '' && ($_smarty_tpl->tpl_vars['whatsapp_class']->value == 'topWidth' || $_smarty_tpl->tpl_vars['whatsapp_class']->value == 'bottomWidth')) {?> whatsapp-offline<?php }?>"
            <?php if ($_smarty_tpl->tpl_vars['color']->value != '' && ($_smarty_tpl->tpl_vars['whatsapp_class']->value == 'topWidth' || $_smarty_tpl->tpl_vars['whatsapp_class']->value == 'bottomWidth') && $_smarty_tpl->tpl_vars['from_bo']->value != '1') {?>style="background-color: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['color']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php }?>>
            <span <?php if ($_smarty_tpl->tpl_vars['color']->value != '') {?>style="background-color: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['color']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php }
if ($_smarty_tpl->tpl_vars['offline_message']->value != '') {?> class="whatsapp-offline"<?php }
if ($_smarty_tpl->tpl_vars['agents']->value !== false && $_smarty_tpl->tpl_vars['from_bo']->value != '1') {?> id="whatsappchat-agents<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
if (($_smarty_tpl->tpl_vars['whatsapp_action']->value === 'quickview' || $_smarty_tpl->tpl_vars['whatsapp_action']->value === 1)) {?>quickview<?php }?>"<?php }?>>
                <i class="whatsapp-icon" <?php if ($_smarty_tpl->tpl_vars['button_text']->value == '') {?>style="padding-right:0px!important;"<?php }?>></i>
                <?php if ($_smarty_tpl->tpl_vars['offline_message']->value != '') {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['offline_message']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['button_text']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>
            </span>
        </div>
    <?php if ($_smarty_tpl->tpl_vars['open_chat']->value && $_smarty_tpl->tpl_vars['from_bo']->value != '1' && $_smarty_tpl->tpl_vars['offline_message']->value == '') {?></a><?php }?>
    <?php if ($_smarty_tpl->tpl_vars['open_chat']->value && $_smarty_tpl->tpl_vars['from_bo']->value != '1' && $_smarty_tpl->tpl_vars['offline_link']->value != '') {?></a><?php }
} else { ?>
    <?php if ($_smarty_tpl->tpl_vars['open_chat']->value && $_smarty_tpl->tpl_vars['from_bo']->value != '1' && $_smarty_tpl->tpl_vars['offline_message']->value == '') {?>
        <a<?php if ($_smarty_tpl->tpl_vars['agents']->value !== false && $_smarty_tpl->tpl_vars['from_bo']->value != '1') {?> id="whatsappchat-agents<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
if (($_smarty_tpl->tpl_vars['whatsapp_action']->value === 'quickview' || $_smarty_tpl->tpl_vars['whatsapp_action']->value === 1)) {?>quickview<?php }?>"<?php }?> target="_blank" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['url']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="float <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsapp_theme']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 whatsapp_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 float-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['position']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 float-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsapp_class']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['offline_message']->value != '') {?> whatsapp-offline<?php }?>" style="background-color: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['color']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" rel="noopener noreferrer">
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['open_chat']->value && $_smarty_tpl->tpl_vars['from_bo']->value != '1' && $_smarty_tpl->tpl_vars['offline_message']->value != '') {?>
        <a class="float <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsapp_theme']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 float-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['position']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 float-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsapp_class']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['offline_message']->value != '') {?> whatsapp-offline<?php }?>" <?php if ($_smarty_tpl->tpl_vars['offline_link']->value != '') {?>href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['offline_link']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php }?> style="background-color: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['color']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['from_bo']->value == '1') {?>
        <a class="float <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsapp_theme']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 float-floating floating-bo<?php if ($_smarty_tpl->tpl_vars['offline_message']->value != '') {?> whatsapp-offline<?php }?>" style="background-color: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['color']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
    <?php }?>
    <i class="whatsapp-icon<?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.5','>=')) {?>-3x<?php }?>" <?php if ($_smarty_tpl->tpl_vars['button_text']->value != '') {?>style="padding-right:0px!important;"<?php }?>></i>
    <?php if ($_smarty_tpl->tpl_vars['from_bo']->value == '1') {?></a><?php }?>
    <?php if ($_smarty_tpl->tpl_vars['open_chat']->value && $_smarty_tpl->tpl_vars['from_bo']->value != '1') {?></a><?php }?>
    <?php if (($_smarty_tpl->tpl_vars['button_text']->value != '' && $_smarty_tpl->tpl_vars['from_bo']->value != '1') || ($_smarty_tpl->tpl_vars['offline_message']->value != '' && $_smarty_tpl->tpl_vars['from_bo']->value != '1')) {?>
        <div class="label-container label-container-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['position']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 float-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsapp_class']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
            <?php if ((strpos($_smarty_tpl->tpl_vars['position']->value,'left') != false || $_smarty_tpl->tpl_vars['position']->value == 'left')) {?>
            <i class="icon icon-caret-left label-arrow" style="font-size: x-large;"></i>
            <div class="label-text"><?php if ($_smarty_tpl->tpl_vars['offline_message']->value != '') {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['offline_message']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['button_text']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?></div>
            <?php } else { ?>
            <div class="label-text"><?php if ($_smarty_tpl->tpl_vars['offline_message']->value != '') {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['offline_message']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['button_text']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?></div>
            <i class="icon icon-play label-arrow"></i>
            <?php }?>
        </div>
    <?php }
}
if (!$_smarty_tpl->tpl_vars['from_bo']->value && $_smarty_tpl->tpl_vars['whatsapp_class']->value == 'hookDisplayWhatsAppProductSocialButtons') {?>
<style type="text/css">
    .social-sharing li.whatsapp-social-button a:hover {
        color: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['color']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;
    }
    .social-icon li.whatsapp-social-button a:hover {
        color: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['color']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;
    }
</style>
<?php echo '<script'; ?>
>
if (document.addEventListener) {
    window.addEventListener('load', setWhatsAppSocialButton, false);
} else {
    window.attachEvent('onload', setWhatsAppSocialButton);
}
function setWhatsAppSocialButton() {
    <?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.7','>=')) {?>
        if ($('li.whatsapp-social').length > 0) {
            return false;
        }
        var element_to_copy = $('div.social-sharing ul li').first().clone();
        var customSocialButtons = false;
        if (element_to_copy.length == 0) {
            element_to_copy = $('div.innovatorySocial-sharing ul li').first().clone();
            parentSocialButtonsElement = 'div.innovatorySocial-sharing ul';
            customSocialButtons = true;
        }
        if (element_to_copy.length == 0) {
            element_to_copy = $('div.social-icon ul li').first().clone();
            parentSocialButtonsElement = 'div.social-icon ul';
            customSocialButtons = true;
        }
        var custom_style = 'max-width: 24px;max-height: 24px;vertical-align: sub;';
        var whatsapp_svg = '<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="whatsapp" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-whatsapp fa-w-14 fa-lg" style="width: inherit;height: inherit;"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" class=""></path></svg>';
        var whatsapp_svg_width = element_to_copy.width();
        if (typeof element_to_copy === 'undefined') {
            $('.whatsapp-hookDisplayWhatsAppProductSocialButtons').show();
        } else {
            if (customSocialButtons === false) {
                element_to_copy.removeClass().addClass('<?php if ($_smarty_tpl->tpl_vars['whatsapp_theme']->value == 'AngarTheme') {?>whatsapp_custom <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsapp_theme']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>fa-whatsapp<?php }?> icon-gray whatsapp-social <?php if ($_smarty_tpl->tpl_vars['whatsapp_theme']->value != 'AngarTheme') {?>whatsapp-social-button<?php }?>');//.css('background-color', '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['color']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
');
                <?php if ($_smarty_tpl->tpl_vars['whatsapp_theme']->value == 'AngarTheme') {?>
                    element_to_copy.css('background', '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['color']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
');
                <?php }?>
            } else {
                element_to_copy.addClass('whatsapp_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
');
            }
            //element_to_copy.removeClass().addClass('icon-gray whatsapp-social-button-svg');//.css('background-color', '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['color']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
');
            element_to_copy.children().attr('href', "<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
").attr('title', 'WhatsApp');
            //element_to_copy.children().append(whatsapp_svg);
            if ($('.whatsapp-social-button').length === 0) {
                if (customSocialButtons === false) {
                    $(element_to_copy).appendTo('div.social-sharing ul');
                    if ($('div.social-sharing ul li a i').length > 0) {
                        $('div.social-sharing ul li a i').last().removeClass().addClass('fa fa-whatsapp');
                    }
                    $(element_to_copy).appendTo('div.social-icon ul');
                    if ($('div.social-icon ul li a i').length > 0) {
                        $('div.social-icon ul li a i').last().removeClass().addClass('fa fa-whatsapp');
                    }
                } else {
                    element_to_copy.children().css('background-color', '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['color']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
').children().removeClass().addClass('fa fa-whatsapp');
                    $(element_to_copy).appendTo(parentSocialButtonsElement);
                }
            }
            if ($('i.fa-whatsapp').length > 0) {
                $('.fa-whatsapp.icon-gray.whatsapp-social-button').removeClass('fa-whatsapp').removeClass('whatsapp-social-button');
            }
        }
    <?php } else { ?>
        var element_to_copy16 = $('p.socialsharing_product button').first().clone();
        if (typeof element_to_copy16 === 'undefined') {
            $('.whatsapp-hookDisplayWhatsAppProductSocialButtons').show();
        } else {
            element_to_copy16.addClass('whatsapp-social-button');
            element_to_copy.children().attr('href', "<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
").attr('title', 'WhatsApp');
            $(element_to_copy16).appendTo('p.socialsharing_product');
        }
    <?php }?>
}
<?php echo '</script'; ?>
>
<?php }
}
}
