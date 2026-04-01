<?php

// Register Custom Post Type.
function provix_post_type() {

	$portfolio_labels = array(
		'name'                  => _x( 'Portfolios', 'Post Type General Name', 'agenvix-core' ),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'agenvix-core' ),
		'menu_name'             => __( 'Portfolios', 'agenvix-core' ),
		'name_admin_bar'        => __( 'Portfolio', 'agenvix-core' ),
		'archives'              => __( 'Item Archives', 'agenvix-core' ),
		'attributes'            => __( 'Item Attributes', 'agenvix-core' ),
		'parent_item_colon'     => __( 'Parent Item:', 'agenvix-core' ),
		'all_items'             => __( 'All Items', 'agenvix-core' ),
		'add_new_item'          => __( 'Add New Item', 'agenvix-core' ),
		'add_new'               => __( 'Add New', 'agenvix-core' ),
		'new_item'              => __( 'New Item', 'agenvix-core' ),
		'edit_item'             => __( 'Edit Item', 'agenvix-core' ),
		'update_item'           => __( 'Update Item', 'agenvix-core' ),
		'view_item'             => __( 'View Item', 'agenvix-core' ),
		'view_items'            => __( 'View Items', 'agenvix-core' ),
		'search_items'          => __( 'Search Item', 'agenvix-core' ),
		'not_found'             => __( 'Not found', 'agenvix-core' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'agenvix-core' ),
		'featured_image'        => __( 'Featured Image', 'agenvix-core' ),
		'set_featured_image'    => __( 'Set featured image', 'agenvix-core' ),
		'remove_featured_image' => __( 'Remove featured image', 'agenvix-core' ),
		'use_featured_image'    => __( 'Use as featured image', 'agenvix-core' ),
		'insert_into_item'      => __( 'Insert into item', 'agenvix-core' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'agenvix-core' ),
		'items_list'            => __( 'Items list', 'agenvix-core' ),
		'items_list_navigation' => __( 'Items list navigation', 'agenvix-core' ),
		'filter_items_list'     => __( 'Filter items list', 'agenvix-core' ),
	);
	$portfolio_args = array(
		'label'                 => __( 'Portfolio', 'agenvix-core' ),
		'description'           => __( 'Portfolio Description', 'agenvix-core' ),
		'labels'                => $portfolio_labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'			=> array('post_tag'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_rest'          => true,
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
	register_post_type( 'portfolio', $portfolio_args );

	// Header.

	$header_labels = array(
		'name'                  => _x( 'Headers', 'Post Type General Name', 'agenvix-core' ),
		'singular_name'         => _x( 'Header', 'Post Type Singular Name', 'agenvix-core' ),
		'menu_name'             => __( 'Headers', 'agenvix-core' ),
		'name_admin_bar'        => __( 'Header', 'agenvix-core' ),
		'archives'              => __( 'Item Archives', 'agenvix-core' ),
		'attributes'            => __( 'Header Attributes', 'agenvix-core' ),
		'parent_item_colon'     => __( 'Parent Item:', 'agenvix-core' ),
		'all_items'             => __( 'All Headers', 'agenvix-core' ),
		'add_new_item'          => __( 'Add Header', 'agenvix-core' ),
		'add_new'               => __( 'Add New', 'agenvix-core' ),
		'new_item'              => __( 'New Item', 'agenvix-core' ),
		'edit_item'             => __( 'Edit Item', 'agenvix-core' ),
		'update_item'           => __( 'Update Item', 'agenvix-core' ),
		'view_item'             => __( 'View Item', 'agenvix-core' ),
		'view_items'            => __( 'View Items', 'agenvix-core' ),
		'search_items'          => __( 'Search Item', 'agenvix-core' ),
		'not_found'             => __( 'Not found', 'agenvix-core' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'agenvix-core' ),
		'featured_image'        => __( 'Featured Image', 'agenvix-core' ),
		'set_featured_image'    => __( 'Set featured image', 'agenvix-core' ),
		'remove_featured_image' => __( 'Remove featured image', 'agenvix-core' ),
		'use_featured_image'    => __( 'Use as featured image', 'agenvix-core' ),
		'insert_into_item'      => __( 'Insert into item', 'agenvix-core' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'agenvix-core' ),
		'items_list'            => __( 'Items list', 'agenvix-core' ),
		'items_list_navigation' => __( 'Items list navigation', 'agenvix-core' ),
		'filter_items_list'     => __( 'Filter items list', 'agenvix-core' ),
	);
	$header_args   = array(
		'label'               => __( 'Header', 'agenvix-core' ),
		'description'         => __( 'Post Type Description', 'agenvix-core' ),
		'labels'              => $header_labels,
		'supports'            => array( 'title', 'elementor' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-table-row-after',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'site_header', $header_args );

	// Footer.

	$footer_labels = array(
		'name'                  => _x( 'Footers', 'Post Type General Name', 'agenvix-core' ),
		'singular_name'         => _x( 'Footer', 'Post Type Singular Name', 'agenvix-core' ),
		'menu_name'             => __( 'Footers', 'agenvix-core' ),
		'name_admin_bar'        => __( 'Footer', 'agenvix-core' ),
		'archives'              => __( 'Item Archives', 'agenvix-core' ),
		'attributes'            => __( 'Footer Attributes', 'agenvix-core' ),
		'parent_item_colon'     => __( 'Parent Item:', 'agenvix-core' ),
		'all_items'             => __( 'All Footers', 'agenvix-core' ),
		'add_new_item'          => __( 'Add Footer', 'agenvix-core' ),
		'add_new'               => __( 'Add New', 'agenvix-core' ),
		'new_item'              => __( 'New Item', 'agenvix-core' ),
		'edit_item'             => __( 'Edit Item', 'agenvix-core' ),
		'update_item'           => __( 'Update Item', 'agenvix-core' ),
		'view_item'             => __( 'View Item', 'agenvix-core' ),
		'view_items'            => __( 'View Items', 'agenvix-core' ),
		'search_items'          => __( 'Search Item', 'agenvix-core' ),
		'not_found'             => __( 'Not found', 'agenvix-core' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'agenvix-core' ),
		'featured_image'        => __( 'Featured Image', 'agenvix-core' ),
		'set_featured_image'    => __( 'Set featured image', 'agenvix-core' ),
		'remove_featured_image' => __( 'Remove featured image', 'agenvix-core' ),
		'use_featured_image'    => __( 'Use as featured image', 'agenvix-core' ),
		'insert_into_item'      => __( 'Insert into item', 'agenvix-core' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'agenvix-core' ),
		'items_list'            => __( 'Items list', 'agenvix-core' ),
		'items_list_navigation' => __( 'Items list navigation', 'agenvix-core' ),
		'filter_items_list'     => __( 'Filter items list', 'agenvix-core' ),
	);
	$footer_args   = array(
		'label'               => __( 'Footer', 'agenvix-core' ),
		'description'         => __( 'Post Type Description', 'agenvix-core' ),
		'labels'              => $footer_labels,
		'supports'            => array( 'title', 'elementor' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-table-row-before',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'site_footer', $footer_args );
}
add_action( 'init', 'provix_post_type' );

/*
 * Custom Taxonomy
*/

function provix_taxonomy() {

	$portfolio_cat_labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'agenvix-core' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'agenvix-core' ),
		'menu_name'                  => __( 'Category', 'agenvix-core' ),
		'all_items'                  => __( 'All Items', 'agenvix-core' ),
		'parent_item'                => __( 'Parent Item', 'agenvix-core' ),
		'parent_item_colon'          => __( 'Parent Item:', 'agenvix-core' ),
		'new_item_name'              => __( 'New Item Name', 'agenvix-core' ),
		'add_new_item'               => __( 'Add New Item', 'agenvix-core' ),
		'edit_item'                  => __( 'Edit Item', 'agenvix-core' ),
		'update_item'                => __( 'Update Item', 'agenvix-core' ),
		'view_item'                  => __( 'View Item', 'agenvix-core' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'agenvix-core' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'agenvix-core' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'agenvix-core' ),
		'popular_items'              => __( 'Popular Items', 'agenvix-core' ),
		'search_items'               => __( 'Search Items', 'agenvix-core' ),
		'not_found'                  => __( 'Not Found', 'agenvix-core' ),
		'no_terms'                   => __( 'No items', 'agenvix-core' ),
		'items_list'                 => __( 'Items list', 'agenvix-core' ),
		'items_list_navigation'      => __( 'Items list navigation', 'agenvix-core' ),
	);
	$portfolio_cat_args = array(
		'labels'                     => $portfolio_cat_labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'portfolio_cat', array( 'portfolio' ), $portfolio_cat_args );

}
add_action( 'init', 'provix_taxonomy', 0 );