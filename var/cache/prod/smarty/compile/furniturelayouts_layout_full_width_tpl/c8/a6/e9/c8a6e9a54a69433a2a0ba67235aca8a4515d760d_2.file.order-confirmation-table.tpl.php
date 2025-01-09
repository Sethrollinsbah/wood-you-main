<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:43:51
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/checkout/_partials/order-confirmation-table.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d59c79825d2_04693784',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8a6e9a54a69433a2a0ba67235aca8a4515d760d' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/checkout/_partials/order-confirmation-table.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d59c79825d2_04693784 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div id="order-items" class="col-md-8">

  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_33428805677d59c7970469_62535236', 'order_items_table_head');
?>


  <div class="order-confirmation-table">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_731654274677d59c7971438_77057114', 'order_confirmation_table');
?>


  </div>
</div>
<?php }
/* {block 'order_items_table_head'} */
class Block_33428805677d59c7970469_62535236 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_items_table_head' => 
  array (
    0 => 'Block_33428805677d59c7970469_62535236',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <h3 class="card-title h3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order items','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</h3>
  <?php
}
}
/* {/block 'order_items_table_head'} */
/* {block 'order_confirmation_table'} */
class Block_731654274677d59c7971438_77057114 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_confirmation_table' => 
  array (
    0 => 'Block_731654274677d59c7971438_77057114',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
        <div class="order-line row">
          <div class="col-sm-2 col-3">
            <span class="image">
              <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['medium']['url'], ENT_QUOTES, 'UTF-8');?>
" />
            </span>
          </div>
          <div class="col-sm-4 col-9 details">
            <?php if ($_smarty_tpl->tpl_vars['add_product_link']->value) {?><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" target="_blank"><?php }?>
              <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span>
            <?php if ($_smarty_tpl->tpl_vars['add_product_link']->value) {?></a><?php }?>
            <?php if (count($_smarty_tpl->tpl_vars['product']->value['customizations'])) {?>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['customizations'], 'customization');
$_smarty_tpl->tpl_vars['customization']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customization']->value) {
$_smarty_tpl->tpl_vars['customization']->do_else = false;
?>
                <div class="customizations">
                  <a href="#" data-toggle="modal" data-target="#product-customizations-modal-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customization']->value['id_customization'], ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product customization','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</a>
                </div>
                <div class="modal fade customization-modal" id="product-customizations-modal-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customization']->value['id_customization'], ENT_QUOTES, 'UTF-8');?>
" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product customization','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</h4>
                      </div>
                      <div class="modal-body">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customization']->value['fields'], 'field');
$_smarty_tpl->tpl_vars['field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['field']->value) {
$_smarty_tpl->tpl_vars['field']->do_else = false;
?>
                          <div class="product-customization-line row">
                            <div class="col-sm-3 col-4 label">
                              <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['label'], ENT_QUOTES, 'UTF-8');?>

                            </div>
                            <div class="col-sm-9 col-8 value">
                              <?php if ($_smarty_tpl->tpl_vars['field']->value['type'] == 'text') {?>
                                <?php if ((int)$_smarty_tpl->tpl_vars['field']->value['id_module']) {?>
                                  <?php echo $_smarty_tpl->tpl_vars['field']->value['text'];?>

                                <?php } else { ?>
                                  <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['text'], ENT_QUOTES, 'UTF-8');?>

                                <?php }?>
                              <?php } elseif ($_smarty_tpl->tpl_vars['field']->value['type'] == 'image') {?>
                                <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['image']['small']['url'], ENT_QUOTES, 'UTF-8');?>
">
                              <?php }?>
                            </div>
                          </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"unit_price"),$_smarty_tpl ) );?>

          </div>
          <div class="col-sm-6 col-12 qty">
            <div class="row">
              <div class="col-5 text-sm-right text-xs-left"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price'], ENT_QUOTES, 'UTF-8');?>
</div>
              <div class="col-2"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['quantity'], ENT_QUOTES, 'UTF-8');?>
</div>
              <div class="col-5 text-xs-right bold"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['total'], ENT_QUOTES, 'UTF-8');?>
</div>
            </div>
          </div>
        </div>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

      <hr>

      <table>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['subtotals']->value, 'subtotal');
$_smarty_tpl->tpl_vars['subtotal']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['subtotal']->value) {
$_smarty_tpl->tpl_vars['subtotal']->do_else = false;
?>
          <?php if ($_smarty_tpl->tpl_vars['subtotal']->value['type'] !== 'tax') {?>
            <tr>
              <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subtotal']->value['label'], ENT_QUOTES, 'UTF-8');?>
</td>
              <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subtotal']->value['value'], ENT_QUOTES, 'UTF-8');?>
</td>
            </tr>
          <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php if ($_smarty_tpl->tpl_vars['subtotals']->value['tax']['label'] !== null) {?>
          <tr class="sub">
            <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subtotals']->value['tax']['label'], ENT_QUOTES, 'UTF-8');?>
</td>
            <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subtotals']->value['tax']['value'], ENT_QUOTES, 'UTF-8');?>
</td>
          </tr>
        <?php }?>
        <tr class="font-weight-bold">
          <td><span class="text-uppercase"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['totals']->value['total']['label'], ENT_QUOTES, 'UTF-8');?>
</span> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['labels']->value['tax_short'], ENT_QUOTES, 'UTF-8');?>
</td>
          <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['totals']->value['total']['value'], ENT_QUOTES, 'UTF-8');?>
</td>
        </tr>
      </table>
    <?php
}
}
/* {/block 'order_confirmation_table'} */
}
