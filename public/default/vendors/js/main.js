// Slick SLider {Best Techers} slider
$(document).on('ready', function () {
	
	$('.ads-top #exit').click(function(){
		$('.conn-ads').hide();
		return false
	});
	$('#menu-site').click(function () {
		$('body').toggleClass('fix-menu');
		$('.menu-site').toggleClass('fix-menu-tab');
		return false;
	});

	$('body').click(function () {
		$(this).removeClass('fix-menu');
		$('.menu-site').removeClass('fix-menu-tab');
	});

	$('#close').click(function () {
		$('body').removeClass('fix-menu');
		$('.menu-site').removeClass('fix-menu-tab');
		return false;
	});

	$('#datepairExample .date').datepicker({
		'format': 'yyyy-m-d',
		'autoclose': true
	});

	$('.sub-menu > a').click(function () {
		$(this).next('ul').slideToggle();
		$(this).find('.fa').toggleClass('fa-angle-down fa-angle-up');
		return false;
	});

	// initialize datepair
	//    $('#datepairExample').datepair();

	$(".vertical-center-4").slick({
		dots: true,
		vertical: true,
		centerMode: true,
		slidesToShow: 4,
		slidesToScroll: 5
	});
	$(".vertical-center-3").slick({
		dots: true,
		vertical: true,
		centerMode: true,
		slidesToShow: 3,
		slidesToScroll: 3
	});
	$(".vertical-center-2").slick({
		dots: true,
		vertical: true,
		centerMode: true,
		slidesToShow: 5,
		slidesToScroll: 1
	});
	$(".vertical-center").slick({
		dots: true,
		vertical: true,
		centerMode: true,
	});
	$(".vertical").slick({
		dots: true,
		vertical: true,
		slidesToShow: 3,
		slidesToScroll: 3
	});
	$(".regular").slick({
		dots: true,
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		lazyLoad: 'ondemand', // ondemand progressive anticipated

	});
	$(".center").slick({
		dots: true,
		infinite: true,
		centerMode: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		lazyLoad: 'ondemand', // ondemand progressive anticipated
		infinite: true
	});
	$(".variable").slick({
		dots: true,
		infinite: true,
		variableWidth: true,
		slidesToShow: 5,
		slidesToScroll: 2,
		lazyLoad: 'ondemand', // ondemand progressive anticipated
		infinite: true

	});
	$(".lazy").slick({
		dots: false,
		slidesToShow: 4,
		slidesToScroll: 1,
		lazyLoad: 'ondemand', // ondemand progressive anticipated
		//appendArrows: '#slider_navs',
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true
				}
    },
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
    },
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]


	});
	
	
		$(".lazyh").slick({
		dots: false,
		slidesToShow: 5,
		slidesToScroll: 1,
		lazyLoad: 'ondemand', // ondemand progressive anticipated
		//appendArrows: '#slider_navs',
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true
				}
    },
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
    },
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]


	});
	
	$(".lazy2").slick({
		dots: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		lazyLoad: 'ondemand', // ondemand progressive anticipated
		//appendArrows: '#slider_navs',
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true
				}
    },
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
    },
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]


	});

	$(".slider_navs").slick({
		dots: true,
		infinite: true,
		variableWidth: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		lazyLoad: 'ondemand', // ondemand progressive anticipated
		infinite: true,
		//appendArrows: '#slider_navs',

	});








	$('.responsive').slick({
		dots: true,
		infinite: true,
		speed: 1000,
		slidesToShow: 4,
		slidesToScroll: 4,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 1,
					infinite: true,
					dots: true
				}
    },
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
    },
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
    },
			{
				breakpoint: 1400,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 1
				}
    },
			{
				breakpoint: 1100,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
    },
			{
				breakpoint: 1000,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
    },

			{
				breakpoint: 740,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
    }

    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
	});


	$('.variable2').slick({
		dots: true,
		infinite: true,
		speed: 1000,
		slidesToShow: 4,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 5,
					slidesToScroll: 1,
					infinite: true,
					dots: true
				}
    },
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
    },
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
    },
			{
				breakpoint: 1400,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				}
    },
			{
				breakpoint: 1100,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				}
    },
			{
				breakpoint: 1000,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
    },
			{
				breakpoint: 1023,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				}
    },
			{
				breakpoint: 740,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				}
    }

    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
	});

	var step = 25;
	var scrolling = false;

	// Wire up events for the 'scrollUp' link:
	$("#scrollUp").bind("click", function (event) {
		event.preventDefault();
		// Animates the scrollTop property by the specified
		// step.
		$("#content").animate({
			scrollTop: "-=" + step + "px"
		});
	});


	$("#scrollDown").bind("click", function (event) {
		event.preventDefault();
		$("#content").animate({
			scrollTop: "+=" + step + "px"
		});
	});

	function scrollContent(direction) {
		var amount = (direction === "up" ? "-=8px" : "+=8px");
		$("#content").animate({
			scrollTop: amount
		}, 1, function () {
			if (scrolling) {
				scrollContent(direction);
			}
		});
	}







});







jQuery(document).ready(function ($) {
	var $lateral_menu_trigger = $('#cd-menu-trigger'),
		$content_wrapper = $('.cd-main-content'),
		$navigation = $('header');

	//open-close lateral menu clicking on the menu icon
	$lateral_menu_trigger.on('click', function (event) {
		event.preventDefault();

		$lateral_menu_trigger.toggleClass('is-clicked');
		$navigation.toggleClass('lateral-menu-is-open');
		$content_wrapper.toggleClass('lateral-menu-is-open').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
			// firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
			$('body').toggleClass('overflow-hidden');
		});
		$('#cd-lateral-nav').toggleClass('lateral-menu-is-open');

		//check if transitions are not supported - i.e. in IE9
		if ($('html').hasClass('no-csstransitions')) {
			$('.website').toggleClass('overflow-hidden');
		}
	});

	//close lateral menu clicking outside the menu itself
	$content_wrapper.on('click', function (event) {
		if (!$(event.target).is('#cd-menu-trigger, #cd-menu-trigger span')) {
			$lateral_menu_trigger.removeClass('is-clicked');
			$navigation.removeClass('lateral-menu-is-open');
			$content_wrapper.removeClass('lateral-menu-is-open').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
				$('.website').removeClass('overflow-hidden');
			});
			$('#cd-lateral-nav').removeClass('lateral-menu-is-open');
			//check if transitions are not supported
			if ($('html').hasClass('no-csstransitions')) {
				$('.website').removeClass('overflow-hidden');
			}

		}
	});

	//open (or close) submenu items in the lateral menu. Close all the other open submenu items.
	$('.item-has-children').children('a').on('click', function (event) {
		event.preventDefault();
		$(this).toggleClass('submenu-open').next('.sub-menu').slideToggle(200).end().parent('.item-has-children').siblings('.item-has-children').children('a').removeClass('submenu-open').next('.sub-menu').slideUp(200);
	});
});


$(window).load(function () {
	// Animate loader off screen
	$(".se-pre-con").fadeOut("slow");;
});
