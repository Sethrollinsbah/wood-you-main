<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:52:01
  from 'module:psshoppingcartpsshoppingc' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26517e75b1_85460304',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35655e6409b6198f29dd6e732ef9598dec599880' => 
    array (
      0 => 'module:psshoppingcartpsshoppingc',
      1 => 1709033473,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c26517e75b1_85460304 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="_desktop_cart">
  <div class="blockcart cart-preview <?php if ($_smarty_tpl->tpl_vars['cart']->value['products_count'] > 0) {?>active<?php } else { ?>inactive<?php }?>" data-refresh-url="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['refresh_url']->value, ENT_QUOTES, 'UTF-8');?>
">
    <div class="header">
      <?php if ($_smarty_tpl->tpl_vars['cart']->value['products_count'] > 0) {?>
        <a class="link" rel="nofollow" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart_url']->value, ENT_QUOTES, 'UTF-8');?>
">
        <?php } else { ?>
        <span class="link">
      <?php }?>
        <i class="material-icons">&#xE8CB;</i>
        <span class="cart-products-count"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value['products_count'], ENT_QUOTES, 'UTF-8');?>
</span>
        <span class="cart-items"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'item(s)','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</span>
              <?php if ($_smarty_tpl->tpl_vars['cart']->value['products_count'] > 0) {?>
        </a>
        <?php } else { ?>
        </span>
      <?php }?>
    </div>
  </div>
</div>
<?php }
}
