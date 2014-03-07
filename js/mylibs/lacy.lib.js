(function ( $ ){

	// add to cart AJAX functionality -nm
	$( "#addCartForm" ).submit( function( event ){
	
		event.preventDefault();
		
		//console.log( $( this ).serialize() );
		
		$.post( "./php/cart/ajax/cart_add_item.php", $( this ).serialize(), function( data ){
		
			$( "#cartmgr" ).html( data );
		} );
	} );
	
	// add to cart AJAX functionality -nm
	$( "#logout" ).click( function( event ){
	
		event.preventDefault();
		
		$.post( "./Account/account_logout.php", function( data ){
		
			// reload page -nm
			location.reload(true);
		} );
	} );
	
})( jQuery );