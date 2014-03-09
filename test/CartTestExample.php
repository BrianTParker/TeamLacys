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
		
        $CART_MGR  	= CartManager::getInstance(); // OK!
		$CART_MGR2	= CartManager::getInstance(); // OK!
		//$CART_MGR3   = unserialize( $_SESSION[ 'CartManager' ] ); NOT OK!
        
		// instance check -nm
        If ($CART_MGR === $CART_MGR2){
		
			echo "<b>Status: <font color='green'>OK</font></b>";
			
		}else{
		
			echo "<b>Status: <font color='red'>ERROR</font></b>";
		};
		
		// list the contents of the first CartManager -nm
		echo "<h4>". $CART_MGR ."</h4>";
		
        echo "<table width='800' border='1'>";
		
		$cartItems = $CART_MGR->getItems();
		
		foreach( $cartItems  as $key => $value ){
			
			echo "<tr>";
			
			foreach( $value as $inKey => $inValue ){
				
				echo "<th>" . $inKey . "</th>";
			}
			
			echo "</tr>";
		}
		
		echo "</table>";
		
		unset( $CART_MGR );
		unset( $CART_MGR2 );
        ?>
    </body>
</html>