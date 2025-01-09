<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:54:55
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/contactboxplus/views/templates/hook/cboxplus_form17.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26ff1e4231_15482386',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9c22fec46aeb0972149b706b53630c8f8100e2bf' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/contactboxplus/views/templates/hook/cboxplus_form17.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c26ff1e4231_15482386 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/u695283169/domains/woodyoubahamas.com/public_html/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),1=>array('file'=>'/home/u695283169/domains/woodyoubahamas.com/public_html/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>

<!-- start contactboxplus module -->
<!-- Fancybox -->
<div style="display: none;">
    <div id="cbp_message_form">
         <form id="ajax-contact" class="ajax-contact" enctype="multipart/form-data">
            <h1 class="page-subheading h1">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send a message','mod'=>'contactboxplus'),$_smarty_tpl ) );?>

            </h1>
            <hr>
            <div class="row">
                <?php if ((isset($_smarty_tpl->tpl_vars['product']->value)) && $_smarty_tpl->tpl_vars['product']->value) {?>
                    <div class="product clearfix  col-xs-12 col-sm-3">

                        <img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value->link_rewrite,$_smarty_tpl->tpl_vars['cover']->value['id_image'],'medium_default'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                             width="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['mediumSize']->value['width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                             alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->name,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="image"/>

                        <div class="product_desc">
                            <p class="product_name">
                                <strong><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->name,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</strong>
                            </p>
                        </div>
                    </div>
                <?php }?>
                <div class="message_form_content col-xs-12 col-sm-9">

                    <div id="message_form_error" class="error alert alert-danger"
                         style="display: none; padding: 15px 25px">
                        <ul></ul>
                    </div>

                    <div class="row">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cbp_fields']->value, 'cbp_field', false, 'nbkey');
$_smarty_tpl->tpl_vars['cbp_field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['nbkey']->value => $_smarty_tpl->tpl_vars['cbp_field']->value) {
$_smarty_tpl->tpl_vars['cbp_field']->do_else = false;
?>
                            <?php $_smarty_tpl->_assignInScope('key', $_smarty_tpl->tpl_vars['cbp_field']->value['id_cbp_field']);?>
                            <?php $_smarty_tpl->_assignInScope('type', $_smarty_tpl->tpl_vars['cbp_field']->value['type']);?>
                            <?php $_smarty_tpl->_assignInScope('width', $_smarty_tpl->tpl_vars['cbp_field']->value['width']);?>
                            <?php $_smarty_tpl->_assignInScope('validate', $_smarty_tpl->tpl_vars['cbp_field']->value['validation']);?>
                            <?php $_smarty_tpl->_assignInScope('description', $_smarty_tpl->tpl_vars['cbp_field']->value['description']);?>
                            <?php $_smarty_tpl->_assignInScope('options', explode("\r\n",$_smarty_tpl->tpl_vars['cbp_field']->value['options']));?>
                            <?php $_smarty_tpl->_assignInScope('required', '');?>
                            <?php $_smarty_tpl->_assignInScope('minimaldate', $_smarty_tpl->tpl_vars['cbp_field']->value['minimaldate']);?>
                            <?php $_smarty_tpl->_assignInScope('maximaldate', $_smarty_tpl->tpl_vars['cbp_field']->value['maximaldate']);?>
                            <?php $_smarty_tpl->_assignInScope('displaydatehint', $_smarty_tpl->tpl_vars['cbp_field']->value['displaydatehint']);?>
                            <?php $_smarty_tpl->_assignInScope('allowedextensions', $_smarty_tpl->tpl_vars['cbp_field']->value['allowedextensions']);?>
                            <div class=" form-group col-sm-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['width']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                <label for="field_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['key']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                    <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cbp_field']->value['label'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                    <?php if ($_smarty_tpl->tpl_vars['cbp_field']->value['required'] == 1) {
$_smarty_tpl->_assignInScope('required', "required");?>
                                        <sup class="required">*</sup>
                                    <?php }?>
                                </label>

                                <?php if ($_smarty_tpl->tpl_vars['type']->value == 'text') {?>
                                    <input type="text" name="field_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['key']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                           data-validate="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['validate']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                           class="form-control grey validate"  <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['required']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
/>
                               <?php } elseif ($_smarty_tpl->tpl_vars['type']->value == 'file') {?>
                                   <input type="file" name="field_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['key']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                          class="form-control grey"  <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['required']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
/>
                                   <p class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Max size','mod'=>'contactboxplus'),$_smarty_tpl ) );?>
: <b><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['max_filesize']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mb','mod'=>'contactboxplus'),$_smarty_tpl ) );?>
</b>
                                       <?php if ($_smarty_tpl->tpl_vars['allowedextensions']->value != '') {?>
                                         <br><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Allowed extensions','mod'=>'contactboxplus'),$_smarty_tpl ) );?>
: <b><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['allowedextensions']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</b>
                                       <?php }?>
                                   </p>
                                <?php } elseif ($_smarty_tpl->tpl_vars['type']->value == 'date') {?>
                                    <input type="date" name="field_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['key']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                           data-validate="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['validate']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                           class="form-control grey validate"  <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['required']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                           min="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['minimaldate']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                           max="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['maximaldate']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"/>
                                           <!--<p class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Between','mod'=>'contactboxplus'),$_smarty_tpl ) );?>
 <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['minimaldate']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'and','mod'=>'contactboxplus'),$_smarty_tpl ) );?>
 <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['maximaldate']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</p>-->
                                            <?php if ($_smarty_tpl->tpl_vars['displaydatehint']->value == 1) {?>
                                              <p class="help-block">
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Choose a date','mod'=>'contactboxplus'),$_smarty_tpl ) );?>


                                                <?php if ($_smarty_tpl->tpl_vars['maximaldate']->value != '0000-00-00' && $_smarty_tpl->tpl_vars['minimaldate']->value != '0000-00-00') {?>
                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'between','mod'=>'contactboxplus'),$_smarty_tpl ) );?>
 <b><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( smarty_modifier_date_format($_smarty_tpl->tpl_vars['minimaldate']->value,$_smarty_tpl->tpl_vars['js_custom_vars']->value['prestashop']['language']['date_format_lite']),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</b>
                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'and','mod'=>'contactboxplus'),$_smarty_tpl ) );?>
 <b><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( smarty_modifier_date_format($_smarty_tpl->tpl_vars['maximaldate']->value,$_smarty_tpl->tpl_vars['js_custom_vars']->value['prestashop']['language']['date_format_lite']),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</b>
                                                 <?php } elseif ($_smarty_tpl->tpl_vars['minimaldate']->value != '0000-00-00') {?>
                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'after','mod'=>'contactboxplus'),$_smarty_tpl ) );?>
 <b><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( smarty_modifier_date_format($_smarty_tpl->tpl_vars['minimaldate']->value,$_smarty_tpl->tpl_vars['js_custom_vars']->value['prestashop']['language']['date_format_lite']),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</b>
                                                  <?php } elseif ($_smarty_tpl->tpl_vars['maximaldate']->value != '0000-00-00') {?>
                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'before','mod'=>'contactboxplus'),$_smarty_tpl ) );?>
 <b><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( smarty_modifier_date_format($_smarty_tpl->tpl_vars['maximaldate']->value,$_smarty_tpl->tpl_vars['js_custom_vars']->value['prestashop']['language']['date_format_lite']),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</b>
                                                  <?php }?>
                                            </p>
                                            <?php }?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['type']->value == 'textarea') {?>
                                    <textarea name="field_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['key']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                              data-validate="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['validate']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                              class="form-control grey validate"  <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['required']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
></textarea>
                                <?php } elseif ($_smarty_tpl->tpl_vars['type']->value == 'password') {?>
                                    <input type="password" name="field_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['key']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                           data-validate="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['validate']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                           class="form-control grey validate"   <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['required']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
/>
                                <?php } elseif ($_smarty_tpl->tpl_vars['type']->value == 'select') {?>
                                    <select name="field_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['key']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                            class="form-control grey" <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['required']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
>
                                        <?php if ($_smarty_tpl->tpl_vars['cbp_field']->value['required'] == 0) {?>
                                            <option></option>
                                        <?php }?>

                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['options']->value, 'option', false, 'key');
