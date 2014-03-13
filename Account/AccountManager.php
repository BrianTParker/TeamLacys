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
    
    // session ID -nm
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
    
    function setSessionVariables($firstName, $lastName, $email){
        $_SESSION["firstName"] = $firstName;
        $_SESSION["lastName"] = $lastName;
        $_SESSION["email"] = $email;
        $this->setID();
        
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
    
    
        
    function checkLogin($email, $password){
        global $DBH;
        $success = 0;
        $password = sha1($password);
        
        $STH = $DBH->query("select * from customers where email = '" . $email . "' and password = '" . $password . "'");
        if($STH->rowCount() == 1){
            $sql = $DBH->query("SELECT id, first_name, last_name from customers where email = '" . $email . "' and password = '" . $password . "'"); 			
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $row = $sql->fetch();
            $id = $row['id'];
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            
            $this->setSessionVariables($firstName, $lastName, $email);
            $success = 1;
            return $success;
   
            

            
        }
        else {
            return $success;

        }// end method -nm
    }
    
    function createNewAccount($firstName, $lastName, $email, $phone, $password, $password_check){
    
    
        global $DBH;
        global $firstName, $lastName, $email;
        $errors = array(); /* declare the array for later use */
        $success = 0;

        if(isset($firstName))
        {
            //the user name exists
            if(!ctype_alnum((str_replace(' ','',$firstName))))
            {
                $errors[] = 'The first name can only contain letters and digits.';
            }
            if(strlen($firstName) > 30)
            {
                $errors[] = 'The first name cannot be longer than 30 characters.';
            }
        }
        else
        {
            $errors[] = 'The first name field must not be empty.';
        }
        
        if(isset($lastName))
        {
            //the user name exists
            if(!ctype_alnum($lastName))
            {
                $errors[] = 'The last name can only contain letters and digits.';
            }
            if(strlen($lastName) > 30)
            {
                $errors[] = 'The last name cannot be longer than 30 characters.';
            }
        }
        else
        {
            $errors[] = 'The last name field must not be empty.';
        }
        
        if(isset($email)){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'The email must be a valid format';
            }
	    
	    $STH = $DBH->query("select * from customers where email = '" . $email . "'");
	    if($STH->rowCount() == 1){
		$errors[] = 'That email is already associated with an account';
	    }
        }else{
            $errors[] = 'The email must not be empty';
        }

        if(isset($password))
        {
            if($password != $password_check)
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
            return array("success" => $success,
                         "errors" => $errors);
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
                $errors[] = "There was an issue with the database";
                return array("success" => $success,
                             "errors" => $errors);
                //echo mysql_error(); //debugging purposes, uncomment when needed
            }
            else
            {
                
                $this->setSessionVariables($firstName, $lastName, $email);
                $success = 1;
                return array("success" => $success,
                             "errors" => $errors);
            }
            //the form has been posted without, so save it
            //notice the use of mysql_real_escape_string, keep everything safe!
            //also notice the sha1 function which hashes the password
            
        }

    
    
    }
    
    
    
    function isLoggedIn(){
        if(isset($_SESSION['firstName'])){
            return true;
        }else{
            return false;
        }
    }
    
    
} // end class -n
