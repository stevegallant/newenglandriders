<?php
/*
Plugin Name: Site Plugin for newenglandriders.org
Description: Site specific code changes for newenglandriders.org
Author: S. Gallant
*/
// hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'create_routesize_hierarchical_taxonomy', 0);

// Create a custom taxonomy named 'Route Sizes'
function create_routescale_hierarchical_taxonomy() {
  // Add new taxonomy, make it hierarchical
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
    'menu_name' => __('Route Scale'),
  );

  // Register the taxonomy
  register_taxonomy('routescale',array('page'), array(
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
    'menu_name' => __('Locale'),
  );

  // Register the taxonomy
  register_taxonomy('locale',array('page'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'locale'),
  ));
}

?>
