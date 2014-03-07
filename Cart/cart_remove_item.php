<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */
include_once( "./CartManager.php" );

/**
 * Removes an item from the CartManager. This script should be called via AJAX.
 *
 * @author(s) nicholas malacarne <nicholas.malacarne@gmail.com>
 */
try {
	
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
		// initialize cart manager -nm
		$CART_MGR = CartManager::init();
	
		// remove the element at the specified index id -nm
		$CART_MGR->removeItem( $_POST[ "id" ] ); 
	}
    
    
}catch( Exception $e ){
    
    $report = "";
    
    $report += $e->getFile();
    $report += $e->getLine();
    $report += $e->getMessage();
    
    echo $report;
}

exit();