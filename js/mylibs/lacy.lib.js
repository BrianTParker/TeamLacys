(function ( $ ){

	// add to cart AJAX functionality -nm
	$( "#addCartForm" ).submit( function( event ){
	
		event.preventDefault();
		
		//console.log( $( this ).serialize() );
		
		$.post( "./php/cart/ajax/cart_add_item.php", $( this ).serialize(), function( data ){
		
			//$( "#cartmgr" ).html( data );
			// load the cart page -nm
			window.location.href = "./cart.php";
		} );
	} );
	
	// remove from cart AJAX functionality -nm
	$( "#removeCartForm" ).submit( function( event ){
	
		event.preventDefault();
		
		$.post( "./php/cart/ajax/cart_remove_item.php", $( this ).serialize(), function( data ){
		
			// reload page -nm
			location.reload(true);
			//console.log(data);
		} );
	} );
	
	// redirect to login page -nm
	$( "#gotoLogin" ).click( function( event ){
	
		event.preventDefault();
		
		// load the login page -nm
		window.location.href = "./login.php";
	} );
	
	// redirect to newuser page -nm
	$( "#gotoNewUser" ).click( function( event ){
	
		event.preventDefault();
		
		// load the newuser page -nm
		window.location.href = "./newuser.php";
	} );
	
	// guest login AJAX -nm
	$( "#guestUserForm" ).submit( function( event ){
	
		event.preventDefault();
		
		$.post( "./Account/account_guest_login.php", function( data ){
		
			// load the checkout page -nm
			//window.location.href = "./checkout.php";
			alert(data);
		} );
	} );
	
	// add to cart AJAX functionality -nm
	$( "#logout" ).click( function( event ){
	
		event.preventDefault();
		
		$.post( "./Account/account_logout.php", function( data ){
		
			// load the index page -nm
			window.location.href = "./index.php";
		} );
	} );
    
    // hides/reveals shipping inputs on the checkout page
    $("input[name='shipping']").change(function(){
        if($(this).val() === "pickup"){
            $("#shippingInput").hide();
			$("#storeSelect").show();
        }else{
            $("#shippingInput").show();
			$("#storeSelect").hide();
        }
    });
	
})( jQuery );