/*-----------------
 Testimonial Video
-------------------*/

document.addEventListener('click', function (e) {
	const btn = e.target.closest('.video-toggle-btn');
	if (!btn) return;

	const wrapper = btn.closest('.video');
	const video = wrapper.querySelector('.custom-video');

	if (video.paused) {
		video.play();
		wrapper.classList.add('is-playing');
	} else {
		video.pause();
		wrapper.classList.remove('is-playing');
	}
});

/*--------------
 Pricing Card
----------------*/

const pricingCards = document.querySelectorAll('.pricing-card');

if (pricingCards.length) {

    const defaultActive = document.querySelector('.pricing-card.is-active');

    pricingCards.forEach(card => {

        card.addEventListener('mouseenter', function () {
            pricingCards.forEach(item => item.classList.remove('is-active'));
            card.classList.add('is-active');
        });

        card.addEventListener('mouseleave', function () {
            if (defaultActive) {
                pricingCards.forEach(item => item.classList.remove('is-active'));
                defaultActive.classList.add('is-active');
            }
        });

    });
}

/*--------------
 Pricing Tab
----------------*/

const pricingTab = document.querySelector(".pricing-wrapper");

if(pricingTab){
	const btnWrap = document.querySelector('.btn-wrap');
	const btnBg   = btnWrap.querySelector('.active-bg');
	const buttons = btnWrap.querySelectorAll('button');

	function moveBg(btn) {
		const wrapRect = btnWrap.getBoundingClientRect();
		const btnRect  = btn.getBoundingClientRect();

		btnBg.style.width = `${btnRect.width}px`;
		btnBg.style.transform = `translateX(${btnRect.left - wrapRect.left}px)`;
	}

	document.querySelectorAll('.pricing-toggle button').forEach( (btn, index) => {
		btn.addEventListener('click', function () {
			const wrapper = this.closest('.pricing-wrapper');
			wrapper.classList.toggle('yearly', this.dataset.type === 'yearly');

			wrapper.querySelectorAll('.pricing-toggle button')
				.forEach(b => b.classList.remove('is-active'));

			this.classList.add('is-active');

			moveBg(btn);
		});
	});

	const activeBtn = btnWrap.querySelector('.is-active') || buttons[0];
	moveBg(activeBtn);
}

/*------------------
 Sticky Toggle Menu
--------------------*/

const toggleBtn = document.querySelector('.sticky-sidebar-toggle .sidebar-toggle');

if (toggleBtn) {
    window.addEventListener('scroll', function () {
    
        if (window.scrollY > 500) {
            toggleBtn.classList.add('show-toggle');
        } else {
            toggleBtn.classList.remove('show-toggle');
        }
    
    });
}

/*------------
 Offcanvas
----------------*/

const offcanvas_backdrop = document.querySelector(".nd-offcanvas-backdrop");

function openCanvas(el) {
    el.classList.add("is-active");
    offcanvas_backdrop.classList.add("is-active");
    document.body.classList.add("nd-offcanvas-open");
}

function closeCanvas(el) {
    el.classList.remove("is-active");
    offcanvas_backdrop.classList.remove("is-active");
    document.body.classList.remove("nd-offcanvas-open");
}

// Open
document.addEventListener("click", function (e) {
    const toggle = e.target.closest(".nd-offcanvas-toggle");
    if (toggle) {
        e.preventDefault();
        const target = toggle.getAttribute("data-target");
        if (target) {
            const targetEl = document.querySelector(target);
            if (targetEl) openCanvas(targetEl);
        }
    }
});

// Close button
document.addEventListener("click", function (e) {
    const closeBtn = e.target.closest(".nd-offcanvas-close");
    if (closeBtn) {
        const offcanvas = closeBtn.closest(".header-offcanvas");
        if (offcanvas) closeCanvas(offcanvas);
    }
});

// Backdrop close
if (offcanvas_backdrop) {
    offcanvas_backdrop.addEventListener("click", function () {
        document.querySelectorAll(".header-offcanvas.is-active")
            .forEach(function (el) {
                closeCanvas(el);
            });
    });
}

// ESC key
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
        document.querySelectorAll(".header-offcanvas.is-active")
            .forEach(function (el) {
                closeCanvas(el);
            });
    }
});