<?php

require_once('post-types/slider.php');

/***************************************************************
* Function erh_change_title_text
* Change the default title text on custom posts
***************************************************************/

function erh_change_title_text( $title ){
	$screen = get_current_screen();
	if ( 'homepage_slider' == $screen->post_type ) {
		$title = 'Enter Title for the Image';
	}

	return $title;
}

add_filter( 'enter_title_here', 'erh_change_title_text' );