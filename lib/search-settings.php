<?php 

/***************************************************************
* Function erh_get_search_form
* Replace the standard WordPress search form
***************************************************************/

// Replace standard WP search form
function erh_get_search_form($form) {
  $form = '';
  locate_template('/templates/search-form.php', true, false);
  return $form;
}

add_filter('get_search_form', 'erh_get_search_form');

/***************************************************************
* Function erh_search_params
* Define array of what post types to search
***************************************************************/

function erh_search_params( $query ) {
	if ( $query->is_search ) {
		$query->set( 'post_type', array( 'post', 'page' ) );
	}
	return $query;
}

add_filter( 'pre_get_posts', 'erh_search_params' );

/***************************************************************
* Function erh_search_redirect
* Make search result URLs nicer looking
***************************************************************/

function erh_search_redirect() {
  global $wp_rewrite;
  if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
    return;
  }

  $search_base = $wp_rewrite->search_base;
  if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
    wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
    exit();
  }
}

add_action('template_redirect', 'erh_search_redirect');