<?php ?>
<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <article>
    <?php do_action( 'travelify_before_post_header' ); ?>
    <header class="entry-header">
        <h2 class="entry-title">
          <?php the_title(); ?>
        </h2><!-- .entry-title -->
      </header>

      <?php do_action( 'travelify_after_post_header' ); ?>
      <?php do_action( 'travelify_before_post_content' ); ?>

      <div class="entry-content clearfix">
        <?php the_content(); ?>

        <div class="locale-chooser-form">
          <?php
          // Run new custom query for select element
          $all_locales_query = new WP_Query(array(
            'post_type' => 'locale-details',
            'tax_query' => array(
              array(
                'taxonomy' => 'locale',
                'field' => 'slug',
                'terms' => array('appalachia', 'northeast', 'cn-central', 'cn-atlantic'),
                'operator' => 'NOT IN',
              ),
            ),
        		'posts_per_page' => '-1',
          ));

          // start sub-loop and create array of unique Locale names
          if ($all_locales_query->have_posts()) {
              $locale_names = array();
              while ($all_locales_query->have_posts()) {
                $all_locales_query->the_post();
                $locale_name = get_post_meta(get_the_ID(), 'locale_name', true);
                // populate array with all unique locale names (non-dupe)
          			if (!in_array($locale_name, $locale_names)) {
          				$locale_names[] = $locale_name;
          			}
              }
          } //end sub-loop
          asort($locale_names);
          // Restore original page query data after populating select element
        	wp_reset_postdata();
         ?>

         <!-- Display form for selecting locale -->
          <form action="<?php echo get_permalink(); ?>" method="GET" role="search">
            <select name="locale" class="locale-select-box">
              <option value="" selected="selected">Select riding locale</option>
              <?php // Use locale names from array for options in drop-down
              foreach ($locale_names as $term) { ?>
                <option value="<?php echo $term; ?>"><?php echo $term; ?></option>';
              <?php } ?>
            </select>
            <input type="submit" value="Go!" class="button" />
          </form>
        </div> <!-- locale-chooser-form -->
      </div> <!-- end entry-content -->

      <?php
      do_action( 'travelify_after_post_content' );
      do_action( 'travelify_before_comments_template' );
      comments_template();
      do_action ( 'travelify_after_comments_template' );
      ?>

  </article>
</section> <!-- END BOA page content section -->




<?php
// Run third query for specific locale chosen by user
$chosenLocale = $_GET['locale'];
if ($chosenLocale) {
  // Set arguments for new WP_Query for specific locale
  $args2 = array(
    'post_type' => 'locale-details',
    'posts_per_page' => '-1',
    'meta_query' => array(
      array(
        'key' => 'locale_name',
        'value' => $chosenLocale,
        'compare' => '=',
      ),
    ),
  );

  // Run new custom query for specific locale
  $locale_query = new WP_Query($args2);
  while ($locale_query->have_posts()) {
    $locale_query->the_post();
    get_template_part('content', 'locale-details');
  }

  // Restore original post data
  wp_reset_postdata();

}  // end if

?>
