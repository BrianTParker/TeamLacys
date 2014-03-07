<?php
include "../header.php";
include_once( "AccountManager.php" );
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $ACCT_MGR = AccountManager::getInstance();
    $status = $ACCT_MGR->createNewAccount($_POST['firstName'],$_POST['lastName'],$_POST['email'], $_POST['phone'],$_POST['password'],$_POST['passwordCheck']);
    
    if($status["success"] === 1){
        header("location: ../index.php");
    }else{
        foreach($status["errors"] as $key => $value) /* walk through the array so all the errors get displayed */
		{
			echo '<li>' . $value . '</li>'; 
		}
		echo '</ul>';
    }


}
?>