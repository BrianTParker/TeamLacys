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
        
		// are both CartManager objects the same instance? -nm
		print_r( "<h4>CartManager 1 === CartManager2 ? </h4>" );
        print_r($CART_MGR === $CART_MGR2); // 1 == TRUE, 0 == FALSE
		
		// list the contents of CartManager that was instantiated first -nm
		print_r( "<h4>CartManager 1 : </h4>" );
        print_r( $CART_MGR->getItems() );
		
		// list the contents of CartManager that was instantiated second -nm
		print_r( "<h4>CartManager 2 : </h4>" );
        print_r( $CART_MGR2->getItems() );
		
		print_r( "<h4>Current Session Keys : </h4>" );
		foreach( array_keys( $_SESSION ) as $key ){
		
			print_r( $key );
			print_r( "<br>" );
		}
		
		print_r( "<h4>Unsetting CartManager Session ! </h4>" );
		unset( $_SESSION[ "CartManager" ] );
		
		print_r( "<h4>Current Session Keys : </h4>" );
		foreach( array_keys( $_SESSION ) as $key ){
		
			print_r( $key );
			print_r( "<br>" );
		}
		
		phpinfo();
        ?>
    </body>
</html>