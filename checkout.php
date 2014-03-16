<?php
include "header.php";
include_once( "Checkout/CheckoutManager.php" );
$total = 0;


$CHECKOUT_MGR = CheckoutManager::getInstance();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $CHECKOUT_MGR->getNewSummary();
    if(isset($_POST['checkoutInput'])){
        $cardType = $_POST['type'];
        $cardName = $_POST['name'];
        $cardNumber = $_POST['number'];
        $security = $_POST['security'];
        $expiration = $_POST['expDate'];
        $shipping = $_POST['shipping'];
        $street = $_POST['street'];
        $street2 = $_POST['street2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $total = $_POST['total'];
        
        
        //validate the checkout information
        $status = $CHECKOUT_MGR->validateCheckout($cardName,$cardNumber,$security,$expiration,$shipping,$street,$street2,$city,$state,$zip);
        
        
        
        if($status["success"] === 1){
            $summary = array(
                        'cardType' => $cardType,'name' => $cardName, 'number' => $cardNumber, 'security' => $security, 
                        'expiration' => $expiration, 'shipping' => $shipping, 'street' => $street, 
                        'street2' => $street2, 'city' => $city, 'state'=> $state, 'zip' => $zip, 'total' => $total);
            $CHECKOUT_MGR->setCheckoutSummary($summary);
            header("location: checkout_summary.php");
        }else{
            echo '<div class="row">';
                echo '<div class="col-sm-4 col-sm-offset-1">';
                echo '</div>';
                echo '<div class="col-sm-4 col-sm-offset-1">';
                    foreach($status["errors"] as $key => $value) /* walk through the array so all the errors get displayed */
                        {
                            echo '<li>' . $value . '</li>'; 
                        }
                        echo '</ul>';
                echo '</div>';
            echo '</div>';
        }
    
    }
    
    
    
}

if(!isset($cardName)){
    $cardName = '';
    $cardNumber = '';
    $security = '';
    $expiration = '';
    $shipping = '';
    $street = '';
    $street2 = '';
    $city = '';
    $state = '';
    $zip = '';
}
?>

<div class="row">

    <div class="col-sm-4 col-sm-offset-1">
    
        <h1>Checkout</h1>
        
        <table class="table">
            
            <head>
                <th>Item</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </head>
                
                <?php
                $CART_MGR = CartManager::getInstance();
                foreach( $CART_MGR->getItems() as $index => $item ){
                    $subTotal = 0;
                    //print_r( $item );
                    // print item to screen -nm
                    echo '<tr>' . "\n";
                    echo '<td>' . $item['name'] . '</td>' . "\n";
                    echo '<td>$' . $item['price'] . '</td>' . "\n";
                    echo '<td> x' . $item['quantity'] . '</td>' . "\n";
                    $subTotal += ($item['price'] * $item['quantity']);
                    $total += ($item['price'] * $item['quantity']);
                    echo '<td>$' . $subTotal . '</td>';
                    echo '</tr>' . "\n";
                    
                }
                ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td><strong>Total</strong></td>
			
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>$<?php echo $total; ?></td>
			
		</tr>
        </table>
    </div>
    
    <div class="col-sm-4 col-sm-offset-1">
        <form class="form-horizontal" method="POST" action="">
            <h2>Credit Card Information</h2>
            <div class="form-group">
                <label for="" class="control-label col-xs-4">Card Type</label>
                <div class="col-xs-6">
                        <select class="form-control" name="type">
                            <option>Visa</option>
                            <option>Mastercard</option>
                        </select> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-xs-4">Name on Card</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="name" value="<?php echo $cardName; ?>"/>
                        </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-xs-4">Card Number</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="number" value="<?php echo $cardNumber; ?>"/>
                        </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-xs-4">Security Code</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="security" value="<?php echo $security; ?>"/>
                        </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-xs-4">Expiration Date</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="expDate" value="<?php echo $expiration; ?>"/>
                        </div>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="shipping" value="ship" checked="true"/>
                        Ship to Address
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="shipping" value="pickup"/>
                        Pick Up in Store
                      </label>
                    </div>
		        <div id="shippingInput">
                    <h2>Shipping Information </h2> <br/>
                    <div class="form-group">
                        <label for="" class="control-label col-xs-4">Street</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="street" value="<?php echo $street; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-xs-4">Street 2</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="street2" value="<?php echo $street2; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-xs-4">City</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="city" value="<?php echo $city; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-xs-4">State</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="state" value="<?php echo $state; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-xs-4">Zip</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="zip" value="<?php echo $zip; ?>"/>
                        </div>
                    </div>

                    <input type="hidden" name="total" value="<?php echo $total; ?>"/>
                    <br/>
        
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <button type="submit" class="btn btn-primary" name="checkoutInput" value="Continue Checkout"/>Continue Checkout</button>
                        </div>
                    </div>
	        </form>
    <br/><br/><br/><br/>
    
    </div>
    
</div>    



<?php
include "footer.php";
?>