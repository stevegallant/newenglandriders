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
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
          <span class="scenicview-archive-thumb"><?php the_post_thumbnail(array(75,75)); ?></span>
          <?php
          echo '  ';
          the_title();?>
        </a>
      </span><!-- .entry-title -->
    </header>

    <?php
    do_action( 'travelify_after_post_content' );
    do_action( 'travelify_before_post_meta' );
    ?>

    <div class="entry-meta-bar clearfix route-meta-bar">
      <div class="entry-meta">
        <?php
        if (has_term('', 'scenicview-tag')) {
          echo get_the_term_list($post->ID, 'scenicview-tag', '',', ') . " - ";
        } ?>
        <span class="ital"><?php the_field('scenicview_address');?></span>
      </div><!-- .entry-meta -->
    </div>

    <?php do_action( 'travelify_after_post_meta' ); ?>

  </article>
</section>
