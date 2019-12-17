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
        <!-- <div class="element-map-wrapper">
          <iframe class="element-map-zoomed" src="<?php //the_field('map_embed');?>" width="300" height="300" frameborder="0" style="border:0"></iframe>
        </div> -->

        <div class="element-photo-wrapper">
          <?php
          //$image = get_field('scenicview_photo');
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
        
        <?php
        $scenicview_coords = get_field('map_center_lat') . ',' . get_field('map_center_long');
        $scenicview_map_url = 'https://www.google.com/maps/search/?api=1&query=' . $scenicview_coords;
        ?>

        <div class="element-data-wrapper">
            <table>
            <tr>
              <td><?php the_field('scenicview_address');?></td>
            </tr>
            <tr>
              <td>
                <a href="<?php echo $scenicview_map_url; ?>" target="_blank"><?php echo $scenicview_coords; ?></a>
              </td>
            </tr>

          </table>
        </div> <!-- end element-data-wrapper -->
        <div style="clear: both;"></div>

        <?php if(get_field("scenicview_notes")) {?>
          <h3>NER Notes</h3>
          <?php the_field('scenicview_notes');?>
        <?php } ?>

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
