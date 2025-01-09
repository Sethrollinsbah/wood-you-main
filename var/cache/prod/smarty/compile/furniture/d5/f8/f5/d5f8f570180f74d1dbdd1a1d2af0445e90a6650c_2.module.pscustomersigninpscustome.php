<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:52:01
  from 'module:pscustomersigninpscustome' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26517dc5c6_73241779',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd5f8f570180f74d1dbdd1a1d2af0445e90a6650c' => 
    array (
      0 => 'module:pscustomersigninpscustome',
      1 => 1709033473,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c26517dc5c6_73241779 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="_desktop_user_info">
  <div class="dropdown js-dropdown">
     <span class="expand-more hidden-md-up" data-toggle="dropdown">
          <i class="material-icons">&#xE7FD;</i>
     </span>
    <div class="user-info dropdown-menu">
      <?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
        <a
          class="logout dropdown-item"
          href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['logout_url']->value, ENT_QUOTES, 'UTF-8');?>
"
          rel="nofollow"
        >
          <i class="material-icons">lock_open</i>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign out','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

        </a>
        <a
          class="account dropdown-item"
          href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['my_account_url']->value, ENT_QUOTES, 'UTF-8');?>
"
          title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View my customer account','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
"
          rel="nofollow"
        >
          <i class="material-icons hidden-sm-down">&#xE898;</i>
          <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customerName']->value, ENT_QUOTES, 'UTF-8');?>
</span>
        </a>
      <?php } else { ?>
        <a
          class="account dropdown-item"
          href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['my_account_url']->value, ENT_QUOTES, 'UTF-8');?>
"
          title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View my customer account','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
"
          rel="nofollow"
        >
          <i class="material-icons">&#xE7FD;</i>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My account','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

        </a>
        <a
          class="dropdown-item"
          href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['my_account_url']->value, ENT_QUOTES, 'UTF-8');?>
"
          title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in to your customer account','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
"
          rel="nofollow"
        >
          <i class="material-icons">lock_outline</i>
          <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign in','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span>
        </a>
      <?php }?>
    </div>
  </div>
</div>
<?php }
}
