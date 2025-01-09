/**
*  @author    Prestapro
*  @copyright Prestapro
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

$(function() {
	$('#colorconfigurator .vc-chrome-toggle-btn').wrap('<div class="cc-btn-group"></div>').wrap('<div class="cc-btn-group-top"></div>');
	$('#colorconfigurator .copy-paste-wrap').removeClass('hidden').appendTo('#colorconfigurator .cc-btn-group');
	$('#colorconfigurator .cc-reset-color').removeClass('hidden').appendTo('#colorconfigurator .cc-btn-group-top');
});
