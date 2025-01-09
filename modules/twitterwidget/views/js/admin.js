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
$(document).ready(function(){
	$('ul.nav.nav-pills').prepend('<li class="li-docs"></li>');
	$('#module-documentation').prependTo('.li-docs').removeClass('hidden');
	$('.display-twitter-tooltip').insertAfter($('#hook_displayTwitter').closest('label')).removeClass('hidden');
});
