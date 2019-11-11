<?php
/*
Plugin Name: NER Custom Plugin for newenglandriders.org
Description: Custom site-specific code for newenglandriders.org
Version: 1.0
Author: S. Gallant
*/

// Custom functions to allow Pages and Attachments to use the default Categories and Tags taxonomies
function ner_default_taxonomy_mod() {
  // Add category support to pages
  register_taxonomy_for_object_type('category', 'page');

  // Add tag support to pages
  register_taxonomy_for_object_type('post_tag', 'page');

  // Add category support for Attachment post type
  register_taxonomy_for_object_type('category', 'attachment');
}
// hook into init action for above functions
add_action( 'init', 'ner_default_taxonomy_mod' );

//ensure all Tags and Categories from all post types are included in queries
function tags_categories_support_query($wp_query) {
  if ($wp_query->get('tag') || ($wp_query->get('category_name'))) $wp_query->set('post_type', 'any');
}
add_action('pre_get_posts', 'tags_categories_support_query');

/********* Add Excerpts to default 'Page' post type ****/
add_post_type_support('page', 'excerpt');



?>
