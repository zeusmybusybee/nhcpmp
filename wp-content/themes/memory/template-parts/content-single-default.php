<?php
/**
 * Template part for content posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package memory
 */

$memory_hide_featured_image = get_theme_mod( 'hide_featured_image', 'show-ft' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( $memory_hide_featured_image ) ); ?>>
	<?php
	if ( 'show-ft' === $memory_hide_featured_image ) {
		echo '<div class="entry-media">';
		the_post_thumbnail( 'memory-thumbnails-2' );
		echo '</div>';
	}
	?>

	<div class="entry-info">
		<header class="entry-header below-featured-image">
			<?php memory_the_category(); ?>
			<div class="entry-meta">
				<?php
				memory_comment_link();
				memory_posted_on();
				?>
			</div>
		</header>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

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

		<footer class="entry-footer">
			<?php memory_entry_footer(); ?>

			<?php if ( class_exists( 'Memory_Like' ) || function_exists( 'sharing_display' ) ) : ?>
				<div class="info-box-sharing">
					<?php
					do_action( 'memory_like' );
					if ( function_exists( 'sharing_display' ) ) {
						sharing_display( '', true );
					}
					?>
				</div>
			<?php endif; ?>
		</footer><!-- .entry-footer -->

		<?php
		memory_author_box();
		?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
