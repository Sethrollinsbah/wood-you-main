<?php
/* Smarty version 3.1.48, created on 2025-01-06 14:33:12
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/admin/helpers/form/form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c2ff86bd058_64283860',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '65b0acc23be9e474162284a99dc69eae2b817547' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/ets_abandonedcart/views/templates/admin/helpers/form/form.tpl',
      1 => 1736189402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c2ff86bd058_64283860 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1909045516677c2ff864a7e3_20302805', "legend");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_499440164677c2ff8657121_56508405', "input");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_597664871677c2ff86a8ea7_79302779', "input_row");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1927481656677c2ff86ba814_46414697', "after");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1196050045677c2ff86bc927_86311051', "autoload_tinyMCE");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/form/form.tpl");
}
/* {block "legend"} */
class Block_1909045516677c2ff864a7e3_20302805 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'legend' => 
  array (
    0 => 'Block_1909045516677c2ff864a7e3_20302805',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((isset($_smarty_tpl->tpl_vars['menuTab']->value)) && $_smarty_tpl->tpl_vars['menuTab']->value) {?>
        <div class="panel-heading">
            <div class="ets_abancart_menus">
                <?php if ((isset($_smarty_tpl->tpl_vars['field']->value['image'])) && (isset($_smarty_tpl->tpl_vars['field']->value['title']))) {?><img src="<?php echo $_smarty_tpl->tpl_vars['field']->value['image'];?>
"
                                                                    alt="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['field']->value['title'],'html','UTF-8' ));?>
" /><?php }?>
                <?php if ((isset($_smarty_tpl->tpl_vars['field']->value['icon']))) {?><i class="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['field']->value['icon'],'html','UTF-8' ));?>
"></i><?php }?>
                <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['field']->value['title'],'html','UTF-8' ));?>

            </div>
            <div class="ets_abancart_buttons ets_abancart_cronjob_tab_right">
                <ul class="ets_abancart_cronjob_tabs">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuTab']->value, 'tab', false, 'id_tab');
$_smarty_tpl->tpl_vars['tab']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id_tab']->value => $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->do_else = false;
?>
                        <li class="ets_abancart_cronjob_tab_item" data-tab="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_tab']->value,'html','UTF-8' ));?>
">
                            <?php if ((isset($_smarty_tpl->tpl_vars['tab']->value['icon'])) && $_smarty_tpl->tpl_vars['tab']->value['icon']) {?><i
                                class="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['icon'],'html','UTF-8' ));?>
"></i><?php }?> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['name'],'html','UTF-8' ));?>

                        </li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    <?php } else {
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
}?>
    <?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value['ETS_ABANCART_CONTENT']))) {?>
        <div class="ets-ac-content-design-tab">
            <div class="tab-menu-item active" data-tab="content"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Content','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</div>
            <div class="tab-menu-item" data-tab="design"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Design','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</div>
        </div>
    <?php }
}
}
/* {/block "legend"} */
/* {block "input"} */
class Block_499440164677c2ff8657121_56508405 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input' => 
  array (
    0 => 'Block_499440164677c2ff8657121_56508405',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ($_smarty_tpl->tpl_vars['input']->value['type'] == 'abancart_group') {?>
        <?php $_smarty_tpl->_assignInScope('groups', $_smarty_tpl->tpl_vars['input']->value['values']);?>
        <?php if ($_smarty_tpl->tpl_vars['groups']->value) {?>
            <div class="row">
                <div class="col-lg-6">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="fixed-width-xs"><span class="title_box"><input type="checkbox"
                                                                                      class="all_abancart_group"
                                                                                      name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
[]"
                                                                                      id="all_abancart_group"
                                                                                      onclick="checkDelBoxes(this.form, '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
[]', this.checked)"
                                                                                      value="ALL"/></span></th>
                            <th><label for="all_abancart_group"
                                       class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</label></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ((isset($_smarty_tpl->tpl_vars['groups']->value['query'])) && $_smarty_tpl->tpl_vars['groups']->value['query']) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value['query'], 'group');
$_smarty_tpl->tpl_vars['group']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->do_else = false;
?>
                            <?php if (!empty($_smarty_tpl->tpl_vars['groups']->value['id'])) {
$_smarty_tpl->_assignInScope('id_group', $_smarty_tpl->tpl_vars['group']->value[$_smarty_tpl->tpl_vars['groups']->value['id']]);
} else {
$_smarty_tpl->_assignInScope('id_group', $_smarty_tpl->tpl_vars['group']->value['id_group']);
}?>
                            <?php if ((isset($_smarty_tpl->tpl_vars['id_group']->value)) && $_smarty_tpl->tpl_vars['id_group']->value) {?>
                                <tr>
                                <td><input type="checkbox" name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
[]"
                                           class="groupBox abancart_group"
                                           id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_group']->value,'quotes','UTF-8' ));?>
"
                                           value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_group']->value,'quotes','UTF-8' ));?>
"
                                           <?php if (!empty($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']]) && is_array($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']]) && in_array($_smarty_tpl->tpl_vars['id_group']->value,$_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']]) || $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']] == 'all') {?>checked="checked"<?php }?>/>
                                </td>
                                <td>
                                    <label for="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_group']->value,'quotes','UTF-8' ));?>
