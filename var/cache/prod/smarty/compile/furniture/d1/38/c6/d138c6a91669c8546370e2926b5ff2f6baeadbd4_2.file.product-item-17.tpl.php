<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:53:01
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/easycarousels/views/templates/hook/product-item-17.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c268d127945_95350859',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd138c6a91669c8546370e2926b5ff2f6baeadbd4' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/easycarousels/views/templates/hook/product-item-17.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c268d127945_95350859 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_591254877677c268d10dd71_77449103', 'product_item');
?>


<?php }
/* {block 'product_image'} */
class Block_1381136064677c268d10e770_36648376 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php if ($_smarty_tpl->tpl_vars['settings']->value['image_type'] != '--') {?>
            <?php $_smarty_tpl->_assignInScope('image_type', $_smarty_tpl->tpl_vars['settings']->value['image_type']);?>
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" class="thumbnail product-thumbnail scale_image" itemprop="url">
                <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['bySize'][$_smarty_tpl->tpl_vars['image_type']->value]['url'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['legend'], ENT_QUOTES, 'UTF-8');?>
" class="<?php if (!empty($_smarty_tpl->tpl_vars['product']->value['second_img_src'])) {?>primary-image<?php }?>">
                <?php if (!empty($_smarty_tpl->tpl_vars['product']->value['second_img_src'])) {?>
                    <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['second_img_src'], ENT_QUOTES, 'UTF-8');?>
" class="img-responsive secondary-image" itemprop="image">
                <?php }?>
            </a>
        <?php }?>
        <?php
}
}
/* {/block 'product_image'} */
/* {block 'product_stickers'} */
class Block_975836897677c268d1113e2_92743155 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['stock']) && $_smarty_tpl->tpl_vars['product']->value['availability_message']) {?>
                <div class="product-flags label_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['availability'], ENT_QUOTES, 'UTF-8');?>
">
                    <div class="product-availability <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['availability'], ENT_QUOTES, 'UTF-8');?>
">
                         <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['availability_message'], ENT_QUOTES, 'UTF-8');?>

                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['settings']->value['stickers']) {?>
                <ul class="product-flags">
                <?php if ($_smarty_tpl->tpl_vars['product']->value['show_price'] && $_smarty_tpl->tpl_vars['product']->value['has_discount'] && $_smarty_tpl->tpl_vars['product']->value['discount_type'] === 'percentage') {?>
                    <li class="discount-percentage"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['discount_percentage'], ENT_QUOTES, 'UTF-8');?>
</li>
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
            <?php }?>
        <?php
}
}
/* {/block 'product_stickers'} */
/* {block 'product_title'} */
class Block_1382248677677c268d114ef7_30048842 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['title'])) {?>
                <h5 class="product-title<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['title_one_line'])) {?> nowrap<?php }?>" itemprop="name"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],$_smarty_tpl->tpl_vars['settings']->value['title'],'...' )), ENT_QUOTES, 'UTF-8');?>
</a></h5>
            <?php }?>
            <?php
}
}
/* {/block 'product_title'} */
/* {block 'hook_reviews'} */
class Block_873752762677c268d116e00_51180250 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['displayProductListReviews'])) {?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductListReviews','product'=>$_smarty_tpl->tpl_vars['product']->value,'hide_thumbnails'=>intval(empty($_smarty_tpl->tpl_vars['settings']->value['thumbnails']))),$_smarty_tpl ) );?>

            <?php }?>
            <?php
}
}
/* {/block 'hook_reviews'} */
/* {block 'product_price'} */
class Block_983074985677c268d118224_02225028 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php if ($_smarty_tpl->tpl_vars['settings']->value['price'] && $_smarty_tpl->tpl_vars['product']->value['show_price']) {?>
                <div class="product-price-and-shipping" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <?php if ($_smarty_tpl->tpl_vars['product']->value['has_discount']) {?>
                        <?php if ($_smarty_tpl->tpl_vars['settings']->value['displayProductPriceBlock']) {?>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"old_price"),$_smarty_tpl ) );?>

                        <?php }?>
                        <span class="regular-price"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['regular_price'], ENT_QUOTES, 'UTF-8');?>
</span>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['settings']->value['displayProductPriceBlock']) {?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"before_price"),$_smarty_tpl ) );?>

                    <?php }?>
                    <span class="price"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price'], ENT_QUOTES, 'UTF-8');?>
</span>
                    <meta itemprop="price" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price_amount'], ENT_QUOTES, 'UTF-8');?>
" />
                    <meta itemprop="priceCurrency" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency_iso_code']->value, ENT_QUOTES, 'UTF-8');?>
" />
                    <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['stock']) && $_smarty_tpl->tpl_vars['product']->value['availability_message']) {?>
                        <meta itemprop="availability" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['availability_message'], ENT_QUOTES, 'UTF-8');?>
" />
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['settings']->value['displayProductPriceBlock']) {?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'unit_price'),$_smarty_tpl ) );?>

                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'weight'),$_smarty_tpl ) );?>

                    <?php }?>
                </div>
            <?php }?>
            <?php
}
}
/* {/block 'product_price'} */
/* {block 'product_other_fields'} */
class Block_26278485677c268d11cb30_87661400 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['reference'])) {?>
                <div class="prop-line product-reference nowrap"><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['reference'], ENT_QUOTES, 'UTF-8');?>
