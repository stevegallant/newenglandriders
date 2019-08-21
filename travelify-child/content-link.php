<?php
/**
 * Template for displaying posts in the Link Post Format
 *
 * Used on index and archive pages
 *
 **/
 ?>


<!-- direct paste -->
<section>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
  <div class="container clearfix">
    <header class="entry-title">
      <?php if ( is_single() ) { ?>
        <h1><?php the_title(); ?></h1>
      <?php } else { ?>
        <?php $myLink = get_my_url(); ?>
        <h2> <a href="<?php echo $myLink; ?>"><?php echo the_title(); ?></a> </h2>
        <p>This is an external link and will take you to a new page.</p>
      <?php } ?>
      <!-- <?php et_fable_post_meta(); ?> -->
    </header>
  </div> <!-- .container -->
  <!-- <?php if ( is_single() ) : ?> <?php get_template_part( 'content', get_post_format() ); ?>
  <?php endif; ?> -->
</article> <!-- .entry-->
</section>
