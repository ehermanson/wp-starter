<?php

/***************************************************************
* Function erh_setup
* Setup the theme
***************************************************************/
if( ! function_exists('erh_setup') ):

	function erh_setup() {

		add_theme_support( 'menus' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form' ) );
		add_theme_support( 'automatic-feed-links' );

		//Set Custom Thumbnail Sizes
		// add_image_size( 'thumbnail-300', 300, 100, true );

		//add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
		
		if (!isset($content_width)) { $content_width = 1140; }

		register_nav_menus(array(
	    'primary_navigation' => 'Primary Navigation'
		));

	}

	add_action('after_setup_theme', 'erh_setup');

endif;

/***************************************************************
* Function erh_mime_types
* Allow SVG uploads
***************************************************************/

if( ! function_exists('erh_mime_types') ):

	function erh_mime_types( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	add_filter( 'upload_mimes', 'erh_mime_types' );

endif;


/***************************************************************
* Function erh_wp_title
* Filter WP_Title() 
***************************************************************/

if( ! function_exists('erh_wp_title') ):

	function erh_wp_title( $title, $sep ) {
		global $paged, $page;
	 
		if ( is_feed() ) {
			return $title;
		} // end if
	 
		// Add the site name.
		$title .= get_bloginfo( 'name' );
	 
		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );

		if ( $site_description && ( is_front_page() ) ) {
			$title = "$title $sep $site_description";
		} // end if
	 
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( __( 'Page %s', 'mayer' ), max( $paged, $page ) );
		} // end if
	 
		return $title;
	 
	} 

	add_filter( 'wp_title', 'erh_wp_title', 10, 2 );

endif;