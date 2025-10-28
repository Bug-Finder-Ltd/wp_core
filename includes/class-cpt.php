<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Nextdestina_CPT {

    public function __construct() {
        $this->register_post_type();
    }

    /**
     * Register "Tour" custom post type
     */
    public function register_post_type() {
        $labels = array(
            'name'                  => _x( 'Packages', 'Post Type General Name', 'nextdestina-booking' ),
            'singular_name'         => _x( 'Package', 'Post Type Singular Name', 'nextdestina-booking' ),
            'menu_name'             => __( 'Manage Package', 'nextdestina-booking' ),
            'name_admin_bar'        => __( 'Package', 'nextdestina-booking' ),
            'archives'              => __( 'Item Archives', 'nextdestina-booking' ),
            'attributes'            => __( 'Item Attributes', 'nextdestina-booking' ),
            'parent_item_colon'     => __( 'Parent Item:', 'nextdestina-booking' ),
            'all_items'             => __( 'All Packages', 'nextdestina-booking' ),
            'add_new_item'          => __( 'Add Package', 'nextdestina-booking' ),
            'add_new'               => __( 'Add New', 'nextdestina-booking' ),
            'new_item'              => __( 'New Item', 'nextdestina-booking' ),
            'edit_item'             => __( 'Edit Item', 'nextdestina-booking' ),
            'update_item'           => __( 'Update Item', 'nextdestina-booking' ),
            'view_item'             => __( 'View Item', 'nextdestina-booking' ),
            'view_items'            => __( 'View Items', 'nextdestina-booking' ),
            'search_items'          => __( 'Search Item', 'nextdestina-booking' ),
            'not_found'             => __( 'Not found', 'nextdestina-booking' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'nextdestina-booking' ),
            'featured_image'        => __( 'Featured Image', 'nextdestina-booking' ),
            'set_featured_image'    => __( 'Set featured image', 'nextdestina-booking' ),
            'remove_featured_image' => __( 'Remove featured image', 'nextdestina-booking' ),
            'use_featured_image'    => __( 'Use as featured image', 'nextdestina-booking' ),
            'insert_into_item'      => __( 'Insert into item', 'nextdestina-booking' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'nextdestina-booking' ),
            'items_list'            => __( 'Items list', 'nextdestina-booking' ),
            'items_list_navigation' => __( 'Items list navigation', 'nextdestina-booking' ),
            'filter_items_list'     => __( 'Filter items list', 'nextdestina-booking' ),
        );
        $args = array(
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            //'rewrite' => ['slug' => 'tours'],
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'menu_icon'             => 'dashicons-airplane',
        );
        register_post_type( 'tour', $args );

        // Invoice Post Type
        
        register_post_type('invoice', [
            'labels' => [
                'name' => __('Invoices', 'nextdestina-booking'),
                'singular_name' => __('Invoice', 'nextdestina-booking')
            ],
            'public' => false,
            'show_ui' => true,
            'show_in_menu'     => false,
            'supports' => ['title', 'custom-fields'],
            'can_export'         => false,
            'capability_type' => 'post',
            'menu_icon' => 'dashicons-media-document',
        ]);

        // Register Custom Taxonomy

        $destination_labels = array(
            'name'                       => _x( 'Destinations', 'Taxonomy General Name', 'nextdestinacore' ),
            'singular_name'              => _x( 'Destination', 'Taxonomy Singular Name', 'nextdestinacore' ),
            'menu_name'                  => __( 'Destination', 'nextdestinacore' ),
            'all_items'                  => __( 'All Destinations', 'nextdestinacore' ),
            'parent_item'                => __( 'Parent Item', 'nextdestinacore' ),
            'parent_item_colon'          => __( 'Parent Item:', 'nextdestinacore' ),
            'new_item_name'              => __( 'New Item Name', 'nextdestinacore' ),
            'add_new_item'               => __( 'Add New Item', 'nextdestinacore' ),
            'edit_item'                  => __( 'Edit Item', 'nextdestinacore' ),
            'update_item'                => __( 'Update Item', 'nextdestinacore' ),
            'view_item'                  => __( 'View Item', 'nextdestinacore' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'nextdestinacore' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'nextdestinacore' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'nextdestinacore' ),
            'popular_items'              => __( 'Popular Items', 'nextdestinacore' ),
            'search_items'               => __( 'Search Items', 'nextdestinacore' ),
            'not_found'                  => __( 'Not Found', 'nextdestinacore' ),
            'no_terms'                   => __( 'No items', 'nextdestinacore' ),
            'items_list'                 => __( 'Items list', 'nextdestinacore' ),
            'items_list_navigation'      => __( 'Items list navigation', 'nextdestinacore' ),
        );
        $destination_args = array(
            'labels'                     => $destination_labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'destination', array( 'tour' ), $destination_args );

    }
}
