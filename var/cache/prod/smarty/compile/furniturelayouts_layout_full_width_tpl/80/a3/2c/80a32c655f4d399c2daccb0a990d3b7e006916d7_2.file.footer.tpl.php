<?php
/* Smarty version 3.1.48, created on 2025-01-09 16:14:18
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/_partials/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_67803c2a605392_94953423',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '80a32c655f4d399c2daccb0a990d3b7e006916d7' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/_partials/footer.tpl',
      1 => 1736457256,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67803c2a605392_94953423 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div class="footer-container">
    <div class="pre-footer">
        <div class="container">
            <div class="row">
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_128115182867803c2a5fd389_01137653', 'hook_footer_before');
?>

            </div>
        </div>
    </div>
  <div class="footer-blocks container">
    <div class="row">
      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_121122576267803c2a5fff34_33165906', 'hook_footer');
?>

    </div>
  </div>
  <div class="container">
    <div class="after-footer">
      <div class="row">
        <div class="copyright col-sm-4">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_195093209767803c2a600ad6_20889068', 'copyright_link');
?>

        </div>
         <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_27723814567803c2a6048e3_27900695', 'hook_footer_after');
?>

         </div>
      </div>
    </div>
</div>
<div id="back-top">
</div>
<?php }
/* {block 'hook_footer_before'} */
class Block_128115182867803c2a5fd389_01137653 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer_before' => 
  array (
    0 => 'Block_128115182867803c2a5fd389_01137653',
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
class Block_121122576267803c2a5fff34_33165906 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer' => 
  array (
    0 => 'Block_121122576267803c2a5fff34_33165906',
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
class Block_195093209767803c2a600ad6_20889068 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'copyright_link' => 
  array (
    0 => 'Block_195093209767803c2a600ad6_20889068',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%copyright% %year% - Wood You | ','sprintf'=>array('%year%'=>date('Y'),'%copyright%'=>'©'),'d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>

              <a class="_blank" href="https://planetbun.com" target="_blank">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Webshop by %Planet Bun%','sprintf'=>array('%Planet Bun%'=>'Planet Bun'),'d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>

              </a>
            <?php
}
}
/* {/block 'copyright_link'} */
/* {block 'hook_footer_after'} */
class Block_27723814567803c2a6048e3_27900695 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer_after' => 
  array (
    0 => 'Block_27723814567803c2a6048e3_27900695',
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
