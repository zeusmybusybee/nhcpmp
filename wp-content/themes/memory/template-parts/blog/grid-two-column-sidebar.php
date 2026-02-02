<?php
/**
 * Custom CSS for blog grid.
 *
 * @package Memory
 */

?>
<div class="blog-grid-sidebar container">
	<main class="row">
		<div class="col-md-8">
			<div id="load-more-posts" class="row load-more-post">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :

						the_post();

						echo '<div class="blog-article col-md-6">';
						get_template_part( 'template-parts/content', get_post_format() );
						echo '</div>';

					endwhile;
					the_posts_pagination(
						array(
							'prev_text' => __( '<i class="icofont icofont-rounded-double-left"></i>', 'memory' ),
							'next_text' => __( '<i class="icofont icofont-rounded-double-right"></i>', 'memory' ),
						)
					);
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>
			</div>
		</div>
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>
	</main>
</div>