"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['group']->value['name'],'html','UTF-8' ));?>
</label>
                                </td>
                                </tr><?php }?>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } else { ?>
            <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No group created','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</p>
        <?php }?>
    <?php } elseif ($_smarty_tpl->tpl_vars['input']->value['name'] == 'ETS_ABANCART_REDUCTION_AMOUNT') {?>
        <div class="row">
            <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'ETS_ABANCART_REDUCTION_AMOUNT') {?>
                <div class="col-lg-4">
                <input type="text" id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
" name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
"
                       value="<?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']]))) {
echo floatval($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']]);
}?>"
                       onchange="this.value = this.value.replace(/,/g, '.');">
                </div><?php }?>
            <div class="col-lg-4">
                <?php if (!empty($_smarty_tpl->tpl_vars['input']->value['currencies'])) {?><select name="ETS_ABANCART_ID_CURRENCY">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['input']->value['currencies'], 'currency');
$_smarty_tpl->tpl_vars['currency']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['currency']->value) {
$_smarty_tpl->tpl_vars['currency']->do_else = false;
?>
                        <option value="<?php echo intval($_smarty_tpl->tpl_vars['currency']->value['id_currency']);?>
"<?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value['ETS_ABANCART_ID_CURRENCY'])) && $_smarty_tpl->tpl_vars['fields_value']->value['ETS_ABANCART_ID_CURRENCY'] == $_smarty_tpl->tpl_vars['currency']->value['id_currency']) {?> selected="selected"<?php }?>><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['currency']->value['iso_code'],'html','UTF-8' ));?>
</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select><?php }?>
            </div>
            <div class="col-lg-4">
                <?php if (!empty($_smarty_tpl->tpl_vars['input']->value['tax'])) {?><select name="ETS_ABANCART_REDUCTION_TAX">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['input']->value['tax'], 'option');
$_smarty_tpl->tpl_vars['option']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->do_else = false;
?>
                        <option value="<?php echo intval($_smarty_tpl->tpl_vars['option']->value['id_option']);?>
"<?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value['ETS_ABANCART_REDUCTION_TAX'])) && $_smarty_tpl->tpl_vars['fields_value']->value['ETS_ABANCART_REDUCTION_TAX'] == $_smarty_tpl->tpl_vars['option']->value['id_option']) {?> selected="selected"<?php }?>><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['name'],'html','UTF-8' ));?>
</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select><?php }?>
            </div>
        </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['input']->value['type'] == 'radios') {?>
        <?php if ((isset($_smarty_tpl->tpl_vars['input']->value['options']['query'])) && $_smarty_tpl->tpl_vars['input']->value['options']['query']) {?>
            <ul style="padding: 0; margin-top: 5px;">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['input']->value['options']['query'], 'option');
$_smarty_tpl->tpl_vars['option']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->do_else = false;
?>
                    <li class="ets_abancart_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));
if ((isset($_smarty_tpl->tpl_vars['option']->value['class'])) && $_smarty_tpl->tpl_vars['option']->value['class']) {?> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['class'],'html','UTF-8' ));
}?>"
                        style="list-style: none; padding-bottom: 5px">
                        <input <?php if ($_smarty_tpl->tpl_vars['option']->value['id_option'] == $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']]) {?> checked="checked" <?php } elseif (!$_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']] && $_smarty_tpl->tpl_vars['input']->value['default'] == $_smarty_tpl->tpl_vars['option']->value['id_option']) {?>checked="checked"<?php }?>
                                style="margin: 2px 7px 0 5px; float: left;"
                                type="radio"
                                id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( (($_smarty_tpl->tpl_vars['input']->value['name']).('_')).($_smarty_tpl->tpl_vars['option']->value['id_option']),'html','UTF-8' ));?>
"
                                value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['id_option'],'html','UTF-8' ));?>
"
                                name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
