<?php
/**
 * The template used for displaying post excerpts
 */
?>

<article <?php post_class('post-excerpt') ?> id="post-<?php the_ID(); ?>" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">

  <header class="post-header">
    <h1 class="entry-title" ><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
    <?php get_template_part( 'templates/entry', 'meta' ); ?>
  </header>
  <?php erh_featured_image(); ?>
  <div class="excerpt-content" itemprop="text">
    <?php the_excerpt(); ?>
  </div>

</article>
