<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */
include_once( __DIR__ . '/../CartManager.php' );

/**
 * Removes an item from the cart via CartManager. 
 *
 * This script should be called by the client via AJAX.
 *
 *************************************************************************** *
 * Example (JavaScript/JQuery):
 * ************************************************************************** *
 * // index of the item in the cart that we wish to remove
 * var index = 0;
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
 *			// log the data for debug
 *			console.log( data );
 *		}
 * }
 *
 * // makes an asynchonous AJAX request via POST
 * $.post( "./php/cart/ajax/cart_remove_item.php", itemData, successHandler );
 *************************************************************************** *
 * @param
 * Integer index - Array Index of item to remove from the cart
 *************************************************************************** *
 * @return 
 * On Success	: 	String 	- e.g. 'Cart(0)'
 * On Exception	: 	JSON	- file, line, and message of the exception
 *************************************************************************** *
 * @author(s) nicholas malacarne <nicholas.malacarne@gmail.com>
 */
try {

	// initialize cart manager -nm
	$CART_MGR = CartManager::getInstance();

	// TESTING!
	// http://localhost/TeamLacys/php/cart/ajax/cart_remove_item.php

	// initialize cart manager -nm
	$CART_MGR = CartManager::getInstance();

	// remove the element at the specified index id -nm
	$CART_MGR->removeItem( 0 ); 
	
	// END TEST !
	
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		// remove the element at the specified index -nm
		$CART_MGR->removeItem( $_POST[ "index" ] ); 
		
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