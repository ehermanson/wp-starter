<?php

/***************************************************************
* Function erh_head_cleanup
* Function erh_remove_versions
* Cleanup the stuff WordPress inserts into <head>
***************************************************************/

if( ! function_exists('erh_head_cleanup') ):

	function erh_head_cleanup() {
		remove_action('wp_head', 'feed_links', 2);
		remove_action('wp_head', 'feed_links_extra', 3);
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

		global $wp_widget_factory;
		remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));

	}

	add_action('init', 'erh_head_cleanup');

endif;

/***************************************************************
* Function erh_remove_admin_bar
* Remove admin bar
***************************************************************/

if( ! function_exists('erh_remove_admin_bar') ):

	function erh_remove_admin_bar(){
		return false;
	}

	add_filter( 'show_admin_bar' , 'erh_remove_admin_bar');

endif;

/***************************************************************
* Function erh_body_class
* Cleanup the default WordPress body classes
***************************************************************/

if( ! function_exists('erh_body_class') ):

	function erh_body_class($classes) {
		// Add post/page slug
		if (is_single() || is_page() && !is_front_page()) {
			$classes[] = basename(get_permalink());
		}

		// Remove unnecessary classes
		$home_id_class = 'page-id-' . get_option('page_on_front');
		$remove_classes = array(
			'page-template-default',
			$home_id_class
		);
		$classes = array_diff($classes, $remove_classes);

		return $classes;
	}

	add_filter('body_class', 'erh_body_class');

endif;

/***************************************************************
* Function erh_filter_ptags_on_images
* Stop WordPress from wrapping images in <p> tags
***************************************************************/

if( ! function_exists('erh_filter_ptags_on_images') ):

	function erh_filter_ptags_on_images($content){
		 return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}

	add_filter('the_content', 'erh_filter_ptags_on_images');

endif;