"/>
                        <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'enabled') {?><span class="enabled_bg"></span><?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['option']->value['id_option'] == 'off') {?>
                            <i class="icon-remove color_danger"></i>
                        <?php }?>
                        <label for="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( (($_smarty_tpl->tpl_vars['input']->value['name']).('_')).($_smarty_tpl->tpl_vars['option']->value['id_option']),'html','UTF-8' ));?>
"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['name'],'html','UTF-8' ));?>

                            <?php if ((isset($_smarty_tpl->tpl_vars['option']->value['cart_rule_link'])) && $_smarty_tpl->tpl_vars['option']->value['cart_rule_link']) {?> <a target="_blank"
                                                                                            href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['cart_rule_link'],'quotes','UTF-8' ));?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Configure discounts','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a><?php }?>
                        </label>
						<?php if ((isset($_smarty_tpl->tpl_vars['option']->value['prestashop_mail_link'])) && $_smarty_tpl->tpl_vars['option']->value['prestashop_mail_link']) {?> <a
                        target="_blank"
                        href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value['prestashop_mail_link'],'quotes','UTF-8' ));?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Configure mail','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a><?php }?>
                    </li>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
        <?php }?>
    <?php } elseif ($_smarty_tpl->tpl_vars['input']->value['name'] == 'ETS_ABANCART_CONTENT') {?>
        <?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

        <?php if ($_GET['controller'] == 'AdminEtsACReminderLeave') {?>
            <div class="ets_ac_reset_popup_box col-lg-12">
                <button type="button" class="btn btn-default ets-ac-btn-reset-content-popup js-ets-ac-btn-reset-content-popup"
                        data-confirm="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If you reset to default, all data changed will not be saved. Do you want to reset to default?','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
">

                            <svg class="w_14 h_14" width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1664 896q0 156-61 298t-164 245-245 164-298 61q-172 0-327-72.5t-264-204.5q-7-10-6.5-22.5t8.5-20.5l137-138q10-9 25-9 16 2 23 12 73 95 179 147t225 52q104 0 198.5-40.5t163.5-109.5 109.5-163.5 40.5-198.5-40.5-198.5-109.5-163.5-163.5-109.5-198.5-40.5q-98 0-188 35.5t-160 101.5l137 138q31 30 14 69-17 40-59 40h-448q-26 0-45-19t-19-45v-448q0-42 40-59 39-17 69 14l130 129q107-101 244.5-156.5t284.5-55.5q156 0 298 61t245 164 164 245 61 298z"/></svg>

                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reset to default','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

                </button>
            </div>
        <?php }?>
        <?php $_smarty_tpl->_assignInScope('typeObj', 'leave');?>
        <?php if ((isset($_smarty_tpl->tpl_vars['hasProductInCart']->value)) && $_smarty_tpl->tpl_vars['hasProductInCart']->value !== 1) {?>
            <input type="hidden" name="etsAcHasProductInCart" id="etsAcHasProductInCart" value="1">
        <?php }?>
        <p class="help-block">
            <?php if ((isset($_smarty_tpl->tpl_vars['short_codes']->value)) && $_smarty_tpl->tpl_vars['short_codes']->value) {?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Available tags','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
 :
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['short_codes']->value, 'short_code', false, 'id_short_code');
$_smarty_tpl->tpl_vars['short_code']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id_short_code']->value => $_smarty_tpl->tpl_vars['short_code']->value) {
$_smarty_tpl->tpl_vars['short_code']->do_else = false;
?>
                    <?php if (empty($_smarty_tpl->tpl_vars['short_code']->value['object']) || in_array($_smarty_tpl->tpl_vars['typeObj']->value,explode(',',$_smarty_tpl->tpl_vars['short_code']->value['object']))) {?>
                        <span class="ets_abancart_short_code group_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['short_code']->value['group'],'html','UTF-8' ));?>
 <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_short_code']->value,'html','UTF-8' ));?>
">
                            <button type="button" class="btn btn-outline-primary sensitive ets_abancart_btn_short_code"
                                    data-short-code="[<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_short_code']->value,'html','UTF-8' ));
if ($_smarty_tpl->tpl_vars['id_short_code']->value == 'lead_form') {?> id=1<?php } elseif ($_smarty_tpl->tpl_vars['id_short_code']->value == 'product_grid') {?> id=&quot;&quot<?php } elseif ($_smarty_tpl->tpl_vars['id_short_code']->value == 'custom_button') {?> href=&quot;#&quot; text=&quot;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click here','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
&quot;<?php }?>]"><i
                                        class="ets_svg_fill_gray ets_svg_hover_fill_white lh_16">
                                    <svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1344 960v-128q0-26-19-45t-45-19h-256v-256q0-26-19-45t-45-19h-128q-26 0-45 19t-19 45v256h-256q-26 0-45 19t-19 45v128q0 26 19 45t45 19h256v256q0 26 19 45t45 19h128q26 0 45-19t19-45v-256h256q26 0 45-19t19-45zm320-64q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"/></svg>
                                </i> [<?php echo $_smarty_tpl->tpl_vars['short_code']->value['name'];?>
]</button>
                        </span>
                    <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
	    </p>
        <?php if ((isset($_smarty_tpl->tpl_vars['short_code_urls']->value)) && $_smarty_tpl->tpl_vars['short_code_urls']->value) {?>
            <?php $_smarty_tpl->_assignInScope('ik', 0);?>
            <p class="help-block">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Available urls','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
 :
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['short_code_urls']->value, 'object', false, 'short_code');
$_smarty_tpl->tpl_vars['object']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['short_code']->value => $_smarty_tpl->tpl_vars['object']->value) {
$_smarty_tpl->tpl_vars['object']->do_else = false;
?>
                    <?php $_smarty_tpl->_assignInScope('ik', $_smarty_tpl->tpl_vars['ik']->value+1);?>
                    <?php if (empty($_smarty_tpl->tpl_vars['object']->value) || in_array($_smarty_tpl->tpl_vars['typeObj']->value,$_smarty_tpl->tpl_vars['object']->value)) {?>
                        <span class="ets_abancart_short_code_url group_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['typeObj']->value,'html','UTF-8' ));?>
 <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['short_code']->value,'html','UTF-8' ));?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click to copy','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
