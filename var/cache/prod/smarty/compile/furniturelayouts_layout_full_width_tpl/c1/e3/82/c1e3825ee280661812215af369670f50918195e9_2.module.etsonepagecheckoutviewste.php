<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:40:02
  from 'module:etsonepagecheckoutviewste' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d58e2b9dbc6_71533247',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1e3825ee280661812215af369670f50918195e9' => 
    array (
      0 => 'module:etsonepagecheckoutviewste',
      1 => 1736189423,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d58e2b9dbc6_71533247 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1911559404677d58e2b9d156_37480025', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "page.tpl");
}
/* {block "content"} */
class Block_1911559404677d58e2b9d156_37480025 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1911559404677d58e2b9d156_37480025',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo $_smarty_tpl->tpl_vars['html_content']->value;?>

<?php
}
}
/* {/block "content"} */
}
