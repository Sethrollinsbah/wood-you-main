<?php
/* Smarty version 3.1.48, created on 2025-01-06 14:33:12
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/admin/menus.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c2ff86faab1_63977159',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '80d98f6e8df0ea50fa7a680e5fb0878dca499275' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/admin/menus.tpl',
      1 => 1736189402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./menu.tpl' => 2,
  ),
),false)) {
function content_677c2ff86faab1_63977159 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_278092143677c2ff86deff8_94620491', 'menu');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1574870790677c2ff86e8f34_75481942', 'breadcrumb');
?>

<?php }
/* {block 'menu'} */
class Block_278092143677c2ff86deff8_94620491 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'menu' => 
  array (
    0 => 'Block_278092143677c2ff86deff8_94620491',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((isset($_smarty_tpl->tpl_vars['menus']->value)) && $_smarty_tpl->tpl_vars['menus']->value) {?>
        <div class="aban_menu_height" style="display: block;height:1px;"></div>
        <div class="aband_group_header_fixed">
            <?php $_smarty_tpl->_assignInScope('_breadcrumb', '');?>
            <ul class="ets_abancart_menus aband_group_header">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menus']->value, 'menu', false, 'id');
$_smarty_tpl->tpl_vars['menu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['menu']->value) {
$_smarty_tpl->tpl_vars['menu']->do_else = false;
?>
                    <li class="ets_abancart_menu_li<?php if (trim($_smarty_tpl->tpl_vars['controller_name']->value) == trim(($_smarty_tpl->tpl_vars['slugTab']->value).($_smarty_tpl->tpl_vars['menu']->value['class'])) || trim($_smarty_tpl->tpl_vars['menu']->value['class']) === 'Campaign' && preg_match('#Reminder#',$_smarty_tpl->tpl_vars['controller_name']->value) || trim($_smarty_tpl->tpl_vars['menu']->value['class']) === 'MailConfigs' && preg_match('#(Mail|Queue|Indexed|Unsubscribed)#',$_smarty_tpl->tpl_vars['controller_name']->value) || trim($_smarty_tpl->tpl_vars['menu']->value['class']) === 'Tracking' && preg_match('#(EmailTracking|DisplayTracking|Discounts|DisplayLog)#',$_smarty_tpl->tpl_vars['controller_name']->value)) {?> active<?php }?>">
                        <?php $_smarty_tpl->_assignInScope('_breadcrumb_first', $_smarty_tpl->tpl_vars['id']->value);?>
                        <?php $_smarty_tpl->_subTemplateRender("file:./menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                        <?php if ((isset($_smarty_tpl->tpl_vars['menu']->value['sub_menus'])) && $_smarty_tpl->tpl_vars['menu']->value['sub_menus']) {?>
                            <ul class="ets_abancart_sub_menus">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value['sub_menus'], 'sub_menu', false, 'id');
$_smarty_tpl->tpl_vars['sub_menu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['sub_menu']->value) {
$_smarty_tpl->tpl_vars['sub_menu']->do_else = false;
?>
                                    <li class="ets_abancart_sub_menu_li<?php if (trim($_smarty_tpl->tpl_vars['controller_name']->value) === trim(($_smarty_tpl->tpl_vars['slugTab']->value).($_smarty_tpl->tpl_vars['sub_menu']->value['class']))) {
$_smarty_tpl->_assignInScope('_breadcrumb', (($_smarty_tpl->tpl_vars['_breadcrumb_first']->value).(',')).($_smarty_tpl->tpl_vars['id']->value));?> active<?php }?>">
                                        <?php $_smarty_tpl->_subTemplateRender("file:./menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('menu'=>$_smarty_tpl->tpl_vars['sub_menu']->value), 0, true);
?>
                                    </li>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ul>
                        <?php } elseif ($_smarty_tpl->tpl_vars['controller_name']->value !== 'AdminEtsACDashboard' && trim($_smarty_tpl->tpl_vars['controller_name']->value) == trim(($_smarty_tpl->tpl_vars['slugTab']->value).($_smarty_tpl->tpl_vars['menu']->value['class']))) {?>
                            <?php $_smarty_tpl->_assignInScope('_breadcrumb', $_smarty_tpl->tpl_vars['id']->value);?>
                            <?php $_smarty_tpl->_assignInScope('onLv2', 1);?>
                        <?php }?>
                    </li>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <li class="ets_abancart_menu_li more_menu">
                    <span class="more_three_dots"></span>
                </li>
            </ul>
        </div>

    <?php }
}
}
/* {/block 'menu'} */
/* {block 'breadcrumb'} */
class Block_1574870790677c2ff86e8f34_75481942 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'breadcrumb' => 
  array (
    0 => 'Block_1574870790677c2ff86e8f34_75481942',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((isset($_smarty_tpl->tpl_vars['isModuleDisabled']->value)) && $_smarty_tpl->tpl_vars['isModuleDisabled']->value) {?>
        <div class="alert alert-warning">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please enable module to use the features of Abandoned Cart Reminder + Auto Email module','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

        </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['_breadcrumb']->value || $_smarty_tpl->tpl_vars['controller_name']->value == 'AdminEtsACCampaign') {?>
        <div class="ets_abancart_breadcrumb">
            <a href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getAdminLink(($_smarty_tpl->tpl_vars['slugTab']->value).('Dashboard'),true),'html','UTF-8' ));?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Home','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
