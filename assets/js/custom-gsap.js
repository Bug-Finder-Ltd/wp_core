// wait until DOM is ready
document.addEventListener("DOMContentLoaded", function(event){

    gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

    //wait until images, links, fonts, stylesheets, and js is loaded
    window.addEventListener("load", function(e){

    const mm = gsap.matchMedia();

    /*===============
     Scroll Smoother
    =================*/

    ScrollSmoother.create({
        smooth: 1.2,
        effects: true,
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
                markers: false
            }
        });

        tl.to(section.querySelector(".overlay-top"), {
            yPercent: -100,
            duration: 1.2,
            ease: "power3.inOut"
        }, 0);

        tl.to(section.querySelector(".overlay-bottom"), {
            yPercent: 100,
            duration: 1.2,
            ease: "power3.inOut"
        }, 0);
    });

    // Style two

    let revealContainers = document.querySelectorAll(".image-box.style-two .feature-image");

    revealContainers.forEach((container) => {
        let image = container.querySelector("img");
        let tl = gsap.timeline({
            scrollTrigger: {
                trigger: container,
                toggleActions: "restart none none reset"
            }
        });

        tl.set(container, { autoAlpha: 1 });
        tl.from(container, 1.5, {
            xPercent: -100,
            ease: Power2.out
        });
        tl.from(image, 1.5, {
            xPercent: 100,
            scale: 1.3,
            delay: -1.5,
            ease: Power2.out
        });
    });

    /*===============
     Experiance Box
    =================*/

    const exp_box = document.querySelectorAll(".curved-circle");

    if (exp_box.length) {
      new CircleType(document.querySelector('.curved-circle'))
        .radius(80)
        .dir(1);
    }

    /*===============
     Section Title
    =================*/

    const section_title1 = document.querySelectorAll(".section-title.style-one .title");

    if(section_title1.length > 0){
        section_title1.forEach(el => {
            const split = SplitText.create(el, { type: "chars,words,lines" });

            gsap.set(split.chars, {
                opacity: 0,
                y: "90%",
                rotateX: "-40deg"
            });

            gsap.to(split.chars, {
                scrollTrigger: {
                    trigger: el,
                    start: "top 80%"
                },
                x: "0",
                y: "0",
                rotateX: "0",
                opacity: 1,
                duration: 1,
                ease: "back.out",
                stagger: 0.02
            });
        });
    }

    // Style Two

    const section_title2 = document.querySelectorAll(".section-title.style-two .title");

    if (section_title2.length > 0) {
        section_title2.forEach(el => {

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
                stagger: 0.25
            });
        });
    }

    /*============
     Hero 1
    ==============*/

    const hero_1 = document.querySelector(".banner-area.style-one");

    if (hero_1) {
        const text = document.querySelector('.curved-circle');
        const chars = text.textContent.split('');
        text.textContent = '';
        
        chars.forEach(char => {
            const span = document.createElement('span');
            span.textContent = char;
            text.appendChild(span);
        });
        
        const spans = document.querySelectorAll('.curved-circle span');
        const angleStep = 360 / spans.length;
        
        gsap.set(spans, {
            rotate: (i) => i * angleStep,
        });
        
        gsap.to('.curved-circle', {
            rotation: 360,
            repeat: -1,
            ease: 'linear',
            duration: 10,
            force3D: true,
        });
    }

    /*============
     Hero 2
    ==============*/

    const hero_2 = document.querySelector(".banner-area.style-two");

    if (hero_2) {

        mm.add("(min-width: 1025px)", () => {

            mm.add("(max-width: 1398px)", () => {

                const videoWrapper = document.querySelector(".video-wrapper");
                
                gsap.set(videoWrapper, {
                  left: 0,
                });

                const mainContainer = document.querySelector(".banner-wrap");

                const containerWidth = mainContainer.offsetWidth;

                const videoWidth = 960;

                const leftSpace = (( containerWidth - videoWidth ) / 2);

                gsap.to(".video-wrapper", {
                    scrollTrigger: {
                        trigger: ".banner-area.style-two .video-wrapper",
                        start: "top-=80 top",
                        end: "bottom top",
                        scrub: true,
                    },
                    height: "731px",
                    width: `${videoWidth}px`,
                    x: `${leftSpace}px`,
                    ease: "none"
                });
            
                // Pin Video

                ScrollTrigger.create({
                  trigger: '.banner-area.style-two .main-video',
                  start: 'top-=80 top',
                  endTrigger: '.banner-area.style-two',
                  end: 'bottom top',
                  pin: true,
                  pinSpacing: false,
                });

            });

            mm.add("(min-width: 1399px)", () => {

                const videoWrapper = document.querySelector(".video-wrapper");
                
                gsap.set(videoWrapper, {
                  left: 0,
                });

                const mainContainer = document.querySelector(".banner-wrap");

                const containerWidth = mainContainer.offsetWidth;

                const videoWidth = 1395;

                const leftSpace = (( containerWidth - videoWidth ) / 2);

                gsap.to(".video-wrapper", {
                    scrollTrigger: {
                        trigger: ".banner-area.style-two .video-wrapper",
                        start: "top-=80 top",
                        end: "bottom top",
                        scrub: true,
                    },
                    height: "731px",
                    width: `${videoWidth}px`,
                    x: `${leftSpace}px`,
                    ease: "none"
                });
            
                // Pin Video

                ScrollTrigger.create({
                  trigger: '.banner-area.style-two .main-video',
                  start: 'top-=80 top',
                  endTrigger: '.banner-area.style-two',
                  end: 'bottom top',
                  pin: true,
                  pinSpacing: false,
                });

            });

        });

        // Split Text

        mm.add("(max-width: 1024px)", () => {
            const text = new SplitType('#split-type-text', { types: 'words, chars' });

            gsap.to(text.words, {
                scrollTrigger: {
                    trigger: ".animated-text",
                    start: "top top",
                    end: "bottom top",
                    scrub: true,
                    pin: true,
                    pinSpacing: true,
                },
                opacity: 1,
                duration: 0.5,
                stagger: { each: 1 }
            });

        });

        mm.add("(min-width: 1025px)", () => {
            const text = new SplitType('#split-type-text', { types: 'words, chars' });

            gsap.to(text.words, {
                scrollTrigger: {
                    trigger: ".animated-text",
                    start: "top-=210 top",
                    end: "bottom top",
                    scrub: true,
                    pin: true,
                    pinSpacing: true,
                },
                opacity: 1,
                duration: 0.5,
                stagger: { each: 1 }
            });

        });

        mm.add("(min-width: 1025px)", () => {
            gsap.fromTo(
              ".banner-area.style-two .animation-area",
              {
                opacity: 0,
              },
              {
                opacity: 1,
                duration: 0.1,
                ease: "power2.out",
                scrollTrigger: {
                  trigger: ".banner-area.style-two .animation-area",
                  start: "top-=250 top",
                  end: "top-=250 top",
                  scrub: false,
                  toggleActions: "play none none reverse",
                },
              }
            );
        });
    }
    
    /*============
     Experience Box
    ==============*/

    const exp_box_1 = document.querySelector(".experience-box.style-one");

    if (exp_box_1) {
        
        gsap.to('.curved-circle', {
            rotation: 360,
            repeat: -1,
            ease: 'linear',
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
            }
        });
        
        tl2.fromTo(".cta-container .content",
            { scale: 0, transformOrigin: "center center" },
            { scale: 1, duration: 1, ease: "power3.out" }
        );
        
        gsap.utils.toArray(".cta-image-box img").forEach(img=>{
            tl2.from(img, {
                top: "50%", 
                left: "50%", 
                x: "-50%", 
                y: "-50%", 
                duration: 0.7, 
                ease: "power2.out"
            }, 0);
        });

    });

    /*===============
     List
    =================*/

    const lists_1 = document.querySelector(".lists.style-1");

    if (lists_1) {
        gsap.from(".lists.style-1 li", {
            duration: 1,
            xPercent: -100,
            opacity: 0,
            scale: 0.8,
            ease: "power1.out",
            stagger: 0.2,
            scrollTrigger: {
                trigger: ".lists.style-1",
                start: "top 80%",
            }
        });
    }

    // Style Two

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
            }
        });
    }

    // Style Three

    const lists_3 = document.querySelector(".lists.style-3");

    if (lists_3) {
        gsap.from(".lists.style-3 li", {
            duration: 0.5,
            yPercent: -100,
            opacity: 0,
            ease: "back.out(5)",
            stagger: 0.2,
            delay: 0.8,
            scrollTrigger: {
                trigger: ".lists.style-3",
                start: "top 80%",
            }
        });
    }

    /*===============
     Feature List 1
    =================*/

    const feature_list_1 = document.querySelector(".features-list.style-one");

    if (feature_list_1) {

        const cards = gsap.utils.toArray(".features-list.style-one .feature-item");

        cards.forEach((card, index) => {
            ScrollTrigger.create({
                trigger: card,
                start: () => `top top+=140`,
                pin: true,
                pinSpacing: false,
                markers: false,
                id: 'pin',
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
                id: 'pin',
                endTrigger: ".features-list.style-one",
                end: () => `bottom-=200 top+=505`,
                invalidateOnRefresh: true,
            });

            const boundary = document.querySelector(".features-list.style-one .feature-left .button-area");

            if (boundary) {
                const button = boundary.querySelector(".features-list.style-one .view-all");

                // Helper: center the button inside boundary
                const centerButton = () => {
                    const bounds = boundary.getBoundingClientRect();
                    const centerX = bounds.width / 2 - button.offsetWidth / 2;
                    const centerY = bounds.height / 2 - button.offsetHeight / 2;
                    gsap.to(button, {
                        x: centerX,
                        y: centerY,
                        duration: 0.6,
                        ease: "power3.out"
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
                    const targetX = (mouseX - bounds.width / 2) * moveFactor + (bounds.width / 2 - button.offsetWidth / 2);
                    const targetY = (mouseY - bounds.height / 2) * moveFactor + (bounds.height / 2 - button.offsetHeight / 2);

                    gsap.to(button, {
                        x: targetX,
                        y: targetY,
                        duration: 0.4,
                        ease: "power3.out",
                        overwrite: true
                    });
                });

                // Return to center when mouse leaves
                boundary.addEventListener("mouseleave", () => {
                    centerButton();
                });
            }

        });

        // Title animation

        const ft = document.querySelector(".features-list.style-one .feature-title");

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
            stagger: 0.25
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

            const targetX1 = (containerWidth / 2) - (item1Width / 2);
            const targetX2 = (containerWidth / 2) - (item2Width / 2);
            const targetX3 = (containerWidth / 2) - (item3Width / 2);
            const targetX4 = (containerWidth / 2) - (item4Width / 2);

            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: feature_list_2,
                    start: 'top-=50 top',
                    end: 'bottom top',
                    scrub: true,
                    pin: true,
                    anticipatePin: 1,
                    invalidateOnRefresh: true,
                }
            });

            tl.to(item1, { x: -targetX1, y: -246, ease: 'none' }, 0)
              .to(item2, { x: targetX2, y: -246, ease: 'none' }, 0)
              .to(item3, { x: -targetX3, y: 261, ease: 'none' }, 0)
              .to(item4, { x: targetX4, y: 261, ease: 'none' }, 0);

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

    const feature_list_3 = document.querySelector(".features-list.style-three");

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

            const targetX1 = (containerWidth / 2) - (item1Width / 2);
            const targetX2 = (containerWidth / 2) - (item2Width / 2);
            const targetX3 = (containerWidth / 2) - (item3Width / 2);
            const targetX4 = (containerWidth / 2) - (item4Width / 2);

            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: feature_list_3,
                    start: 'top-=50 top',
                    end: 'bottom top',
                    scrub: true,
                    pin: true,
                    anticipatePin: 1,
                    invalidateOnRefresh: true,
                }
            });

            tl.to(item1, { x: targetX2, y: -356, ease: 'none' }, 0)
              .to(item3, { x: -targetX3, y: 356, ease: 'none' }, 0)
              .to(item4, { x: targetX4, y: 356, ease: 'none' }, 0);
        });

    }

    /*===============
     Product 
    =================*/

    const product_item2 = document.querySelectorAll(".zupet-product-grid.style-two .product-item");

    if (product_item2.length > 0) {
        product_item2.forEach(widget => {
            const cursor = widget.querySelector(".cursor");

            let mouseX = 0, mouseY = 0;
            let cursorX = 0, cursorY = 0;
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
                    ease: "power2.out"
                });
            });

            // Mouse move
            widget.addEventListener("mousemove", evt => {
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
                            }
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

    gsap.utils.toArray(".team-single.style-one .team-single-image-box").forEach((section) => {
        let tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: "top 80%",
                toggleActions: "play none none none", 
                markers: false
            }
        });

        tl.to(section.querySelector(".overlay-top"), {
            yPercent: -100,
            duration: 1.2,
            ease: "power3.inOut"
        }, 0);

        tl.to(section.querySelector(".overlay-bottom"), {
            yPercent: 100,
            duration: 1.2,
            ease: "power3.inOut"
        }, 0);
    });

    /*===============
     Testimonial 
    =================*/

    const testimonial_3 = document.querySelector(".testimonial.style-three");

    if (testimonial_3) {

        // Set Height

        const wrapper = document.querySelector('.testi-wrapper');
        const items = Array.from(testimonial_3.querySelectorAll(".testimonial-single"));

        let maxHeight = 0;

        items.forEach(item => {
            const height = item.offsetHeight;
            if (height > maxHeight) {
                maxHeight = height;
            }
        });

        wrapper.style.height = `${maxHeight}px`;

        const containerWidth = testimonial_3.offsetWidth;

        mm.add("(max-width: 767px)", () => {
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: testimonial_3,
                    start: 'top-=80 top',
                    end: 'bottom top',
                    scrub: true,
                    pin: true,
                    anticipatePin: 1,
                    invalidateOnRefresh: true,
                }
            });
        
            const itemsToAnimate = items.slice(1).reverse();

            itemsToAnimate.forEach((item, index) => {
                
                const direction = index % 2 === 0 ? 1 : -1;

                tl.to(item, {
                    xPercent: 100 * direction,
                    yPercent: -100,
                    duration: 1,
                    ease: "none",
                });
            });

        });

        mm.add("(min-width: 768px)", () => {
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: testimonial_3,
                    start: 'top-=250 top',
                    end: 'bottom top',
                    scrub: true,
                    pin: true,
                    anticipatePin: 1,
                    invalidateOnRefresh: true,
                }
            });
        
            const itemsToAnimate = items.slice(1).reverse();

            itemsToAnimate.forEach((item, index) => {
                
                const direction = index % 2 === 0 ? 1 : -1;

                tl.to(item, {
                    xPercent: 100 * direction,
                    yPercent: -100,
                    duration: 1,
                    ease: "none",
                });
            });

        });
        
    }

    // Style Four

    const testimonial_4 = document.querySelector(".testimonial.style-four");

    if (testimonial_4) {

        const testi_center = document.querySelector(".testimonial.style-four .testi-center");
        const item1 = document.querySelector(".single-testimonial.item-1");
        const item2 = document.querySelector(".single-testimonial.item-2");
        const item3 = document.querySelector(".single-testimonial.item-3");

        mm.add("(min-width: 1200px)", () => {

            const containerWidth = testimonial_4.offsetWidth;

            const item1Width = item1.offsetWidth;
            const item2Width = item2.offsetWidth;
            const item3Width = item3.offsetWidth;

            const targetX1 = (containerWidth / 2) - (item1Width / 2);
            const targetX2 = (containerWidth / 2) - (item2Width / 2);
            const targetX3 = (containerWidth / 2) - (item3Width / 2);

            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: '.testimonial.style-four',
                    start: 'top-=50 top',
                    end: 'bottom top',
                    scrub: true,
                    pin: true,
                    anticipatePin: 1,
                    invalidateOnRefresh: true,
                }
            });

            tl.to(item1, { x: -targetX1, ease: 'none' }, 0)
              .to(item2, { x: targetX2, ease: 'none' }, 0)
              .to(item3, { x: 0, y: 500, ease: 'none' }, 0)
              .fromTo(testi_center,
                { x: 0, scale: 0 },
                { x: 0, y: 64, scale: 1, ease: 'power2.out', transformOrigin: 'top center', },
                0
              );

        });

    }

    /*===============
     Blog 
    =================*/

    const blog_1 = document.querySelector(".blog-posts-1");

    if (blog_1) {
        mm.add("(min-width: 992px)", () => {
            gsap.from(".blog-posts-1 .col-lg-4:nth-child(2)", {
                duration: 1,
                y: -500,
                opacity: 0,
                ease: "bounce.out",
                scrollTrigger: {
                    trigger: ".blog-posts-1",
                    start: "top 80%",
                }
            });
        });
    }

  }, false);

});
