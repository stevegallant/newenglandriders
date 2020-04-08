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

        <!-- Embedded map centered on route element -->
        <?php
        // Get locale taxonomy slug to retrieve correct map ID from global array
        $locale_slug = get_the_terms($post->ID, 'locale')[0]->slug;
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
        <div class="element-map-wrapper">
          <iframe class="element-map-zoomed" src="<?php echo $map_url;?>" width="300" height="300" frameborder="0" style="border:0"></iframe>
        </div>

        <div class="element-data-wrapper">
            <table>
            <tr>
              <td><?php the_field('restaurant_address');?></td>
            </tr>
            <tr>
              <td><a href="<?php the_field('restaurant_website');?>">Restaurant's Website</a></td>
            </tr>
            <tr>
              <td><a href="<?php the_field('restaurant_reviews');?>">Customer Reviews</a></td>
            </tr>
          </table>
        </div> <!-- end element-data-wrapper -->
        <div style="clear: both;"></div>

        <?php if($post->post_content !== '') {?>
          <h3>NER Notes</h3>
          <?php the_content();?>
        <?php } ?>
        <hr />
        <h3>Rated by Riders</h3>
        <p>One per rider. You can edit your previous reviews via your <a href="<?php echo esc_url(site_url('/my-reviews')); ?>" target="_blank">My Reviews</a> dashboard page.</p>
        <p>Information on <a href="<?php echo esc_url(site_url('/reviews-and-ratings'));?>" target="_blank">Reviews and Ratings</a></p>
        <div>
          <strong>Average Rider Rating</strong>
          <?php echo do_shortcode('[cbxmcratingreview_postavgrating form_id="2" details="1"]'); ?>
          <br />
          <?php echo do_shortcode('[cbxmcratingreview_postreviews  form_id="2"]'); ?>
          <br />
          <?php echo do_shortcode('[cbxmcratingreview_reviewform form_id="2"]'); ?>
        </div>
        <?php
        // hiding the main body content field for this Custom Post Type
        // the_content();

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
