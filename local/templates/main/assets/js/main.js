$(document).ready(function() {

	$(".main-menu a[href^='#'], .btn-more a[href^='#']").click(function(){
		var target = $(this).attr("href");
		$("html, body").animate({scrollTop: $(target).offset().top+"px"});
		return false;
	});


	$('.js-slider').slick({
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		autoplay: true,
		autoplaySpeed: 3000
	});

	$('.js-content-slider').slick({
		slidesToScroll: 1,
		fade: true,
		autoplay: true,
		autoplaySpeed: 10000
	});

	$('.js-facts-slider').slick({
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 8000
	});

	$('.js-lightgallery').lightGallery();

    $('.js-scroll-pane').jScrollPane();

    $('.lazy').lazy();

	/*
	* Подключаем слик слайдер для Уроки воды
	* */
	$('.slick-slider-block').slick({
		slidesToShow: 4,
		slidesToScroll: 4,
		dots: true,
		infinite: true,
	});

	$('.nav-link').on('click', function() {
		function initslick(){
			$('.slick-slider-block').slick('unslick');

			$('.slick-slider-block').slick({
				slidesToShow: 4,
				slidesToScroll: 4,
				dots: true,
				infinite: true,
			});
		}
		setTimeout(initslick, 200);
	});
});



