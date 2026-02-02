<?php
/**
 * Customizer.
 *
 * @package Gt addons
 */

/**
 * Require sanitization callbacks.
 */
require dirname( __FILE__ ) . '/sanitization-callbacks.php';

/**
 * Register custom Customize controls.
 */
function gt_register_customize_controls() {
	$files = glob( dirname( __FILE__ ) . '/controls/*.php' );
	foreach ( $files as $file ) {
		require $file;
	}
}

// Run at priority 0 to make it available everywhere.
add_action( 'customize_register', 'gt_register_customize_controls', 0 );
