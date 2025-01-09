/**
*  @author    Amazzing
*  @copyright Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

$(document).ready(function(){

	if (typeof tinymce !== 'undefined') {
		tinymce.init({
			selector: '#new-comment-content',
			plugins: 'bbcode paste emoticons',
			toolbar1: 'bold italic underline emoticons',
			menubar: false,
			statusbar: false,
			paste_as_text: true,
			forced_root_block: false,
			inline: true,
		});
	}

	var sharingName = encodeURIComponent(document.title),
		sharingUrl = document.location.href;
		sharingImgSrc = $('.post-page').find('img').first().attr('src') || getLargestImgSrcOnPage();
	if (sharingImgSrc && sharingImgSrc.indexOf(location.origin) < 0) {
		sharingImgSrc = location.origin+''+sharingImgSrc;
	}
	sharingImgSrc = encodeURIComponent(sharingImgSrc);
	$(document).on('click', '.social-share', function(e){
		e.preventDefault();
		var network = $(this).data('network');
		var popupLink = false;
		switch(network) {
			case 'twitter':
				popupLink = 'https://twitter.com/intent/tweet?text='+sharingName+'&url='+sharingUrl;
				break;
			case 'facebook':
				popupLink = 'http://www.facebook.com/sharer.php?u='+sharingUrl+'&picture='+sharingImgSrc;
				break;
			case 'google-plus':
				popupLink = 'https://plus.google.com/share?url='+sharingUrl;
				break;
			case 'vk':
				popupLink = 'http://vk.com/share.php?url='+sharingUrl+'&image='+sharingImgSrc;
				break;
			case 'odnoklassniki':
				popupLink = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st._surl='+sharingUrl+'&title='+sharingName
				break;
			case 'linkedin':
				popupLink = 'https://www.linkedin.com/shareArticle?mini=true&url='+sharingUrl+'&title='+sharingName;
				break;
			case 'pinterest':
				popupLink = 'https://pinterest.com/pin/create/button/?url='+sharingUrl+'&media='+sharingImgSrc+'&description='+sharingName;
				break;
		}
		if (popupLink) {
			window.open(popupLink, 'sharer', 'toolbar=0,status=0,width=640,height=445');
		}
	}).on('click', '.edit-avatar', function(e){
		e.preventDefault();
		$(this).closest('.user-avatar').find('input[type="file"]').click();
	}).on('change', '.avatar-file', function(e){
		var $el = $(this);
		var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader)
			return;
        if (/^image/.test( files[0].type)){
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function(){
				$el.closest('.user-avatar').find('.avatar-img').removeClass('empty').css('background-image', 'url('+this.result+')');
            }
        }
	}).on('submit', '.new-comment', function(e){
		e.preventDefault();
		var $form = $(this),
			formData = new FormData($form[0]);
		formData.append('ajax', 1);
		formData.append('content', tinymce.get('new-comment-content').getContent());
		$form.find('.ajax-error, .thrown-errors').remove();
		$.ajax({
			type: 'POST',
			url: ab_ajax_path,
			dataType : 'json',
			data: formData,
			contentType: false,
			processData: false,
			cache: false,
			success: function(r){
				console.dir(r);
				if ('errors' in r){
					if (typeof r.errors === 'object'){
						for (var i in r.errors){
							var err = '<div class="ajax-error">'+utf8_decode(r.errors[i])+'</div>';
							$form.find('[name="'+i+'"]').parent().prepend(err).children('[name="'+i+'"]').addClass('red-border');
							if (i == 'content') {
								$form.find('.comment-item').prepend(err).addClass('red-border');
							}
						}
					} else {
						$form.prepend(utf8_decode(r.errors));
					}
				} else if (r.new_comment_html) {
					$('.comments-list').append(utf8_decode(r.new_comment_html));
					$('#new-comment-content').val('');
					tinymce.get('new-comment-content').setContent('');
					var num = parseInt($('#post-comments').find('.comments-num').text()) + 1;
					$('.comments-num').html(num);
					sendNotification(r.id_comment);
				}
			},
			error: function(r){
				console.warn(r.responseText);
			}
		});
	}).on('click keyup', '.red-border', function(e) {
		$(this).removeClass('red-border');
		$(this).find('.ajax-error').remove();
		$(this).siblings('.ajax-error').remove();
	}).on('click', function(e) {
		var $el = $(e.target).closest('.new-comment');
		if (!$el.length && !$(e.target).closest('.mce-container').length) {
			$el = $('.focus-on');
			if ($el.length) {
				$el.removeClass('focus-on');
				$el.find('.red-border').removeClass('red-border');
				$el.find('.ajax-error').remove();
				if (!$.trim($el.find('.mce-input').text()) && !$el.find('img').length) {
					$el.find('.mce-placeholder').removeClass('hidden');
				}
			}
		} else if (!$el.hasClass('focus-on')){
			$el.addClass('focus-on');
			$el.find('.mce-placeholder').addClass('hidden');
		}
	});

	function getLargestImgSrcOnPage() {
		var max = 0;
			src = '';
		$('img').each(function(){
			var size = parseFloat($(this).width()) * parseFloat($(this).height());
			if (size > max) {
				max = size;
				src = $(this).attr('src');
			}
		});
		return src;
	}

	function sendNotification(id_comment) {
		$.ajax({
			type: 'POST',
			url: ab_ajax_path,
			dataType : 'json',
			data: {
				ajax: 1,
				action: 'SendNotification',
				id_comment: id_comment,
			},
			success: function(r){
				// console.dir(r);
			},
			error: function(r){
				console.warn(r.responseText);
			}
		});
	}

	function utf8_decode (utfstr) {
		var res = '';
		for (var i = 0; i < utfstr.length;) {
			var c = utfstr.charCodeAt(i);

			if (c < 128)
			{
				res += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224))
			{
				var c1 = utfstr.charCodeAt(i+1);
				res += String.fromCharCode(((c & 31) << 6) | (c1 & 63));
				i += 2;
			}
			else
			{
				var c1 = utfstr.charCodeAt(i+1);
				var c2 = utfstr.charCodeAt(i+2);
				res += String.fromCharCode(((c & 15) << 12) | ((c1 & 63) << 6) | (c2 & 63));
				i += 3;
			}
		}
		return res;
	}
});
/* since 1.3.0 */
