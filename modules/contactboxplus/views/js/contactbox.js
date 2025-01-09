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

$(document).ready(function () {

    $('.open-message-form').fancybox({
        'autoSize': false,
        'width': 660,
        'height': 'auto',
        'hideOnContentClick': false,
        'titleShow': false
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
    var version = 1;
    var name = $('.fancybox-inner #ajax-contact #name').val();
    var message = $('.fancybox-inner #ajax-contact #message').val();
    var email = $('.fancybox-inner #ajax-contact #email').val();
    var phone = $('.fancybox-inner #ajax-contact #phone').val();
    var company = $('.fancybox-inner #ajax-contact #company').val();
    var product_url = $('.fancybox-inner #ajax-contact #url_product_message_send').val();
    var product_name = $('.fancybox-inner #ajax-contact #name_product_message_send').val();
    var id_product = $('.fancybox-inner #ajax-contact #id_product_message_send').val();
    var cb_data = {
        'name': name, 'email': email, 'phone': phone, 'company': company,
        'product_url': product_url, 'product_name': product_name, 'version': version,
        'id_product': id_product, 'message': message
    };

    $.ajax({
        url: baseDir + ctbx_controller,
        //data: $('.fancybox-inner #ajax-contact').serialize(),
        data: $('#ajax-contact').serialize(),
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        dataType: "json",
        success: function (data) {
            if (data.result) {
                $.fancybox.close();
                var buttons = {};
                //new
                buttons[ctbx_productmessage_ok] = $.fancybox.close();
                fancyChooseBox(ctbx_message_text, ctbx_message_title, buttons);
                $('.fancybox-inner #message').val('');
                $('.fancybox-inner .form-group').removeClass('form-ok');
                $('.fancybox-inner #submitMessage').removeClass('disabled');
                $('.fancybox-inner #submitMessage span').html(ctbx_m_send);
                $('.fancybox-inner #ajax-contact ul').html('');
                $('.fancybox-inner #message_form_error').hide();

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
