(function ($) {
	"use strict";
	/*------------------------------------
		Mobile Menu
	--------------------------------------*/
	$(document).ready(function () {
		$("#menu-main-menu ul.sub-menu").removeClass("sub-menu").addClass("dropdown-menu");
		$("#menu-main-menu ul.dropdown-menu li a")
			.removeClass("nav-link")
			.removeClass("dropdown-toggle")
			.addClass("dropdown-item");
		$("#mobile-menu-active").metisMenu();
		$("#mobile-menu-active .has-dropdown > a").on("click", function (e) {
			e.preventDefault();
		});
		$(".hamburger-menu > a").on("click", function (e) {
			e.preventDefault();
			$(".slide-bar").toggleClass("show");
			$("body").addClass("on-side");
			$(".body-overlay").addClass("active");
			$(this).addClass("active");
		});
		$(".close-mobile-menu > a").on("click", function (e) {
			e.preventDefault();
			$(".slide-bar").removeClass("show");
			$("body").removeClass("on-side");
			$(".body-overlay").removeClass("active");
			$(".hamburger-menu > a").removeClass("active");
		});
		$(".body-overlay").on("click", function () {
			$(this).removeClass("active");
			$(".slide-bar").removeClass("show");
			$("body").removeClass("on-side");
			$(".hamburger-menu > a").removeClass("active");
		});
		// Hide/show of the sticky header: assets/js/vds.js
		// feedback-active
		// $(".testimonial-active").owlCarousel({
		// 	loop: false,
		// 	margin: 30,
		// 	items: 3,
		// 	autoplay: true,
		// 	autoplaySpeed: 2000,
		// 	navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		// 	nav: false,
		// 	dots: true,
		// 	responsive: {
		// 		0: {
		// 			items: 1,
		// 			margin: 0,
		// 		},
		// 		768: {
		// 			items: 2,
		// 		},
		// 		900: {
		// 			items: 3,
		// 		},
		// 	},
		// });
		// feedback-active
		$(".testimonial-active2").owlCarousel({
			loop: false,
			margin: 30,
			items: 1,
			autoplay: true,
			autoplaySpeed: 2000,
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			nav: false,
			dots: true,
			responsive: {
				0: {
					items: 1,
					margin: 0,
				},
				768: {
					items: 1,
				},
				900: {
					items: 1,
				},
			},
		});
		// feature-active
		$(".feature-active, .team-active, .case-active, .blog-active").owlCarousel({
			loop: true,
			margin: 30,
			items: 3,
			autoplay: true,
			autoplaySpeed: 2000,
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			nav: false,
			dots: false,
			responsive: {
				0: {
					items: 1,
					margin: 0,
				},
				768: {
					items: 2,
				},
				900: {
					items: 3,
				},
			},
		});
		// case-active2
		$(".case-active2").owlCarousel({
			loop: true,
			margin: 30,
			items: 4,
			autoplay: true,
			autoplaySpeed: 2000,
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			nav: false,
			dots: false,
			responsive: {
				0: {
					items: 1,
					margin: 0,
				},
				768: {
					items: 2,
				},
				900: {
					items: 3,
				},
				1024: {
					items: 4,
				},
			},
		});
		/*---------- 06.Set Background Image ----------*/
		if ($("[data-bg-src]").length > 0) {
			$("[data-bg-src]").each(function () {
				var src = $(this).attr("data-bg-src");
				$(this).css({
					"background-image": "url(" + src + ")",
				});
			});
		}
		// -------------------- Remove Placeholder When Focus Or Click
		$("input,textarea").each(function () {
			$(this).data("holder", $(this).attr("placeholder"));
			$(this).on("focusin", function () {
				$(this).attr("placeholder", "");
			});
			$(this).on("focusout", function () {
				$(this).attr("placeholder", $(this).data("holder"));
			});
		});
		//----------  Quantity Added
		$(".quantity-plus").each(function () {
			$(this).on("click", function (e) {
				e.preventDefault();
				var $qty = $(this).siblings(".qty-input");
				var currentVal = parseInt($qty.val());
				if (!isNaN(currentVal)) {
					$qty.val(currentVal + 1);
				}
			});
		});
		$(".quantity-minus").each(function () {
			$(this).on("click", function (e) {
				e.preventDefault();
				var $qty = $(this).siblings(".qty-input");
				var currentVal = parseInt($qty.val());
				if (!isNaN(currentVal) && currentVal > 1) {
					$qty.val(currentVal - 1);
				}
			});
		});
		/* magnificPopup img view */
		$(".popup-image").magnificPopup({
			type: "image",
			gallery: {
				enabled: true,
			},
		});
		/* magnificPopup video view */
		$(".popup-video").magnificPopup({
			type: "iframe",
		});
		// active-class
		$(".do-box, .s-services").on("mouseenter", function () {
			$(this)
				.addClass("active")
				.parent()
				.siblings()
				.find(".do-box, .s-services")
				.removeClass("active");
		});
		// isotop
		$(".grid").imagesLoaded(function () {
			// init Isotope
			var $grid = $(".grid").isotope({
				itemSelector: ".grid-item",
				percentPosition: true,
				masonry: {
					// use outer width of grid-sizer for columnWidth
					columnWidth: 0,
					gutter: 0,
				},
			});
			// filter items on button click
			$(".portfolio-menu").on("click", "button", function () {
				var filterValue = $(this).attr("data-filter");
				$grid.isotope({ filter: filterValue });
			});
		});
		//for menu active class
		$(".portfolio-menu button").on("click", function (event) {
			$(this).siblings(".active").removeClass("active");
			$(this).addClass("active");
			event.preventDefault();
		});
		//counter
		$(".counter").counterUp({
			delay: 10,
			time: 3000,
		});
		// ===== Scroll to Top ====
		$(window).scroll(function () {
			if ($(this).scrollTop() >= 100) {
				$(".scrollUp").fadeIn(200);
			} else {
				$(".scrollUp").fadeOut(200);
			}
		});
		$(".scrollUp").click(function () {
			$("body,html").animate(
				{
					scrollTop: 0,
				},
				1000
			);
		});
		// wow animation - start
		// --------------------------------------------------
		function wowAnimation() {
			new WOW({
				offset: 100,
				mobile: true,
			}).init();
		}
		wowAnimation();
		//nice-select

	});
	$(document).ready(function () {
		$("select").niceSelect();
		//ajax
		$('.ajax_container').on('click','.readmore a',function(e){
			e.preventDefault();
			var target = $(this).closest('.ajax_container'),
				blogs = $(target).find('.blog_lists'),
				button = $(this),
				data = target.data('args');
				if(!button.hasClass('loading') && typeof(data) !== 'undefined'){
					button.addClass('loading');
					button.append('<i class="fas fa-spinner fa-spin"></i>');
				
					$.ajax({
						type: 'POST',
						url: ajaxurl,
						data:{action:'wb_load_blog',data:data},
						dataType: 'json',
						success: function(response){ 
							button.removeClass('loading'); 
							button.find('i').remove();
							if(response.items){
								blogs.append(response.items);
							}
							if(!response.more){
								button.remove();
							}							
							target.data('args',response.args);
						}
						
					});
				}
		})
	});

})(jQuery);

jQuery(document).ready(function () {
	jQuery("#menu-main-menu-1 li").each(function () {
		if (!jQuery(this).find("ul").length) {
			jQuery(this).find("a").removeClass("dropdown-toggle");
		}
	});
});
