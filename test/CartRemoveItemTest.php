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
		<h1>CartManager Remove Item Test</h1>
        <?php
		// URL to test: http://localhost/TeamLacys/test/CartRemoveItemTest.php -nm
		
        include_once( __DIR__ . "/../php/cart/CartManager.php" );
        
		// instantiate CartManager object -nm
        $CART_MGR  	= CartManager::getInstance();
        
		print_r( "<h4>Current Items In Cart : ". $CART_MGR ."</h4>" );
		print_r( $CART_MGR->getItems() );
		
		print_r( "<h4>Removing 1x Item From Cart (index 0) ! </h4>" );
		print_r( $CART_MGR->removeItem( 0 ) );
		
		print_r( "<h4>Remaining Items In Cart : ". $CART_MGR ."</h4>" );
		print_r( $CART_MGR->getItems() );
		
		phpinfo();
        ?>
    </body>
</html>