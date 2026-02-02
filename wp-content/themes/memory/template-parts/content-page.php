<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Memory
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-media">
		<?php the_post_thumbnail( 'memory-single' ); ?>
	</div>

	<div class="entry-info">

		<div class="entry-content">
			<?php

			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'memory' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->

		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer">
				<?php if ( function_exists( 'sharing_display' ) ) : ?>
					<div class="info-box-sharing">
						<?php
						do_action( 'memory_like' );
						sharing_display( '', true );
						?>
					</div>
				<?php endif; ?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
