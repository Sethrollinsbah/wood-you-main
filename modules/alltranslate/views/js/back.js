/**
*  @author    Prestapro
*  @copyright Prestapro
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

var allTranslate = (function() {
	var buttons_to_click = [],
		block_ajax = false;

	function decode(string) {
		var res = '';

		for (var i = 0; i < string.length;) {
			var c = string.charCodeAt(i);
			if (c < 128){
				res += String.fromCharCode(c);
				i++;
			} else if ((c > 191) && (c < 224)) {
				var c1 = string.charCodeAt(i+1);
				res += String.fromCharCode(((c & 31) << 6) | (c1 & 63));
				i += 2;
			} else {
				var c1 = string.charCodeAt(i+1);
				var c2 = string.charCodeAt(i+2);
				res += String.fromCharCode(((c & 15) << 12) | ((c1 & 63) << 6) | (c2 & 63));
				i += 3;
			}
		}

		return res;
	}

	function insertErrors(element, error) {
		var new_error = $('<div class="at-ajax-error">' + decode(error) + '</div>'),
			error_text = new_error.text(),
			repeated = false;

		element.find('.at-ajax-error').each(function() {
			var repeat_container = $(this).find('.at-repeat'),
				repeat_count = repeat_container.text();

			if ($.trim($(this).text()) == $.trim(error_text + ' ' + repeat_count)) {
				if (!repeat_container.length) {
					$(this).find('.alert').append('<span class="at-repeat">2</span>');
				} else {
					repeat_container.html(parseInt(repeat_count) + 1);
				}

				repeated = true;
				return false;
			}
		});

		if (!repeated) {
			element.prepend(new_error);
		}
	}

	function request(data, response) {
		if (block_ajax) {
			toggleWarning('#at-warning-progress', 'on');
			return;
		} else {
			toggleWarning('#at-warning-progress', 'off');
		}

		block_ajax = true;
		$.ajax({
			type: 'POST',
			url: window.location.href.split('#')[0],
			data: data,
			dataType: 'json',
			success: function(r) {
				block_ajax = false;
				$('.at-loading').removeClass('at-loading');
				response(r);
			},
			error: function(r) {
				block_ajax = false;
				$('.at-loading').removeClass('at-loading');
			}
		});
	}

	function translate(type, identifier, from, from_locale, to) {
		var tr = $('tr[data-identifier="' + identifier + '"]'),
			translate_button = tr.find('.at-translate-btn'),
			data = {
				type: type,
				identifier: identifier,
				from: from,
				from_locale: from_locale,
				to: to,
				action: 'translate',
				overwrite_existing : $('input[name="overwrite_existing"]').prop('checked') ? 1 : 0,
			},
			response = function(r) {
				if (r.error) {
					insertErrors(tr.closest('.dynamic-list'), r.response);
				} else {
					tr.find('.at-ajax-response').addClass('ok').html('<i class="icon-check"></i> ' + decode(r.response));
				}

				buttons_to_click.shift();

				if (buttons_to_click.length) {
					identifier = buttons_to_click[0].closest('tr').attr('data-identifier');
					translate(type, identifier, from, from_locale, to);
				}
			};

		translate_button.addClass('at-loading');
		request(data, response);
	}

	function updateFlag(element) {
		element.parent().css('backgroundImage', 'url("' + at_dir + '/views/img/' + element.val() + '.png")');
	}

	function animateScroll(offset) {
		$('html, body').animate({
			scrollTop: offset
		}, 700);
	}

	function toggleWarning(selector, state) {
		if (state === 'on') {
			$(selector).removeClass('hidden');
			animateScroll(0);
		} else {
			$(selector).addClass('hidden');
		}
	}

	return {
		init: function() {
			$('select.at-lang-list').each(function() {
				updateFlag($(this));

				$(this).on('change', function() {
					updateFlag($(this));
				});
			});

			$(document).on('click', 'a[href="#"]', function(event) {
				event.preventDefault();
			}).on('click', 'a.at-translate-btn', function() {
				if ($(this).hasClass('at-loading')) {
					return false;
				}

				var type = $(this).closest('tr').data('type'),
					identifier = $(this).closest('tr').data('identifier'),
					from = $('#at-lang-from').val(),
					from_locale = $('#at-lang-from option:selected').data('locale'),
					to = $('#at-lang-to').val();


				if (to === null || to.length === 0) {
					toggleWarning('#at-warning-empty', 'on');
				} else if (from === to || $.inArray(from, to) != -1) {
					toggleWarning('#at-warning-same-lang', 'on');
				} else {
					toggleWarning('#at-warning-empty', 'off');
					toggleWarning('#at-warning-same-lang', 'off');
					translate(type, identifier, from, from_locale, to);
				}
			}).on('click', '.btn.stop', function() {
				buttons_to_click = [];
			}).on('click', '.at-checkbox-action', function() {
				var i = $(this).find('i'),
					checkboxes = $('input.at-checkbox');

				if (i.hasClass('icon-check-sign')) {
					checkboxes.prop('checked', true);
				} else if (i.hasClass('icon-check-empty')) {
					checkboxes.prop('checked', false);
				} else if (i.hasClass('icon-random')) {
					checkboxes.each(function() {
						$(this).prop('checked', !$(this).prop('checked'));
					});
				};
			}).on('click', '#at-bulk-translate', function() {
				buttons_to_click = [];

				$('input.at-checkbox:checked').each(function() {
					$(this).closest('tr').find('a.at-translate-btn').each(function() {
						buttons_to_click.push($(this));
					});
				});

				if (buttons_to_click.length) {
					toggleWarning('#at-warning-selection', 'off');
					buttons_to_click[0].click();
					animateScroll(buttons_to_click[0].closest('tr').offset().top - 150);
				} else {
					toggleWarning('#at-warning-selection', 'on');
				}
			}).on('change', '#at-lang-from', function() {
				if ($(this).val() != 'en') {
					toggleWarning('#at-warning-source-lang', 'on');
				} else {
					toggleWarning('#at-warning-source-lang', 'off');
				}
			}).on('click', '#at-multiple-lang', function() {
				var multiple_lang = $(this).prop('checked');

				if (multiple_lang == '1') {
					$('#at-lang-to').attr('multiple', 'multiple');
					$('#at-all').removeAttr('selected').hide();
				} else {
					$('#at-lang-to').attr('multiple', false);
					$('#at-all').show();
				}
			});
		}
	};
})();

$(function() {
	allTranslate.init();
});
