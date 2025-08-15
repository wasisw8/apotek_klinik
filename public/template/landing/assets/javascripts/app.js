var CODEXCODER = CODEXCODER || {};

(function($){

	// Beautiful functions stack by Aminul Islam
	// Lead Web Developer @CodexCoder

	// USE STRICT
	"use strict";

	CODEXCODER.initialize = {

		init: function(){

			
			CODEXCODER.initialize.defaults();
			CODEXCODER.initialize.sectionsImageBackground();
			// CODEXCODER.initialize.sectionsVideoBackground();
			CODEXCODER.initialize.navigationOne();
			CODEXCODER.initialize.navigationClickr();
			CODEXCODER.initialize.heroFullScreen();
			CODEXCODER.initialize.bannerHeightFix();
			CODEXCODER.initialize.testimonialCarousel();
			CODEXCODER.initialize.testimonialToggler();
			CODEXCODER.initialize.screenshotCarousel();
			CODEXCODER.initialize.newsletterAjax();

		},
		defaults: function() {
		    // Light Box
		    $('[data-lightbox="yes"]').lightbox();

			// Site Preloader
			$(window).load(function () {
				$(".loader").fadeOut();
				$("#preloader").delay(350).fadeOut("slow");
			});

		},
		sectionsImageBackground: function() {
		    
		    // Make Parallax Image Background
		    $('[data-type="background"]').each(function() {

		    	var actualHeight = $(this).position().top;
		    	var reSize = actualHeight - $(window).scrollTop();
		    	var makeParallax = -(reSize/15);
		    	var posValue = makeParallax + "px";

		       // Set background Image postion
		    	$(this).css({
		    		backgroundImage: 'url(' + $(this).data('src') + ')',
		    		backgroundPosition: '50% ' + posValue,
		    	});

		     });
		},
		sectionsVideoBackground: function() {

			$('[data-type="videbg"]').each(function() {

		    	var actualHeight = $(this).position().top;
		    	var reSize = actualHeight-$(window).scrollTop();
		    	var makeParallax = -(reSize/2.5);
		    	var posValue = makeParallax+"px";

		       	// Set background div ID or class
		    	$(this).find('.video-container').css({
		    		top:posValue,
		    	});

		    });
		},

		navigationOne: function() {

			// Add Class To body
			if ($('#navigation').hasClass( "navigation-style-1" )) {
				$('body').addClass('menu-1-canvas');
			};

			// Open Navigation
			$('#nav-trigger > a').click(function(e) {
				$("#navigation").toggleClass('open');
				$('.menu-1-canvas').toggleClass('menu-1-open');
			});

			// Open Submenu
			$('.has-submenu').hover(function() {
				$(this).toggleClass('active');
			});

		},
		navigationClickr: function() {

			$('#navigation .site-navigation li a[href*="#"]').click(function() {
				$('body').toggleClass('menu-1-open', false);
				$("#navigation").toggleClass('open', false);
				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
					if (target.length) {
						$('html,body').animate({
							scrollTop: target.offset().top
						}, 1000);
						return false;
					}
				}
			});

		},

		heroFullScreen: function() {

			// Make The Section Full Screen
			$('.full-screen').css('height', window.innerHeight );

			// Overlay Div Full Screen
			$('.full-screen .overlay').css('height', window.innerHeight );
			
		},

		bannerHeightFix: function() {

			$(".banner-section > div > .container").css("height", $(".banner-section").height());
			$(".banner-section .application-mockup").css("height", $(".banner-section").height());
			
		},

		testimonialCarousel: function() {


			$('[data-testimonial="carousel"]').each( function() {

				var carouselInt = $(this).find('[data-carousel="content"]').attr('id');
				var carouselNav = $(this).find('[data-carousel="nav"]').attr('id');
				var carouselPrev = $(this).find('[data-carousel="prev"]').attr('id');
				var carouselNext = $(this).find('[data-carousel="next"]').attr('id');

				// Carousel Contents
				var tCarousels = new Swiper('#' + carouselInt, {
					effect: 'fade',
					fade: {
						crossFade: true
					},
					initialSlide: 2
				});

				// Navigation Config
				var navConf = {
					centeredSlides: true,
					slidesPerView: 3,
					initialSlide: 2,
					slideToClickedSlide: true,
					// nextButton: '#' + carouselNext,
					// prevButton: '#' + carouselPrev,
					// navigation: {
				 //        nextButton: '#' + carouselNext,
				 //        prevButton: '#' + carouselPrev,
				 //      },
				  navigation: {
			        nextEl: '.testimonial-carousel-control-541',
			        prevEl: '.testimonial-carousel-control-542',
			      },
				};

				if (window.innerWidth > 992 ) {
					navConf.direction = 'vertical';
				}

				var tNavigation = new Swiper('#' + carouselNav, navConf);

				// Merge
				tCarousels.params.control = tNavigation;
				tNavigation.params.control = tCarousels;

			});
			
		},

		testimonialToggler: function() {


			$('.overflow-testimonials > .item').each( function() {

				$(this).hover(function(){
					$(this).toggleClass('active');
					
				});

			});
			
		},

		screenshotCarousel: function() {

			$('[data-screenshot="carousel"]').each( function() {

				var slidesPerViewVar = 4;

				ssrFix();

				function ssrFix() {
					var iW = window.innerWidth;
					if (iW > 992) slidesPerViewVar = 4;
					if (iW > 768 && iW <= 992) slidesPerViewVar = 3;
					if (iW > 480 && iW <= 768) slidesPerViewVar = 2;
					if (iW <= 480) slidesPerViewVar = 1;
				}

				var carouselInt = $(this).find('[data-carousel="content"]').attr('id');
				var carouselPag = $(this).find('[data-carousel="pagination"]').attr('id');
				var carouselNex = $(this).find('[data-carousel="next"]').attr('id');
				var carouselPre = $(this).find('[data-carousel="prev"]').attr('id');

				// Carousel Contents

				var items = 4;

				var swiper = new Swiper( '#' + carouselInt, {
					pagination: '#' + carouselPag,
					paginationClickable: '#' + carouselPag,
					// nextButton: '#' + carouselNex,
					// prevButton: '#' + carouselPre,
					// navigation: {
				 //        nextButton: '#' + carouselNex,
				 //        prevButton: '#' + carouselPre,
				 //      },
				      navigation: {
				        nextEl: '.reenshots-carousel-nav-next',
				        prevEl: '.screenshots-carousel-nav-prev',
				      },
					spaceBetween: 30,
					slidesPerView: slidesPerViewVar,
				});

			});
			
		},

		newsletterAjax: function() {

			$('.aw-mc-ajax-form').each(function() {
				var $this = $(this);

				// Newselleter Scripts
				$this.submit(function() {
					$this.find('button[type="submit"]').addClass('clicked');
					var action = $(this).attr('action');
					$.ajax({
						url: action,
						type: 'POST',
						data: {
							action: $this.find('input[name="action"]').val(),
							email: $this.find('input[name="email"]').val()
						},
						success: function(data){
							$this.find('.aw-mc-response').html(data).addClass('success').css('display', 'block');
							$this.find('button[type="submit"]').removeClass('clicked');
						},
						error: function() {
							$this.find('.aw-mc-response').html('Sorry, an error occurred.').addClass('error').css('display', 'block');
							$this.find('button[type="submit"]').removeClass('clicked');
						}
					});
					return false;
				});
				
			});
		},

	};

	CODEXCODER.documentOnReady = {

		init: function(){
			CODEXCODER.initialize.init();
		},

	};

	CODEXCODER.documentOnResize = {

		init: function(){
			CODEXCODER.initialize.heroFullScreen();
			// CODEXCODER.initialize.testimonialCarousel();
			CODEXCODER.initialize.screenshotCarousel();
		},

	};

	CODEXCODER.documentOnScroll = {

		init: function(){
			CODEXCODER.initialize.sectionsImageBackground();
		},

	};

	// Variables
	var $window = $(window),
		$body = $('body'),
		$banner = $('#banner');

	// Initialize Functions
	$(document).ready( CODEXCODER.documentOnReady.init );
	$(window).on( 'resize', CODEXCODER.documentOnResize.init );
	$(document).on( 'scroll', CODEXCODER.documentOnScroll.init );

})(jQuery);