">
							<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['short_code']->value,'html','UTF-8' ));?>

                        </span>
                    <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </p>
        <?php }?>
	<?php } elseif ($_smarty_tpl->tpl_vars['input']->value['name'] == 'ETS_ABANCART_CRONJOB_LOG') {?>
		<textarea readonly id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
" name="_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
"><?php if ((isset($_smarty_tpl->tpl_vars['cronjobLog']->value)) && $_smarty_tpl->tpl_vars['cronjobLog']->value) {
echo $_smarty_tpl->tpl_vars['cronjobLog']->value;
}?></textarea>
		<button class="ets_abancart_clear_log btn btn-default" name="ets_abancart_clear_log" type="button">
			<i class="icon-trash"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Clear log','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

		</button>
    <?php } elseif ($_smarty_tpl->tpl_vars['input']->value['name'] == 'ETS_ABANCART_REDUCTION_PRODUCT') {?>
        <div class="input_group_form">
            <?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value['specific_product_item'])) && $_smarty_tpl->tpl_vars['fields_value']->value['specific_product_item']) {?>
                <?php echo $_smarty_tpl->tpl_vars['fields_value']->value['specific_product_item'];?>

            <?php } else { ?>
                <ul class="ets-ac-products-list-selected" id="ets-ac-products-list-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
"></ul>
            <?php }?>
            <div class="input-group">
                <input class="form-control specific_product ets_ac_specific_product_filter"
                       value=""
                       data-name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
" />
                <input type="hidden" name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']],'html','UTF-8' ));?>
" />
                <span class="input-group-addon"><i class="ets_svg_fill_gray lh_16">
						<svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"/></svg>
					</i></span>
            </div>
        </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['input']->value['name'] == 'ETS_ABANCART_SELECTED_PRODUCT') {?>
        <div class="input-group">
            <input class="form-control selected_product ets_ac_selected_product_filter" data-name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
" />
            <span class="input-group-addon"><i class="ets_svg_fill_gray lh_16">
						<svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"/></svg>
					</i></span>
        </div>
        <?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value['selected_product_list'])) && $_smarty_tpl->tpl_vars['fields_value']->value['selected_product_list']) {?>
            <?php echo $_smarty_tpl->tpl_vars['fields_value']->value['selected_product_list'];?>

        <?php } else { ?>
            <ul class="ets-ac-products-list-selected" id="ets-ac-products-list-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
"></ul>
        <?php }?>
    <?php } elseif ($_smarty_tpl->tpl_vars['input']->value['name'] == 'ETS_ABANCART_PRODUCT_GIFT') {?>
        <div class="input_group_form">
            <?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value['gift_product_item'])) && $_smarty_tpl->tpl_vars['fields_value']->value['gift_product_item']) {?>
                <?php echo $_smarty_tpl->tpl_vars['fields_value']->value['gift_product_item'];?>

            <?php } else { ?>
                <ul class="ets-ac-products-list-selected ets_abancart_result_productlist" id="ets-ac-products-list-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
"></ul>
            <?php }?>
            <div class="input-group">
                <input class="form-control selected_product ets_ac_gift_product_filter"
                       value=""
                       data-name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
