<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>

	<section class="full" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'templates/content', 'page' ); ?>

		<?php endwhile; ?>

	</section>

<?php get_footer(); ?>
