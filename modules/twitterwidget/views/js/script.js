/**
*  @author    Prestapro
*  @copyright Prestapro
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

$(document).ready(function(){
	var twitterCarousels = {};
	var initialClasses = {};
	prepareCarousels();

	function prepareCarousels()
	{
		$('.twitter-carousel').not('.rendered').each(function(i){
			var $container = $(this);
			var id = this.id || 'tw_carousel_'+i;
			var params = {
				pager : false,
				controls: true,
				speed: 200,
				responsive: true,
				swipeThreshold: 1,
				useCSS: true,
				oneToOneTouch: false,
				infiniteLoop: 1,
				nextText: '',
 				prevText: '',
				onSliderLoad: function(){
					$container.attr('class', initialClasses[id]+' rendered');
					// $container.attr('class', initialClasses[id]+' rendered').closest('.bx-wrapper').css('max-width', '100%').children('.bx-viewport').css('height', 'auto').find('.item_twits').css({'display':'inline-block','float':''});
				 },
			};
			if (id in twitterCarousels)
				twitterCarousels[id].reloadSlider(params);
			else {
				initialClasses[id] = $container.attr('class');
				twitterCarousels[id] = $container.bxSlider(params);
			}
		});
	}

	$(document).on('click', '.twitter-box .bx-controls-direction a', function(){
		var $el = $('.twitter-bird').find('i')
		$el.addClass('shake animated');
		setTimeout(function(){
			$el.removeClass('shake animated');
		},1200);
	});
});
