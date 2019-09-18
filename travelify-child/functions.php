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

/***** ADD FILTER TO PROCESS SHORTCODES IN ACF RATINGS-RELATED FIELDS *****/
add_filter('acf/format_value/name=gpx_file','do_shortcode');

/*** FILTER TO ALLOW GPX FILE UPLOADS ****/
function add_custom_mime_types($mimes = array()) {
  // $mimes['gpx'] = 'application/gpx+xml';
  $mimes['gpx'] = 'application/gpx+xml';
  return $mimes;
}
add_filter('upload_mimes', 'add_custom_mime_types');
?>
