<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */

// Report simple running errors (avoid notices) -nm
error_reporting(E_ERROR | E_WARNING | E_PARSE);

/**
 * SessionSingleton 
 *
 * This class acts as a singleton, but is persistent between
 * server queries. 
 *
 * While there is nothing preventing the unserialization of 
 * a child instance of this class directly from the session, 
 * please instantiate a child of this class via the 
 * SessionSingleton::getInstance() method if possible.
 *
 *************************************************************************** *
 * Example:
 * ************************************************************************** *
 * class Child extends SessionSingleton {}
 *
 * $object = Child::getInstance();
 *
 * *do some stuff with $object*
 *
 * // instance is stored in $_SESSION upon destruction
 * unset( $object );
 * 
 * foreach ( $_SESSION as $key => $value ){
 *	
 * 		echo $key; // outputs 'Child'
 * } 
 *************************************************************************** *
 * @author(s) nicholas malacarne <nicholas.malacarne@gmail.com>
 */
abstract class SessionSingleton {
    
    // associative array of SessionSingleton instances -nm
    private static $instances = array();
    
    // returns an instance of the specified class -nm
    final public static function getInstance(){
        
        // the name of the instances' class -nm
        $className = get_called_class();
        
        // if the instance has not been loaded -nm
        if ( !isset( self::$instances[ $className ] ) ){
            
            // load the instance from the session -nm
            self::$instances[ $className ] = static::sessionLoad();
        }
        
        // return the instance -nm
        return self::$instances[ $className ];
        
    } // end method -nm
    
    // serializes the instance to the session -nm
    public function __destruct(){
        
        // start user session -nm
        session_start();
        
        // the session key for the serialized instance (class name of instance) -nm
        $sessionKey = get_called_class();
        
        // serialize instance to session -nm
        $_SESSION[ $sessionKey ] = serialize( self::$instances[ $sessionKey ] );
        
        // close user session -nm
        session_write_close();
        
    } // end method -nm
    
    // prevent cloning (there should only ever be one instance per child class) -nm
    protected function __clone() {
        
        // do nothing -nm
        
    } // end method -nm
    
	// hide the constructor (use getInstance to instantiate) -nm
    private function __construct(){
        
        // do nothing -nm
        
    } // end method -nm
	
    // loads an instance from session -nm
    private static function sessionLoad(){
        
        // the session key for the class (the classes name) -nm
        $sessionKey = get_called_class();
        
        // start user session -nm
        session_start();
        
        // if the session key exists -nm
        if ( isset( $_SESSION[ $sessionKey ] ) === TRUE ){

                // unserialize and return the existing instance -nm
                return unserialize( $_SESSION[ $sessionKey ] );

        }else{
                
                // construct and return a new instance -nm
                return new static;
        }
        
    } // end method -nm
    
} // end class -nm
