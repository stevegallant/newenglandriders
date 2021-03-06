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
        <div class="element-photo-wrapper">
          <?php
          if (has_post_thumbnail()) { ?>
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
            <table>
            <tr>
              <td><?php the_field('campground_address');?></td>
            </tr>
            <tr>
              <td><?php
                the_field('map_center_lat');
                echo ', ';
                the_field('map_center_long');?>
              </td>
            </tr>
            <tr>
              <td><a href="<?php the_field('campground_website');?>" target="_blank">Website</a></td>
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
          <p>One review per rider. Learn more about <a href="<?php echo esc_url(site_url('/reviews-and-ratings'));?>" target="_blank">Rider Reviews and Ratings</a></p>
            <?php if (is_user_logged_in()) { ?>
              <p>You can view/edit all your previous reviews via your <a href="<?php echo esc_url(site_url('/my-reviews')); ?>" target="_blank">My Reviews</a> dashboard page.</p>
            <?php } else { ?>
              <p>You must <a href="<?php echo esc_url(wp_login_url(get_permalink()));?>">Log In</a> to leave a review. Read about <a href="<?php echo esc_url(site_url('/user-accounts'));?>" target="_blank">NER User Accounts</a> before attempting to register.</p>
            <?php } ?>
          <div>
            <strong>Average Rider Rating</strong>
            <?php echo do_shortcode('[cbxmcratingreview_postavgrating form_id="5" details="1"]'); ?>
            <br />
            <?php echo do_shortcode('[cbxmcratingreview_postreviews  form_id="5"]'); ?>
            <br />
            <?php echo do_shortcode('[cbxmcratingreview_reviewform form_id="5"]'); ?>
          </div>
        <?php

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
