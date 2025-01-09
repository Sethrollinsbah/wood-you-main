<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:58:38
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/catalog/_partials/products-bottom.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c27de2f7696_01049000',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd8a65b8167e281fd462e48ee3bcc65ad6d297cda' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/catalog/_partials/products-bottom.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:catalog/_partials/sort-orders.tpl' => 1,
    'file:_partials/pagination.tpl' => 1,
  ),
),false)) {
function content_677c27de2f7696_01049000 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<div id="js-product-list-bottom" class="row products-selection">
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1423142556677c27de2f57f1_07297495', 'display_view');
?>

    <div class="sort-by-row">
      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_802976188677c27de2f6271_07421789', 'sort_by');
?>

    </div>
      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_337967132677c27de2f6d27_63734804', 'pagination');
?>

</div>
<?php }
/* {block 'display_view'} */
class Block_1423142556677c27de2f57f1_07297495 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'display_view' => 
  array (
    0 => 'Block_1423142556677c27de2f57f1_07297495',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

       <div class="display-view hidden-sm-down">
            <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View as','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</label>
             <span class="material-icons view-item show_grid active">&#xE42A;</span>
             <span class="material-icons view-item show_list">&#xE8EF;</span>
       </div>
    <?php
}
}
/* {/block 'display_view'} */
/* {block 'sort_by'} */
class Block_802976188677c27de2f6271_07421789 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'sort_by' => 
  array (
    0 => 'Block_802976188677c27de2f6271_07421789',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/sort-orders.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('sort_orders'=>$_smarty_tpl->tpl_vars['listing']->value['sort_orders']), 0, false);
?>
      <?php
}
}
/* {/block 'sort_by'} */
/* {block 'pagination'} */
class Block_337967132677c27de2f6d27_63734804 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'pagination' => 
  array (
    0 => 'Block_337967132677c27de2f6d27_63734804',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php $_smarty_tpl->_subTemplateRender('file:_partials/pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('pagination'=>$_smarty_tpl->tpl_vars['listing']->value['pagination']), 0, false);
?>
      <?php
}
}
/* {/block 'pagination'} */
}
