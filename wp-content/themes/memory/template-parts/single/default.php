<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Memory
 */

?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<div class="content-single">
				<?php
				get_template_part( 'template-parts/content', 'single-default' );

				the_post_navigation(
					array(
						'prev_text' => esc_html__( 'Previous Post', 'memory' ),
						'next_text' => esc_html__( 'Next Post', 'memory' ),
					)
				);

					// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>
			</div>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->
