/**
*  @author    Amazzing
*  @copyright Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*
*  NOTE: It is not recommended to modify this file.
*  If you want to add custom scripts, you should add an override named custom.js in your theme subfolder:
*      PS 1.6: /themes/your_theme/css/modules/testimonialswithavatars/views/js/custom.js
*      PS 1.7: /themes/your_theme/modules/testimonialswithavatars/views/js/custom.js
*
*/

var taResizeTimer;

$(document).ready(function(){

	var carousels = {};
	var initialClasses = {};

	// activating hooks in editable areas
	for (c = 1; c <= 3; c++){
		var orig_value = '{hook h=\'testimonials'+c+'\'}';
		var new_value = '<div class="dynamic_testimonials" data-hook="testimonials'+c+'"></div>';
		replaceTextInDom(orig_value, new_value);
	}

	$('.dynamic_testimonials').each(function(){
		var $el = $(this);
		var hook = $el.data('hook');
		$.ajax({
			type: 'POST',
			url: twa_ajax_path,
			dataType : 'json',
			data: {
				hook: hook,
				ajaxAction: 'loadDynamicTestimonials'
			},
			success: function(r) {
				// console.dir(r);
				$el.html(r.html);
				prepareCarousels();
				normalizeColumns(true);
			},
			error: function(r) {
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	});

	prepareCarousels();
	normalizeColumns(true);

	$('.twa_posts').on('click', ' .expand', function(e){
		e.preventDefault();
		var $post = $(this).closest('.post');
		$post.toggleClass('expanded');
		if ($post.parent().hasClass('grid')) {
			adjustHeighsInRow($post);
		}
	});

	function adjustHeighsInRow($post){
		var $postsInRow = $post.siblings('[data-row="'+$post.attr('data-row')+'"]').andSelf(),
			h = 0;
		$postsInRow.css('min-height', '');
		$postsInRow.filter('.expanded').each(function(){
			var postH = $(this).outerHeight();
			h = postH > h ? postH : h;
		});
		if (h) {
			$postsInRow.css('min-height', (h+1)+'px'); // 1 extra pixel for possible decimals
		}
	}

	$(window).resize(function(){
		clearTimeout(taResizeTimer);
		taResizeTimer = setTimeout(function() {
			$('.twa_posts.rendered').removeClass('rendered');
			prepareCarousels();
		}, 200);
	});

	function prepareCarousels(){
		$('.twa_in_hook.carousel').find('.twa_posts').not('.rendered').each(function(){
			var $container = $(this),
				id = this.id,
				itemsNum = 2;
			if ($(window).width() < 980 || $container.closest('.twa_in_hook').innerWidth() < 700)
				itemsNum = 1;
			var slideWidth = Math.round($container.closest('.twa_in_hook').innerWidth() / itemsNum);
			var params = {
				pager : true,
				controls: false,
				moveSlides: 1,
				speed: 200,
				maxSlides: itemsNum,
				minSlides: itemsNum,
				slideWidth: slideWidth,
				responsive: false,
				swipeThreshold: 1,
				useCSS: true,
				oneToOneTouch: false,
				infiniteLoop: 1,
				onSliderLoad: function(){
					$container.attr('class', initialClasses[id]+' rendered items-num-'+itemsNum).closest('.bx-wrapper').css('max-width', '100%')
					.children('.bx-viewport').css('height', 'auto');
					// normalize heights in carousel
					var carouselHeights = [];
					$container.find('.post_content').each(function(){
						if ($(this).prop('scrollHeight') - 1 > $(this).prop('offsetHeight'))
							$(this).closest('.post').addClass('expandable');
						carouselHeights.push($(this).outerHeight());
						if ($(this).closest('.post').next().length < 1){
							var h = Math.max.apply(Math,carouselHeights);
							$(this).css('height', h+'px').closest('.post').prevAll().find('.post_content').css('height', h+'px');
							carouselHeights = [];
						}
					});
				 },
			};

			if (id in carousels) {
				carousels[id].reloadSlider(params);
			} else {
				initialClasses[id] = $container.attr('class');
				carousels[id] = $container.bxSlider(params);
			}
		});
	}
});

function normalizeColumns(keepAdjusted){

	if (!keepAdjusted) {
		$('.post.adjusted').removeClass('adjusted');
	}

	var $elements = $('.twa_posts.grid, .twa_posts.list').find('.content_wrapper').not('.adjusted'),
		colsNum = 0,
		currentCol = 0,
		currentRow = 1,
		rowHeights = [];

	$elements.each(function(){
		if (!colsNum)
			colsNum = Math.floor($(this).closest('.twa_posts').outerWidth() / $(this).outerWidth());
		var $post_content = $(this).find('.post_content');
		// in some cases 1 extra pixel is added to scrollHeight
		if ($post_content.prop('scrollHeight') - 1 > $post_content.prop('offsetHeight')) {
			$(this).closest('.post').addClass('expandable');
		}

		rowHeights.push($(this).outerHeight());
		currentCol++;

		if (currentCol == colsNum || !$(this).closest('.post').next().length){
			var h = Math.max.apply(Math, rowHeights);
			var newCSS = {'min-height': (h+1)+'px'}; // 1 extra pixel for possible decimals
			$(this).closest('.post').prevAll().andSelf().not('.adjusted').addClass('adjusted').attr('data-row', currentRow)
			.find('.content_wrapper').css(newCSS);
			rowHeights = [];
			currentCol = 0;
			currentRow++;
			if (!$(this).closest('.post').next().length){
				colsNum = 0;
				currentRow = 1;
			}
		}
	});
}

function replaceTextInDom(original_value, new_value){
	var reg_exp =  new RegExp(original_value, 'g');
	$('div:contains('+original_value+')').each(function(){
		if ($(this).clone().children('div').remove().end().text().indexOf(original_value) >= 0)
			$(this).html($(this).html().replace(reg_exp, new_value));
	});
}
/* since 2.5.0 */
