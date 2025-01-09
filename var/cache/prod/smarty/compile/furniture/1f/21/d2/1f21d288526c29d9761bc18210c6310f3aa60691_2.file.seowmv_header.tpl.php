<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:52:01
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/seowebmasterverification/views/templates/hook/seowmv_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c265171f6a6_10182956',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f21d288526c29d9761bc18210c6310f3aa60691' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/seowebmasterverification/views/templates/hook/seowmv_header.tpl',
      1 => 1709033584,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c265171f6a6_10182956 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- SEO Webmaster verification -->
<?php if ((isset($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_GOOGLE']->value)) && ($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_GOOGLE']->value != '')) {?> <meta name="google-site-verification" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_GOOGLE']->value, ENT_QUOTES, 'UTF-8');?>
" /> <?php }
if ((isset($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_BING']->value)) && ($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_BING']->value != '')) {?> <meta name="msvalidate.01" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_BING']->value, ENT_QUOTES, 'UTF-8');?>
" /> <?php }
if ((isset($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_YAHOO']->value)) && ($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_YAHOO']->value != '')) {?> <meta name="y_key" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_YAHOO']->value, ENT_QUOTES, 'UTF-8');?>
" /> <?php }
if ((isset($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_ALEXA']->value)) && ($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_ALEXA']->value != '')) {?> <meta name="alexaVerifyID" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_ALEXA']->value, ENT_QUOTES, 'UTF-8');?>
" /> <?php }
if ((isset($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_YANDEX']->value)) && ($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_YANDEX']->value != '')) {?> <meta name="yandex-verification" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SEO_MGR_CONFIG_YANDEX']->value, ENT_QUOTES, 'UTF-8');?>
" /> <?php }?>
<!-- end SEO Webmaster verification --><?php }
}
