<?php
/**
 * Displays the archive section of the theme.
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

<div id="container">
	<p> Using custom template taxonomy-routescale.php</p>
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
	<p> INserted after main container invoked</p>
</div><!-- #container -->

<?php
	/**
	 * travelify_after_main_container hook
	 */
	do_action( 'travelify_after_main_container' );
?>

<?php get_footer(); ?>
