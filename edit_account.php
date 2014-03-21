<?php
include "header.php";
include "Account/AccountManager.php";


$ACCT_MGR = AccountManager::getInstance();

if(!isset($firstName)){
    $firstName = "";
    $lastName = "";
    $email = "";
    $phone = "";
    $firstNameError = "";
    $lastNameError = "";
    $emailError = "";
    $passwordError = "";
}
?>

<div class="row">

    <div class="col-sm-10 col-sm-offset-1">
		<?php 
		
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			
			$firstNameError = "";
			$lastNameError = "";
			$emailError = "";
			$passwordError = "";
		
			if(isset($_POST['editAccount'])){
				$firstName = $_POST['firstName'];
				$lastName = $_POST['lastName'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				
				echo '<form role="form" action="" method="POST">' . "\n";
				echo '<div class="form-group">' . "\n";
				echo '<label for="firstName">First Name</label> &nbsp;&nbsp&nbsp;&nbsp;<font color="red">' . $firstNameError . '</font> ' . "\n";
				echo '<div class="row">' . "\n";
				echo '<div class="col-xs-3">' . "\n";
				echo '<input  type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter First Name" value="' . $firstName . '">' . "\n"; 
				echo '</div>' . "\n";
				echo '</div> ' . "\n";   
				echo '</div>' . "\n";
				echo '<div class="form-group">' . "\n";
				  
				echo '<label for="lastName">Last Name</label>  &nbsp;&nbsp&nbsp;&nbsp;<font color="red">' . $lastNameError . '</font> ' . "\n";
				echo '<div class="row">' . "\n";
				echo '<div class="col-xs-3">' . "\n";
				echo '<input type="text" class="form-control" name="lastName" id="lastName" placeholder="Enter Last Name" value="' . $lastName . '">' . "\n";
				echo '</div>' . "\n";
				echo '</div>' . "\n";
				echo '</div>' . "\n";
				echo '<div class="form-group">' . "\n";
				  
				echo '<label for="email">Email address</label>' . "\n";
				echo '<div class="row">' . "\n";
				echo '<div class="col-xs-3">' . "\n";
				echo '<input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="' . $email . '" readonly>' . "\n";
				echo '</div>' . "\n";
				echo '</div>' . "\n";
				echo '</div>' . "\n";
				  
				echo '<div class="form-group">' . "\n";
				  
				echo '<label for="phone">Phone (optional)</label>' . "\n";
				echo '<div class="row">' . "\n";
				echo '<div class="col-xs-3">' . "\n";
				echo '<input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" value="' .$phone . '">' . "\n";
				echo '</div>' . "\n";
				echo '</div>' . "\n";
				echo '</div>' . "\n";
				echo '<button type="submit" class="btn btn-default">Save</button>' . "\n";
				echo '</form>' . "\n";
			}
		
			if(isset($_POST['changePassword'])){
			
			}
		}
		?>
		
	
	</div>

</div>


<?php
include "footer.php"
?>