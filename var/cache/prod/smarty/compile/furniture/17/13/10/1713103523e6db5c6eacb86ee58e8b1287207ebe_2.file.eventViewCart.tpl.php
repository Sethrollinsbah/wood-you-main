<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:28:37
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/lggoogleanalytics/views/templates/hook/eventViewCart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d5635aab125_37816237',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1713103523e6db5c6eacb86ee58e8b1287207ebe' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/lggoogleanalytics/views/templates/hook/eventViewCart.tpl',
      1 => 1720095542,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d5635aab125_37816237 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
    gtag('event', 'view_cart', {
    currency: '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['event']->value['currency'],'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
',
    items: [
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['event']->value['items'], 'item', false, 'k', 'items', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['total'];
?>
    {
        item_id: '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['item']->value['item_id'],'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
',
        item_name: '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['item']->value['item_name'],'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
',
        discount: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['item']->value['discount'],'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
,
        affiliation: '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['item']->value['affiliation'],'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
',
        item_brand: '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['item']->value['item_brand'],'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
',
        item_category: '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['item']->value['item_category'],'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
',
        item_variant: '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['item']->value['item_variant'],'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
',
        price: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['item']->value['price'],'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
,
        currency: '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['item']->value['currency'],'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
',
        quantity: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['item']->value['quantity'],'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

    }<?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['last'] : null)) {?>,<?php }?>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    ],
    value: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['event']->value['value'],'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

    });
<?php echo '</script'; ?>
>
<?php }
}
