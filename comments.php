<?php
/**
 * The template for displaying Comments
 */
?>

<?php 

  if ( post_password_required() )
    return;

?>
 
<div id="comments" class="comments-area">
 
  <?php if ( have_comments() ) : ?>
    <h3 class="comments-title">
     <?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'erh_starter' ),
      number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
    </h3>

    <ol class="commentlist">
      <?php wp_list_comments( ); ?>
    </ol>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>

    <div role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
      <h3 class="assistive-text"><?php _e( 'Comment navigation', 'erh' ); ?></h3>
      <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'erh_starter' ) ); ?></div>
      <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'erh_starter' ) ); ?></div>
    </div>

    <?php endif; // check for comment navigation ?>

  <?php endif; // have_comments() ?>

  <?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

    <p class="nocomments"><?php _e( 'Comments are closed.', 'erh_starter' ); ?></p>
    
  <?php endif; ?>

  <?php 

    $args = array(
      'title_reply'       => __( 'Leave a Comment', 'erh_starter' ),
      'title_reply_to'    => __( 'Reply to %s', 'erh_starter' ),
      'label_submit'      => __( 'Submit Comment', 'erh_starter' ),
      'comment_notes_after' => '',
      'cancel_reply_link' => __( '<i class="fa fa-lg fa-times"></i>' ),

      'comment_notes_before' => '<p class="comment-notes">' .
      __( 'Note: Your email address will not be published.', 'erh_starter' ) .
      '</p>',
    );

    comment_form($args); 

  ?>

</div>