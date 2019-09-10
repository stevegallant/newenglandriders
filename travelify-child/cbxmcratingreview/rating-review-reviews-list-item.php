<?php
	/**
	 * Provides review list item
	 *
	 * This file is used to markup frontend review list item
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
	$post_id    = intval( $post_review['post_id'] );
	$post_title = get_the_title( $post_id );


	$avatar_style = apply_filters('cbxmcratingreview_reviewer_avatar_style', '', $post_review);

	$questions     = maybe_unserialize( $post_review['questions'] );
	$ratings       = maybe_unserialize( $post_review['ratings'] );
	$ratings_stars = isset( $ratings['ratings_stars'] ) ? $ratings['ratings_stars'] : array();

	$enable_question = isset( $form['enable_question'] ) ? intval( $form['enable_question'] ) : 0;


	$cbxmcratingreview_setting = new CBXMCRatingReviewSettings();
	$form_question_formats = CBXMCRatingReviewHelper::form_question_formats();
?>
<?php
	do_action( 'cbxmcratingreview_review_list_item_before', $post_review );
?>
<div itemprop="review" itemscope itemtype="http://schema.org/Review">
		<span style="display: none;" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing">
			<span itemprop="name"><?php echo esc_attr( $post_title ); ?></span>
		</span>

	<p class="cbxmcratingreview_review_list_item_user">
		<a itemprop="author" itemscope itemtype="http://schema.org/Person"
		   class="cbxmcratingreview_review_list_item_user_name"
		   href="<?php echo esc_url( apply_filters( 'cbxmcratingreview_reviewer_posts_url', get_author_posts_url( intval( $post_review['user_id'] ) ), $post_review) ); ?>">
			<span class="cbxmcratingreview_review_list_item_user_img" style="<?php echo  $avatar_style; ?>">
				<?php echo apply_filters('cbxmcratingreview_reviewer_avatar', get_avatar( $post_review['user_email'] ), $post_review); ?>
			</span>
			<span itemprop="name"><?php echo apply_filters( 'cbxmcratingreview_reviewer_name', stripslashes( $post_review['display_name'] ), $post_review ); ?></span>
		</a>

		<?php
			$review_create_date       = $post_review['date_created'];
			$review_create_date_human = CBXMCRatingReviewHelper::dateReadableFormat( $review_create_date )

		?>
		<a title="<?php echo sprintf( esc_html__( 'Review Created on: %s ', 'cbxmcratingreview' ), $review_create_date ); ?>"
		   class="cbxmcratingreview_review_list_item_date"
		   href="#cbxmcratingreview_review_list_item_<?php echo intval( $post_review['id'] ); ?>">
			<?php
				echo $review_create_date_human;
			?>
		</a>
		<span class="clearfix cbxmcratingreview_clearfix clear"></span>
	</p>


	<div class="clearfix cbxmcratingreview_clearfix clear"></div>
	<!-- SJG: Removed <p> containing avg rating, or class cbxmcratingreview_review_list_item_star_score_headline -->


	<?php
		if ( isset( $form['custom_criteria'] ) && is_array( $form['custom_criteria'] ) && sizeof( $form['custom_criteria'] ) > 0 ) {
			$custom_criterias = isset( $form['custom_criteria'] ) ? $form['custom_criteria'] : array();

			echo '<ul class="cbxmcratingreview_review_readonly_criterias">';
			foreach ( $custom_criterias as $custom_index => $custom_criteria ) {
				//$enabled = isset( $custom_criteria['enabled'] ) ? intval( $custom_criteria['enabled'] ) : 0;
				//if ( $enabled ) {


					$criteria_id = isset( $custom_criteria['criteria_id'] ) ? intval( $custom_criteria['criteria_id'] ) : intval( $custom_index );
					$label       = isset( $custom_criteria['label'] ) ? esc_attr( $custom_criteria['label'] ) : sprintf( esc_html__( 'Criteria %d' ), $criteria_index );

					$stars_formatted = is_array( $custom_criteria['stars_formatted'] ) ? $custom_criteria['stars_formatted'] : array();

					$stars_length = isset( $stars_formatted['length'] ) ? intval( $stars_formatted['length'] ) : 0;
					$stars_hints  = isset( $stars_formatted['stars'] ) ? $stars_formatted['stars'] : array();


					$rating       = isset( $ratings_stars[ $criteria_id ] ) ? $ratings_stars[ $criteria_id ] : array();
					$rating_score = isset( $rating['score'] ) ? $rating['score'] : 0;
					//$star_id      = isset( $rating['star_id'] ) ? $rating['star_id'] : '';



					echo '<li class="cbxmcratingreview_review_readonly_criteria" data-criteria_id="' . $criteria_id . '">';
					echo '<p>' . esc_attr( $label ) . '</p>';


					/*if(!isset($stars_hints[$star_id]))  {
						$rating_score = 0;
					}*/


					echo '<div data-processed="0" class="cbxmcratingreview_readonlyrating_score_js" data-score="'.$rating_score.'"  data-hints=\'' . json_encode( array_values( $stars_hints ) ) . '\'></div>';
				//}
				echo '</li>';
			}
			echo '</ul>';

		}

	?>


	<?php
		do_action( 'cbxmcratingreview_review_list_item_before_comment', $post_review );
	?>
	<div class="cbxmcratingreview_review_list_item_comment">
		<br />
		<!-- SJG: Remove heading for review comments -->
		<!-- <p class="cbxmcratingreview_review_list_item_heading"><?php //esc_html_e( 'Review', 'cbxmcratingreview' ); ?></p> -->
		<div class="cbxmcratingreview_review_list_item_comment_text"
			 itemprop="description"><?php echo wpautop( stripslashes( $post_review['comment'] ) ); ?></div>
	</div>
	<?php
		if($enable_question): ?>
<div class="cbxmcratingreview_review_custom_questions">
			            <?php
				            if ( isset( $form['custom_question'] ) && is_array( $form['custom_question'] ) && sizeof( $form['custom_question'] ) > 0 ) {

					            $customQuestion = $form['custom_question'];

											// SJG: HIDE header for Questions and Answers
					            //echo '<h3>' . esc_html__( 'Questions and Answers', 'cbxmcratingreview' ) . '</h3>';

					            foreach ( $customQuestion as $question_index => $question ) {

						            $field_type = isset( $question['type'] ) ? $question['type'] : '';
						            $enabled    = isset( $question['enabled'] ) ? intval( $question['enabled'] ) : 0;

						            if ( $field_type == '' || ( $enabled == 0 ) ) {
							            continue;
						            } //if the field type is not proper then move for next item in loop

						            $user_answer = isset($questions[$question_index])? $questions[$question_index]: '';


						            echo '<div class="cbxmcratingreview-form-field cbxmcratingreview_review_custom_question cbxmcratingreview_review_custom_question_' . $field_type . '" id="cbxmcratingreview_review_custom_question_' . intval( $question_index ) . '">';

						            $form_question_format = $form_question_formats[ $field_type ];
						            $question_render      = $form_question_format['answer_renderer'];

						            if ( is_callable( $question_render ) ) {
							            echo call_user_func( $question_render, $question_index, $question, $user_answer );
						            }

						            echo '</div>';
					            }
				            }
			            ?>

					</div>
	<?php endif; ?>
	<?php
		do_action( 'cbxmcratingreview_review_list_item_after_comment', $post_review );

		do_action( 'cbxmcratingreview_review_list_item_after', $post_review );

	?>
</div>
