(function ($) {

  var controller = new slidebars();
  controller.init();
  $('.slidebar-toggle').on('click', function (event) {
    event.stopPropagation();
    controller.toggle($(this).data('id'));
  });
  $('body').on('click', function (event) {
    event.stopPropagation();
    if (!event.target.id || !$('#' + event.target.id).hasClass("slidebar-opened")) {
      //controller.close();
    }
  });

})(jQuery);