$_smarty_tpl->tpl_vars['option']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->do_else = false;
?>
                                            <option value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['option']->value),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </select>
                                <?php } elseif ($_smarty_tpl->tpl_vars['type']->value == 'radio') {?>
                                    <div class="radio_options">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['options']->value, 'option', false, 'rkey');
$_smarty_tpl->tpl_vars['option']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rkey']->value => $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->do_else = false;
?>
                                            <label>
                                                <input type="radio" name="field_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['key']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                                                       value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( smarty_modifier_replace(preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['option']->value),' ',''),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                            </label>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </div>
                                <?php } elseif ($_smarty_tpl->tpl_vars['type']->value == 'checkbox') {?>
                                    <div class="radio_options">

                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['options']->value, 'option', false, 'ckey');
$_smarty_tpl->tpl_vars['option']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ckey']->value => $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->do_else = false;
?>
                                            <label>
                                                <input type="checkbox" name="field_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['key']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
[]"
                                                       value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                                <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['option']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                            </label>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </div>
                                <?php }?>

                                <p class="help-block"><?php if ($_smarty_tpl->tpl_vars['description']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['description']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?></p>

                            </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>



                    </div>

                    <div id="new_message_form_footer">
                        <input id="name_product_message_send" name="product_name" type="hidden"
                               value='<?php if ((isset($_smarty_tpl->tpl_vars['product']->value)) && $_smarty_tpl->tpl_vars['product']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->name,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>'/>
                        <input id="id_product_message_send" name="id_product" type="hidden"
                               value='<?php if ((isset($_smarty_tpl->tpl_vars['product']->value)) && $_smarty_tpl->tpl_vars['product']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->id,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>'/>
                        <input id="ref_product_message_send" name="cbp_ref_product" type="hidden"
                               value='<?php if ((isset($_smarty_tpl->tpl_vars['product']->value)) && $_smarty_tpl->tpl_vars['product']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->reference,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>'/>
                        <input id="url_product_message_send" name="product_url" type="hidden"
                               value='<?php if ((isset($_smarty_tpl->tpl_vars['cbp_url']->value)) && $_smarty_tpl->tpl_vars['cbp_url']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cbp_url']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>'/>

                        <hr>
                        <?php if ((isset($_smarty_tpl->tpl_vars['gdpr_enabled']->value)) && $_smarty_tpl->tpl_vars['gdpr_enabled']->value) {?>
                        <div class="radio_options">


                                <label>
                                    <input type="checkbox" name="gdpr_consent"
                                           value="consented">

                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'I have read and accept the','mod'=>'contactboxplus'),$_smarty_tpl ) );?>

                                    <a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['privacy_policy_url']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" target="_blank">
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Privacy Policy','mod'=>'contactboxplus'),$_smarty_tpl ) );?>
 <sup>*</sup>
                                  </a>
                                </label>

                        </div>
                        <hr>

                        <?php }?>

                        <p class="required"><sup>*</sup> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Required fields','mod'=>'contactboxplus'),$_smarty_tpl ) );?>
</p>

                         <?php if ((isset($_smarty_tpl->tpl_vars['recaptcha_enabled']->value)) && $_smarty_tpl->tpl_vars['recaptcha_enabled']->value) {?>
                        <div class="g-recaptcha" data-sitekey="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['recaptcha_site_key']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"></div>

                        <?php }?>

                        <p class="">
                            <button id="submitMessage" name="submitMessage" type="submit"
                                    class="btn button btn-primary button-small">
                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send','mod'=>'contactboxplus'),$_smarty_tpl ) );?>
</span>
                            </button>
                            &nbsp;
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'or','mod'=>'contactboxplus'),$_smarty_tpl ) );?>
&nbsp;
                            <a class="closefb" href="#">
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel','mod'=>'contactboxplus'),$_smarty_tpl ) );?>

                            </a>
                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<!-- End fancybox -->


<!-- end contactboxplus module -->
<?php }
}
