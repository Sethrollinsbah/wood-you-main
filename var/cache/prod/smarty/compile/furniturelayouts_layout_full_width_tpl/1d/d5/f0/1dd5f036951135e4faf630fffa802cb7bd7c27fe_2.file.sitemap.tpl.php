<?php
/* Smarty version 3.1.48, created on 2025-01-07 08:02:53
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/cms/sitemap.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d25fdaa9bc0_71677435',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1dd5f036951135e4faf630fffa802cb7bd7c27fe' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/cms/sitemap.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:cms/_partials/sitemap-nested-list.tpl' => 4,
  ),
),false)) {
function content_677d25fdaa9bc0_71677435 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_894174369677d25fda97968_28627517', 'page_title');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2083767008677d25fda9bab8_47724073', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_title'} */
class Block_894174369677d25fda97968_28627517 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_title' => 
  array (
    0 => 'Block_894174369677d25fda97968_28627517',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <span class="sitemap-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sitemap','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</span>
<?php
}
}
/* {/block 'page_title'} */
/* {block 'page_content_container'} */
class Block_2083767008677d25fda9bab8_47724073 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_2083767008677d25fda9bab8_47724073',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="row sitemap">
        <div class="col-md-3 col-sm-6 col-12">
          <h2><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['our_offers']->value, ENT_QUOTES, 'UTF-8');?>
</h2>
          <?php $_smarty_tpl->_subTemplateRender('file:cms/_partials/sitemap-nested-list.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('links'=>$_smarty_tpl->tpl_vars['links']->value['offers']), 0, false);
?>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <h2><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categories']->value, ENT_QUOTES, 'UTF-8');?>
</h2>
          <?php $_smarty_tpl->_subTemplateRender('file:cms/_partials/sitemap-nested-list.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('links'=>$_smarty_tpl->tpl_vars['links']->value['categories']), 0, true);
?>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <h2><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['your_account']->value, ENT_QUOTES, 'UTF-8');?>
</h2>
          <?php $_smarty_tpl->_subTemplateRender('file:cms/_partials/sitemap-nested-list.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('links'=>$_smarty_tpl->tpl_vars['links']->value['user_account']), 0, true);
?>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <h2><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pages']->value, ENT_QUOTES, 'UTF-8');?>
</h2>
          <?php $_smarty_tpl->_subTemplateRender('file:cms/_partials/sitemap-nested-list.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('links'=>$_smarty_tpl->tpl_vars['links']->value['pages']), 0, true);
?>
        </div>
    </div>
<?php
}
}
/* {/block 'page_content_container'} */
}
