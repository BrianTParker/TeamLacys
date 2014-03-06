<?php
//include "../header.php";
include_once( "AccountManager.php" );
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $ACCT_MGR = AccountManager::getInstance();
    $ACCT_MGR->checkLogin($_POST['email'], $_POST['password']);
    

}
?>