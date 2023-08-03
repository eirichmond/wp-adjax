(function( $ ) {
	
	'use strict';

	$('.clicked-class').on('click', function(){
		
		
		jQuery.post(
			script_object.ajax_url,
			{
				// wp ajax action
				action : 'action_hook_function_name',
				nextNonce : script_object.nextNonce,
				consent : true,
			},
			
			function( response ) {					
				console.log( response );
			}

		);
	});

})( jQuery );