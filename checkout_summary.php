<?php
include "header.php";
include_once( "Checkout/CheckoutManager.php" );
$total = 0;
$CHECKOUT_MGR = CheckoutManager::getInstance();
$orderTotal = $CHECKOUT_MGR->getOrderTotal();
?>

<div class="row">

    <div class="col-sm-4 col-sm-offset-4">
        
        <h1>Checkout Summary</h1>
        <br/>
        <h3>Item Details</h3>
        <table class="table">
            
            <head>
                <th>Item</th>
                <th>Size</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Amount</th>
            </head>
            <?php
            $CART_MGR = CartManager::getInstance();
                foreach( $CART_MGR->getItems() as $index => $item ){
                    $subTotal = 0;
                    //print_r( $item );
                    // print item to screen -nm
                    echo '<tr>' . "\n";
                    echo '<td>' . $item['name'] . '</td>' . "\n";
                    echo '<td>' . $item['size'] . '</td>' . "\n";
                    echo '<td>$' . number_format($item['price']) . '</td>' . "\n";
                    echo '<td> x' . $item['quantity'] . '</td>' . "\n";
                    $subTotal += ($item['price'] * $item['quantity']);
                    $total += ($item['price'] * $item['quantity']);
                    echo '<td>$' . number_format($subTotal, 2) . '</td>';
                    echo '</tr>' . "\n";
                    
                }
            ?>
            		<tr>
			<td><br/></td>
            <td></td>
			<td></td>
			<td></td>
			<td></strong></td>
			
            </tr>
            		<tr>
			<td></td>
            <td></td>
			<td></td>
			<td><strong>Sub Total</strong></td>
			<td>$<?php echo number_format($total, 2); ?></td>
			
            </tr>
            
            
            		<tr>
			<td></td>
            <td></td>
			<td></td>
			<td><strong>Tax</strong></td>
			<td>$<?php echo number_format($orderTotal['tax'], 2); ?></td>
			
            </tr>
           
            
            		<tr>
			<td></td>
            <td></td>
			<td></td>
			<td><strong>Shipping</strong></td>
			<td>$<?php echo number_format($orderTotal['ship'], 2); ?></td>
			
            </tr>
            
            </tr>
            
            
            		<tr>
			<td></td>
            <td></td>
			<td></td>
			<td><strong>Grand Total</strong></td>
			<td>$<?php echo number_format($orderTotal['grand'], 2); ?></td>
			
            </tr>
           
            
        </table>
    
    
    
    <br/>
  
    <h3>Billing Information</h3>
    Card Type: <?php echo $CHECKOUT_MGR->getCardType(); ?>
    <br/>
    Name on Credit Card: <?php echo $CHECKOUT_MGR->getCardName(); ?>
    <br/>
    Credit Card Number Ending in: <?php echo substr($CHECKOUT_MGR->getCardNumber(), -4); ?>
    <br/>
    Credit Card Expiration: <?php echo $CHECKOUT_MGR->getExpirationMonth() . '/' . $CHECKOUT_MGR->getExpirationYear(); ?>
    <br/>
    <h3>Delivery Information</h3>
    <?php
    
    if($CHECKOUT_MGR->getShippingOption() === "ship"){
        echo "Street: " . $CHECKOUT_MGR->getStreet1();
        echo "<br/>";
        if(!empty($_SESSION['summary']['street2'])){
            echo "Street 2: " . $CHECKOUT_MGR->getStreet2();
            echo "<br/>";
        }
        echo "City: " . $CHECKOUT_MGR->getCity();
        echo "<br/>";
        echo "State: " . $CHECKOUT_MGR->getState();
        echo "<br/>";
        echo "Zip: " . $CHECKOUT_MGR->getZip();
        echo "<br/>";
        
    }else{
        echo "Customer will pickup at store location: <br/>";
		echo '<strong>' . $CHECKOUT_MGR->getStoreLocationText() . '</strong>';
    }
    ?>
    <br/>
    <br/>
    <form action="checkout_final.php" method="POST" class="form-group">
    <input type="hidden" name="tax" value="<?php echo $orderTotal['tax']; ?>">
    <input type="hidden" name="shipping" value="<?php echo $orderTotal['ship']; ?>">
    <input type="hidden" name="grandTotal" value="<?php echo $orderTotal['grand']; ?>">
    <button class="btn btn-default" name="finishCheckout" type="submit">Finish Checkout</button>
    </form>
    
    </div>
        
        
 
    
</div>





<?php
include "footer.php";
?>