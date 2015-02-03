<?php
/**
 * The template used for displaying full posts
 */
?>

<article <?php post_class('full-post'); ?> id="post-<?php the_ID(); ?>">

  <header>
    <h1><?php the_title(); ?></h1>

    <?php get_template_part( 'templates/entry', 'meta' ); ?>
  </header>

  <div class="post-content">

    <?php the_content(); ?>

    <?php wp_link_pages( array( 'before' => 'Pages: ', 'next_or_number' => 'number' ) ); ?>

    <?php the_tags( 'Tags: ', ', ', ''); ?>

  </div>

  <footer>
    <?php get_template_part( 'templates/entry', 'social' ); ?>
  </footer>

</article>