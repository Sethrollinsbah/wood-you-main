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
function ajaxsave(url) {
	var glyphs = [];

	$('#ft-icons .fticon').each(function() {
		var icon = $(this).find('span');
		var uid = icon.data('uid');
		var src = icon.data('src');
		var css = $(this).find('input.css').val();
		var code = parseInt($(this).find('input.code').val(), 16);
		if (icon.attr('data-path')) {
			var path = icon.data('path');
			var width = icon.data('width');
			var svg = {path: path, width: width};
			glyphs.push({uid: uid,  css: css, code: code, src: src, svg: svg, selected: true});
		} else {
			glyphs.push({uid: uid,  css: css, code: code, src: src});
		}

	});
	var custom_classes = [];
	$('#custom-classes-wrap .fticon').each(function() {
		var icon = $(this).find('span');
		var uid = icon.data('uid');
		custom_classes.push({uid: uid, custom_class: $(this).find('.custom_css').val()});
	});
	var fontCfg = {
		name: "fontello",
  		css_prefix_text: $('#fontello-prefix').val(),
  		css_use_suffix: false,
  		hinting: true,
  		units_per_em: 1000,
  		ascent: 850,
  		glyphs: glyphs
	};
	fontCfg = JSON.stringify(fontCfg);
	data = {data: fontCfg, custom_classes: custom_classes};
	$.post(url, data, function(response) {

		reloadStylesheets();
		$('#fontellico-module').html(response);

	});

}

function reloadStylesheets() {
    var queryString = '?reload=' + new Date().getTime();
    $('link[rel="stylesheet"]').each(function () {
        if (this.href.indexOf('fontello') > -1) {
        	this.href = this.href.replace(/\?.*|$/, queryString);
        }
    });
}

function isHex(h) {
	var a = parseInt(h,16);
	return (a.toString(16) ===h.toLowerCase())
}

$(document).ready(function() {
	$(this).on('click', '#ajax-save', function() {
		var url = $('#ajax-save').data('url');
		ajaxsave(url);
	});

	$(this).on('focusout', '.fticon input', function() {
		var uid = $(this).closest('.fticon').find('span').attr('data-uid');
		var icon = $('span[data-uid="'+uid+'"');
		if ($(this).attr('class') != 'custom_css' || $(this).attr('class') != 'custom_id') {
			icon.closest('.fticon').find('input.'+$(this).attr('class')).val($(this).val());
		}
	});

	$(this).on('click', '#save-custom-class-button', function() {
		if ($('#custom-class-input').val() != '') {
			var uid = $('#custom-class-popup').attr('data-uid');
			$('.fticon span[data-uid="'+uid+'"]').attr('data-custom-class', $('#custom-class-input').val()).css('color','red');
		}

	});

	$(this).on('click', '#fix-unicode', function() {
		if (isHex($('#fix-unicode-input').val())) {
			var add_value = parseInt($('#fix-unicode-input').val(),16);
			if (add_value < 65535) {
				var start = parseInt($('.fticon').find('input.code').first().val(), 16);
				$('.fticon').each(function() {

					var code = parseInt($(this).find('input.code').val(), 16);
					code = code + add_value - start;
					var test = code.toString(16);
					if (test == 'f0b5') {
						add_value = add_value + 13;
						code = code + 13;
					}
					if (test == 'f116') {
						add_value = add_value + 2;
						code = code + 2;
					}
					var last = code.toString(16).slice(-1);
					if (last == 'f') {
						add_value = add_value + 1;
						code = code + 1;
					}
					$(this).find('input.code').val(code.toString(16));
				});
			}
		}
	});

	$(this).on('change' , '#zipped_config_data', function(){
		if ($(this).val() != '') {
			$(this).parent().find('span').text($(this).val());
			$(this).parent().parent().find('#submit-upload').prop('disabled', false);
		}
	});


	reloadStylesheets();
	$('#fontellico-all span').click(function() {
        $(this).toggleClass('selected');
    });

	$(this).on('click', '#fontellico-all #add-icons-modal', function() {
		var prefix = $('#fontello-prefix').val();
		$('.selected').each(function() {
			$(this).addClass(prefix+$(this).data('css'));
			$(this).data('code', $(this).data('code').toString(16));
			$(this).wrap('<div class="col-md-1 fticon"></div>');
			var wrap = $(this).parent();
			wrap.append('<input size="5" class="code" value="' + $(this).data('code') + '" />');
			wrap.append('<input size="5" class="css" value="' + $(this).data('css') + '" />');
			$("#ft-icons").append(wrap);
		});
    	$('#ajax-save').trigger('click');
    });

	$(this).on('click','#ft-icons .del-icon', function() {
		var uid = $(this).closest('.fticon').find('span').attr('data-uid');
		var icon = $('#custom-classes-wrap span[data-uid="'+uid+'"');
		icon.closest('.fticon').remove();
		$(this).parent().remove();
	});

	$(this).on('click','#custom-classes-wrap .del-icon', function() {
		$(this).parent().remove();
	});

	$(this).on('click','#clear-icons', function() {
        $('.fticon').remove();
    });

	$(this).on('keyup','#icon-search', function() {
		var filter = $(this).val();
        $(".fticon input.css").each(function() {
            if ($(this).val().search(new RegExp(filter, "i")) < 0) {
                $(this).parent().fadeOut();
            } else {
                $(this).parent().show();
            }
        });
	});
	$(this).on('keyup','#icon-search-popup', function() {
		var filter = $(this).val();
        $("#fontellico-all span").each(function() {
            if ($(this).data('css').search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
            }
        });
	});

	$(this).on('keyup','#icon-css-search-popup', function() {
		var filter = $(this).val();
        $('#fontellico-change-class-select span').each(function() {
            if ($(this).data('css').search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
            }
        });
	});

	$(this).on('click', '#fontellico-change-class-select span', function() {
		var icon = $(this).closest('.fticon');
		icon.find('button').unwrap();
		$('#custom-classes-wrap').append(icon);
    });
});