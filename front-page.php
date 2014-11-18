<?php get_header(); ?>

	<section class="full" role="main">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<article class="main-content" id="post-<?php the_ID(); ?>">

			<div class="entry">

				<?php the_content(); ?>

			</div>

		</article>

		<?php endwhile; endif; ?>

	</section>

<?php get_footer(); ?>
