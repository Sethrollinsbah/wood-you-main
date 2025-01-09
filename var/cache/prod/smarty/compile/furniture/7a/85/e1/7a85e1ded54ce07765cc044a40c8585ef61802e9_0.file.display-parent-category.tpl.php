<?php
/* Smarty version 3.1.48, created on 2025-01-07 10:42:17
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-parent-category.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d4b594fbca8_33847827',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7a85e1ded54ce07765cc044a40c8585ef61802e9' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-parent-category.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d4b594fbca8_33847827 (Smarty_Internal_Template $_smarty_tpl) {
?><li class="more">
    <?php echo $_smarty_tpl->tpl_vars['category']->value;?>
    <ul>
        <?php echo $_smarty_tpl->tpl_vars['children']->value;?>
    </ul>
</li><?php }
}
