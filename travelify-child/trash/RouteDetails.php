1<?php 
/* Template Name: Route Details  */
/* Template Post Type: page */?>

<?php
/**
 * Displays the page section of the theme.
 *
 */
?>

<?php get_header(); ?>

<?php
	/**
	 * travelify_before_main_container hook
	 */
	do_action( 'travelify_before_main_container' );
?>
<p>This is text proving the Road Details template is being used.</p>
<div id="container">
	<?php
		/**
		 * travelify_main_container hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * travelify_content 10
		 */
		do_action( 'travelify_main_container' );
	?>
</div><!-- #container -->

<?php
	/**
	 * travelify_after_main_container hook
	 */
	do_action( 'travelify_after_main_container' );
?>

<?php get_footer(); ?>
