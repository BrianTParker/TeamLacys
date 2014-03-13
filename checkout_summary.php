<?php
include "header.php";
include_once( "Checkout/CheckoutManager.php" );
$total = 0;
$CHECKOUT_MGR = CheckoutManager::getInstance();
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
                    echo '<td>' . $item['size'] . '</td>' . "\n";
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
			<td></td>
			<td><strong>Total</strong></td>
			
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>$<?php echo $total; ?></td>
                
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
        echo "Customer will pickup in store";
    }
    ?>
    <br/>
    <br/>
    <form action="checkout_final.php" method="POST" class="form-group">
    <button class="btn btn-default" name="finishCheckout" type="submit">Finish Checkout</button>
    </form>
    
    </div>
        
        
 
    
</div>





<?php
include "footer.php";
?>