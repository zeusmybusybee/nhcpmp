/**
 * Slideout sidebar script.
 *
 * @package Memory.
 */

jQuery( function ( $ ) {
	'use strict';

	var clickEvent  = 'ontouchstart' in window ? 'touchstart' : 'click';
	var $body       = $( 'body' );
	var $menuToggle = $( '.slideout-sidebar-enabel .menu-toggle' );

	$menuToggle.on( clickEvent, function( e ) {
		e.stopPropagation(); // do not trigger event on .site.
		$body.addClass( 'slideout-sidebar-open' );
	} );
	$( '.site, .header__close' ).on( clickEvent, function() {
		$body.removeClass( 'slideout-sidebar-open' );
	} );

} );
