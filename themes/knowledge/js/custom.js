/*------------remove link of menu has sub-menu for mobile-----------*/

var ua = navigator.userAgent.toLowerCase();

var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");

	if(isAndroid) {

		jQuery('#menu-main-menu .menu-item-has-children > a').click(function(e){

		e.preventDefault();

	});

}

jQuery( document ).ready(function() {

	var isMobile = {

		Android: function() {

			return navigator.userAgent.match(/Android/i);

		},

		BlackBerry: function() {

			return navigator.userAgent.match(/BlackBerry/i);

		},

		iOS: function() {

			return navigator.userAgent.match(/iPhone|iPad|iPod/i);

		},

		Opera: function() {

			return navigator.userAgent.match(/Opera Mini/i);

		},

		Windows: function() {

			return navigator.userAgent.match(/IEMobile/i);

		},

		any: function() {

			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());

		}

	};

	if( isMobile.any() ) {

		jQuery('#menu-main-menu .menu-item-has-children > a').click(function(e){

			e.preventDefault();

		});

	}

 });





jQuery(document).ready(function(){

  jQuery(".slider_testimonials").bxSlider({

    minSlides: 1,

    maxSlides: 1,

    speed: 500,

    controls: true,

    autoControls: true,

    pager: false,

    slideWidth: 700,

    auto: true,

    slideMargin: 15,

    autoStart: true

  });

});

jQuery(document).ready(function(){

  jQuery(".slider_development").bxSlider({

    minSlides: 1,

    maxSlides: 1,

    speed: 2000,

    controls: true,

    autoControls: true,

    pager: true,

    auto: true,

    autoStart: true,

    slideMargin: 0,

	infiniteLoop: true,

	onSlideAfter: function (currentSlideNumber, totalSlideQty, currentSlideHtmlObject) {

		console.log(currentSlideHtmlObject+1);

		var check_count_loop = currentSlideHtmlObject+1;

		jQuery('.slider_development > li').removeClass('active-slide');

		jQuery('.slider_development > li').eq(currentSlideHtmlObject + 2).addClass('active-slide');

		if (jQuery('.slider_development > li.count_'+(currentSlideHtmlObject+1)).hasClass ("old")) {

		   jQuery('.bx-controls-direction .bx-next').addClass('db');

		   

		}

		if (jQuery('.slider_development > li.count_1.active-slide').hasClass ("bx-clone")) {

			jQuery(".bx-pager.bx-default-pager .bx-pager-item:first-child a").trigger('click');

		}

		if(check_count_loop == 1){

			jQuery(".bx-next.db").addClass('loop');

		}

		if(check_count_loop == 1){

			setTimeout(function(){

				  jQuery(".bx-next.db.loop").delay(1000).trigger('click');

			}, 11000);

		}else{

			setTimeout(function(){

				  jQuery(".bx-next.db.loop").delay(1000).trigger('click');

			}, 5000);

		}

		

	},

	});


	
});

jQuery(document).ready(function() {

		var offset = 300;

		var duration = 350;

		jQuery(window).scroll(function() {

			if (jQuery(this).scrollTop() > offset) {

				jQuery('.back-to-top').fadeIn(duration);

			} else {

				jQuery('.back-to-top').fadeOut(duration);

			}

		});

		jQuery('.back-to-top').click(function(event) {

			event.preventDefault();

			jQuery('html, body').animate({scrollTop: 0}, duration);

			return false;

		})

	});



jQuery( document ).ready(function() {

  jQuery('.custom-header #menu-main-menu > li').hover( function() {

    jQuery(this).toggleClass("showclass");

  });

});



var page = 1;

var ppp = 2;

function load_posts(){

    jQuery.ajax({

        type: "POST",

        dataType: "html",

        url: ajaxurl,

        data: {"action": "more_post_ajax", offset: (page * ppp), ppp: ppp, number_post: number_post },

    success: function(response4) {

            page++;

            $('.show-all-post').append(response4);

            jQuery("#loading-animation").hide();

    }

    });

}

$("#more_posts").on("click",function(){ // When btn is pressed.

  //alert(number_post);

  //alert(offset+ppp);

    $("#more_posts").attr("disabled",true); // Disable the button, temp.

    jQuery("#loading-animation").show();

    load_posts(); 

});





var page = 1;

var ppp = 2;

function load_posts_testimonials(){

    jQuery.ajax({

        type: "POST",

        dataType: "html",

        url: ajaxurl,

        data: {"action": "more_post_ajax_testimonials", offset: (page * ppp), ppp: ppp, number_post: number_post },

    success: function(response4) {

            page++;

            $('.show-all-post-testimonials').append(response4);

            jQuery("#loading-animation").hide();

    }

    });

}

$("#more_posts_testimonials").on("click",function(){ // When btn is pressed.

  //alert(number_post);

  //alert(offset+ppp);

    $("#more_posts_testimonials").attr("disabled",true); // Disable the button, temp.

    jQuery("#loading-animation").show();

    load_posts_testimonials(); 

});



var page = 1;

var ppp = 2;

