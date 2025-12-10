<?php

class WC_Price_Filter_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'wc_price_filter',
            'Woo Price Filter',
            ['description' => 'Filter products by price']
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'] . 'Price' . $args['after_title'];

        $range = wc_get_min_max_price();
        $min_price = $range['min'];
        $max_price = $range['max'];

        ?>
        <div class="price-slider-container" 
             data-min="<?php echo esc_attr($min_price); ?>" 
             data-max="<?php echo esc_attr($max_price); ?>">
            <div id="price-slider"></div>
            <div class="price-range">
            	<div class="min-price">
            		<label for="min_price"><?php esc_html_e('Min Price', 'raizencore'); ?></label>
                	<input type="text" id="min_price" readonly>
                </div>
                <div class="max-price">
                	<label for="max_price"><?php esc_html_e('Min Price', 'raizencore'); ?></label>
                	<input type="text" id="max_price" readonly>
                </div>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }
}

add_action('widgets_init', function() {
    register_widget('WC_Price_Filter_Widget');
});