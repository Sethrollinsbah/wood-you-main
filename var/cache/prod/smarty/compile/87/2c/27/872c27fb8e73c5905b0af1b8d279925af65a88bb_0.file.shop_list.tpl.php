<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:52:09
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/gettadmin/themes/new-theme/template/components/layout/shop_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c265991e486_15763307',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '872c27fb8e73c5905b0af1b8d279925af65a88bb' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/gettadmin/themes/new-theme/template/components/layout/shop_list.tpl',
      1 => 1716896612,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c265991e486_15763307 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['is_multishop']->value)) && $_smarty_tpl->tpl_vars['is_multishop']->value && $_smarty_tpl->tpl_vars['shop_list']->value && ((isset($_smarty_tpl->tpl_vars['multishop_context']->value)) && $_smarty_tpl->tpl_vars['multishop_context']->value&Shop::CONTEXT_GROUP || $_smarty_tpl->tpl_vars['multishop_context']->value&Shop::CONTEXT_SHOP || $_smarty_tpl->tpl_vars['multishop_context']->value&Shop::CONTEXT_ALL)) {?>
  <div id="shop-list" class="shop-list dropdown ps-dropdown stores">
    <button class="btn btn-link" type="button" data-toggle="dropdown">
      <span class="selected-item">
        <i class="material-icons visibility">visibility</i>
        <?php if (!(isset($_smarty_tpl->tpl_vars['current_shop_name']->value)) || $_smarty_tpl->tpl_vars['current_shop_name']->value == '') {?>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All shops','d'=>'Admin.Global'),$_smarty_tpl ) );?>

        <?php } else { ?>
          <?php echo $_smarty_tpl->tpl_vars['current_shop_name']->value;?>

        <?php }?>
        <i class="material-icons arrow-down">arrow_drop_down</i>
      </span>
    </button>
    <div class="dropdown-menu dropdown-menu-right ps-dropdown-menu">
      <?php echo $_smarty_tpl->tpl_vars['shop_list']->value;?>

    </div>
  </div>
<?php } else { ?>
  <div class="shop-list">
    <a class="link" id="header_shopname" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['base_url']->value,'html','UTF-8' ));?>
" target= "_blank">
      <i class="material-icons">visibility</i>
      <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View my shop','d'=>'Admin.Navigation.Header'),$_smarty_tpl ) );?>
</span>
    </a>
  </div>
<?php }
}
}
