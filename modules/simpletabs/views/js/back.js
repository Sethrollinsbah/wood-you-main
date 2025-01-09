/**
*  @author    Prestapro
*  @copyright Prestapro
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

var st_form = $('#simpletabs-form'),
    st_button_edit = $('#simpletabs-list .simpletabs-edit'),
    st_button_delete = $('#simpletabs-list .simpletabs-delete'),
    st_button_add = $('#simpletabs-new-tab'),
    st_button_submit = $('#simpletabs-submit-button'),
    st_input_title_default = $('.simpletabs-title.default').eq(0),
    st_input_title = $('.simpletabs-title:not(.default)'),
    st_textarea = $('.simpletabs-content'),
    st_status_switch = $('.simpletabs-status'),
    st_status_switch_on = $('#simpletabs-status-on'),
    st_category_title = $('#form_simpletabs_categories li.more > .checkbox'),
    st_input_id_tab = $('#simpletabs-id-tab'),
    st_form_active = $('#simpletabs-submit'),
    st_redirect = st_hash_index = st_product = null,
    st_submit_disabled = true;

function resetFields() {
    st_form.find('input[type=text]', 'textarea').each(function() {
        $(this).val(null);
    });
    st_form.find('input[type=checkbox], input[type=radio]').each(function() {
        $(this).prop('checked', false);
    });
    st_status_switch_on.prop('checked', true);
    st_input_id_tab.val(null);
    $(st_textarea).each(function() {
        tinyMCE.get($(this).attr('id')).setContent('');
    });
}

function toggleSubmit(input) {
    if ($.trim(input.val()) !== '') {
        st_submit_disabled = false;
    } else {
        st_submit_disabled = true;
    }

    st_button_submit.prop('disabled', st_submit_disabled);
}

function toggleForm(mode) {
    if (mode === 'off') {
        st_button_add.find('i').html('add_circle');
        st_button_add.find('span').each(function() {
            $(this).html($(this).data('label-add'));
        });
        st_form.hide();
        st_form_active.val(null);
        st_input_title_default.prop('required', false);
        resetFields();
    } else if (mode === 'on') {
        st_button_add.find('i').html('remove_circle');
        st_button_add.find('span').each(function() {
            $(this).html($(this).data('label-cancel'));
        });
        st_input_title_default.prop('required', true);
        st_form.show();
    }

    toggleSubmit(st_input_title_default);
}

function manageTab(mode, id_tab, id_product) {
    $.ajax({
        method: 'POST',
        url: simpletabs_dir + 'ajax.php',
        data: {
            mode: mode,
            secure_key: secure_key,
            id_tab: id_tab,
            id_product: id_product
        },
        dataType: 'json'
    }).done(function(json) {
        switch (mode) {
            case 'edit':
                resetFields();
                $.each(json.title, function(i, value) {
                    $('#simpletabs-title_' + i).val(value);
                });
                $.each(json.content, function(i, value) {
                    if ($('#simpletabs-content_' + i).length) {
                        tinyMCE.get('simpletabs-content_' + i).setContent(value);
                    }
                });
                st_status_switch.each(function() {
                    if ($(this).val() == json.status) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });
                $.each(json.products, function(i, values) {
                    st_product = $('#simpletabs-product-' + values.id_product);

                    if (values.status !== null) {
                       st_product.prop('checked', true);
                    } else {
                       st_product.prop('checked', false);
                    }
                });
                st_input_id_tab.val(id_tab);
                toggleForm('on');
                toggleSubmit(st_input_title_default);
                break;
            case 'delete':
                $('#simpletabs-tab-' + id_tab).remove();
                break;
            default:
                break;
        }
    });
}

function toggleCategory(element) {
    if (element.hasClass('more')) {
        element.removeClass('more').addClass('less');
        element.children('ul').eq(0).css('display', 'block');
    } else {
        element.removeClass('less').addClass('more');
        element.children('ul').eq(0).css('display', 'none');
    }
}

$(function() {
    st_form.hide();
    st_redirect = window.location.href;
    st_hash_index = st_redirect.indexOf('#');

    if (st_hash_index !== -1) {
        st_redirect = st_redirect.substr(0, st_hash_index);
    }

    st_button_submit.attr('data-redirect', st_redirect);

    st_button_edit.each(function() {
        $(this).click(function() {
            manageTab('edit', $(this).data('id-tab'), id_product);
        });
    });

    st_button_delete.each(function() {
        $(this).click(function(event) {
            event.preventDefault();

            if (window.confirm($(this).data('confirmation'))) {
                manageTab('delete', $(this).data('id-tab'), id_product);
            }
        });
    });

    st_button_add.click(function(event) {
        event.preventDefault();

        if (st_form.is(':visible')) {
            toggleForm('off');
        } else {
            toggleForm('on');
        }
    });

    st_input_title_default.keyup(function() {
        toggleSubmit($(this));
    });

    st_category_title.each(function() {
        $(this).click(function(e) {
            if (e.target !== this) {
                return;
            }

            toggleCategory($(this).parent());
        });
    });

    st_button_submit.click(function(event) {
        if ($.trim(st_input_title_default.val()) !== '') {
            st_input_title.each(function() {
                if ($.trim($(this).val()) === '') {
                    $(this).val(st_input_title_default.val());
                }
            });

            tinyMCE.triggerSave();
            st_form_active.val(1);
        } else {
            alert(st_input_title_default.data('warning'));
            return false;
        }
    });
});
