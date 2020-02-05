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
    <?php do_action( 'travelify_before_post_meta' ); ?>

      <div class="entry-meta-bar clearfix">
        <div class="entry-meta">
            <span class="category"><?php the_taxonomies(', '); ?></span>
        </div><!-- .entry-meta -->
      </div>

      <?php do_action( 'travelify_after_post_meta' ); ?>
      <?php do_action( 'travelify_before_post_content' ); ?>

      <div class="entry-content clearfix">
        <div>
          <p><?php the_field('intro_text'); ?> </p>
          <p><a href="<?php echo home_url('/?p=2560'); ?>" target="_blank">How NER trips work.</a></p>
        </div>

        <!-- Show trip dates if populated -->
        <?php if (get_field('start_date')) { ?>
          <div class="trip-dates-container">
            <div class="trip-dates">
              <?php
              $startDate = DateTime::createFromFormat('Ymd', get_field('start_date'));
              $endDate = DateTime::createFromFormat('Ymd', get_field('end_date'));
              if ($startDate->format('F') == $endDate->format('F')) {
                $endFormat = 'd, Y';
              } else {
                $endFormat = 'F d, Y';
              }
              ?>
              Next Trip: <?php echo $startDate->format('F d') . ' - ' . $endDate->format($endFormat); ?>
            </div>
          </div>
          <br />
        <?php } ?>
        <section id="trip-booking">
          <h3>Booking</h3>
          <div class="element-photo-wrapper">
            <?php
            // Display featured image if there is one
            if (has_post_thumbnail()) { ?>
              <!-- <img class="element-photo-zoomed" src="<?php //echo esc_url($image['url']);?>" alt="<?php //echo esc_url($image['alt']); ?>" width="300" height="300" /> -->
              <div class="element-photo-zoomed">
                <?php
                $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                echo '<a href="' . $full_image_url[0] . '" target="_blank">';
                the_post_thumbnail(array(300,300));
                echo '</a>'; ?>
              </div>
            <?php } ?>
          </div>

          <div class="element-data-wrapper">
            <?php
            $relatedHotel = get_field('trip_hotel')[0];

            ?>
              <table>
              <tr>
                <td colspan="2">
                  <a href="<?php echo get_the_permalink($relatedHotel);?>" target="_blank"><?php echo get_the_title($relatedHotel)?></a>
                </td>
              </tr>
              <tr>
                <td colspan="2"><?php the_field('hotel_address', $relatedHotel->ID); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php the_field('hotel_phone'); ?></td>
              </tr>
              <tr>
                <td><strong>Group Code</strong></td>
                <td><?php the_field('group_code'); ?></td>
              </tr>
              <tr>
                <td><strong>Deadline</strong></td>
                <td><?php the_field('reservation_deadline'); ?></td>
              </tr>
              <tr>
                <td><strong>Cancel</strong></td>
                <td><?php the_field('cancellation_policy'); ?></td>
              </tr>
            </table>
          </div> <!-- end element-data-wrapper -->
          <div style="clear: both;"></div>

          <?php if(get_field("booking_notes")) {?>
          <div>
            <p><?php the_field('booking_notes'); ?></p>
          </div>
          <?php } ?>
        </section>

        <section id="trip-destination">
          <h3>Destination</h3>
          <?php the_field('destination_notes'); ?>
          <p><a href="<?php the_field('amenities_map'); ?>">Destination Amenties Map</a></p>
          <p>Recommended Area Restaurants</p>
          <p>Recommended Area Attractions/Views</p>
          <table class="tbl-related-attractions">
          <?php
          $relatedAttractions = get_field('related_attractions');
          foreach($relatedAttractions as $attraction) { ?>
            <tr style="min-width: 33%">
              <td class="col1"><a href="<?php echo get_the_permalink($attraction); ?>" target="_blank"><?php echo get_the_title($attraction); ?></a></td>
              <td><?php echo wp_trim_words($attraction->ner_notes,20); ?></td>
            </tr>
          <?php } ?>
          </table>
        </section>

        <section id="trip-rides">
          <h3>Trip Rides</h3>
          <div class="rides-map">
            <?php
            $rides_map = get_field('rides_map_image');
            if (!empty($rides_map)) { ?>
              <img src="<?php echo esc_url($rides_map['url']); ?>" alt="<?php echo esc_attr($rides_map['alt']); ?>"/>
            <?php } ?>
          </div>
        </section>

        <div>
          <?php
          $relatedRides = get_field('related_rides');
          foreach($relatedRides as $ride) { ?>
            <div class="trip-ride-card">
              <span class="trip-ride-card-title"><strong><a href="<?php echo get_the_permalink($ride); ?>" target="_blank"><?php echo get_the_title($ride); ?></a></strong></span>
              <br />
              <p><?php echo wp_trim_words($ride->description,30); ?></p>
              <div class="route-element-btn-container">
                <?php
                if(get_field("gpx_file", $ride->ID)) {?>
                  <a href="<?php the_field('gpx_file', $ride->ID);?>"><span class="btn-route-file-dl">GPX</span></a>
                <?php }

                if(get_field("ride-preview-pdf", $ride->ID)) {?>
                  <a href="<?php the_field('ride-preview-pdf', $ride->ID);?>"><span class="btn-route-file-dl">Ride Preview</span></a>
                <?php } ?>
              </div> <!-- end route-element-btn-container -->

            </div> <!-- end trip-ride-card -->
          <?php } ?>
        </div>

        <?php
        // hiding the main body content field for this Custom Post Type
        // the_content();
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
