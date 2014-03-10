<!DOCTYPE html>
<!--
 @description
 @author(s)
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
		<h1>CartManager Test Example</h1>
        <?php
		// RUN: http://localhost/TeamLacys/test/CartTestExample.php
		
        include_once( __DIR__ . "/../php/cart/CartManager.php" );
		
        $CART_MGR  	= CartManager::getInstance(); // OK!
		$CART_MGR2	= CartManager::getInstance(); // OK!
		//$CART_MGR3   = unserialize( $_SESSION[ 'CartManager' ] ); NOT OK!
        
		// both objects should be the same instance (a change to one will affect the other) -nm
        If ($CART_MGR === $CART_MGR2){
		
			echo "<b>Status: <font color='green'>OK</font></b>";
			
		}else{
		
			echo "<b>Status: <font color='red'>ERROR</font></b>";
		};
		
		// list the contents of the first CartManager -nm
		echo "<h4>". $CART_MGR ."</h4>";
		
        echo "<table  border='1'>";
		
		echo "<tr>";
			
		echo "<th>Cart Index</th>" ;
		echo "<th>Id</th>" ;
		echo "<th>Name</th>" ;
		echo "<th>Description</th>" ;
		echo "<th>Image</th>";
		
		echo "</tr>";
		
		foreach( $CART_MGR2->getItems() as $key => $array ){
		
			echo "<tr>";
			
			echo "<td>" . $key . "</td>";
			echo "<td>" . $array[ "id" ] . "</td>";
			echo "<td>" . $array[ "name" ] . "</td>";
			echo "<td>" . $array[ "description" ] . "</td>";
			echo "<td>" . $array[ "image_location" ] . "</td>";
			
			echo "</tr>";
		}
		
		echo "</table>";
		
		unset( $CART_MGR );
		unset( $CART_MGR2 );
        ?>
    </body>
</html>