<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */
include_once( "./CartManager.php" );

/**
 * Adds an item to the CartManager. 
 *
 * @author(s) nicholas malacarne <nicholas.malacarne@gmail.com>
 */
try {

	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="admin"; // Mysql password 
	$db_name="advanced_systems_project"; // Database name 

	# MySQL with PDO_MYSQL
	$DBH = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    
	// TODO: id as post data -nm
	$cart_sql = $DBH->query("select id, name, description, image_location,price from products where id = '1'");
	
	
	// TEST -nm
	$CART_MGR = CartManager::init();
		
	$cart_sql->setFetchMode(PDO::FETCH_ASSOC);

	while($row = $cart_sql->fetch()) {
	
		$CART_MGR->addItem( $row );
	}
	
	echo $CART_MGR;
	echo "<br>";
	
	foreach( $CART_MGR->getItems() as $value ){
	
		print_r( $value );
		echo "<br>";
	}
	// END TEST -nm
	
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		// initialize cart manager -nm
		$CART_MGR = CartManager::init();
	
		// we want an associative array -nm
		$cart_sql->setFetchMode(PDO::FETCH_ASSOC);

		// for each row -nm
		while($row = $cart_sql->fetch()) {
		
			// add the row to the cart via cart manager -nm
			$CART_MGR->addItem( $row );
		}
	}
    
    
}catch( Exception $e ){
    
    $report = "";
    
    $report += $e->getFile();
    $report += $e->getLine();
    $report += $e->getMessage();
    
    echo $report;
}

exit();