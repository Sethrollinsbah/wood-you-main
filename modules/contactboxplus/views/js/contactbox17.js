/*
 * 2007-2015 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 Chimon Sultan
 * @license All right reserved
 */

 /**
 * Display a messageDialog with different buttons including a callback for each one
 * @param {string} question
 * @param {mixed} title Optional title for the dialog box. Send false if you don't want any title
 * @param {object} buttons Associative array containg a list of {buttonCaption: callbackFunctionName, ...}. Use an empty space instead of function name for no callback
 * @param {mixed} otherParams Optional data sent to the callback function
 */
var fancyChooseBox = fancyChooseBox || function(question, title, buttons, otherParams)
{
    var msg, funcName, action;
    msg = '';
    if (title)
        msg = "<h1 class='h1'>" + title + "</h1><hr><p>" + question + "</p>";
    msg += "<br/><p class=\"submit\" style=\"text-align:right;\">";
    var i = 0;
    for (var caption in buttons) {
        if (!buttons.hasOwnProperty(caption)) continue;
        funcName = buttons[caption];
        if (typeof otherParams == 'undefined') otherParams = 0;
        otherParams = escape(JSON.stringify(otherParams));
        action = funcName ? "$.fancybox.close();window['" + funcName + "'](JSON.parse(unescape('" + otherParams + "')), " + i + ")" : "$.fancybox.close()";
      msg += '<button type="submit" class="button btn btn-primary button-medium" style="margin-right: 5px;" value="true" onclick="' + action + '" >';
      msg += '<span>' + caption + '</span></button>'
        i++;
    }
    msg += "</p>";
    if(!!$.prototype.fancybox)
        $.fancybox(msg, {'autoDimensions': false, 'width': 500, 'height': 'auto', 'openEffect': 'none', 'closeEffect': 'none'});
}

$(document).ready(function () {

    $('.open-message-form').fancybox({
        'autoSize': false,
        'width': 660,
        'height': 'auto',
        'hideOnContentClick': false,
        'titleShow': false
    });
    //binds to onchange event of the file input field
    $('#ajax-contact input[type="file"]').bind('change', function() {
        if(this.files[0] && this.files[0].size > ctbx_max_filesize){
            $('.fancybox-inner #submitMessage').addClass('disabled');
            $('.fancybox-inner #submitMessage').prop('disabled', true);
            $('.fancybox-inner #ajax-contact ul').html('');
            $('.fancybox-inner #ajax-contact ul').append('<li>' + ctbx_file_too_large + '</li>');
            $('.fancybox-inner #message_form_error').slideDown('slow');
        } else {
            $('.fancybox-inner .form-group').removeClass('form-ok');
            $('.fancybox-inner #submitMessage').removeClass('disabled');
            $('.fancybox-inner #submitMessage').prop('disabled', false);
            $('.fancybox-inner #ajax-contact ul').html('');
            $('.fancybox-inner #message_form_error').slideUp('slow');
        }
    });
});


$(document).on('click', '#ajax-contact .closefb', function (e) {
    e.preventDefault();
    $.fancybox.close();
});


$(document).on('click', '#submitMessage', function (e) {
    // Kill default behaviour
    e.preventDefault();

    $('.fancybox-inner #submitMessage').addClass('disabled');
    $('.fancybox-inner #submitMessage span').html(ctbx_m_sending);

    var formData = new FormData($('#ajax-contact').get(0));

    $.ajax({
        url: ctbx_controller,
        data: formData,
        type: 'POST',
        processData: false,
        contentType: false,
        headers: {"cache-control": "no-cache"},
        dataType: "json",
        success: function (data) {
            if (data.result) {
                $.fancybox.close();

                // Reset the sending button
                $('.fancybox-inner .form-group').removeClass('form-ok');
                $('.fancybox-inner #submitMessage').removeClass('disabled');
                $('.fancybox-inner #submitMessage span').html(ctbx_m_send);

                // Clean error messages
                $('.fancybox-inner #ajax-contact ul').html('');
                $('.fancybox-inner #message_form_error').hide();

                // Reset the form
                $('#ajax-contact')[0].reset();

                var buttons = {};
                //new
                buttons[ctbx_productmessage_ok] = $.fancybox.close();
                fancyChooseBox(ctbx_message_text, ctbx_message_title, buttons);


            }
            else {
                $('.fancybox-inner #ajax-contact ul').html('');
                $.each(data.errors, function (index, value) {
                    $('.fancybox-inner #ajax-contact ul').append('<li>' + value + '</li>');
                });
                $('.fancybox-inner #message_form_error').slideDown('slow');
                $('.fancybox-inner #submitMessage').removeClass('disabled');
                $('.fancybox-inner #submitMessage span').html(ctbx_m_send);
            }
        },

        error: function () {
            $('.fancybox-inner #ajax-contact ul').html('');
            $('.fancybox-inner #ajax-contact ul').append('<li>An error as occurred</li>');

            $('.fancybox-inner #message_form_error').slideDown('slow');
            $('.fancybox-inner #submitMessage').removeClass('disabled');
            $('.fancybox-inner #submitMessage span').html(ctbx_m_send);

        }
    });
});
