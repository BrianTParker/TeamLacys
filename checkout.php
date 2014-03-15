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
$total = 0;
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
        <form class="form-group" method="POST" action="">
		<h2>Credit Card Information</h2>
		Card Type <br/>
		<select name="type">
			<option>Visa</option>
			<option>Mastercard</option>
		</select> <br/>
		Name on the card <br/>
		<input type="text" name="name" value="<?php echo $cardName; ?>"/><br/>
		Card Number <br/>
		<input type="text" name="number" value="<?php echo $cardNumber; ?>"/> <br/>
		Security Code <br/>
		<input type="text" name="security" value="<?php echo $security; ?>"/> <br/>
		Expiration Date <br/>
		<input type="text" name="expDate" value="<?php echo $expiration; ?>"/> <br/>
		<br/>
        <input type="radio" name="shipping" value="ship" checked="true"/>Ship to Address &nbsp; &nbsp; &nbsp; 
        <input type="radio" name="shipping" value="pickup" />Pickup in Store <br/>
        <div id="shippingInput">
		<h2>Shipping Information </h2> <br/>
		Street <br/>
		<input type="text" name="street" value="<?php echo $street; ?>"/> <br/>
		Street 2 <br/>
		<input type="text" name="street2" value="<?php echo $street2; ?>"/> <br/>
		City <br/>
		<input type="text" name="city" value="<?php echo $city; ?>"/> <br/>
		State <br/>
		<input type="text" name="state" value="<?php echo $state; ?>"/> <br/>
		Zip <br/>
		<input type="text" name="zip" value="<?php echo $zip; ?>"/> <br/>
		
        </div>
        <input type="hidden" name="total" value="<?php echo $total; ?>"/>
        <br/>
		<input type="submit" name="checkoutInput" value="Continue Checkout"/> <br/>
	</form>
	
	
	
	
    
    </div>
    
</div>    



<?php
include "footer.php";
?>