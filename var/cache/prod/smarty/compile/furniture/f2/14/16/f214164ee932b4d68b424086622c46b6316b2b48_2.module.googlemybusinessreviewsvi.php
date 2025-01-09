<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:54:44
  from 'module:googlemybusinessreviewsvi' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26f4ecac71_42944555',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f214164ee932b4d68b424086622c46b6316b2b48' => 
    array (
      0 => 'module:googlemybusinessreviewsvi',
      1 => 1709033585,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
    'module:googlemybusinessreviews/views/templates/hook/partials/stars.tpl' => 2,
  ),
),false)) {
function content_677c26f4ecac71_42944555 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="Rating__module">
    <div class="section-rating Rating__Container
    <?php if ((isset($_smarty_tpl->tpl_vars['classes']->value))) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['classes']->value, 'classe', false, 'k');
$_smarty_tpl->tpl_vars['classe']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['classe']->value) {
$_smarty_tpl->tpl_vars['classe']->do_else = false;
?>
        <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['classe']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
">

        <div class="Rating__Container__Child Rating__Item Rating__Item__First">
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

        <?php if (count($_smarty_tpl->tpl_vars['reviews']->value) > 0) {?>
            <div class="Rating__Container__Child Rating__Item__Slider">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reviews']->value, 'review', false, 'k');
$_smarty_tpl->tpl_vars['review']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['review']->value) {
$_smarty_tpl->tpl_vars['review']->do_else = false;
?>
                    <div>
                        <div class="Rating__content">
                            <div>
                                <span class="Rating__Author"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['review']->value['author'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
                            </div>
                            <div class="Rating__Item__Stars">
                                <?php $_smarty_tpl->_subTemplateRender('module:googlemybusinessreviews/views/templates/hook/partials/stars.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('rating'=>$_smarty_tpl->tpl_vars['review']->value['rating']), 0, true);
?>
                            </div>
                            <div>
                                <p class="Rating__Item__Review"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['review']->value['text'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</p>
                            </div>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>
    </div>
</div>
<?php }
}
