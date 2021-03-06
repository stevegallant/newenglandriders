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
              <td><?php the_field('attraction_address');?></td>
            </tr>
            <tr>
              <td><?php
                $map_url = 'https://www.google.com/maps/search/?api=1&query=';
                $map_url .= get_field('map_center_lat') . ',' . get_field('map_center_long');
                $coords = get_field('map_center_lat') . ', ' . get_field('map_center_long');?>
                <a href="<?php echo $map_url; ?>" target="_blank"><?php echo $coords; ?></a>
              </td>
            </tr>
            <tr>
              <td><a href="<?php the_field('attraction_website');?>" target="_blank">Website</a></td>
            </tr>

          </table>
        </div> <!-- end element-data-wrapper -->
        <div style="clear: both;"></div>

        <?php if($post->post_content !== '') {?>
          <h3>NER Notes</h3>
          <?php the_content();?>
        <?php } ?>

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
