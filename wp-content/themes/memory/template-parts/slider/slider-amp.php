<?php
		$featured_posts = memory_get_featured_posts();
		if ( empty( $featured_posts ) ) {
			return;
		}
		?>
		<div class="homepage-slider">
			<amp-carousel class="amp-slider amp-featured-slider" layout="responsive" type="slides" width="780" height="500" delay="3500">
				<?php
				foreach ( $featured_posts as $index => $post ) :
					setup_postdata( $post );
					?>
					<article id="post-<?php the_ID(); ?>">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail(); ?>
						</a>
						<div class="featured-wrapper">
							<div class="featured-content">

								<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '?amp" rel="bookmark">', '</a></h2>' ); ?>

							</div>
						</div>
					</article>
				<?php endforeach;

				wp_reset_postdata();

				?>
			</amp-carousel>
		</div>