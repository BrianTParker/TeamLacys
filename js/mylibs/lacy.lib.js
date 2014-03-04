(function ( $ ){

	// add to cart AJAX functionality -nm
	$( "#addCartForm" ).submit( function( event ){
	
		event.preventDefault();
		
		//console.log( $( this ).serialize() );
		
		$.post( "./Cart/cart_add_item.php", $( this ).serialize(), function( data ){
		
			$( "#cartmgr" ).html( data );
		} );
	} );
	
})( jQuery );