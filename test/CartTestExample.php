<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
		<h1>CartManager Test Example</h1>
        <?php
		// URL to test: http://localhost/TeamLacys/test/CartTestExample.php -nm
		
        include_once( __DIR__ . "/../php/cart/CartManager.php" );
        
		// instantiate two CartManager objects; both should reference the same instance -nm
        $CART_MGR  	= CartManager::getInstance();
        $CART_MGR2   = CartManager::getInstance();
        
		// clear all content from the cart -nm
        $CART_MGR->emptyCart();
		
        // both the first CartManager object and the second CartManager object should total two items -nm
        $CART_MGR->addItem( "Cart Manager 1 Item" );
	    $CART_MGR2->addItem( "Cart Manager 2 Item" );
        
		// are both CartManager objects the same instance? -nm
		print_r( "<h4>CartManager 1 === CartManager2 ? </h4>" );
        print_r($CART_MGR === $CART_MGR2); // 1 == TRUE, 0 == FALSE
		
		// list the contents of CartManager that was instantiated first -nm
		print_r( "<h4>CartManager 1 : </h4>" );
        print_r( $CART_MGR->getItems() );
		
		// list the contents of CartManager that was instantiated second -nm
		print_r( "<h4>CartManager 2 : </h4>" );
        print_r( $CART_MGR2->getItems() );
		
		// test session unset -nm
		unset( $CART_MGR );
		unset( $CART_MGR2 );
		
		print_r( "<h4>Current Session Keys : </h4>" );
		foreach( array_keys( $_SESSION ) as $key ){
		
			print_r( $key );
			print_r( "<br>" );
		}
		
		print_r( "<h4>Current Session Keys : </h4>" );
		unset( $_SESSION[ "CartManager" ] );
		
		print_r( "<h4>Current Session Keys : </h4>" );
		foreach( array_keys( $_SESSION ) as $key ){
		
			print_r( $key );
			print_r( "<br>" );
		}
        ?>
    </body>
</html>