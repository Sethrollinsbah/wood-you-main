/**
*  @author    Amazzing
*  @copyright Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

$(document).ready(function(){
    var ab_initialClasses = {},
        ab_carousels = {},
        ab_resizeTimer,
        $currentPresentationItems = $('.presentation-preview.current');

    if ($currentPresentationItems.length) {
        $('.presentation-preview').on('click', function(e){
            e.preventDefault();
            $(this).addClass('current').siblings().removeClass('current');
            var html = $(this).find('.full-content').html();
            $(this).closest('.block.presentation-view').find('.main-item').html(html);
        });
        $currentPresentationItems.click();
    }

    // normalize heights in grids
    $('.item-list.grid').each(function(){
        ab_normalizeHeights($(this));
    })

    // prepare carousels
    $('.item-list.carousel').each(function(){
        ab_renderCarousel($(this).closest('.block').data('id'));
    });

    $(window).resize(function(){
		clearTimeout(ab_resizeTimer);
		ab_resizeTimer = setTimeout(function() {
			$('.ab.block').find('.carousel.rendered').removeClass('rendered');
            // reset item heights for normalizing
            $('.ab.block').find('.normalized').removeClass('normalized');
            $('.ab.block').find('.post-item-title, .post-item-content').css('min-height', '');
			for (var id in ab_carousels) {
				ab_renderCarousel(id);
            }
		}, 200);
	});

    function ab_renderCarousel(id){
        var $block = $('.ab.block[data-id="'+id+'"]'),
            $container = $block.find('.carousel'),
            settings = $block.data('carousel-settings'),
            w = $(window).width(),
            itemsNum = 1;
		if ($container.hasClass('rendered') || !settings) {
			return;
        }
		$container.addClass('rendered');
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

		var contanerWidth = $container.closest('.block').innerWidth(),
    		slideWidth = Math.round(contanerWidth / itemsNum);

        settings.min_width = 100;
		if (slideWidth < settings.min_width) {
			itemsNum = parseInt(contanerWidth / settings.min_width);
			slideWidth = parseInt(contanerWidth / itemsNum);
		}

		var params = {
			pager : settings.p == 1 ? true : false,
			controls: parseInt(settings.n) > 0 ? true : false,
			auto: settings.a == 1 ? true : false,
			moveSlides: 1,
			speed: parseInt(settings.s),
			maxSlides: itemsNum,
			minSlides: itemsNum,
			slideWidth: slideWidth,
			responsive: false,
			swipeThreshold: 1,
			useCSS: true,
			oneToOneTouch: false,
			infiniteLoop: settings.l == 1 ? true : false,
            nextText: '<i class="icon-chevron-right"></i>',
            prevText: '<i class="icon-chevron-left"></i>',
			onSliderLoad: function(){
				$container.attr('class', ab_initialClasses[id]+' items-num-'+itemsNum).closest('.bx-wrapper').css('max-width', '100%');
                ab_normalizeHeights($container);
                var $productImageContainer = $container.find('.product-image-container').first();
                if ($productImageContainer.length) {
                    $container.closest('.bx-wrapper').find('.bx-prev, .bx-next').css('top', parseInt(($productImageContainer.outerHeight()/2) + 5)+'px');
                }
			},
            onSlideBefore: function() {
                $block.find('.bx-controls-direction').addClass('no-bg');
            },
            onSlideAfter: function() {
                $block.find('.bx-controls-direction').removeClass('no-bg');
            }
		};

		if (id in ab_carousels)
			ab_carousels[id].reloadSlider(params);
		else {
			if (settings.n == 2 && !isMobile) {
				$block.addClass('n-hover');
			}
			ab_initialClasses[id] = $container.attr('class');
			ab_carousels[id] = $container.bxSlider(params);
		}
	}
});

function ab_normalizeHeights($list) {
    if ($list.hasClass('normalized')) {
        return;
    }
    if ($list.hasClass('post-list')) {
        var thMax = 0,
            chMax = 0;
        // temporary phantom item for normalizing the last row
        $list.append('<div class="first-in-line phantom hidden"></div>');
        $list.children().each(function(){
            if ($(this).hasClass('first-in-line')) {
                $(this).prevAll().not('.normalized').addClass('normalized')
                .find('.post-item-title').css({'min-height': thMax+'px'})
                .siblings('.post-item-content').css({'min-height': chMax+'px'});
                thMax = 0;
                chMax = 0;
                if ($(this).hasClass('phantom')) {
                    $list.addClass('normalized');
                    $(this).remove();
                }
            }
            var th = $(this).find('.post-item-title').outerHeight();
            thMax = th > thMax ? th : thMax;
            var ch = $(this).find('.post-item-content').outerHeight();
            chMax = ch > chMax ? ch : chMax;
        });
    }
}
/* since 1.3.0 */
