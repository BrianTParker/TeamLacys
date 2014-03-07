<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */
include_once( __DIR__ . '/../CartManager.php' );

/**
 * Adds an item to the cart via CartManager.
 *
 * This script should be called by the client via AJAX.
 *
 *************************************************************************** *
 * Example (JavaScript/JQuery):
 * ************************************************************************** *
 * // JSON object to represent an item
 * var itemData = { "key": "value" };
 *
 * // callback function that is executed if the request succeeds
 * function successHandler( data, textStatus, jqXHR ){
 * 		
 *		// if return data is a string
 *		if ( typeof data == 'string' ){
 * 			
 *			// insert data into DOM
 *			$( '#someId' ).html( data );
 *
 *		}else{
 * 			
 *			// an exception was thrown; log the data for debug
 *			console.log( data );
 *		}
 * }
 *
 * // makes an asynchonous AJAX request via POST
 * $.post( "./php/cart/ajax/cart_add_item.php", itemData, successHandler );
 *************************************************************************** *
 * @param
 * $_POST - Each key/value pair is copied into an item array; then the item
 * 			is added to the cart
 *************************************************************************** *
 * @return 
 * On Success: 		String 	- e.g. 'Cart(0)'
 * On Exception: 	JSON	- file, line, and message of the exception
 *************************************************************************** *
 * @author(s) nicholas malacarne <nicholas.malacarne@gmail.com>
 */
try {

	// initialize cart manager -nm
	$CART_MGR = CartManager::getInstance();

	/* // TESTING!
	// http://localhost/TeamLacys/php/cart/ajax/cart_add_item.php

	// add test item -nm
	$CART_MGR->addItem( "Test Item" ); 
	
	// END TEST ! */
	
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		// associative array to represent an item -nm
		$item = array();
		
		// for each key/value -nm
		foreach( $_POST as $key => $value ){
		
			// copy the key/value to the item array -nm
			$item[ $key ] = $value;
		}
		
		// add item to cart -nm
		$CART_MGR->addItem( $item );
	}
	
	// return cart manager as string -nm
	echo $CART_MGR;
	
	// save the cart manager to session -nm
	unset( $CART_MGR );
    
}catch( Exception $e ){
    
    $report = array();
    
    $report[ 'file' ] 		= $e->getFile();
    $report[ 'line' ] 		= $e->getLine();
    $report[ 'message' ] 	= $e->getMessage();
    
	// return exception report as JSON -nm
    echo json_encode( $report );
}

exit();