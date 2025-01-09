<?php
/* Smarty version 3.1.48, created on 2025-01-06 14:34:08
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/hook/desc_tp_item.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c3030a8cf70_97128699',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '69f5f4e4560fff9d7bf9f651d516a71deeb764b9' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/hook/desc_tp_item.tpl',
      1 => 1736189402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c3030a8cf70_97128699 (Smarty_Internal_Template $_smarty_tpl) {
if (count($_smarty_tpl->tpl_vars['languages']->value) > 1) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'lang');
$_smarty_tpl->tpl_vars['lang']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->do_else = false;
?>
        <a class="ets-ac-desc-link-tp<?php if ($_smarty_tpl->tpl_vars['idLangDefault']->value != $_smarty_tpl->tpl_vars['lang']->value['id_lang'] || !$_smarty_tpl->tpl_vars['formItem']->value) {?> hide<?php }?>"  target="_blank" data-lang="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['lang']->value['id_lang'],'html','UTF-8' ));?>
" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['baseLinkLeadForm']->value,'quotes','UTF-8' ));
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['lang']->value['iso_code'],'html','UTF-8' ));?>
/thank/<?php if ($_smarty_tpl->tpl_vars['formItem']->value) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['formItem']->value->thankyou_page_alias[$_smarty_tpl->tpl_vars['lang']->value['id_lang']],'quotes','UTF-8' ));
}?>"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['baseLinkLeadForm']->value,'quotes','UTF-8' ));
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['lang']->value['iso_code'],'html','UTF-8' ));?>
/thank/<span class="alias-link"><?php if ($_smarty_tpl->tpl_vars['formItem']->value) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['formItem']->value->thankyou_page_alias[$_smarty_tpl->tpl_vars['lang']->value['id_lang']],'quotes','UTF-8' ));
}?></span></a>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
    <a class="ets-ac-desc-link-tp<?php if (!$_smarty_tpl->tpl_vars['formItem']->value) {?> hide<?php }?>"  target="_blank" data-lang="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['idLangDefault']->value,'html','UTF-8' ));?>
" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['baseLinkLeadForm']->value,'quotes','UTF-8' ));?>
thank/<?php if ($_smarty_tpl->tpl_vars['formItem']->value) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['formItem']->value->thankyou_page_alias[$_smarty_tpl->tpl_vars['idLangDefault']->value],'quotes','UTF-8' ));
}?>"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['baseLinkLeadForm']->value,'quotes','UTF-8' ));?>
thank/<span class="alias-link"><?php if ($_smarty_tpl->tpl_vars['formItem']->value) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['formItem']->value->thankyou_page_alias[$_smarty_tpl->tpl_vars['idLangDefault']->value],'quotes','UTF-8' ));
}?></span></a>
<?php }
}
}
