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
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title();?></a>
        </h2><!-- .entry-title -->
      </header>

      <div class="entry-content clearfix">
        <?php the_excerpt(); ?>
      </div>

      <?php do_action( 'travelify_after_post_content' ); ?>
      <?php do_action( 'travelify_before_post_meta' ); ?>

      <div class="entry-meta-bar clearfix">
        <div class="entry-meta">
            <?php // travelify_posted_on(); ?>

            <?php if (get_field('start_date', $post->ID)) { ?>
              <div class="trip-schedule-date">
                <?php
                $startDate = DateTime::createFromFormat('Ymd', get_field('start_date', $post->ID));
                ?>
                <strong>Next Scheduled Trip:</strong> <?php echo $startDate->format('F d, Y'); ?>
              </div>
            <?php } ?>



            <?php if ( comments_open() ) { ?>
                <span class="comments"><?php comments_popup_link( __( 'No Comments', 'travelify' ), __( '1 Comment', 'travelify' ), __( '% Comments', 'travelify' ), '', __( 'Comments Off', 'travelify' ) ); ?></span>
              <?php } ?>
        </div><!-- .entry-meta -->
        <?php
        echo '<a class="readmore" href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">'.__( 'Trip Info', 'travelify' ).'</a>';
        ?>
      </div>

      <?php do_action( 'travelify_after_post_meta' ); ?>

  </article>
</section>
<br />
