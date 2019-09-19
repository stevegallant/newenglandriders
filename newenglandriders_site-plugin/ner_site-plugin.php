<?php
/*
Plugin Name: NER Custom Plugin for newenglandriders.org
Description: Custom site-specific code for newenglandriders.org
Version: 1.0
Author: S. Gallant
*/

// Custom functions to allow Pages and Attachments to use the default Categories and Tags taxonomies
function support_category_for_pages() {
    // Add category support to pages
    register_taxonomy_for_object_type('category', 'page');
}
function support_tag_for_pages() {
    // Add tag support to pages
    register_taxonomy_for_object_type('post_tag', 'page');
}
function support_category_for_attachments() {
  // Add category support for Attachment post type
  register_taxonomy_for_object_type('category', 'attachment');
}
// hook into init action for above functions
add_action( 'init', 'support_category_for_pages' );
add_action( 'init', 'support_tag_for_pages' );
add_action('init', 'support_category_for_attachments');

//ensure all Tags and Categories from all post types are included in queries
function tags_categories_support_query($wp_query) {
  if ($wp_query->get('tag') || ($wp_query->get('category_name'))) $wp_query->set('post_type', 'any');
}
add_action('pre_get_posts', 'tags_categories_support_query');



/******** CUSTOM TAXONOMIES *******/
// hook into the init action and call custom taxonomies when it fires
add_action('init', 'create_routescale_hierarchical_taxonomy', 0);
add_action('init', 'create_locale_hierarchical_taxonomy', 0);
add_action('init', 'create_routefeatures_taxonomy', 0);

// Create a custom taxonomy named 'Route Sizes'
function create_routescale_hierarchical_taxonomy() {
  // Add new taxonomy Route Scale, make it hierarchical
  // First do the translations part for GUI
  $labels = array(
    'name' => _x('Route Scale', 'taxonomy general name'),
    'singular_name' => _x('Route Scale', 'taxonomy singular name'),
    'search_items' => __('Search Route Scale'),
    'all_items' => __('All Route Scales'),
    'parent_item' => __('Parent Route Scale'),
    'parent_item_colon' => __('Parent Route Scale:'),
    'edit_item' => __('Edit Route Scale'),
    'update_item' => __('Update Route Scale'),
    'add_new_item' => __('Add New Route Scale'),
    'new_item_name' => __('New Route Scale Name'),
    'menu_name' => __('NER Route Scale'),
  );

  // Register the taxonomy
  register_taxonomy('routescale',array('route-details'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'routescale'),
  ));
}

// Create a custom taxonomy named 'Locale'
function create_locale_hierarchical_taxonomy() {
  // Add new taxonomy, make it hierarchical
  // First do the translations part for GUI
  $labels = array(
    'name' => _x('Locale', 'taxonomy general name'),
    'singular_name' => _x('Locale', 'taxonomy singular name'),
    'search_items' => __('Search Locale'),
    'all_items' => __('All Locales'),
    'parent_item' => __('Parent Locale'),
    'parent_item_colon' => __('Parent Locale:'),
    'edit_item' => __('Edit Locale'),
    'update_item' => __('Update Locale'),
    'add_new_item' => __('Add New Locale'),
    'new_item_name' => __('New Locale Name'),
    'menu_name' => __('NER Locale'),
  );

  // Register the taxonomy
  register_taxonomy('locale',array('page','route-details'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'locale'),
  ));
}

// Create a custom taxonomy named 'Route Features'
function create_routefeatures_taxonomy() {
  // Add new taxonomy, make it non-hierarchical
  // First do the translations part for GUI
  $labels = array(
    'name' => _x('Route Features', 'taxonomy general name'),
    'singular_name' => _x('Route Feature', 'taxonomy singular name'),
    'search_items' => __('Search Route Features'),
    'all_items' => __('All Route Features'),
    'edit_item' => __('Edit Feature'),
    'update_item' => __('Update Feature'),
    'add_new_item' => __('Add New Route Feature'),
    'new_item_name' => __('New Route Feature Name'),
    'menu_name' => __('NER Route Features'),
  );

  // Register the taxonomy
  register_taxonomy('routefeatures',array('route-details'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'route-features'),
  ));
}



/******** CUSTOM POST TYPES *******/
// hook into the init action and call custom post types when it fires
function custom_post_type_route_details() {
	//Set UI labels for CPT
	$labels = array(
		'name' => _x('Route Details', 'Post Type General Name', 'travelify-child'),
		'singular_name' => _x('Route Details', 'Post Type Singular Name', 'travelify-child'),
		'menu_name' => __('Route Details Pages', 'travelify-child'),
		'parent_item_colon' => __('Parent Route', 'travelify-child'),
		'all_items' => __('All Routes', 'travelify-child'),
		'view_item' => __('View Route Page', 'travelify-child'),
		'add_new_item' => __('Add New Route', 'travelify-child'),
		'add_new' => __('Add New', 'travelify-child'),
		'edit_item' => __('Edit Route Details', 'travelify-child'),
		'update_item' => __('Update Route Details', 'travelify-child'),
		'search_items' => __('Search Routes', 'travelify-child'),
		'not_found' => __('Not found', 'travelify-child'),
		'not_found_in_trash' => __('Not found in Trash', 'travelify-child'),
		);

	// Set other options for Custom Post Type
	$args = array(
		'label' => __('Route Details', 'travelify-child'),
		'description' => __('Details of road segments and day rides', 'travelify-child'),
		'labels' => $labels,
		//Features this CPT supports in Post Editor
		'supports' => array('title','editor','excerpt','comments','revisions','custom-fields',),
		'taxonomies' => array('routescale', 'locale',),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 5,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	// Register the CPT
	register_post_type('route-details',$args);
}
// Hook into the 'init' action to register CPT
add_action('init', 'custom_post_type_route_details', 0);

// CPT Locale Details
function custom_post_type_locale_details() {
	//Set UI labels for CPT
	$labels = array(
		'name' => _x('Locale Detail', 'Post Type General Name', 'travelify-child'),
		'singular_name' => _x('Locale Detail', 'Post Type Singular Name', 'travelify-child'),
		'menu_name' => __('Locale Detail Pages', 'travelify-child'),
		'parent_item_colon' => __('Parent Locale', 'travelify-child'),
		'all_items' => __('All Locales', 'travelify-child'),
		'view_item' => __('View Locale Page', 'travelify-child'),
		'add_new_item' => __('Add New Locale', 'travelify-child'),
		'add_new' => __('Add New', 'travelify-child'),
		'edit_item' => __('Edit Locale Detail', 'travelify-child'),
		'update_item' => __('Update Locale Detail', 'travelify-child'),
		'search_items' => __('Search Locales', 'travelify-child'),
		'not_found' => __('Not found', 'travelify-child'),
		'not_found_in_trash' => __('Not found in Trash', 'travelify-child'),
		);

	// Set other options for Custom Post Type
	$args = array(
		'label' => __('Locale Detail', 'travelify-child'),
		'description' => __('Details of riding locales/regions', 'travelify-child'),
		'labels' => $labels,
		//Features this CPT supports in Post Editor
		'supports' => array('title','editor','excerpt','comments','revisions','custom-fields',),
		'taxonomies' => array('category'),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 5,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	// Register the CPT
	register_post_type('locale-details',$args);
}
// Hook into the 'init' action to register CPT
add_action('init', 'custom_post_type_locale_details', 0);



/********* Add Excerpts to default 'Page' post type ****/
add_post_type_support('page', 'excerpt');

?>
