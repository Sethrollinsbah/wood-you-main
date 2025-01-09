/**
*  @author    Prestapro
*  @copyright Prestapro
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

var compareWishlistPro = (function() {
  var wishlistProductsIds = [],
      comparisonProductsIds = [],
      notifier = new AWN({position: 'top-right'}),
      notificationImage,
      addToCartForm,
      addToCartURL,
      toggleFeaturesButton,
      timers = {};

  function initCatalogButtons() {
    $('.easywishlist-catalog-buttons').each(function() {
      $(this).closest('.product-miniature').append($(this).removeClass('wishlist-hidden'));
    });
  }

  function showSendComparisonForm(button) {
    $('#send-comparison-form').slideDown();
    button.addClass('easywishlist-hidden');
  }

  function hideSendComparisonForm() {
    $('#send-comparison-form').slideUp(function() {
      $('#show-send-comparison-form').removeClass('easywishlist-hidden');
    });
  }

  function fallbackCopyTextToClipboard(text) {
    var textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.top = '0';
    textArea.style.left = '0';
    textArea.style.position = 'fixed';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
      var successful = document.execCommand('copy'),
          msg = successful ? 'successful' : 'unsuccessful';
    } catch (err) {
      notifier.alert('Fallback: Unable to copy' + err);
      console.error('Fallback: Unable to copy', err);
    }

    document.body.removeChild(textArea);
  }

  function copyTextToClipboard(text, event) {
    event.preventDefault();

    if (!navigator.clipboard) {
      fallbackCopyTextToClipboard(text);
      return;
    }

    navigator.clipboard.writeText(text).then(function() {
      notifier.success('Permalink copied to clipboard');
    }, function(err) {
      notifier.alert('Async: Could not copy text: ' + err);
      console.error('Async: Could not copy text: ', err);
    });
  }

  function preloadNotificationImage(url) {
    if (!(notificationImage instanceof HTMLImageElement) || notificationImage.src != url) {
      notificationImage = new Image();
      notificationImage.classList.add('comparison-preview');
      notificationImage.src = url;
    }
  }

  function addProductToComparison(id_product, button) {
    var data = {
      'action': 'add',
      'id_product': id_product,
      'token': comparewishlistpro.static_token
    };

    $.ajax({
      type: 'GET',
      url: comparewishlistpro.controller.comparisontools + '?rand=' + new Date().getTime(),
      headers: { "cache-control": "no-cache" },
      async: true,
      cache: false,
      data: $.param(data),
      dataType: 'json'
    }).done(function(data) {
      comparisonProductsIdsAdd(id_product);
      comparisonRefreshStatus();
      $('.compare-products-count').text(parseInt(data.count));

      if (typeof button !== 'undefined') {
        button.addClass('easywishlist-active');
      }

      notifier.success(notificationImage.outerHTML + comparewishlistpro.added_to_comparison.replace(/%s/g, button.data('product-name')) + unescape(comparewishlistpro.comparison_link));
    });
  }

  function updateLinks(permalink) {
    $('.comparison-copy-permalink').data('permalink', permalink);
    $('.comparison-social').each(function() {
      $(this).attr('href', $(this).data('link').replace(/%s/g, escape(permalink)));
    });
  }

  function hideComparisonTable() {
    $('.comparison-table, .easywishlist-panel, .comparison-permalink.card').fadeOut(function() {
      $('.empty-comparison').fadeIn();
    });
  }

  function removeProductFromComparison(id_product, element) {
    var data = {
      'action': 'delete',
      'id_product': id_product,
      'token': comparewishlistpro.static_token
    };

    $.ajax({
      type: 'GET',
      url: comparewishlistpro.controller.comparisontools + '?rand=' + new Date().getTime(),
      headers: { "cache-control": "no-cache" },
      async: true,
      cache: false,
      data: $.param(data),
      dataType: 'json'
    }).done(function(data) {
      comparisonProductsIdsRemove(id_product);
      comparisonRefreshStatus();
      $('.compare-products-count').text(parseInt(data.count));
      updateLinks(data.permalink);

      if (element.hasClass('easywishlist-active')) {
        element.removeClass('easywishlist-active');
      }

      var productCell = element.closest('.comparison-item');

      if (productCell.length > 0) {
        productCell.fadeOut(function() {
          $(this).remove();

          if ($('.comparison-table .comparison-item').length < 1) {
            hideComparisonTable();
          } else {
            var productBlock = $('.comparison-products'),
                productBlockPosition = parseInt(productBlock.css('left')),
                productBlockWidth = productBlock.width(),
                parentWidth = $('.comparison-table').width(),
                categoryID = $(this).data('id-category'),
                categoryFilterButton = $('.easywishlist-category-filter-button[data-id-category="' + categoryID + '"]'),
                categoryFilterCount = categoryFilterButton.find('.easywishlist-category-product-count'),
                categoryFilterCountValue = parseInt(categoryFilterCount.text()),
                newCategoryFilterCountValue = categoryFilterCountValue - 1,
                itemWidth = $('.comparison-item').eq(0).width() + 1;

            if (productBlockPosition < 0 && productBlockWidth > parentWidth) {
              productBlock.css('left', productBlockPosition + itemWidth);
            }

            if (newCategoryFilterCountValue >= 1) {
              categoryFilterCount.text(newCategoryFilterCountValue);
            } else {
              categoryFilterButton.fadeOut();
              $('.easywishlist-category-filter-button').eq(0).click();
            }
          }

          filterFeatures($('.easywishlist-feature-filter-button.active').data('show'));
          hideEmptyFeatureRows();
          updateNav();
          updateHeadersHeight();
        });

        $('.comparison-list li[data-id-product="' + id_product + '"]').remove();
      }

      notifier.success(notificationImage.outerHTML + comparewishlistpro.removed_from_comparison.replace(/%s/g, element.data('product-name')) + unescape(comparewishlistpro.comparison_link));
    });
  }

  function removeMultipleProductsFromComparison(id_product) {
    var data = {
      'action': 'delete',
      'id_product': id_product,
      'token': comparewishlistpro.static_token
    };

    $.ajax({
      type: 'GET',
      url: comparewishlistpro.controller.comparisontools + '?rand=' + new Date().getTime(),
      headers: { "cache-control": "no-cache" },
      async: true,
      cache: false,
      data: $.param(data),
      dataType: 'json'
    }).done(function(data) {
      var itemSelector = [];

      $.each(id_product, function(index, value) {
        comparisonProductsIdsRemove(value);
        itemSelector.push('.comparison-item[data-id-product="' + value + '"], .comparison-list li[data-id-product="' + value + '"]');
      });

      comparisonRefreshStatus();
      $('#compare-products-count').text(parseInt(data.count));
      updateLinks(data.permalink);

      $(itemSelector.join(',')).fadeOut(function() {
        $(this).remove();

        filterFeatures($('.easywishlist-feature-filter-button.active').data('show'));
        hideEmptyFeatureRows();
        updateHeadersHeight();

        if ($('.comparison-table .comparison-item').length < 1) {
          hideComparisonTable();
        }
      });
    });
  }

  function WishlistCart(id, action, id_product, id_product_attribute, quantity, id_wishlist, button) {
    var wishlistSelect = $('#idWishlist');

    if (wishlistSelect.length > 0) {
      id_wishlist = wishlistSelect.val();
    }

    $.ajax({
      type: 'GET',
      url: comparewishlistpro.controller.cart + '?rand=' + new Date().getTime(),
      headers: { "cache-control": "no-cache" },
      async: true,
      cache: false,
      data: 'action=' + action + '&id_product=' + id_product + '&quantity=' + quantity + '&token=' + comparewishlistpro.static_token + '&id_product_attribute=' + id_product_attribute + '&id_wishlist=' + id_wishlist,
      dataType: 'json',
      success: function(data) {
        if (action == 'add') {
          if (comparewishlistpro.isLogged == true) {
            wishlistProductsIdsAdd(id_product);
            wishlistRefreshStatus();

            if (typeof button !== 'undefined') {
              button.addClass('easywishlist-active');
              button.find('svg').replaceWith($('.wishlist-icons .cwp-wishlist-icon-active').first().clone());
            }

            notifier.success(notificationImage.outerHTML + comparewishlistpro.added_to_wishlist.replace(/%s/g, button.data('product-name')));
          } else {
            notifier.alert(comparewishlistpro.loggin_required);
          }
        }

        if (action == 'delete') {
          wishlistProductsIdsRemove(id_product);
          wishlistRefreshStatus();

          if (typeof button !== 'undefined') {
            button.removeClass('easywishlist-active');
            button.find('svg').replaceWith($('.wishlist-icons .cwp-wishlist-icon').first().clone());
          }

          notifier.success(notificationImage.outerHTML + comparewishlistpro.removed_from_wishlist.replace(/%s/g, button.data('product-name')));
        }

        if (typeof data.wishlist_product_count !== 'undefined') {
          $('.wishlist-products-count').text(data.wishlist_product_count);

          var icon_active = $('.easywishlist-block-nav .cwp-wishlist-icon-active'),
              icon_inactive = $('.easywishlist-block-nav .cwp-wishlist-icon'),
              class_hidden = 'wishlist-hidden';

          if (data.wishlist_product_count > 0) {
            icon_active.removeClass(class_hidden);
            icon_inactive.addClass(class_hidden);
          } else {
            icon_active.addClass(class_hidden);
            icon_inactive.removeClass(class_hidden);
          }
        }
      }
    });
  }

  function WishlistChangeDefault(id, id_wishlist) {
    $.ajax({
      type: 'GET',
      url: comparewishlistpro.controller.cart + '?rand=' + new Date().getTime(),
      headers: { "cache-control": "no-cache" },
      async: true,
      data: 'id_wishlist=' + id_wishlist + '&token=' + comparewishlistpro.static_token,
      cache: false,
      success: function(data) {
        $('#' + id).slideUp('normal');
        document.getElementById(id).innerHTML = data;
        $('#' + id).slideDown('normal');
      }
    });
  }

  function WishlistBuyProduct(token, id_product, id_product_attribute, id_quantity, button, ajax) {
    if (ajax) {
      var addToCartForm = $('#addtocart_' + id_product + '_' + id_product_attribute),
          query = addToCartForm.serialize() + '&qty=' + $('#quantity_' + id_quantity).val() + '&action=update';

      $.post(addToCartForm.attr('action'), query, null, 'json').then(function(response) {
        prestashop.emit('updateCart', {
          reason: {
            idProduct: response.id_product,
            idProductAttribute: response.id_product_attribute,
            linkAction: 'add-to-cart',
            cart: response.cart
          },
          resp: response
        });
      }).fail(function(response) {
        prestashop.emit('handleError', {
          eventType: 'addProductToCart',
          resp: response
        });
      });
    } else {
      $('#' + id_quantity).val(0);
      WishlistAddProductCart(token, id_product, id_product_attribute, id_quantity)
      document.forms['addtocart' + '_' + id_product + '_' + id_product_attribute].method='POST';
      document.forms['addtocart' + '_' + id_product + '_' + id_product_attribute].action=baseUri + '?controller=cart';
      document.forms['addtocart' + '_' + id_product + '_' + id_product_attribute].elements['token'].value = comparewishlistpro.static_token;
      document.forms['addtocart' + '_' + id_product + '_' + id_product_attribute].submit();
    }

    return (true);
  }

  function WishlistAddProductCart(token, id_product, id_product_attribute, id_quantity) {
    if ($('#' + id_quantity).val() <= 0)
      return (false);

    $.ajax({
        type: 'GET',
        url: comparewishlistpro.controller.buywishlistproduct + '?rand=' + new Date().getTime(),
        headers: { "cache-control": "no-cache" },
        data: 'token=' + token + '&static_token=' + comparewishlistpro.static_token + '&id_product=' + id_product + '&id_product_attribute=' + id_product_attribute,
        async: true,
        cache: false,
        success: function(data) {
          if (data) {
            notifier.alert(data);
          } else {
            $('#' + id_quantity).val($('#' + id_quantity).val() - 1);
          }
        }
    });

    return (true);
  }

  function WishlistManage(id, id_wishlist) {
    $.ajax({
      type: 'GET',
      async: true,
      url: comparewishlistpro.controller.managewishlist + '?rand=' + new Date().getTime(),
      headers: { "cache-control": "no-cache" },
      data: 'id_wishlist=' + id_wishlist + '&refresh=' + false,
      cache: false,
      success: function(data) {
        $('#' + id).fadeOut(function() {
          document.getElementById(id).innerHTML = data;
          $('#' + id).fadeIn('slow');

          $('.wishlist_change_button').each(function(index) {
            $(this).change(function () {
              wishlistProductChange($('option:selected', this).attr('data-id-product'), $('option:selected', this).attr('data-id-product-attribute'), $('option:selected', this).attr('data-id-old-wishlist'), $('option:selected', this).attr('data-id-new-wishlist'));
            });
          });
        });
      }
    });
  }

  function WishlistProductManage(id, action, id_wishlist, id_product, id_product_attribute, quantity, priority) {
    $.ajax({
      type: 'GET',
      async: true,
      url: comparewishlistpro.controller.managewishlist + '?rand=' + new Date().getTime(),
      headers: { "cache-control": "no-cache" },
      data: 'action=' + action + '&id_wishlist=' + id_wishlist + '&id_product=' + id_product + '&id_product_attribute=' + id_product_attribute + '&quantity=' + quantity + '&priority=' + priority + '&refresh=' + true,
      cache: false,
      success: function(data) {
        if (action == 'delete') {
          $('#wlp_' + id_product + '_' + id_product_attribute).fadeOut('fast');
        } else if (action == 'update') {
          $('#wlp_' + id_product + '_' + id_product_attribute).fadeOut('fast');
          $('#wlp_' + id_product + '_' + id_product_attribute).fadeIn('fast');
        }

        nb_products = 0;
        $("[id^='quantity']").each(function(index, element) {
          nb_products += parseInt(element.value);
        });
        $("#wishlist_"+id_wishlist).children('td').eq(1).html(nb_products);
      }
    });
  }

  function WishlistDelete(id, id_wishlist, msg) {
    var res = confirm(msg);

    if (res == false) {
      return false;
    }

    if (typeof comparewishlistpro.mywishlist_url == 'undefined') {
      return false;
    }

    $.ajax({
      type: 'GET',
      async: true,
      dataType: "json",
      url: comparewishlistpro.mywishlist_url,
      headers: { "cache-control": "no-cache" },
      cache: false,
      data: {
        rand: new Date().getTime(),
        deleted: 1,
        myajax: 1,
        id_wishlist: id_wishlist,
        action: 'deletelist'
      },
      success: function(data) {
        var mywishlist_siblings_count = $('#' + id).siblings().length;
        $('#' + id).fadeOut('slow').remove();
        $("#block-order-detail").html('');

        if (mywishlist_siblings_count == 0) {
          $("#block-history").remove();
        }

        if (data.id_default) {
          var td_default = $("#wishlist_" + data.id_default + " > .wishlist_default");
          $("#wishlist_" + data.id_default + " > .wishlist_default > a").remove();
          td_default.append('<span class="is_wish_list_default"><i class="material-icons">check_box</i></i></span>');
        }
      }
    });
  }

  function WishlistDefault(id, id_wishlist) {
    if (typeof comparewishlistpro.mywishlist_url == 'undefined') {
      return (false);
    }

    $.ajax({
      type: 'GET',
      async: true,
      url: comparewishlistpro.mywishlist_url,
      headers: { "cache-control": "no-cache" },
      cache: false,
      data: {
        rand:new Date().getTime(),
        'default': 1,
        id_wishlist: id_wishlist,
        myajax: 1,
        action: 'setdefault'
      },
      success: function (data) {
        var old_default_id = $(".is_wish_list_default").parents("tr").attr("id");
        var td_check = $(".is_wish_list_default").parent();
        $(".is_wish_list_default").remove();
        td_check.append('<a href="#" onclick="event.preventDefault();(compareWishlistPro.WishlistDefault(\''+old_default_id+'\', \''+old_default_id.replace("wishlist_", "")+'\'));"><i class="material-icons">check_box_outline_blank</i></a>');
        var td_default = $("#"+id+" > .wishlist_default");
        $("#"+id+" > .wishlist_default > a").remove();
        td_default.append('<span class="is_wish_list_default"><i class="material-icons">check_box</i></span>');
      }
    });
  }

  function WishlistVisibility(bought_class, id_button) {
    if ($('#hide' + id_button).is(':hidden')) {
      $('.' + bought_class).slideDown();
      $('#show' + id_button).hide();
      $('#hide' + id_button).css('display', 'block');
    } else {
      $('.' + bought_class).slideUp();
      $('#hide' + id_button).hide();
      $('#show' + id_button).css('display', 'block');
    }
  }

  function WishlistSend(id, id_wishlist, id_email) {
    var firstEmail = $('#' + id_email + '1').val();

    if (firstEmail.trim() === '') {
      notifier.warning('Specify at least one email address');
      return false;
    }

    $.post(
      comparewishlistpro.controller.sendwishlist,
      {
        token: comparewishlistpro.static_token,
        mode: 'wishlist',
        id_wishlist: id_wishlist,
        email1: $('#' + id_email + '1').val(),
        email2: $('#' + id_email + '2').val(),
        email3: $('#' + id_email + '3').val(),
        email4: $('#' + id_email + '4').val(),
        email5: $('#' + id_email + '5').val(),
        email6: $('#' + id_email + '6').val(),
        email7: $('#' + id_email + '7').val(),
        email8: $('#' + id_email + '8').val(),
        email9: $('#' + id_email + '9').val(),
        email10: $('#' + id_email + '10').val()
      },
      function(data) {
        if (data) {
          notifier.alert(data);
        } else {
          notifier.success('Your wishlist has been sent');
          WishlistVisibility(id, 'hideSendWishlist');
          $('#showSendWishlist').show();
        }
      }
    );
  }

  function sendComparison() {
    var firstEmail = $('#comparison-email').val();

    if (firstEmail.trim() === '') {
      notifier.warning('Please enter an email address');
      return false;
    }

    $.post(
      comparewishlistpro.controller.sendwishlist,
      {
        token: comparewishlistpro.static_token,
        mode: 'comparison',
        id_product: $('#comparison-send-permalink').data('id-product'),
        email1: firstEmail,
      },
      function(data) {
        if (data) {
          notifier.alert(data);
        } else {
          notifier.success('Permalink to your product comparison has been sent');
        }
      }
    );
  }

  function wishlistProductsIdsAdd(id) {
    if ($.inArray(parseInt(id), wishlistProductsIds) == -1) {
      wishlistProductsIds.push(parseInt(id))
    }
  }

  function comparisonProductsIdsAdd(id) {
    if ($.inArray(parseInt(id), comparisonProductsIds) == -1) {
      comparisonProductsIds.push(parseInt(id))
    }
  }

  function wishlistProductsIdsRemove(id) {
    wishlistProductsIds.splice($.inArray(parseInt(id), wishlistProductsIds), 1)
  }

  function comparisonProductsIdsRemove(id) {
    comparisonProductsIds.splice($.inArray(parseInt(id), comparisonProductsIds), 1)
  }

  function wishlistRefreshStatus() {
    $('.addToWishlist').each(function() {
      if ($.inArray(parseInt($(this).prop('rel')), wishlistProductsIds)!= -1) {
        $(this).addClass('checked');
      } else {
        $(this).removeClass('checked');
      }
    });
  }

  function comparisonRefreshStatus() {
    $('.addToComparison').each(function() {
      if ($.inArray(parseInt($(this).prop('rel')), comparisonProductsIds) != -1) {
        $(this).addClass('checked');
      } else {
        $(this).removeClass('checked');
      }
    });
  }

  function wishlistProductChange(id_product, id_product_attribute, id_old_wishlist, id_new_wishlist) {
    if (typeof comparewishlistpro.mywishlist_url == 'undefined') {
      return (false);
    }

    var quantity = $('#quantity_' + id_product + '_' + id_product_attribute).val();

    $.ajax({
      type: 'GET',
      url: comparewishlistpro.mywishlist_url,
      headers: {
        'cache-control': 'no-cache'
      },
      async: true,
      cache: false,
      dataType: 'json',
      data: {
        id_product:id_product,
        id_product_attribute:id_product_attribute,
        quantity: quantity,
        priority: $('#priority_' + id_product + '_' + id_product_attribute).val(),
        id_old_wishlist:id_old_wishlist,
        id_new_wishlist:id_new_wishlist,
        myajax: 1,
        action: 'productchangewishlist'
      },
      success: function (data) {
        console.log(data);
        console.log(data.msg);

        if (data.success == true) {
          $('#wlp_' + id_product + '_' + id_product_attribute).fadeOut('slow');
          $('#wishlist_' + id_old_wishlist + ' td:nth-child(2)').text($('#wishlist_' + id_old_wishlist + ' td:nth-child(2)').text() - quantity);
          $('#wishlist_' + id_new_wishlist + ' td:nth-child(2)').text(+$('#wishlist_' + id_new_wishlist + ' td:nth-child(2)').text() + +quantity);
        } else {
          if (!!$.prototype.fancybox) {
            $.fancybox.open([{
                type: 'inline',
                autoScale: true,
                minHeight: 30,
                content: '<p class="fancybox-error">' + data.error + '</p>'
            }], {
              padding: 0
            });
          }
        }
      }
    });
  }

  function filterFeatures(mode) {
    var different = false,
        currentRow,
        firstValue;

    $('.filtered-feature').removeClass('filtered-feature').show();

    if (mode == 'differing') {
      $('.comparison-row').not('.hidden-feature').find('.comparison-features').each(function(index) {
        different = false;
        currentRow = $(this).children().not('.filtered-category');

        if (currentRow.length > 1) {
          currentRow.each(function(innerIndex) {
            if (innerIndex == 0) {
              firstValue = $(this).text().trim();
            } else if ($(this).text().trim() != firstValue) {
              different = true;
              return false;
            }
          });
        } else {
          return false;
        }

        if (different === false) {
          $(this).closest('.comparison-row').addClass('filtered-feature').hide();
          $('.comparison-features-container .comparison-headers li').eq(index).addClass('filtered-feature').hide();
        }
      });
    }
  }

  function updateNav() {
    var productsBlock = $('.comparison-products'),
        productsBlockWidth = productsBlock.width(),
        productBlockOffset = parseInt(productsBlock.css('left')) || 0,
        parentBlock = $('.comparison-table'),
        parentBlockWidth = parentBlock.width(),
        navigation = $('.comparison-nav'),
        forwardButton = $('.comparison-nav-next'),
        backButton = $('.comparison-nav-prev'),
        hidingClass = 'easywishlist-hidden';

    if (productsBlockWidth > parentBlockWidth) {
      if (productBlockOffset >= 0) {
        backButton.addClass(hidingClass);
      } else {
        backButton.removeClass(hidingClass);
      }

      if (productsBlockWidth + productBlockOffset <= parentBlockWidth) {
        forwardButton.addClass(hidingClass);
      } else {
        forwardButton.removeClass(hidingClass);
      }
    } else {
      navigation.addClass(hidingClass);
    }
  }

  function colorizeRows() {
    var colorClass = 'comparison-alternate-color',
        rows = $('.comparison-products .comparison-row-basic'),
        headerRows = $('.comparison-headers .comparison-row-basic'),
        featureRows = $('.comparison-features-container .comparison-row'),
        featureHeaderRows = $('.comparison-features-container .comparison-headers li');

    rows.removeClass(colorClass);
    rows.filter(':visible:nth-child(2n)').addClass(colorClass);
    headerRows.removeClass(colorClass);
    headerRows.filter(':visible:nth-child(2n)').addClass(colorClass);
    featureRows.removeClass(colorClass);
    featureRows.filter(':visible:odd').addClass(colorClass);
    featureHeaderRows.removeClass(colorClass);
    featureHeaderRows.filter(':visible:odd').addClass(colorClass);
  }

  function hideEmptyFeatureRows() {
    var empty,
        currentRow;

    $('.hidden-feature').removeClass('hidden-feature').show();
    $('.comparison-section-heading').show();

    $('.comparison-list').each(function(index) {
      empty = true;
      currentRow = $(this).children().filter(':visible');

      if (currentRow.length >= 1) {
        currentRow.each(function(innerIndex) {
          if ($(this).text().trim() !== '') {
            empty = false;
            return false;
          }
        });
      }

      if (empty === true) {
        $(this).closest('.comparison-row').addClass('hidden-feature').hide();
        $('.comparison-headers li').eq(index).addClass('hidden-feature').hide();
      }
    });

    if ($('.comparison-features-container .comparison-row').filter(':visible').length === 0) {
      $('.comparison-section-heading').hide();
    }

    colorizeRows();
  }

  function toggleFeatures(button) {
    var icon = button.find('i'),
        features = $('.comparison-features-container');

    if (button.data('state') == 'show') {
      button.data('state', 'hide');
      icon.text(button.data('icon-hide'));
      features.addClass('easywishlist-hidden');
    } else {
      button.data('state', 'show');
      icon.text(button.data('icon-show'));
      features.removeClass('easywishlist-hidden');
    }
  }

  function updateHeadersHeight() {
    $('.comparison-sidebar .comparison-headers li').each(function(index) {
      $(this).css('height', $('.comparison-table .comparison-products .comparison-row').eq(index).height());
    });
  }

  function updateCellWidth() {
    var half = 0.5,
        third = 0.333333333333333,
        quarter = 0.25,
        fifth = 0.2,
        containerWidth = $('.comparison-table').width(),
        cellWidthPercentage = fifth,
        sidebarExists = $('.comparison-sidebar').length > 0 ? true : false,
        desktopPercentage = fifth,
        tabletPercentage = quarter;

    switch (comparewishlistpro.comparison_table_items_desktop) {
      case 2:
        desktopPercentage = half;
        break;
      case 3:
        desktopPercentage = third;
        break;
      case 4:
        desktopPercentage = quarter;
        break;
      default:
        desktopPercentage = fifth;
        break;
    }

    switch (comparewishlistpro.comparison_table_items_tablet) {
      case 2:
        tabletPercentage = half;
        break;
      case 3:
        tabletPercentage = third;
        break;
      case 4:
        tabletPercentage = quarter;
        break;
      default:
        tabletPercentage = fifth;
        break;
    }

    if (sidebarExists) {
      if (containerWidth > 726) {
        cellWidthPercentage = desktopPercentage;
      } else if (containerWidth > 486) {
        cellWidthPercentage = tabletPercentage;
      } else {
        cellWidthPercentage = half;
      }
    } else {
      if (containerWidth > 928) {
        cellWidthPercentage = desktopPercentage;
      } else if (containerWidth > 688) {
        cellWidthPercentage = tabletPercentage;
      } else {
        cellWidthPercentage = half;
      }
    }

    $('.comparison-item, .comparison-list li').css('width', containerWidth * cellWidthPercentage);
  }

  function waitForFinalEvent(callback, ms, uniqueID) {
    if (!uniqueID) {
      uniqueID = 'uniqueID';
    }

    if (timers[uniqueID]) {
      clearTimeout(timers[uniqueID]);
    }

    timers[uniqueID] = setTimeout(callback, ms);
  }

  function resetTablePosition() {
    $('.comparison-products, .comparison-section-heading').css('left', 0);
    updateNav();
  }

  return {
    init: function() {
      toggleFeaturesButton = $('#comparison-toggle-features');

      wishlistRefreshStatus();

      $(document).on('change', 'select[name=wishlists]', function(){
        WishlistChangeDefault('wishlist_block_list', $(this).val());
      });

      $('.wishlist').each(function() {
        current = $(this);
        $(this).children('.wishlist_button_list').popover({
          html: true,
          content: function () {
            return current.children('.popover-content').html();
          }
        });
      });

      $(document).on('click', '#wishlist-permalink', function() {
        $(this).select();
        document.execCommand('copy');
      });

      $(document).on('click', '.add-product-to-wishlist', function(event) {
        event.preventDefault();
        preloadNotificationImage($(this).data('preview'));

        if ($(this).hasClass('easywishlist-active')) {
          WishlistCart('wishlist_block_list', 'delete', $(this).data('id-product'), 0, 1, null, $(this));

          if (!$(this).hasClass('easywishlist-button-icon')) {
            $(this).find('#wishlist-button-label').text($(this).data('label-add'));
          }
        } else {
          WishlistCart('wishlist_block_list', 'add', $(this).data('id-product'), 0, 1, null, $(this));

          if (!$(this).hasClass('easywishlist-button-icon')) {
            $(this).find('#wishlist-button-label').text($(this).data('label-remove'));
          }
        }
      });

      $(document).on('click', '.comparison-copy-permalink', function(event) {
        copyTextToClipboard($(this).data('permalink'), event);
      });

      $(document).on('mouseover', '.add-product-to-comparison, .remove-product-from-comparison, .add-product-to-wishlist', function() {
        preloadNotificationImage($(this).data('preview'));
      });

      $(document).on('click', '.add-product-to-comparison', function() {
        preloadNotificationImage($(this).data('preview'));

        if ($(this).hasClass('easywishlist-active')) {
          removeProductFromComparison($(this).data('id-product'), $(this));

          if (!$(this).hasClass('easywishlist-button-icon')) {
            $(this).find('#comparison-button-label').text($(this).data('label-add'));
          }
        } else {
          addProductToComparison($(this).data('id-product'), $(this));

          if (!$(this).hasClass('easywishlist-button-icon')) {
            $(this).find('#comparison-button-label').text($(this).data('label-remove'));
          }
        }
      });

      $(document).on('click', '.remove-product-from-comparison', function() {
        preloadNotificationImage($(this).data('preview'));
        removeProductFromComparison($(this).data('id-product'), $(this));
      });

      $(document).on('click', '#comparison-send-permalink', function() {
        sendComparison();
      });

      $(document).on('click', '.easywishlist-category-filter-button', function() {
        var activeCategory = parseInt($(this).data('id-category'))
            comparedProducts = $('.comparison-products .comparison-item');

        $(this).closest('.easywishlist-category-filter').find('button').removeClass('active');
        $(this).addClass('active');
        comparedProducts.show();
        $('.comparison-list .filtered-category').removeClass('filtered-category').show();

        if (activeCategory > 0) {
          comparedProducts.each(function() {
            if ($(this).data('id-category') != activeCategory) {
              $(this).hide();
              $('.comparison-list li[data-id-product="' + $(this).data('id-product') + '"]').addClass('filtered-category').hide();
            }
          });
        }

        resetTablePosition();
        filterFeatures($('.easywishlist-feature-filter-button.active').data('show'));
        hideEmptyFeatureRows();
      });

      $(document).on('click', '#comparison-remove-category', function() {
        var activeCategoryButton = $('.easywishlist-category-filter-button.active'),
            activeCategory = parseInt(activeCategoryButton.data('id-category')),
            productIDs = [];

        if (activeCategory > 0) {
          $('.comparison-item[data-id-category="' + activeCategory + '"]').each(function() {
            productIDs.push($(this).data('id-product'));
          });

          removeMultipleProductsFromComparison(productIDs);
          activeCategoryButton.remove();
          $('.easywishlist-category-filter-button').eq(0).click();
        } else {
          $('.comparison-item').each(function() {
            productIDs.push($(this).data('id-product'));
          });

          removeMultipleProductsFromComparison(productIDs);
          $('.easywishlist-category-filter-button:gt(0)').remove();
        }

        updateNav();
      });

      $(document).on('click', '.easywishlist-feature-filter-button', function() {
        $(this).closest('.easywishlist-feature-filter').find('button').removeClass('active');
        $(this).addClass('active');
        $('#easywishlist-feature-filter').val($(this).data('show'));
        filterFeatures($(this).data('show'));
        hideEmptyFeatureRows();
      });

      $(document).on('change', '#easywishlist-feature-filter', function() {
        $('.easywishlist-feature-filter-button').removeClass('active');
        $('.easywishlist-feature-filter-button[data-show="' + $(this).val() + '"]').addClass('active');
        filterFeatures($(this).val());
        hideEmptyFeatureRows();
      });

      initCatalogButtons();

      $(document).ajaxComplete(function(event, xhr, settings) {
        waitForFinalEvent(function() {
          if ((settings.hasOwnProperty('data')
              && settings.data
              && settings.data.indexOf('action=refresh') !== -1)
          || (settings.url.indexOf('productattributelist') !== -1 && settings.url.indexOf('ajax=1') !== -1)
          || ((settings.url.indexOf('prestasearch') !== -1
              || settings.url.indexOf('advancedsearchfilterpro') !== -1)
            && settings.url.indexOf('xhr=1') !== -1)
          || settings.url.indexOf('from-xhr') !== -1) {
            initCatalogButtons();
          }
        }, 500, 'initCatalogButtons');
      });

      $('.comparison-add-to-cart').each(function() {
        addToCartForm = $(this);
        addToCartURL = addToCartForm.attr('action');

        addToCartForm.find('.add-to-cart').on('click', {form: addToCartForm, url: addToCartURL}, function(event) {
          event.preventDefault();
          var query = event.data.form.serialize() + '&action=update';

          $.post(event.data.url, query, null, 'json').then(function(response) {
            prestashop.emit('updateCart', {
              reason: {
                idProduct: response.id_product,
                idProductAttribute: response.id_product_attribute,
                linkAction: 'add-to-cart',
                cart: response.cart
              },
              resp: response
            });
          }).fail(function(response) {
            prestashop.emit('handleError', {
              eventType: 'addProductToCart',
              resp: response
            });
          });
        });
      });

      $('.comparison-nav').on('click', function() {
        var productsBlock = $('.comparison-products'),
            headers = $('.comparison-table .comparison-section-heading'),
            productsBlockLeft = parseInt(productsBlock.css('left')) || 0,
            headersLeft = parseInt(headers.css('left')) || 0,
            productsBlockNewPosition,
            headersNewPosition,
            parentWidth,
            itemWidth = $('.comparison-item').eq(0).width() + 1;

        if ($(this).hasClass('comparison-nav-next')) {
          productsBlockNewPosition = productsBlockLeft - itemWidth;
          headersNewPosition = headersLeft + itemWidth;
          parentWidth = $('.comparison-table').width();

          if ((productsBlock.width() + (productsBlockNewPosition + itemWidth)) < parentWidth || productsBlock.width() <= parentWidth) {
            return false;
          }
        } else {
          productsBlockNewPosition = productsBlockLeft + itemWidth;
          headersNewPosition = headersLeft - itemWidth;

          if (productsBlockNewPosition > 0) {
            productsBlockNewPosition = 0;
          }

          if (headersNewPosition > 0) {
            headersNewPosition = 0;
          }
        }

        productsBlock.css('left', productsBlockNewPosition);
        headers.css('left', headersNewPosition);
        updateNav();
      });

      updateNav();
      updateCellWidth();
      updateHeadersHeight();

      toggleFeaturesButton.on('click', function() {
        toggleFeatures($(this));
      });

      $(window).on('resize', function() {
        waitForFinalEvent(function() {
          resetTablePosition();
          updateCellWidth();
          updateHeadersHeight();
        }, 1000, 'recalculateDimensions');
      });

      $('.comparison-quick-view').on('click', function() {
        prestashop.emit('clickQuickView', {
          dataset: $(this).data()
        });
        return false;
      });
    },
    WishlistCart: function(id, action, id_product, id_product_attribute, quantity, id_wishlist, button) {
      WishlistCart(id, action, id_product, id_product_attribute, quantity, id_wishlist, button);
    },
    WishlistChangeDefault: function(id, id_wishlist) {
      WishlistChangeDefault(id, id_wishlist);
    },
    WishlistVisibility: function(bought_class, id_button) {
      WishlistVisibility(bought_class, id_button);
    },
    WishlistProductManage: function(id, action, id_wishlist, id_product, id_product_attribute, quantity, priority) {
      WishlistProductManage(id, action, id_wishlist, id_product, id_product_attribute, quantity, priority);
    },
    WishlistSend: function(id, id_wishlist, id_email) {
      WishlistSend(id, id_wishlist, id_email);
    },
    WishlistManage: function(id, id_wishlist) {
      WishlistManage(id, id_wishlist);
    },
    WishlistDefault: function(id, id_wishlist) {
      WishlistDefault(id, id_wishlist);
    },
    WishlistDelete: function(id, id_wishlist, msg) {
      return WishlistDelete(id, id_wishlist, msg);
    },
    WishlistBuyProduct: function(token, id_product, id_product_attribute, id_quantity, button, ajax) {
      WishlistBuyProduct(token, id_product, id_product_attribute, id_quantity, button, ajax);
    },
  }
})();

$(function() {
  compareWishlistPro.init();
});
