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
			<?php
			if ('foundation-of-towns' === get_post_type()) {
				get_template_part('template-parts/content', 'single-foundation-default');
			} elseif ('book' === get_post_type()) {
				get_template_part('template-parts/content', 'single-book-default');
			}elseif ('articles' === get_post_type()) {
				get_template_part('template-parts/content', 'single-articles-default');
			}else {
				get_template_part('template-parts/content', 'single-default');
			}
			?>

			

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->
