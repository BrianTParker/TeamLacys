<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */
include __DIR__ . "/../db_connect.php"; // relative path include -nm

/**
 * This class manages a user account.
 *
 *
 */
class AccountManager {
    
    
    protected static $instance = null;

    protected function __construct()
    {
        //Thou shalt not construct that which is unconstructable!
    }

    protected function __clone()
    {
        //Me not like clones! Me smash clones!
    }

    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }
	
	
	private $firstName,
            $lastName,
            $email;
    
    

    
 
	
	public function getId(){
        if(isset($_SESSION['id'])){
            return $_SESSION['id'];
        }
    }

    
    function setID(){
        global $DBH;
        
        $sql = $DBH->query("SELECT id, first_name, last_name from customers where email = '" . $email . "'"); 			
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $row = $sql->fetch();
        $id = $row['id'];
        
        $_SESSION['id'] = $id;
            
    }
    
    function setSessionVariables($firstName, $lastName, $email, $id, $phone, $access_level){
        $_SESSION["firstName"] = $firstName;
        $_SESSION["lastName"] = $lastName;
        $_SESSION["email"] = $email;
        $_SESSION["id"] = $id;
        $_SESSION["phone"] = $phone;
		$_SESSION["access_level"] = $access_level;
        
    }
    
    function getFirstName(){
        if(isset($_SESSION["firstName"])){
            return $_SESSION["firstName"];
        }
    }
    
    function getLastName(){
        if(isset($_SESSION["lastName"])){
            return $_SESSION["lastName"];
        }
    }
	
	function getEmail(){
		if(isset($_SESSION["email"])){
			return $_SESSION["email"];
		}
	}
	
	function getPhone(){
		if(isset($_SESSION["phone"])){
			return $_SESSION["phone"];
		}
	}
    
	function getAccessLevel(){
		if(isset($_SESSION["access_level"])){
			return $_SESSION["access_level"];
		}
	}
    
        
    function checkLogin($email, $password){
        global $DBH;
        $success = 0;
        $password = sha1($password);
        
        $STH = $DBH->query("select * from customers where email = '" . $email . "' and password = '" . $password . "' and active = 1");
        if($STH->rowCount() == 1){
            $sql = $DBH->query("SELECT id, first_name, last_name, phone, access_level from customers where email = '" . $email . "' and password = '" . $password . "'"); 			
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $row = $sql->fetch();
            $id = $row['id'];
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
			$phone = $row['phone'];
			$access_level = $row['access_level'];
            
            $this->setSessionVariables($firstName, $lastName, $email, $id, $phone,$access_level);
            $success = 1;
            return $success;
   
            

            
        }
        else {
            return $success;

        }
    }
    
    public function changePassword($email, $oldPassword, $newPassword, $newPasswordCheck){
        global $DBH;
        $success = 0;
        
        
        
        $sql = $DBH->query("select password from customers where email = '" . $email . "'");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $row = $sql->fetch();
        $db_password = $row['password'];
        
        
        if(!empty($oldPassword)){
            $oldPassword = sha1($oldPassword);
            if($oldPassword != $db_password){
                $errors['oldPassword'] = 'The password entered was not valid';
            }else{
                if(sha1($newPassword) === $oldPassword){
                    $errors['newPassword'] = 'The new password cannot be the same as the old password';
                }
            }
        }
        else
        {
            $errors['oldPassword'] = 'The new password field cannot be empty.';
        }
        if(!empty($newPassword))
        {
            $newPassword = sha1($newPassword);
            $newPasswordCheck = sha1($newPasswordCheck);
            
            
            if($newPassword != $newPasswordCheck)
            {
                $errors['newPasswordCheck'] = 'The two passwords did not match.';
            }
        }
        else
        {
            $errors['newPassword'] = 'The new password field cannot be empty.';
        }
        
        if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
        {
            return array("success" => $success,
                         "errors" => $errors);
        }else{
            $sql = "update customers set password = ? where email = ?";
            $q = $DBH->prepare($sql);
            $q->execute(array($newPassword, $email));
        }
        
        if(!$q)
        {
            //something went wrong, display the error
            $errors['database'] = "There was an issue with the database";
            return array("success" => $success,
                         "errors" => $errors);
            //echo mysql_error(); //debugging purposes, uncomment when needed
        }
        else
        {
            
            $success = 1;
            return array("success" => $success,
                         "errors" => $errors);
        }
        
    }
    
    public function editAccount($id,$firstName, $lastName, $email,$phone){
        global $DBH;
        $errors = array(); /* declare the array for later use */
        $success = 0;
        
        if(!empty($firstName))
        {
            //the user name exists
            if(!ctype_alpha((str_replace(' ','',$firstName))))
            {
                $errors['firstName'] = 'The first name can only contain letters.';
            }
            if(strlen($firstName) > 30)
            {
                $errors['firstName'] = 'The first name cannot be longer than 30 characters.';
            }
        }
        else
        {
            $errors['firstName'] = 'The first name field must not be empty.';
        }
        
        if(!empty($lastName))
        {
            //the user name exists
            if(!ctype_alpha($lastName))
            {
                $errors['lastName'] = 'The last name can only contain letters';
            }
            if(strlen($lastName) > 30)
            {
                $errors['lastName'] = 'The last name cannot be longer than 30 characters.';
            }
        }
        else
        {
            $errors['lastName'] = 'The last name field must not be empty.';
        }
        if(!empty($email)){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'The email must be a valid format';
            }
	    
            if($email != $this->getEmail()){
                $STH = $DBH->query("select * from customers where email = '" . $email . "' and active = 1");
                if($STH->rowCount() == 1){
                $errors['email'] = 'That email is already associated with an account';
                }
            }
        }else{
            $errors['email'] = 'The email must not be empty';
        }
        
        
        if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
        {
            return array("success" => $success,
                         "errors" => $errors);
        }else{
            $sql = "update customers set first_name = ?, last_name = ?, email = ?,phone = ? where id = ?";
            $q = $DBH->prepare($sql);
            $q->execute(array($firstName, $lastName, $email,$phone, $id));
        }
        
        if(!$q)
        {
            //something went wrong, display the error
            $errors['database'] = "There was an issue with the database";
            return array("success" => $success,
                         "errors" => $errors);
            //echo mysql_error(); //debugging purposes, uncomment when needed
        }
        else
        {
            $id = $DBH->lastInsertId();
            $this->setSessionVariables($firstName, $lastName, $email, $id, $phone);
            $success = 1;
            return array("success" => $success,
                         "errors" => $errors);
        }
    }
    
    function createNewAccount($firstName, $lastName, $email, $phone, $password, $password_check, $access_level = 2, $active = 1){
    
    
        global $DBH;
        //global $firstName, $lastName, $email;
        $errors = array(); /* declare the array for later use */
        $success = 0;

        if(!empty($firstName))
        {
            //the user name exists
            if(!ctype_alpha((str_replace(' ','',$firstName))))
            {
                $errors['firstName'] = 'The first name can only contain letters.';
            }
            if(strlen($firstName) > 30)
            {
                $errors['firstName'] = 'The first name cannot be longer than 30 characters.';
            }
        }
        else
        {
            $errors['firstName'] = 'The first name field must not be empty.';
        }
        
        if(!empty($lastName))
        {
            //the user name exists
            if(!ctype_alpha($lastName))
            {
                $errors['lastName'] = 'The last name can only contain letters';
            }
            if(strlen($lastName) > 30)
            {
                $errors['lastName'] = 'The last name cannot be longer than 30 characters.';
            }
        }
        else
        {
            $errors['lastName'] = 'The last name field must not be empty.';
        }
        
        if(!empty($email)){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'The email must be a valid format';
            }
	    
	    $STH = $DBH->query("select * from customers where email = '" . $email . "' and active = 1");
	    if($STH->rowCount() == 1){
		$errors['email'] = 'That email is already associated with an account';
	    }
        }else{
            $errors['email'] = 'The email must not be empty';
        }

        if(!empty($password))
        {
            if($password != $password_check)
            {
                $errors['password'] = 'The two passwords did not match.';
            }
        }
        else
        {
            $errors['password'] = 'The password field cannot be empty.';
        }

        if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
        {
            return array("success" => $success,
                         "errors" => $errors);
        }
        else
        {
        
            /* $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $password = sha1($_POST['password']);
            $email = $_POST['email'];
            $phone = $_POST['phone']; */
            $password = sha1($password);
            $sql = "Insert into customers(first_name, last_name, email, phone,password, access_level, active)
                    values (:firstName, :lastName,:email, :phone, :password, :access_level, :active)";
            $q = $DBH->prepare($sql);
            $q->execute(array(':firstName'=>$firstName,
                              ':lastName'=>$lastName,
                              ':password'=>$password,
                              ':email'=>$email,
                              ':phone'=>$phone,
							  ':access_level'=>$access_level,
							  ':active'=>$active
                              ));
            
            //$result = mysql_query($sql);
            if(!$q)
            {
                //something went wrong, display the error
                $errors['database'] = "There was an issue with the database";
                return array("success" => $success,
                             "errors" => $errors);
                //echo mysql_error(); //debugging purposes, uncomment when needed
            }
            else
            {
                $id = $DBH->lastInsertId();
                $this->setSessionVariables($firstName, $lastName, $email, $id, $phone, $access_level);
                $success = 1;
                return array("success" => $success,
                             "errors" => $errors);
            }
            //the form has been posted without, so save it
            //notice the use of mysql_real_escape_string, keep everything safe!
            //also notice the sha1 function which hashes the password
            
        }

    
    
    }
    
    public function closeAccount(){
		global $DBH;
		
		$errors = array(); /* declare the array for later use */
        $success = 0;
		
		$sql = "update customers set active = 0 where id = ?";
		$q = $DBH->prepare($sql);
		$q->execute(array($this->getId()));
		
		if(!$q)
        {
            //something went wrong, display the error
            $errors['database'] = "There was an issue with the database";
            return array("success" => $success,
                         "errors" => $errors);
            //echo mysql_error(); //debugging purposes, uncomment when needed
        }
        else
        {
            
            $success = 1;
            return array("success" => $success,
                         "errors" => $errors);
        }
	}
    
    function isLoggedIn(){
        if(isset($_SESSION['firstName'])){
			
			if($_SESSION['access_level'] != 3){
				return true;
			}else{
				return false;
			}
				
			
            
        }else{
            return false;
        }
    }
    
    
} // end class -n
