<?php

/***************************************************************
* Function erh_profile_fields
* Remove useless contact fields in user profile page
***************************************************************/

if( ! function_exists('erh_profile_fields') ):

	function erh_profile_fields( $contactmethods ) {
		unset( $contactmethods['aim'] );
		unset( $contactmethods['yim'] );
		unset( $contactmethods['jabber'] );

		return $contactmethods;
	}

	add_filter('user_contactmethods','erh_profile_fields',10,1);

endif;

/***************************************************************
* Function erh_remove_dashboard_widgets
* Remove unnecessary dashboard widgets
***************************************************************/

if( ! function_exists('erh_remove_dashboard_widgets') ):

	function erh_remove_dashboard_widgets() {
	  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
	  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
	  remove_meta_box('dashboard_primary', 'dashboard', 'normal');
	  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
	}

	add_action('admin_init', 'erh_remove_dashboard_widgets');

endif;

/***************************************************************
* Function erh_replace_howdy
* Change 'Howdy' in the admin bar
***************************************************************/

if( ! function_exists('erh_replace_howdy') ):

	function erh_replace_howdy( $wp_admin_bar ) {

		$my_account=$wp_admin_bar->get_node('my-account');
		$newtitle = str_replace( 'Howdy,', 'Welcome,', $my_account->title );
		$wp_admin_bar->add_node( array(
			'id' => 'my-account',
			'title' => $newtitle,
		) );
	}

	add_filter( 'admin_bar_menu', 'erh_replace_howdy',25 );

endif;

/***************************************************************
* Function erh_remove_wp_menu_items
* Remove admin menu bar items that are not needed for the site
* Remove menu items client does not need to access
***************************************************************/

if( ! function_exists('erh_remove_wp_menu_items') ):

	function erh_remove_wp_menu_items() {

	  // Menu Items to Remove for All Users //

	  // remove_menu_page( 'edit-comments.php' );          //Comments
	  // remove_menu_page( 'edit.php' );								//Posts
	 
	  
		// Menu Items to Hide to All Except $admins //
	  $admins = array( 
	      'ADMIN ACCOUNT'
	  );

	  $current_user = wp_get_current_user();

	  if( !in_array( $current_user->user_login, $admins ) ) {
			// remove_menu_page( 'themes.php' );                          // Appearance
			// remove_menu_page( 'plugins.php' );                         // Plugins
	    // remove_menu_page( 'edit.php?post_type=acf-field-group' );  // ACF 
	  }
	 
	}
	 
	add_action( 'admin_menu', 'erh_remove_wp_menu_items', 999 );

endif;


/***************************************************************
* Function erh_custom_admin_menu
* Custom ordering of WP menu items
***************************************************************/

if( ! function_exists('erh_custom_admin_menu') ):

function erh_custom_admin_menu( $menu_ord ) {
	if ( !$menu_ord ) return true;
	return array(
		// 'index.php', // Dashboard
		// 'separator1', // First separator
		// 'edit.php?post_type=page', // Pages
		// 'edit.php', // Posts
		// 'upload.php', // Media
		// 'edit-comments.php', // Comments
		// 'separator2', // Second separator
		// 'themes.php', // Appearance
		// 'plugins.php', // Plugins
		// 'users.php', // Users
		// 'tools.php', // Tools
		// 'options-general.php', // Settings
		// 'separator-last', // Last separator
	);
}

// add_filter( 'custom_menu_order', 'erh_custom_admin_menu' );
// add_filter( 'menu_order', 'erh_custom_admin_menu' );

endif; 

/***************************************************************
* Function erh_admin_branding
* Custom ordering of WP menu items
***************************************************************/

function erh_admin_branding () {
  echo 'Created by <a href="http://ericrhermanson.com">Eric Hermanson</a>. Powered by <a href="http://www.wordpress.org">WordPress</a>';
}
 
add_filter('admin_footer_text', 'erh_admin_branding');

/***************************************************************
* Function erh_mce_mod
* Function erh_mce_add_buttons
* Add Formats dropdown to Tiny MCE Editor
***************************************************************/

function erh_mce_mod( $init ) {
    $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 5=h6';

    $style_formats = array (
        array( 'title' => 'Disclosure', 'block' => 'div', 'classes' => 'disclosure' ),
    );

    $init['style_formats'] = json_encode( $style_formats );

    $init['style_formats_merge'] = false;
    return $init;
}

// add_filter('tiny_mce_before_init', 'erh_mce_mod');

function erh_mce_add_buttons( $buttons ){
    array_splice( $buttons, 1, 0, 'styleselect' );
    return $buttons;
}

// add_filter( 'mce_buttons_2', 'erh_mce_add_buttons' );