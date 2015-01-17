<?php

/***************************************************************
* Function erh_pagenav
* Pagination
***************************************************************/

if( ! function_exists('erh_pagenav') ):

	function erh_pagenav() {
			global $wp_query, $wp_rewrite;
			$pages = '';
			$max = $wp_query->max_num_pages;
			if(!$current = get_query_var('paged')) $current = 1;
			$base = str_replace(999999999, '%#%', get_pagenum_link(999999999));

		 $total = 1;

		 $args = array(
				'base'         => $base,
				'total'        => $max,
				'current'      => $current,
				'end_size'     => 1,
				'mid_size'     => 4,
				'prev_text'    => '&laquo; Previous',
				'next_text'    => 'Next &raquo;'
			);

			if($max > 1) echo '<div class="page-nav">';
				echo $pages . paginate_links($args);
			if($max > 1) echo '</div>';
	}

endif;

/***************************************************************
* Function erh_trim_excerpt
* Detailed output of Post Excerpt
***************************************************************/
if( ! function_exists('erh_trim_excerpt') ):

	function erh_trim_excerpt($text) {
		$raw_excerpt = $text;
			if ( '' == $text ) {

				$text = get_the_content('');
				$text = strip_shortcodes( $text );
				$text = apply_filters('the_content', $text);
				// $text = str_replace(']]>', ']]>', $text);
			 //  $text = strip_tags($text, '<em><strong><p>');

				// Set the excerpt length
				$excerpt_length = apply_filters('excerpt_length', 150);

				// Set what appears at the end of the excerpt
				$excerpt_more = apply_filters('excerpt_more', ' ' . '...');

				$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
				if ( count($words) > $excerpt_length ) {
						array_pop($words);
						$text = implode(' ', $words);
						$text = $text . $excerpt_more;
						$text = force_balance_tags( $text );
				} else {
						$text = implode(' ', $words);
				}

		}

		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}

	// remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	// add_filter('get_the_excerpt', 'erh_trim_excerpt');

endif;

/***************************************************************
* Function erh_auto_featured_image
* Set the Featured Image automatically if user doesn't set it
***************************************************************/
if( ! function_exists('erh_auto_featured_image') ):

	function erh_auto_featured_image() {
		global $post;
		$already_has_thumb = has_post_thumbnail($post->ID);
		if (!$already_has_thumb) {
			$attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
			if ($attached_image) {
				foreach ($attached_image as $attachment_id => $attachment) {
					set_post_thumbnail($post->ID, $attachment_id);
				}
			}
		}
	}

	add_action('the_post', 'erh_auto_featured_image');
	add_action('save_post', 'erh_auto_featured_image');
	add_action('draft_to_publish', 'erh_auto_featured_image');
	add_action('new_to_publish', 'erh_auto_featured_image');
	add_action('pending_to_publish', 'erh_auto_featured_image');
	add_action('future_to_publish', 'erh_auto_featured_image');

endif;

/***************************************************************
* Function erh_featured_image
* Display Featured Image
***************************************************************/
if( ! function_exists('erh_featured_image') ):

function erh_featured_image() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="featured-image">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="featured-image" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ); ?>
	</a>

	<?php endif; // End is_singular()
}

endif;

/***************************************************************
* Function erh_no_image_link
* Remove default links added to images
***************************************************************/
if( ! function_exists('erh_no_image_link') ):

	function erh_no_image_link() {
		$image_set = get_option( 'image_default_link_type' );
		if ( $image_set !== 'none' ) {
			update_option( 'image_default_link_type', 'none' );
		}
	}

	add_action( 'admin_init', 'erh_no_image_link', 10 );

endif;

/***************************************************************
* Function erh_read_more
* Custom Read More function
***************************************************************/
if( ! function_exists('erh_read_more') ):

	function erh_read_more($more) {
			global $post;
		return '...  <p><a class="button excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __('Read', 'erhtheme') . get_the_title($post->ID).'">'. __('Read more &raquo;', 'erhtheme') .'</a>';
	}

	add_filter('excerpt_more', 'erh_read_more');

endif;

/***************************************************************
* Function erh_post_count_on_archive
* Set Custom Number of Results for Search/Archive pages
***************************************************************/

if( ! function_exists('erh_post_count_on_archive') ):

	function erh_post_count_on_archive( $query ) {

		if ( $query->is_tag() || $query->is_search() || $query->is_archive() ) {

			$query->set( 'posts_per_page', '20' );

		}

	}

// add_action( 'pre_get_posts', 'erh_post_count_on_archive' );

endif;