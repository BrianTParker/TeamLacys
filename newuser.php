<?php
include "header.php";
?>
<div class="row">
   <div class="col-sm-3 col-sm-offset-1">
        <form role="form" action="newuser.php" method="POST">
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter First Name">
          </div>
          <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Enter Last Name">
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
          </div>
          
          <div class="form-group">
            <label for="phone">Phone (optional)</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone">
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

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    validateInfo();
}

function validateInfo(){
    global $DBH;
    $errors = array(); /* declare the array for later use */

	if(isset($_POST['firstName']))
	{
		//the user name exists
		if(!ctype_alnum($_POST['firstName']))
		{
			$errors[] = 'The first name can only contain letters and digits.';
		}
		if(strlen($_POST['firstName']) > 30)
		{
			$errors[] = 'The first name cannot be longer than 30 characters.';
		}
	}
	else
	{
		$errors[] = 'The first name field must not be empty.';
	}
    
    if(isset($_POST['lastName']))
	{
		//the user name exists
		if(!ctype_alnum($_POST['lastName']))
		{
			$errors[] = 'The last name can only contain letters and digits.';
		}
		if(strlen($_POST['lastName']) > 30)
		{
			$errors[] = 'The last name cannot be longer than 30 characters.';
		}
	}
	else
	{
		$errors[] = 'The last name field must not be empty.';
	}
    
    if(isset($_POST['email'])){
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'The email must be a valid format';
        }
    }else{
        $errors[] = 'The email must not be empty';
    }

	if(isset($_POST['password']))
	{
		if($_POST['password'] != $_POST['passwordCheck'])
		{
			$errors[] = 'The two passwords did not match.';
		}
	}
	else
	{
		$errors[] = 'The password field cannot be empty.';
	}

	if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
	{
		echo 'Uh-oh.. a couple of fields are not filled in correctly..';
		echo '<ul>';
		foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
		{
			echo '<li>' . $value . '</li>'; /* this generates a nice error list */
		}
		echo '</ul>';
	}
	else
	{
    
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
		$password = sha1($_POST['password']);
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		
		$sql = "Insert into customers(first_name, last_name, email, phone,password)
				values (:firstName, :lastName,:email, :phone, :password)";
		$q = $DBH->prepare($sql);
		$q->execute(array(':firstName'=>$firstName,
                          ':lastName'=>$lastName,
						  ':password'=>$password,
						  ':email'=>$email,
						  ':phone'=>$phone
						  ));
		
		//$result = mysql_query($sql);
		if(!$q)
		{
			//something went wrong, display the error
			echo 'Something went wrong while registering. Please try again later.';
			//echo mysql_error(); //debugging purposes, uncomment when needed
		}
		else
		{
			echo 'Successfully registered.';
            $_SESSION['firstName'] = $_POST['firstName'];
		}
		//the form has been posted without, so save it
		//notice the use of mysql_real_escape_string, keep everything safe!
		//also notice the sha1 function which hashes the password
		
	}

}
include "footer.php";
?>