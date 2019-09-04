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
            <?php // travelify_posted_on(); ?>
            <?php // if( has_category() ) { ?>
                <span class="category"><?php the_taxonomies(', '); ?></span>
              <?php // } ?>
            <?php if ( comments_open() ) { ?>
                <span class="comments"><?php comments_popup_link( __( 'No Comments', 'travelify' ), __( '1 Comment', 'travelify' ), __( '% Comments', 'travelify' ), '', __( 'Comments Off', 'travelify' ) ); ?></span>
              <?php } ?>
        </div><!-- .entry-meta -->
      </div>

      <?php do_action( 'travelify_after_post_meta' ); ?>
      <?php do_action( 'travelify_before_post_content' ); ?>

      <div class="entry-content clearfix">
        <div class="route-sources">
          <?php
          if(get_field("gpx_file")) {?>
            <a href="<?php the_field('gpx_file');?>"><span class="route-source-link">GPX</span></a>
          <?php }

          if(get_field("gpx-shaping")) {?>
            <a href="<?php the_field('gpx-shaping');?>"><span class="route-source-link">GPX-Shaping</span></a>
          <?php }

          if(get_field("google_maps_nav")) {?>
            <a href="<?php the_field('google_maps_nav');?>"><span class="route-source-link">Google Nav</span></a>
          <?php } ?>
        </div> <!-- end route-sources -->
        <iframe src="<?php the_field('map_embed');?>" width="auto" height="300" frameborder="0" style="border:0"></iframe>
        <table class="route-data-table">
          <tr>
            <td><b>Miles</b> </td>
            <td><?php the_field('mileage');?></td>
          </tr>
          <tr>
            <td><b>Endpoints</b> </td>
            <td><?php the_field('endpoint_1');?>, <?php the_field('endpoint_2');?></td>
          </tr>
          <tr>
            <td><b>Surface</b> </td>
            <td><?php the_field('surface');?></td>
          </tr>
          <tr>
            <td><b>Description</b> </td>
            <td><?php the_field('description');?></td>
          </tr>
          <tr>
            <td><b>Turn By Turn</b> </td>
            <td><?php the_field('turn-by-turn');?></td>
          </tr>

        </table> <!-- end route-data-table -->
        <h3>Rated by Riders</h3>
        <p>One per rider. If you need to update your rating: take a copy of the text, delete and recreate.</p>
        <div>
          <strong>Average Rating</strong> [cbxmcratingreview_postavgrating]
          [cbxmcratingreview_postreviews]
          [cbxmcratingreview_reviewform form_id="1"]
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
