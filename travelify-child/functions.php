<?php

// Enqueue styles from parent and child themes
function theme_enqueue_styles() {
	$parent_style = 'travelify-style';
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'ner-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// Custom JavaScript for NER site
add_action('wp_enqueue_scripts', 'ner_js_scripts', 100);
function ner_js_scripts() {
	// replace default script from parent theme to modify tinynav mobile menu
	wp_dequeue_script('theme_functions');
	wp_deregister_script('theme_functions');
	wp_enqueue_script('theme_functions_ner', get_stylesheet_directory_uri().'/library/js/functions.min.js', array('jquery'));

	// load script for collapible div sections in Trip template - (ed.) moved just to trip template
	// wp_enqueue_script('collapsingsection', get_stylesheet_directory_uri() . '/library/js/collapsingsection.js');

}

// Customize header by replacing original function from parent theme
function customize_travelify_header(){
	remove_action( 'travelify_header', 'travelify_headerdetails' );
	add_action( 'travelify_header', 'custom_travelify_headerdetails', 99 );
}
add_action('init', 'customize_travelify_header');

/**
 * Custom NER function shows Header Template Part Content
 * Shows the site logo, title, description, searchbar, social icons etc.
 */
function custom_travelify_headerdetails() {
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
	} ?>

	<div class="container clearfix">
		<div class="hgroup-wrap clearfix">
			<section class="hgroup-right">
				<?php travelify_socialnetworks( $flag ); ?>
				<?php if (is_user_logged_in()) {
					$currUser = wp_get_current_user(); ?>
					<a href="<?php echo wp_logout_url();?>" class="btn-login" title="Log out <?php echo $currUser->user_login; ?>">Log Out</a>
				<?php } else { ?>
					<span class="login-group">
						<a href="<?php echo wp_login_url();?>" class="btn-login" title="NERd Login">Log In</a>
						<a href="<?php echo esc_url(home_url('/reviews-and-ratings')); ?>" class="login-explain" target="_blank"><em>Why?</em></a>
					</span>
				<?php } ?>

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
					<?php }	?>
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
		if( !is_home() || !is_front_page() ) {
			if( ( '' != travelify_header_title() ) || function_exists( 'bcn_display_list' ) ) {
		?>
			<div class="page-title-wrap">
	    		<div class="container clearfix">
	    			<?php
		    		if( function_exists( 'travelify_breadcrumb' ) )
						travelify_breadcrumb();
					?>
				   <h2 class="page-title"><?php echo travelify_header_title(); ?></h2><!-- .page-title -->
				</div>
	    	</div>
	   <?php
	   	}
		}
} // end custom_travelify_headerdetails

/********* Add additional Post Formats *******/
add_action('after_setup_theme', 'ner_theme_features');
function ner_theme_features() {
	//add theme support for addl post formats
	add_theme_support('post-formats', array('link', 'gallery', 'video'));
	// Add Featured Image support
	add_theme_support('post-thumbnails');
}

/******** (for 'Link' post format) returns raw URL from content of a post
that contains a single hyperlink ***/
function get_my_url() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) ) {
		return false;
	}
	return esc_url_raw( $matches[1] );
}


// Replace parent theme function for assembling slider
function travelify_featured_post_slider() {
	global $post;
	global $travelify_theme_options_settings;
  $options = $travelify_theme_options_settings;
  $travelify_featured_post_slider = '';
	// new variable to hold URL for hyperlink based on slide title
	$slide_link = '';

	if (!empty( $options[ 'featured_post_slider' ] ) ) {
		$travelify_featured_post_slider .= '
		<section class="featured-slider"><div class="slider-cycle">';
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' 		    => $options[ 'slider_quantity' ],
				'post_type'					    => array( 'post', 'page' ),
				'post__in'		 			    => $options[ 'featured_post_slider' ],
				'orderby' 		 			    => 'post__in',
				'suppress_filters' 	    => false,
				'ignore_sticky_posts' 	=> 1 						// ignore sticky posts
			));
			$i=0; while ( $get_featured_posts->have_posts()) : $get_featured_posts->the_post(); $i++;
				$title_attribute = apply_filters( 'the_title', get_the_title( $post->ID ) );
				$excerpt = get_the_excerpt();

				switch ($title_attribute) {
					case 'Ride':
						$slide_link = site_url('/b-o-n-e');
						break;
					case 'Learn':
						$slide_link = site_url('/category/technique-safety');
						break;
					case 'Meet':
						$slide_link = site_url('/ner-online-groups');
						break;
					case 'Represent':
						$slide_link = site_url('/ner-oval-stickers');
						break;
					default:
						$slide_link = '#';
				}

				if ( 1 == $i ) { $classes = "slides displayblock"; } else { $classes = "slides displaynone"; }
				$travelify_featured_post_slider .= '
				<div class="'.$classes.'">';
						if( has_post_thumbnail() ) {
							$travelify_featured_post_slider .= '<figure><a href="' . $slide_link . '" title="'.the_title('','',false).'">';
							$travelify_featured_post_slider .= get_the_post_thumbnail( $post->ID, 'slider', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class'	=> 'pngfix' ) ).'</a></figure>';
						}
						if( $title_attribute != '' || $excerpt !='' ) {
						$travelify_featured_post_slider .= '
							<article class="featured-text">';
							if( $title_attribute !='' ) {
									$travelify_featured_post_slider .= '<div class="featured-title"><a href="' . $slide_link . '" title="'.the_title('','',false).'">'. get_the_title() . '</a></div><!-- .featured-title -->';
							}
							if( $excerpt !='' ) {
								$travelify_featured_post_slider .= '<div class="featured-content">'.$excerpt.'</div><!-- .featured-content -->';
							}
						$travelify_featured_post_slider .= '
							</article><!-- .featured-text -->';
						}
				$travelify_featured_post_slider .= '
				</div><!-- .slides -->';
			endwhile; wp_reset_query();
		$travelify_featured_post_slider .= '</div>
		<nav id="controllers" class="clearfix">
		</nav><!-- #controllers --></section><!-- .featured-slider -->';
	}
	echo $travelify_featured_post_slider;
}


