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

    var type = $('select[name=type]');

    var fields = {
      validation : $('select[name^=validation]').closest('.form-wrapper > .form-group'),
      options : $("textarea.opttxt").closest('.form-wrapper > .form-group'),
      iscustomername : $('input[name^=iscustomername]').closest('.form-wrapper > .form-group'),
      iscustomeremail : $('input[name^=iscustomeremail]').closest('.form-wrapper > .form-group'),
      minimaldate : $('input[name^=minimaldate]').closest('.form-wrapper > .form-group'),
      maximaldate: $('input[name^=maximaldate]').closest('.form-wrapper > .form-group'),
      displaydatehint : $('input[name^=displaydatehint]').closest('.form-wrapper > .form-group'),
      allowedextensions : $('input[name^=allowedextensions]').closest('.form-wrapper > .form-group')
    }

    displayHideElements();

    type.change(function () {
        displayHideElements();
    });

    function displayHideElements() {
        var val = $(type).val();
        $.each(fields, function(key, value){
          $(fields[key]).hide();
        });


        if (val == 'select' || val == 'radio' || val == 'checkbox') {
             $(fields.options).show();

        } else if (val == 'text') {
              $(fields.validation).show();
              $(fields.iscustomername).show();
              $(fields.iscustomeremail).show();

        } else if (val == 'textarea') {
            $(fields.validation).show();

        } else if (val == 'password') {

        } else if (val == 'file') {
            $(fields.allowedextensions).show();

        } else if (val == 'date') {
            $(fields.minimaldate).show();
            $(fields.maximaldate).show();
            $(fields.displaydatehint).show();
        }
    }
});
