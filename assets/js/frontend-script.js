document.addEventListener('DOMContentLoaded', function () {
    /**
     * Star Rating
     */
    const stars = document.querySelectorAll('.star-rating .star');
    const ratingInput = document.getElementById('rating-value');

    if (stars.length > 0 && ratingInput) {
        stars.forEach(star => {
            star.addEventListener('mouseenter', function () {
                highlightStars(parseInt(this.dataset.value));
            });

            star.addEventListener('mouseleave', function () {
                highlightStars(parseInt(ratingInput.value) || 0);
            });

            star.addEventListener('click', function () {
                const rating = parseInt(this.dataset.value);
                ratingInput.value = rating;
                highlightStars(rating);
            });
        });

        function highlightStars(rating) {
            stars.forEach(star => {
                star.classList.remove('selected');
                if (parseInt(star.dataset.value) <= rating) {
                    star.classList.add('selected');
                }
            });
        }
    }

    /**
     * Flatpickr
     */
    if (document.querySelector('.datepicker') || document.querySelector('.dob-datepicker')) {
        if (typeof flatpickr !== 'undefined') {
            flatpickr('.datepicker', {
                minDate: 'today',
                dateFormat: 'Y-m-d'
            });
            flatpickr('.dob-datepicker', {
                maxDate: 'today',
                dateFormat: 'Y-m-d'
            });

        } else {
            console.warn('flatpickr is not loaded.');
        }
    }

    /**
     * Tour details mini form dropdown
     */
    const wrapper = document.querySelector('.traveler-dropdown-wrapper');
    if (wrapper) {
        const display = document.getElementById('num_travelers_display');
        const dropdown = wrapper.querySelector('.traveler-dropdown');

        const inputs = {
            adults: document.getElementById('adults'),
            children: document.getElementById('children'),
            infants: document.getElementById('infants')
        };

        display.addEventListener('click', () => {
            dropdown.classList.toggle('show');
        });

        dropdown.addEventListener('click', function (e) {
            const btn = e.target;
            const target = btn.dataset.target;
            if (!target || !inputs[target]) return;

            let value = parseInt(inputs[target].value);
            if (btn.classList.contains('plus')) {
                inputs[target].value = value + 1;
            } else if (btn.classList.contains('minus')) {
                if (value > 0) inputs[target].value = value - 1;
            }

            updateDisplay();
        });

        function updateDisplay() {
            const a = parseInt(inputs.adults.value);
            const c = parseInt(inputs.children.value);
            const i = parseInt(inputs.infants.value);

            const parts = [
                `${a} Adult${a !== 1 ? 's' : ''}`,
                `${c} Children`,
                `${i} Infant${i !== 1 ? 's' : ''}`
            ];

            display.value = parts.join(', ');
        }

        document.addEventListener('click', function (e) {
            if (!wrapper.contains(e.target)) {
                dropdown.classList.remove('show');
            }
        });

        // Initialize display on page load
        updateDisplay();
    }
});
