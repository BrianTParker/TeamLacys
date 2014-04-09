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
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$report = AccountManager::getInstance()->createNewAccount( $_POST[ "fName" ], $_POST[ "lName" ], 
																   $_POST[ "email" ], $_POST[ "phone" ],
																   "password", 		  "password",
																   $_POST[ "alvl" ],  $_POST[ "active" ]);
																   
		print_r($report);
	}
    
}catch( Exception $e ){
    
    $report = "";
    
    $report += $e->getFile();
    $report += $e->getLine();
    $report += $e->getMessage();
    
    echo $report;
}

exit();