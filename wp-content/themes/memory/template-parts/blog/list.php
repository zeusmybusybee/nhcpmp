<?php
/**
 * Custom CSS for simple blog.
 *
 * @package Memory
 */

?>
<div class="blog-list container">
	<main id="load-more-posts" class="row load-more-post">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :

				the_post();

				echo '<div class="blog-article">';
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
	</main>
</div>
