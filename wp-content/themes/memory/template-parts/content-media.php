<?php
/**
 * Display an optional post thumbnail, video in according to post formats
 * above the post excerpt in the archive page.
 *
 * @package memory
 */

if ( has_post_format( array( 'video' ) ) ) {
	$memory_main_content = apply_filters( 'the_content', get_the_content() );
	$memory_media        = get_media_embedded_in_content(
		$memory_main_content,
		array(
			'video',
			'object',
			'embed',
			'iframe',
		)
	);

	if ( $memory_media ) {
		$memory_media = reset( $memory_media );
		echo '<div class="entry-media">' . wp_kses_post( $memory_media ) . '</div>'; /* WPCS: xss ok. */
		return;
	}
}

if ( has_post_format( 'gallery' ) ) {
	$memory_gallery = get_post_gallery( get_the_id(), false );
	if ( ! empty( $memory_gallery['ids'] ) ) {
		$memory_gallery_id = explode( ',', $memory_gallery['ids'] ); ?>

		<div class="grid-gallery
		<?php if ( ! memory_is_amp() ) : ?>
			is-hidden
		<?php endif; ?>
		">

			<?php
			if ( memory_is_amp() ) : ?>
			<amp-carousel class="amp-slider" layout="responsive" type="slides" width="780" height="500" delay="3500">
			<?php endif; ?>

			<?php
			foreach ( $memory_gallery_id as $id_item ) :

				echo wp_get_attachment_image( $id_item, 'memory-thumbnails-2' );

			endforeach;
			?>

			<?php
			if ( memory_is_amp() ) : ?>
			</amp-carousel>
			<?php endif; ?>
		</div>
		<?php
	}
	return;
}

if ( has_post_format( 'quote' ) ) {
	$memory_content = get_the_content();
	if ( preg_match( '~<blockquote>([\s\S]+?)</blockquote>~', $memory_content, $memory_quote ) ) {
		echo '<div class="entry-media quote">' . wp_kses_post( $memory_quote[0] ) . '</div>';
		return;
	}
}

if ( has_post_thumbnail() ) :
	?>
	<div class="entry-media">
		<?php
		if ( is_single() ) {
			the_post_thumbnail( 'memory-single' );
		} else {
			memory_post_thumbnail( 'memory-thumbnails-2' );
		}
		?>
	</div>
<?php endif;

if ( ! has_post_thumbnail() ) {
	return;
}
?>
