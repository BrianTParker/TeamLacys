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
    
    
    public validateCheckout($cardName,$cardNumber,$security,$expiration,$shipping,$street,$street2,$city,$state,$zip){
        
        $errors = array(); /* declare the array for later use */
        $success = 0;
        
        if(isset($cardName)){
        
            if(!ctype_alnum((str_replace(' ','',$cardName)))){
                $errors[] = 'The card name can only contain letters and digits.';
            }
        }else{
            $errors[] = 'The card name cannot be blank.';
        }
        
        if(isset($cardNumber){
            
        }else{
            $errors[] = 'The card number feild must not be blank.';
        }
        
        if(isset($security){
            if(!is_numeric($security)){
                $errors[]= 'The security code must be numeric only';
            }
            if($strlen($security) != 3){
                $errors[] = 'The security code must be 3 digits';
            }
        }else{
            $errors[] = 'The security code feild must not be blank';
        }
        
        if(isset($expiration){
        
        }else{
            $errors[] = 'The credit card expiration date must not be blank';
        }
        
        if(isset($shipping){
            if(isset($street){
                
            }else{
                $errors[] = 'Street address must not be blank';
            }
            
            if(isset($city)){
                
            }else{
                $errors[] = 'City must not be blank';
            }
            
            if(isset($state)){
                
            }else{
                $errors[] = 'State must not be blank';
            }
            
            if(isset($zip)){
                $errors[] = 'Zip code must not be blank';
            }else{
            
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