<?php
/**
 * Custom components for GT addons.
 *
 * @package Memory
 */

/**
 * Add theme asset libraries.
 *
 * @param array $libraries assets.
 */
function memory_asset_libraries( $libraries ) {
	$libraries[] = 'slick';

	return $libraries;
}
add_filter( 'gt_addons_asset_libraries', 'memory_asset_libraries' );

/**
 * Get Google fonts URL for the theme.
 *
 * @return string Google fonts URL for the theme.
 */
function memory_fonts_url() {
	$fonts   = array();
	$subsets = 'latin,latin-ext';

	if ( 'off' !== _x( 'on', 'Josefin Sans font: on or off', 'memory' ) ) {
		$fonts[] = 'Josefin Sans:300,600';
	}

	if ( 'off' !== _x( 'on', 'Work Sans font: on or off', 'memory' ) ) {
		$fonts[] = 'Work Sans:400,500,600,700';
	}

	$fonts_url = add_query_arg(
		array(
			'family' => rawurlencode( implode( '|', $fonts ) ),
			'subset' => rawurlencode( $subsets ),
		),
		'https://fonts.googleapis.com/css'
	);

	return $fonts_url;
}

/**
 * Add theme asset libraries.
 *
 * @param array $libraries modules.
 */
function memory_components_libraries( $libraries ) {

	$libraries[] = 'searchform-modal';
	$libraries[] = 'header-menu';
	$libraries[] = 'slideout-sidebar-enabel';
	$libraries[] = 'dropdown-widget-navmenu';

	return $libraries;
}
add_filter( 'gt_addons_components_libraries', 'memory_components_libraries' );
add_filter( 'body_class', 'memory_components_libraries' ); // add class to body.
