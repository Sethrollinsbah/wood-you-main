/**
 * Copyright 2022 LÍNEA GRÁFICA E.C.E S.L.
 *
 * @author    Línea Gráfica E.C.E. S.L.
 * @copyright Lineagrafica.es - Línea Gráfica E.C.E. S.L. all rights reserved.
 * @license   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

var lggoogleanalytics = {};

window.addEventListener('load',function() {
    lggoogleanalytics = {
        response: null,

        pcommon: {
            'ajax': 1,        
            // 'module_name': 'lggoogleanalytics',
            // 'configure': 'lggoogleanalytics',
            'token': lggoogleanalytics_token,
            'rand': new Date().getTime()
        },

        ajaxCall: function (params, callback) {
            if (typeof params.data != 'undefined') {
                var contentType = false;
                var processData = false;
                var data = params.data;
                delete params.data;
                Object.assign(params, this.pcommon);
                $.each(params, function(index, value) {
                    data.append(index, value);
                });
            } else {
                var contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
                var processData = true;
                var data = {};
                Object.assign(data, this.pcommon, params);
            }
            return $.ajax({
                'url': lggoogleanalytics_link,
                'method': 'post',
                'dataType': 'json',
                'contentType': contentType,
                'processData': processData,
                'cache': false,
                'data': data,
                'success': function (data) {
                    if (typeof callback != 'undefined') {                       
                        eval(callback + '(params, data)');
                    }
                },
                'error': function (data) {
                    console.log(data)
                    //alert("leer error");
                }            
            });
        },
        addToCart(params, data) {
            if (typeof data.value != 'undefined') {
                gtag('event', 'add_to_cart', data);
            }
        },
    };
});

$( document ).ajaxComplete(function( event, xhr, settings ) {
    if (typeof settings.data !== 'undefined' && (
        (settings.data.search('add-to-cart') > -1 || settings.data.search('add') > -1) ||
        (
            settings.data.search('controller=cart') > -1 &&
            settings.data.search('id_product=') > -1
        ))
        && settings.data.search('getProductPopupAdded') == -1
    ) {
        var id_product = 0;
        var id_product_attribute = 0;
        var regex_p = /[&|?]?id_product=([0-9]+)/gm
        var match_p = regex_p.exec(settings.data);
        if (match_p != null && typeof match_p[1] != 'undefined') {
            id_product = match_p[1];
        }
        var regex_pa = /[&|?]?id_product_attribute|ipa=([0-9]+)/gm
        var match_pa = regex_pa.exec(settings.data);
        if (match_pa != null && typeof match_pa[1] != 'undefined') {
            id_product_attribute = match_pa[1];
        }
        if ($('input[name="qty"]').length) {
            var quantity = $('input[name="qty"]').val();
        } else {
            var quantity = 1;
        }
        if (id_product > 0) {
            var params = {
                'action': 'getProduct',
                'id_product': id_product,
                'id_product_attribute': id_product_attribute,
                'quantity': quantity
            };
            //console.log('lggoogleanalytics.addToCart');
            lggoogleanalytics.ajaxCall(params, 'lggoogleanalytics.addToCart');
        }
    }
});
