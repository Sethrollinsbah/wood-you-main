<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:53:56
  from 'module:googlemybusinessreviewsvi' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26c4c1fe48_73332183',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e4b6aecb113e3a4364cf7b37152cf324cae398e0' => 
    array (
      0 => 'module:googlemybusinessreviewsvi',
      1 => 1709033585,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
    'module:googlemybusinessreviews/views/templates/hook/partials/stars.tpl' => 1,
  ),
),false)) {
function content_677c26c4c1fe48_73332183 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="section-rating">
    <?php if ($_smarty_tpl->tpl_vars['rating']->value) {?>
        <div class="Review__Line Review__Align__Center Review__p-1">
            <span class="Review__Rating Review__Image">
                <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['rating']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

            </span>
        </div>
        <div class="Review__Line Review__align__center">
            <span class="Review__Rating_Stars">
              <?php $_smarty_tpl->_subTemplateRender('module:googlemybusinessreviews/views/templates/hook/partials/stars.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('rating'=>$_smarty_tpl->tpl_vars['rating']->value), 0, false);
?>
            </span>
        </div>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['nb_reviews']->value > 0) {?>
        <div class="Review__Line Review__align__center Review__p-1">
            <span class="Review__NB_Rating">
                <a class="Review__Bt" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['place_url']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" target="_blank">
                                                                                                                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'See all our reviews','mod'=>'googlemybusinessreviews'),$_smarty_tpl ) );?>

                 </a>
            </span>
        </div>
    <?php }?>
</div>
<?php }
}
