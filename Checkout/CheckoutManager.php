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
    
    public function setCheckoutSummary($summary){
        $_SESSION['summary'] = $summary;
    }
    
    public function getNewSummary(){
        unset($_SESSION['summary']);
    }
    
    public function getCardType(){
        if(isset($_SESSION['summary']['cardType'])){
            return $_SESSION['summary']['cardType'];
        }
    }
    
    public function getCardName(){
        if(isset($_SESSION['summary']['name'])){
            return $_SESSION['summary']['name'];
        }
    }
    
    public function getCardNumber(){
        if(isset($_SESSION['summary']['number'])){
            return $_SESSION['summary']['number'];
        }
    }
    
    public function getCardSecurity(){
        if(isset($_SESSION['summary']['security'])){
            return $_SESSION['summary']['security'];
        }
    }
    
    public function getCardExpiration(){
        if(isset($_SESSION['summary']['expiration'])){
            return $_SESSION['summary']['expiration'];
        }
    }
    
    public function getShippingOption(){
        if(isset($_SESSION['summary']['shipping'])){
            return $_SESSION['summary']['shipping'];
        }
    }
    
    public function getStreet1(){
        if(isset($_SESSION['summary']['street'])){
            return $_SESSION['summary']['street'];
        }
    }
    
    public function getStreet2(){
        if(isset($_SESSION['summary']['street2'])){
            return $_SESSION['summary']['street2'];
        }
    }
    
    public function getCity(){
        if(isset($_SESSION['summary']['city'])){
            return $_SESSION['summary']['city'];
        }
    }
    
    public function getState(){
        if(isset($_SESSION['summary']['state'])){
            return $_SESSION['summary']['state'];
        }
    }
    
    public function getZip(){
        if(isset($_SESSION['summary']['zip'])){
            return $_SESSION['summary']['zip'];
        }
    }
    
    public function checkout(){
        global $DBH;
        $success = 0;
        $shippingId = null;
        
        if($this->getShippingOption() === "ship"){
            $sql = "Insert into shipping(street_address1, street_address2, city, state,zip)
                    values (:street_address1, :street_address2,:city, :state, :zip)";
            $q = $DBH->prepare($sql);
            $q->execute(array(':street_address1'=>$this->getStreet1(),
                              ':street_address2'=>$this->getStreet2(),
                              ':city'=>$this->getCity(),
                              ':state'=>$this->getState(),
                              ':zip'=>$this->getZip
                              ));
                              
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
                $shippingId = $DBH->lastInsertId();
                
            }
        }
        
        
        //$result = mysql_query($sql);
        
        
    }

}


?>