
<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
  if( is_home() || is_front_page() ) {
    // if( "0" == $options[ 'disable_slider' ] ) {
      if( function_exists( 'travelify_pass_cycle_parameters' ) )
        travelify_pass_cycle_parameters();
      if( function_exists( 'travelify_featured_post_slider' ) )
        travelify_featured_post_slider();
    // }
    }
  ?>
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
        <?php
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
