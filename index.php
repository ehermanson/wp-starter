<?php get_header(); ?>

	<section class="main" role="main">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'templates/content', 'excerpt' ); ?>

		<?php endwhile; ?>

		<?php else : ?>

			<article>
				<h1>Not Found</h1>
			</article>

		<?php endif; ?>
	<?php the_posts_pagination(); ?>
	</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>