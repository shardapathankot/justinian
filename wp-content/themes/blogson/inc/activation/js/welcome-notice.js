( function( $ ) {
	"use strict";

	$(document).on('click', '.blogson-notice .getstarted-button', function( e ) {
		if ( 'install-activate' === $(this).data('action') && ! $( this ).hasClass('init') ) {
			var $self = $(this),
			$href = $self.attr('href');
			$self.addClass('init');
			$self.html('Installing Spiraclethemes Site Library <span class="dot-flashing"></span>');

			var spiraclethemesSiteLibraryData = {
				'action' : 'blogson_install_activate_spiraclethemes_site_library',
				'nonce' : blogson_localize.spiraclethemes_site_library_nonce
			};

			// Send Request.
			$.post( blogson_localize.ajax_url, spiraclethemesSiteLibraryData, function( response ) {
				if ( response.success ) {
					console.log('plugin installed');
					// Plugin Installed
					setTimeout(function() {
						$self.html('Redirecting to Demo Import Page <span class="dot-flashing"></span>');
						setTimeout( function() {
							window.location = $href;
						}, 1000 );
					}, 500);
					console.log('Spiraclethemes Site Library installed');
					return false;
				}
			} ).fail( function( xhr, textStatus, e ) {
				$(this).parent().after( `<div class="plugin-activation-warning">${blogson_localize.failed_message}</div>` );
			} );
			e.preventDefault();
		}
	} );
} )( jQuery );
