/*
*
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0).
*
*  @author Andrey <byalonovich@bk.ru>
*  @copyright  2015-2020 Andrey & co
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/


$(document).ready(function() {

	$(this).on('keyup','#icon-search-popup', function() {
		var filter = $(this).val();
        $(".mce-fontawesome-panel .fticon").each(function() {
            if ($(this).data('css').search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
            }
        });
	});


});