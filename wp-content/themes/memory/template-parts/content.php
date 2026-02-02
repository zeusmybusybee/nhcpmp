<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Memory
 */

if ( memory_has_video() || has_post_format( 'gallery' ) || has_post_format( 'quote' ) || has_post_thumbnail() ) {
	$memory_class = 'has-thumbnail';
} else {
	$memory_class = '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $memory_class ); ?>>

	<?php get_template_part( 'template-parts/content', 'media' ); ?>

	<div class="article-container">
		<header class="entry-header">
			<?php memory_the_category(); ?>
			<div class="entry-meta">
				<?php
				memory_comment_link();
				memory_posted_on();
				?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

		<div class="entry-content">
			<?php
			the_excerpt();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'memory' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php if ( function_exists( 'sharing_display' ) ) : ?>
				<?php sharing_display( '', true ); ?>
			<?php endif; ?>

			<p class="link-more">
				<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo esc_html( 'Read More', 'memory' ); ?></a>
			</p>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
