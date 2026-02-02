<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Memory
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function memory_jetpack_setup() {
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Featured content.
	add_theme_support(
		'featured-content',
		array(
			'filter'    => 'memory_get_featured_posts',
			'max_posts' => 10,
		)
	);

	// Social menu.
	add_theme_support( 'jetpack-social-menu' );

	// Remove sharing counts.
	add_filter( 'jetpack_sharing_counts', '__return_false' );
}
add_action( 'after_setup_theme', 'memory_jetpack_setup' );

/**
 * Remove sharing jetpack.
 */
function memory_remove_sharing_jetpack() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
add_action( 'loop_start', 'memory_remove_sharing_jetpack' );

/**
 * Deregister jetpack style.
 */
function memory_deregister_jetpack_style() {
	wp_deregister_style( 'jetpack-social-menu' );
	wp_deregister_style( 'jetpack-subscriptions' );
	wp_dequeue_style( 'jetpack-widget-social-icons-styles' );
}
add_action( 'wp_enqueue_scripts', 'memory_deregister_jetpack_style', 999 );
