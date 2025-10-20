
jQuery(function($) {

    function runFilters(page = 1) {
        let data = {
            action: 'filter_products',
            categories: [],
            min_price: $('#min_price').val(),
            max_price: $('#max_price').val(),
            rating: $('select[name="rating"]').val(),
            paged: page
        };

        $('.filter-category:checked').each(function(){ data.categories.push($(this).val()); });

        $.ajax({
            url: woocommerce_params.ajax_url,
            data: data,
            type: 'POST',
            beforeSend: function() {
                $('#product-results').addClass('loading').html('<p>Loading...</p>');
            },
            success: function(response) {
                $('#product-results').html(response).removeClass('loading');
            }
        });
    }

    // Auto-run on filter changes
    $(document).on('change', '#product-filters input, #product-filters select', function() {
        runFilters();
    });

    // Price slider
    function initPriceSlider(){
        let $slider = $("#price-slider");
        if(!$slider.length) return;

        let min = parseInt($slider.closest('.price-slider-container').data('min'));
        let max = parseInt($slider.closest('.price-slider-container').data('max'));

        $slider.slider({
            range: true,
            min: min,
            max: max,
            values: [min, max],
            slide: function(event, ui){
                $("#min_price").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);
            },
            change: function(){
                runFilters(1);
            }
        });

        $("#min_price").val(min);
        $("#max_price").val(max);
    }

    initPriceSlider();

    // Pagination clicks
    $(document).on('click', '.ajax-pagination a', function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        runFilters(page);
    });

});