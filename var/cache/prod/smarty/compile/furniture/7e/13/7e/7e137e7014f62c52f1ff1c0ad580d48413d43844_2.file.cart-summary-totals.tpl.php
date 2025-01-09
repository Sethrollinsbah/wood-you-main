<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:41:43
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/cart-summary-totals.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d59470e5755_84455249',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e137e7014f62c52f1ff1c0ad580d48413d43844' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_onepagecheckout/views/templates/hook/cart-summary-totals.tpl',
      1 => 1736189423,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d59470e5755_84455249 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="card-block cart-summary-totals">
    <?php if ((isset($_smarty_tpl->tpl_vars['cart']->value['subtotals']['tax'])) && $_smarty_tpl->tpl_vars['cart']->value['subtotals']['tax']) {?>
      <div class="cart-summary-line">
        <span class="label sub"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%label%:','sprintf'=>array('%label%'=>$_smarty_tpl->tpl_vars['cart']->value['subtotals']['tax']['label']),'mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
        <span class="value sub"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['subtotals']['tax']['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
      </div>
    <?php }?>
    <div class="cart-summary-line cart-total">
      <?php if ((isset($_smarty_tpl->tpl_vars['configuration']->value['taxes_enabled'])) && $_smarty_tpl->tpl_vars['configuration']->value['taxes_enabled']) {?>
        <?php if ((isset($_smarty_tpl->tpl_vars['configuration']->value['display_prices_tax_incl'])) && $_smarty_tpl->tpl_vars['configuration']->value['display_prices_tax_incl']) {?>
          <span class="label"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['totals']['total_including_tax']['label'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
          <span class="value"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['totals']['total_including_tax']['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
        <?php } else { ?>
          <span class="label"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['totals']['total_excluding_tax']['label'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
          <span class="value"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['totals']['total_excluding_tax']['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
        <?php }?>
      <?php } else { ?>
        <span class="label"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['totals']['total']['label'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
        <span class="value"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cart']->value['totals']['total']['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
      <?php }?>
    </div>
</div><?php }
}
