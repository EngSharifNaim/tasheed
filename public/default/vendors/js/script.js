$(function () {

$(".nav2").hide();

$(".icon-menu").on("click", function() {
        $(".nav2").fadeToggle();
});

  $('.color-choose input').on('click', function() {
      var headphonesColor = $(this).attr('data-image');
 
      $('.active').removeClass('active');
      $('.left-column img[data-image = ' + headphonesColor + ']').addClass('active');
      $(this).addClass('active');
  });

  	$('.scroll').slimScroll({
		position: 'left',
		width: '100%',
		height: '400px',
		railVisible: false,
		alwaysVisible: false,
		disableFadeOut: true,
		railOpacity: 0.7,
    	wheelStep: 10,
	});

});