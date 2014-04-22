<?php
include "header.php";
include_once( "Account/AccountManager.php" );

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $firstNameError = "";
    $lastNameError = "";
    $emailError = "";
	$phoneError = "";
    $passwordError = "";
    
    $ACCT_MGR = AccountManager::getInstance();
    $status = $ACCT_MGR->createNewAccount($_POST['firstName'],$_POST['lastName'],$_POST['email'], $_POST['phone'],$_POST['password'],$_POST['passwordCheck']);
    
    if($status["success"] === 1){
        header("location: index.php");
    }else{
    
        if(isset($status['errors']['firstName'])){
            $firstNameError = $status['errors']['firstName'];
        }
        if(isset($status['errors']['lastName'])){
            $lastNameError = $status['errors']['lastName'];
        }
		if(isset($status['errors']['phone'])){
            $phoneError = $status['errors']['phone'];
        }
        if(isset($status['errors']['email'])){
            $emailError = $status['errors']['email'];
            
        }
        if(isset($status['errors']['password'])){
            $passwordError = $status['errors']['password'];
        }
        
    }


}

if(!isset($firstName)){
    $firstName = "";
    $lastName = "";
    $email = "";
    $phone = "";
    $firstNameError = "";
    $lastNameError = "";
	$phoneError = "";
    $emailError = "";
    $passwordError = "";
}

?>

<div class="row">
   <div class="col-sm-10 col-sm-offset-1">
        <form role="form" action="newuser.php" method="POST">
        <div class="form-group">
            
                    <label for="firstName">First Name</label> &nbsp;&nbsp&nbsp;&nbsp;<font color="red"><?php echo $firstNameError; ?></font> 
                    <div class="row">
                <div class="col-xs-3">
                    <input  type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter First Name" value="<?php echo $firstName;?>"> 
                </div>
            </div>    
          </div>
          <div class="form-group">
          
            <label for="lastName">Last Name</label>  &nbsp;&nbsp&nbsp;&nbsp;<font color="red"><?php echo $lastNameError; ?></font>
            <div class="row">
                <div class="col-xs-3">
            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Enter Last Name" value="<?php echo $lastName;?>">
            </div>
            </div>
          </div>
          <div class="form-group">
          
            <label for="email">Email address</label> &nbsp;&nbsp&nbsp;&nbsp;<font color="red"><?php echo $emailError; ?></font>
            <div class="row">
                <div class="col-xs-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php echo $email;?>">
                            </div>
            </div>
          </div>
          
          <div class="form-group">
          
            <label for="phone">Phone (optional)</label>&nbsp;&nbsp&nbsp;&nbsp;<font color="red"><?php echo $phoneError; ?></font>
            <div class="row">
                <div class="col-xs-3">
            <input type="text" class="form-control" name="phone" id="phone" placeholder="XXX-XXX-XXXX" value="<?php echo $phone;?>">
                            </div>
            </div>
          </div>
          
          <div class="form-group">
          
            <label for="password">Password</label> &nbsp;&nbsp&nbsp;&nbsp;<font color="red"><?php echo $passwordError; ?></font>
            <div class="row">
                <div class="col-xs-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
            </div>
          </div>
          
          <div class="form-group">
          
            <label for="passwordCheck">Re-enter Password</label> &nbsp;&nbsp&nbsp;&nbsp;<font color="red"><?php echo $passwordError; ?></font>
            <div class="row">
                <div class="col-xs-3">
            <input type="password" class="form-control" id="passwordCheck" name="passwordCheck" placeholder="Password">
                            </div>
            </div>
          </div>
          
          <button type="submit" class="btn btn-default">Create New Account</button>
        </form>


   </div>
</div>

<?php


include "footer.php";
?>