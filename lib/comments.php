<?php
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */

function erh_update_comment_text_field($comment_field) {
	$comment_field =
		'<p class="comment-form-comment">
			<textarea required placeholder="Enter Your Comment Here..." id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
		</p>';

		return $comment_field;
}

// add_filter('comment_form_field_comment','erh_update_comment_text_field');