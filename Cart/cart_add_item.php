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
    
	
	
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		/* # MySQL with PDO_MYSQL
		$DBH = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
		
		// prepared statement; get all attributes of item by id -nm
		$cart_sql = $DBH->query("select id, name, description, image_location,price from products where id = '" . $_POST[ 'id' ] . "'"); */
		
		// initialize cart manager -nm
		$CART_MGR = CartManager::init();
	/* 
		// it may be faster if we use POST data in place of DB -nm
		$cart_sql->setFetchMode(PDO::FETCH_ASSOC);

		// for each row -nm
		while($row = $cart_sql->fetch()) {
		
			// add the row to the cart via cart manager -nm
			$CART_MGR->addItem( $row );
		} */
		
		// associative array to represent an item -nm
		$item = array();
		
		// for each key and value -nm
		foreach( $_POST as $key => $value ){
		
			$item[ $key ] = $value;
		}
		
		$CART_MGR->addItem( $item );
		
		// return cart manager as string -nm
		echo $CART_MGR;
	}
    
}catch( Exception $e ){
    
    $report = "";
    
    $report += $e->getFile();
    $report += $e->getLine();
    $report += $e->getMessage();
    
	// return exception report -nm
    echo $report;
}

exit();