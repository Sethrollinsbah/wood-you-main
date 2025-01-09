<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:53:56
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/catalog/listing/category.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26c49b9a47_08110156',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '249f170d2643ca13441e721e65868f4d208ec9c0' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/catalog/listing/category.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c26c49b9a47_08110156 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_534966501677c26c49b19c2_99223054', 'product_list_header');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'catalog/listing/product-list.tpl');
}
/* {block 'product_list_header'} */
class Block_534966501677c26c49b19c2_99223054 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_list_header' => 
  array (
    0 => 'Block_534966501677c26c49b19c2_99223054',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="block-category card card-block">
      <h1 class="listing-title title_main_section"><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span></h1>
      <?php if ($_smarty_tpl->tpl_vars['category']->value['description']) {?>
        <div id="category-description" class="text-muted"><?php echo $_smarty_tpl->tpl_vars['category']->value['description'];?>
</div>
      <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['category']->value['image']['large']['url']) {?>
        <div class="category-cover">
          <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['image']['large']['url'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['image']['legend'], ENT_QUOTES, 'UTF-8');?>
">
        </div>
      <?php }?>
    </div>
    
    <?php if ((isset($_smarty_tpl->tpl_vars['subcategories']->value))) {?>
    <!-- Subcategories -->
    <div id="subcategories">
        <p class="subcategory-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Subcategories'),$_smarty_tpl ) );?>
</p>
        <div class="">
        <ul class="clearfix">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['subcategories']->value, 'subcategory');
$_smarty_tpl->tpl_vars['subcategory']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['subcategory']->value) {
$_smarty_tpl->tpl_vars['subcategory']->do_else = false;
?>
                <li>
                    <div class="subcategory-image">
                        <a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getCategoryLink($_smarty_tpl->tpl_vars['subcategory']->value['id_category'],$_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['subcategory']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="img">
                            <?php if ($_smarty_tpl->tpl_vars['subcategory']->value['id_image']) {?>
                                <img class="replace-2x" src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getCatImageLink($_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite'],$_smarty_tpl->tpl_vars['subcategory']->value['id_image'],'category_default'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['subcategory']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"/>
                            <?php } else { ?>
                                <img class="replace-2x" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['img_cat_dir']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['lang_iso']->value, ENT_QUOTES, 'UTF-8');?>
-default-category_default.jpg" alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['subcategory']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"/>
                            <?php }?>
                        </a>
                    </div>
                    <h5><a class="subcategory-name" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getCategoryLink($_smarty_tpl->tpl_vars['subcategory']->value['id_category'],$_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['subcategory']->value['name'],25,'...' )),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</a></h5>
                    <?php if ($_smarty_tpl->tpl_vars['subcategory']->value['description']) {?>
                        <div class="cat_desc"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subcategory']->value['description'], ENT_QUOTES, 'UTF-8');?>
</div>
                    <?php }?>
                </li>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        </div>
    </div>
    <?php }?>


<?php
}
}
/* {/block 'product_list_header'} */
}
