/**
*  @author    Amazzing
*  @copyright Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

var cbResizeTimer,
	cbCarousels = {};

$(document).ready(function(){

	$('.cb-wrapper').find('.carousel').each(function(){
		renderCarousel($(this), false);
	});

	$(window).resize(function(){
		clearTimeout(cbResizeTimer);
		cbResizeTimer = setTimeout(function() {
			for (var idWrapper in cbCarousels){
				renderCarousel(cbCarousels[idWrapper], true);
			}
		}, 200);
	});

	function renderCarousel($container, reload){
		var settings = $container.data('settings');
		var w = $(window).width();
		var itemsNum = 1;
		if (w > 1199) {
			itemsNum = settings.i;
		} else if (w > 991) {
			itemsNum = settings.i_1200;
		} else if (w > 767) {
			itemsNum = settings.i_992;
		} else if (w > 479) {
			itemsNum = settings.i_768;
		} else if (w < 480) {
			itemsNum = settings.i_480;
		}
		var slideWidth = Math.round($container.parent().innerWidth() / itemsNum);
		moveSlides = (settings.m == 0 || parseInt(settings.m) > parseInt(itemsNum)) ? itemsNum : settings.m;
		var params = {
			pager : settings.p == 1,
			controls: parseInt(settings.n) > 0,
			infiniteLoop: settings.l == 1,
			auto: settings.t != 1 && settings.a == 1,
			autoHover: settings.ah == 1,
			pause: settings.ps,
			ticker: settings.t == 1,
			moveSlides: moveSlides,
			speed: settings.s,
			maxSlides: itemsNum,
			minSlides: itemsNum,
			slideWidth: slideWidth,
			responsive: false,
			swipeThreshold: 1,
			useCSS: true,
			oneToOneTouch: false,
			prevText: '',
			nextText: '',
			onSliderLoad: function() {
				addClasses($container.find('.banner-item').not('.bx-clone').first(), itemsNum);
		    },
			onSlideAfter: function ($slideElement, prevIndex, newIndex) {
				addClasses($container.find('.banner-item').not('.bx-clone').eq(newIndex * moveSlides), itemsNum);
			},
		}
		if (reload) {
			$container.reloadSlider(params);
		} else {
			var idWrapper = $container.closest('.cb-wrapper').data('wrapper');
			cbCarousels[idWrapper] = $container.bxSlider(params);
			if (settings.n == 2 && !isMobile) {
				$container.closest('.cb-wrapper').addClass('n-hover');
			}
		}
		$container.closest('.bx-wrapper').css('max-width', '100%');
	}

	function addClasses($firstItem, itemsNum) {
		$firstItem.siblings().andSelf().removeClass('first last middle');
		$firstItem.addClass('first');
		var middleEq = 	parseInt(itemsNum/2);
		$firstItem.nextAll().andSelf().eq(middleEq).addClass('middle');
		if (itemsNum % 2 == 0) {
			$firstItem.nextAll().andSelf().eq(middleEq - 1).addClass('middle');
		}
		$firstItem.nextAll().andSelf().eq(itemsNum - 1).addClass('last');
	}
});
/* since 2.9.1 */
