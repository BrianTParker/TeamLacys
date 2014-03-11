<?php
include "header.php";
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
        <form class="form-group" method="POST" action="process_checkout.php">
		<h2>Credit Card Information</h2>
		Card Type <br/>
		<select name="type">
			<option>Visa</option>
			<option>Mastercard</option>
		</select> <br/>
		Name on the card <br/>
		<input type="text" name="name"/><br/>
		Card Number <br/>
		<input type="text" name="number"/> <br/>
		Security Code <br/>
		<input type="text" name="security"/> <br/>
		Expiration Date <br/>
		<input type="text" name="expDate"/> <br/>
		<br/>
        <input type="radio" name="shipping" value="ship" checked="true"/>Ship to Address &nbsp; &nbsp; &nbsp; 
        <input type="radio" name="shipping" value="pickup" />Pickup in Store <br/>
        <div id="shippingInput">
		<h2>Shipping Information </h2> <br/>
		Street Address <br/>
		<input type="text" name="street"/> <br/>
		Apt# <br/>
		<input type="text" name="street2"/> <br/>
		City <br/>
		<input type="text" name="city"/> <br/>
		State <br/>
		<input type="text" name="state"/> <br/>
		Zip <br/>
		<input type="text" name="zip"/> <br/>
		
        </div>
        <br/>
		<input type="submit" name="submit" value="Continue Checkout"/> <br/>
	</form>
	
	
	
	
    
    </div>
    
</div>    



<?php
include "footer.php";
?>