<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */

/**
 * Logs an account out. 
 *
 * @author(s) nicholas malacarne <nicholas.malacarne@gmail.com>
 */
session_start(); 
ob_start();
 
try {
	
	// would an account class be useful? -nm
	unset($_SESSION['firstName']);
	unset($_SESSION['lastName']);
	unset($_SESSION['email']);
	unset($_SESSION['id']);
    
}catch( Exception $e ){
    
    $report = "";
    
    $report += $e->getFile();
    $report += $e->getLine();
    $report += $e->getMessage();
    
    echo $report;
}

exit();