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
		'menu_icon' => 'dashicons-location',
		'menu_position' => 4,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	// Register the CPT
	register_post_type('locale-details', $localedetailsArgs);

	// Route  CPT
	//Set UI labels for CPT
	$routeLabels = array(
		'name' => _x('Route Details', 'Post Type General Name', 'travelify-child'),
		'singular_name' => _x('Route', 'Post Type Singular Name', 'travelify-child'),
		'menu_name' => __('Routes', 'travelify-child'),
		'parent_item_colon' => __('Parent Route', 'travelify-child'),
		'all_items' => __('All Routes', 'travelify-child'),
		'view_item' => __('View Route', 'travelify-child'),
		'add_new_item' => __('Add New Route', 'travelify-child'),
		'add_new' => __('Add New', 'travelify-child'),
		'edit_item' => __('Edit Route', 'travelify-child'),
		'update_item' => __('Update Route', 'travelify-child'),
		'search_items' => __('Search Routes', 'travelify-child'),
		'not_found' => __('Not found', 'travelify-child'),
		'not_found_in_trash' => __('Not found in Trash', 'travelify-child'),
		);

	// Set other options for CPT
	$routeArgs = array(
		'label' => __('Route', 'travelify-child'),
		'description' => __('Details of road segments and day rides', 'travelify-child'),
		'labels' => $routeLabels,
		//Features this CPT supports in Post Editor
		'supports' => array('title','editor','excerpt','comments','revisions','custom-fields','page-attributes'),
		'taxonomies' => array('routescale', 'locale',),
		'hierarchical' => true,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_icon' => 'dashicons-randomize',
		'menu_position' => 5,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	// Register the CPT
	register_post_type('route', $routeArgs);

	// Restaurant  CPT
	//Set UI labels for CPT
	$restaurantLabels = array(
		'name' => _x('Restaurants', 'Post Type General Name', 'travelify-child'),
		'singular_name' => _x('Restaurant', 'Post Type Singular Name', 'travelify-child'),
		'menu_name' => __('Restaurants', 'travelify-child'),
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
	$restaurantArgs = array(
		'label' => __('Restaurant', 'travelify-child'),
		'description' => __('Details of restaurants', 'travelify-child'),
		'labels' => $restaurantLabels,
		//Features this CPT supports in Post Editor
		'supports' => array('title','editor','excerpt','comments','revisions','custom-fields',),
		'taxonomies' => array('locale',),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_icon' => 'dashicons-carrot',
		'menu_position' => 6,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	// Register the CPT
	register_post_type('restaurant', $restaurantArgs);

	// Hotel  CPT
	//Set UI labels for CPT
	$hotelLabels = array(
		'name' => _x('Hotels', 'Post Type General Name', 'travelify-child'),
		'singular_name' => _x('Hotel', 'Post Type Singular Name', 'travelify-child'),
		'menu_name' => __('Hotels', 'travelify-child'),
		'parent_item_colon' => __('Parent Hotel', 'travelify-child'),
		'all_items' => __('All Hotels', 'travelify-child'),
		'view_item' => __('View Hotel', 'travelify-child'),
		'add_new_item' => __('Add New Hotel', 'travelify-child'),
		'add_new' => __('Add New', 'travelify-child'),
		'edit_item' => __('Edit Hotel', 'travelify-child'),
		'update_item' => __('Update Hotel', 'travelify-child'),
		'search_items' => __('Search Hotels', 'travelify-child'),
		'not_found' => __('Not found', 'travelify-child'),
		'not_found_in_trash' => __('Not found in Trash', 'travelify-child'),
		);

	// Set other options for CPT
	$hotelArgs = array(
		'label' => __('Hotel', 'travelify-child'),
		'description' => __('Details of hotels', 'travelify-child'),
		'labels' => $hotelLabels,
		//Features this CPT supports in Post Editor
		'supports' => array('title','editor','excerpt','comments','revisions','custom-fields',),
		'taxonomies' => array('locale',),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_icon' => 'dashicons-building',
		'menu_position' => 7,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	// Register the CPT
	register_post_type('hotel', $hotelArgs);

	// Scenic View CPT
	//Set UI labels for CPT
	$scenicViewLabels = array(
		'name' => _x('Scenic Views', 'Post Type General Name', 'travelify-child'),
		'singular_name' => _x('Scenic View', 'Post Type Singular Name', 'travelify-child'),
		'menu_name' => __('Scenic Views', 'travelify-child'),
		'parent_item_colon' => __('Parent Scenic View', 'travelify-child'),
		'all_items' => __('All Scenic Views', 'travelify-child'),
		'view_item' => __('View Scenic View', 'travelify-child'),
		'add_new_item' => __('Add New Scenic View', 'travelify-child'),
		'add_new' => __('Add New', 'travelify-child'),
		'edit_item' => __('Edit Scenic View', 'travelify-child'),
		'update_item' => __('Update Scenic View', 'travelify-child'),
		'search_items' => __('Search Scenic Views', 'travelify-child'),
		'not_found' => __('Not found', 'travelify-child'),
		'not_found_in_trash' => __('Not found in Trash', 'travelify-child'),
		);

	// Set other options for CPT
	$scenicViewArgs = array(
		'label' => __('Scenic View', 'travelify-child'),
		'description' => __('Details of scenic views', 'travelify-child'),
		'labels' => $scenicViewLabels,
		//Features this CPT supports in Post Editor
		'supports' => array('title','editor','revisions','custom-fields','thumbnail'),
		'taxonomies' => array('locale',),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_icon' => 'dashicons-visibility',
		'menu_position' => 9,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	// Register the CPT
	register_post_type('scenicview', $scenicViewArgs);

	// Attraction  CPT
	//Set UI labels for CPT
	$attractionLabels = array(
		'name' => _x('Attractions', 'Post Type General Name', 'travelify-child'),
		'singular_name' => _x('Attraction', 'Post Type Singular Name', 'travelify-child'),
		'menu_name' => __('Attractions', 'travelify-child'),
		'parent_item_colon' => __('Parent Attraction', 'travelify-child'),
		'all_items' => __('All Attractions', 'travelify-child'),
		'view_item' => __('View Attraction', 'travelify-child'),
		'add_new_item' => __('Add New Attraction', 'travelify-child'),
		'add_new' => __('Add New', 'travelify-child'),
		'edit_item' => __('Edit Attraction', 'travelify-child'),
		'update_item' => __('Update Attraction', 'travelify-child'),
		'search_items' => __('Search Attractions', 'travelify-child'),
		'not_found' => __('Not found', 'travelify-child'),
		'not_found_in_trash' => __('Not found in Trash', 'travelify-child'),
		);

	// Set other options for CPT
	$attractionArgs = array(
		'label' => __('Attraction', 'travelify-child'),
		'description' => __('Details of attraction', 'travelify-child'),
		'labels' => $attractionLabels,
		//Features this CPT supports in Post Editor
		'supports' => array('title','editor','revisions','custom-fields','thumbnail'),
		'taxonomies' => array('locale',),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_icon' => 'dashicons-camera',
		'menu_position' => 10,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	// Register the CPT
	register_post_type('attraction', $attractionArgs);

	// Campground  CPT
	//Set UI labels for CPT
	$campgroundLabels = array(
		'name' => _x('Campgrounds', 'Post Type General Name', 'travelify-child'),
		'singular_name' => _x('Campground', 'Post Type Singular Name', 'travelify-child'),
		'menu_name' => __('Campgrounds', 'travelify-child'),
		'parent_item_colon' => __('Parent Campground', 'travelify-child'),
		'all_items' => __('All Campgrounds', 'travelify-child'),
		'view_item' => __('View Campground', 'travelify-child'),
		'add_new_item' => __('Add New Campground', 'travelify-child'),
		'add_new' => __('Add New', 'travelify-child'),
		'edit_item' => __('Edit Campground', 'travelify-child'),
		'update_item' => __('Update Campground', 'travelify-child'),
		'search_items' => __('Search Campgrounds', 'travelify-child'),
		'not_found' => __('Not found', 'travelify-child'),
		'not_found_in_trash' => __('Not found in Trash', 'travelify-child'),
		);

	// Set other options for CPT
	$campgroundArgs = array(
		'label' => __('Campground', 'travelify-child'),
		'description' => __('Details of campgrounds', 'travelify-child'),
		'labels' => $campgroundLabels,
		//Features this CPT supports in Post Editor
		'supports' => array('title','editor','excerpt','comments','revisions','custom-fields',),
		'taxonomies' => array('locale',),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_icon' => 'dashicons-palmtree',
		'menu_position' => 11,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	// Register the CPT
	register_post_type('campground', $campgroundArgs);

	// Trip CPT
	//Set UI labels for CPT
	$tripLabels = array(
		'name' => _x('Trips', 'Post Type General Name', 'travelify-child'),
		'singular_name' => _x('Trip', 'Post Type Singular Name', 'travelify-child'),
		'menu_name' => __('Trips', 'travelify-child'),
		'parent_item_colon' => __('Parent Trip', 'travelify-child'),
		'all_items' => __('All Trips', 'travelify-child'),
		'view_item' => __('View Trip', 'travelify-child'),
		'add_new_item' => __('Add New Trip', 'travelify-child'),
		'add_new' => __('Add New', 'travelify-child'),
		'edit_item' => __('Edit Trip', 'travelify-child'),
		'update_item' => __('Update Trip', 'travelify-child'),
		'search_items' => __('Search Trips', 'travelify-child'),
		'not_found' => __('Not found', 'travelify-child'),
		'not_found_in_trash' => __('Not found in Trash', 'travelify-child'),
		);

	// Set other options for CPT
	$tripArgs = array(
		'label' => __('Trip', 'travelify-child'),
		'description' => __('Details of NER trips', 'travelify-child'),
		'labels' => $tripLabels,
		//Features this CPT supports in Post Editor
		'supports' => array('title','editor','excerpt','comments','revisions','custom-fields',),
		'taxonomies' => array('locale',),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_icon' => 'dashicons-location-alt',
		'menu_position' => 12,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	// Register the CPT
	register_post_type('trip', $tripArgs);

} // end ner_custom_post_types
