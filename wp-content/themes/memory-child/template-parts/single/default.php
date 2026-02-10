<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Memory
 */

?>
<div >
	<main >

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php 	get_template_part( 'template-parts/content', 'single-default' ); ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->
