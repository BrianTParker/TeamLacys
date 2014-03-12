<?php

include __DIR__ . "/../db_connect.php"; 


class CheckoutManager{

    protected static $instance = null;

    protected function __construct()
    {
        
    }

    protected function __clone()
    {
        
    }

    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }
    
    
    public function validateCheckout($cardName,$cardNumber,$security,$expiration,$shipping,$street,$street2,$city,$state,$zip){
        
        $errors = array(); /* declare the array for later use */
        $success = 0;
        
        if(empty($cardName)){
            $errors[] = 'The card name cannot be blank.';
            
        }else{
            if(!ctype_alnum((str_replace(' ','',$cardName)))){
                $errors[] = 'The card name can only contain letters and digits.';
            }
        }
        
        if(!empty($cardNumber)){
            
        }else{
            $errors[] = 'The card number field cannot be blank.';
        }
        
        if(!empty($security)){
            if(!is_numeric($security)){
                $errors[]= 'The security code must be numeric only';
            }
            if(strlen($security) != 3){
                $errors[] = 'The security code must be 3 digits';
            }
        }else{
            $errors[] = 'The security code field cannot be blank';
        }
        
        if(!empty($expiration)){
        
        }else{
            $errors[] = 'The credit card expiration date cannot be blank';
        }
        
        if($shipping === "ship"){
            if(!empty($street)){
                
            }else{
                $errors[] = 'Street address cannot be blank';
            }
            
            if(!empty($city)){
                
            }else{
                $errors[] = 'City cannot be blank';
            }
            
            if(!empty($state)){
                
            }else{
                $errors[] = 'State cannot be blank';
            }
            
            if(!empty($zip)){
                
            }else{
                $errors[] = 'Zip code cannot be blank';
            }
        }
        
        if(!empty($errors)){
            return array("success" => $success,
                         "errors" => $errors);
        }else{
            $success = 1;
            return array("success" => $success,
                         "errors" => $errors);
        }
        
        
        
    }

}


?>