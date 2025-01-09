<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:40:02
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d58e2a52a92_02091555',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '133ef3f760c6d56c9224e20657412e9f498f6469' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/cart.tpl',
      1 => 1736189423,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'module:ets_onepagecheckout/views/templates/hook/cart-detailed.tpl' => 1,
    'module:ets_onepagecheckout/views/templates/hook/cart-detailed-totals.tpl' => 2,
    'module:ets_onepagecheckout/views/templates/hook/cart-voucher.tpl' => 2,
  ),
),false)) {
function content_677d58e2a52a92_02091555 (Smarty_Internal_Template $_smarty_tpl) {
?><section id="main">
    <div class="cart-grid row">
      <!-- Left Block: cart product informations & shpping -->
      <div class="cart-grid-body col-xs-12 col-lg-12">
        <!-- cart products detailed -->
        <div class="card cart-container">
            <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/cart-detailed.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('cart'=>$_smarty_tpl->tpl_vars['cart']->value), 0, false);
?>
        </div>
        <div class="card cart-total-action ass">
            <div class="row">
                <?php if ($_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_3' || $_smarty_tpl->tpl_vars['opc_layout']->value == 'layout_4') {?>
                    <div class="col-lg-12">
                        <div class="card cart-summary">
                            <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/cart-detailed-totals.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('cart'=>$_smarty_tpl->tpl_vars['cart']->value), 0, false);
?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card cart-summary">
                            <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/cart-voucher.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-lg-6">
                        <div class="card cart-summary">
                            <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/cart-voucher.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card cart-summary">
                            <?php $_smarty_tpl->_subTemplateRender('module:ets_onepagecheckout/views/templates/hook/cart-detailed-totals.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('cart'=>$_smarty_tpl->tpl_vars['cart']->value), 0, true);
?>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayShoppingCartFooterOnepageCheckout'),$_smarty_tpl ) );?>

      </div>
    </div>
</section><?php }
}
