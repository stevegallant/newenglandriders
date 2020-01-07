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
    'menu_name' => __('Route Scale'),
  );

  // Register the taxonomy
  register_taxonomy('routescale',array('route'), array(
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
    'menu_name' => __('Surface Type'),
  );

  // Register the taxonomy
  register_taxonomy('surface',array('route'), array(
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
    'menu_name' => __('Locale'),
  );

  // Register the taxonomy
  register_taxonomy('locale',array('page','route','locale-details','attachment'), array(
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
    'menu_name' => __('Route Features'),
  );

  // Register the taxonomy
  register_taxonomy('routefeatures',array('route'), array(
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
    'menu_name' => __('Cuisines'),
  );

  // Register the taxonomy
  register_taxonomy('cuisine',array('restaurant'), array(
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
    'menu_name' => __('Hotel Tags'),
  );

  // Register the taxonomy
  register_taxonomy('hotel-tag',array('hotel'), array(
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
    'menu_name' => __('Attraction Tags'),
  );

  // Register the taxonomy
  register_taxonomy('attraction-tag', array('attraction'), array(
    'hierarchical' => false,
    'labels' => $attractionTagLabels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'attraction-tag'),
    'meta_box_cb' => 'post_categories_meta_box', //display with hierarchical checkbox UI
    // 'meta_box_sanitize_cb' => 'taxonomy_meta_box_sanitize_cb_input',
  ));


  // Create a custom taxonomy named 'Media Tags'
  // Add new taxonomy, make it non-hierarchical
  // First do the translations part for GUI
  $mediaTagLabels = array(
    'name' => _x('Media Tags', 'taxonomy general name'),
    'singular_name' => _x('Media Tag', 'taxonomy singular name'),
    'search_items' => __('Search Media Tags'),
    'all_items' => __('All Media Tags'),
    'edit_item' => __('Edit Media Tag'),
    'update_item' => __('Update Media Tag'),
    'add_new_item' => __('Add New Media Tag'),
    'new_item_name' => __('New Media Tag Name'),
    'menu_name' => __('Media Tags'),
  );

  // Register the taxonomy
  register_taxonomy('media-tag',array('attachment'), array(
    'hierarchical' => false,
    'labels' => $mediaTagLabels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'media-tag'),
  ));

}

// // use a filter to hide the parent selection checkbox on non-hierarch taxonomy
add_filter('post_edit_category_parent_dropdown_args', 'hide_parent_dropdown_select');
function hide_parent_dropdown_select($args) {
  if ('attraction-tag' == $args['taxonomy']) {
    $args['echo'] = false;
  }
  return $args;
}

// convert non-hier taxonomy term ID strings into integrers, to preserve relationship
// see https://www.gazchap.com/posts/enable-checkbox-lists-non-hierarchical-taxonomies-wordpress/
// add_action('admin_init', 'convert_tax_terms_to_int');
// function convert_tax_terms_to_int() {
//   if( isset( $_POST['tax_input'] ) && is_array( $_POST['tax_input'] ) ) {
//     $new_tax_input = array();
//     foreach( $_POST['tax_input'] as $tax => $terms) {
//     	if( is_array( $terms ) ) {
// 			  $taxonomy = get_taxonomy( $tax );
// 			  if( !is_taxonomy_hierarchical($taxonomy)) {
// 				  $terms = array_map( 'intval', array_filter( $terms ) );
// 			  }
// 			}
// 			$new_tax_input[$tax] = $terms;
// 		}
// 		$_POST['tax_input'] = $new_tax_input;
// 	}
// }

// function convert_tax_terms_to_int() {
//   $taxonomy = 'attraction-tag';
//   if (isset($_POST['tax_input'][$taxonomy]) && is_array($_POST['tax_input'][$taxonomy])) {
//     $terms = $_POST['tax_input'][$taxonomy];
//     $new_terms = array_map('intval', array_filter($terms));
//     $_POST['tax_input'][$taxonomy] = $new_terms;
//   }
// }
