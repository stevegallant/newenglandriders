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
      <?php do_action( 'travelify_before_post_content' ); ?>

      <div class="entry-content clearfix">
        <?php the_content(); ?>

        <div class="locale-chooser-form">
          <?php //route_element_search_form(); ?>

        </div> <!-- locale-chooser-form -->

      </div>

      <?php
      do_action( 'travelify_after_post_content' );
      do_action( 'travelify_before_comments_template' );
      comments_template();
      do_action ( 'travelify_after_comments_template' );
      ?>

  </article>
</section>
