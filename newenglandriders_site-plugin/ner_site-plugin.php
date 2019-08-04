<?php
/*
Plugin Name: Site Plugin for newenglandriders.org
Description: Site specific code changes for newenglandriders.org
*/
// hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'create_routesize_hierarchical_taxonomy', 0);

// Create a custom taxonomy named 'Route Sizes'
function create_routesize_hierarchical_taxonomy() {
  // Add new taxonomy, make it hierarchical
  // First do the translations part for GUI
  $labels = array(
    'name' => _x('Route Size', 'taxonomy general name'),
    'singular_name' => _x('Route Size', 'taxonomy singular name'),
    'search_items' => __('Search Route Size'),
    'all_items' => __('All Route Sizes'),
    'parent_item' => __('Parent Route Size'),
    'parent_item_colon' => __('Parent Route Size:'),
    'edit_item' => __('Edit Route Size'),
    'update_item' => __('Update Route Size'),
    'add_new_item' => __('Add New Route Size'),
    'new_item_name' => __('New Route Size Name'),
    'menu_name' => __('Route Size'),
  );

  // Register the taxonomy
  register_taxonomy('routesize',array('page'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'routesize'),
  ));
}

?>
