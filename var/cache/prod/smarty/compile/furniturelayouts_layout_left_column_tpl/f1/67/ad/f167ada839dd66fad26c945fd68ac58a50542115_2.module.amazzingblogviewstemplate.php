<?php
/* Smarty version 3.1.48, created on 2025-01-07 14:24:08
  from 'module:amazzingblogviewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d7f582869d6_22342044',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f167ada839dd66fad26c945fd68ac58a50542115' => 
    array (
      0 => 'module:amazzingblogviewstemplate',
      1 => 1709033585,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d7f582869d6_22342044 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_878295336677d7f58284cb5_19881877', 'head_seo_title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_26118999677d7f582856d2_14148075', 'head_seo_description');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2092391077677d7f58285cf1_65370222', 'head_seo_keywords');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1860662055677d7f58286274_65778555', 'page_content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'head_seo_title'} */
class Block_878295336677d7f58284cb5_19881877 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head_seo_title' => 
  array (
    0 => 'Block_878295336677d7f58284cb5_19881877',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8');
}
}
/* {/block 'head_seo_title'} */
/* {block 'head_seo_description'} */
class Block_26118999677d7f582856d2_14148075 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head_seo_description' => 
  array (
    0 => 'Block_26118999677d7f582856d2_14148075',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_description']->value, ENT_QUOTES, 'UTF-8');
}
}
/* {/block 'head_seo_description'} */
/* {block 'head_seo_keywords'} */
class Block_2092391077677d7f58285cf1_65370222 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head_seo_keywords' => 
  array (
    0 => 'Block_2092391077677d7f58285cf1_65370222',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_keywords']->value, ENT_QUOTES, 'UTF-8');
}
}
/* {/block 'head_seo_keywords'} */
/* {block 'page_content'} */
class Block_1860662055677d7f58286274_65778555 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_1860662055677d7f58286274_65778555',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['html']->value;
}
}
/* {/block 'page_content'} */
}
