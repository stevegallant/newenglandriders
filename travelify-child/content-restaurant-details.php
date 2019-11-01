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
        <div class="element-map-wrapper">
          <iframe class="element-map-zoomed" src="<?php the_field('map_embed');?>" width="300" height="300" frameborder="0" style="border:0"></iframe>
        </div>
        <div class="element-data-wrapper">
            <table>
            <tr>
              <td><?php the_field('restaurant_address');?></td>
            </tr>
            <tr>
              <td><a href="<?php the_field('restaurant_website');?>">Website</a></td>
            </tr>
            <tr>
              <td><a href="<?php the_field('yelp_reviews');?>">Yelp Reviews</a></td>
            </tr>
          </table>
        </div> <!-- end element-data-wrapper -->
        <div style="clear: both;"></div>

        <?php if(get_field("description")) {?>
          <h3>Description</h3>
          <?php the_field('description');?>
        <?php } ?>

        <h3>Rated by Riders</h3>
        <p>One per rider. If you need to update your rating: take a copy of the text, delete and recreate.</p>
        <div>
          <strong>Average Rider Rating</strong> <?php echo do_shortcode('[cbxmcratingreview_postavgrating form_id="3"]'); ?>
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
