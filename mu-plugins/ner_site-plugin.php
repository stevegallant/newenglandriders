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

/****** Array of Google Map IDs for embedded maps *******/
global $map_ids;
$map_ids = array(
  'ct' => '1wgQsXozc5yu_AKGVjZ6c4lhAP30H3ruQ',
  'ma' => '1jfAXOageah5elJTzBFwx9vxe07wWXqHg',
  'me' => '1uXL6HdJ5fw-yIhzz4_q7QK_t4m1I0dKR',
  'nb' => '16f6fpPrAdHJVQm3hIaq3CM6Jp3yolgGC',
  'nh' => '1x5Kp3mkiiulj5Uj07yvbQMivkc1iFgVA',
  'nj' => '1rLvEvaMOnIT5gsiAd0obXG_IcPPkLCkt',
  'nl' => '1dXFZ718bvx10p0gPJiHn23Fbgy1bmDUg',
  'ns' => '1v6lF6K0jaOzDEiXosgE1u69FrqBqOA5s',
  'ny' => '1deFfpRZpA6Qd-vSQuJtMg7iyLy3B1zHN',
  'on' => '1k73lbvdsNpnMtMP8_b_hYRF8KusWYWHp',
  'pa' => '1oEQYBi150Dp1n1DA7v0sRYzI_3XapoYn',
  'pei' => '1uyuTOKRqMDiDWN7Szu0e6b5r_cpvCcfA',
  'qc' => '1_c1gLz33sEnq_4oDudI7NgwmH1214luO',
  'ri' => '1RKZEMiDBEmQggWM4iT3jnozCtdnRYAdT',
  'vt' => '1OU5pdbmligQXyH3eQC5VafzzHIJ7LXxZ',
  'wv' => '1ovVls7wJaVv9nMKsU0LWKcbXwNvpGZPc',

)

?>
