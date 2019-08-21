<?php ?>
<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <article>

    <?php do_action( 'travelify_before_post_header' ); ?>

      <?php do_action( 'travelify_after_post_header' ); ?>

      <?php do_action( 'travelify_before_post_content' ); ?>

    <?php
    if( has_post_thumbnail() ) {
      $image = '';
        $title_attribute = apply_filters( 'the_title', get_the_title( $post->ID ) );
        $image .= '<figure class="post-featured-image">';
        $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
        $image .= get_the_post_thumbnail( $post->ID, 'featured', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
        $image .= '</figure>';

        echo $image;
      }
      ?>
    <header class="entry-header">
        <h2 class="entry-title">
          <a href="<?php
          // For 'Link' post type, use URL from content for title hyperlink
          // and open in a new browser tab
            if (has_post_format('link')) {
              $myLink = get_my_url();
              echo $myLink; ?>" target="_blank
            <?php } else {
              // else just use the normal permalink
              the_permalink();
            } ?>" title="<?php the_title_attribute();?>"><?php the_title();?></a>
        </h2><!-- .entry-title -->
      </header>

      <div class="entry-content clearfix">
        <?php the_excerpt(); ?>
      </div>

      <?php do_action( 'travelify_after_post_content' ); ?>

      <?php do_action( 'travelify_before_post_meta' ); ?>

      <div class="entry-meta-bar clearfix">
        <div class="entry-meta">
            <?php travelify_posted_on(); ?>
            <?php if( has_category() ) { ?>
                <span class="category"><?php the_category(', '); ?></span>
              <?php } ?>
            <?php if ( comments_open() ) { ?>
                <span class="comments"><?php comments_popup_link( __( 'No Comments', 'travelify' ), __( '1 Comment', 'travelify' ), __( '% Comments', 'travelify' ), '', __( 'Comments Off', 'travelify' ) ); ?></span>
              <?php } ?>
        </div><!-- .entry-meta -->
        <?php
        echo '<a class="readmore" href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">'.__( 'Read more', 'travelify' ).'</a>';
        ?>
      </div>

      <?php do_action( 'travelify_after_post_meta' ); ?>

  </article>
</section>
