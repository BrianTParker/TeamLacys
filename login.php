<?php
include "header.php";



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errorMessage = '';
    $ACCT_MGR = AccountManager::getInstance();
    $status = $ACCT_MGR->checkLogin($_POST['email'], $_POST['password']);
    
    if($status === 1){
        header("location: index.php");
		
    }else{
        $errorMessage = "That email and password is not valid";
    }
    

}

if(!isset($errorMessage)){
    $errorMessage = '';
}

?>
<div class="row">
   <div class="col-sm-3 col-sm-offset-1">
        <form role="form" action="login.php" method="POST">
          <div class="form-group">
          <font color="red"><?php echo $errorMessage; ?></font><br/>
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          
          <button type="submit" class="btn btn-default">Submit</button>
        </form>


   </div>
</div>

<?php


include "footer.php";
?>