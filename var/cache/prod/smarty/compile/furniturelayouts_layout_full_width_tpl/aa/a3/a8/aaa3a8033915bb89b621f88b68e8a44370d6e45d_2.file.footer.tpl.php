<?php
/* Smarty version 3.1.48, created on 2025-01-08 17:24:06
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/checkout/_partials/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677efb06abcda9_32301329',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aaa3a8033915bb89b621f88b68e8a44370d6e45d' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/checkout/_partials/footer.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677efb06abcda9_32301329 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div class="footer-container">
    <div class="pre-footer">
        <div class="container">
            <div class="row">
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_259450263677efb06ab7c24_15399089', 'hook_footer_before');
?>

            </div>
        </div>
    </div>
  <div class="footer-blocks container">
    <div class="row">
      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2125596138677efb06ab8512_05641287', 'hook_footer');
?>

    </div>
  </div>
  <div class="container">
    <div class="after-footer">
      <div class="row">
        <div class="copyright col-sm-4">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1540970776677efb06ab8c62_06579750', 'copyright_link');
?>

        </div>
         <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_550896591677efb06abc6b9_02637086', 'hook_footer_after');
?>

         </div>
      </div>
    </div>
</div>
<div id="back-top">
</div>
<?php }
/* {block 'hook_footer_before'} */
class Block_259450263677efb06ab7c24_15399089 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer_before' => 
  array (
    0 => 'Block_259450263677efb06ab7c24_15399089',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterBefore'),$_smarty_tpl ) );?>

                <?php
}
}
/* {/block 'hook_footer_before'} */
/* {block 'hook_footer'} */
class Block_2125596138677efb06ab8512_05641287 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer' => 
  array (
    0 => 'Block_2125596138677efb06ab8512_05641287',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooter'),$_smarty_tpl ) );?>

      <?php
}
}
/* {/block 'hook_footer'} */
/* {block 'copyright_link'} */
class Block_1540970776677efb06ab8c62_06579750 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'copyright_link' => 
  array (
    0 => 'Block_1540970776677efb06ab8c62_06579750',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

              <a class="_blank" href="http://www.prestashop.com" target="_blank">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%copyright% %year% - Ecommerce software by %prestashop%','sprintf'=>array('%prestashop%'=>'PrestaShop™','%year%'=>date('Y'),'%copyright%'=>'©'),'d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>

              </a>
            <?php
}
}
/* {/block 'copyright_link'} */
/* {block 'hook_footer_after'} */
class Block_550896591677efb06abc6b9_02637086 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer_after' => 
  array (
    0 => 'Block_550896591677efb06abc6b9_02637086',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

           <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterAfter'),$_smarty_tpl ) );?>

         <?php
}
}
/* {/block 'hook_footer_after'} */
}
