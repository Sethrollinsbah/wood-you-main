<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:53:00
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/catalog/_partials/product-add-to-cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c268ce8b793_26666297',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '55cb57610f1641bb969466fbecea5ed49b91fbf4' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/catalog/_partials/product-add-to-cart.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c268ce8b793_26666297 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div class="product-add-to-cart">
  <?php if (!$_smarty_tpl->tpl_vars['configuration']->value['is_catalog']) {?>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_97062870677c268ce86503_65088036', 'product_quantity');
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1570643627677c268ce890f0_89438623', 'product_minimal_quantity');
?>

  <?php }
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCompareWishlistProButtons','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>
</div><?php }
/* {block 'product_quantity'} */
class Block_97062870677c268ce86503_65088036 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_quantity' => 
  array (
    0 => 'Block_97062870677c268ce86503_65088036',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div class="product-quantity">
        <div class="qty">
          <span class="control-label hidden-lg-down"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'QTY','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span>
          <input type="text" name="qty" id="quantity_wanted" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['quantity_wanted'], ENT_QUOTES, 'UTF-8');?>
" class="input-group" min="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['minimal_quantity'], ENT_QUOTES, 'UTF-8');?>
"/>
        </div>
        <div class="add">
          <button class="btn btn-primary add-to-cart" data-button-action="add-to-cart" type="submit" <?php if (!$_smarty_tpl->tpl_vars['product']->value['add_to_cart_url']) {?>disabled="disabled"<?php }?>>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to cart','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

          </button>
        </div>
      </div>
    <?php
}
}
/* {/block 'product_quantity'} */
/* {block 'product_minimal_quantity'} */
class Block_1570643627677c268ce890f0_89438623 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_minimal_quantity' => 
  array (
    0 => 'Block_1570643627677c268ce890f0_89438623',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <p class="product-minimal-quantity">
        <?php if ($_smarty_tpl->tpl_vars['product']->value['minimal_quantity'] > 1) {?>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The minimum purchase order quantity for the product is %quantity%.','d'=>'Shop.Theme.Checkout','sprintf'=>array('%quantity%'=>$_smarty_tpl->tpl_vars['product']->value['minimal_quantity'])),$_smarty_tpl ) );?>

        <?php }?>
      
    <?php
}
}
/* {/block 'product_minimal_quantity'} */
}
