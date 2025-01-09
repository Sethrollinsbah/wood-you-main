<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:40:02
  from 'module:etsonepagecheckoutviewste' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d58e2a61808_58161464',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd02708bb60a931f9408f2731ab70c416f9e54fc' => 
    array (
      0 => 'module:etsonepagecheckoutviewste',
      1 => 1736189423,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
    'module:ph_extend_support/views/templates/hook/checkout/cart-detailed-product-line.tpl' => 1,
    'module:ets_onepagecheckout/views/templates/hook/cart-detailed-product-line.tpl' => 1,
  ),
),false)) {
function content_677d58e2a61808_58161464 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="cart-overview js-cart" data-refresh-url="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('ets_onepagecheckout','order',array('ajax'=>true,'action'=>'refresh')),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
    <?php if ((isset($_smarty_tpl->tpl_vars['cart']->value['products'])) && $_smarty_tpl->tpl_vars['cart']->value['products']) {?>
    <ul class="cart-items">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart']->value['products'], 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
        <li class="cart-item">
            <?php if (Module::isEnabled('ph_extend_support')) {?>
                <?php $_smarty_tpl->_subTemplateRender('module:ph_extend_support/views/templates/hook/checkout/cart-detailed-product-line.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value), 0, true);
?>
            <?php } else { ?>
                <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/cart-detailed-product-line.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value), 0, true);
?>
            <?php }?>
        </li>
        <?php if (is_array($_smarty_tpl->tpl_vars['product']->value['customizations']) && Ets_onepagecheckout::validateArray($_smarty_tpl->tpl_vars['product']->value['customizations']) && count($_smarty_tpl->tpl_vars['product']->value['customizations']) > 1) {?><hr><?php }?>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
    <?php } else { ?>
      <span class="no-items"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There are no more items in your cart','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
    <?php }?>
</div><?php }
}
