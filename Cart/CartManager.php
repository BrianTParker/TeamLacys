<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */


// Report simple running errors (avoid notices) -nm
error_reporting(E_ERROR | E_WARNING | E_PARSE);

/**
 * This class manages a shopping cart.
 *
 * @author(s) nicholas malacarne <nicholas.malacarne@gmail.com>
 */
class CartManager {
    
    // session ID -nm
    const SESSION_NAME = "CART_MGR";
	
	// current CartManager instance -nm
	private static $instance;
	
	// list of items currently in the cart -nm
	private $items_l = array();
    
    // constructor -nm
    private function __construct(){
        
		// do nothing -nm
		
    } // end constructor -nm
	
	// load serialized instance from session -nm
	private static function load(){
	
		// start user session -nm
		session_start();
	
		if ( isset( $_SESSION[ self::SESSION_NAME ] ) === TRUE ){
			 
			// unserialize and return the existing object -nm
			return unserialize( $_SESSION[ self::SESSION_NAME ] );
			 
		}else{
			 
			return new self();
		}
	}
    
    // destructor -nm
    public function __destruct() {
        
        // serialize object to session -nm
        $_SESSION[ self::SESSION_NAME ] = serialize( $this );
        
        // close user session -nm
        session_write_close();
        
    } // end destructor -nm
	
	// add item to the cart -nm
	public function addItem( $aItem ){
		
		array_push( $this->items_l, $aItem );
		
	} // end method -nm
	
	// remove item from the cart by numerical index -nm
	public function removeItem( $index ){
	
		// delete item at index -nm
		unset( $this->items_l[ $index ] );
		
		// reindex item list -nm
		$this->items_l = array_values( $this->items_l );
	
	} // end method -nm
	
	// returns the number of items currently in the cart -nm
	public function getItemCount(){
	
		return count( $this->items_l );
	
	} // end method -nm
	
	// returns a list of items -nm
	public function getItems(){
	
		return $this->items_l;
	
	} // end method -nm
	
	public function __toString(){
	
		return "Cart(" . $this->getItemCount() . ")"; 
		
	} // end method -nm
    
    // init method -nm
    public static function getInstance(){

		// check if an instance exists -nm
		if ( !isset( static::$instance ) ){
			
			// load the cart manager -nm
			static::$instance = static::load();
			
		}
		
		// return the current instance -nm
		return static::$instance;
		
    } // end method -nm
    
} // end class -nm