" />
                <input type="hidden" name="ETS_ABANCART_GIFT_PRODUCT" value="<?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value['ETS_ABANCART_GIFT_PRODUCT']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fields_value']->value['ETS_ABANCART_GIFT_PRODUCT'],'html','UTF-8' ));
}?>" />
                <input type="hidden" name="ETS_ABANCART_GIFT_PRODUCT_ATTRIBUTE" value="<?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value['ETS_ABANCART_GIFT_PRODUCT_ATTRIBUTE']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fields_value']->value['ETS_ABANCART_GIFT_PRODUCT_ATTRIBUTE'],'html','UTF-8' ));
}?>" />
                <span class="input-group-addon"><i class="ets_svg_fill_gray lh_16">
						<svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"/></svg>
					</i></span>
            </div>
        </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['input']->value['type'] == 'range') {?>
        <input type="hidden" name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
" id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
" value="<?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']]))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']],'html','UTF-8' ));
} elseif ((isset($_smarty_tpl->tpl_vars['input']->value['default']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['default'],'html','UTF-8' ));
}?>">
        <div class="range-wrap ets-ac-range-input ets_range_input">
            <div class="range-wrap ets-ac-range-input">
                <div class="ets_range_input_slide">
                    <span class="range-bubble-bar"></span>
                </div>
                <div class="range-bubble"></div>
                <input type="range" class="range for-target-name" data-name-target="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
" name="range_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
"
                       data-selector-change="<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['selector_change']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['selector_change'],'html','UTF-8' ));
}?>"
                       data-attr-change="<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['attr_change']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['attr_change'],'html','UTF-8' ));
}?>"
                       data-unit="<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['unit']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['unit'],'html','UTF-8' ));
}?>"
                       min="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['min'],'html','UTF-8' ));?>
" max="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['max'],'html','UTF-8' ));?>
"
                       step="<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['step'])) && $_smarty_tpl->tpl_vars['input']->value['step']) {
echo floatval($_smarty_tpl->tpl_vars['input']->value['step']);
} else { ?>1<?php }?>"
                       value="<?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']]))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']],'html','UTF-8' ));
} elseif ((isset($_smarty_tpl->tpl_vars['input']->value['default']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['default'],'html','UTF-8' ));
}?>" />
                <div class="range_title">
                    <span class="min-number"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['min'],'html','UTF-8' ));?>
 <?php if ((isset($_smarty_tpl->tpl_vars['input']->value['unit']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['unit'],'html','UTF-8' ));
}?></span>
                    <span class="max-number"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['max'],'html','UTF-8' ));?>
 <?php if ((isset($_smarty_tpl->tpl_vars['input']->value['unit']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['unit'],'html','UTF-8' ));
}?></span>
                </div>
            </div>
        </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['input']->value['type'] == 'color') {?>
        <div class="form-group">
            <div class="col-lg-5">
                <div class="row">
                    <div class="input-group">
                        <input type="color"
                               data-selector-change="<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['selector_change']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['selector_change'],'html','UTF-8' ));
}?>"
                               data-attr-change="<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['attr_change']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['attr_change'],'html','UTF-8' ));
}?>"
                               data-hex="true"
                                <?php if ((isset($_smarty_tpl->tpl_vars['input']->value['class']))) {?> class="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['class'],'html','UTF-8' ));?>
"
                                <?php } else { ?> class="color mColorPickerInput"<?php }?>
                               name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
"
                               value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']],'html','UTF-8' ));?>
" />
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'ETS_ABANCART_SECURE_TOKEN') {?>
            <div class="input-group">
                <input type="text" name="ets_abancart_secure_token" id="ets_abancart_secure_token" value="<?php if (!empty($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']])) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']],'html','UTF-8' ));
}?>" placeholder="">
                <span class="input-group-addon"><i class="ets_icon_svg">
					<svg width="12" height="12" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M666 481q-60 92-137 273-22-45-37-72.5t-40.5-63.5-51-56.5-63-35-81.5-14.5h-224q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h224q250 0 410 225zm1126 799q0 14-9 23l-320 320q-9 9-23 9-13 0-22.5-9.5t-9.5-22.5v-192q-32 0-85 .5t-81 1-73-1-71-5-64-10.5-63-18.5-58-28.5-59-40-55-53.5-56-69.5q59-93 136-273 22 45 37 72.5t40.5 63.5 51 56.5 63 35 81.5 14.5h256v-192q0-14 9-23t23-9q12 0 24 10l319 319q9 9 9 23zm0-896q0 14-9 23l-320 320q-9 9-23 9-13 0-22.5-9.5t-9.5-22.5v-192h-256q-48 0-87 15t-69 45-51 61.5-45 77.5q-32 62-78 171-29 66-49.5 111t-54 105-64 100-74 83-90 68.5-106.5 42-128 16.5h-224q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h224q48 0 87-15t69-45 51-61.5 45-77.5q32-62 78-171 29-66 49.5-111t54-105 64-100 74-83 90-68.5 106.5-42 128-16.5h256v-192q0-14 9-23t23-9q12 0 24 10l319 319q9 9 9 23z"/></svg>
				</i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Generate','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</span>
            </div>
            <input type="hidden" name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
