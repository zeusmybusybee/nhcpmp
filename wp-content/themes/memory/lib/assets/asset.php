<?php
/**
 * Custom asset.
 *
 * @package Memory
 */

/**
 * Enqueue the plugin main CSS and JS files.
 */
function gt_addons_enqueue_scripts() {
	// Plugin's CSS file.
	if ( memory_is_amp() ) {
		wp_enqueue_style( 'gt-addons-style', GT_LIB_URL . '/style-amp.css', '', '1.0' );
	} else {
		wp_enqueue_style( 'gt-addons-style', GT_LIB_URL . '/style.css', '', '1.0' );
	}

	// Theme's fonts.
	wp_enqueue_style( 'gt-fonts', gt_get_fonts_url(), '', '1.0' );

	// Theme's custom script.
	if ( ! memory_is_amp() ) {
		wp_enqueue_script( 'gt-addons-theme-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );
	}

}
add_action( 'wp_enqueue_scripts', 'gt_addons_enqueue_scripts', 1 );

/**
 * Enqueue scripts and styles from libraries.
 *
 * Libraris available:
 *
 * slick (Slider)
 */
function gt_addons_enqueue_asset_libraries() {
	$libraries = gt_addons_get_asset_libraries();

	$css = GT_LIB_URL . '/assets/css/';
	$js  = GT_LIB_URL . '/assets/js/';

	// Slick.
	if ( ! memory_is_amp() && in_array( 'slick', $libraries, true ) ) {
		wp_enqueue_style( 'slick', $css . 'slick.css', '', '1.8.1' );
		wp_enqueue_script( 'slick', $js . 'slick.js', array( 'jquery' ), '1.8.1', true );
	}
}
add_action( 'wp_enqueue_scripts', 'gt_addons_enqueue_asset_libraries', 0 );

/**
 * Get asset libraries.
 * Themes should filter to this.
 *
 * @return array
 */
function gt_addons_get_asset_libraries() {
	return apply_filters( 'gt_addons_asset_libraries', array() );
}

/**
 * Add editor style.
 */
function gt_add_editor_styles() {
	$styles   = array(
		'css/editor-style.css',
	);
	$styles[] = gt_get_fonts_url();
	add_editor_style( $styles );
}
add_action( 'init', 'gt_add_editor_styles' );

/**
 * Get function that returns font URL.
 *
 * @return string|bool
 */
function gt_get_fonts_url() {
	$theme         = get_template();
	$function_name = str_replace( '-', '_', "{$theme}_fonts_url" );

	return function_exists( $function_name ) ? $function_name() : false;
}
