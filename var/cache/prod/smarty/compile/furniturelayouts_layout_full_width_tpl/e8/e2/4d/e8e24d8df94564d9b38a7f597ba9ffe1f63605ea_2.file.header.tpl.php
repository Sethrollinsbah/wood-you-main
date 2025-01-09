<?php
/* Smarty version 3.1.48, created on 2025-01-08 17:24:06
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/checkout/_partials/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677efb06771c41_10846540',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8e24d8df94564d9b38a7f597ba9ffe1f63605ea' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/templates/checkout/_partials/header.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677efb06771c41_10846540 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_953200560677efb0676ff25_61673819', 'header_banner');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_595213171677efb06770d12_90173485', 'header_nav');
?>

<?php }
/* {block 'header_banner'} */
class Block_953200560677efb0676ff25_61673819 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_banner' => 
  array (
    0 => 'Block_953200560677efb0676ff25_61673819',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div class="header-banner">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayBanner'),$_smarty_tpl ) );?>

  </div>
<?php
}
}
/* {/block 'header_banner'} */
/* {block 'header_nav'} */
class Block_595213171677efb06770d12_90173485 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_nav' => 
  array (
    0 => 'Block_595213171677efb06770d12_90173485',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <nav class="header-nav">
    <div class="container">
        <div class="row nav-inner">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNav1'),$_smarty_tpl ) );?>

              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNav2'),$_smarty_tpl ) );?>

          <div class="hidden-md-up text-xs-center mobile">
            <label id="menu-icon" class="js-menu-btn round" for="menu-checkbox"> <span class="menu-btn"></span></label>
            <div class="top-logo" id="_mobile_logo"></div>
            <div id="_mobile_cart" class="hidden-md-up"></div>
            <div id="_mobile_user_info" class="hidden-md-up"></div>
          </div>
        </div>
    </div>
  </nav>
<?php
}
}
/* {/block 'header_nav'} */
}
