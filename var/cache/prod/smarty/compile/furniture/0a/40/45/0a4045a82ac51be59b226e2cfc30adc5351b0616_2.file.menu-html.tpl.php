<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:52:01
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/ets_megamenu/views/templates/hook/menu-html.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c2651939de9_33852368',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a4045a82ac51be59b226e2cfc30adc5351b0616' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/themes/furniture/modules/ets_megamenu/views/templates/hook/menu-html.tpl',
      1 => 1709033473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c2651939de9_33852368 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['menus']->value)) && $_smarty_tpl->tpl_vars['menus']->value) {?>
    <ul class="mm_menus_ul <?php if ((isset($_smarty_tpl->tpl_vars['mm_config']->value['ETS_MM_CLICK_TEXT_SHOW_SUB'])) && $_smarty_tpl->tpl_vars['mm_config']->value['ETS_MM_CLICK_TEXT_SHOW_SUB']) {?> clicktext_show_submenu<?php }?> <?php if ((isset($_smarty_tpl->tpl_vars['mm_config']->value['ETS_MM_SHOW_ICON_VERTICAL'])) && !$_smarty_tpl->tpl_vars['mm_config']->value['ETS_MM_SHOW_ICON_VERTICAL']) {?> hide_icon_vertical<?php }?>">
        <li class="close_menu">
            <div class="pull-left">
                <span class="mm_menus_back">
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                </span>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Menu','mod'=>'ets_megamenu'),$_smarty_tpl ) );?>

            </div>
            <div class="pull-right">
                <span class="mm_menus_back_icon"></span>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Back','mod'=>'ets_megamenu'),$_smarty_tpl ) );?>

            </div>
        </li>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menus']->value, 'menu');
$_smarty_tpl->tpl_vars['menu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['menu']->value) {
$_smarty_tpl->tpl_vars['menu']->do_else = false;
?>
            <li class="mm_menus_li<?php if ($_smarty_tpl->tpl_vars['menu']->value['enabled_vertical']) {?> mm_menus_li_tab<?php if ($_smarty_tpl->tpl_vars['menu']->value['menu_ver_hidden_border']) {?> mm_no_border<?php }
if ($_smarty_tpl->tpl_vars['menu']->value['menu_ver_alway_show']) {?> menu_ver_alway_show_sub<?php }
}
if ($_smarty_tpl->tpl_vars['menu']->value['custom_class']) {?> <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['custom_class'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['menu']->value['sub_menu_type']) {?> mm_sub_align_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( strtolower($_smarty_tpl->tpl_vars['menu']->value['sub_menu_type']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['menu']->value['columns']) {?> mm_has_sub<?php }
if ($_smarty_tpl->tpl_vars['menu']->value['display_tabs_in_full_width'] && $_smarty_tpl->tpl_vars['menu']->value['enabled_vertical']) {?> display_tabs_in_full_width<?php }?>"
                <?php if ($_smarty_tpl->tpl_vars['menu']->value['enabled_vertical']) {?>style="width: <?php if ($_smarty_tpl->tpl_vars['menu']->value['menu_item_width']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_item_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>auto;<?php }?>"<?php }?>>
                <a <?php if ((isset($_smarty_tpl->tpl_vars['menu']->value['menu_open_new_tab'])) && $_smarty_tpl->tpl_vars['menu']->value['menu_open_new_tab'] == 1) {?> target="_blank"<?php }?>
                        href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                        style="<?php if ($_smarty_tpl->tpl_vars['menu']->value['enabled_vertical']) {
if ((isset($_smarty_tpl->tpl_vars['menu']->value['menu_ver_text_color'])) && $_smarty_tpl->tpl_vars['menu']->value['menu_ver_text_color']) {?>color:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_ver_text_color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php }
if ((isset($_smarty_tpl->tpl_vars['menu']->value['menu_ver_background_color'])) && $_smarty_tpl->tpl_vars['menu']->value['menu_ver_background_color']) {?>background-color:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_ver_background_color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php }
}
if (Configuration::get('ETS_MM_HEADING_FONT_SIZE')) {?>font-size:<?php echo htmlspecialchars(intval(Configuration::get('ETS_MM_HEADING_FONT_SIZE')), ENT_QUOTES, 'UTF-8');?>
px;<?php }?>">
                    <span class="mm_menu_content_title">
                        <?php if ($_smarty_tpl->tpl_vars['menu']->value['menu_img_link']) {?>
                            <img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_img_link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="" alt="" width="20"/>
                                <?php } elseif ($_smarty_tpl->tpl_vars['menu']->value['menu_icon']) {?>
                            <i class="fa <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_icon'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"></i>
                        <?php }?>
                        <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                        <?php if ($_smarty_tpl->tpl_vars['menu']->value['columns']) {?><span class="mm_arrow"></span><?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['menu']->value['bubble_text']) {?><span class="mm_bubble_text"style="background: <?php if ($_smarty_tpl->tpl_vars['menu']->value['bubble_background_color']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['bubble_background_color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>#FC4444<?php }?>; color: <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['bubble_text_color'],'html','UTF-8' ))) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['bubble_text_color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>#ffffff<?php }?>;"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['bubble_text'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span><?php }?>
                    </span>
                </a>
                <?php if ($_smarty_tpl->tpl_vars['menu']->value['enabled_vertical']) {?>
                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabs']) {?>
                        <span class="arrow closed"></span>
                    <?php }?>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['menu']->value['enabled_vertical']) {?>
                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabs']) {?>
                        <ul class="mm_columns_ul mm_columns_ul_tab <?php if ($_smarty_tpl->tpl_vars['menu']->value['menu_ver_alway_show']) {?> mm_columns_ul_tab_content<?php }?>"
                            style="width:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['sub_menu_max_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php if (Configuration::get('ETS_MM_TEXT_FONT_SIZE')) {?> font-size:<?php echo htmlspecialchars(intval(Configuration::get('ETS_MM_TEXT_FONT_SIZE')), ENT_QUOTES, 'UTF-8');?>
px;<?php }?>">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value['tabs'], 'tab', false, 'key');
$_smarty_tpl->tpl_vars['tab']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->do_else = false;
?>
                                <li class="mm_tabs_li<?php if ($_smarty_tpl->tpl_vars['tab']->value['columns']) {?> <?php if ($_smarty_tpl->tpl_vars['key']->value == 0 && (isset($_smarty_tpl->tpl_vars['menu']->value['menu_ver_alway_open_first'])) && $_smarty_tpl->tpl_vars['menu']->value['menu_ver_alway_open_first']) {?>open <?php }?>mm_tabs_has_content<?php }
if (!$_smarty_tpl->tpl_vars['tab']->value['tab_sub_content_pos']) {?> mm_tab_content_hoz<?php }?> <?php if ((isset($_smarty_tpl->tpl_vars['menu']->value['menu_ver_alway_open_first'])) && $_smarty_tpl->tpl_vars['menu']->value['menu_ver_alway_open_first'] && $_smarty_tpl->tpl_vars['menu']->value['menu_ver_alway_show']) {?>open_first<?php }?> <?php if (!$_smarty_tpl->tpl_vars['menu']->value['menu_ver_alway_show']) {?> ver_alway_hide<?php }?>">
                                    <div class="mm_tab_li_content closed"
                                         style="width: <?php if ($_smarty_tpl->tpl_vars['menu']->value['tab_item_width']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['tab_item_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>230px<?php }?>">
                                        <span class="mm_tab_name mm_tab_toggle<?php if ($_smarty_tpl->tpl_vars['tab']->value['columns']) {?> mm_tab_has_child<?php }?>">
                                            <span class="mm_tab_toggle_title">
                                                <?php if ($_smarty_tpl->tpl_vars['tab']->value['url']) {?>
                                                    <a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                                <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['tab']->value['tab_img_link']) {?>
                                                        <img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['tab_img_link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="" alt="" width="20"/>
                                                    <?php } elseif ($_smarty_tpl->tpl_vars['tab']->value['tab_icon']) {?>
                                                        <i class="fa <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['tab_icon'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"></i>
                                                    <?php }?>
                                                    <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                                    <?php if ($_smarty_tpl->tpl_vars['tab']->value['bubble_text']) {?><span class="mm_bubble_text" style="background: <?php if ($_smarty_tpl->tpl_vars['tab']->value['bubble_background_color']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['bubble_background_color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>#FC4444<?php }?>; color: <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['bubble_text_color'],'html','UTF-8' ))) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['bubble_text_color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>#ffffff<?php }?>;"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['bubble_text'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span><?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['tab']->value['url']) {?>
                                                    </a>
                                                <?php }?>
                                            </span>
                                        </span>
                                    </div>
                                    <?php if ($_smarty_tpl->tpl_vars['tab']->value['columns']) {?>
                                        <ul class="mm_columns_contents_ul "
                                            style="<?php if ($_smarty_tpl->tpl_vars['tab']->value['tab_sub_width']) {?>width: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['tab_sub_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php } else {
if ($_smarty_tpl->tpl_vars['menu']->value['tab_item_width']) {?> width:calc(100% - <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['tab_item_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>230px<?php }?> + 2px);<?php }?> left: <?php if ($_smarty_tpl->tpl_vars['menu']->value['tab_item_width']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['tab_item_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>230px<?php }?>;right: <?php if ($_smarty_tpl->tpl_vars['menu']->value['tab_item_width']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['tab_item_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>230px<?php }?>;<?php if ($_smarty_tpl->tpl_vars['tab']->value['background_image']) {?> background-image:url('<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['background_image'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
');background-position:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['position_background'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tab']->value['columns'], 'column');
$_smarty_tpl->tpl_vars['column']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['column']->value) {
$_smarty_tpl->tpl_vars['column']->do_else = false;
?>
                                                <li class="mm_columns_li column_size_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['column']->value['column_size']), ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['column']->value['is_breaker']) {?>mm_breaker<?php }?> <?php if ($_smarty_tpl->tpl_vars['column']->value['blocks']) {?>mm_has_sub<?php }?>">
                                                    <?php if ((isset($_smarty_tpl->tpl_vars['column']->value['blocks'])) && $_smarty_tpl->tpl_vars['column']->value['blocks']) {?>
                                                        <ul class="mm_blocks_ul">
                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['column']->value['blocks'], 'block');
$_smarty_tpl->tpl_vars['block']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->do_else = false;
?>
                                                                <li data-id-block="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['block']->value['id_block']), ENT_QUOTES, 'UTF-8');?>
"
                                                                    class="mm_blocks_li">
                                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayBlock','block'=>$_smarty_tpl->tpl_vars['block']->value),$_smarty_tpl ) );?>

                                                                </li>
                                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                        </ul>
                                                    <?php }?>
                                                </li>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </ul>
                                    <?php }?>
                                </li>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    <?php }?>
                <?php } else { ?>
                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['columns']) {?><span class="arrow closed"></span><?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['columns']) {?>
                        <ul class="mm_columns_ul"
                            style=" width:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['sub_menu_max_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php if (Configuration::get('ETS_MM_TEXT_FONT_SIZE')) {?> font-size:<?php echo htmlspecialchars(intval(Configuration::get('ETS_MM_TEXT_FONT_SIZE')), ENT_QUOTES, 'UTF-8');?>
px;<?php }
if (!$_smarty_tpl->tpl_vars['menu']->value['enabled_vertical'] && $_smarty_tpl->tpl_vars['menu']->value['background_image']) {?> background-image:url('<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['background_image'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
');background-position:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['position_background'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value['columns'], 'column');
$_smarty_tpl->tpl_vars['column']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['column']->value) {
$_smarty_tpl->tpl_vars['column']->do_else = false;
?>
                                <li class="mm_columns_li column_size_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['column']->value['column_size']), ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['column']->value['is_breaker']) {?>mm_breaker<?php }?> <?php if ($_smarty_tpl->tpl_vars['column']->value['blocks']) {?>mm_has_sub<?php }?>">
                                    <?php if ((isset($_smarty_tpl->tpl_vars['column']->value['blocks'])) && $_smarty_tpl->tpl_vars['column']->value['blocks']) {?>
                                        <ul class="mm_blocks_ul">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['column']->value['blocks'], 'block');
$_smarty_tpl->tpl_vars['block']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->do_else = false;
?>
                                                <li data-id-block="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['block']->value['id_block']), ENT_QUOTES, 'UTF-8');?>
" class="mm_blocks_li">
                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayBlock','block'=>$_smarty_tpl->tpl_vars['block']->value),$_smarty_tpl ) );?>

                                                </li>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </ul>
                                    <?php }?>
                                </li>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    <?php }?>
                <?php }?>
            </li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCustomMenu'),$_smarty_tpl ) );?>

<?php }
echo '<script'; ?>
 type="text/javascript">
    var Days_text = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Day(s)','mod'=>'ets_megamenu','js'=>1),$_smarty_tpl ) );?>
';
    var Hours_text = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hr(s)','mod'=>'ets_megamenu','js'=>1),$_smarty_tpl ) );?>
';
    var Mins_text = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Min(s)','mod'=>'ets_megamenu','js'=>1),$_smarty_tpl ) );?>
';
    var Sec_text = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sec(s)','mod'=>'ets_megamenu','js'=>1),$_smarty_tpl ) );?>
';
<?php echo '</script'; ?>
><?php }
}