/***** REPLACE ARCHIVE LOOP FROM TRAVELIFY THEME *****/
function travelify_theloop_for_archive() {
	global $post;

	if (is_post_type_archive('trip')) {
		echo '<h2>NER Multi-Day Trips</h2>';
		echo '<p>Our trips cover many of the best motorcycling regions in the East. The rides are the result of months of planning and represent the best day rides from each area we have seen posted anywhere.</p>';
		echo '<p><a href="' . esc_url(site_url('/attending-ner-trips')) . '" target="_blank">How NER Trips Work</a></p>';
	}

	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			do_action( 'travelify_before_post' );
			// Here we need logic to choose template parts based on what styling
			// is needed for the different archive views.

			switch (get_post_type()) {
				case 'route':
					get_template_part('content','archive-route');
					break;
				case 'restaurant':
					get_template_part('content','archive-restaurant');
					break;
				case 'hotel':
					get_template_part('content','archive-hotel');
					break;
				case 'scenicview':
					get_template_part('content','archive-scenicview');
					break;
				case 'attraction':
					get_template_part('content','archive-attraction');
					break;
				case 'campground':
					get_template_part('content','archive-campground');
					break;
				case 'trip':
					get_template_part('content','archive-trip');
					break;
				default:

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
			switch (get_post_type()) {
				case 'locale-details':
					get_template_part('content','locale-details');
					break;
				case 'route':
					get_template_part('content','route');
					break;
				case 'restaurant':
					get_template_part('content','restaurant');
					break;
				case 'hotel':
					get_template_part('content','hotel');
					break;
				case 'scenicview':
					get_template_part('content','scenicview');
					break;
				case 'attraction':
					get_template_part('content','attraction');
					break;
				case 'campground':
					get_template_part('content','campground');
					break;
				case 'trip':
					get_template_part('content','trip');
					// load script for collapible div sections in Trip template
					wp_enqueue_script('collapsingsection', get_stylesheet_directory_uri() . '/library/js/collapsingsection.js');
					break;
				case 'event':
					get_template_part('content','event');
					break;
				default:
					get_template_part('content','single');
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

/****** REPLACE SINGLE PAGE LOOP FROM TRAVELIFY THEME ******/
function travelify_theloop_for_page() {
	global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			do_action( 'travelify_before_post' );
			if (is_page('b-o-n-e')) {
				get_template_part('content', 'page-b-o-n-e');
			} elseif (is_page('best-of-appalachia')) {
				get_template_part('content', 'page-b-o-a');
			} elseif (is_page('beyond-the-east')) {
					get_template_part('content', 'page-beyond-the-east');
			} else {
				get_template_part('content', 'page');
				// load script for collapible div sections in Trip template
				wp_enqueue_script('collapsingsection', get_stylesheet_directory_uri() . '/library/js/collapsingsection.js');

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

/****** REPLACE SEARCH RESULTS LOOP FROM TRAVELIFY THEME ******/
function travelify_theloop_for_search() {
	global $post;

	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			do_action( 'travelify_before_post' );
			$post_type = get_post_type_object(get_post_type(get_the_ID()));
?>
	<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<article>

			<?php do_action( 'travelify_before_post_header' ); ?>

			<header class="entry-header">
    			<h3 class="entry-title">
    				<a href="<?php
						// For 'Link' post type, use URL from content for title hyperlink
						// and open in a new browser tab
						if (has_post_format('link')) {
							$myLink = get_my_url();
							echo $myLink; ?>" target="_blank
						<?php } else {
							the_permalink();
						} ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?>
						<?php
						if (!has_post_format('link')) {
							echo '<span style="font-size:.75em">(' . $post_type->labels->singular_name . ')</span>';
						} ?>
						</a>
					</h3><!-- .entry-title -->

  		</header>

  		<?php do_action( 'travelify_after_post_header' ); ?>
			<?php do_action( 'travelify_before_post_content' ); ?>
			<div class="entry-content clearfix">
  			<?php the_excerpt(); ?>
  		</div>

  		<?php do_action( 'travelify_after_post_content' ); ?>
		</article>
	</section>
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


/**** CHANGE SORTING OF ARCHIVE LISTS TO ASC BY custom_sort_order, then TITLE */
add_action('pre_get_posts', 'apply_custom_sort');
function apply_custom_sort($query) {
	if(! is_admin() && $query->is_archive() && $query->is_main_query()) {
		$query->set('meta_query', array(
			'relation' => 'OR',
			array(
				'key' => 'custom_sort_order',
				'type' => 'NUMERIC',
				'compare' => 'EXISTS',
			),
			array(
				'key' => 'custom_sort_order',
				'type' => 'NUMERIC',
				'compare' => 'NOT EXISTS',
				'value' => 'null',
			),
		));
		$query->set('orderby', array(
			'meta_value_num' => 'ASC',
			'title' => 'ASC',
		));
	}
	return $query;
}
// OLD VERSION of above
// add_action('pre_get_posts', 'sort_order_title');
// function sort_order_title($query) {
// 	if(is_archive()):
// 		//If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
// 		$query->set('order', 'ASC');
// 		$query->set('orderby', 'title');
// 	endif;
// };


/***** ADD FILTER TO PROCESS SHORTCODES IN ACF RATINGS-RELATED FIELDS *****/
add_filter('acf/format_value/name=gpx_file','do_shortcode');

/*** FILTER TO ALLOW GPX FILE UPLOADS ****/
function add_custom_mime_types($mimes = array()) {
  // $mimes['gpx'] = 'application/gpx+xml';
  $mimes['gpx'] = 'application/gpx+xml';
	$mimes['gbd'] = 'application/octet-stream';
	$mimes['bmp'] = 'image/bmp';
  return $mimes;
}
add_filter('upload_mimes', 'add_custom_mime_types',1,1);

/*** SUBSCRIBER LOCK-DOWN  ***/
// Re-direct subscriber accounts out of admin and to homepage
add_action('admin_init', 'redirectSubToFrontend');
function redirectSubToFrontEnd() {
  $ourCurrentUser = wp_get_current_user();
  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber' AND !defined('DOING_AJAX')) {
    wp_redirect(site_url('/'));
    exit;
  }
}

// remove top admin bar for logged in subscribers
add_action('wp_loaded', 'noSubAdminBar');
function noSubAdminBar() {
  $ourCurrentUser = wp_get_current_user();
  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    show_admin_bar(false);
  }
}

// Customize login screen
add_filter('login_headerurl', 'ourHeaderUrl');
function ourHeaderUrl() {
  return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCSS');
function ourLoginCSS() {
	wp_enqueue_style( 'ner-style', get_stylesheet_uri(), NULL, microtime());
  // wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

add_filter('login_headertext', 'ourLoginTitle');
function ourLoginTitle() {
  return get_bloginfo('name');
}


// Shortcode to use for copying text from a custom field to main content field
// add_shortcode('update-posts-from-custom-fields', 'upfc_fields321');
function upfc_fields321() {
	$cpt = 'scenicview'; // slug of custom post type to process
	$cpt_field = 'ner_notes'; // field name to copy from

  $args = array(
    'post_type' => $cpt,
		// 'p' => '8386',
    'meta_query' => array(
        array(
            'key'     => $cpt_field,
            'value'   => '',
            'compare' => '!=',
        ),
    ),
    'post_count' => '-1'
  );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
      $post_counter = $save_counter = $delete_counter = 0;
      while ( $the_query->have_posts() ) {
          $the_query->the_post();
          global $post; // not sure if this is needed, but it can't hurt
          ?>
          <div>
              <h3><?php the_title(); ?></h3>
							<div>
								<p><b>"<?php echo $cpt_field; ?>" Field Content</b></p>
								<?php the_field($cpt_field); ?>
              </div>
              <div>
								<p><b>Original Content Field</b></p>
								<?php the_content(); ?>
              </div>
          <?php $post_counter++;
          $post->post_content = get_post_meta($post->ID, $cpt_field, true);
          $post->post_content_filtered = '';
          $post->post_excerpt = '';
          // uncomment next line when you are ready to commit changes
          // wp_update_post($post); $save_counter++;
          // uncomment next line if you want to delete the meta key (useful if you have too many posts and want to do them in batchces)
          // delete_post_meta($post->ID, $cpt_field); $delete_counter++;
					?>
					<div>
						<p><b>Modified Content Field</b></p>
						<?php echo $post->post_content; ?>
					</div>
				</div>
				<?php
      }
    } else {
        // no posts found
    };
    echo
        '<hr>Processed posts: ' . $post_counter .
        '<hr>Saved posts:' . $save_counter .
        '<hr>Deleted meta from: ' . $delete_counter . ' posts';
    wp_reset_postdata() ;
}

?>
