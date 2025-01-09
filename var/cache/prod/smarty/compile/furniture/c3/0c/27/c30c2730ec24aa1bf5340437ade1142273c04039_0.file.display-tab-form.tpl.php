<?php
/* Smarty version 3.1.48, created on 2025-01-07 10:42:17
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-tab-form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d4b595bcd92_68423518',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c30c2730ec24aa1bf5340437ade1142273c04039' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/simpletabs/views/templates/admin/display-tab-form.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d4b595bcd92_68423518 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="simpletabs-form" class="m-t-3">
    <h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add or modify a tab','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</h2>

    <div class="row form-group">
        <div class="col-lg-3">
            <label class="form-control-label required"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Title','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</label>
        </div>
        <div class="col-lg-8">
            <div class="translations tabbable" id="simpletabs-title">
                <div class="translationsFields tab-content">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
                    <div class="translationsFields-simpletabs-title_<?php echo intval($_smarty_tpl->tpl_vars['language']->value['id_lang']);?>
 tab-pane translation-label-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['iso_code'],'html','UTF-8' ));
if ($_smarty_tpl->tpl_vars['language']->value['id_lang'] == $_smarty_tpl->tpl_vars['default_form_language']->value) {?> active<?php }?>">
                        <input type="text" id="simpletabs-title_<?php echo intval($_smarty_tpl->tpl_vars['language']->value['id_lang']);?>
" name="simpletabs_title_<?php echo intval($_smarty_tpl->tpl_vars['language']->value['id_lang']);?>
" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter tab title','mod'=>'simpletabs'),$_smarty_tpl ) );?>
" class="simpletabs-title edit js-edit form-control<?php if ($_smarty_tpl->tpl_vars['language']->value['id_lang'] == $_smarty_tpl->tpl_vars['default_form_language']->value) {?> default<?php }?>" value="<?php if ((isset($_smarty_tpl->tpl_vars['values']->value[$_smarty_tpl->tpl_vars['language']->value['id_lang']])) && (isset($_smarty_tpl->tpl_vars['values']->value['title'][$_smarty_tpl->tpl_vars['language']->value['id_lang']]))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['values']->value['title'][$_smarty_tpl->tpl_vars['language']->value['id_lang']],'html','UTF-8' ));
}?>" data-warning="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tab title field (%s) is required','sprintf'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['iso_code'],'html','UTF-8' )),'mod'=>'simpletabs'),$_smarty_tpl ) );?>
">
                    </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-3">
            <label class="form-control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Content','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</label>
        </div>
        <div class="col-lg-8">
            <div class="translations tabbable" id="simpletabs-content">
                <div class="translationsFields tab-content">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
                    <div class="translationsFields-simpletabs-content_<?php echo intval($_smarty_tpl->tpl_vars['language']->value['id_lang']);?>
 tab-pane translation-label-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['iso_code'],'html','UTF-8' ));
if ($_smarty_tpl->tpl_vars['language']->value['id_lang'] == $_smarty_tpl->tpl_vars['default_form_language']->value) {?> active<?php }?>">
                        <textarea id="simpletabs-content_<?php echo intval($_smarty_tpl->tpl_vars['language']->value['id_lang']);?>
" name="simpletabs_content_<?php echo intval($_smarty_tpl->tpl_vars['language']->value['id_lang']);?>
" class="simpletabs-content autoload_rte form-control" aria-hidden="true"><?php if ((isset($_smarty_tpl->tpl_vars['values']->value[$_smarty_tpl->tpl_vars['language']->value['id_lang']])) && (isset($_smarty_tpl->tpl_vars['values']->value['title'][$_smarty_tpl->tpl_vars['language']->value['id_lang']]))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['values']->value['title'][$_smarty_tpl->tpl_vars['language']->value['id_lang']],'html','UTF-8' ));
}?></textarea>
                    </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-3">
            <label class="form-control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enabled','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</label>
        </div>
        <div class="col-lg-8">
            <div class="radio">
                <label><input type="radio" id="simpletabs-status-on" class="simpletabs-status" name="simpletabs_status" value="1"<?php if (!(isset($_smarty_tpl->tpl_vars['values']->value['status'])) || $_smarty_tpl->tpl_vars['values']->value['status'] == 1) {?> checked="checked"<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</label>
            </div>
            <div class="radio">
                <label><input type="radio" id="simpletabs-status-off" class="simpletabs-status" name="simpletabs_status" value="0"<?php if ((isset($_smarty_tpl->tpl_vars['values']->value['status'])) && $_smarty_tpl->tpl_vars['values']->value['status'] == 0) {?> checked="checked"<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</label>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-3">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Additional products','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</label>
        </div>
        <div class="col-lg-8">
            <?php echo $_smarty_tpl->tpl_vars['product_list']->value;?>
        </div>

        <div class="alert alert-info col-lg-8 col-lg-offset-3" role="alert">
            <i class="material-icons">help</i><p class="alert-text"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select additional products this tab will be assigned to','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</p>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-3">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Additional categories','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</label>
        </div>
        <div class="col-lg-8">
            <?php echo $_smarty_tpl->tpl_vars['categories']->value;?>
        </div>

        <div class="alert alert-info col-lg-8 col-lg-offset-3" role="alert">
            <i class="material-icons">help</i><p class="alert-text"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This tab will be assigned to all products in selected categories','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</p>
        </div>
    </div>

    <button type="reset" name="ResetBtn" id="ResetBtn" onclick="$('#simpletabs-new-tab').click();" class="btn btn-action"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel','mod'=>'simpletabs'),$_smarty_tpl ) );?>
</button>

    <input id="simpletabs-id-tab" type="hidden" name="simpletabs_id_tab" value="" />
    <input id="simpletabs-submit" type="hidden" name="simpletabs_submit" value="" />
</div><?php }
}
