<?php
include "header.php";



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
            
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
		
			if(isset($_POST['editAccount'])){
				$firstName = $_POST['firstName'];
				$lastName = $_POST['lastName'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				
				
			}
            
            if(isset($_POST['cancelAccountEdit'])){
                header("location: account.php");
            }
		
			
            if(isset($_POST['saveAccountEdit'])){
                $firstNameError = "";
                $lastNameError = "";
                $emailError = "";
                $passwordError = "";
                
                
                $status = $ACCT_MGR->editAccount($ACCT_MGR->getId(), $_POST['firstName'],$_POST['lastName'], $_POST['email'],$_POST['phone']);
                
                if($status["success"] === 1){
                    header("location: account.php");
                }else{
                
                    if(isset($status['errors']['firstName'])){
                        $firstNameError = $status['errors']['firstName'];
                    }
                    if(isset($status['errors']['lastName'])){
                        $lastNameError = $status['errors']['lastName'];
                    }
                    if(isset($status['errors']['email'])){
                        $emailError = $status['errors']['email'];
                        
                    }
                    if(isset($status['errors']['password'])){
                        $passwordError = $status['errors']['password'];
                    }
                    
                }
            }
		}
        
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
          
        echo '<label for="email">Email address</label> &nbsp;&nbsp&nbsp;&nbsp;<font color="red">' . $emailError . '</font>' . "\n";
        echo '<div class="row">' . "\n";
        echo '<div class="col-xs-3">' . "\n";
        echo '<input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="' . $email . '">' . "\n";
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
        echo '<button name="saveAccountEdit" type="submit" class="btn btn-default">Save</button>' . "\n";
        echo '<button name="cancelAccountEdit" type="submit" class="btn btn-default">Cancel</button>' . "\n";
        echo '</form>' . "\n";
		?>
		
	
	</div>

</div>


<?php
include "footer.php"
?>