" id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
" value="<?php if (!empty($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']])) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']],'html','UTF-8' ));
}?>">
        <?php } else { ?>
            <?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

            <?php if (trim($_smarty_tpl->tpl_vars['input']->value['name']) === 'ETS_ABANCART_MAIL_API_KEY') {?>
                <p class="help-block">
                    <a target="_blank" rel="noreferrer noopener" class="ets-ab-config-mail sendgrid" href="https://sendgrid.com/docs/ui/account-and-settings/api-keys/"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'How to get key?','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a>
                    <a target="_blank" rel="noreferrer noopener" class="ets-ab-config-mail sendinblue" href="https://help.brevo.com/hc/en-us/articles/209467485-Create-and-manage-your-API-keys"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'How to get key?','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a>
                </p>
            <?php }?>
            <?php if (trim($_smarty_tpl->tpl_vars['input']->value['name']) === 'ETS_ABANCART_MAIL_SECRET_KEY') {?>
                <p class="help-block">
                    <a target="_blank" rel="noreferrer noopener" class="ets-ab-config-mail mailjet" href="https://app.mailjet.com/account/api_keys"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'How to get key?','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a>
                </p>
            <?php }?>
            <?php if (preg_match('/^ETS_ABANCART_MAIL_SMTP_PORT/',trim($_smarty_tpl->tpl_vars['input']->value['name']))) {?>
                <p class="help-block">
                    <span class="ets-ab-config-mail gmail"><a target="_blank"  href="https://support.google.com/mail/answer/7126229?hl=en" rel="noreferrer noopener"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'How to configure Gmail?','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a>. <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Note that you may need to enable less secure apps to access Gmail in order to send reminder emails via Gmail SMTP:','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
 <a href="https://support.google.com/a/answer/6260879?hl=en" target="_blank" rel="noreferrer noopener"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'See more here!','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a></span>
                    <a target="_blank" class="ets-ab-config-mail yahoomail" href="https://help.yahoo.com/kb/set-imap-sln4075.html" rel="noreferrer noopener"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'How to configure Yahoo mail?','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a>
                    <?php if ((isset($_smarty_tpl->tpl_vars['input']->value['callback_url'])) && $_smarty_tpl->tpl_vars['input']->value['callback_url']) {?>
                    <p class="ets-ab-config-mail hotmail">
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Callback URL','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</span>: <span class="ets-ab-callback-uri"><?php echo $_smarty_tpl->tpl_vars['input']->value['callback_url'];?>
</span>
                    </p><?php }?>
                    <a target="_blank" class="ets-ab-config-mail hotmail" href="https://drive.google.com/file/d/1TF8M0-DSU_AAL6tOs0vZB8uoflqvsfXo/view?usp=sharing" rel="noreferrer noopener"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'How to configure Hotmail?','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a>
                    <?php if ((isset($_smarty_tpl->tpl_vars['input']->value['authorize_url'])) && $_smarty_tpl->tpl_vars['input']->value['authorize_url']) {?>
                    <div class="ets-ab-config-mail hotmail">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['input']->value['authorize_url'];?>
" class="btn btn-default" target="_blank"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Get Access token','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a>
                    </div><?php }?>
                </p>
            <?php }?>
        <?php }?>
    <?php }
}
}
/* {/block "input"} */
/* {block "input_row"} */
class Block_597664871677c2ff86a8ea7_79302779 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input_row' => 
  array (
    0 => 'Block_597664871677c2ff86a8ea7_79302779',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((!(isset($_smarty_tpl->tpl_vars['tabs']->value)) || !$_smarty_tpl->tpl_vars['tabs']->value) && (isset($_smarty_tpl->tpl_vars['menuTab']->value)) && $_smarty_tpl->tpl_vars['menuTab']->value) {
$_smarty_tpl->_assignInScope('tabs', $_smarty_tpl->tpl_vars['menuTab']->value);
}?>
    <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'ETS_ABANCART_CRONJOB_MAIL_LOG') {?>        <div class="form-group ets_abancart_cronjob"<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['tab'])) && $_smarty_tpl->tpl_vars['input']->value['tab']) {?> data-tab-id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['tab'],'html','UTF-8' ));?>
