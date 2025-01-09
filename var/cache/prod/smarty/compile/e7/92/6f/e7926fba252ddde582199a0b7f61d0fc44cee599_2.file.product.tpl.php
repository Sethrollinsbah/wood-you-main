<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:54:13
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/catalog/_partials/miniatures/product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26d59f94b4_85848582',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7926fba252ddde582199a0b7f61d0fc44cee599' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/catalog/_partials/miniatures/product.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:catalog/_partials/variant-links.tpl' => 1,
  ),
),false)) {
function content_677c26d59f94b4_85848582 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_235798598677c26d59ed2d6_95733369', 'product_miniature_item');
?>

<?php }
/* {block 'product_thumbnail'} */
class Block_1368955940677c26d59edcc8_04400467 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" class="thumbnail scale_image product-thumbnail">
          <img
            src = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['bySize']['home_default']['url'], ENT_QUOTES, 'UTF-8');?>
"
            alt = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['legend'], ENT_QUOTES, 'UTF-8');?>
"
            data-full-size-image-url = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['large']['url'], ENT_QUOTES, 'UTF-8');?>
"
          >
        </a>
      <?php
}
}
/* {/block 'product_thumbnail'} */
/* {block 'product_flags'} */
class Block_1619017028677c26d59ef164_69907812 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <ul class="product-flags">
            <?php if ($_smarty_tpl->tpl_vars['product']->value['has_discount']) {?>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['discount_type'] === 'percentage') {?>
                    <span class="discount-percentage"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['discount_percentage'], ENT_QUOTES, 'UTF-8');?>
</span>
                <?php }?>
            <?php }?>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['flags'], 'flag');
$_smarty_tpl->tpl_vars['flag']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['flag']->value) {
$_smarty_tpl->tpl_vars['flag']->do_else = false;
?>
            <li class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['flag']->value['type'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['flag']->value['label'], ENT_QUOTES, 'UTF-8');?>
</li>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
      <?php
}
}
/* {/block 'product_flags'} */
/* {block 'product_name'} */
class Block_608420930677c26d59f1219_23698604 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <h1 class="h3 product-title" itemprop="name"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],30,'...' )), ENT_QUOTES, 'UTF-8');?>
</a></h1>
          <?php
}
}
/* {/block 'product_name'} */
/* {block 'product_reviews'} */
class Block_213600860677c26d59f20d8_26911622 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductListReviews','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

        <?php
}
}
/* {/block 'product_reviews'} */
/* {block 'product_price_and_shipping'} */
class Block_603215250677c26d59f46b6_89730838 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php if ($_smarty_tpl->tpl_vars['product']->value['show_price']) {?>
              <div class="product-price-and-shipping" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
              <link itemprop="availability" href="https://schema.org/InStock"/>
              <meta itemprop="priceCurrency" content="<?php if ((isset($_smarty_tpl->tpl_vars['currency']->value))) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value['iso_code'], ENT_QUOTES, 'UTF-8');
}?>">
                <?php if ($_smarty_tpl->tpl_vars['product']->value['has_discount']) {?>
                  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"old_price"),$_smarty_tpl ) );?>


                  <span class="regular-price"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['regular_price'], ENT_QUOTES, 'UTF-8');?>
</span>
                                  <?php }?>

                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"before_price"),$_smarty_tpl ) );?>


                <span itemprop="price" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price_amount'], ENT_QUOTES, 'UTF-8');?>
" class="price"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price'], ENT_QUOTES, 'UTF-8');?>
</span>

                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'unit_price'),$_smarty_tpl ) );?>


              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'weight'),$_smarty_tpl ) );?>

            </div>
          <?php }?>
        <?php
}
}
/* {/block 'product_price_and_shipping'} */
/* {block 'quick_view'} */
class Block_966114394677c26d59f7d90_69984540 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <a class="quick-view function-btn hidden-sm-down" href="#" data-link-action="quickview">
          </a>
           <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" class="lnk_view function-btn">
           </a>
        <?php
}
}
/* {/block 'quick_view'} */
/* {block 'product_variants'} */
class Block_823820249677c26d59f8515_93055846 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php if ($_smarty_tpl->tpl_vars['product']->value['main_variants']) {?>
            <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/variant-links.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('variants'=>$_smarty_tpl->tpl_vars['product']->value['main_variants']), 0, false);
?>
          <?php }?>
        <?php
}
}
/* {/block 'product_variants'} */
/* {block 'product_miniature_item'} */
class Block_235798598677c26d59ed2d6_95733369 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_miniature_item' => 
  array (
    0 => 'Block_235798598677c26d59ed2d6_95733369',
  ),
  'product_thumbnail' => 
  array (
    0 => 'Block_1368955940677c26d59edcc8_04400467',
  ),
  'product_flags' => 
  array (
    0 => 'Block_1619017028677c26d59ef164_69907812',
  ),
  'product_name' => 
  array (
    0 => 'Block_608420930677c26d59f1219_23698604',
  ),
  'product_reviews' => 
  array (
    0 => 'Block_213600860677c26d59f20d8_26911622',
  ),
  'product_price_and_shipping' => 
  array (
    0 => 'Block_603215250677c26d59f46b6_89730838',
  ),
  'quick_view' => 
  array (
    0 => 'Block_966114394677c26d59f7d90_69984540',
  ),
  'product_variants' => 
  array (
    0 => 'Block_823820249677c26d59f8515_93055846',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <article class="product-miniature js-product-miniature" data-id-product="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
" data-id-product-attribute="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product_attribute'], ENT_QUOTES, 'UTF-8');?>
" itemscope itemtype="http://schema.org/Product">
    <div class="thumbnail-container">
      <div class="left-block">
      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1368955940677c26d59edcc8_04400467', 'product_thumbnail', $this->tplIndex);
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1619017028677c26d59ef164_69907812', 'product_flags', $this->tplIndex);
?>

      </div>
      <div class="right-block">
        <div class="product-description">
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_608420930677c26d59f1219_23698604', 'product_name', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_213600860677c26d59f20d8_26911622', 'product_reviews', $this->tplIndex);
?>

        <div class="prop-line product-description-short" itemprop="description">
              <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( strip_tags($_smarty_tpl->tpl_vars['product']->value['description_short']),120,'...' )), ENT_QUOTES, 'UTF-8');?>

        </div>
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_603215250677c26d59f46b6_89730838', 'product_price_and_shipping', $this->tplIndex);
?>

        <div class="highlighted-informations<?php if (!$_smarty_tpl->tpl_vars['product']->value['main_variants']) {?> no-variants<?php }?>">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_966114394677c26d59f7d90_69984540', 'quick_view', $this->tplIndex);
?>

        </div>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_823820249677c26d59f8515_93055846', 'product_variants', $this->tplIndex);
?>

      </div>
    </div>
  </article>
<?php
}
}
/* {/block 'product_miniature_item'} */
}
