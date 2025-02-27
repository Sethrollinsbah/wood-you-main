/**
*  @author    Amazzing
*  @copyright Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

var ajax_action_path,
	blockAjax = false,
	cbSaveOnTheFlyTimeOut;

$(document).ready(function() {

	ajax_action_path = window.location.href.split('#')[0]+'&ajax=1';
	activateSortable();
	activateDatePicker();

	$(document).on('change', '.hookSelector', function() {
		var hook_name = $(this).val();
		$('.hook-content#'+hook_name).addClass('active').siblings().removeClass('active');
		$('.callSettings.active').trigger('click');
	});
	$('.hookSelector').change();

	$(document).on('click', 'a[href="#"], .img-browse', function(e) {
		e.preventDefault();
	}).on('click', '.img-browse', function(e) {
		$(this).siblings('input').removeProp('dropped_files').click();
	});

	$(document).on('change', '.img-holder input[type="file"]', function() {
		this.file_to_submit = false;
		if ('dropped_files' in this && /^image/.test(this.dropped_files[0].type))
			this.file_to_submit = this.dropped_files[0];
		else if (!!this.files && this.files.length && /^image/.test(this.files[0].type))
			this.file_to_submit = this.files[0];
		if (!this.file_to_submit || !window.FileReader)
			return;
		var $parent = $(this.closest('.img-holder'));
		var reader = new FileReader();
		reader.readAsDataURL(this.file_to_submit);
		reader.onloadend = function() {
			$parent.find('img').remove();
			var newImgHTML = '<img src="'+this.result+'">';
			$parent.addClass('has-img').find('.img-uploader').hide().after(newImgHTML);
		}
    });

	$(document).on('dragover', '.img-holder:not(.has-img)', function(e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).addClass('ondragover');
	}).on('dragend dragleave', '.img-holder', function(e) {
		$(this).removeClass('ondragover');
	}).on('drop', '.img-holder', function(e) {
		e.preventDefault();
		$(this).removeClass('ondragover');
		// most browsers dont support modyfing prop('files'), so we create an additional prop 'dropped_files'
		$(this).find('input[type="file"]').prop('dropped_files', e.originalEvent.dataTransfer.files).change();
	});

	$(document).on('click', '.delete-image', function() {
		$(this).siblings().toggle().parent().removeClass('has-img').find('.banner_img_file').prop('file_to_submit', '');
	});

	var timerC;
	$(document).on('mouseenter', '.show-classes, .predefined-classes', function() {
		if (!$(this).closest('.multilang').find('.predefined-classes').length) {
			$(this).closest('.multilang').append($('.classes-wrapper').html()).tooltip({selector: '.label-tooltip'});
			var right = $(this).closest('.show-classes').outerWidth() / 2;
			$(this).closest('.multilang').find('.caret-t').css({'right' : right+'px', 'left' : 'auto'});
		}
		$(this).closest('.multilang').find('.predefined-classes').show();
		clearTimeout(timerC);
	}).on('mouseleave', '.show-classes, .predefined-classes', function(e) {
		if ($(e.target).hasClass('show-classes') || $(e.target).hasClass('predefined-classes')) {
			$el = $(this).closest('.multilang').find('.predefined-classes');
			timerC = setTimeout(function() {
				$el.hide();
			}, 200);
		}
	}).on('click', function(e) {
		if ($(e.target).hasClass('show-classes') || $(e.target).closest('.predefined-classes').length)
			return;
		$('.predefined-classes').hide();
	});

	var timerW;
	$(document).on('mouseenter', '.multiclass', function() {
		var $classes = $(this).find('.list');

		// prestashop BO layout
		var hiddenTop = 100;
		var hiddenBottom = $('#footer').is(':visible') ? 50 : 0;

		var h = $(this).find('i').innerHeight();
		var top = Math.round($classes.innerHeight() / 2 - h / 2);
		var viewPortPosition = this.getBoundingClientRect();
		var overTop = viewPortPosition.top - hiddenTop - top;
		if (overTop < 0)
			top += overTop;
		var overBottom = $(window).height() - viewPortPosition.bottom - hiddenBottom - top;
		if (overBottom < 0)
			top -= overBottom;
		$classes.css('top', '-'+top+'px');
		$classes.find('.caret-l').css('top', (top + h / 2)+'px');

		$('.multiclass .list').hide();
		$classes.show();
		clearTimeout(timerW);

	}).on('mouseleave', '.multiclass', function() {
		$classes = $(this).find('.list');
		timerW = setTimeout(function() {
			$classes.hide();
		}, 200);
	});

	$(document).on('keyup change', '.all-langs ', function() {
		$(this).closest('.multilang').siblings().find('[data-all="'+$(this).attr('data-all')+'"]').val($(this).val());
	});

	$(document).on('click', '.predefined-classes [data-class]', function() {
		var $input = $(this).closest('.multilang').find('input[type="text"]');
		var currentClasses = $.trim($input.val()).split(' ');
		var classToAdd = $(this).data('class');
		var fragment = classToAdd;
		if ($(this).find('.fragment').length > 0) {
			var fragment = $.trim($(this).find('.fragment').text());
			$(this).closest('.list').hide();
		}
		var newClasses = [];
		for (var i in currentClasses)
			if (currentClasses[i].indexOf(fragment) == -1)
				newClasses.push(currentClasses[i]);
			else
				newClasses.push(classToAdd);
		if ($.inArray(classToAdd, newClasses) == -1)
			newClasses.push(classToAdd);
		$input.val(newClasses.join(' ')).trigger('keyup');
	});

	$(document).on('change', 'select.exc', function() {
		var value = $(this).val(),
			showExcludeTxt = value.lastIndexOf('_all') > -1;
		$(this).closest('.exceptions-block').toggleClass('has-ids', value != 0)
		.find('.exclude-ids-txt').toggleClass('hidden', !showExcludeTxt).prev().toggleClass('hidden', showExcludeTxt);
	});

	$(document).on('click', '.activateBanner', function(e) {
		e.preventDefault();
		$checkbox = $(this).find('input[type="checkbox"]');
		$checkbox.prop('checked', !$checkbox.prop('checked')).change();
	});

	$(document).on('change', '.toggleable_param', function(e) {
		if (blockAjax)
			return;
		var $parent = $(this).closest('.banner-item'),
			id_banner = $parent.attr('data-id'),
			param_name = $(this).attr('name'),
			param_value = $(this).prop('checked') ? 1 : 0;

		$.ajax({
			type: 'POST',
			url: ajax_action_path+'&action=ToggleBannerParam&param_name='+param_name+'&param_value='+param_value+'&id_banner='+id_banner,
			dataType : 'json',
			success: function(r)
			{
				console.dir(r);
				if(r.success) {
					$.growl.notice({ title: '', message: savedTxt});
					if (param_name == 'active') {
						$parent.find('.activateBanner').toggleClass('action-enabled action-disabled');
					}
				}
				else
					$.growl.error({ title: '', message: failedTxt});

			},
			error: function(r)
			{
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	});

	$(document).on('click', '.editBanner', function(e) {
		e.preventDefault();
		$('.banner-item').removeClass('open').find('.banner-details').slideUp();

		var $parent = $(this).closest('.banner-item');
		$parent.addClass('open').find('.banner-details').slideDown(function() {
			// activate only visible textareas, others are activated on language change
			$parent.find('textarea.mce:visible').not('.mce-activated').each(function() {
				prepareVisibleTextarea($(this));
			});
		});
	});

	$(document).on('click', '.show-field', function(e) {
		e.preventDefault();
		$(this).closest('.form-group').removeClass('empty').find('textarea.mce:visible').not('.mce-activated').each(function() {
			prepareVisibleTextarea($(this));
		});
	});

	$(document).on('click', '.hide-field', function() {
		$(this).closest('.form-group').addClass('empty');
	});

	$(document).on('change', '.linkTypeSelector', function() {
		$(this).next().attr('data-type', $(this).val()).find('input[type="text"]').val('');
	});

	$(document).on('click', '.scrollUp', function(e) {
		e.preventDefault();
		$('.banner-item').removeClass('open').find('.banner-details').slideUp();
	});

	$(document).on('click', '.saveBanner', function(e) {
		e.preventDefault();
		var $parent = $(this).closest('.banner-item');
		$parent.find('.ajax-errors').slideUp().html('');
		var fd = new FormData();
		$parent.find('input[type="file"]').each(function() {
			if ((!$(this).closest('.img-holder').hasClass('has-img') || $(this).closest('.form-group').hasClass('empty'))
				&& $(this).siblings('input.banner_img_name').val()) {
				fd.append('imgs_to_delete['+$(this).siblings('input.banner_img_name').val()+']', 1);
				$(this).siblings('input.banner_img_name').val('');
			} else if ('file_to_submit' in this && this.file_to_submit) {
				fd.append($(this).attr('name'), this.file_to_submit);
			}
		});

		$parent.find('textarea.mce-activated').each(function() {
			var html_content = tinyMCE.get($(this).attr('id')).getContent();
			$(this).val(html_content);
		});

		var otherParams = $parent.find('form').serializeArray();
		$.each(otherParams, function (i, val) {
			if (!$parent.find('[name="'+val.name+'"]').closest('.form-group').hasClass('empty'))
				fd.append(val.name, val.value);
		});

		$.ajax({
			type: 'POST',
			url: ajax_action_path+'&action=SaveBannerData&id_banner='+$parent.attr('data-id'),
			dataType : 'json',
			processData: false,
			contentType: false,
			data: fd,
			success: function(r)
			{
				console.dir(r);
				if ('errors' in r) {
					$parent.prepend(utf8_decode(r.errors));
					$('html, body').animate({
						scrollTop: $parent.offset().top - 130
					}, 500);
					return;
				}
				else if ('banner_form_html' in r) {
					$parent.removeClass('open').find('.banner-details').slideUp(function() {
						$.growl.notice({ title: '', message: savedTxt});
						$parent.replaceWith(utf8_decode(r.banner_form_html));
						$('body').tooltip({selector: '.label-tooltip'});
						activateDatePicker();
					});
				}
			},
			error: function(r)
			{
				console.warn($(r.responseText).text() || r.responseText);
				$parent.find('.ajax-errors').slideDown().html('Error. Check console log');
			}
		});

    });

	$(document).on('click', '.bulk-select, .bulk-unselect', function(e) {
		e.preventDefault();
		var checked = $(this).hasClass('bulk-select');
		$('.banner-item:visible .banner-box').prop('checked', checked);
	});

	$(document).on('click', '[data-bulk-act]', function(e) {
		e.preventDefault();
		$('.bulk-actions-error').remove();
		var ids = [];
		$('.banner-box:checked').each(function() {
			ids.push($(this).val());
		});
		var act = $(this).data('bulk-act');
		if ((act == 'delete' || act == 'deleteAll')&& !confirm(areYouSureTxt))
			return;
		var additionalParams = {};
		if (act == 'move' || act == 'copy')
			additionalParams.to_hook = $(this).siblings('select').val();
		$.ajax({
			type: 'POST',
			url: ajax_action_path+'&action=BulkAction',
			dataType : 'json',
			data: {
				act : act,
				ids : ids,
				additionalParams : additionalParams,
			},
			success: function(r)
			{
				if ('errors' in r) {
					var err = '<div class="bulk-actions-error" style="display:none;">'+utf8_decode(r.errors)+'</div>';
					$('.bulk-actions').removeClass('open').before(err);
					$('.bulk-actions-error').slideDown();
				}
				else if (r.success) {
					$.growl.notice({ title: '', message: r.reponseText});
					blockAjax = true;
					switch (act) {
						case 'enable':
							for (var i in ids)
								$('.banner-item[data-id="'+ids[i]+'"] .activateBanner').addClass('action-enabled').removeClass('action-disabled').find('input').prop('checked', true);
						break;
						case 'disable':
							for (var i in ids)
								$('.banner-item[data-id="'+ids[i]+'"] .activateBanner').removeClass('action-enabled').addClass('action-disabled').find('input').prop('checked', false);
						break;
						case 'delete':
							removeBannerRows(ids);
						break;
						case 'deleteAll':
							window.location.reload();
						break;
						case 'copy':
						case 'move':
							if (r.append_to_wrapper_id) {
								var idWrapper = r.append_to_wrapper_id,
									hookName = additionalParams.to_hook,
									wrapperHTML = utf8_decode(r.new_wrapper_form),
									bannersHTML = utf8_decode(r.responseHTML);
								// make sure that required wrapper is present on page
								if (!$('.cb-wrapper[data-id="'+idWrapper+'"]').length) {
									$('.hook-content#'+hookName).find('.wrappers-container').append(wrapperHTML);
								}
								addToWrapper(idWrapper, hookName, bannersHTML, false);
								if (act == 'move') {
									removeBannerRows(ids);
								}
							}
							$('.bulk-actions').removeClass('open');
						break;
					}
					blockAjax = false;
				}

			},
			error: function(r)
			{
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	});

	$(document).on('click', '.addBanner', function(e) {
		e.preventDefault();
		var hook_name = $('.hookSelector').val(),
			id_wrapper = $(this).closest('.cb-wrapper').attr('data-id');
		$.ajax({
			type: 'POST',
			url: ajax_action_path+'&action=AddBanner&hook_name='+hook_name+'&id_wrapper='+id_wrapper,
			dataType : 'json',
			success: function(r) {
				if ('banner_form_html' in r) {
					addToWrapper(id_wrapper, hook_name, utf8_decode(r.banner_form_html), true);
					$('.cb-wrapper[data-id='+id_wrapper+']').find('.banner-item').first().find('.editBanner').click();
					activateDatePicker();
				}
			},
			error: function(r) {
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	});

	$(document).on('click', '.addWrapper', function(e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: ajax_action_path+'&action=AddWrapper',
			dataType : 'json',
			success: function(r) {
				if ('wrapper_html' in r) {
					$('.hook-content.active').find('.wrappers-container').prepend(utf8_decode(r.wrapper_html));
					activateSortable();
				}
			},
			error: function(r) {
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	}).on('click', '.deleteWrapper', function(e) {
		var $wrapperContainer = $(this).closest('.cb-wrapper')
			id_wrapper = $wrapperContainer.attr('data-id');
		$.ajax({
			type: 'POST',
			url: ajax_action_path+'&action=DeleteWrapper&id_wrapper='+id_wrapper,
			dataType : 'json',
			success: function(r) {
				if (r.deleted) {
					$wrapperContainer.remove();
				}
			},
			error: function(r) {
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	});

	$(document).on('submit', '.w-settings-form', function(e) {
		e.preventDefault();
	}).on('focusin', '.save-on-the-fly', function(e) {
		$(this).data('initial-value', $(this).val());
	}).on('keyup', '.save-on-the-fly', function(e) {
		var $el = $(this);
		if (e.which == 13 && $el.val() != $el.data('initial-value')) {
			$el.trigger('change');
		}
		clearTimeout(cbSaveOnTheFlyTimeOut);
		cbSaveOnTheFlyTimeOut = setTimeout(function() {
			if ($el.val() != $el.data('initial-value')) {
				$el.removeClass('already-saved').trigger('change').addClass('already-saved');
			}
		}, 2000);
	}).on('change', '.save-on-the-fly', function() {
		clearTimeout(cbSaveOnTheFlyTimeOut);
		var $el = $(this);
		if ($el.hasClass('already-saved')) {
			$el.removeClass('already-saved');
			return;
		}
		var	$form = $el.closest('form'),
			additionalParams = 'save_single_value='+$el.attr('name');
			response = function(r) {
				if ('saved' in r) {
					$el.addClass('just-saved');
					setTimeout(function() {
						$el.removeClass('just-saved');
					}, 1000);
					if ($el.attr('name') == 'display_type') {
						$el.closest('form').find('.callSettings[data-settings="carousel"]').toggleClass('hidden', $el.val() != 2);
					}
				}
			};
		saveWrapperSettings($form, additionalParams, 'general', response);
	});

	$(document).on('click', '.saveCarouselSettings', function(e) {
		e.preventDefault();
		var $form = $(this).closest('form'),
			response = function(r) {
				$form.slideUp(function() {
					$('.callSettings.active').removeClass('active');
				});
			};
		saveWrapperSettings($form, '', 'carousel', response);
	});

	function saveWrapperSettings($form, additionalParams, settingsType, response) {
		$('.wrapper-settings-error').remove();
		var data = $form.serialize()+'&settings_type='+settingsType+'&'+additionalParams;
		$.ajax({
			type: 'POST',
			url: ajax_action_path+'&action=SaveWrapperSettings',
			data: data,
			dataType : 'json',
			success: function(r) {
				console.dir(r);
				if ('errors' in r) {
					var errorHTML = '<div class="wrapper-settings-error">'+utf8_decode(r.errors)+'</div>';
					$form.before(errorHTML);
				} else if ('saved' in r) {
					$.growl.notice({ title: '', message: savedTxt});
				}
				if (typeof response === 'function') {
					response(r);
				}
			},
			error: function(r) {
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	}

	$(document).on('click', 'li.dont-hide', function(e) {
		e.preventDefault();
		$el = $(e.target);
		// tweak to leave .btn-group open. Otherwise it is closed on any click on dropdown list element
		$el.closest('.btn-group').addClass('force-open');
		setTimeout(function() {
			$el.closest('.btn-group').removeClass('force-open').addClass('open');
		}, 50);
		if ($el.hasClass('toggle-hook-list')) {
			$el.closest('li').siblings().find('.dynamic-hook-list').hide();
			if (!$el.siblings('.dynamic-hook-list').find('select').length) {
				var selectHTML = '<select>';
				$('.hookSelector option').each(function() {
					selectHTML += '<option value="'+$(this).val()+'">'+$(this).val()+'</option>';
				});
				selectHTML += '</select>';
				$el.siblings('.dynamic-hook-list').prepend(selectHTML);
			}
		}
		$el.siblings('.dynamic-hook-list').toggle();
	});

	$(document).on('click', '.copyToAnotherHook, .moveToAnotherHook', function(e) {
		e.preventDefault();
		var id_banner = $(this).closest('.banner-item').attr('data-id');
		var to_hook = $(this).siblings('select').val();
		var delete_original = $(this).hasClass('moveToAnotherHook') ? 1 : 0;
		var params = '&action=CopyToAnotherHook&id_banner='+id_banner+'&to_hook='+to_hook+'&delete_original='+delete_original;
		$.ajax({
			type: 'POST',
			url: ajax_action_path+params,
			dataType : 'json',
			success: function(r) {
				console.dir(r);
				if (r.new_banner_form) {
					$('[data-id="'+id_banner+'"]').find('.actions .icon-caret-down, .copy-banner a').click();
					// make sure that required wrapper is present on page
					if (!$('.cb-wrapper[data-id="'+r.append_to_wrapper_id+'"]').length) {
						$('.hook-content#'+to_hook).find('.wrappers-container').append(utf8_decode(r.new_wrapper_form));
					}
					var id_wrapper = r.append_to_wrapper_id,
						banner_html = utf8_decode(r.new_banner_form);
					addToWrapper(id_wrapper, to_hook, banner_html, false);

					if (delete_original) {
						removeBannerRows(id_banner);
					}
					$.growl.notice({ title: '', message: r.reponseText});
				} else {
					$.growl.error({ title: '', message: r.reponseText});
				}

			},
			error: function(r) {
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	});

	$(document).on('click', '.deleteBanner', function(e) {
		e.preventDefault();
		if (!confirm('Are you sure?'))
			return;
		var id_banner = $(this).closest('.banner-item').attr('data-id');
		$.ajax({
			type: 'POST',
			url: ajax_action_path+'&action=DeleteBanner&id_banner='+id_banner,
			dataType : 'json',
			success: function(r)
			{
				console.dir(r);
				if (r.deleted)
					removeBannerRows(id_banner);
			},
			error: function(r)
			{
				console.warn($(r.responseText).text() || r.responseText);
			}
		});

	});

	$(document).on('click', '.callSettings', function(e) {
		e.preventDefault();
		var $el = $(this),
			settings_type = $el.data('settings');
			id_wrapper = $el.closest('cb-wrapper').attr('data-id'),
			hook_name = $(this).closest('form').find('.hookSelector').val();

		$('#settings-content').hide().html('');
		$('.carousel-settings-form').hide();
		$('.callSettings').not(this).removeClass('active');
		if ($el.hasClass('active')) {
			$el.removeClass('active');
			return;
		}
		if (settings_type == 'carousel') {
			$el.addClass('active').closest('.cb-wrapper').find('.carousel-settings-form').slideDown();
			return;
		}

		$.ajax({
			type: 'POST',
			url: ajax_action_path+'&action=CallSettingsForm&settings_type='+settings_type+'&hook_name='+hook_name,
			dataType : 'json',
			success: function(r) {
				if ('form_html' in r) {
					$('#settings-content').html(utf8_decode(r.form_html)).slideDown();
					 $('body').tooltip({
						selector: '.label-tooltip'
					});
					$el.addClass('active');
				}
			},
			error: function(r) {
				$('#settings-content').hide().html('');
				$('.carousel-settings-form').hide();
				$('.callSettings').removeClass('active');
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	});

	$(document).on('click', '.hide-settings', function() {
		$('.callSettings.active').click();
	});

	$(document).on('click', '.chk-action', function(e) {
		e.preventDefault();
		var $checkboxes = $(this).closest('#settings-content').find('input[type="checkbox"]');
		if ($(this).hasClass('checkall')) {
			$checkboxes.each(function() {
				$(this).prop('checked', true);
			});
		}
		else if ($(this).hasClass('uncheckall')) {
			$checkboxes.each(function() {
				$(this).prop('checked', false);
			});
		}
		else if ($(this).hasClass('invert')) {
			$checkboxes.each(function() {
				$(this).prop('checked', !$(this).prop('checked'));
			});
		}
	});

	// avoid flickering before positioning quick search
	$('.quick-search').removeClass('absolute');
	var absolute = $('.quick-search').offset().top != $('.addWrapper').offset().top;
	$('.quick-search').removeClass('transparent').toggleClass('absolute', absolute);
	if (absolute) {
		$('.toggleSearch').on('click', function(){
			var $searchBlock = $(this).closest('.quick-search');
			$searchBlock.toggleClass('active');
			if (!$searchBlock.hasClass('active')) {
				$('.searchBy').val('banner_name').change();
			}
		});
	}
	$('.searchBy').on('change', function(){
		$('.searchByValue').val('').trigger('keyup');
	});
	$('.searchByValue').on('keyup', function(){
		var by = $('.searchBy').val(),
			val = $(this).val().toLowerCase(),
			matchesNum = 0;
		if (!val && by == 'banner_name') {
			$('.hook-content.active').find('.cb-wrapper').removeClass('hidden')
			.find('.banner-item').removeClass('hidden');
			return;
		}
		$('.hook-content.active').find('.banner-item').each(function(){
			var hidden = false;
			switch (by) {
				case 'banner_name':
					hidden = $(this).find('.banner-name').text().toLowerCase().indexOf(val) < 0;
					break;
				case 'product':
				case 'category':
				case 'manufacturer':
				case 'supplier':
				case 'cms':
					var $excBlock = $(this).find('.exceptions-block.page'),
						savedIDs = formatIDs($excBlock.find('.ids').val()),
						searchedIDs = formatIDs(val);
					hidden = $excBlock.find('.exc').val() != by;
					for (var i in searchedIDs) {
						if (!hidden) {
							hidden = $.inArray(searchedIDs[i], savedIDs) < 0;
						} else {
							break;
						}
					}
					break;
			}
			$(this).toggleClass('hidden', !!hidden);
			if (!$(this).next().length) {
				var $wrapper = $(this).closest('.cb-wrapper');
				$wrapper.toggleClass('hidden', !$wrapper.find('.banner-item').not('.hidden').length);
			}
			if (!hidden) {
				matchesNum++;
			}
		});
		$('.no-matches').toggleClass('hidden', matchesNum > 0);
	});

	function formatIDs(ids)
	{
		ids = $.map(ids.split(','), function(val) {
			return parseInt(val) || null;
		});
		return ids;
	}

	$(document).on('click', '.saveHookSettings', function(e) {
		e.preventDefault();
		var hook_name = $(this).attr('data-hook');
		var data = $(this).closest('form').serialize();
		$.ajax({
			type: 'POST',
			url: ajax_action_path+'&action=SaveHookSettings&'+data,
			dataType : 'json',
			success: function(r)
			{
				console.dir(r);
				if (r.saved) {
					$('#settings-content').slideUp(function() {
						$('.callSettings').removeClass('active');
						$(this).html('');
						$.growl.notice({ title: '', message: savedTxt});
					});
				}
			},
			error: function(r)
			{
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	});

	$(document).on('click', '.custom-code', function() {
		var $textarea = $($(this).data('target')+' .textarea-code');
		$textarea.css('visibility', 'hidden');
		var file_type = $textarea.closest('form').find('input[name="file_type"]').val();
		$.ajax({
			type: 'POST',
			url: ajax_action_path+'&action=GetCustomCode&file_type='+file_type,
			dataType : 'json',
			success: function(r)
			{
				$textarea.val(utf8_decode(r.code)).css('visibility', 'visible');
			},
			error: function(r)
			{
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	});

	$(document).on('click', '.saveCustomFile', function(e) {
		e.preventDefault();
		var code = $(this).closest('form').find('textarea').val();
		// Tools::getValue strips backslashes, so they should be escaped here
		code = code.replace(/\\/g, '\\\\');
		var file_type = $(this).closest('form').find('input[name="file_type"]').val();
		var $closeBtn = $(this).closest('.file-form').find('.close');
		$.ajax({
			type: 'POST',
			url: ajax_action_path+'&action=SaveCustomFile',
			data: {
				code : code,
				file_type : file_type
			},
			dataType : 'json',
			success: function(r)
			{
				console.dir(r);
				if (r.saved) {
					$.growl.notice({ title: '', message: savedTxt});
					$closeBtn.click();
				}
				else
					$.growl.error({ title: '', message: failedTxt});
			},
			error: function(r)
			{
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	});

	$(document).on('click', '.importBannersData', function(e) {
		$(this).hide().next().show();
	});

	$(document).on('submit', '.zip-uploader', function(e) {
		e.preventDefault();
		$('.general-ajax-errors').slideUp().html('');
		$submitBtn = $(this).find('button[type=submit]');
		$submitBtn.find('span').css('opacity','0').siblings('i').show();
		var fd = new FormData();
		$(this).find('input[type="file"]').each(function() {
			if ($(this).prop('files').length > 0)
				fd.append($(this).attr('name'), $(this).prop('files')[0]);
		});
		var otherParams = $(this).serializeArray();
		$.each(otherParams, function (i, val) {
			fd.append(val.name, val.value);
		});

		$.ajax({
			type: 'POST',
			url: ajax_action_path,
			dataType : 'json',
			processData: false,
			contentType: false,
			data: fd,
			success: function(r)
			{
				console.dir(r);
				if ('errors' in r)
					$submitBtn.closest('.panel').find('h3').after(utf8_decode(r.errors));
				else {
					$upd = $('<div>'+utf8_decode(r.upd_html)+'</div>');
					$('.all-banners').replaceWith($upd.find('.all-banners'));
					$('.all-banners').find('.hookSelector').change();
					$('.all-banners').before($upd.find('.module_confirmation'));
					activateSortable();
					activateDatePicker();
				}
				$submitBtn.find('span').css('opacity','1').siblings('i').hide();
			},
			error: function(r)
			{
				$submitBtn.find('span').css('opacity','1').siblings('i').hide();
				console.warn($(r.responseText).text() || r.responseText);
			}
		});
	});

	// ajax progress
	$('body').append('<div id="re-progress"><div class="progress-inner"></div></div>');
	$(document).ajaxStart(function() {
		$('#re-progress .progress-inner').width(0).fadeIn('fast').animate({'width':'70%'},500);
	})
	.ajaxSuccess(function() {
		$('#re-progress .progress-inner').animate({'width':'100%'},500,function() {
			$(this).fadeOut('fast');
		});
	})

	// check for multiple ids
	// $('[id]').each(function() {
	// 	var ids = $('[id="'+this.id+'"]');
	// 	if(ids.length>1 && ids[0]==this)
	// 	console.warn('Multiple IDs #'+this.id);
	// });
})

function activateSortable() {
	$('.banner-list, .wrappers-container').each(function() {
		if ($(this).hasClass('ui-sortable')) {
			return;
		}
		var isBannerList = $(this).hasClass('banner-list') ? 1 : 0,
			connectWith = isBannerList ? '.banner-list' : '',
			params = {
				placeholder: 'new-position-placeholder',
				connectWith: connectWith,
				handle: '.dragger',
				start: function(e, ui) {
	                var $item = ui.item,
	                    css = {
	                        'height': $item.innerHeight(),
						};
	                $('.new-position-placeholder').css(css);
	            },
				update: function(event, ui) {
					var $item = ui.item,
						$parent = $item.parent(),
						id_wrapper = isBannerList ? $parent.closest('.cb-wrapper').attr('data-id') : false;
					// update may be called twice if elements are moved among wrappers
					// the following condition makes sure positions are updated only once
					if (this === $parent[0]) {
						$.ajax({
							type: 'POST',
							url: ajax_action_path+'&action=UpdatePositionsInHook',
							dataType : 'json',
							data: {
								ordered_ids: getOrderedIds($item.closest('.hook-content')),
								moved_element_is_banner: isBannerList,
								moved_element_wrapper_id: id_wrapper,
								moved_element_id: $item.attr('data-id'),
							},
							success: function(r) {
								if('successText' in r) {
									$.growl.notice({ title: '', message: r.successText});
									if (isBannerList) {
										$item.find('input[name="id_wrapper"]').val(id_wrapper);
									}
								}
								markEmptyWrappers();
							},
							error: function(r) {
								$.growl.error({ title: '', message: 'Error'});
								console.warn($(r.responseText).text() || r.responseText);
							}
						});
					}
				}
			};
		$(this).sortable(params);
	});
}

function activateDatePicker(){
	$('.datepicker').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:00',
        onClose:  function(current_time, $el){
        	// minimal timeout for clicking "clear"
			setTimeout(function(){
				$el.input.closest('.form-group').find('.clear-date').addClass('hidden');
			}, 100);
        },

	});
	$('.hasDatepicker').on('focusin', function(){
		$(this).closest('.form-group').find('.clear-date').removeClass('hidden');
	});
	$('.clear-date').on('click', function(){
		$(this).closest('.form-group').find('.hasDatepicker').val('');
	});
}

function getOrderedIds($container) {
	var ordered_ids = [];
	$container.find('.banner-item').each(function() {
		ordered_ids.push($(this).attr('data-id'));
	});
	return ordered_ids;
}

function markEmptyWrappers() {
	$('.cb-wrapper').each(function() {
		$(this).toggleClass('empty', !$(this).find('.banner-item').length);
	});
}

function selectLanguage($el, id) {
	$el.closest('.banner-item').find('.multilang').hide();
	$el.closest('.banner-item').find('.multilang.lang-'+id).show().find('textarea.mce:visible').not('.mce-activated').each(function(i) {
		prepareVisibleTextarea($(this));
	});
	$el.closest('.banner-item').find('input[name="lang_source"]').val(id);
}

function prepareVisibleTextarea($el)
{
	// add minimal timeout for smooth sliding
	setTimeout(function() {
		tinySetup({
			selector: '#'+$el.attr('id'),
			onloadContent: $el.addClass('mce-activated'),
			content_css: pathCSS+'global.css',
		});
	}, 100);
}

// tabulation for textarea
$(document).delegate('.textarea-code', 'keydown', function(e) {
	var keyCode = e.keyCode || e.which;
	if (keyCode == 9) {
		e.preventDefault();
		var start = $(this).get(0).selectionStart;
		var end = $(this).get(0).selectionEnd;

		// set textarea value to: text before caret + tab + text after caret
		$(this).val($(this).val().substring(0, start)+'\t'+ $(this).val().substring(end));
		// put caret at right position again
		$(this).get(0).selectionStart =	$(this).get(0).selectionEnd = start + 1;
	}
});

function addToWrapper(id_wrapper, hook_name, html, prepend) {
	var $wrapper = $('.cb-wrapper[data-id="'+id_wrapper+'"]');
	if (prepend) {
		$wrapper.removeClass('empty').find('.banner-list').prepend(html);
	} else {
		$wrapper.removeClass('empty').find('.banner-list').append(html);
	}
	var banners_num = $('#'+hook_name).find('.banner-item').length;
	$('.hookSelector').find('option[value="'+hook_name+'"]').text(hook_name+' ('+banners_num+')');
	$('.banner-item').tooltip({selector: '.label-tooltip'});
}

function removeBannerRows(ids) {
	if (!$.isArray(ids))
		ids = [ids];
	var lastId = ids[ids.length - 1];
	for (var i in ids) {
		$('.banner-item[data-id="'+ids[i]+'"]').fadeOut(function() {
			if ($(this).data('id') == lastId) {
				var hook_name = $('.hookSelector').val();
				var banners_num = $('#'+hook_name+' .banner-item').length - 1;
				$('.hookSelector').find('option:selected').text(hook_name+' ('+banners_num+')');
				if (!$(this).siblings().length) {
					$(this).closest('.cb-wrapper').addClass('empty');
				}
			}
			$(this).remove();
		});
	}
}

function utf8_decode(utfstr) {
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
/* since 2.9.1 */
