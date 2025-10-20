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
            'frontend/element_ready/protine-counter.default',
            initWidgetThree
        );

    });
})(jQuery);