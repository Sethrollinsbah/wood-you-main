<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:28:38
  from 'module:psshoppingcartmodal.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d563627cff0_39074572',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0de54a7df2ce9f325675562cb8b6164899785ff9' => 
    array (
      0 => 'module:psshoppingcartmodal.tpl',
      1 => 1709033473,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d563627cff0_39074572 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="blockcart-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  </button>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6 divide-right">
                                               <div class="product-image" style="background-image: url(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['medium']['url'], ENT_QUOTES, 'UTF-8');?>
);"></div>
          </div>
          <div class="col-lg-6 cart-content">
                              <h6 class="h6 product-name"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
</h6>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"unit_price"),$_smarty_tpl ) );?>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['attributes'], 'property_value', false, 'property');
$_smarty_tpl->tpl_vars['property_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['property']->value => $_smarty_tpl->tpl_vars['property_value']->value) {
$_smarty_tpl->tpl_vars['property_value']->do_else = false;
?>
                  <p><strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['property']->value, ENT_QUOTES, 'UTF-8');?>
</strong> <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['property_value']->value, ENT_QUOTES, 'UTF-8');?>
</span></p>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <p><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</strong><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cart_quantity'], ENT_QUOTES, 'UTF-8');?>
</span></p>
                <p><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product price','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</strong><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price'], ENT_QUOTES, 'UTF-8');?>
</span></p>
                              <?php if ($_smarty_tpl->tpl_vars['cart']->value['subtotals']['tax']) {?>
                <p><strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value['subtotals']['tax']['label'], ENT_QUOTES, 'UTF-8');?>
</strong><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value['subtotals']['tax']['value'], ENT_QUOTES, 'UTF-8');?>
</span></p>
              <?php }?>
                            <div class="cart-content-btn">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Continue shopping','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</button>
                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart_url']->value, ENT_QUOTES, 'UTF-8');?>
" class="btn btn-primary"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'proceed to checkout','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }
}
