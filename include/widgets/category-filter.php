<?php

class WC_Category_Filter_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'wc_category_filter',
            'Woo Category Filter',
            ['description' => 'Filter products by category']
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'] . 'Categories' . $args['after_title'];

        $categories = get_terms([
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
        ]);

        echo '<ul>';
        foreach ($categories as $cat) {
            echo '<li><label>
                <input type="checkbox" class="filter-category" value="'. esc_attr($cat->term_id) .'"> 
                '. esc_html($cat->name) .'
            </label></li>';
        }
        echo '</ul>';
        echo $args['after_widget'];
    }
}

add_action('widgets_init', function() {
    register_widget('WC_Category_Filter_Widget');
});
