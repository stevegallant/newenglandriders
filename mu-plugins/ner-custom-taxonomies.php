<?php
/*
Plugin Name: NER Custom Taxonomies for newenglandriders.org
Description: Custom site-specific code for newenglandriders.org
Version: 1.0
Author: S. Gallant
*/

/******** CUSTOM TAXONOMIES *******/
// hook into the init action and call custom taxonomies when it fires
add_action('init', 'create_ner_taxonomies', 0);

// Define NER custom taxonomies
function create_ner_taxonomies() {
  // Add new taxonomy Route Scale, make it hierarchical
  // First do the translations part for GUI
  $routescaleLabels = array(
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
    'labels' => $routescaleLabels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'routescale'),
  ));

  // Add new taxonomy Surface Type, make it hierarchical
  // First do the translations part for GUI
  $surfacetypeLabels = array(
    'name' => _x('Surface Type', 'taxonomy general name'),
    'singular_name' => _x('Surface Type', 'taxonomy singular name'),
    'search_items' => __('Search Surface Type'),
    'all_items' => __('All Surface Types'),
    'parent_item' => __('Parent Surface Type'),
    'parent_item_colon' => __('Parent Surface Type:'),
    'edit_item' => __('Edit Surface Type'),
    'update_item' => __('Update Surface Type'),
    'add_new_item' => __('Add New Surface Type'),
    'new_item_name' => __('New Surface Type Name'),
    'menu_name' => __('NER Surface Type'),
  );

  // Register the taxonomy
  register_taxonomy('surface',array('route-details'), array(
    'hierarchical' => true,
    'labels' => $surfacetypeLabels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'surface'),
  ));


  // Create a custom taxonomy named 'Locale'
  // Add new taxonomy, make it hierarchical
  // First do the translations part for GUI
  $localeLabels = array(
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
  register_taxonomy('locale',array('page','route-details','locale-details'), array(
    'hierarchical' => true,
    'labels' => $localeLabels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'locale'),
  ));

  // Create a custom taxonomy named 'Route Features'
  // Add new taxonomy, make it non-hierarchical
  // First do the translations part for GUI
  $routefeaturesLabels = array(
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
    'labels' => $routefeaturesLabels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'route-features'),
  ));

  // Create a custom taxonomy named 'Cuisine'
  // Add new taxonomy, make it non-hierarchical
  // First do the translations part for GUI
  $cuisineLabels = array(
    'name' => _x('Cuisines', 'taxonomy general name'),
    'singular_name' => _x('Cuisine', 'taxonomy singular name'),
    'search_items' => __('Search Cuisines'),
    'all_items' => __('All Cuisines'),
    'edit_item' => __('Edit Cuisine'),
    'update_item' => __('Update Cuisine'),
    'add_new_item' => __('Add New Cuisine'),
    'new_item_name' => __('New Cuisine Name'),
    'menu_name' => __('NER Cuisines'),
  );

  // Register the taxonomy
  register_taxonomy('cuisine',array('restaurant-details'), array(
    'hierarchical' => false,
    'labels' => $cuisineLabels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'cuisine'),
  ));

  // Create a custom taxonomy named 'Hotel Tags'
  // Add new taxonomy, make it non-hierarchical
  // First do the translations part for GUI
  $hotelTagLabels = array(
    'name' => _x('Hotel Tags', 'taxonomy general name'),
    'singular_name' => _x('Hotel Tag', 'taxonomy singular name'),
    'search_items' => __('Search Hotel Tags'),
    'all_items' => __('All Hotel Tags'),
    'edit_item' => __('Edit Hotel Tag'),
    'update_item' => __('Update Hotel Tag'),
    'add_new_item' => __('Add New Hotel Tag'),
    'new_item_name' => __('New Hotel Tag Name'),
    'menu_name' => __('NER Hotel Tags'),
  );

  // Register the taxonomy
  register_taxonomy('hotel-tag',array('hotel-details'), array(
    'hierarchical' => false,
    'labels' => $hotelTagLabels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'hotel-tag'),
  ));

  // Create a custom taxonomy named 'Attraction Tags'
  // Add new taxonomy, make it non-hierarchical
  // First do the translations part for GUI
  $attractionTagLabels = array(
    'name' => _x('Attraction Tags', 'taxonomy general name'),
    'singular_name' => _x('Attraction Tag', 'taxonomy singular name'),
    'search_items' => __('Search Attraction Tags'),
    'all_items' => __('All Attraction Tags'),
    'edit_item' => __('Edit Attraction Tag'),
    'update_item' => __('Update Attraction Tag'),
    'add_new_item' => __('Add New Attraction Tag'),
    'new_item_name' => __('New Attraction Tag Name'),
    'menu_name' => __('NER Attraction Tags'),
  );

  // Register the taxonomy
  register_taxonomy('attraction-tag',array('attraction-details'), array(
    'hierarchical' => false,
    'labels' => $attractionTagLabels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'attraction-tag'),
  ));

}
