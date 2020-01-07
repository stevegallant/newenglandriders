<?php ?>
<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <article>

    <?php
    do_action( 'travelify_before_post_header' );
    do_action( 'travelify_after_post_header' );
    do_action( 'travelify_before_post_content' );

    if (has_post_thumbnail()) {
      $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0];
    } else {
      $full_image_url = '#';
    };
    ?>

    <header class="entry-header">
      <span class="entry-title">
        <a href="<?php echo $full_image_url; ?>" title="<?php the_title_attribute();?>" target="_blank">
          <span class="scenicview-archive-thumb"><?php the_post_thumbnail(array(75,75)); ?></span>
          <?php
          echo '  ';
          the_title();?>
        </a>
      </span><!-- .entry-title -->
      <?php the_field('ner_notes'); ?>
    </header>

    <?php
    do_action( 'travelify_after_post_content' );
    do_action( 'travelify_before_post_meta' );
    ?>

    <div class="entry-meta-bar clearfix route-meta-bar">
      <div class="entry-meta">
        <span class="ital">
          <?php the_field('scenicview_address');
          $scenicview_map_url = 'https://www.google.com/maps/search/?api=1&query=';
          $scenicview_map_url .= get_field('map_center_lat') . ',' . get_field('map_center_long');
          ?>
        </span>
        <?php
        if (has_term('', 'scenicview-tag')) {
          echo get_the_term_list($post->ID, 'scenicview-tag', '',', ') . " - ";
        } ?>

      </div><!-- .entry-meta -->
      <span style="float: right;">
        <a href="<?php echo $scenicview_map_url; ?>" class="map-link-archive-view" target="_blank">Map</a>
      </span>
    </div>

    <?php do_action( 'travelify_after_post_meta' ); ?>

  </article>
</section>
