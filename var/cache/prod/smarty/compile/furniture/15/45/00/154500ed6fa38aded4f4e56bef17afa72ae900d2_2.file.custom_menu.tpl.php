<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:52:01
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/ets_megamenu/views/templates/hook/custom_menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c2651bc8f14_82850780',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '154500ed6fa38aded4f4e56bef17afa72ae900d2' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/ets_megamenu/views/templates/hook/custom_menu.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c2651bc8f14_82850780 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['ETS_MM_DISPLAY_SHOPPING_CART']->value || $_smarty_tpl->tpl_vars['ETS_MM_DISPLAY_SEARCH']->value || $_smarty_tpl->tpl_vars['ETS_MM_DISPLAY_CUSTOMER_INFO']->value || $_smarty_tpl->tpl_vars['ETS_MM_CUSTOM_HTML_TEXT']->value) {?>
    <div class="mm_extra_item<?php if ($_smarty_tpl->tpl_vars['ETS_MM_SEARCH_DISPLAY_DEFAULT']->value) {?> mm_display_search_default<?php }?>">
        <?php if ($_smarty_tpl->tpl_vars['ETS_MM_CUSTOM_HTML_TEXT']->value) {?>
            <div class="mm_custom_text">
                <?php echo $_smarty_tpl->tpl_vars['ETS_MM_CUSTOM_HTML_TEXT']->value;?>

            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['ETS_MM_DISPLAY_SEARCH']->value) {?>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displaySearch'),$_smarty_tpl ) );?>

        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['ETS_MM_DISPLAY_CUSTOMER_INFO']->value) {?>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCustomerInforTop'),$_smarty_tpl ) );?>

        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['ETS_MM_DISPLAY_SHOPPING_CART']->value) {?>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCartTop'),$_smarty_tpl ) );?>

        <?php }?>
    </div>
<?php }
}
}
