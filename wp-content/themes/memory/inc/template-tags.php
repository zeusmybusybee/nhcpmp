<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Memory
 */

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function memory_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'j F Y' ) ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	echo '<span class="posted-on"><i class="icofont icofont-clock-time"></i>' . wp_kses_post( $time_string ) . '</span>';
}

/**
 * Prints HTML with meta information for the current author.
 */
function memory_posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'author: %s', 'post author', 'memory' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . wp_kses_post( $byline ) . '</span>'; // WPCS: XSS OK.

}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function memory_the_category() {
	if ( 'post' !== get_post_type() ) {
		return;
	}

	echo '<span class="entry-header__category">';
	/* translators: used between list items, there is a space after the comma */
	the_category( esc_html__( ', ', 'memory' ) );
	echo '</span>';
}

/**
 * Prints HTML with meta information for the comment number.
 */
function memory_comment_link() {
	$comment_number = get_comments_number();
	if ( ! post_password_required() && ( comments_open() || $comment_number ) ) {
		echo '<span class="comments-link"><i class="icofont icofont-speech-comments"></i>';
		comments_popup_link( $comment_number, $comment_number, $comment_number );
		echo '</span>';
	}
}


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function memory_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list();
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			echo '<span class="tags-links">' . wp_kses_post( $tags_list ) . '</span>';
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'memory' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'memory' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @param string|array $size thumbnail size.
 */
function memory_post_thumbnail( $size ) {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() && ! is_front_page() ) : ?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail( $size ); ?>
		</div><!-- .post-thumbnail -->

	<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php the_post_thumbnail( $size ); ?>
		</a>

		<?php
	endif; // End is_singular().
}

/**
 * Socials author bio.
 *
 * @param string $id user id.
 */
function memory_user_social_links( $id ) {
	$socials        = array( 'facebook', 'twitter', 'google-plus', 'linkedin', 'instagram', 'youtube-play', 'pinterest' );
	$author_website = get_the_author_meta( 'user_url', $id );
	$output         = '';

	foreach ( $socials as $social ) {
		$social_value = get_the_author_meta( $social, $id );

		if ( 'twitter' === $social && '' !== get_the_author_meta( 'twitter', $id ) ) {
			$social_value = 'https://twitter.com/' . get_the_author_meta( 'twitter', $id );
		}

		if ( empty( $social_value ) ) {
			continue;
		}

		$output .= sprintf(
			'<li><a class="social-links" href="%s"><i class="icofont icofont-%s"></i></a></li>',
			esc_url( $social_value ),
			esc_html( $social )
		);
	}

	if ( empty( $output ) ) {
		return '';
	}

	echo '<ul class="author-social">' . wp_kses_post( $output ) . '</ul>';
}

/**
 * Author Box.
 */
function memory_author_box() {
	$bio = get_the_author_meta( 'description' );
	if ( ! $bio ) {
		return;
	}
	?>
	<div class="entry-author">
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 110 ); ?>
		</div>

		<div class="author-info">
			<div class="author-header">
				<div class="author-heading">
					<h3 class="author-title">
						<?php echo wp_kses_post( '<span class="author-name">' . get_the_author() . '</span>' ); ?>
					</h3>
				</div>
			</div>

			<div class="author-bio">
				<?php the_author_meta( 'description' ); ?>
			</div>

			<?php memory_user_social_links( get_the_author_meta( 'ID' ) ); ?>

		</div><!-- .author-info -->
	</div><!-- .entry-author -->
	<?php
}

/**
 * Getter function for Featured Content.
 *
 * @return array An array of WP_Post objects.
 */
function memory_get_featured_posts() {
	return apply_filters( 'memory_get_featured_posts', array() );
}
