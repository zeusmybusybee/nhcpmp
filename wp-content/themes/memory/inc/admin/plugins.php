<?php
/**
 * Add required and recommended plugins.
 *
 * @package memory
 */

add_action( 'tgmpa_register', 'memory_register_required_plugins' );
add_filter( 'ocdi/register_plugins', 'memory_register_ocdi_plugins' );

function memory_register_required_plugins() {
	tgmpa( memory_required_plugins(), [
		'id'          => 'memory',
		'has_notices' => true,
	] );
}

function memory_register_ocdi_plugins( $plugins ) {
	return array_merge( $plugins, memory_required_plugins() );
}

function memory_required_plugins() {
	$url = 'http://demo.featherlayers.com/';

	return [
		[
			'name' =>  'Jetpack',
			'slug' => 'jetpack',
		],
		[
			'name' =>  'Slim SEO',
			'slug' => 'slim-seo',
		],
		[
			'name' =>  'Falcon',
			'slug' => 'falcon',
		],
		[
			'name' =>  'Social Slider Widget',
			'slug' => 'instagram-slider-widget',
		],
	];
}
