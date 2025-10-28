jQuery(document).ready(function ($) {

    /**
     * Tour Search Suggestion
     */

    const input = $('#tour-search-input');
    const suggestionBox = $('#tour-suggestions');

    input.on('keyup', function () {
        const keyword = $(this).val();

        if (keyword.length < 2) {
            suggestionBox.fadeOut();
            return;
        }

        $.ajax({
            url: PublicAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'search_tours_and_destinations',
                keyword: keyword,
                nonce: PublicAjax.nonce
            },
            success: function (res) {
                if (res.success && res.data.length) {
                    let suggestions = res.data.map(item => `
                        <div class="suggestion-item" data-title="${item.title}">
                            <div class="suggestion-thumb">
                                ${item.thumbnail
                                    ? `<img src="${item.thumbnail}" alt="${item.title}" />`
                                    : `<i class="fa-light fa-location-arrow fallback-icon"></i>`}
                            </div>
                            <div class="suggestion-title">${item.title}</div>
                        </div>
                    `).join('');

                    suggestionBox.html(suggestions).fadeIn();
                } else {
                    suggestionBox.fadeOut();
                }
            }
        });
    });

    $(document).on('click', '.suggestion-item', function () {
        input.val($(this).data('title'));
        suggestionBox.fadeOut();
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#tour-search-input, #tour-suggestions').length) {
            suggestionBox.fadeOut();
        }
    });

    /**
     * Tour Search Count
     */

    $('.count-counter').click(function(event) {
        event.stopPropagation(); // Prevent the click event from propagating to the document
        $('.count-container').slideToggle(500);
    });
    
    $(document).click(function(event) {
        if (!$(event.target).closest('.count-counter').length && !$(event.target).closest('.count-container').length) {
            $('.count-container').slideUp(500);
        }
    });

    function setupCountSection(countSelector, incrementSelector, decrementSelector) {
        let count = 0;

        function updateCount() {
            $(countSelector).text(count);
        }

        $(incrementSelector).on('click', function() {
            count++;
            updateCount();
        });

        $(decrementSelector).on('click', function() {
            if (count > 0) {
                count--;
                updateCount();
            }
        });
    }

    // Setup count functionality for adults
    setupCountSection('.adult', '.increment', '.decrement');

    // Setup count functionality for children
    setupCountSection('.childeren', '.incrementTwo', '.decrementTwo');

    // Setup count functionality for room
    setupCountSection('.infants', '.incrementThree', '.decrementThree');

    /**
     * Update tour details mini form
     */

    function syncCountersToInputs() {
        $('#search_adults').val($('.count-counter-inner .adult').text());
        $('#search_children').val($('.count-counter-inner .childeren').text());
        $('#search_infants').val($('.count-counter-inner .infants').text());
    }

    $('.increment, .decrement, .incrementTwo, .decrementTwo, .incrementThree, .decrementThree').on('click', function () {
        setTimeout(syncCountersToInputs, 100); // wait for UI update
    });
    syncCountersToInputs();

});