"<?php }?>>
            <div class="alert alert-info" role="alert">
                <p class="alert-text"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Configure cronjob feature to send email for reminder campaign that you added. For example, send reminder email after customer adding products to shopping cart, after customer registering an account, after customer subscribes to newsletter, etc.','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</p>
                <p class="alert-text"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Moreover, you can save failed email to mail queue to run in next time. This will help you resend the errored email within allowed time.','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</p>
            </div>
            <h4><span class="required">*</span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Some important notes:','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</h4>
            <ul>
                <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The recommended frequency is ','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
<b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'once per minute','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</b></li>
                <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'How to set up a cronjob is different depending on your server. If you are using a Cpanel hosting, watch this video for reference: ','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

                    <a target="_blank" href="https://www.youtube.com/watch?v=bmBjg1nD5yA" rel="noreferrer noopener">https://www.youtube.com/watch?v=bmBjg1nD5yA</a><br/>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If your cpanel software is Plesk, see this:','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
 <a href="https://docs.plesk.com/en-US/obsidian/customer-guide/scheduling-tasks.65207/" target="_blank" rel="noreferrer noopener">https://docs.plesk.com/en-US/obsidian/customer-guide/scheduling-tasks.65207/</a><br/>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If your server is Ubuntu, see this:','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
 <a href="https://www.digitalocean.com/community/tutorials/how-to-use-cron-to-automate-tasks-ubuntu-1804" target="_blank" rel="noreferrer noopener">https://www.digitalocean.com/community/tutorials/how-to-use-cron-to-automate-tasks-ubuntu-1804</a><br/>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If your server is Centos, see this:','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
 <a href="https://www.digitalocean.com/community/tutorials/how-to-use-cron-to-automate-tasks-centos-8" target="_blank" rel="noreferrer noopener">https://www.digitalocean.com/community/tutorials/how-to-use-cron-to-automate-tasks-centos-8</a><br/>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You can also contact your hosting provider to ask them for support on setting up the cronjob','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

                </li>
                <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Web push notification only works on Chrome and Firefox (and some other modern web browsers) when HTTPS is enabled','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</li>
                <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Configure SMTP for your website (instead of using default PHP mail() function) to send email better. If you can afford, buy professional marketing email hosting to send a large number of emails','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</li>
            </ul>
        </div>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] != 'ETS_ABANCART_ID_CURRENCY' && $_smarty_tpl->tpl_vars['input']->value['name'] != 'ETS_ABANCART_REDUCTION_TAX' && $_smarty_tpl->tpl_vars['input']->value['name'] != 'ETS_ABANCART_HOURS' && $_smarty_tpl->tpl_vars['input']->value['name'] != 'ETS_ABANCART_MINUTES' && $_smarty_tpl->tpl_vars['input']->value['name'] != 'ETS_ABANCART_SECONDS') {?>
        <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'ETS_ABANCART_MAIL_SERVICE') {?>
            <p class="ets_abancart_title_block alert alert-info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select and configure a mail service to send reminder emails.','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</p>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'ETS_ABANCART_BROWSER_TAB_ENABLED') {?>
            <p class="ets_abancart_title_block alert alert-info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Highlight the number of products in shopping cart on customer\'s browser tab','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</p>
        <?php }?>
        <?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'ETS_ABANCART_HOURS') {?>
        <div class="form-group<?php if ($_smarty_tpl->tpl_vars['input']->value['form_group_class']) {?> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['form_group_class'],'html','UTF-8' ));
}?>">
            <label class="control-label col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Display a reminder message to suggest customers to save their shopping cart if they have not checkout after','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</label>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="input-group">
                            <input type="text" class="" name="ETS_ABANCART_HOURS"
                                   value="<?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']]))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']],'html','UTF-8' ));
}?>"/>
                            <span class="input-group-addon"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hour(s)','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="input-group">
                            <input type="text" class="" name="ETS_ABANCART_MINUTES"
                                   value="<?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value['ETS_ABANCART_MINUTES']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fields_value']->value['ETS_ABANCART_MINUTES'],'html','UTF-8' ));
}?>"/>
                            <span class="input-group-addon"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Minute(s)','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="input-group">
                            <input type="text" class="" name="ETS_ABANCART_SECONDS"
                                   value="<?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value['ETS_ABANCART_SECONDS']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fields_value']->value['ETS_ABANCART_SECONDS'],'html','UTF-8' ));
}?>"/>
                            <span class="input-group-addon"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Second(s)','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'ETS_ABANCART_SECURE_TOKEN') {?>
        <div class="form-group ets_abancart_cronjob ets_abancart_help"<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['tab'])) && $_smarty_tpl->tpl_vars['input']->value['tab']) {?> data-tab-id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['tab'],'html','UTF-8' ));?>
