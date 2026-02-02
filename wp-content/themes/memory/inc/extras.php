<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package memory
 */

add_filter( 'comment_form_default_fields', 'memory_modify_comment_form_default' );
/**
 * Modify default comment form.
 *
 * @param array $fields default field.
 */
function memory_modify_comment_form_default( $fields ) {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html_req  = ( $req ? " required='required'" : '' );
	$html5     = 'html5' === current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$fields['author'] = '<p class="comment-form-author">' .
	'<input id="author" name="author" placeholder="' . esc_attr__( 'Full Name *', 'memory' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>';
	$fields['email']  = '<p class="comment-form-email">' .
	'<input id="email" placeholder="' . esc_attr__( 'Mail Address *', 'memory' ) . '" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req . ' /></p>';
	$fields['url']    = '<p class="comment-form-url">' .
	'<input id="url" placeholder="' . esc_attr__( 'Website URL', 'memory' ) . '" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>';
	return $fields;
}

add_filter( 'comment_form_defaults', 'memory_modify_comment_form_args' );
/**
 * Modify default comment form args.
 *
 * @param array $defaults default args.
 */
function memory_modify_comment_form_args( $defaults ) {
	$defaults['label_submit']         = esc_html__( 'Submit', 'memory' );
	$defaults['title_reply_before']   = '';
	$submit_button                    = sprintf(
		$defaults['submit_button'],
		esc_attr( $defaults['name_submit'] ),
		esc_attr( $defaults['id_submit'] ),
		esc_attr( $defaults['class_submit'] ),
		esc_attr( $defaults['label_submit'] )
	);
	$submit_field                     = sprintf(
		$defaults['submit_field'],
		$submit_button,
		get_comment_id_fields( get_the_ID() )
	);
	$defaults['submit_field']         = '';
	$defaults['comment_field']        = '<div class="comment-form-comment"><textarea id="comment" placeholder="' . esc_attr__( 'Write Your Comments Here...', 'memory' ) . '" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea>' . $submit_field . '</div>';
	$defaults['title_reply']          = '';
	$defaults['comment_notes_before'] = '';
	return $defaults;
}

/**
 * Change the Tag Cloud's Font Sizes
 *
 * @param array $args Widget area.
 *
 * @return array.
 */
function memory_tag_cloud_fz( $args ) {
	$args['largest']  = 1.3;
	$args['smallest'] = 1.3;
	$args['unit']     = 'rem';

	return $args;
}

add_filter( 'widget_tag_cloud_args', 'memory_tag_cloud_fz' );

/**
 * Change excerpt length
 *
 * @return string.
 */
function memory_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	$length = get_theme_mod( 'blog_excerpt', 17 );
	return $length;
}
add_filter( 'excerpt_length', 'memory_excerpt_length' );

/**
 * Change the [...] to a 'continue reading' link automatically.
 *
 * @return string.
 */
function memory_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	return '&hellip;';
}
add_filter( 'excerpt_more', 'memory_excerpt_more' );
add_filter( 'the_content_more_link', 'memory_excerpt_more' );

/**
 * Get the map from the page/post content.
 *
 * @package memory
 */
function memory_get_iframe() {
	$main_content = apply_filters( 'the_content', get_the_content() );
	$media        = get_media_embedded_in_content( $main_content, array( 'iframe' ) );
	if ( $media ) {
		$media = reset( $media );
		echo wp_kses_post( $media );
	}
}

/**
 * Check format video
 *
 * @return true
 */
function memory_has_video() {
	$main_content = apply_filters( 'the_content', get_the_content() );
	$media        = get_media_embedded_in_content(
		$main_content,
		array(
			'video',
			'object',
			'embed',
			'iframe',
		)
	);

	if ( $media ) {
		return true;
	}
}

/**
 * Add iFrame to allowed wp_kses_post tags
 *
 * @param string $tags Allowed tags, attributes, and/or entities.
 * @param string $context Context to judge allowed tags by. Allowed values are 'post'.
 *
 * @return mixed
 */
function memory_wpkses_post_tags( $tags, $context ) {
	if ( 'post' === $context ) {
		$tags['iframe'] = array(
			'src'             => true,
			'height'          => true,
			'width'           => true,
			'frameborder'     => true,
			'align'           => true,
			'allowfullscreen' => true,
		);
	}
	return $tags;
}
add_filter( 'wp_kses_allowed_html', 'memory_wpkses_post_tags', 10, 2 );
