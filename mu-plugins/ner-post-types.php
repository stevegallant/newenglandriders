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
	//Set UI labels for CPT
	$routedetailsLabels = array(
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
		'menu_position' => 5,
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
	$localedetailsArgs = array(
		'label' => __('Locale Detail', 'travelify-child'),
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

} // end ner_custom_post_types
