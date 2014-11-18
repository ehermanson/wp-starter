<?php get_header(); ?>

	<section class="main" role="main">

		<?php if ( have_posts() ) : ?>

			<h2 class="search-title"><?php printf( __( 'Search Results for: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h2>

			<?php while ( have_posts() ) : the_post(); ?>

				<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

					<?php get_template_part( 'templates/entry', 'meta' ); ?>

					<div class="entry">

						<?php the_excerpt(); ?>

					</div>

				</article>

			<?php endwhile; ?>

			<?php get_template_part( 'templates/page', 'nav' ); ?>

		<?php else : ?>

			<h1>Nothing found. Try searching something else or using the main menu.</h1>

		<?php endif; ?>

	</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
