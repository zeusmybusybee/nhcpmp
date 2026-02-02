<?php
/**
 * Gt addon.
 *
 * @package Gt addons
 */

define( 'GT_LIB_DIR', dirname( __FILE__ ) );
define( 'GT_LIB_URL', trailingslashit( get_template_directory_uri() ) . basename( dirname( __FILE__ ) ) );

require_once GT_LIB_DIR . '/assets/asset.php';
require_once GT_LIB_DIR . '/components/components.php';
