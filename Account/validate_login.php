<?php
session_start();
include_once( "AccountManager.php" );
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $ACCT_MGR = AccountManager::getInstance();
    $status = $ACCT_MGR->checkLogin($_POST['email'], $_POST['password']);
    
    if($status === 1){
        header("location: ../index.php");
    }else{
        echo "That email and password is not valid";
    }
    

}


?>