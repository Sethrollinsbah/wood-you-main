<?php
/* Smarty version 3.1.48, created on 2025-01-09 14:44:44
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/whatsappchat/views/templates/hook/bo_customers_grid_action.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6780272c9c9400_89455538',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cddad5bfaf83717b4aa4639cac8b85c7b7a2e272' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/whatsappchat/views/templates/hook/bo_customers_grid_action.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6780272c9c9400_89455538 (Smarty_Internal_Template $_smarty_tpl) {
if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.4','<')) {?>
    <!-- TODO PS13 -->
    
    <?php echo '<script'; ?>
 type="text/javascript">
        if (document.URL.indexOf('id_customer') > 0) {
            $(document).ready(function() {
                var id_customer = '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( (($tmp = @$_GET['id_customer'])===null||$tmp==='' ? 0 : $tmp),'htmlall','UTF-8' ));?>
'
                //var html = ' <a href="#" onclick="customers_list.getCustomerPhoneAndOpenWhatsAppChat(' + id_customer + ');return false;"><img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['this_path_bo']->value,'htmlall','UTF-8' ));?>
views/img/whatsapp-32x32.png" /> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action_whatsappchat']->value,'htmlall','UTF-8' ));?>
</a>';
                //$(this).find("a[href='javascript:window.print()']").append(html);
            });
        } else {
            $(document).ready(function() {
                $('.table.table tbody tr').each(function(){
                    //var html = '<a href="#" onclick="customers_list.getCustomerPhoneAndOpenWhatsAppChat(' + id_customer + ');return false;" ' + 'title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action']->value,'htmlall','UTF-8' ));?>
"><img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['this_path_bo']->value,'htmlall','UTF-8' ));?>
views/img/whatsapp-green.png" width="16px"/></a>';
                    //$(this).find('td:last').append(html);
                })
            });
        }
    <?php echo '</script'; ?>
>
    
<?php } else { ?>
    
    <?php echo '<script'; ?>
 type="text/javascript">
        var customers_list = {
            init: function() {
                customers_list.createListDropdown();
            },
            createListDropdown: function() {
                <?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.5','<')) {?>
                var parent = $('table.table');
                <?php if (mb_strtolower($_GET['tab'], 'UTF-8') == 'adminorders') {?>
                parent = [];
                <?php }?>
                <?php } elseif (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.7.6','>=')) {?>
                var parent = $('table#customer_grid_table');
                <?php } else { ?>
                var parent = $('table.table.customer');
                <?php }?>
                if (parent.length) {
                    var items = parent.find('tbody tr');
                    if (items.length) {
                        items.each(function(){
                            var last_cell = $(this).find('td:last');
                            var checkbox = $(this).find('td:first input[type=checkbox]');
                            if (checkbox.length > 0) {
                                var id_customer = parseInt(checkbox.attr('value'));
                            } else {
                                <?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.6','>=')) {?>
                                var id_customer = parseInt($(this).find('td:first').html());
                                <?php } else { ?>
                                var id_customer = parseInt($(this).find('td.pointer:first').html());
                                <?php }?>
                            }
                            if (last_cell.length) {
                                <?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.6','<')) {?>
                                    var html = '<a href="#" onclick="customers_list.getCustomerPhoneAndOpenWhatsAppChat(' + id_customer + ');return false;" title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action']->value,'htmlall','UTF-8' ));?>
" class="btn btn-default"> <i class="icon-trash"></i> <?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.6','<')) {?><img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['this_path_bo']->value,'htmlall','UTF-8' ));?>
views/img/whatsapp-green.png" width="16px"/><?php } else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action']->value,'htmlall','UTF-8' ));
}?></a>';
                                    <?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.5','<')) {?>
                                        $(this).find('td:last').append(html);
                                    <?php } elseif (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.6','<')) {?>
                                        $(this).find('td:last').append(html);
                                    <?php }?>
                                <?php } else { ?>
                                    var button_container = last_cell.find('.btn-group'),
                                        button = customers_list.createWhatsAppChatButton(id_customer);
                                    if (last_cell.find('.btn-group-action').length) {
                                        <?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.7.6','>=')) {?>
                                        var whatsapp_icon_big = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="24px" height="24px" style="-ms-transform: rotate(360deg);-webkit-transform: rotate(360deg);transform: rotate(360deg);width: 24px;height: 24px;vertical-align: bottom;" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.225 8.225 0 0 1 2.41 5.83c0 4.54-3.7 8.23-8.24 8.23c-1.48 0-2.93-.39-4.19-1.15l-.3-.17l-3.12.82l.83-3.04l-.2-.32a8.188 8.188 0 0 1-1.26-4.38c.01-4.54 3.7-8.24 8.25-8.24M8.53 7.33c-.16 0-.43.06-.66.31c-.22.25-.87.86-.87 2.07c0 1.22.89 2.39 1 2.56c.14.17 1.76 2.67 4.25 3.73c.59.27 1.05.42 1.41.53c.59.19 1.13.16 1.56.1c.48-.07 1.46-.6 1.67-1.18c.21-.58.21-1.07.15-1.18c-.07-.1-.23-.16-.48-.27c-.25-.14-1.47-.74-1.69-.82c-.23-.08-.37-.12-.56.12c-.16.25-.64.81-.78.97c-.15.17-.29.19-.53.07c-.26-.13-1.06-.39-2-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.12-.24-.01-.39.11-.5c.11-.11.27-.29.37-.44c.13-.14.17-.25.25-.41c.08-.17.04-.31-.02-.43c-.06-.11-.56-1.35-.77-1.84c-.2-.48-.4-.42-.56-.43c-.14 0-.3-.01-.47-.01z" fill="#6c868e"></path></svg>';
                                        var toolbar_list = button_container.prepend('<a href="#" class="btn tooltip-link js-link-row-action dropdown-item float-left icon-whatsapp-bo-list" data-toggle="pstooltip" data-confirm-message data-clickable-row onclick="customers_list.getCustomerPhoneAndOpenWhatsAppChat(' + id_customer + ');return false;" title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action']->value,'htmlall','UTF-8' ));?>
" data-placement="top" data-original-title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action']->value,'htmlall','UTF-8' ));?>
">' + whatsapp_icon_big + '</a>');
                                        button_container.find('.dropdown-menu').append(button);
                                        <?php } else { ?>
                                        button_container.find('ul.dropdown-menu').append($(document.createElement('li')).attr({'class': 'divider'}));
                                        button_container.find('ul.dropdown-menu').append(button);
                                        <?php }?>
                                    } else {
                                        button_container.wrap($(document.createElement('div')).addClass('btn-group-action'));
                                        button_container.append(
                                            $(document.createElement('button')).addClass('btn btn-default dropdown-toggle').attr('data-toggle', 'dropdown')
                                                .append($(document.createElement('i')).addClass('icon-caret-down'))
                                        ).append($(document.createElement('ul')).addClass('dropdown-menu').append(button))
                                    }
                                <?php }?>
                            }
                        });
                    }
                }
            },
            createWhatsAppChatButton: function(id_customer) {
            	var whatsapp_icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg);-webkit-transform: rotate(360deg);transform: rotate(360deg);width: 18px;height: 18px;vertical-align: bottom;" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.225 8.225 0 0 1 2.41 5.83c0 4.54-3.7 8.23-8.24 8.23c-1.48 0-2.93-.39-4.19-1.15l-.3-.17l-3.12.82l.83-3.04l-.2-.32a8.188 8.188 0 0 1-1.26-4.38c.01-4.54 3.7-8.24 8.25-8.24M8.53 7.33c-.16 0-.43.06-.66.31c-.22.25-.87.86-.87 2.07c0 1.22.89 2.39 1 2.56c.14.17 1.76 2.67 4.25 3.73c.59.27 1.05.42 1.41.53c.59.19 1.13.16 1.56.1c.48-.07 1.46-.6 1.67-1.18c.21-.58.21-1.07.15-1.18c-.07-.1-.23-.16-.48-.27c-.25-.14-1.47-.74-1.69-.82c-.23-.08-.37-.12-.56.12c-.16.25-.64.81-.78.97c-.15.17-.29.19-.53.07c-.26-.13-1.06-.39-2-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.12-.24-.01-.39.11-.5c.11-.11.27-.29.37-.44c.13-.14.17-.25.25-.41c.08-.17.04-.31-.02-.43c-.06-.11-.56-1.35-.77-1.84c-.2-.48-.4-.42-.56-.43c-.14 0-.3-.01-.47-.01z" fill="#6c868e"></path></svg>';
                <?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.7.6','>=')) {?>
                return $(document.createElement('a')).attr({'href': '#', 'title':'<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action']->value,'htmlall','UTF-8' ));?>
', 'onclick': 'customers_list.getCustomerPhoneAndOpenWhatsAppChat(' + id_customer + ')', 'class': 'btn tooltip-link dropdown-item icon-whatsapp-bo'}).html(whatsapp_icon + ' ' + customers_list.tr('<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action']->value,'htmlall','UTF-8' ));?>
'));
                <?php } else { ?>
                return $(document.createElement('li')).append($(document.createElement('a')).attr({'href': '#', 'title':'<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action']->value,'htmlall','UTF-8' ));?>
', 'onclick': 'customers_list.getCustomerPhoneAndOpenWhatsAppChat(' + id_customer + ')'}).html('<i class="icon-whatsapp"></i> ' + customers_list.tr('<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action']->value,'htmlall','UTF-8' ));?>
')));
                <?php }?>
            },
            tr: function(str) {
                return str;
            },
            getCustomerPhoneAndOpenWhatsAppChat: function(id_customer) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['whatsappchat_admincontroller']->value,"quotes","UTF-8" ));?>
',
                    async: true,
                    cache: false,
                    dataType : "json",
                    data: 'method=getCustomerMobilePhone&id_customer=' + id_customer,
                    success: function(jsonData)
                    {
                        if (jsonData.whatsappchat_response.code == 'OK') {
                            window.open(jsonData.whatsappchat_response.url, "sharer", "toolbar=0,status=0,width=660,height=725");
                        } else if (jsonData.whatsappchat_response.code == 'NOK') {
                            alert(jsonData.whatsappchat_response.msg);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                        if (textStatus != 'abort') {
                            alert("TECHNICAL ERROR: unable to open WhatsApp chat window \n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
                        }
                    }
                });
            },
            openWhatsAppChat: function() {
                window.open("<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['url']->value,'quotes','UTF-8' ));?>
", "sharer", "toolbar=0,status=0,width=660,height=725");
            },
        }
        $(function(){
            customers_list.init();
        });
        if (document.URL.indexOf('id_customer') > 0 || (document.URL.indexOf('/sell/customers/') > 0 && document.URL.indexOf('/view') > 0)) {
            $(document).ready(function(){
                <?php if ($_smarty_tpl->tpl_vars['show_button']->value !== false) {?>
                	<?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.7.6','>=')) {?>
                		var whatsapp_icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="20px" height="20px" style="-ms-transform: rotate(360deg);-webkit-transform: rotate(360deg);transform: rotate(360deg);width: 20px;height: 20px;vertical-align: bottom;" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.225 8.225 0 0 1 2.41 5.83c0 4.54-3.7 8.23-8.24 8.23c-1.48 0-2.93-.39-4.19-1.15l-.3-.17l-3.12.82l.83-3.04l-.2-.32a8.188 8.188 0 0 1-1.26-4.38c.01-4.54 3.7-8.24 8.25-8.24M8.53 7.33c-.16 0-.43.06-.66.31c-.22.25-.87.86-.87 2.07c0 1.22.89 2.39 1 2.56c.14.17 1.76 2.67 4.25 3.73c.59.27 1.05.42 1.41.53c.59.19 1.13.16 1.56.1c.48-.07 1.46-.6 1.67-1.18c.21-.58.21-1.07.15-1.18c-.07-.1-.23-.16-.48-.27c-.25-.14-1.47-.74-1.69-.82c-.23-.08-.37-.12-.56.12c-.16.25-.64.81-.78.97c-.15.17-.29.19-.53.07c-.26-.13-1.06-.39-2-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.12-.24-.01-.39.11-.5c.11-.11.27-.29.37-.44c.13-.14.17-.25.25-.41c.08-.17.04-.31-.02-.43c-.06-.11-.56-1.35-.77-1.84c-.2-.48-.4-.42-.56-.43c-.14 0-.3-.01-.47-.01z" fill="#fff"></path></svg>';
                		//var toolbar = $('.card-header .material-icons:contains("edit"):first').parent().parent().append('<a href="#" class="tooltip-link float-right icon-whatsapp-bo-edit" data-toggle="pstooltip" onclick="customers_list.openWhatsAppChat();return false;" title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action_whatsappchat']->value,'htmlall','UTF-8' ));?>
" data-placement="top" data-original-title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action_whatsappchat']->value,'htmlall','UTF-8' ));?>
">' + whatsapp_icon + '</a>');
                        var id_customer = 0;
                        if (document.URL.indexOf('id_customer') > 0) {
                            id_customer = '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( (($tmp = @$_GET['id_customer'])===null||$tmp==='' ? 0 : $tmp),'htmlall','UTF-8' ));?>
'
                        }
                        //var toolbar_list = $('#customer_grid_table .material-icons:contains("edit")').parent().parent().prepend('<a href="#" class="btn tooltip-link js-link-row-action dropdown-item float-left icon-whatsapp-bo-list" data-toggle="pstooltip" data-confirm-message data-clickable-row onclick="customers_list.getCustomerPhoneAndOpenWhatsAppChat(' + id_customer + ');return false;" title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action_whatsappchat']->value,'htmlall','UTF-8' ));?>
" data-placement="top" data-original-title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action_whatsappchat']->value,'htmlall','UTF-8' ));?>
">' + whatsapp_icon + '</a>');
                        var ref_button = $('div.customer-personal-informations-card h3.card-header a').last();
                        var su_button = ref_button.clone();
                        su_button.attr('data-original-title', '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action_whatsappchat']->value,'htmlall','UTF-8' ));?>
');
                        su_button.removeClass('float-right').addClass('btn btn-primary').html(whatsapp_icon + '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action_whatsappchat']->value,'htmlall','UTF-8' ));?>
');
                        su_button.attr('href', '#');
                        su_button.attr('onclick', "customers_list.getCustomerPhoneAndOpenWhatsAppChat('<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['wa_id_customer']->value,'htmlall','UTF-8' ));?>
');return false;");
                        su_button.attr('target', '_blank');
                        su_button.insertAfter(ref_button);
                        $('.js-superuser-order-view-page').append(html);
                    <?php } elseif (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.6','>=')) {?>
                        var toolbar = $('ul#toolbar-nav').prepend('<li><a id="page-header-desc-customer-whatsapp" class="toolbar_btn" href="#" onclick="customers_list.openWhatsAppChat();return false;" title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action_whatsappchat']->value,'htmlall','UTF-8' ));?>
"><i class="icon-whatsapp bo"></i><div><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action_whatsappchat']->value,'htmlall','UTF-8' ));?>
</div></a></li>');
                    <?php }?>
                    var html = '<a class="btn btn-default" href="#" onclick="customers_list.openWhatsAppChat();return false;" ><i class="icon-whatsapp bo"></i> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action_whatsappchat']->value,'htmlall','UTF-8' ));?>
</a>';
                    <?php if (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.5','<')) {?>
                        $("#content div.col-lg-7 .panel:first .hidden-print:first").prepend(html);
                    <?php } elseif (version_compare((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'1.6','>=')) {?>
                        $("#content div.col-lg-7 .panel:first .hidden-print:first").prepend(html);
                    <?php } else { ?>
                        html = '<a class="toolbar_btn" href="#" onclick="customers_list.openWhatsAppChat();return false;" ><span class="icon-whatsapp bo"><img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['this_path_bo']->value,'htmlall','UTF-8' ));?>
views/img/whatsapp-32x32.png" /></span> <div><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['action_whatsappchat']->value,'htmlall','UTF-8' ));?>
</div></a>';
                        $('ul.cc_button').prepend('<li>' + html + '</li>');
                    <?php }?>
                <?php }?>
            });
        }
    <?php echo '</script'; ?>
>
    
<?php }
}
}
