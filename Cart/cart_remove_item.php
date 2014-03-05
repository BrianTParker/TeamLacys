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

	// TEST -nm
	$CART_MGR = CartManager::init();
		
	$CART_MGR->removeItem( 0 );
	
	echo $CART_MGR;
	
	// END TEST -nm
	
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