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
	
	const serviceCarousel = function ($scope, $) {
        $scope.find('.service-list.style-two').each(function () {
            const service_2 = new Swiper('.service-list.style-two .service-slider', {
                slidesPerView: 3,
                centeredSlides: true,
                effect: "slide",
                loop: true,
                // speed: 1400,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.button-next',
                    prevEl: '.button-prev',
                },
                breakpoints: {
                    320: {
                        spaceBetween: 30,
                        slidesPerView: 1,
                    },
                    768: {
                        spaceBetween: 30,
                        slidesPerView: 2,
                        centeredSlides: false,
                    },
                    1200: {
                        slidesPerView: 3,
                    }
                }
            });
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
            'frontend/element_ready/service-list.default',
            serviceCarousel
        );

        elementorFrontend.hooks.addAction(
            'frontend/element_ready/raizen-counter.default',
            initWidgetThree
        );

    });

    /*
	 * Video Box
    */

	$(".play-button").on("click", function() {
		$(".preview-image, .play-button").hide();
		$("#videoPlayer").show()[0].play();
	});

	/*
	 * Service List
	*/

	$(".service-item").hover(function(){
		$(".service-item").removeClass("sActive");
		$(this).addClass("sActive");
	});

	if ($(".service-item.sActive").length === 0) {
		$(".service-item").first().addClass("sActive");
	}

	// Style Two

    $(".service-list .lists .item").first().addClass("active-item");

    $(".image-box .service-two-image").css({
        opacity: 0,
        left: "-20px"
    });

    $(".image-box .service-two-image-1")
        .css({ left: "20px" })
        .animate({ opacity: 1, left: 0 }, 300);

    $(".service-list .lists .item").on("click", function (e) {
        e.preventDefault();
        
        if ($(this).hasClass("active-item")) return;

        var index = $(this).index() + 1;

        $(".service-list .lists .item").removeClass("active-item");
        $(this).addClass("active-item");

        $(".image-box .service-two-image").stop().animate({
            opacity: 0,
            left: "-20px"
        }, 300);

        $(".image-box .service-two-image-" + index)
            .css({ left: "20px" })
            .stop()
            .animate({ opacity: 1, left: 0 }, 300);
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
	 * Team
	*/
    
    if ($(window).width() > 767) {
        $(".frame .item").on("click", function () {
            
            let angle = $(this).data("angle");
            let index = $(this).attr("class").split(" ")[1];
            
            // Rotate the circle frame
            $(".frame").css("transform", "rotate(" + angle + "deg)");
            
            // Counter rotate images wrapper so the image stays upright
            $(".rotator").css("transform", "rotate(" + (-angle) + "deg)");
            
            // Active highlight
            $(".item").removeClass("active");
            $(this).addClass("active");
            
            // Show title
            $(".title").removeClass("active");
            $("." + index + "-title").addClass("active");
            
        });
        
        // default load
        $(".item1").click();
    }



})(jQuery);