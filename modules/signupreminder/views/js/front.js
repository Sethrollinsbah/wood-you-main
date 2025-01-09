/**
*  @author    Prestapro
*  @copyright Prestapro
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

function setCookie(name, value) {
	var date = new Date(),
		expires;
	date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
	expires = '; expires=' + date.toGMTString();
	document.cookie = name + "=" + value + expires + '; path=/';
}

function getCookie(name) {
	var cookieName = name + '=',
		cookieArray = document.cookie.split(';'),
		i,
		cookie;

	for (i = 0; i < cookieArray.length; i++) {
		cookie = $.trim(cookieArray[i]);

		if (cookie.indexOf(cookieName) === 0) {
			return cookie.substring(cookieName.length, cookie.length);
		}
	}

	return null;
}

function validateForm() {
	var fields = [$('#sur-firstname'), $('#sur-lastname'), $('#sur-birthdate'), $('#sur-email')],
		errors = false;

	for (var i = 0, l = fields.length; i < l; i++) {
		if (fields[i].length > 0 && fields[i].attr('required') === 'required' && $.trim(fields[i].val()) === '') {
			fields[i].addClass('sur-error');
			errors = true;
		} else {
			fields[i].removeClass('sur-error');
		}
	}

	if (errors) {
		$('#sur-warning').removeClass('sur-hidden');
		return false;
	} else {
		$('#sur-warning').addClass('sur-hidden');
	}

	return true;
}

function showConfirmaton() {
	$('#sur-form, #sur-image').fadeOut(600, function() {
		$(this).remove();
		$('#sur-confirmation').fadeIn(600);
		var currentHeight = $('#sur-container').height(),
			autoHeight = $('#sur-container').css('height', 'auto').height();
		$('#sur-container').height(currentHeight).animate({height: 124}, 400);
	});
}

function closePopup(popup) {
	popup.fadeOut();
	setCookie('signupreminder', 'off');
}

function submitData(popup) {
	$.ajax({
		method: 'POST',
		url: sur_dir + 'ajax.php',
		data: {
			secure_key: sur_secure_key,
			firstname: $('#sur-firstname').val(),
			lastname: $('#sur-lastname').val(),
			gender: $('input[name=sur-gender]:checked').val(),
			birthdate: $('#sur-birthdate').val(),
			email: $('#sur-email').val()
		},
		dataType: 'json'
	}).done(function(json) {
		if (json !== null) {
			$.each(json, function(i, value) {
				$('#sur-' + value).addClass('sur-error');
			});

			$('#sur-warning').removeClass('sur-hidden');

			return false;
		}

		showConfirmaton();
	});
}

$(function() {
	var lightbox = $('#sur-lightbox'),
		birthdate = $('#sur-birthdate'),
		cookie = getCookie('signupreminder');

	if (lightbox.length > 0 && cookie === null) {
		if (!sur_delay || sur_delay <= 0) {
			sur_delay = 5;
		}

		setTimeout(function() {
			lightbox.fadeIn();
		}, sur_delay * 1000);

		lightbox.click(function() {
			closePopup($(this));
		});

		$('#sur-container').click(function(e) {
			e.stopPropagation();
		});

		$('#sur-close').click(function() {
			closePopup(lightbox);
		});

		if (birthdate.length > 0) {
			birthdate.datepicker({dateFormat: "yy-mm-dd"});
		}

		$('#sur-submit').click(function() {
			if (validateForm() === true) {
				submitData(lightbox);
			}
		});
	}
});
