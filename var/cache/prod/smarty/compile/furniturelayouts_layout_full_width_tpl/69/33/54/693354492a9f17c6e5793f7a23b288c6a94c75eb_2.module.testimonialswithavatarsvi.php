<?php
/* Smarty version 3.1.48, created on 2025-01-06 23:18:05
  from 'module:testimonialswithavatarsvi' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677caafd4f5dc9_02670120',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '693354492a9f17c6e5793f7a23b288c6a94c75eb' => 
    array (
      0 => 'module:testimonialswithavatarsvi',
      1 => 1709033585,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677caafd4f5dc9_02670120 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1660537493677caafd4f4e88_61185613', 'page_content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content'} */
class Block_1660537493677caafd4f4e88_61185613 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_1660537493677caafd4f4e88_61185613',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['html']->value;
}
}
/* {/block 'page_content'} */
}
