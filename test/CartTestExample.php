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
        
		session_start();
		
		print_r( "<h6>Initializing Cart Manager 1 Object</h6>" );
        $CART_MGR  	= CartManager::getInstance();
		
		print_r( "<h6>Initializing Cart Manager 2 Object</h6>" );
        $CART_MGR2   = CartManager::getInstance();
        
		// instance check -nm
		print_r( "<h4>CartManager 1 === CartManager2 :</h4>" );
        print_r($CART_MGR === $CART_MGR2); // 1 == TRUE, 0 == FALSE
		
		// list the contents of the first CartManager -nm
		print_r( "<h4>CartManager 1 Contents : </h4>" );
        print_r( $CART_MGR->getItems() );
		
		// list the contents of the second CartManager -nm
		print_r( "<h4>CartManager 2 Contents : </h4>" );
        print_r( $CART_MGR2->getItems() );
		
		print_r( "<h4>Current Session Keys : </h4>" );
		foreach( array_keys( $_SESSION ) as $key ){
		
			print_r( $key );
			print_r( "<br>" );
		}
		
		phpinfo();
        ?>
    </body>
</html>