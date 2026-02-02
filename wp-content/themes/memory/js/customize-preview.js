/**
 * Theme Customizer enhancements for a better user experience.
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @package Memory.
 */

( function( $, customize, document, body ) {
	var options = {
		'blogname': '.site-title a',
		'blogdescription': '.site-description',
		'subscribe_text' : '.header-subscription #subscribe-text p',
		'footer_subscribe_title' : '.footer-subscription .widgettitle',
		'footer_subscribe_text' : '.footer-subscription #subscribe-text p',
		'readmore_text' : '.article-container .link-more a',
	};

	// Use each to resolve closure problem.
	$.each( options, function ( setting, selector ) {
		wp.customize( setting, function ( value ) {
			value.bind( function ( to ) {
				$( selector ).html( to );
			} );
		} );
	} );

	var settings = {
		'site_title'         : 'site-title-hidden',
		'site_description'   : 'site-description-hidden',
		'ft_site_title'      : 'footer-title-hidden',
		'ft_site_description': 'footer-description-hidden',
	};

	Object.keys( settings ).forEach( function( key ) {
		customize( key, function( setting ) {
			setting.bind( function( value ) {
				body.classList.toggle( settings[key], !value );
			} );
		} );
	} );

	customize( 'subscribe_button', function( setting ) {
		setting.bind( function( value ) {
			$( '.header-subscription #subscribe-submit input[type="submit"]' ).val( value );
		} );
	} );
} )( jQuery, wp.customize, document, document.body );
