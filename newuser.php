<?php
include "header.php";
include_once( "Account/AccountManager.php" );

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $ACCT_MGR = AccountManager::getInstance();
    $status = $ACCT_MGR->createNewAccount($_POST['firstName'],$_POST['lastName'],$_POST['email'], $_POST['phone'],$_POST['password'],$_POST['passwordCheck']);
    
    if($status["success"] === 1){
        header("location: index.php");
    }else{
    
	echo '<div class="row">';
		echo '<div class="col-sm-8 col-sm-offset-1">';
			foreach($status["errors"] as $key => $value) /* walk through the array so all the errors get displayed */
				{
					echo '<li>' . $value . '</li>'; 
				}
				echo '</ul>';
		echo '</div>';
	echo '</div>';
    }


}

if(!isset($firstName)){
    $firstName = "";
    $lastName = "";
    $email = "";
    $phone = "";
}

?>

<div class="row">
   <div class="col-sm-3 col-sm-offset-1">
        <form role="form" action="newuser.php" method="POST">
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter First Name" value="<?php echo $firstName;?>">
          </div>
          <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Enter Last Name" value="<?php echo $lastName;?>">
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php echo $email;?>">
          </div>
          
          <div class="form-group">
            <label for="phone">Phone (optional)</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" value="<?php echo $phone;?>">
          </div>
          
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          
          <div class="form-group">
            <label for="passwordCheck">Re-enter Password</label>
            <input type="password" class="form-control" id="passwordCheck" name="passwordCheck" placeholder="Password">
          </div>
          
          <button type="submit" class="btn btn-default">Create New Account</button>
        </form>


   </div>
</div>

<?php


include "footer.php";
?>