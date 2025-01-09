<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:54:45
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26f5268e16_19142725',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b86192a7ceffba5eb6531952528db3788242f299' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/index.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c26f5268e16_19142725 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1015127580677c26f5265a62_72419835', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_1520797474677c26f5265df9_12872494 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block "block_top_banners"} */
class Block_1184686828677c26f5266545_41965486 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCustomBanners3'),$_smarty_tpl ) );?>

            <?php
}
}
/* {/block "block_top_banners"} */
/* {block "block_carousel"} */
class Block_564752582677c26f5266df5_42728516 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayEasyCarousel1'),$_smarty_tpl ) );?>

            <?php
}
}
/* {/block "block_carousel"} */
/* {block "block_banners"} */
class Block_1394052980677c26f5267598_36592039 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCustomBanners1'),$_smarty_tpl ) );?>

            <?php
}
}
/* {/block "block_banners"} */
/* {block 'hook_home'} */
class Block_150797246677c26f5267e88_55880415 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

          <?php
}
}
/* {/block 'hook_home'} */
/* {block 'page_content'} */
class Block_834629886677c26f5267c29_26355688 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_150797246677c26f5267e88_55880415', 'hook_home', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_1015127580677c26f5265a62_72419835 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_1015127580677c26f5265a62_72419835',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_1520797474677c26f5265df9_12872494',
  ),
  'block_top_banners' => 
  array (
    0 => 'Block_1184686828677c26f5266545_41965486',
  ),
  'block_carousel' => 
  array (
    0 => 'Block_564752582677c26f5266df5_42728516',
  ),
  'block_banners' => 
  array (
    0 => 'Block_1394052980677c26f5267598_36592039',
  ),
  'page_content' => 
  array (
    0 => 'Block_834629886677c26f5267c29_26355688',
  ),
  'hook_home' => 
  array (
    0 => 'Block_150797246677c26f5267e88_55880415',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1520797474677c26f5265df9_12872494', 'page_content_top', $this->tplIndex);
?>

             <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1184686828677c26f5266545_41965486', "block_top_banners", $this->tplIndex);
?>

            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_564752582677c26f5266df5_42728516', "block_carousel", $this->tplIndex);
?>

            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1394052980677c26f5267598_36592039', "block_banners", $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_834629886677c26f5267c29_26355688', 'page_content', $this->tplIndex);
?>

        <div class="home-custom row">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayHomeCustom'),$_smarty_tpl ) );?>

        </div>
      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
