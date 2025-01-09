/**
*  @author    Amazzing
*  @copyright Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

var action_url;
$(document).ready(function() {

	action_url = window.location.href.split('#')[0];
	activateSortable();
	activateDatePicker();

	$(document).on('click', '.btn:not([type="submit"]), .act, a[href="#"]', function(e){
		e.preventDefault();
	}).on('click', '.list-group-item', function(e){
		e.preventDefault();
		if ($(this).data('sub')) {
			$(this).siblings('.sub-item.'+$(this).data('sub')).toggleClass('hidden');
		} else {
			$(this).addClass('active').siblings().removeClass('active');
			$('.tab-content'+$(this).attr('href')).addClass('active').siblings().removeClass('active');
		}
	})

	$('.testimonialswithavatars').on('click', 'h3 i.toggle_content', function(){
		$icon = $(this);
		if ($icon.closest('.panel').hasClass('closed')) {
			$icon.toggleClass('icon-chevron-down icon-chevron-up').closest('.panel').removeClass('closed');
			$icon.closest('h3').siblings().slideDown();
		}
		else{
			$(this).closest('h3').siblings().slideUp(function(){
				$icon.toggleClass('icon-chevron-down icon-chevron-up').closest('.panel').addClass('closed');
			});
		}
	});

	$('form[data-hook]').find('[name="active"][value="1"]:checked').each(function(){
		$('.list-group-item[href="#'+$(this).closest('form').data('hook')+'_settings').find('.icon-check').removeClass('hidden');
	});

	$('.testimonialswithavatars').on('click', '.editPost', function(e){
		e.preventDefault();
		$('.postRow').removeClass('being_edited');
		var $parent = $(this).closest('.postRow');
		$parent.addClass('being_edited');
		tinymce.init({
			selector: '#content_'+$parent.attr('data-id'),
			plugins: 'bbcode emoticons paste',
			inline: true,
			toolbar1: 'bold italic underline emoticons',
			menubar: false,
			statusbar: false,
			paste_as_text: true,
		});
	});

	$('.testimonialswithavatars').on('click', '.cancelEditing', function(e){
		e.preventDefault();
		$('.postRow').removeClass('being_edited');
	});

	$(document).on('mouseenter', '.being_edited .stars_holder .rating-star', function(){
		$(this).parent().children().removeClass('highlighted');
		$(this).addClass('highlighted').prevAll('.rating-star').addClass('highlighted');
	});

	$(document).on('mouseleave', '.being_edited .stars_holder .rating-star', function(){
		$(this).parent().children().removeClass('highlighted');
	});

	$(document).on('click', '.being_edited .stars_holder .rating-star', function(){
		$(this).parent().children().removeClass('highlighted on');
		$(this).addClass('on').prevAll('.rating-star').addClass('on');
		$(this).siblings('input').val($(this).attr('data-rating'));
	})

	// uploading avatar
	$('.testimonialswithavatars').on('click', '.being_edited .imgholder > div', function(){
		$(this).next().find('input').click();
	});

	$('.testimonialswithavatars').on('change', 'input[name="avatar_file"]', function(){
		var el = $(this);
		var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader)
			return;
        if (/^image/.test( files[0].type)){
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function(){
				el.parent().siblings().css('background-image', 'url('+this.result+')');
            }
        }
    });

	// multilang
	$('.testimonialswithavatars').on('click', '.selectLanguage', function(){
		var id_lang = $(this).data('lang');
		$('.multilang').addClass('hidden');
		$('.multilang.lang-'+id_lang).removeClass('hidden');
	});


	// saving post
	$(document).on('click', '.testimonialswithavatars .savePost', function(e){
		e.preventDefault();
		if ($(this).hasClass('blocked_for_ajax_requests'))
			return;
		$(this).addClass('blocked_for_ajax_requests');
		updatePost($(this).closest('.postRow').attr('data-id'));
	});

	$(document).on('focus click', '.alert-danger', function(){
		$(this).removeClass('alert-danger');
	});

	$(document).on('click', '.activatePost', function(e){
		e.preventDefault();
		var id_post = $(this).closest('.postRow').attr('data-id');
		var active = $(this).hasClass('action-enabled') ? 0 : 1;
		var $button = $(this);
		$.ajax({
			type: 'POST',
			url: action_url+'&ajaxAction=toggleActiveStatus&id_post='+id_post+'&active='+active,
			dataType : 'json',
			success: function(r)
			{
				if(r.success){
					$button.toggleClass('action-enabled action-disabled');
					$button.find('input').val(r.active);

				}
			},
			error: function(r)
			{
				console.warn(r.responseText);
			}
		});

	});

	$(document).on('click', '.deletePost', function(e){
		e.preventDefault();
		if (!confirm('Are you sure?'))
			return;
		var id_post = $(this).closest('.postRow').attr('data-id');
		$.ajax({
			type: 'POST',
			url: action_url+'&ajaxAction=deletePost&id_post='+id_post,
			dataType : 'json',
			success: function(r)
			{
				// console.dir(r);
				if (r.deleted){
					$('.postRow[data-id="'+id_post+'"]').fadeOut(function(){
						$(this).remove();
					});
				}
			},
			error: function(r)
			{
				console.warn(r.responseText);
			}
		});
	});

	// load more
	$('.testimonialswithavatars').on('click', '#loadMore', function(){
		var currentIds = [];
		$('.postRow').each(function(){
			currentIds.push($(this).attr('data-id'));
		})
		loadMorePosts(currentIds);
	});

	// save settings
	$('.submitSettings').on('click', function(){
		$('.form-group.wrong-value').removeClass('wrong-value').find('.error-txt').remove();
		$('.alert-ajax').remove();
		var $form = $(this).closest('form'),
			data = $form.serialize();
		$.ajax({
			type: 'POST',
			url: action_url+'&ajaxAction=saveSettings',
			data: data,
			dataType : 'json',
			success: function(r) {
				console.dir(r);
				if ('errors' in r) {
					for (var name in r.errors) {
						if ($form.find('.form-group.'+name).length) {
							$form.find('.form-group.'+name).addClass('wrong-value').find('.input-field')
							.after('<span class="alert-danger error-txt">'+utf8_decode(r.errors[name])+'</span>');
						} else {
							$form.prepend(displayAlert('danger', utf8_decode(r.errors[name])));
						}
					}
				} else if ('successText' in r) {
					if ($form.data('hook')) {
						var active = $form.find('[name="active"][value="1"]').prop('checked');
						$('.list-group-item[href="#'+$form.data('hook')+'_settings').find('.icon-check').toggleClass('hidden', !active);
					}
					$.growl.notice({ title: '', message: utf8_decode(r.successText)});
				}
			},
			error: function(r) {
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	});

	function displayAlert(type, content) {
		var alertHTML = '<div class="alert alert-'+type+' alert-ajax">';
			alertHTML += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			alertHTML += content;
			alertHTML += '</div>';
		return alertHTML;
	}

	// ajax progress
	$('body').append('<div id="re-progress"><div class="progress-inner"></div></div>');
	$(document).ajaxStart(function(){
		$('#re-progress .progress-inner').width(0).fadeIn('fast').animate({'width':'70%'},500);
	})
	.ajaxSuccess(function(){
		$('#re-progress .progress-inner').animate({'width':'100%'},500,function(){
			$(this).fadeOut('fast');
		});
	});
});

function updatePost(id){
	var $form = $('.postRow[data-id="'+id+'"] form');
	var data = new FormData();
	if ($form.find('input[name="avatar_file"]').prop('files').length > 0)
		data.append('avatar_file', $form.find('input[name="avatar_file"]').prop('files')[0]);
	data.append('content', tinyMCE.get('content_'+id).getContent());
	var otherParams = $form.serializeArray();
	$.each(otherParams, function (i, val) {
		data.append(val.name, val.value);
	});
	$form.find('.ajax_errors').slideUp().html('');
	$.ajax({
		type: 'POST',
		url: action_url+'&ajaxAction=updatePost',
		dataType : 'json',
		processData: false,
        contentType: false,
		data: data,
		success: function(r) {
			// console.dir(r);
			$('.blocked_for_ajax_requests').removeClass('blocked_for_ajax_requests');

			var hasError = false;
			for (var e in r.errors) {
				var label = $('.field.'+e).prev().html();
				$form.find('.ajax_errors').append('<div>'+label+' '+r.errors[e]+'</div>');
				hasError = true;
			}
			if (hasError) {
				$form.find('.ajax_errors').slideDown();
			} else {
				tinymce.remove()
				$form.parent().replaceWith(utf8_decode(r.new_post));
				$.growl.notice({ title: '', message: r.successText});
			}

		},
		error: function(r) {
			console.warn(r.responseText);
			$('.blocked_for_ajax_requests').removeClass('blocked_for_ajax_requests');
		}
	});
}

function loadMorePosts(currentIds){
	$('#loadMore span').hide().siblings().show();
	$.ajax({
		type: 'POST',
		url: action_url+'&ajaxAction=loadMore',
		dataType : 'json',
		data: {
			ids_to_exclude: currentIds,
		},
		success: function(r) {
			$('#loadMore span').show().siblings().hide();
			if (r.posts) {
				$('.postList').append(utf8_decode(r.posts));
			} else {
				$('#loadMore').hide().siblings().show();
			}
		},
		error: function(r) {
			console.warn(r.responseText);
			$('#loadMore span').show().siblings().hide();
		}
	});
}

function activateSortable(){
	$('.postList').sortable({
		placeholder: 'new_position_placeholder',
		handle: '.dragger',
		start: function(e, ui) {
            var h = ui.item.outerHeight();
            $('.new_position_placeholder').css('height', h+'px');
        },
		update: function(event, ui) {
			var total_visible_items = ui.item.closest('.postList').find('.postRow').length;
			var ordered_ids = [];
			ui.item.closest('.postList').find('.postRow').each(function(i){
				var id = $(this).attr('data-id');
				// ordering by position will be performed in DESC way, like date
				ordered_ids[id] = total_visible_items - i;
			});
			$.ajax({
				type: 'POST',
				url: action_url+'&ajaxAction=updatePositions',
				dataType : 'json',
				data: {
					ordered_ids: ordered_ids,
				},
				success: function(r) {
					if (r.errors.length > 0) {
						var errorMsg = '';
						for (var i in r.errors) {
							errorMsg += r.errors[i]+'; ';
						}
						$.growl.notice({ title: '', message: errorMsg});
					}
					if('successText' in r) {
						$.growl.notice({ title: '', message: r.successText});
					}
				},
				error: function(r) {
					console.warn($(r.responseText).text() || r.responseText);
				}
			});
		}
	});
}

function activateDatePicker(){
	$('.datepicker').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:00'
	});
}

/**
 * Copy of the php function utf8_decode()
 */
function utf8_decode (utfstr) {
	var res = '';
	for (var i = 0; i < utfstr.length;) {
		var c = utfstr.charCodeAt(i);
		if (c < 128) {
			res += String.fromCharCode(c);
			i++;
		} else if((c > 191) && (c < 224)) {
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
/* since 2.5.0 */
