<?php ?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <article>
    <?php do_action( 'travelify_before_post_header' ); ?>
    <header class="entry-header">
      <div class="locale-header">
        <h2 class="entry-title">
          <?php the_title(); ?>
        </h2><!-- .entry-title -->
        <div class="locale-photo">
          <?php
          if(get_field("feature_photo")) {?>
            <a href="<?php the_field('feature_photo');?>" target="_blank"><img src="<?php the_field('feature_photo');?>" /></a>
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

        <div class="locale-map-wrapper">
          <iframe class="locale-map" src="<?php the_field('map_embed');?>" width="100%" height="320px" frameborder="0" style="border:0"></iframe>
        </div>

        <div class="locale-resources">
          <div class="locale-resource-links">
            <a href="<?php the_field('list_roads');?>" class="locale-resource-list" target="_blank">Roads</a>
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
