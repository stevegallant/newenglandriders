<?php ?>
<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <article>

    <?php
    do_action( 'travelify_before_post_header' );
    do_action( 'travelify_after_post_header' );
    do_action( 'travelify_before_post_content' );
    ?>

    <header class="entry-header">
      <span class="entry-title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title();?></a>
      </span><!-- .entry-title -->
    </header>

    <?php
    do_action( 'travelify_after_post_content' );
    do_action( 'travelify_before_post_meta' );
    ?>

    <div class="entry-meta-bar clearfix route-meta-bar">
      <div class="entry-meta">
        <span class="ital"><?php the_field('hotel_address');?></span>
        <?php
        if (has_term('', 'hotel-tag')) {
          echo ' - Tags: ' . get_the_term_list($post->ID, 'hotel-tag', '',', ');
        } ?>

      </div><!-- .entry-meta -->
    </div>

    <?php do_action( 'travelify_after_post_meta' ); ?>

  </article>
</section>
