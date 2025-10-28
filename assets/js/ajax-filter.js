
jQuery(function($) {

    const priceSlider = document.getElementById('price-slider');

    if (priceSlider) {
        noUiSlider.create(priceSlider, {
            start: [0, 1000],
            connect: true,
            step: 10,
            range: {
                'min': 0,
                'max': 1000
            },
            format: {
                to: value => Math.round(value),
                from: value => parseInt(value)
            }
        });

        priceSlider.noUiSlider.on('update', function(values) {
            $('#min_price').val(values[0]);
            $('#max_price').val(values[1]);
            $('#price-min-label').text('$' + values[0]);
            $('#price-max-label').text('$' + values[1]);
        });

        // Trigger filter on slide stop
        priceSlider.noUiSlider.on('change', function() {
            $('#tour-filter-form input').trigger('change');
        });
    }

    $('#tour-filter-form input').on('change', function() {
        let data = $('#tour-filter-form').serialize();
        $.ajax({
            url: ajaxfilter.ajax_url,
            data: data + '&action=filter_tours',
            type: 'POST',
            success: function(response) {
                $('#tour-results').html(response);
            }
        });
    });
});