</span></div>
            <?php }?>
            <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['product_cat']) && !empty($_smarty_tpl->tpl_vars['product']->value['cat_url'])) {?>
                <div class="prop-line product-category nowrap">
                    <a class="cat-name " href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cat_url'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cat_name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['cat_name'],45,'...' )), ENT_QUOTES, 'UTF-8');?>
</a>
                </div>
            <?php }?>
            <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['product_man']) && $_smarty_tpl->tpl_vars['product']->value['id_manufacturer'] && $_smarty_tpl->tpl_vars['product']->value['man_name'] && !empty($_smarty_tpl->tpl_vars['product']->value['man_url'])) {?>
                <div class="prop-line product-manufacturer nowrap">
                    <a class="man-name" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['man_url'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['man_name'], ENT_QUOTES, 'UTF-8');?>
">
                    <?php if (!empty($_smarty_tpl->tpl_vars['product']->value['man_img_src'])) {?>
                        <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['man_img_src'], ENT_QUOTES, 'UTF-8');?>
" class="product-manufacturer-img">
                    <?php } else { ?>
                        <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['man_name'],45,'...' )), ENT_QUOTES, 'UTF-8');?>

                    <?php }?>
                    </a>
                </div>
            <?php }?>
            <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['description'])) {?>
                <div class="prop-line product-description-short" itemprop="description">
                    <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( strip_tags($_smarty_tpl->tpl_vars['product']->value['description_short']),$_smarty_tpl->tpl_vars['settings']->value['description'],'...' )), ENT_QUOTES, 'UTF-8');?>

                </div>
            <?php }?>
            <?php
}
}
/* {/block 'product_other_fields'} */
/* {block 'product_buttons'} */
class Block_2143852961677c268d123353_28619539 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <?php if ($_smarty_tpl->tpl_vars['settings']->value['add_to_cart'] || $_smarty_tpl->tpl_vars['settings']->value['displayProductListFunctionalButtons']) {?>
                    <form type="post" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart_page_url']->value, ENT_QUOTES, 'UTF-8');?>
" class="product-item-buttons">
                        <?php if ($_smarty_tpl->tpl_vars['settings']->value['add_to_cart']) {?>
                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['static_token']->value, ENT_QUOTES, 'UTF-8');?>
">
                            <input type="hidden" name="id_product" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
">
                            <input type="hidden" name="qty" value="1">
                            <button data-button-action="add-to-cart" class="add-to-cart butt btn_border">
                            <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to cart','d'=>'Shop.Modules.Easycarousels'),$_smarty_tpl ) );?>
</span>
                            </button>
                        <?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['settings']->value['displayProductListFunctionalButtons'])) {?>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductListFunctionalButtons','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

                        <?php }?>
                    </form>
                <?php }?>
                <?php
}
}
/* {/block 'product_buttons'} */
/* {block 'product_quick_view'} */
class Block_585129211677c268d1257d3_16666276 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <?php if ($_smarty_tpl->tpl_vars['settings']->value['quick_view'] || $_smarty_tpl->tpl_vars['settings']->value['view_more']) {?>
                    <div class="highlighted-informations">
                        <?php if ($_smarty_tpl->tpl_vars['settings']->value['quick_view']) {?>
                            <a href="#" class="quick-view function-btn hidden-sm-down" data-link-action="quickview"></a>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['settings']->value['view_more']) {?>
                            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" class="lnk_view function-btn"></a>
                        <?php }?>
                    </div>
                <?php }?>
                <?php
}
}
/* {/block 'product_quick_view'} */
/* {block 'product_informations'} */
class Block_1420349630677c268d114c52_11319057 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <div class="product-description">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1382248677677c268d114ef7_30048842', 'product_title', $this->tplIndex);
?>

            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_873752762677c268d116e00_51180250', 'hook_reviews', $this->tplIndex);
?>

            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_983074985677c268d118224_02225028', 'product_price', $this->tplIndex);
?>

            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_26278485677c268d11cb30_87661400', 'product_other_fields', $this->tplIndex);
?>

            <div class="button-container">
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2143852961677c268d123353_28619539', 'product_buttons', $this->tplIndex);
?>

                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_585129211677c268d1257d3_16666276', 'product_quick_view', $this->tplIndex);
?>

            </div>
        </div>
        <?php
}
}
/* {/block 'product_informations'} */
/* {block 'product_variants'} */
class Block_580424275677c268d1272d9_85734418 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'product_variants'} */
/* {block 'product_item'} */
class Block_591254877677c268d10dd71_77449103 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_item' => 
  array (
    0 => 'Block_591254877677c268d10dd71_77449103',
  ),
  'product_image' => 
  array (
    0 => 'Block_1381136064677c268d10e770_36648376',
  ),
  'product_stickers' => 
  array (
    0 => 'Block_975836897677c268d1113e2_92743155',
  ),
  'product_informations' => 
  array (
    0 => 'Block_1420349630677c268d114c52_11319057',
  ),
  'product_title' => 
  array (
    0 => 'Block_1382248677677c268d114ef7_30048842',
  ),
  'hook_reviews' => 
  array (
    0 => 'Block_873752762677c268d116e00_51180250',
  ),
  'product_price' => 
  array (
    0 => 'Block_983074985677c268d118224_02225028',
  ),
  'product_other_fields' => 
  array (
    0 => 'Block_26278485677c268d11cb30_87661400',
  ),
  'product_buttons' => 
  array (
    0 => 'Block_2143852961677c268d123353_28619539',
  ),
  'product_quick_view' => 
  array (
    0 => 'Block_585129211677c268d1257d3_16666276',
  ),
  'product_variants' => 
  array (
    0 => 'Block_580424275677c268d1272d9_85734418',
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1381136064677c268d10e770_36648376', 'product_image', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_975836897677c268d1113e2_92743155', 'product_stickers', $this->tplIndex);
?>

    </div>
    <div class="right-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1420349630677c268d114c52_11319057', 'product_informations', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_580424275677c268d1272d9_85734418', 'product_variants', $this->tplIndex);
?>


    </div>
</div>
</article>
<?php
}
}
/* {/block 'product_item'} */
}
