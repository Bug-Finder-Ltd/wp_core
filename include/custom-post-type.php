<?php

// Register Custom Post Type
function raizen_post_type() {

	$labels = array(
		'name'                  => _x( 'Portfolios', 'Post Type General Name', 'raizencore' ),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'raizencore' ),
		'menu_name'             => __( 'Portfolios', 'raizencore' ),
		'name_admin_bar'        => __( 'Portfolio', 'raizencore' ),
		'archives'              => __( 'Item Archives', 'raizencore' ),
		'attributes'            => __( 'Item Attributes', 'raizencore' ),
		'parent_item_colon'     => __( 'Parent Item:', 'raizencore' ),
		'all_items'             => __( 'All Items', 'raizencore' ),
		'add_new_item'          => __( 'Add New Item', 'raizencore' ),
		'add_new'               => __( 'Add New', 'raizencore' ),
		'new_item'              => __( 'New Item', 'raizencore' ),
		'edit_item'             => __( 'Edit Item', 'raizencore' ),
		'update_item'           => __( 'Update Item', 'raizencore' ),
		'view_item'             => __( 'View Item', 'raizencore' ),
		'view_items'            => __( 'View Items', 'raizencore' ),
		'search_items'          => __( 'Search Item', 'raizencore' ),
		'not_found'             => __( 'Not found', 'raizencore' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'raizencore' ),
		'featured_image'        => __( 'Featured Image', 'raizencore' ),
		'set_featured_image'    => __( 'Set featured image', 'raizencore' ),
		'remove_featured_image' => __( 'Remove featured image', 'raizencore' ),
		'use_featured_image'    => __( 'Use as featured image', 'raizencore' ),
		'insert_into_item'      => __( 'Insert into item', 'raizencore' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'raizencore' ),
		'items_list'            => __( 'Items list', 'raizencore' ),
		'items_list_navigation' => __( 'Items list navigation', 'raizencore' ),
		'filter_items_list'     => __( 'Filter items list', 'raizencore' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio', 'raizencore' ),
		'description'           => __( 'Portfolio Description', 'raizencore' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'			=> array('post_tag'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-portfolio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'portfolio', $args );

	// Footer

	$footer_labels = array(
		'name'                  => _x( 'Footers', 'Post Type General Name', 'raizencore' ),
		'singular_name'         => _x( 'Footer', 'Post Type Singular Name', 'raizencore' ),
		'menu_name'             => __( 'Footers', 'raizencore' ),
		'name_admin_bar'        => __( 'Footer', 'raizencore' ),
		'archives'              => __( 'Item Archives', 'raizencore' ),
		'attributes'            => __( 'Item Attributes', 'raizencore' ),
		'parent_item_colon'     => __( 'Parent Item:', 'raizencore' ),
		'all_items'             => __( 'All Items', 'raizencore' ),
		'add_new_item'          => __( 'Add New Item', 'raizencore' ),
		'add_new'               => __( 'Add New', 'raizencore' ),
		'new_item'              => __( 'New Item', 'raizencore' ),
		'edit_item'             => __( 'Edit Item', 'raizencore' ),
		'update_item'           => __( 'Update Item', 'raizencore' ),
		'view_item'             => __( 'View Item', 'raizencore' ),
		'view_items'            => __( 'View Items', 'raizencore' ),
		'search_items'          => __( 'Search Item', 'raizencore' ),
		'not_found'             => __( 'Not found', 'raizencore' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'raizencore' ),
		'featured_image'        => __( 'Featured Image', 'raizencore' ),
		'set_featured_image'    => __( 'Set featured image', 'raizencore' ),
		'remove_featured_image' => __( 'Remove featured image', 'raizencore' ),
		'use_featured_image'    => __( 'Use as featured image', 'raizencore' ),
		'insert_into_item'      => __( 'Insert into item', 'raizencore' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'raizencore' ),
		'items_list'            => __( 'Items list', 'raizencore' ),
		'items_list_navigation' => __( 'Items list navigation', 'raizencore' ),
		'filter_items_list'     => __( 'Filter items list', 'raizencore' ),
	);
	$footer_args = array(
		'label'                 => __( 'Footer', 'raizencore' ),
		'description'           => __( 'Post Type Description', 'raizencore' ),
		'labels'                => $footer_labels,
		'supports'              => array( 'title', 'elementor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-table-row-before',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'site_footer', $footer_args );

}
add_action( 'init', 'raizen_post_type', 0 );

// Register Custom Taxonomy
function raizen_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'raizencore' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'raizencore' ),
		'menu_name'                  => __( 'Category', 'raizencore' ),
		'all_items'                  => __( 'All Items', 'raizencore' ),
		'parent_item'                => __( 'Parent Item', 'raizencore' ),
		'parent_item_colon'          => __( 'Parent Item:', 'raizencore' ),
		'new_item_name'              => __( 'New Item Name', 'raizencore' ),
		'add_new_item'               => __( 'Add New Item', 'raizencore' ),
		'edit_item'                  => __( 'Edit Item', 'raizencore' ),
		'update_item'                => __( 'Update Item', 'raizencore' ),
		'view_item'                  => __( 'View Item', 'raizencore' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'raizencore' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'raizencore' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'raizencore' ),
		'popular_items'              => __( 'Popular Items', 'raizencore' ),
		'search_items'               => __( 'Search Items', 'raizencore' ),
		'not_found'                  => __( 'Not Found', 'raizencore' ),
		'no_terms'                   => __( 'No items', 'raizencore' ),
		'items_list'                 => __( 'Items list', 'raizencore' ),
		'items_list_navigation'      => __( 'Items list navigation', 'raizencore' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'portfolio_cat', array( 'portfolio' ), $args );

}
add_action( 'init', 'raizen_taxonomy', 0 );
























// Register Custom Post Type
function custom_post_type() {



}
add_action( 'init', 'custom_post_type', 0 );