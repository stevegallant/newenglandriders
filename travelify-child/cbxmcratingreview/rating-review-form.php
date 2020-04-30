<?php
/**
 * Provides frontend  rating form
 *
 * This file is used to markup frontend rating form
 *
 * @link       https://codeboxr.com
 * @since      1.0.0
 *
 * @package    cbxmcratingreview
 * @subpackage cbxmcratingreview/templates
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
<?php


$cbxmcratingreview_setting = new CBXMCRatingReviewSettings();


$show_headline    = intval( $cbxmcratingreview_setting->get_option( 'show_headline', 'cbxmcratingreview_common_config', 1 ) );
$show_comment     = intval( $cbxmcratingreview_setting->get_option( 'show_comment', 'cbxmcratingreview_common_config', 1 ) );
$require_headline = intval( $cbxmcratingreview_setting->get_option( 'require_headline', 'cbxmcratingreview_common_config', 1 ) );
$require_comment  = intval( $cbxmcratingreview_setting->get_option( 'require_comment', 'cbxmcratingreview_common_config', 1 ) );

$enable_question = isset( $form['enable_question'] ) ? intval( $form['enable_question'] ) : 0;

$form_question_formats = CBXMCRatingReviewHelper::form_question_formats();

?>

<div class="cbxmcratingreviewmainwrap">
    <div class="cbxmcratingreview-form-section">
        <div class="cbxmcratingreview_global_msg"></div>

		<?php
		do_action( 'cbxmcratingreview_review_rating_form_before', $form_id, $post_id );
		?>

        <form class="cbxmcratingreview-form" method="post" enctype="multipart/form-data" data-busy="0"
              data-form_id="<?php echo intval( $form_id ); ?>" data-postid="<?php echo intval( $post_id ); ?>">
			<?php
			do_action( 'cbxmcratingreview_review_rating_form_start', $form_id, $post_id );
			?>
            <div class="cbxmcratingreview-form-field">
                <label class="cbxmcratingreview-form-field-urrating"><strong><?php esc_html_e( 'Rate Your Experience', 'cbxmcratingreview' ); ?></strong></label>
				<?php
				if ( isset( $form['custom_criteria'] ) && is_array( $form['custom_criteria'] ) && sizeof( $form['custom_criteria'] ) > 0 ) {
					$custom_criterias = isset( $form['custom_criteria'] ) ? $form['custom_criteria'] : array();

					echo '<ul class="cbxmcratingreview_review_custom_criterias">';
					foreach ( $custom_criterias as $custom_index => $custom_criteria ) {
						//$enabled = isset( $custom_criteria['enabled'] ) ? intval( $custom_criteria['enabled'] ) : 0;
						//if ( $enabled ) {
							$criteria_id = isset( $custom_criteria['criteria_id'] ) ? intval( $custom_criteria['criteria_id'] ) : intval( $custom_index );
							$label       = isset( $custom_criteria['label'] ) ? esc_attr( $custom_criteria['label'] ) : sprintf( esc_html__( 'Criteria %d' ), $criteria_index );

							echo '<li class="cbxmcratingreview_review_custom_criteria" data-criteria_id="' . $criteria_id . '">';
							echo '<p>' . esc_attr( $label ) . '</p>';



							$stars_formatted = is_array( $custom_criteria['stars_formatted'] ) ? $custom_criteria['stars_formatted'] : array();
							$stars_length    = isset( $stars_formatted['length'] ) ? intval( $stars_formatted['length'] ) : 0;
							$stars_hints     = isset( $stars_formatted['stars'] ) ? $stars_formatted['stars'] : array();

							echo '<div class="cbxmcratingreview_rating_trigger" data-number="' . intval( $stars_length ) . '" data-hints=\'' . json_encode( array_values( $stars_hints ) ) . '\'></div>';
							echo '<input type="hidden" name="cbxmcratingreview_ratingForm[ratings][' . $criteria_id . ']" class="cbxmcratingreview-form-field-input cbxmcratingreview-form-field-input-hidden cbxmcratingreview_rating_score" value="" required data-rule-required="true" data-rule-min="0.5" data-rule-max="' . intval( $stars_length ) . '" data-msg-required="' . esc_html__( 'Rating missing!', 'cbxmcratingreview' ) . '" />';
						//}
						echo '</li>';
					}
					echo '</ul>';

				}

				?>

            </div>
			<?php if ( $show_headline ): ?>
                <div class="cbxmcratingreview-form-field">
                    <label for="cbxmcratingreview_review_headline"
                           class=""><?php esc_html_e( 'Review Headline', 'cbxmcratingreview' ); ?></label>
                    <input type="text" name="cbxmcratingreview_ratingForm[headline]" id="cbxmcratingreview_review_headline"
                           class="cbxmcratingreview-form-field-input cbxmcratingreview-form-field-input-text cbxmcratingreview_review_headline" <?php echo ( $require_headline ) ? 'required' : ''; ?>
                           data-rule-minlength="2"
                           placeholder="<?php esc_html_e( 'One line review', 'cbxmcratingreview' ); ?>">
                </div>
			<?php endif; ?>
			<!-- SJG: Added second condition before showing Review comments so they are omitted for NER Rating -->
			<?php if ( $show_comment && $form_id != 1): ?>
                <div class="cbxmcratingreview-form-field">
                    <label for="cbxmcratingreview_review_comment"
                           class=""><strong><?php esc_html_e( 'Your Review', 'cbxmcratingreview' ); ?></strong></label>

					<?php wp_editor( '', 'cbxmcratingreview_review_comment', $settings = array(
						'teeny'         => true,
						'media_buttons' => false,
						'textarea_name' => 'cbxmcratingreview_ratingForm[comment]',
						'editor_class'  => 'cbxmcratingreview-form-field-input cbxmcratingreview-form-field-input-vtextarea cbxmcratingreview_review_comment',
						'textarea_rows' => 8,
						'quicktags'     => false,
						'content_css'   => get_stylesheet_directory_uri() . '/editor-styles.css',
						'tinymce'       => array(
							'init_instance_callback' => 'function(editor) {
							editor.on("change", function(){
								tinymce.triggerSave();
								jQuery("#" + editor.id).valid();
						    });
						}'
						)
					) ); ?>
                </div>
			<?php endif; ?>
			<?php if ( $enable_question ): ?>
                <div class="cbxmcratingreview_review_custom_questions">
					<?php
					if ( isset( $form['custom_question'] ) && is_array( $form['custom_question'] ) && sizeof( $form['custom_question'] ) > 0 ) {
						$customQuestion = $form['custom_question'];


                        //write_log($customQuestion);
						// SJG commented out sub-heading for styling
						//echo '<h3>' . esc_html__( 'Please answer following questions', 'cbxmcratingreview' ) . '</h3>';

						foreach ( $customQuestion as $question_index => $question ) {


							$field_type = isset( $question['type'] ) ? $question['type'] : '';
							$enabled    = isset( $question['enabled'] ) ? intval( $question['enabled'] ) : 0;

							if ( $field_type == '' || ( $enabled == 0 ) ) {
								continue;
							} //if the field type is not proper then move for next item in loop


							echo '<div class="cbxmcratingreview-form-field cbxmcratingreview_review_custom_question cbxmcratingreview_review_custom_question_' . $field_type . '" id="cbxmcratingreview_review_custom_question_' . intval( $question_index ) . '">';

							$form_question_format = $form_question_formats[ $field_type ];
							$question_render      = $form_question_format['public_renderer'];

							if ( is_callable( $question_render ) ) {
								echo call_user_func( $question_render, $question_index, $question );
							}


							echo '</div>';


						}
					}
					?>

                </div>
			<?php endif; ?>
			<?php
			do_action( 'cbxmcratingreview_review_rating_form_end', $form_id, $post_id );
			?>
			<input type="hidden" id="cbxmcratingreview-form-id" name="cbxmcratingreview_ratingForm[form_id]"
				   value="<?php echo intval( $form_id ); ?>"/>

			<input type="hidden" id="cbxmcratingreview-post-id" name="cbxmcratingreview_ratingForm[post_id]"
                   value="<?php echo intval( $post_id ); ?>"/>

			<!-- SJG: edited language in following paragraph -->
			<p class="label-cbxmcratingreview-submit-processing"
               style="display: none;"><?php esc_html_e( 'Please wait while your review is being submitted. Do not close this window.', 'cbxmcratingreview' ) ?></p>
            <button type="submit"
                    class="btn btn-primary btn-cbxmcratingreview-submit"><?php esc_html_e( 'Submit your review', 'cbxmcratingreview' ); ?></button>

        </form>
		<?php
		do_action( 'cbxmcratingreview_review_rating_form_after', $form_id, $post_id );
		?>
    </div>
</div>
