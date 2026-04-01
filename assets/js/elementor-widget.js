(function ($) {
    const initMyWidget = function ($scope, $) {
        // This will run for your widget both frontend & editor
        // Example: target by widget class
        $scope.find('.banner-section-two').each(function () {
            // Your jQuery code here
			function bannerSlider() {
				
				if ($(".banner-slider-1").length > 0) {
					
					var bannerSlider2 = new Swiper('.banner-slider-1', {
						preloadImages: false,
						loop: true,
						centeredSlides: false,
						resistance: true,
						resistanceRatio: 0.6,
						speed: 2400,
						spaceBetween: 0,
						parallax: false,
						effect: "fade",
						autoplay: {
							delay: 8000,
							disableOnInteraction: false
						},
						pagination: {
							el: '.slider__pagination',
							clickable: true,
						},
						navigation: {
							nextEl: '.banner-slider-button-next',
							prevEl: '.banner-slider-button-prev',
						},
					});
				}
			}
			bannerSlider();
        });
    };

	const initWidgetTwo = function ($scope, $) {
		$scope.find('.destination').each(function () {
			if ($('.destination-carousel').length) {
				var twoItemCarousel = new Swiper('.destination-carousel', {
					preloadImages: false,
					loop: true,
					centeredSlides: false,
					resistance: true,
					resistanceRatio: 0.6,
					slidesPerView: 4,
					speed: 1400,
					spaceBetween: 30,
					parallax: false,
					effect: "slide",
					active: 'active',
					autoplay: {
						delay: 5000,
						disableOnInteraction: false
					},
					navigation: {
						nextEl: '.slider-button-next4',
						prevEl: '.slider-button-prev4',
					},
					breakpoints: {
						320: {
							slidesPerView: 1,
						},
						768: {
							slidesPerView: 2,
						},
						1024: {
							slidesPerView: 3,
						},
						1200: {
							slidesPerView: 4,
						}, 
					}
				});
			}
		});
	};

	const initWidgetThree = function ($scope, $) {
		const odometers = $scope.find('.odometer');

		if (!odometers.length) return;

		const observer = new IntersectionObserver((entries, observer) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					const el = entry.target;
					const countNumber = el.getAttribute('data-count');
					el.innerHTML = countNumber;
					observer.unobserve(el);
				}
			});
		}, { threshold: 0.5 });

		odometers.each(function () {
			observer.observe(this);
		});
	};

	// const initTabWidget = function ($scope, $) {
	// 	$scope.find('.nd-tabs-widget').each(function () {
	// 		document.addEventListener('click', function (e) {
	// 			if (!e.target.classList.contains('nd-tab-btn')) return;

	// 			const widget = e.target.closest('.nd-tabs-widget');
	// 			const index  = e.target.dataset.tab;

	// 			widget.querySelectorAll('.nd-tab-btn').forEach(btn => btn.classList.remove('active'));
	// 			widget.querySelectorAll('.nd-tab-panel').forEach(panel => panel.classList.remove('active'));

	// 			e.target.classList.add('active');
	// 			widget.querySelector(`.nd-tab-panel[data-panel="${index}"]`).classList.add('active');
	// 		});
	// 	});
	// };

    // Run on frontend and editor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/hero-banner.default',
            initMyWidget
        );

        elementorFrontend.hooks.addAction(
            'frontend/element_ready/tour_destination.default',
            initWidgetTwo
        );

        elementorFrontend.hooks.addAction(
            'frontend/element_ready/provix-counter.default',
            initWidgetThree
        );

		// elementorFrontend.hooks.addAction(
        //     'frontend/element_ready/tabs.default',
        //     initTabWidget
        // );

    });

    /*
	 * Video Box
    */

	$(".play-button").on("click", function() {
		$(".preview-image, .play-button").hide();
		$("#videoPlayer").show()[0].play();
	});

	/*
	 * About tab
	*/

	$('.nav-link').on('shown.bs.tab', function (e) {
		var newImage = $(e.target).data('image');
		if(newImage){
			$('#aboutImage').attr('src', newImage);
		}
	});

	/*
	 * Testimonial
	*/

	if ($('.testimonial.style-three .testimonial-slider').length) {
		var twoItemCarousel = new Swiper('.testimonial.style-three .testimonial-slider', {
			preloadImages: false,
			loop: true,
			centeredSlides: false,
			resistance: true,
			resistanceRatio: 0.6,
			slidesPerView: 2,
			speed: 1400,
			spaceBetween: 30,
			parallax: false,
			effect: "slide",
			active: 'active',
			autoplay: {
				delay: 5000,
				disableOnInteraction: false
			},
			autoplay: false,
			pagination: {
				el: '.slider__pagination2',
				clickable: true,
			},
			navigation: {
				nextEl: '.custom-next',
				prevEl: '.custom-prev',
			},
			breakpoints: {
				1400: {
					slidesPerView: 2,
				},
                992: {
                  slidesPerView: 2,
                },
                768: {
                  slidesPerView: 1,
                },
				320: {
					slidesPerView: 1,
				}
            }
		});
	}

	// Style Four

	if ($('.testimonial.style-four .swiper-container').length) {
		var testi4Carousel = new Swiper('.testimonial.style-four .swiper-container', {
			preloadImages: false,
			loop: true,
			centeredSlides: false,
			resistance: true,
			resistanceRatio: 0.6,
			slidesPerView: 1,
			speed: 1400,
			spaceBetween: 30,
			parallax: false,
			effect: "slide",
			active: 'active',
			autoplay: {
				delay: 5000,
				disableOnInteraction: false
			},
			autoplay: false,
			pagination: {
				el: '.slider__pagination',
				clickable: true,
				type: 'fraction',
			},
			navigation: {
				nextEl: '.custom-next',
				prevEl: '.custom-prev',
			},
			breakpoints: {
				// 1400: {
				// 	slidesPerView: 2,
				// },
			}
		});
	}

	// Style Five

	if ($('.testimonial.style-five .swiper-container').length) {
		var testi5Carousel = new Swiper('.testimonial.style-five .swiper-container', {
			preloadImages: false,
			loop: true,
			centeredSlides: false,
			resistance: true,
			resistanceRatio: 0.6,
			slidesPerView: 1,
			speed: 1400,
			spaceBetween: 30,
			parallax: false,
			effect: "slide",
			active: 'active',
			autoplay: {
				delay: 5000,
				disableOnInteraction: false
			},
			autoplay: false,
			pagination: {
				el: '.slider__pagination',
				clickable: true,
				type: 'fraction',
			},
			navigation: {
				nextEl: '.custom-next',
				prevEl: '.custom-prev',
			},
		});
	}

	// Style Six

	if ($('.testimonial.style-six .swiper-container').length) {
		var testi6Carousel = new Swiper('.testimonial.style-six .swiper-container', {
			preloadImages: false,
			loop: true,
			centeredSlides: false,
			resistance: true,
			resistanceRatio: 0.6,
			slidesPerView: 2,
			speed: 1400,
			spaceBetween: 30,
			parallax: false,
			effect: "slide",
			active: 'active',
			autoplay: {
				delay: 5000,
				disableOnInteraction: false
			},
			autoplay: false,
			pagination: {
				el: '.slider__pagination',
				clickable: true,
				type: 'fraction',
			},
			navigation: {
				nextEl: '.custom-next',
				prevEl: '.custom-prev',
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
				},
				768: {
					slidesPerView: 1,
				},
				992: {
					slidesPerView: 2,
				},
				1400: {
					slidesPerView: 2,
				},
			}
		});
	}

	/*
	 * Portfolio
	*/

	if ($('.portfolio-grid.style-two .portfolio-carousol').length) {
		var twoItemCarousel = new Swiper('.portfolio-grid.style-two .portfolio-carousol', {
			preloadImages: false,
			loop: true,
			centeredSlides: false,
			resistance: true,
			resistanceRatio: 0.6,
			slidesPerView: 4,
			speed: 1400,
			spaceBetween: 30,
			parallax: false,
			effect: "slide",
			active: 'active',
			slidesOffsetBefore: 270,
			slidesOffsetAfter: 270,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false
			},
			navigation: {
				nextEl: '.slider-button-next4',
				prevEl: '.slider-button-prev4',
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
					slidesOffsetBefore: 0,
					slidesOffsetAfter: 0,
				},
				768: {
					slidesPerView: 2,
					slidesOffsetBefore: 0,
					slidesOffsetAfter: 0,
				},
				1024: {
					slidesPerView: 3,
				},
				1200: {
					slidesPerView: 4,
				}, 
			}
		});
	}

	/*
	 * Banner Two
	*/

	var swiper = new Swiper(".banner-two-slider", {
		loop: true,
		autoplay: false,
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
			renderBullet: function (index, className) {
				return $('<span>', {
				class: className,
				text: index + 1
				})[0].outerHTML;
			}
		}
	});

})(jQuery);





