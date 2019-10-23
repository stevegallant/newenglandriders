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

          // Restore original page query data
        	wp_reset_postdata();
         ?>

         <!-- Display form for selecting locale -->
          <form action="<?php echo get_permalink(); ?>" method="GET" role="search">
            <div class="localeselectbox">
              <?php
              // Assemble select dropdown element for Locale selection form
              //if (is_array($locale_names)) { ?>
                <select name="locale">
                  <option value="" selected="selected">Select locale</option>
                  <?php // Use locale names from array for options in drop-down
                  foreach ($locale_names as $term) { ?>
                    <option value="<?php echo $term; ?>"><?php echo $term; ?></option>';
                  <?php } ?>
                </select>

              <?php
              //} // echo $select_locale; ?>
            </div>
            <p><input type="submit" value="Go!" class="button" /></p>
          </form>
          <br />

          <?php
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
                  'compare' => 'LIKE',
                ),
              ),
            );

            // Run new custom query for specific locale
            $locale_query = new WP_Query($args2);
            while ($locale_query->have_posts()) {
              $locale_query->the_post(); ?>

              <div class="entry-content clearfix">
                <div class="locale-map-wrapper">
                  <iframe class="locale-map" src="<?php the_field('map_embed');?>" width="100%" height="320px" frameborder="0" style="border:0"></iframe>
                </div>

                <div class="locale-resources">
                  <div class="locale-resource-links">
                    <a href="<?php the_field('list_roads');?>" class="locale-resource-list">Roads</a>
                    <a href="<?php the_field('gpx_roads');?>" class="locale-resource-gpx">GPX</a>
                  </div> <!-- locale-resource-links -->
                  <div class="locale-resource-links">
                    <a href="<?php the_field('list_restaurants');?>" class="locale-resource-list">Restaurants</a>
                    <a href="<?php the_field('gpx_restaurants');?>" class="locale-resource-gpx">GPX</a>
                  </div> <!-- locale-resource-links -->
                  <div class="locale-resource-links">
                    <a href="<?php the_field('list_scenicviews');?>" class="locale-resource-list">Scenic Views</a>
                    <a href="<?php the_field('gpx_scenicviews');?>" class="locale-resource-gpx">GPX</a>
                  </div> <!-- locale-resource-links -->
                  <div class="locale-resource-links">
                    <a href="<?php the_field('list_attractions');?>" class="locale-resource-list">Attractions</a>
                    <a href="<?php the_field('gpx_attractions');?>" class="locale-resource-gpx">GPX</a>
                  </div> <!-- locale-resource-links -->
                  <div class="locale-resource-links">
                    <a href="<?php the_field('list_hotels');?>" class="locale-resource-list">Hotels</a>
                    <a href="<?php the_field('gpx_hotels');?>" class="locale-resource-gpx">GPX</a>
                  </div> <!-- locale-resource-links -->
                  <div class="locale-resource-links">
                    <a href="<?php the_field('list_campgrounds');?>" class="locale-resource-list">All Campgrounds</a>
                    <a href="<?php the_field('gpx_campgrounds');?>" class="locale-resource-gpx">GPX</a>
                  </div> <!-- locale-resource-links -->
                </div> <!-- end locale-resources -->
                <br />
                <hr />
                <p><?php the_field("description"); ?></p>
                <?php

                wp_link_pages( array(
                  'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'travelify' ),
                  'after'             => '</div>',
                  'link_before'       => '<span>',
                  'link_after'        => '</span>',
                  'pagelink'          => '%',
                  'echo'              => 1
                     ) );
                     ?>
              </div>
            <?php
            }
          }
          // Restore original post data
        	wp_reset_postdata();
          ?>
        </div> <!-- locale-chooser-form -->
      </div> <!-- end entry-content -->

      <?php
      do_action( 'travelify_after_post_content' );
      do_action( 'travelify_before_comments_template' );
      comments_template();
      do_action ( 'travelify_after_comments_template' );
      ?>

  </article>
</section>
