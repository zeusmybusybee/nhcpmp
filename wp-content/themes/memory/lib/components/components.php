<?php
/**
 * Custom components for GT addons.
 *
 * @package Memory
 */

/**
 * Enqueue scripts.
 *
 * List Modules:
 *
 * searchform-modal ( function: gt_searchform_modal )
 * header-menu
 * dropdown-widget-navmenu
 * slideout-sidebar-enabel ( function: gt_slideout_sidebar )
 *
 * @param array $library is library want use.
 */
function gt_components_scripts( $library = array() ) {
	$libraries  = gt_addons_get_components_libraries();
	$components = GT_LIB_URL . '/components/';

	// searchform-modal.
	if ( ! memory_is_amp() && in_array( 'searchform-modal', $libraries, true ) ) {
		wp_enqueue_script( 'gt-searchform-modal', $components . 'searchform-modal/searchform-modal.js', array( 'jquery' ), '1.0', true );
	}

	// header-menu.
	if ( ! memory_is_amp() && in_array( 'header-menu', $libraries, true ) ) {
		wp_enqueue_script( 'gt-header-menu', $components . 'header-menu/header-menu.js', array( 'jquery' ), '1.0', true );
	}

	// dropdown-widget-navmenu.
	if ( ! memory_is_amp() && in_array( 'dropdown-widget-navmenu', $libraries, true ) ) {
		wp_enqueue_script( 'gt-dropdown-widget-navmenu', $components . 'dropdown-widget-navmenu/dropdown-widget-navmenu.js', array( 'jquery' ), '1.0', true );
	}

	// slideout-sidebar.
	if ( ! memory_is_amp() && in_array( 'slideout-sidebar-enabel', $libraries, true ) ) {
		wp_enqueue_script( 'gt-slideout-sidebar', $components . 'slideout-sidebar/slideout-sidebar.js', array( 'jquery' ), '1.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'gt_components_scripts' );

/**
 * Get modules libraries.
 * Themes should filter to this.
 *
 * @return array
 */
function gt_addons_get_components_libraries() {
	return apply_filters( 'gt_addons_components_libraries', array() );
}

// Modules.
/**
 * Search modal.
 */
require GT_LIB_DIR . '/components/searchform-modal/searchform-modal.php';

/**
 * Slideout Sidebar.
 */
require GT_LIB_DIR . '/components/slideout-sidebar/slideout-sidebar.php';

// Customizer.
require GT_LIB_DIR . '/components/customizer/customizer.php';
