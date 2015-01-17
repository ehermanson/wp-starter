<?php

$fontURL = 'http://fonts.googleapis.com/css?family=Open+Sans:300,400';

/***************************************************************
* Function erh_styles
* Register and enqueue styles and scripts
***************************************************************/

function erh_styles() {

	global $fontURL;

	wp_enqueue_style( 'erh-fonts', $fontURL );
	wp_enqueue_style( 'erh-styles', get_template_directory_uri() . '/assets/build/css/style.css',array(), filemtime( get_template_directory().'/assets/build/css/style.css' ) );

	wp_enqueue_script( 'erh-modernizr', get_template_directory_uri() . '/assets/build/js/modernizr.min.js', array('jquery'), null, false );
	wp_enqueue_script( 'erh-js', get_template_directory_uri() . '/assets/build/js/global.min.js', array('jquery'), null, true );

	/// LiveReload for local development
	if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
	  wp_register_script('livereload', 'http://localhost:8888/livereload.js?snipver=1', null, false, true);
	  wp_enqueue_script('livereload');
	}

}

add_action( 'wp_enqueue_scripts', 'erh_styles' );

/***************************************************************
* Function erh_add_editor_styles
* Add styles for TinyMCE editor
***************************************************************/

function erh_add_editor_styles() {

	global $fontURL;

  add_editor_style( get_template_directory_uri() . '/assets/build/css/editor-style.css' );
  add_editor_style( str_replace( ',', '%2C', $fontURL ) );

}

add_action( 'init', 'erh_add_editor_styles' );

/***************************************************************
* Function erh_login_css
* Function erh_login_url
* Function erh_login_title
* Customize the login screen
***************************************************************/


function erh_login_css() {
	wp_enqueue_style( 'erh_login_css', get_template_directory_uri() . '/assets/build/css/login.css', false );
}

function erh_login_url() {
	return home_url();
}

function erh_login_title() {
	return get_option( 'blogname' );
}

add_action( 'login_enqueue_scripts', 'erh_login_css', 10 );
add_filter( 'login_headerurl', 'erh_login_url' );
add_filter( 'login_headertitle', 'erh_login_title' );


add_editor_style( 'editor-style.css' );

/***************************************************************
* Function erh_respond_js
* Conditionally add Respond.js for IE8
***************************************************************/

// function erh_respond_js () {
//   echo '<!--[if lte IE 9]>';
//   echo '<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>';
//   echo '<![endif]-->';
// }
// add_action('wp_head', 'erh_respond_js');


/***************************************************************
* Function erh_dequeue_jquery_migrate
* Remove jQuery Migrate
***************************************************************/

add_filter( 'wp_default_scripts', 'erh_dequeue_jquery_migrate' );

function erh_dequeue_jquery_migrate( &$scripts){
	if(!is_admin()){
		$scripts->remove( 'jquery');
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
	}
}

/***************************************************************
* Function erh_deregister_styles
* Remove specific plugin CSS
***************************************************************/

// add_action( 'wp_print_styles', 'erh_deregister_styles', 100 );

// function erh_deregister_styles() {
// 	wp_deregister_style( 'contact-form-7' );
// }

/***************************************************************
* Function erh_deregister_scripts
* Remove specific plugin JS
***************************************************************/

//add_action( 'wp_print_scripts', 'erh_deregister_scripts', 100 );

// function erh_deregister_scripts() {
// 	if ( !is_page('contact') ) {
// 		wp_deregister_script( 'contact-form-7' );
// 	}
// }