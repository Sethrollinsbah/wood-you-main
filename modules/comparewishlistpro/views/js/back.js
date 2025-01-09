/**
*  @author    Prestapro
*  @copyright Prestapro
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)*
*/

var compareWishlistPro = (function() {
  return {
    init: function() {
      $('.list-group-item').on('click', function() {
        var el = $(this).parent().closest('.list-group').children('.active');

        if (el.hasClass('active')) {
          el.removeClass('active');
          $(this).addClass('active');
        }
      });

      $('.ppro-faq-question a').on('click', function(event) {
        event.preventDefault();
        $(this).parent().siblings('.ppro-faq-answer').toggleClass('ppro-hidden');
      });
    }
  };
})();

$(function() {
  compareWishlistPro.init();
});
