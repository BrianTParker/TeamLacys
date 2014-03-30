<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */
include_once( __DIR__ . '/AccountManager.php' );

/**
 * Logs a user in as a guest. 
 *
 * @author(s) nicholas malacarne <nicholas.malacarne@gmail.com>
 */
session_start(); 
ob_start();
 
try {
	
	echo __DIR__ . __FILE__ . "\n\n TODO: log user in as guest via AccountManager";
    
}catch( Exception $e ){
    
    $report = "";
    
    $report += $e->getFile();
    $report += $e->getLine();
    $report += $e->getMessage();
    
    echo $report;
}

exit();