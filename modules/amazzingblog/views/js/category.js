/**
*  @author    Amazzing
*  @copyright Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

$(document).ready(function(){
	$(document).on('click', '.go-to-page', function(e){
		if ($(this).closest('.pages').hasClass('ajax')) {
			e.preventDefault();
			var $pagination = $(this).closest('.pagination'),
				p = $(this).data('page'),
				npp = $pagination.find('.npp').val(),
				total = $pagination.find('.posts_total').val();
			ajaxLoadItems(p, npp, total);
			if ($(this).attr('href') != '#') {
				window.history.pushState(null, null, $(this).attr('href'));
			}
		}
	}).on('change', '.npp', function(){
		var $pagination = $(this).closest('.pagination'),
			p = 1,
			npp = $(this).val(),
			total = $pagination.find('.posts_total').val();
		ajaxLoadItems(p, npp, total);
		window.history.pushState(null, null, ab_first_page_url);
	});

	function ajaxLoadItems(p, npp, total) {
		$('.dynamic-posts').find('.post-list').addClass('loading');
		var data = {
			ajax: '1',
			action: 'LoadPosts',
			p: p,
			npp: npp,
			total: total,
			additional_filters: $('form.additional-filters').serialize(),
			ab_first_page_url: ab_first_page_url,
		};
		$.ajax({
			type: 'POST',
			url: ab_ajax_path,
			data: data,
			dataType : 'json',
			success: function(r) {
				// console.dir(r);
				$('.dynamic-posts').html(utf8_decode(r.html));
				ab_normalizeHeights($('.dynamic-posts').find('.post-list.grid'));
				try{ $('.npp').uniform() }catch(err){};
			},
			error: function(r) {
				console.warn(r.responseText);
			}
		});
	}

	function utf8_decode (utfstr) {
		var res = '';
		for (var i = 0; i < utfstr.length;) {
			var c = utfstr.charCodeAt(i);

			if (c < 128) {
				res += String.fromCharCode(c);
				i++;
			} else if ((c > 191) && (c < 224)) {
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
/* since 1.2.2 */
