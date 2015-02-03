<?php
/**
 * The template used for displaying page content in page.php
 */
?>

<article <?php post_class('main-content');?> id="post-<?php the_ID(); ?>">

  <div class="entry-content">

    <?php the_content(); ?>

    <?php wp_link_pages( array( 'before' => 'Pages: ', 'next_or_number' => 'number' ) ); ?>

  </div>

</article>