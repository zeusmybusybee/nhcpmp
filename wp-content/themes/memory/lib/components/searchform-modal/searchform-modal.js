/**
 * Search Form modal script.
 *
 * @package Memory.
 */

jQuery(function($) {

	$( '.header__search .search-toggle' ).on( 'click', function ( e ) {
		e.stopPropagation();
		var parent = jQuery( this ).parent();
		$( '#page' ).addClass( 'gt-search-active' );
		setTimeout( function () {
			parent.find( '.search-field' ).focus();
		}, 500 );

		return false;

	} );
	jQuery( '.search-popup-bg' ).on( 'click', function () {
		var parent = jQuery( this ).parent();
		parent.find( '.search-field' ).val( '' );
		$( '#page' ).removeClass( 'gt-search-active' );

		return false;
	} );

	// $( '.header__search > a' ).on( 'click', function () {
	// 	$( this ).siblings( 'form' ).slideToggle();
	// } );

});
