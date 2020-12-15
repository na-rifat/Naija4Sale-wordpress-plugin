(function ($) {
  $(".naija-options-form form").on("submit", function (e) {
    e.preventDefault();

    var self = $(this);    
    var data = self.serialize();

    $.ajax({
      type: "POST",
      url: naija.ajaxurl,
      data: data,
      success: function (response) {
        console.log(response)
      },
      error: function (error) {
        console.log(error)
      },
    });
  });
})(jQuery);
