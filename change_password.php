<?php
include "header.php";



$ACCT_MGR = AccountManager::getInstance();

if(!isset($email)){
    $email = "";
}




if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $oldPasswordError = "";
    $newPasswordError = "";
    $newPasswordCheckError = "";
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }
    
    if(isset($_POST['cancelUpdate'])){
        header("location: account.php");
    }
    
    if(isset($_POST['saveUpdate'])){
        
        
        
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $newPasswordCheck = $_POST['newPasswordCheck'];
        
        $status = $ACCT_MGR->changePassword($email, $oldPassword,$newPassword, $newPasswordCheck);
        
        if($status["success"] === 1){
            header("location: account.php");
        }else{
        
            if(isset($status['errors']['oldPassword'])){
                $oldPasswordError = $status['errors']['oldPassword'];
            }
            if(isset($status['errors']['newPassword'])){
                $newPasswordError = $status['errors']['newPassword'];
            }
            if(isset($status['errors']['newPasswordCheck'])){
                $newPasswordCheckError = $status['errors']['newPasswordCheck'];
                
            }
            
        }
    }
}




?>



<div class="row">

    <div class="col-sm-8 col-sm-offset-1">
        <form role="form" action="" method="POST">
            
            <div class="form-group">
          
            <label for="oldPassword">Old Password</label> &nbsp;&nbsp&nbsp;&nbsp;<font color="red"><?php echo $oldPasswordError; ?></font>
            <div class="row">
                <div class="col-xs-3">
            <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Password">
                            </div>
            </div>
            </div>
          
          <div class="form-group">
          
            <label for="newPassword">New Password</label> &nbsp;&nbsp&nbsp;&nbsp;<font color="red"><?php echo $newPasswordError; ?></font>
            <div class="row">
                <div class="col-xs-3">
            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password">
                            </div>
            </div>
          </div>
          
          <div class="form-group">
          
            <label for="newPasswordCheck">Re-enter Password</label> &nbsp;&nbsp&nbsp;&nbsp;<font color="red"><?php echo $newPasswordCheckError; ?></font>
            <div class="row">
                <div class="col-xs-3">
            <input type="password" class="form-control" id="passwordCheck" name="newPasswordCheck" placeholder="Password">
                            </div>
            </div>
          </div>
          
          <input type="hidden" name="email" value="<?php echo $email; ?>">
          
          
          <button name="saveUpdate" type="submit" class="btn btn-default">Update Password</button>
          <button name="cancelUpdate" type="submit" class="btn btn-default">Cancel</button>
        </form>


	</div>

</div>




<?php
include "footer.php"
?>