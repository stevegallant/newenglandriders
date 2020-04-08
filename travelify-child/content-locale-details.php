<?php ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <article>
    <?php do_action( 'travelify_before_post_header' ); ?>
    <header class="entry-header">
      <div class="locale-header">
        <h2 class="entry-title">
          <?php the_title(); ?>
          Ride Planning
        </h2><!-- .entry-title -->


        <div class="locale-photo">
          <?php
          // Display featured image if there is one
          if (has_post_thumbnail()) { ?>
            <div class="element-photo-zoomed">
              <?php
              $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
              echo '<a href="' . $full_image_url[0] . '" target="_blank">';
              the_post_thumbnail();
              echo '</a>'; ?>
            </div>
          <?php } ?>
        </div>

      </div>
    </header>
    <?php do_action( 'travelify_after_post_header' ); ?>
    <?php do_action( 'travelify_before_post_meta' ); ?>

      <div class="entry-meta-bar clearfix">
        <div class="entry-meta">
            <?php if ( comments_open() ) { ?>
                <span class="comments"><?php comments_popup_link( __( 'No Comments', 'travelify' ), __( '1 Comment', 'travelify' ), __( '% Comments', 'travelify' ), '', __( 'Comments Off', 'travelify' ) ); ?></span>
            <?php } ?>
        </div><!-- .entry-meta -->
      </div>

      <?php do_action( 'travelify_after_post_meta' ); ?>
      <?php do_action( 'travelify_before_post_content' ); ?>

      <div class="entry-content clearfix">

        <!-- Embedded map centered on route element -->
        <?php
        // Get locale taxonomy slug to retrieve correct map ID from global array
        $locale_slug = get_field('locale_abbreviation');
        // $locale_slug = get_the_terms($post->ID, 'locale')[0]->slug;
        global $map_ids; // defined in site plugin
        $map_id = $map_ids[$locale_slug];
        // Assemble URL for embedded map
        $map_url = 'https://www.google.com/maps/d/u/0/embed?mid=';
        $map_url .= $map_id;
        if (get_field('map_center_lat') && get_field('map_center_long')) {
          $map_url .= '&ll=' . get_field('map_center_lat') . '%2C' . get_field('map_center_long');
          $map_url .= '&z=' . get_field('map_zoom');
        }
        ?>
        <div>
          <iframe src="<?php echo $map_url;?>" width="100%" height="320px" frameborder="0" style="border:0"></iframe>
        </div>

        <p><a href="<?php echo get_bloginfo('url') . '/filtering-ner-google-custom-maps-view'; ?>" target="_blank">Tips for Filtering Map View</a></p>
        <?php
        // Store partial path for GPX download links
        $dl_path = get_bloginfo('url') . '/download/' . $locale_slug . '-';
        ?>
        <p><strong>Listings & GPX Downloads</strong></p>
        <div class="route-element-btn-container">
          <div class="route-element-btn-group">
            <a href="<?php echo get_bloginfo('url') . '/route/?locale='. $locale_slug . '&routescale=segment' . '&surface=paved'; ?>" class="btn-route-element-list" target="_blank">Roads</a>
            <a href="<?php echo $dl_path . 'roads/';?>" class="btn-route-element-gpx">GPX</a>
          </div> <!-- route-element-btn-group -->
          <div class="route-element-btn-group">
            <a href="<?php echo get_bloginfo('url') . '/restaurant/?locale='. $locale_slug;?>" class="btn-route-element-list" target="_blank">Restaurants</a>
            <a href="<?php echo $dl_path . 'restaurants/';?>" class="btn-route-element-gpx">GPX</a>
          </div> <!-- route-element-btn-group -->
          <div class="route-element-btn-group">
            <a href="<?php echo get_bloginfo('url') . '/scenicview/?locale='. $locale_slug;?>" class="btn-route-element-list" target="_blank">Scenic Views</a>
            <a href="<?php echo $dl_path . 'scenicviews/';?>" class="btn-route-element-gpx">GPX</a>
          </div> <!-- route-element-btn-group -->
          <div class="route-element-btn-group">
            <a href="<?php echo get_bloginfo('url') . '/attraction/?locale='. $locale_slug;?>" class="btn-route-element-list" target="_blank">Attractions</a>
            <a href="<?php echo $dl_path . 'attractions/';?>" class="btn-route-element-gpx">GPX</a>
          </div> <!-- route-element-btn-group -->
          <div class="route-element-btn-group">
            <a href="<?php echo get_bloginfo('url') . '/hotel/?locale='. $locale_slug;?>" class="btn-route-element-list" target="_blank">Hotels</a>
            <a href="<?php echo $dl_path . 'hotels/';?>" class="btn-route-element-gpx">GPX</a>
          </div> <!-- route-element-btn-group -->
          <div class="route-element-btn-group">
            <a href="<?php echo get_bloginfo('url') . '/campground/?locale='. $locale_slug;?>" class="btn-route-element-list" target="_blank">Campgrounds</a>
            <a href="<?php echo get_bloginfo('url') . '/download/campgrounds';?>" class="btn-route-element-gpx">GPX</a>
          </div> <!-- route-element-btn-group -->
          <div class="route-element-btn-group">
            <a href="<?php echo get_bloginfo('url') . '/route/?locale='. $locale_slug . '&surface=unpaved';?>" class="btn-route-element-list" target="_blank">Dirt Roads</a>
            <a href="<?php echo $dl_path . 'unpaved/';?>" class="btn-route-element-gpx">GPX</a>
          </div> <!-- route-element-btn-group -->
          <div class="route-element-btn-group">
            <a href="<?php echo get_bloginfo('url') . '/route/?locale='. $locale_slug . '&routescale=day-ride'; ?>" class="btn-route-element-list" target="_blank">Complete Day-Rides</a>
            <!-- <a href="#" class="btn-route-element-gpx" disabled>N/A</a> -->
          </div> <!-- route-element-btn-group -->

        </div> <!-- end route-element-btn-container -->

        <hr />
        <p><?php the_field("description"); ?></p>

        <!-- Section for external links related to Locale -->
        <div id="locale-links-container">
          <?php if (get_field("tourism_link")) { ?>
            <a href="<?php the_field("tourism_link");?>" target="_blank">
              <div class="ext-locale-link">
                Official Tourism Site
              </div>
            </a>
          <?php } ?>

          <?php if (get_field("roadwork_link")) { ?>
            <a href="<?php the_field("roadwork_link");?>" target="_blank">
              <div class="ext-locale-link">
                Roadwork Info
              </div>
            </a>
          <?php } ?>

          <?php if (get_field("roadside_america_link")) { ?>
            <a href="<?php the_field("roadside_america_link");?>" target="_blank">
              <div class="ext-locale-link">
                Roadside America
              </div>
            </a>
          <?php } ?>

          <?php if (get_field("pictures_link")) { ?>
            <a href="<?php the_field("pictures_link");?>" target="_blank">
              <div class="ext-locale-link">
                Photos
              </div>
            </a>
          <?php } ?>

        </div> <!-- end locale-links-container -->
        <br />
        <?php if (get_field("other_locale_links")) { ?>
          <h3>More Useful Links</h3>
          <?php the_field("other_locale_links");?>

        <?php } ?>

        <?php //the_content();
        if( is_single() ) {
          $tag_list = get_the_tag_list( '', __( ', ', 'travelify' ) );
          if( !empty( $tag_list ) ) {
            ?>
            <div class="tags">
              <?php echo $tag_list; ?>
            </div>
            <?php
          }
        }

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
      do_action( 'travelify_after_post_content' );
      do_action( 'travelify_before_comments_template' );
      comments_template();
      do_action ( 'travelify_after_comments_template' );
      ?>

  </article>
</section>
