<?php
/*
Plugin Name: NER Local Chooser Form for newenglandriders.org
Description: Custom site-specific code for newenglandriders.org
Version: 1.0
Author: S. Gallant
*/

/**** GENERATE FORM FOR SELECTING LOCALES AND ROUTE ELEMENTS *****/
/*** Register custom query vars *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/query_vars
 */
function ner_register_query_vars( $vars ) {
    $vars[] = 'route-element';
    return $vars;
}
add_filter( 'query_vars', 'ner_register_query_vars' );

//modify query for BONE page only
function bone_pre_get_posts($query) {
	// check if the user is requesting an admin page
	// or current query is not the main query
	if ( is_admin() || ! $query->is_main_query() ){
		return;
	}
	// edit the query only for the b-o-n-e page, else return
	if (!is_page('b-o-n-e')) {
		return;
	}
	$meta_query = array();
	// add meta_query elements
	if (!empty(get_query_var('route-element'))) {
		$meta_query[] = array(
			'key' => 'route_element_type',
			'value' => get_query_var('route-element'),
			'compare' => 'LIKE'
		);
	}
	if( count( $meta_query ) > 1 ){
    $meta_query['relation'] = 'AND';
  }
  if( count( $meta_query ) > 0 ){
    $query->set( 'meta_query', $meta_query );
  }
}
// add_action('pre_get_posts', 'bone_pre_get_posts', 1);

//create shortcode
function route_element_search_setup() {
	add_shortcode('route_element_search_form', 'route_element_search_form');
}
add_action('init', 'route_element_search_setup');

// Create first select field for locale
function route_element_search_form($args) {
	// The secondary query for the form
	$bone_query = new WP_Query(array(
		'post_type' => 'locale-details',
		'posts_per_page' => '-1',
		));

	// the secondary loop
	if ($bone_query->have_posts()) {
		$route_elements = array();
		while ($bone_query->have_posts()) {
			$bone_query->the_post();
			$route_element = get_post_meta(get_the_ID(), 'route_element_type', true);

			// populate array of all occurrences (non-dupe)
			if (!in_array($route_element, $route_elements)) {
				$route_elements[] = $route_element;
			}
		}
	} else {
		echo 'Secondary BONE query not working correctly!';
		return;
	}
	// Restore original post data
	wp_reset_postdata();

	if (count($route_elements) == 0) {
		return;
	}
	asort($route_elements);

	// Create first select element for form
	// All locales are options in drop-down
	$locale_terms = get_terms('locale', array('hide_empty' => false));
	if (is_array($locale_terms)) {
		// $select_locale = '<select name="locale" onchange="this.form.submit()">';
		$select_locale = '<select name="locale">';
		$select_locale .= '<option value="" selected="selected">Select locale</option>';
		foreach ($locale_terms as $term) {
			$select_locale .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
		}
		$select_locale .= '</select>' . "\n";
	}

	// Create second select field for route element
	$select_element = '<select name="route-element">';
	$select_element .= '<option value="" selected="selected">Select route element</option>';
	$select_element .= '<option value="segment">Roads</option>';
	$select_element .= '<option value="restaurant">Restaurants</option>';
	$select_element .= '<option value="scenicview">Scenic Views</option>';
	$select_element .= '<option value="attraction">Attractions</option>';
	$select_element .= '<option value="hotel">Hotels</option>';
	$select_element .= '<option value="campground">Campgrounds</option>';
	$select_element .= '<option value="dirtroad">Dirt Roads</option>';
	$select_element .= '</select>' . "\n";

	//print form1 for Locale page only
	$form1_output = '<form action="' . home_url() . '" method="GET" role="search">';
	$form1_output .= '<div class="localeselectbox">' . $select_locale . '</div></form><br />';
	// $form1_output .= '<p><input type="submit" value="Go!" class="button" /></p></form>';

	//print the form
	$form2_output = '<form action="' . home_url() . '" method="GET" role="search">';
	$form2_output .= '<div class="localeselectbox">' . $select_locale . '</div>';
	$form2_output .= '<div class="elementselectbox">' . $select_element . '</div>';
	// $form_output .= '<input type="hidden" name="post_type" value="" />';
	$form2_output .= '<p><input type="submit" value="Go!" class="button" /></p></form>';

	$form_output = 'Select an overall locale or region to explore:';
	$form_output .= $form1_output;
	$form_output .= 'Jump directly to list of route elements for a locale:';
	$form_output .= $form2_output;
	return $form_output;
}
