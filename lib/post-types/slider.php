<?php
		
// Register Slider Post Type

add_action( 'init', 'homepage_slider', 0 );

function homepage_slider() {
    $labels = array(
        'name'                => _x( 'Slides', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Slide', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Image Slider', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Slide:', 'text_domain' ),
        'all_items'           => __( 'All Slides', 'text_domain' ),
        'view_item'           => __( 'View Slide', 'text_domain' ),
        'add_new_item'        => __( 'Add New', 'text_domain' ),
        'add_new'             => __( 'New Slide', 'text_domain' ),
        'edit_item'           => __( 'Edit Slide', 'text_domain' ),
        'update_item'         => __( 'Update Slide', 'text_domain' ),
        'search_items'        => __( 'Search slides', 'text_domain' ),
        'not_found'           => __( 'No slides found', 'text_domain' ),
        'not_found_in_trash'  => __( 'No slides found in Trash', 'text_domain' ),
    );
 
    $args = array(
        'label'               => __( 'homepage_slider', 'text_domain' ),
        'description'         => __( 'Homepage Slides', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'show_in_admin_bar'   => false,
        'menu_position'       => 7,
        'menu_icon'           => 'dashicons-images-alt2',
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
 
    register_post_type( 'homepage_slider', $args );
}

add_action('manage_homepage_slider_posts_columns', 'posts_column_homepage_slider', 10);
add_action('manage_homepage_slider_posts_custom_column', 'posts_custom_column_homepage_slider', 10, 2);

    function posts_column_homepage_slider($defaults){
        
        unset($defaults);
        $defaults['cb'] = '<input type="checkbox"/>';
        $defaults['thumbnail'] = __('Thumbnail', 'default');
        $defaults['title'] = __('Title', 'default');
        $defaults['date'] = __('Date', 'default');
        return $defaults;
    }

    function posts_custom_column_homepage_slider($column_name, $post_id){
        switch($column_name) {
            case 'thumbnail':
                if(has_post_thumbnail($post_id)) {
                    the_post_thumbnail('thumbnail');
                }
                break;
        }
}
 	
?>