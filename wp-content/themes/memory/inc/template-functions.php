<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Memory
 */

/**
 * Get whether the it is a full width list view.
 *
 * @return bool
 */
function memory_is_list_layout() {
	return 'list' === get_theme_mod( 'blog_style' );
}


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function memory_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Sticky header.
	$classes[] = 'sticky-header';

	// Sticky sidebar.
	$classes[] = 'sticky-sidebar';

	// Check jetpack active and module subscriptions enable.
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'subscriptions' ) ) {
		$classes[] = 'subscriptions-enable';
	}

	// Site title.
	$site_title = get_theme_mod( 'site_title', true );
	if ( ! $site_title ) {
		$classes[] = 'site-title-hidden';
	}

	// Site description.
	$site_description = get_theme_mod( 'site_description', true );
	if ( ! $site_description ) {
		$classes[] = 'site-description-hidden';
	}

	// Footer title.
	$footer_title = get_theme_mod( 'ft_site_title', true );
	if ( ! $footer_title ) {
		$classes[] = 'footer-title-hidden';
	}

	// Footer description.
	$footer_description = get_theme_mod( 'ft_site_description', true );
	if ( ! $footer_description ) {
		$classes[] = 'footer-description-hidden';
	}

	// Adds a class of style blog.
	if ( ! is_singular() ) {
		if ( memory_is_list_layout() ) {
			$classes[] = 'default overlap';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'memory_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function memory_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'memory_pingback_header' );

/**
 * Add No-JS Class.
 * If we're missing JavaScript support, the HTML element will have a no-js class.
 */
function memory_no_js_class() {
	if ( memory_is_amp() ) {
		return;
	}
	?>
	<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
	<?php

}
add_action( 'wp_head', 'memory_no_js_class' );

/**
 * Add classes to articles.
 *
 * This logic used to be in the checkNotHaveThumbnail() in script.js.
 *
 * @param string[] $classes Post classes.
 * @param int      $post_id Post ID.
 * @return string[] Classes.
 */
function memory_post_classes( $classes, $post_id ) {
	if ( ! has_post_thumbnail( $post_id ) && ! get_post_gallery( $post_id, false ) ) {
		$classes[] = memory_is_list_layout() ? 'no-vertical-margin-auto-horizontal-margin' : 'no-margin';
	}
	return $classes;
}
add_filter( 'post_class', 'memory_post_classes', 10, 2 );
