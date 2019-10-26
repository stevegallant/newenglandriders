<?php
/*
Plugin Name: NER Post Types for newenglandriders.org
Description: Custom site-specific code for newenglandriders.org
Version: 1.0
Author: S. Gallant
*/

/******** CUSTOM POST TYPES *******/
// Hook into the 'init' action to register CPT
add_action('init', 'ner_custom_post_types', 0);

// hook into the init action and call custom post types when it fires
function ner_custom_post_types() {
	// Route Details CPT
	//Set UI labels for CPT
	$routedetailsLabels = array(
		'name' => _x('Route Details', 'Post Type General Name', 'travelify-child'),
		'singular_name' => _x('Route Details', 'Post Type Singular Name', 'travelify-child'),
		'menu_name' => __('Route Details', 'travelify-child'),
		'parent_item_colon' => __('Parent Route', 'travelify-child'),
		'all_items' => __('All Routes', 'travelify-child'),
		'view_item' => __('View Route', 'travelify-child'),
		'add_new_item' => __('Add New Route', 'travelify-child'),
		'add_new' => __('Add New', 'travelify-child'),
		'edit_item' => __('Edit Route Details', 'travelify-child'),
		'update_item' => __('Update Route Details', 'travelify-child'),
		'search_items' => __('Search Routes', 'travelify-child'),
		'not_found' => __('Not found', 'travelify-child'),
		'not_found_in_trash' => __('Not found in Trash', 'travelify-child'),
		);

	// Set other options for CPT
	$routedetailsArgs = array(
		'label' => __('Route Details', 'travelify-child'),
		'description' => __('Details of road segments and day rides', 'travelify-child'),
		'labels' => $routedetailsLabels,
		//Features this CPT supports in Post Editor
		'supports' => array('title','editor','excerpt','comments','revisions','custom-fields',),
		'taxonomies' => array('routescale', 'locale',),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 6,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	// Register the CPT
	register_post_type('route-details', $routedetailsArgs);

  // CPT Locale Details
	//Set UI labels for CPT
	$localedetailsLabels = array(
		'name' => _x('Locale Details', 'Post Type General Name', 'travelify-child'),
		'singular_name' => _x('Locale Details', 'Post Type Singular Name', 'travelify-child'),
		'menu_name' => __('Locale Details', 'travelify-child'),
		'parent_item_colon' => __('Parent Locale', 'travelify-child'),
		'all_items' => __('All Locales', 'travelify-child'),
		'view_item' => __('View Locale', 'travelify-child'),
		'add_new_item' => __('Add New Locale', 'travelify-child'),
		'add_new' => __('Add New', 'travelify-child'),
		'edit_item' => __('Edit Locale', 'travelify-child'),
		'update_item' => __('Update Locale', 'travelify-child'),
		'search_items' => __('Search Locales', 'travelify-child'),
		'not_found' => __('Not found', 'travelify-child'),
		'not_found_in_trash' => __('Not found in Trash', 'travelify-child'),
		);

	// Set other options for Custom Post Type
	$localedetailsArgs = array(
		'label' => __('Locale Details', 'travelify-child'),
		'description' => __('Details of riding locales/regions', 'travelify-child'),
		'labels' => $localedetailsLabels,
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
	register_post_type('locale-details', $localedetailsArgs);

	// Restaurant Details CPT
	//Set UI labels for CPT
	$restaurantDetailsLabels = array(
		'name' => _x('Restaurant Details', 'Post Type General Name', 'travelify-child'),
		'singular_name' => _x('Restaurant Details', 'Post Type Singular Name', 'travelify-child'),
		'menu_name' => __('Restaurant Details', 'travelify-child'),
		'parent_item_colon' => __('Parent Restaurant', 'travelify-child'),
		'all_items' => __('All Restaurants', 'travelify-child'),
		'view_item' => __('View Restaurant', 'travelify-child'),
		'add_new_item' => __('Add New Restaurant', 'travelify-child'),
		'add_new' => __('Add New', 'travelify-child'),
		'edit_item' => __('Edit Restaurant', 'travelify-child'),
		'update_item' => __('Update Restaurant', 'travelify-child'),
		'search_items' => __('Search Restaurants', 'travelify-child'),
		'not_found' => __('Not found', 'travelify-child'),
		'not_found_in_trash' => __('Not found in Trash', 'travelify-child'),
		);

	// Set other options for CPT
	$restaurantDetailsArgs = array(
		'label' => __('Restaurant Details', 'travelify-child'),
		'description' => __('Details of restaurants', 'travelify-child'),
		'labels' => $restaurantDetailsLabels,
		//Features this CPT supports in Post Editor
		'supports' => array('title','editor','excerpt','comments','revisions','custom-fields',),
		'taxonomies' => array('locale',),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 7,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	// Register the CPT
	register_post_type('restaurant-details', $restaurantDetailsArgs);

} // end ner_custom_post_types
