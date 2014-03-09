<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */
include_once( __DIR__ . '/../SessionSingleton.php' );

/**
 * This class manages a shopping cart.
 * 
 * This class extends the abstract class SessionSingleton.
 * Therefore, there is no way to directly construct an object
 * of this class. To instantiate an object of this class,
 * the SessionSingleton::getInstance() method must be used.
 *
 *************************************************************************** *
 * Example:
 *************************************************************************** *
 * // load CartManager class via relative path
 * include_once( __DIR__ . '/CartManager.php' );
 *
 * $CART_MGR = CartManager::getInstance();
 *
 * echo $CART_MGR->getItemCount(); // prints 0
 *
 * $CART_MGR->addItem( 'Any Type' );
 * 
 * echo $CART_MGR->getItemCount(); // prints 1
 *
 * $CART_MGR->emptyCart();
 * 
 * echo $CART_MGR; // prints Cart(0)
 *
 * unset( $CART_MGR ); // not required, but encouraged
 ****************************************************************************
 * @author(s) nicholas malacarne <nicholas.malacarne@gmail.com>
 */
class CartManager extends SessionSingleton {
	
	// list of items currently in the cart -nm
	private $cart = array();
	
	// add item to the cart -nm
	public function addItem( $aItem ){
		
		array_push( $this->cart, $aItem );
		
	} // end method -nm
	
	// remove item from the cart by numerical index -nm
	public function removeItem( $index ){
	
		// delete item at index -nm
		unset( $this->cart[ $index ] );
		
		// reindex item list -nm
		$this->cart = array_values( $this->cart );
	
	} // end method -nm
	
	// returns the number of items currently in the cart -nm
	public function getItemCount(){
	
		return count( $this->cart );
	
	} // end method -nm
	
	// returns a list of items -nm
	public function getItems(){
	
		return $this->cart;
	
	} // end method -nm
	
	public function __toString(){
	
		return "Cart(" . $this->getItemCount() . ")"; 
		
	} // end method -nm
	
	// empties the cart -nm
	public function emptyCart(){
	
		$this->cart = array();
		
	} // end method -nm
    
} // end class -nm
