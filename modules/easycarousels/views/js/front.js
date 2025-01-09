/**
*  @author    Amazzing
*  @copyright Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

$(document).ready(function(){

	var ec_resizeTimer,
		initialClasses = {},
		carousels = {},
		quickViewForced = false,
		compactTabsActivated = false,
		$dynamicCarousels = $('.easycarousels.dynamic'); // .easycarousels.dynamic wrapper with ajaxpath is generated in easycarousels.php->displayNativeHook

	activateTabs();
	prepareVisibleCarousels();

	if ($dynamicCarousels.length) {
		$dynamicCarousels.each(function(){
			var $el = $(this);
			$.ajax({
				type: 'POST',
				url: $(this).attr('data-ajaxpath'),
				dataType : 'json',
				success: function(r) {
					$el.replaceWith(utf8_decode(r.carousels_html));
					activateTabs();
					prepareVisibleCarousels();
				},
				error: function(r) {
					console.warn($(r.responseText).text() || r.responseText);
				}
			});
		});
	}

	function activateTabs(){

		$('.ec-tabs').each(function(){
			if ($(this).hasClass('activated')) {
				return;
			}
			$(this).addClass('activated').find('.ec-tab-link').on('click', function(e){
				e.preventDefault();
				var $parent = $(this).parent(),
					txt = $(this).text(),
					id = $(this).attr('href').replace('#', '');
				if ($parent.hasClass('active') || !id) {
					return;
				}
				$parent.addClass('active').siblings().removeClass('active');
				$parent.closest('ul').addClass('closed').find('.responsive_tabs_selection span').html(txt);
				$('#'+id).addClass('active').siblings('.ec-tab-pane').removeClass('active');
				renderCarousel(id);
			});
			$(this).find('.responsive_tabs_selection').on('click', function(){
				var closed = $(this).parent().hasClass('closed');
				$('.ec-tabs').addClass('closed'); // close all available compact tabs on page
				if (closed) {
					$(this).closest('.ec-tabs').removeClass('closed');
				}
			});
			if (!compactTabsActivated) {
				$(document).on('click', function(e) {
					var $clicked = $(e.target);
					if (!$clicked.parents().hasClass('ec-tabs')) {
						$('.ec-tabs').addClass('closed');
					}
				});
				compactTabsActivated = 1;
			}
		});
	}

	// carousels should be re-rendered on first accordion click
	$('.column').find('.carousel_block').find('.title_block').on('click', function(){
		if (!$(this).hasClass('carousel-is-ready') && $(this).hasClass('active')) {
			var $carousel = $(this).closest('.easycarousel');
			$carousel.find('.rendered').removeClass('rendered');
			renderCarousel($(this).closest('.easycarousel').attr('id'));
			$(this).addClass('carousel-is-ready');
		}
	});

	if (!is_17) {
		// .carousel_title.active is used in column accordion
		$('.column').on('click', 'h3.carousel_title.active', function(){
			renderCarousel($(this).parent().attr('id'));
		});
	}

	function prepareVisibleCarousels(){
		$('.c_container:visible').each(function(){
			renderCarousel($(this).closest('.easycarousel').attr('id'));
			if ($(this).closest('.column').length){
				if ($(this).closest('.easycarousel').hasClass('carousel_block'))
					$(this).closest('.easycarousel').addClass('block');
				if ($(this).closest('.column').hasClass('accordion'))
					try {accordion('disable'); accordion('enable');}catch(e){};
			}
		});
		if (!is_17 && $('.easycarousels .quick-view').length && !quickViewForced) {
			try {quick_view(); quickViewForced = true;}catch(e){};
		}
	}

	$(window).resize(function(){
		clearTimeout(ec_resizeTimer);
		ec_resizeTimer = setTimeout(function() {
			$('.c_container.rendered').removeClass('rendered');
			$('.in_tabs.compact').removeClass('compact');
			for (var id in carousels) {
				if (carousels[id].is(':visible')) {
					renderCarousel(id);
				}
			}
		}, 200);
	});

	function renderCarousel(id){
		var $container = $('#'+id).find('.c_container'),
			settings = $container.data('settings');

		if ($container.hasClass('rendered')) {
			var arrowsShown = $container.closest('.bx-wrapper').find('.bx-prev:visible').length ? true : false;
			$container.closest('.in_tabs').toggleClass('arrows-shown', arrowsShown);
			return;
		} else if (!$container.hasClass('carousel')) {
			carousels[id] = $container;
			$container.closest('.in_tabs').removeClass('arrows-shown');
			compactTabs($container.closest('.in_tabs'));
			if (settings.normalize_h == 1) {
				normalizeHeights($container);
			}
		}

		$container.addClass('rendered');

		if ($container.hasClass('simple-grid')) {
			return;
		}

		var w = $(window).width(),
			itemsNum = 1;
		if (w > 1199)
			itemsNum = settings.i;
		else if (w > 991)
			itemsNum = settings.i_1200;
		else if (w > 767)
			itemsNum = settings.i_992;
		else if (w > 479)
			itemsNum = settings.i_768;
		else if (w < 480)
			itemsNum = settings.i_480;

		var wrapperWidth = $container.closest('.c-wrapper').innerWidth(),
			slideWidth = parseInt(wrapperWidth / itemsNum);

		if (slideWidth < settings.min_width) {
			itemsNum = parseInt(wrapperWidth / settings.min_width);
			slideWidth = parseInt(wrapperWidth / itemsNum);
		}

		if ($container.hasClass('scroll-x')) {
			$container.find('.c_col').css('width', slideWidth+'px');
		} else {
			var loop = $container.find('.c_col').length <= itemsNum ? 0 : settings.l;
			var params = {
				pager : settings.p == 1 ? true : false,
				controls: settings.n == 1 ? true : false,
				auto: settings.a == 1 ? true : false,
				autoHover: settings.ah == 1 ? true : false,
				moveSlides: parseInt(settings.m),
				speed: parseInt(settings.s),
				maxSlides: itemsNum,
				minSlides: itemsNum,
				slideWidth: slideWidth,
				responsive: false,
				swipeThreshold: 50,
				useCSS: true,
				oneToOneTouch: false,
				infiniteLoop: loop == 1 ? true : false,
				onSliderLoad: function(){
					$container.attr('class', initialClasses[id]+' items-num-'+itemsNum).closest('.bx-wrapper')
					.css({'max-width': '100%'}).find('.bx-viewport').css({'height': ''});
					if (settings.normalize_h == 1) {
						normalizeHeights($container);
					}
					var arrowsShown = settings.n && $container.find('.c_col').length > itemsNum;
					$container.closest('.in_tabs').toggleClass('arrows-shown', arrowsShown);
					compactTabs($container.closest('.in_tabs'));
				},
				onSlideAfter: function ($slideElement) {
					$slideElement.addClass('current').siblings('.current').removeClass('current');
				}
			};

			if (id in carousels)
				carousels[id].reloadSlider(params);
			else {
				if (settings.n == 1 && settings.n_hover == 1 && !isMobile) {
					$container.addClass('n-hover');
				}
				initialClasses[id] = $container.attr('class');
				carousels[id] = $container.bxSlider(params);
			}
		}
	}

	function compactTabs($tabsContainer) {
		if ($tabsContainer.hasClass('compact_on') && !$tabsContainer.hasClass('compact')) {
			var $tabList = $tabsContainer.find('ul.ec-tabs');
			var $lastLi = $tabList.find('li.carousel_title').last();
			var $firstLi = $tabList.find('li.carousel_title').first();
			if ($lastLi.prev().hasClass('carousel_title') && $lastLi.offset().top != $firstLi.offset().top) {
				$tabList.closest('.in_tabs').addClass('compact');
			}
		}
	}

	function normalizeHeights($container) {

		if ($container.hasClass('scroll-x') && typeof window.ec_loaded == 'undefined') {
			// before window is loaded, heights of multiline containers are not calculated properly
			$(window).on('load', function(){
				window.ec_loaded = 1;
				normalizeHeights($container);
			});
			return;
		}
		var hMax = 0,
			selector = '.'+(is_17 ? 'thumbnail' : 'product')+'-container';
		$container.find('.c_col').each(function() {
			$(this).find(selector).each(function() {
				var h = $(this).outerHeight();
				hMax = h > hMax ? h : hMax;
			});
			if (!$(this).next('.c_col').length) {
				$container.find(selector).each(function(){
					$(this).css('min-height', hMax+'px');
				});
			}
		});
	}

	function utf8_decode (utfstr) {
		var res = '';
		for (var i = 0; i < utfstr.length;) {
			var c = utfstr.charCodeAt(i);
			if (c < 128){
				res += String.fromCharCode(c);
				i++;
			} else if((c > 191) && (c < 224))			{
				var c1 = utfstr.charCodeAt(i+1);
				res += String.fromCharCode(((c & 31) << 6) | (c1 & 63));
				i += 2;
			} else {
				var c1 = utfstr.charCodeAt(i+1);
				var c2 = utfstr.charCodeAt(i+2);
				res += String.fromCharCode(((c & 15) << 12) | ((c1 & 63) << 6) | (c2 & 63));
				i += 3;
			}
		}
		return res;
	}
});
/* since 2.5.0 */