"><span class="breadcrumb"><i class="icon-home"></i></span></a>
            <?php $_smarty_tpl->_assignInScope('dot', " > ");
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['dot']->value,'html','UTF-8' ));?>

            <?php $_smarty_tpl->_assignInScope('_breadcrumb', explode(',',$_smarty_tpl->tpl_vars['_breadcrumb']->value));
$_smarty_tpl->_assignInScope('ik', "0");?>
            <?php if ($_smarty_tpl->tpl_vars['controller_name']->value !== 'AdminEtsACCampaign') {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['_breadcrumb']->value, 'id');
$_smarty_tpl->tpl_vars['id']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value) {
$_smarty_tpl->tpl_vars['id']->do_else = false;
?>
                    <?php $_smarty_tpl->_assignInScope('ik', $_smarty_tpl->tpl_vars['ik']->value+1);?>
                    <?php if ((isset($_smarty_tpl->tpl_vars['menus']->value[$_smarty_tpl->tpl_vars['id']->value])) && $_smarty_tpl->tpl_vars['menus']->value[$_smarty_tpl->tpl_vars['id']->value]) {?>
                        <?php $_smarty_tpl->_assignInScope('menu', $_smarty_tpl->tpl_vars['menus']->value[$_smarty_tpl->tpl_vars['id']->value]);?>
                        <?php if ((isset($_smarty_tpl->tpl_vars['onLv2']->value)) && $_smarty_tpl->tpl_vars['onLv2']->value) {?>
                            <?php if ((isset($_smarty_tpl->tpl_vars['leadFormTitle']->value)) && $_smarty_tpl->tpl_vars['leadFormTitle']->value) {?>
                                <a href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getAdminLink(($_smarty_tpl->tpl_vars['slugTab']->value).($_smarty_tpl->tpl_vars['menu']->value['class']),true),'quotes','UTF-8' ));?>
"><span class="breadcrumb"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['label'],'html','UTF-8' ));?>
</span></a>
                            <?php } else { ?>
                                <span class="breadcrumb"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['label'],'html','UTF-8' ));?>
</span>
                            <?php }?>
                        <?php } else { ?>
                            <a href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getAdminLink(($_smarty_tpl->tpl_vars['slugTab']->value).($_smarty_tpl->tpl_vars['menu']->value['class']),true),'quotes','UTF-8' ));?>
"><span class="breadcrumb"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['label'],'html','UTF-8' ));?>
</span></a>
                        <?php }?>
                    <?php } else { ?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menus']->value, 'menu', false, 'id_menu');
$_smarty_tpl->tpl_vars['menu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id_menu']->value => $_smarty_tpl->tpl_vars['menu']->value) {
$_smarty_tpl->tpl_vars['menu']->do_else = false;
if (!empty($_smarty_tpl->tpl_vars['menu']->value['sub_menus'])) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value['sub_menus'], 'menu2', false, 'id_menu2');
$_smarty_tpl->tpl_vars['menu2']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id_menu2']->value => $_smarty_tpl->tpl_vars['menu2']->value) {
$_smarty_tpl->tpl_vars['menu2']->do_else = false;
?>
                            <?php if ($_smarty_tpl->tpl_vars['id_menu2']->value == $_smarty_tpl->tpl_vars['id']->value) {?>
                                <?php if ((isset($_smarty_tpl->tpl_vars['campaignName']->value)) && $_smarty_tpl->tpl_vars['campaignName']->value) {?><a href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getAdminLink(($_smarty_tpl->tpl_vars['slugTab']->value).($_smarty_tpl->tpl_vars['menu2']->value['class']),true),'quotes','UTF-8' ));?>
"><?php }?>
                                <span class="breadcrumb"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu2']->value['label'],'html','UTF-8' ));?>
</span>
                                <?php if ((isset($_smarty_tpl->tpl_vars['campaignName']->value)) && $_smarty_tpl->tpl_vars['campaignName']->value) {?></a><?php }?>
                            <?php }?>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['ik']->value < count($_smarty_tpl->tpl_vars['_breadcrumb']->value)) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['dot']->value,'html','UTF-8' ));
}?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reminder campaigns','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

            <?php }?>
            <?php if ((isset($_smarty_tpl->tpl_vars['campaignName']->value)) && $_smarty_tpl->tpl_vars['campaignName']->value) {?>
                <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['dot']->value,'html','UTF-8' ));?>

                <span class="breadcrumb"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['campaignName']->value,'html','UTF-8' ));?>
</span>
            <?php }?>
            <?php if ((isset($_smarty_tpl->tpl_vars['leadFormTitle']->value)) && $_smarty_tpl->tpl_vars['leadFormTitle']->value) {?>
                <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['dot']->value,'html','UTF-8' ));?>

                <span class="breadcrumb"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['leadFormTitle']->value,'html','UTF-8' ));?>
</span>
            <?php }?>
        </div>
    <?php }
}
}
/* {/block 'breadcrumb'} */
}
