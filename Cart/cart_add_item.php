<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */
include_once( "./CartManager.php" );

/**
 * Adds an item to the CartManager. This script should be called via AJAX.
 *
 * @author(s) nicholas malacarne <nicholas.malacarne@gmail.com>
 */
try {
	
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		// initialize cart manager -nm
		$CART_MGR = CartManager::getInstance();
		
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