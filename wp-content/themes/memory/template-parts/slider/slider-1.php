<?php
/**
 * Display featured content on the homepage.
 *
 * @package memory
 */

$memory_featured_posts = memory_get_featured_posts();
if ( empty( $memory_featured_posts ) ) {
	return;
}
?>
<div class="clearfix featured-posts-1 is-hidden">
	<div class="featured-post__content">
		<?php
		foreach ( $memory_featured_posts as $index => $post ) :
			setup_postdata( $post );
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'memory-thumbnails-1' ); ?>
				</a>
				<div class="featured-wrapper">
					<div class="featured-content">
						<header class="entry-header">
							<?php memory_the_category(); ?>
						</header>

						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

						<div class="entry-meta">
							<?php
							memory_posted_on();
							?>
						</div><!-- .entry-meta -->
					</div>
				</div>
			</article>
		<?php endforeach; ?>
	</div>
</div>
<?php
wp_reset_postdata();
