<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package memory
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses memory_header_style()
 */
function memory_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'memory_custom_header_args',
			array(
				'default-text-color' => '#000000',
				'width'              => 1920,
				'height'             => 500,
				'flex-width'         => true,
				'flex-height'        => true,
				'wp-head-callback'   => 'memory_header_style',
			)
		)
	);
}

add_action( 'after_setup_theme', 'memory_custom_header_setup' );

/**
 * Show the header image and optionally hide the site title, site description.
 */
function memory_header_style() {
	$style = '';
	if ( ! display_header_text() ) {
		$style .= '.site-branding .site-title, .site-branding .site-description, .footer-branding .site-title, .footer-branding .site-description { clip: rect(1px, 1px, 1px, 1px); position: absolute; }';
	}
	if ( $style ) :
		?>
		<style id="memory-header-css">
			<?php echo esc_html( $style ); ?>
		</style>
		<?php
	endif;
}
