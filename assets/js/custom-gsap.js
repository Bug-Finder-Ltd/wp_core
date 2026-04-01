// wait until DOM is ready
document.addEventListener("DOMContentLoaded", function (event) {
	gsap.registerPlugin(ScrollTrigger, ScrollSmoother, ScrollToPlugin);

	//wait until images, links, fonts, stylesheets, and js is loaded
	window.addEventListener(
		"load",
		function (e) {
			const mm = gsap.matchMedia();
        
		/*===============
		Scroll Smoother
		=================*/
		
		const isMobile = window.matchMedia("(max-width: 767px)").matches;
		
        if (!isMobile) {
            ScrollSmoother.create({
                wrapper: "#smooth-wrapper",
                content: "#smooth-content",
                smooth: 1.2,
                effects: true,
            });
        }

		/*===============
		Smooth Navigation
		=================*/

		document.querySelectorAll('.navigation a[href^="#"]').forEach((link) => {
			link.addEventListener("click", function (e) {
                
                const href = this.getAttribute("href");
                if (href === "#") return;
                
				e.preventDefault();
                
				const target = document.querySelector(this.getAttribute("href"));
                
				if (target) {
					//smoother.scrollTo(target, true, "top top");
                    
                    window.scrollTo({
                        top: target.offsetTop,
                        behavior: "smooth"
                    });
				}
			});
		});
        
		/*===============
		 Breadcrumb
		=================*/

		const provix_breadcrumb = gsap.utils.toArray(".provix-breadcrumb > *");

		provix_breadcrumb.forEach((breadcrumb_item, index) => {
			gsap.from(breadcrumb_item, {
				x: 50,
				opacity: 0,
				duration: 0.5,
				delay: index * 0.2,
				ease: "power2.out",
			});
		});

		/*======================
		 Image animation
		========================*/

		gsap.utils.toArray(".image-box.style-one .image").forEach((section) => {
			let tl = gsap.timeline({
				scrollTrigger: {
					trigger: section,
					start: "top 80%",
					toggleActions: "play none none none",
					markers: false,
				},
			});

			tl.to(
				section.querySelector(".overlay-top"), {
					yPercent: -100,
					duration: 1.2,
					ease: "power3.inOut",
				},
				0,
			);

			tl.to(
				section.querySelector(".overlay-bottom"), {
					yPercent: 100,
					duration: 1.2,
					ease: "power3.inOut",
				},
				0,
			);
		});

		// Style two

		let imageWrapper = document.querySelectorAll(".image-anim-2");

		imageWrapper.forEach((container) => {
			let image = container.querySelector("img");
			let tl = gsap.timeline({
			scrollTrigger: {
				trigger: container,
				toggleActions: "restart none none reset",
			},
			});

			tl.set(container, { autoAlpha: 1 });
			tl.from(container, 1.5, {
				xPercent: -100,
				ease: Power2.out,
			});
			tl.from(image, 1.5, {
				xPercent: 100,
				scale: 1.3,
				delay: -1.5,
				ease: Power2.out,
			});
		});

		/*=========================
		 Text Animation (Global)
		===========================*/

		const text_anim_1 = document.querySelectorAll(".text-anim-1");

		if (text_anim_1.length > 0) {
			text_anim_1.forEach((el) => {
			const split = SplitText.create(el, { type: "chars,words,lines" });

			gsap.from(
				split.chars,
				{
				scrollTrigger: {
					trigger: el,
					start: "top 80%",
				},
				duration: 0.6,
				autoAlpha: 0,
				scale: 3,
				force3D: true,
				stagger: 0.02,
				},
				0.5,
			);
			});
		}

		// Style Two

		const text_anim_2 = document.querySelectorAll(".text-anim-2");

		if (text_anim_2.length > 0) {
			text_anim_2.forEach((el) => {
			// Get delay from data attribute
			let delayValue = parseFloat(el.getAttribute("data-split-delay")) || 0;

			// Split text into lines, words, chars
			el.split = new SplitText(el, {
				type: "lines,words,chars",
				linesClass: "split-line",
			});

			// Perspective for 3D effect
			gsap.set(el, { perspective: 400 });

			// Initial position and opacity
			gsap.set(el.split.chars, {
				x: 50,
				opacity: 0,
			});

			// Animate chars on scroll
			el.anim = gsap.to(el.split.chars, {
				x: 0,
				opacity: 1,
				duration: 0.4,
				ease: "power1.out",
				stagger: 0.02,
				delay: delayValue,
				scrollTrigger: {
					trigger: el,
					start: "top 86%",
					toggleActions: "play none none reverse",
				},
			});
			});
		}

		// Style Three

		const text_anim_3 = document.querySelectorAll(".text-anim-3");

		if (text_anim_3.length > 0) {
			text_anim_3.forEach((el) => {
			const split = SplitText.create(el, { type: "chars,words,lines" });

			gsap.from(split.lines, {
				scrollTrigger: {
				trigger: el,
				start: "top 80%",
				toggleActions: "play none none none",
				},
				rotationX: -100,
				transformOrigin: "50% 50% -160px",
				opacity: 0,
				duration: 0.8,
				ease: "power3.out",
				stagger: 0.25,
			});
			});
		}

		// Style Four

		const text_anim_4 = document.querySelectorAll(".text-anim-4");

		if (text_anim_4.length > 0) {
			text_anim_4.forEach((el) => {
			const split = SplitText.create(el, { type: "chars,words,lines" });

			gsap.set(split.chars, {
				opacity: 0,
				y: "90%",
				rotateX: "-40deg",
			});

			gsap.to(split.chars, {
				scrollTrigger: {
				trigger: el,
				start: "top 80%",
				},
				x: "0",
				y: "0",
				rotateX: "0",
				opacity: 1,
				duration: 1,
				ease: "back.out",
				stagger: 0.02,
			});
			});
		}

		// Style Five

		const text_anim_5 = document.querySelectorAll(".text-anim-5");

		if (text_anim_5.length > 0) {
			const split = new SplitType(text_anim_5, {
			types: "lines",
			lineClass: "line",
			});

			split.lines.forEach((line, i) => {
			gsap.set(line, {
				clipPath: "inset(0 100% 0 0)",
			});

			gsap.to(line, {
				clipPath: "inset(0 0% 0 0)",
				duration: 0.7,
				ease: "power2.out",
				delay: i * 0.3,
			});
			});
		}

		/*=========================
		 Parallax Image
		===========================*/

		// gsap.utils.toArray(".imagewrapper").forEach(imageWrap => {
		// 	const image = imageWrap.querySelector(".imageinside");
		// 	gsap.to(image, {
		// 		scrollTrigger: {
		// 			trigger: imageWrap,
		// 			toggleActions: "restart none none none",
		// 			scrub: 2
		// 		},
		// 		y: 200,
		// 		duration: 3
		// 	});
		// });


		gsap.utils.toArray(".imagewrapper").forEach(section => {
			const image = section.querySelector(".imageinside");
			if (!image) return;

			gsap.to(image, {
				y: 200, // image moves slower than scroll
				ease: "none",
				scrollTrigger: {
					trigger: section,
					start: "top bottom", // when section enters
					end: "bottom top", // when section leaves
					scrub: true,
					markers: false, // set true for debugging
				},
			});
		});



		/*=========================
		 Section title
		===========================*/

		gsap.utils.toArray(".section-title.style-five").forEach(section => {
			const title1 = section.querySelector(".title-1");
			const title2 = section.querySelector(".title-2");

			if (title1) {
				gsap.fromTo( title1,
					{
						x: 150,
					},
					{
						x: 0,
						scrollTrigger: {
							trigger: section,
							start: "top 70%",
							end: "bottom 70%",
							markers: false,
							scrub: 0.5,
							toggleActions: "play none none reverse"
						},
					},
				);
			}

			if (title2) {
				gsap.fromTo( title2,
					{
						x: 0,
					},
					{
						x: 150,
						scrollTrigger: {
							trigger: section,
							start: "top 70%",
							end: "bottom 70%",
							markers: false,
							scrub: 0.5,
							toggleActions: "play none none reverse"
						},
					},
				);
			}
		});

		// Style Six

		gsap.utils.toArray(".section-title.style-six").forEach( section => {
			const title1 = section.querySelector(".title-1");
			const title3 = section.querySelector(".title-3");

			if (title1) {
				gsap.fromTo( title1,
					{
						x: 150,
					},
					{
						x: 0,
						scrollTrigger: {
							trigger: section,
							start: "top 80%",
							end: "bottom 80%",
							markers: false,
							scrub: 0.5,
							toggleActions: "play none none reverse"
						},
					},
				);
			}

			if (title3) {
				gsap.fromTo( title3,
					{
						x: -150,
					},
					{
						x: 0,
						scrollTrigger: {
							trigger: section,
							start: "top 80%",
							end: "bottom 80%",
							markers: false,
							scrub: 0.5,
							toggleActions: "play none none reverse"
						},
					},
				);
			}
		} );

		/*=========================
		 Magnetic Effect
		===========================*/

		const magnetic_1 = document.querySelector(".magnetic_effect_1");

		if (magnetic_1) {
			var waMagnets3 = document.querySelectorAll(".magnetic_effect_1");
			var waStrength3 = 100;

			waMagnets3.forEach((magnet) => {
				magnet.addEventListener("mousemove", moveMagnet3);
				magnet.addEventListener("mouseout", function (event) {
					const innerElements = event.currentTarget.querySelectorAll(
						".magnetic_effect_1_elm"
					);
					innerElements.forEach((elm) => {
						gsap.to(elm, {
							x: 0,
							y: 0,
							duration: 1,
							ease: "elastic.out(1, 0.3)",
						});
					});
				});
			});

			function moveMagnet3(event) {
				var magnetButton = event.currentTarget;
				var bounding = magnetButton.getBoundingClientRect();
				const innerElements = magnetButton.querySelectorAll(
					".magnetic_effect_1_elm"
				);

				const xMove =
					((event.clientX - bounding.left) / magnetButton.offsetWidth -
						0.5) *
					waStrength3;
				const yMove =
					((event.clientY - bounding.top) / magnetButton.offsetHeight -
						0.5) *
					waStrength3;

				innerElements.forEach((elm) => {
					gsap.to(elm, {
						x: xMove,
						y: yMove,
						duration: 1,
						ease: "elastic.out(1, 0.3)",
					});
				});
			}
		}

		/*=========================
		 Portfolio
		===========================*/

		const portfolio3 = document.querySelector(".portfolio-grid.style-three");

		if (portfolio3) {
            
			const port3_title_tl = gsap.timeline();
            
			// Slide title
            
			port3_title_tl.from(".portfolio-grid.style-three .title1", {
				x: -1000,
				scrollTrigger: {
					trigger: ".portfolio-grid.style-three .title",
					start: "top bottom",
					end: "bottom center",
					scrub: true,
					invalidateOnRefresh: true,
					markers: false,
				}
			});
			port3_title_tl.from(".portfolio-grid.style-three .title2", {
				x: 1000,
				scrollTrigger: {
					trigger: ".portfolio-grid.style-three .title",
					start: "top bottom",
					end: "bottom center",
					scrub: true,
					invalidateOnRefresh: true,
					markers: false,
				}
			});

			// Zoom Out

			port3_title_tl.fromTo(".portfolio-grid.style-three .title1, .portfolio-grid.style-three .title2",
				{
					scale: 1,
					height: () => {
						const title = document.querySelector(".portfolio-grid.style-three .title1");
						return title.getBoundingClientRect().height;
					},
				},
				{
					scale: 0.1,
					height: () => {
						const title = document.querySelector(".portfolio-grid.style-three .title1");
						const originalHeight = title.getBoundingClientRect().height;
						const scale = 0.1;
						return originalHeight * scale;
					},
					scrollTrigger: {
						trigger: ".portfolio-grid.style-three .title",
						start: "top top",
						end: "bottom-=100 top",
						pin: true,
						pinSpacing: false,
						scrub: true,
						markers: false,
						invalidateOnRefresh: true,
					},
				},
			);
		}

		// Style Four

		const portfolio4 = document.querySelector(".portfolio-grid.style-four");

		if (portfolio4) {

			const section_title = portfolio4.querySelector(".section-title");

			ScrollTrigger.create({
				trigger: ".portfolio-grid.style-four .section-title",
				start: "top top",
				end: () => {
					return "+=" + (portfolio4.offsetHeight - section_title.offsetHeight);
				},
				pin: true,
				pinSpacing: false
			});

			const items = gsap.utils.toArray(
				portfolio4.querySelectorAll(".portfolio-item")
			);

			items.forEach((item) => {

				gsap.set(item, {
					transform: "rotateX(70deg) rotateY(0deg) rotateZ(-30deg)"
				});

				gsap.to(item, {
					rotateX: 0,
					rotateY: 0,
					rotateZ: 0,
					scrollTrigger: {
						trigger: item,
						start: "top 60%",
						end: "top top",
						scrub: 1.5
					}
				});

			});
		}

		// Style Five

		const portfolio5 = document.querySelector(".portfolio-grid.style-five");

		if (portfolio5) {

			mm.add("(min-width: 1025px)", () => {
				const totalItems = 6;

				for (let i = 1; i <= totalItems; i++) {
					const box1 = document.querySelector(`.top-item-${i}`);
					const box2 = document.querySelector(`.port-item-${i} .image`);

					if (!box1 || !box2) continue;

					const flip = Flip.fit(box1, box2, {
						//scale: true,
						ease: "none",
						duration: 1,
						absolute: true,
					});

					flip.pause(0);

					ScrollTrigger.create({
						trigger: box1,
						start: "top top",
						end: "bottom top",
						scrub: true,
						markers: false,
						onUpdate: self => {
							flip.progress(self.progress);
						}
					});
				}
			});

			mm.add("(max-width: 1024px)", () => {

				const totalItems = 6;

				for (let i = 1; i <= totalItems; i++) {

				const box1 = document.querySelector(`.top-item-${i}`);
				const box2 = document.querySelector(`.port-item-${i} .image`);

				if (!box1 || !box2) continue;

				Flip.fit(box1, box2, {
					absolute: true,
					duration: 0
				});

				}

			});

		}

		/*=========================
		 Image Heading 
		===========================*/

		const imageHeading1 = document.querySelector(".inline-text-image.style-one");

		if(imageHeading1){
			const box1 = imageHeading1.querySelector(".image-wrap img");
			const box2 = imageHeading1.querySelector(".full-img");
			const flip = Flip.fit(box1, box2, {
				scale: true,
				ease: "none",
				duration: 1,
				absolute: true,
			});

			flip.pause(0);

			ScrollTrigger.create({
				trigger: ".inline-text-image.style-one",
				start: "top center",
				end: "bottom bottom",
				scrub: true,
				markers: false,
				onUpdate: self => {
					flip.progress(self.progress);
				}
			});
		}

		/*================
		Service List
		==================*/
		
		const service1_cards = gsap.utils.toArray(".service-list.style-two .service-item");
		
        service1_cards.forEach((card, index) => {
            
            const cardHeight = card.offsetHeight;
            
            ScrollTrigger.create({
                trigger: card,
                start: "top top+=140",
                pin: true,
                pinSpacing: false,
                markers: false,
                endTrigger: ".service-list.style-two",
                end: () => `bottom top+=${(cardHeight * 2) + 140}`,
                invalidateOnRefresh: true,
            });
        });
        
        const service1_title = document.querySelector(".service-list.style-two .title");
        
        if(service1_title) {
            ScrollTrigger.create({
                trigger: service1_title,
                start: "top top+=140",
                pin: true,
                pinSpacing: false,
                endTrigger: ".service-list.style-two",
                end: "bottom bottom",
                markers: false,
            });
        }

        // Style Four

		gsap.utils.toArray(".service-list.style-four .service-item").forEach((item, index) => {
			const image = item.querySelector(".image");

			const isEven = index % 2 === 0;

			gsap.fromTo(
				image,
				{
					rotate: isEven ? 10 : -10,
					skewX: isEven ? 10 : -10,
					x: isEven ? 400 : -400,
				},
				{
					rotate: 0,
					skewX: 0,
					x: 0,
					scrollTrigger: {
						trigger: item,
						start: "top bottom",
						end: "bottom top",
						scrub: true,
						markers: false,
					},
				},
			);
		});

		// Style Five

		const service_5 = document.querySelector(".service-list.style-five");

		if(service_5){

			mm.add("(min-width: 768px)", () => {
				const list = document.querySelector(".service-list.style-five");
				const items = gsap.utils.toArray(".service-list.style-five .service-item");
				const gap = 170;

				// space so next section doesn't overlap
				const totalOffset = (items.length - 1) * gap;
				list.style.paddingBottom = totalOffset + "px";

				const lastItem = items[items.length - 1];

				items.forEach((item, index) => {
					ScrollTrigger.create({
						trigger: item,
						start: () => `top-=${index * gap} top`,
						endTrigger: lastItem,
						end: "top top",
						pin: true,
						pinSpacing: false,
						invalidateOnRefresh: true,
						markers: false,
					});
				});
			});
		}

		// Style Six

		const service_6 = document.querySelector(".service-list.style-six");

		if(service_6){
			const cards = gsap.utils.toArray(".service-item");

			cards.forEach((card, index) => {
				const nextCard = cards[index + 1];

				if (!nextCard) return;

				gsap.timeline({
					scrollTrigger: {
						trigger: card,
						start: "top+=100 top+=100",
						endTrigger: nextCard,
						end: "top+=100 top+=100",
						scrub: true,
						pin: true,
						pinSpacing: false,
						invalidateOnRefresh: true,
					}
				})
				.to(card, {
					opacity: 0,
					scale: 0.8,
					ease: "none"
				});
			});
		}

		/*============
		Hero 1
		==============*/

		const hero_1 = document.querySelector(".banner-area.style-one");

		if (hero_1) {
			const star = hero_1.querySelector(".banner-one-top-right .star");
			const arrow = hero_1.querySelector(".banner-one-title .banner-icon-1");

			gsap.from(star, {
				x: window.innerWidth,
				rotation: -720,
				duration: 1.5,
				});

				gsap.from(arrow, {
				x: -window.innerWidth,
				// rotation: -720,
				duration: 1.5,
			});
		}

		/*============
		Hero 2
		==============*/

		const hero_2 = document.querySelector(".banner-area.style-two");

		if (hero_2) {
			var tl = gsap.timeline(),
			firstBg = document.querySelectorAll(".text__first-bg"),
			secBg = document.querySelectorAll(".text__second-bg"),
			thirdBg = document.querySelectorAll(".text__third-bg"),
			word = document.querySelectorAll(".text__word");
			highlightWord = document.querySelector(".highlight-text");
			highlightItem = document.querySelectorAll(".highlight-text span");

			let maxWidth = 0;

			tl.to(firstBg, 0.2, { scaleX: 1 })
			.to(secBg, 0.2, { scaleX: 1 })
			.to(thirdBg, 0.2, { scaleX: 1 })
			.to(word, 0.1, { opacity: 1 }, "-=0.1")
			.to(highlightWord, 0.1, { opacity: 1 }, "-=0.1")
			.to(firstBg, 0.2, { scaleX: 0 })
			.to(secBg, 0.2, { scaleX: 0 })
			.to(thirdBg, 0.2, { scaleX: 0 });

			// Set width
			highlightItem.forEach((item) => {
			const width = item.offsetWidth;
			if (width > maxWidth) {
				maxWidth = width;
			}
			});

			highlightWord.style.width = maxWidth + "px";
		}

		/*============
		Hero 3
		==============*/

		const hero_3 = document.querySelector(".banner-area.style-three");

		if (hero_3) {
			const hero_3_subtitle = hero_3.querySelector(".banner-six-title h6");
			const hero_3_description = hero_3.querySelector(".banner-six-title p");
			const hero_3_btn_set = hero_3.querySelector(".banner-six-btn-box");

			gsap.from(hero_3_subtitle, {
			y: -100,
			duration: 0.3,
			ease: "power1.inOut",
			});

			const split = new SplitType(hero_3_description, {
			types: "lines",
			lineClass: "line",
			});

			gsap.from(hero_3_description, {
			left: -200,
			opacity: 0,
			});

			const items = gsap.utils.toArray(".banner-six-btn-box > *");

			items.forEach((item, index) => {
			gsap.from(item, {
				x: -50,
				opacity: 0,
				duration: 0.5,
				delay: index * 0.2,
				ease: "power2.out",
			});
			});

			const visitor_list = gsap.utils.toArray(
			".banner-six-visitor-list ul > *",
			);

			visitor_list.forEach((item, index) => {
			gsap.from(item, {
				y: 80,
				opacity: 0,
				duration: 0.5,
				delay: index * 0.2,
				ease: "power2.out",
			});
			});
		}

		/*============
		Hero 4
		==============*/

		const hero_4 = document.querySelector(".hero-section.style-four");

		if (hero_4) {
			const imagesWrap = hero_4.querySelector(".images");
			const imagesWrapRect = imagesWrap.getBoundingClientRect();

			mm.add("(min-width: 1200px)", () => {
				ScrollTrigger.create({
					trigger: hero_4,
					start: "top top",
					end: "+=2000",
					pin: ".hero-section.style-four .banner-area",
					pinSpacing: true
				});
			});

			/* IMAGE ANIMATIONS */

			const img1 = hero_4.querySelector(".img1");
			const img2 = hero_4.querySelector(".img2");
			const img3 = hero_4.querySelector(".img3");
			const img4 = hero_4.querySelector(".img4");
			const img5 = hero_4.querySelector(".img5");
			const img6 = hero_4.querySelector(".img6");

			gsap.set(img1, {
				x: -500,
				rotation: -20,
			});
			gsap.set(img2, {
				x: 500,
				y: -341,
				rotation: 20,
			});
	
			gsap.fromTo( img3,
				{
					x: 0
				},
				{
					x: 500,
					rotation: 20,
					ease: "power2.out",
					scrollTrigger: {
						trigger: img3,
						start: "top 80%",
						end: "top top",
						scrub: true,
						invalidateOnRefresh: true,
					}
				}
			);

			gsap.fromTo(
				img4,
				{ x: 0 },
				{
				x: -500,
				rotation: -20,
				ease: "power2.out",
				scrollTrigger: {
					trigger: img4,
					start: "top 80%",
					end: "top top",
					scrub: true,
				}
				}
			);

			gsap.fromTo(
				img5,
				{ x: 0 },
				{
				x: 500,
				rotation: 20,
				ease: "power2.out",
				scrollTrigger: {
					trigger: img5,
					start: "top 80%",
					end: "top top",
					scrub: true,
				}
				}
			);

			gsap.fromTo(
				img6,
				{ x: 0 },
				{
					x: -500,
					rotation: -20,
					ease: "power2.out",
					scrollTrigger: {
						trigger: img6,
						start: "top 80%",
						end: "top top",
						scrub: true,
					}
				}
			);



			// gsap.to(img3, {
			//   x: () => {
			//     const img3Rect = img3.getBoundingClientRect();
			//     // move image so its RIGHT edge touches wrapper RIGHT edge
			//     return imagesWrapRect.right - img3Rect.right;
			//   },
			//   rotation: 20,
			// });

			// tl.to(img4, {
			//   x: () => {
			//     const img4Rect = img4.getBoundingClientRect();
			//     return imagesWrapRect.left - img4Rect.left;
			//   },
			//   rotation: -20,
			// });

			// tl.to(img5, {
			//   x: () => {
			//     const img5Rect = img5.getBoundingClientRect();
			//     return imagesWrapRect.right - img5Rect.right;
			//   },
			//   rotation: 20,
			// });

			// tl.to(img6, {
			//   x: () => {
			//     const img6Rect = img6.getBoundingClientRect();
			//     return imagesWrapRect.left - img6Rect.left;
			//   },
			//   rotation: -20,
			// });


		}

		/*============
		 Hero 5
		==============*/

		const hero_5 = document.querySelector(".banner-area.style-five");

		if (hero_5) {

			mm.add("(min-width: 768px)", () => {
				const imgWrap = hero_5.querySelector(".images");
				const image1 = hero_5.querySelector(".images .img1");
				const image2 = hero_5.querySelector(".images .img2");
				const img_timeline = gsap.timeline();

				img_timeline.fromTo([image1, image2],
					{
						y: -500,
						scale: 0,
					},
					{
						y: 0,
						scale: 1,
						duration: 1.2,
					}
				);

				img_timeline.to([image1, image2], {
					x: (i, el) => {
						const parentRect = imgWrap.getBoundingClientRect();
						const elRect = el.getBoundingClientRect();

						if (i === 0) {
							return -(elRect.left - parentRect.left);
						} else {
							return parentRect.right - elRect.right;
						}

						
					},
					rotate: (i) => (i === 0 ? 10.92 : -9.43),
				});
			});

		}

		/*============
		 Hero 6
		==============*/

		const hero_6 = document.querySelector(".banner-area.style-six");

		if (hero_6) {
			const title_1 = hero_6.querySelector(".title1");
			const title_2 = hero_6.querySelector(".title2");

			gsap.to(title_1, {
				xPercent: -80,
				scrollTrigger: {
					trigger: hero_6,
					start: "top top",
					end: "bottom 80%",
					scrub: true,
					markers: false,
				}
			});

			gsap.to(title_2, {
				xPercent: 80,
				scrollTrigger: {
					trigger: hero_6,
					start: "top top",
					end: "bottom top",
					scrub: true,
					markers: false,
				}
			});
		}

		/*============
		 Info Box
		==============*/

		const infobox_1 = document.querySelector('.info-box.style-two');

		if(infobox_1){

			mm.add("(min-width: 1025px)", () => {
				gsap.set('.info-box.style-two .title', {
					y: -600,
					color: "#fff",
					scale: 0.5,
				});

				gsap.to('.info-box.style-two .title', {
					y: 0,
					color: "#023929",
					scale: 1,
					scrollTrigger: {
						trigger: infobox_1,
						start: "top bottom",
						end: "top top",
						scrub: true,
						markers: false,
					}
				});
			});
		}

		/*============
		 Awards
		==============*/

		const moveThumbsWrapper = document.querySelector('.tp-awards-vp-move-thumbs-wrapper');
		const startThumbsCaption = document.querySelector('.tp-awards-vp-start-thumbs-caption');
		const moveThumbsParent = document.querySelectorAll('.start-thumbs-wrapper .tp-awards-vp-start-move-thumb');
		const moveThumbs = document.querySelectorAll('.start-thumbs-wrapper .tp-awards-vp-move-thumb-inner');
		const overlappingThumbs = document.querySelectorAll('.tp-awards-vp-end-thumbs-wrapper .tp-awards-vp-end-move-thumb');
		
		function animateElements(moveThumbs, overlappingThumbs, moveThumbsParent) {
			moveThumbs.forEach((moveThumb, index) => {
				const state = Flip.getState(moveThumb);
				overlappingThumbs[index].appendChild(moveThumb);

				const moveAnimation = Flip.from(state, {
					duration: 1,
					ease: 'power4.inOut',
				});

				const startOffset = moveThumbsParent[index].dataset.start;
				const endOffset = moveThumbsParent[index].dataset.stop;

				ScrollTrigger.create({
					trigger: moveThumbsParent[index],
					start: startOffset,
					end: endOffset,
					scrub: true,
					animation: moveAnimation,
				});
			});

			//  Only run if element exists
			if (startThumbsCaption) {
				gsap.to(startThumbsCaption, {
					scrollTrigger: {
						trigger: startThumbsCaption,
						start: () => {
							const startPin = (window.innerHeight - startThumbsCaption.offsetHeight) / 2;
							return "top +=" + startPin;
						},
						end: () => {
							return "+=" + window.innerHeight;
						},
						pin: true,
						pinSpacing: false,
						scrub: true,
					},
					opacity: 0,
					ease: "power1.inOut",
				});
			}
		}

		mm.add("(min-width: 1025px)", () => {
			animateElements(
				Array.from(moveThumbs),
				Array.from(overlappingThumbs),
				Array.from(moveThumbsParent)
			);
		});
			
		/*============
		Tabs
		==============*/

      const tabs_1 = document.querySelector(".provix-tabs.style-one");

      if (tabs_1) {
        const nav_items = gsap.utils.toArray(".nav-tabs > *");

        nav_items.forEach((item, index) => {
          gsap.from(item, {
            x: -50,
            opacity: 0,
            duration: 0.5,
            delay: index * 0.2,
            ease: "power2.out",
            scrollTrigger: {
              trigger: nav_items,
              start: "top 80%",
            },
          });
        });

        const tab_content = gsap.utils.toArray(
          ".service-two-container-content > *",
        );

        tab_content.forEach((item, index) => {
          gsap.from(item, {
            x: 100,
            opacity: 0,
            duration: 0.5,
            delay: index * 0.2,
            ease: "power2.out",
            scrollTrigger: {
              trigger: tab_content,
              start: "top 80%",
            },
          });
        });
      }

      /*============
     Experience Box
    ==============*/

      const exp_box_1 = document.querySelector(".experience-box.style-one");

      if (exp_box_1) {
        gsap.to(".curved-circle", {
          rotation: 360,
          repeat: -1,
          ease: "linear",
          duration: 10,
          force3D: true,
        });
      }

      /*===============
     CTA
    =================*/

      mm.add("(min-width: 1025px)", () => {
        const tl2 = gsap.timeline({
          scrollTrigger: {
            trigger: ".cta-container",
            start: "top center",
            end: "bottom top",
            scrub: 1,
          },
        });

        tl2.fromTo(
          ".cta-container .content",
          { scale: 0, transformOrigin: "center center" },
          { scale: 1, duration: 1, ease: "power3.out" },
        );

        gsap.utils.toArray(".cta-image-box img").forEach((img) => {
          tl2.from(
            img,
            {
              top: "50%",
              left: "50%",
              x: "-50%",
              y: "-50%",
              duration: 0.7,
              ease: "power2.out",
            },
            0,
          );
        });
      });

		/*===============
		 Single Button
		=================*/

      const boundary = document.querySelector(".single-btn.style-one");

      if (boundary) {
        const button = boundary.querySelector(".single-btn.style-one .button");

        // Helper: center the button inside boundary
        const centerButton = () => {
          const isMobile = window.matchMedia("(max-width: 1024px)").matches;
          const bounds = boundary.getBoundingClientRect();
          const centerX = bounds.width / 2 - button.offsetWidth / 2;
          const centerY = bounds.height / 2 - button.offsetHeight / 2;

          if (isMobile) {
            x = bounds.width / 2 - button.offsetWidth / 2;
          } else {
            x = bounds.width - button.offsetWidth;
          }

          gsap.to(button, {
            x: x,
            y: centerY,
            duration: 0.6,
            ease: "power3.out",
          });
        };

        // Initial center position
        centerButton();
        window.addEventListener("resize", centerButton);

        // Mouse move effect
        boundary.addEventListener("mousemove", (evt) => {
          const bounds = boundary.getBoundingClientRect();
          const mouseX = evt.clientX - bounds.left;
          const mouseY = evt.clientY - bounds.top;

          // Button moves slightly toward cursor
          const moveFactor = 0.5; // smaller = subtler motion
          const targetX =
            (mouseX - bounds.width / 2) * moveFactor +
            (bounds.width / 2 - button.offsetWidth / 2);
          const targetY =
            (mouseY - bounds.height / 2) * moveFactor +
            (bounds.height / 2 - button.offsetHeight / 2);

          gsap.to(button, {
            x: targetX,
            y: targetY,
            duration: 0.4,
            ease: "power3.out",
            overwrite: true,
          });
        });

        // Return to center when mouse leaves
        boundary.addEventListener("mouseleave", () => {
          centerButton();
        });
      }

		/*===============
		List
		=================*/

		const lists_2 = document.querySelector(".lists.style-2");

		if (lists_2) {
			gsap.from(".lists.style-2 li", {
				duration: 1,
				xPercent: 100,
				opacity: 0,
				scale: 0.8,
				ease: "power1.out",
				stagger: 0.2,
				scrollTrigger: {
					trigger: ".lists.style-2",
					start: "top 80%",
				},
			});
		}

		// Style Three

		const lists_3 = document.querySelector(".lists.style-3");

		if (lists_3) {
			gsap.from(".lists.style-3 li", {
				duration: 1,
				xPercent: -100,
				opacity: 0,
				scale: 0.8,
				ease: "power1.out",
				stagger: 0.2,
				scrollTrigger: {
					trigger: ".lists.style-3",
					start: "top 80%",
				},
			});
		}

      /*===============
     Feature List 1
    =================*/

      const feature_list_1 = document.querySelector(".features-list.style-one");

      if (feature_list_1) {
        const cards = gsap.utils.toArray(
          ".features-list.style-one .feature-item",
        );

        cards.forEach((card, index) => {
          ScrollTrigger.create({
            trigger: card,
            start: () => `top top+=140`,
            pin: true,
            pinSpacing: false,
            markers: false,
            id: "pin",
            endTrigger: ".features-list.style-one",
            end: () => `bottom top+=505`,
            invalidateOnRefresh: true,
          });
        });

        mm.add("(min-width: 768px)", () => {
          ScrollTrigger.create({
            trigger: ".features-list.style-one .feature-left",
            start: () => `top top+=140`,
            pin: true,
            pinSpacing: false,
            markers: false,
            id: "pin",
            endTrigger: ".features-list.style-one",
            end: () => `bottom-=200 top+=505`,
            invalidateOnRefresh: true,
          });

          const boundary = document.querySelector(
            ".features-list.style-one .feature-left .button-area",
          );

          if (boundary) {
            const button = boundary.querySelector(
              ".features-list.style-one .view-all",
            );

            // Helper: center the button inside boundary
            const centerButton = () => {
              const bounds = boundary.getBoundingClientRect();
              const centerX = bounds.width / 2 - button.offsetWidth / 2;
              const centerY = bounds.height / 2 - button.offsetHeight / 2;
              gsap.to(button, {
                x: centerX,
                y: centerY,
                duration: 0.6,
                ease: "power3.out",
              });
            };

            // Initial center position
            centerButton();
            window.addEventListener("resize", centerButton);

            // Mouse move effect
            boundary.addEventListener("mousemove", (evt) => {
              const bounds = boundary.getBoundingClientRect();
              const mouseX = evt.clientX - bounds.left;
              const mouseY = evt.clientY - bounds.top;

              // Button moves slightly toward cursor
              const moveFactor = 0.5; // smaller = subtler motion
              const targetX =
                (mouseX - bounds.width / 2) * moveFactor +
                (bounds.width / 2 - button.offsetWidth / 2);
              const targetY =
                (mouseY - bounds.height / 2) * moveFactor +
                (bounds.height / 2 - button.offsetHeight / 2);

              gsap.to(button, {
                x: targetX,
                y: targetY,
                duration: 0.4,
                ease: "power3.out",
                overwrite: true,
              });
            });

            // Return to center when mouse leaves
            boundary.addEventListener("mouseleave", () => {
              centerButton();
            });
          }
        });

        // Title animation

        const ft = document.querySelector(
          ".features-list.style-one .feature-title",
        );

        if (ft) {
          const split = SplitText.create(ft, { type: "chars,words,lines" });

          gsap.from(split.lines, {
            scrollTrigger: {
              trigger: ft,
              start: "top 80%",
              toggleActions: "play none none none",
            },
            rotationX: -100,
            transformOrigin: "50% 50% -160px",
            opacity: 0,
            duration: 0.8,
            ease: "power3.out",
            stagger: 0.25,
          });
        }
      }

      /*===============
     Feature List 2
    =================*/

      const feature_list_2 = document.querySelector(".features-list.style-two");

      if (feature_list_2) {
        const item1 = document.querySelector(".feature-item.item-1");
        const item2 = document.querySelector(".feature-item.item-2");
        const item3 = document.querySelector(".feature-item.item-3");
        const item4 = document.querySelector(".feature-item.item-4");

        mm.add("(min-width: 1130px)", () => {
          const containerWidth = feature_list_2.offsetWidth;

          const item1Width = item1.offsetWidth;
          const item2Width = item2.offsetWidth;
          const item3Width = item3.offsetWidth;
          const item4Width = item4.offsetWidth;

          const targetX1 = containerWidth / 2 - item1Width / 2;
          const targetX2 = containerWidth / 2 - item2Width / 2;
          const targetX3 = containerWidth / 2 - item3Width / 2;
          const targetX4 = containerWidth / 2 - item4Width / 2;

          const tl = gsap.timeline({
            scrollTrigger: {
              trigger: feature_list_2,
              start: "top-=50 top",
              end: "bottom top",
              scrub: true,
              pin: true,
              anticipatePin: 1,
              invalidateOnRefresh: true,
            },
          });

          tl.to(item1, { x: -targetX1, y: -246, ease: "none" }, 0)
            .to(item2, { x: targetX2, y: -246, ease: "none" }, 0)
            .to(item3, { x: -targetX3, y: 261, ease: "none" }, 0)
            .to(item4, { x: targetX4, y: 261, ease: "none" }, 0);

          // gsap.to(item1, {
          //     x: -targetX1,
          //     y: -246,
          //     duration: 1,
          //     ease: "sine.inOut",
          //     scrollTrigger: {
          //         trigger: ".features-list.style-two",
          //         start: "top 100%",
          //         toggleActions: "play reverse play reverse"
          //     }
          // });
        });
      }

		/*==============
		Feature List 3
		================*/

		const feature_list_3 = document.querySelector(
			".features-list.style-three",
		);

		if (feature_list_3) {
			const item1 = document.querySelector(".feature-item.item-1");
			const item2 = document.querySelector(".feature-item.item-2");
			const item3 = document.querySelector(".feature-item.item-3");
			const item4 = document.querySelector(".feature-item.item-4");

			mm.add("(min-width: 1130px)", () => {
			const containerWidth = feature_list_3.offsetWidth;

			const item1Width = item1.offsetWidth;
			const item2Width = item2.offsetWidth;
			const item3Width = item3.offsetWidth;
			const item4Width = item4.offsetWidth;

			const targetX1 = containerWidth / 2 - item1Width / 2;
			const targetX2 = containerWidth / 2 - item2Width / 2;
			const targetX3 = containerWidth / 2 - item3Width / 2;
			const targetX4 = containerWidth / 2 - item4Width / 2;

			const tl = gsap.timeline({
				scrollTrigger: {
				trigger: feature_list_3,
				start: "top-=50 top",
				end: "bottom top",
				scrub: true,
				pin: true,
				anticipatePin: 1,
				invalidateOnRefresh: true,
				},
			});

			tl.to(item1, { x: targetX2, y: -356, ease: "none" }, 0)
				.to(item3, { x: -targetX3, y: 356, ease: "none" }, 0)
				.to(item4, { x: targetX4, y: 356, ease: "none" }, 0);
			});
		}

		/*===============
		 Gallery
		=================*/

		const gallery_1 = document.querySelector(".gallery.style-one");

		if(gallery_1){

			mm.add("(min-width: 768px)", () => {
				const gl_tl = gsap.timeline({
					scrollTrigger: {
						trigger: gallery_1,
						scrub: 1,
						pin: true,
						start: "top 40px",
						end: "+=100%",
					}
				})
				.to(".gallery.style-one .gallery-list", {
					scale: 3.15,
					ease: "none"
				})
				.fromTo(".gallery.style-one .overlay", {opacity: 0}, {
					opacity: 1,
					duration: 0.4,
					ease: "power1.out",
				})
				.fromTo(".gallery.style-one .content .rotating-image", {x: -100, opacity: 0}, {
					x: 0,
					opacity: 1,
					duration: 0.4,
					ease: "power1.out",
				})
				.fromTo(".gallery.style-one .content .title", {x: 100, opacity: 0}, {
					x: 0,
					opacity: 1,
					duration: 0.4,
					ease: "power1.out",
				})
			});
		}

		/*===============
		Product 
		=================*/

		const product_item2 = document.querySelectorAll(
			".provix-product-grid.style-two .product-item",
		);

      if (product_item2.length > 0) {
        product_item2.forEach((widget) => {
          const cursor = widget.querySelector(".cursor");

          let mouseX = 0,
            mouseY = 0;
          let cursorX = 0,
            cursorY = 0;
          let isHovering = false;
          let isLeaving = false;

          const centerCursor = () => {
            const bounds = widget.getBoundingClientRect();
            const centerX = bounds.width / 2;
            const centerY = bounds.height / 2;
            gsap.set(cursor, { x: centerX, y: centerY });
            cursorX = centerX;
            cursorY = centerY;
          };

          centerCursor();

          // Hover enter
          widget.addEventListener("mouseenter", () => {
            isHovering = true;
            isLeaving = false;
            gsap.killTweensOf(cursor);
            gsap.to(cursor, {
              autoAlpha: 1,
              scale: 1,
              duration: 0.3,
              ease: "power2.out",
            });
          });

          // Mouse move
          widget.addEventListener("mousemove", (evt) => {
            const bounds = widget.getBoundingClientRect();
            mouseX = evt.clientX - bounds.left;
            mouseY = evt.clientY - bounds.top;
          });

          // Smooth lerp follow
          gsap.ticker.add(() => {
            if (!isHovering && !isLeaving) return;

            const lerpSpeed = isLeaving ? 0.06 : 0.12;
            cursorX += (mouseX - cursorX) * lerpSpeed;
            cursorY += (mouseY - cursorY) * lerpSpeed;

            gsap.set(cursor, { x: cursorX, y: cursorY });
          });

          // Hover leave — smooth natural finish
          widget.addEventListener("mouseleave", () => {
            isHovering = false;
            isLeaving = true;

            const fadeDelay = 0.25; // wait before disappearing
            const fadeDuration = 0.5;

            gsap.delayedCall(fadeDelay, () => {
              if (!isHovering) {
                gsap.to(cursor, {
                  scale: 0.8,
                  autoAlpha: 0,
                  duration: fadeDuration,
                  ease: "power2.inOut",
                  onComplete: () => {
                    isLeaving = false;
                    centerCursor();
                  },
                });
              }
            });
          });

          window.addEventListener("resize", centerCursor);
        });
      }

		/*======================
		Team animation
		========================*/

		gsap.utils
			.toArray(".team-single.style-three .team-single-image-box")
			.forEach((section) => {
			let tl = gsap.timeline({
				scrollTrigger: {
				trigger: section,
				start: "top 80%",
				toggleActions: "play none none none",
				markers: false,
				},
			});

			tl.to(
				section.querySelector(".overlay-top"),
				{
				yPercent: -100,
				duration: 1.2,
				ease: "power3.inOut",
				},
				0,
			);

			tl.to(
				section.querySelector(".overlay-bottom"),
				{
				yPercent: 100,
				duration: 1.2,
				ease: "power3.inOut",
				},
				0,
			);
		});

		/*======================
		 Team List
		========================*/

		const team_list_1 = document.querySelector(".team-list.style-one");

		if(team_list_1){

			const section_title = team_list_1.querySelector(".section-title");

			mm.add("(min-width: 992px)", () => {
				ScrollTrigger.create({
					trigger: team_list_1,
					start: "top top",
					end: `bottom-=${section_title.offsetHeight} top`,
					pin: section_title,
					pinSpacing: true
				});
			});
		}

		/*======================
		 Button
		========================*/

		gsap.utils.toArray(".single-btn.style-four .button").forEach( button => {
			const buttonText = button.querySelector(".button-text");

			const split = SplitText.create(buttonText, { type: "chars,words,lines" });

			const tl = gsap.timeline({ paused: true });

			tl.to(split.chars, {
				x: 0,
				opacity: 1,
				stagger: 0.04,
				duration: 0.4,
				ease: "power2.out"
			});
			button.addEventListener("mouseenter", () => {
				gsap.set(split.chars, { x: 20, opacity: 0 });
				tl.restart();
			});
		});

		/*===============
		Blog 
		=================*/

		const blog_1 = document.querySelector(".blog-posts.style-one");

		if (blog_1) {
			const items = blog_1.querySelectorAll(".right-column .blog-item");

			const item1 = items[0];
			const item2 = items[1];
			const item3 = items[2];

			const item1Height = item1.offsetHeight;
			const item2Height = item2.offsetHeight;
			const item3Height = item3.offsetHeight;

			gsap.from(item1, {
				y: item1Height,
				duration: 1,
				opacity: 0,
				ease: "power1.out",
				scrollTrigger: {
					trigger: blog_1,
					start: "top 50%",
				},
			});

			gsap.from(item3, {
				y: -item3Height,
				duration: 1,
				opacity: 0,
				ease: "power1.out",
				scrollTrigger: {
					trigger: blog_1,
					start: "top 50%",
				},
			});
		}

    },
    false,
  );
});