"<?php }?>>
            <label class="control-label col-lg-3"><span
                        class="required">*</span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Setup a cronjob as below on your server to send email reminders automatically','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

            </label>

            <em><span id="ets_abd_cronjob_path"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['path']->value,'quotes','UTF-8' ));?>
</span></em>
            <label class="control-label col-lg-3"><span
                        class="required">*</span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Execute the cronjob manually by clicking on the button below','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

            </label><br>
            <a id="ets_abd_cronjob_link" class="btn btn-default" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['url']->value,'quotes','UTF-8' ));?>
"
               target="_blank"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Execute cronjob manually','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
</a>
        </div>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['input']->value['type'] == 'default_content') {?>
        <?php if ($_GET['controller'] !== 'AdminEtsACReminderLeave') {?>
        <div class="form-group">
            <button type="button" class="btn btn-default ets-ac-btn-reset-content-popup js-ets-ac-btn-reset-content-popup"
                    data-confirm="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If you reset to default, all data changed will not be saved. Do you want to reset to default?','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>
">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reset to default','mod'=>'ets_abandonedcart'),$_smarty_tpl ) );?>

            </button>
        </div>
        <?php }?>
        <textarea class="ets_ac_default_content_has_discount" style="display: none"><?php echo $_smarty_tpl->tpl_vars['input']->value['has_discount'];?>
</textarea>
        <textarea class="ets_ac_default_content_no_discount" style="display: none"><?php echo $_smarty_tpl->tpl_vars['input']->value['no_discount'];?>
</textarea>
        <textarea class="ets_ac_default_content_no_product_in_cart" style="display: none"><?php echo $_smarty_tpl->tpl_vars['input']->value['no_product_in_cart'];?>
</textarea>
        <?php if ((isset($_smarty_tpl->tpl_vars['input']->value['title_has_discount']))) {?>
            <input type="hidden" class="ets_ac_default_title_has_discount" value="<?php echo $_smarty_tpl->tpl_vars['input']->value['title_has_discount'];?>
" />
        <?php }?>
        <?php if ((isset($_smarty_tpl->tpl_vars['input']->value['title_no_discount']))) {?>
            <input type="hidden" class="ets_ac_default_title_no_discount" value="<?php echo $_smarty_tpl->tpl_vars['input']->value['title_no_discount'];?>
" />
        <?php }?>
        <?php if ((isset($_smarty_tpl->tpl_vars['input']->value['title_no_product_in_cart']))) {?>
            <input type="hidden" class="ets_ac_default_title_no_product_in_cart" value="<?php echo $_smarty_tpl->tpl_vars['input']->value['title_no_product_in_cart'];?>
" />
        <?php }?>
    <?php }
}
}
/* {/block "input_row"} */
/* {block "after"} */
class Block_1927481656677c2ff86ba814_46414697 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'after' => 
  array (
    0 => 'Block_1927481656677c2ff86ba814_46414697',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((isset($_GET['controller'])) && $_GET['controller'] && (trim($_GET['controller']) === 'AdminEtsACMailConfigs' || trim($_GET['controller']) === 'AdminEtsACMailServices')) {?>
        <?php echo (Module::getInstanceByName('ets_abandonedcart')->hookDisplayBoFormTestMail());?>

    <?php }
}
}
/* {/block "after"} */
/* {block "autoload_tinyMCE"} */
class Block_1196050045677c2ff86bc927_86311051 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'autoload_tinyMCE' => 
  array (
    0 => 'Block_1196050045677c2ff86bc927_86311051',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    tinySetup({
        editor_selector : 'autoload_rte',
        force_br_newlines : true,
        force_p_newlines : false,
        forced_root_block : '',
        setup : function(ed) {
            ed.on('keyup change blur', function(ed) {
                tinyMCE.triggerSave();
                ets_ab_fn.previewLanguage();
                if($('.ets_abancart_overload.active').length > 0) {
                    ets_ab_fn.prevNext();
                }
            });
            ed.on('change', function(ed) {
                if(!ets_abancart_textarea_changed && ets_abancart_tab_message_active){
                    ets_abancart_textarea_changed = true;
                }
            });
        },
        resize : 'both',
        height : 350
    });
<?php
}
}
/* {/block "autoload_tinyMCE"} */
}
