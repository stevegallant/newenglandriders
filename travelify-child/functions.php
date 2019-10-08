<?php

// Enqueue styles from parent and child themes
function theme_enqueue_styles() {
	$parent_style = 'travelify-style';
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// customize theme header
function customize_travelify_header(){
	remove_action( 'travelify_header', 'travelify_headerdetails' );
	add_action( 'travelify_header', 'custom_travelify_headerdetails', 99 );
}
add_action('init', 'customize_travelify_header');

/**
 * Shows Header Part Content
 *
 * Shows the site logo, title, description, searchbar, social icons etc.
 */
function custom_travelify_headerdetails() {
?>
	<?php
		global $travelify_theme_options_settings;
   	$options = $travelify_theme_options_settings;

   	$elements = array();
		$elements = array(
			$options[ 'social_facebook' ],
			$options[ 'social_twitter' ],
			$options[ 'social_googleplus' ],
			$options[ 'social_linkedin' ],
			$options[ 'social_pinterest' ],
			$options[ 'social_youtube' ],
			$options[ 'social_vimeo' ],
			$options[ 'social_flickr' ],
			$options[ 'social_tumblr' ],
			$options[ 'social_instagram' ],
			$options[ 'social_rss' ],
			$options[ 'social_github' ]
		);

		$flag = 0;
		if( !empty( $elements ) ) {
			foreach( $elements as $option) {
				if( !empty( $option ) ) {
					$flag = 1;
				}
				else {
					$flag = 0;
				}
				if( 1 == $flag ) {
					break;
				}
			}
		}


	?>

	<div class="container clearfix">
		<div class="hgroup-wrap clearfix">
					<section class="hgroup-right">
						<?php travelify_socialnetworks( $flag ); ?>
					</section><!-- .hgroup-right -->
				<hgroup id="site-logo" class="clearfix">
					<?php
						if( $options[ 'header_show' ] != 'disable-both' && $options[ 'header_show' ] == 'header-text' ) {
						?>
							<h1 id="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h1>
							<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
						<?php
						}
						elseif( $options[ 'header_show' ] != 'disable-both' && $options[ 'header_show' ] == 'header-logo' ) {
						?>
							<h1 id="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
									<img src="<?php echo $options[ 'header_logo' ]; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
								</a>
							</h1>
						<?php
						} else if( $options[ 'header_show' ] == 'disable-both'){ ?>
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
									<img src="<?php echo $options[ 'header_logo' ]; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
								</a>
							</h1>
							<h1 id="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h1>
							<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
						<?php }
						?>

				</hgroup><!-- #site-logo -->

		</div><!-- .hgroup-wrap -->
	</div><!-- .container -->
	<?php $header_image = get_header_image();
			if( !empty( $header_image ) ) :?>
				<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
			<?php endif; ?>
	<?php
		if ( has_nav_menu( 'primary' ) ) {
			$args = array(
				'theme_location'    => 'primary',
				'container'         => '',
				'items_wrap'        => '<ul class="root">%3$s</ul>'
			);
			echo '<nav id="main-nav" class="clearfix">
					<div class="container clearfix">';
				wp_nav_menu( $args );
			echo '</div><!-- .container -->
					</nav><!-- #main-nav -->';
		}
		else {
			echo '<nav id="main-nav" class="clearfix">
					<div class="container clearfix">';
				wp_page_menu( array( 'menu_class'  => 'root' ) );
			echo '</div><!-- .container -->
					</nav><!-- #main-nav -->';
		}
	?>
		<?php
		if( is_home() || is_front_page() ) {
			if( "0" == $options[ 'disable_slider' ] ) {
				if( function_exists( 'travelify_pass_cycle_parameters' ) )
   				travelify_pass_cycle_parameters();
   			if( function_exists( 'travelify_featured_post_slider' ) )
   				travelify_featured_post_slider();
   		}
   		}
		else {
			if( ( '' != travelify_header_title() ) || function_exists( 'bcn_display_list' ) ) {
		?>
			<div class="page-title-wrap">
	    		<div class="container clearfix">
	    			<?php
		    		if( function_exists( 'travelify_breadcrumb' ) )
						travelify_breadcrumb();
					?>
				   <h3 class="page-title"><?php echo travelify_header_title(); ?></h3><!-- .page-title -->
				</div>
	    	</div>
	   <?php
	   	}
		}
}

/********* Add additional post formats *******/
//add theme support for addl post formats
function additional_post_formats() {
	add_theme_support('post-formats', array('link', 'gallery', 'video'));
}
add_action('after_setup_theme', 'additional_post_formats');

/******** (for Link post format) returns raw URL from content of a post
that contains a single hyperlink ***/
function get_my_url() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) ) {
		return false;
	}
	return esc_url_raw( $matches[1] );
}
// function get_my_url() {
//   if (! preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches)) return false;
//   return esc_url_raw($matches[1]);
// }


/***** REPLACE ARCHIVE LOOP FROM TRAVELIFY THEME *****/
function travelify_theloop_for_archive() {
	global $post;

	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			do_action( 'travelify_before_post' );
			// Here we need logic to choose template parts based on what styling
			// is needed for the different archive views.
			// if (has_term('','routescale')) {
			if ('route-details' == get_post_type()) {
				get_template_part('content','archive-route-details');
			} else {
				get_template_part('content','archive');
			}

			do_action( 'travelify_after_post' );
		}
	}
	else {
		?>
		<h1 class="entry-title"><?php _e( 'No Posts Found.', 'travelify' ); ?></h1>
      <?php
  }
}

/****** REPLACE SINGLE POST LOOP FROM TRAVELIFY THEME ******/
function travelify_theloop_for_single() {
	global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			do_action( 'travelify_before_post' );
			// Display content template based on custom post type
			if(is_singular('route-details')){
				get_template_part('content','route-details');
			} elseif (is_singular('locale-details')) {
				get_template_part('content','locale-details');
			} else {
				// default single post content template
				get_template_part('content','single');
			}
?>
<?php
			do_action( 'travelify_after_post' );
		}
	}
	else {
		?>
		<h1 class="entry-title"><?php _e( 'No Posts Found.', 'travelify' ); ?></h1>
      <?php
   }
}

/****** REPLACE SINGLE PAGE LOOP FROM TRAVELIFY THEME ******/
function travelify_theloop_for_page() {
	global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			do_action( 'travelify_before_post' );
			if (is_page('b-o-n-e')) {
				get_template_part('content', 'page-b-o-n-e');
			}
			else {
				get_template_part('content', 'page');
			}

			do_action( 'travelify_after_post' );
		}
	}
	else {
		?>
		<h1 class="entry-title"><?php _e( 'No Posts Found.', 'travelify' ); ?></h1>
  <?php
  }
}

/**** CHANGE SORTING OF ARCHIVE LISTS TO ASC BY TITLE */
add_action('pre_get_posts', 'sort_order_title');
function sort_order_title($query) {
	if(is_archive()):
		//If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
		$query->set('order', 'ASC');
		$query->set('orderby', 'title');
	endif;
};

/***** ADD FILTER TO PROCESS SHORTCODES IN ACF RATINGS-RELATED FIELDS *****/
add_filter('acf/format_value/name=gpx_file','do_shortcode');

/*** FILTER TO ALLOW GPX FILE UPLOADS ****/
function add_custom_mime_types($mimes = array()) {
  // $mimes['gpx'] = 'application/gpx+xml';
  $mimes['gpx'] = 'application/gpx+xml';
  return $mimes;
}
add_filter('upload_mimes', 'add_custom_mime_types');


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

?>
