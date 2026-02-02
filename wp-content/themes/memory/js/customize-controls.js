( function( api ) {

	// Extends our custom "gt-link" section.
	api.sectionConstructor['gt-link'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
