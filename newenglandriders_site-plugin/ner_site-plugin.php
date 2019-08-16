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
    'menu_name' => __('NER Route Scale'),
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
    'menu_name' => __('NER Locale'),
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



/****** Allow GPX files to be uploaded ***************/
// function add_custom_mime_types($mimes) {
//   return array_merge($mimes, array(
//     'gpx' => 'text/plain',
//   ));
// }
function add_custom_mime_types($mimes) {
  // $mimes['gpx'] = 'application/gpx+xml';
  $mimes['gpx'] = 'text/plain';
  return $mimes;
}
add_filter('mime_types', 'add_custom_mime_types', 1, 1);

// TEST by showing all allowed mime types
// function my_theme_output_upload_mimes() {
// 	var_dump( wp_get_mime_types() );
// }
// add_action( 'template_redirect', 'my_theme_output_upload_mimes' );


// /******** Set title for  post-format 'link' to link directly to URL ***/
// function get_my_url() {
//   if (! preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches)) return false;
//   return esc_url_raw($matches[1]);
// }

?>