function case_studies(){

    jQuery.ajax({

        type: "POST",

        dataType: "html",

        url: ajaxurl,

        data: {"action": "more_case_studies_ajax", offset: (page * ppp), ppp: ppp, number_post: number_post },

    success: function(response4) {

            page++;

            $('.show-all-post-casestudy').append(response4);

            jQuery("#loading-animation").hide();

    }

    });

}



$("#case_studies").on("click",function(){ // When btn is pressed.

  //alert(number_post);

  //alert(offset+ppp);

    $("#case_studies").attr("disabled",true); // Disable the button, temp.

    jQuery("#loading-animation").show();

    case_studies(); 

});



$(".aphabe li a").on("click",function(){ // When btn is pressed.

    var keys = $(this).data('key');

    var keys_LowerCase = $(this).data('key').toLowerCase();

    $("ul.shortcode-client li a").each(function (index,i) {

		var str = $(this).text();

		first_lett = str.substring(0, 1);

        if ( keys_LowerCase === first_lett.toLowerCase()) {

            $(this).parent().show();

        } else {

            $(this).parent().hide();

        }

    });

});



(function($){var defaults={topSpacing:0,bottomSpacing:0,className:'is-sticky',wrapperClassName:'sticky-wrapper',center:false,getWidthFrom:''},$window=$(window),$document=$(document),sticked=[],windowHeight=$window.height(),scroller=function(){var scrollTop=$window.scrollTop(),documentHeight=$document.height(),dwh=documentHeight- windowHeight,extra=(scrollTop>dwh)?dwh- scrollTop:0;for(var i=0;i<sticked.length;i++){var s=sticked[i],elementTop=s.stickyWrapper.offset().top,etse=elementTop- s.topSpacing- extra;if(scrollTop<=etse){if(s.currentTop!==null){s.stickyElement.css('position','').css('top','');s.stickyElement.parent().removeClass(s.className);s.currentTop=null;}}

else{

	var newTop=documentHeight- s.stickyElement.outerHeight()

- s.topSpacing- s.bottomSpacing- scrollTop- extra;if(newTop<0){newTop=newTop+ s.topSpacing;}else{newTop=s.topSpacing;}

if(s.currentTop!=newTop){

    s.stickyElement.css('position','fixed').css('top',newTop).css('right','0%').css('z-index','9').addClass("have_right_social");

    if(typeof s.getWidthFrom!=='undefined'){s.stickyElement.css('width',$(s.getWidthFrom).width());

}



s.stickyElement.parent().addClass(s.className);s.currentTop=newTop;}}}},resizer=function(){windowHeight=$window.height();},methods={init:function(options){var o=$.extend(defaults,options);return this.each(function(){var stickyElement=$(this);var stickyId=stickyElement.attr('id');var wrapper=$('<div></div>').attr('id',stickyId+'-sticky-wrapper').addClass(o.wrapperClassName);stickyElement.wrapAll(wrapper);if(o.center){stickyElement.parent().css({width:stickyElement.outerWidth(),marginLeft:"auto",marginRight:"auto"});}

if(stickyElement.css("float")=="right"){stickyElement.css({"float":"none"}).parent().css({"float":"right"});}

var stickyWrapper=stickyElement.parent();stickyWrapper.css('height',stickyElement.outerHeight());sticked.push({topSpacing:o.topSpacing,bottomSpacing:o.bottomSpacing,stickyElement:stickyElement,currentTop:null,stickyWrapper:stickyWrapper,className:o.className,getWidthFrom:o.getWidthFrom});});},update:scroller};if(window.addEventListener){window.addEventListener('scroll',scroller,false);window.addEventListener('resize',resizer,false);}else if(window.attachEvent){window.attachEvent('onscroll',scroller);window.attachEvent('onresize',resizer);}

$.fn.sticky=function(method){if(methods[method]){return methods[method].apply(this,Array.prototype.slice.call(arguments,1));}else if(typeof method==='object'||!method){return methods.init.apply(this,arguments);}else{$.error('Method '+ method+' does not exist on jQuery.sticky');}};$(function(){setTimeout(scroller,0);});})(jQuery);







$(window).load(function(){

  //$(".share-social-custom").sticky({ topSpacing: 0 });

  //$(".main-share-social").sticky({ topSpacing: 150 });

});





jQuery(window).load(function($) {

        // Dock each summary as it arrives just below the docked header, pushing the

        // previous summary up the page.

		/*jQuery('.navbar.navbar-inverse.custom-header').scrollToFixed();*/

        var summaries = jQuery('.summary');

        summaries.each(function(i) {

            var summary = jQuery(summaries[i]);

            var next = summaries[i + 1];

            summary.scrollToFixed({

                marginTop: 150,

                limit: function() {

                    var limit = 0;

                    if (next) {

                        limit = $(next).offset().top - $(this).outerHeight(true) - 10;

                    }

                    else {

                        //limit = $('.footer-form').offset().top - $(this).outerHeight(true) -0;

                    }

                    return limit;

                },

                zIndex: 9994

            });

        });

    });