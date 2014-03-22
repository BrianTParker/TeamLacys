<?php
include "header.php";
include_once( "Checkout/CheckoutManager.php" );
include_once( "Account/AccountManager.php" );
$total = 0;
$CHECKOUT_MGR = CheckoutManager::getInstance();
$CART_MGR = CartManager::getInstance();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $status = $CHECKOUT_MGR->checkout();
    
   
    
    if($status["success"] === 1){
		echo '<div class="row">' . "\n";

		echo '<div class="col-sm-4 col-sm-offset-4">' . "\n";
        
		echo '<h1>Checkout Completed!</h1>' . "\n";
        echo '<br/>' . "\n";
        echo '<h3>Item Details</h3>' . "\n";
        echo '<table class="table">' . "\n";
            
        echo '    <head>' . "\n";
        echo '        <th>Item</th>' . "\n";
        echo '        <th>Size</th>' . "\n";
        echo '        <th>Price</th>' . "\n";
        echo '        <th>Qty</th>' . "\n";
        echo '        <th>Subtotal</th>' . "\n";
        echo '    </head>' . "\n";
            
            
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
            
            echo '<tr>' . "\n";
			echo '<td></td>' . "\n";
            echo '<td></td>' . "\n";
			echo '<td></td>' . "\n";
			echo '<td></td>' . "\n";
			echo '<td><strong>Total</strong></td>' . "\n";
			
            echo '</tr>' . "\n";
            echo '<tr>' . "\n";
            echo '<td></td>' . "\n";
            echo '<td></td>' . "\n";
            echo '<td></td>' . "\n";
            echo '<td></td>' . "\n";
            echo '<td>$' . number_format($total, 2) . '</td>' . "\n";
                
            echo '</tr>' . "\n";
			echo '<tr>' . "\n";
			echo '<td><strong>Confirmation Code:</strong></td>' . "\n";
            echo '<td>' . $status['confirmation_code'] . '</td>' . "\n";
			echo '<td></td>' . "\n";
			echo '<td></td>' . "\n";
			echo '<td></td>' . "\n";
			
            echo '</tr>' . "\n";
            echo '<tr>' . "\n";
            echo '<td></td>' . "\n";
            echo '<td></td>' . "\n";
            echo '<td></td>' . "\n";
            echo '<td></td>' . "\n";
            echo '<td></td>' . "\n";
                
            echo '</tr>' . "\n";
        echo '</table>' . "\n";
        $CART_MGR->emptyCart();
        $CHECKOUT_MGR->getNewSummary();
        //header("location: index.php");
    }else{
        echo '<div class="row">';
            echo '<div class="col-sm-4 col-sm-offset-1">';
            echo '</div>';
            echo '<div class="col-sm-4 col-sm-offset-1">';
                foreach($status["errors"] as $key => $value) 
                    {
                        echo '<li>' . $value . '</li>'; 
                    }
                    echo '</ul>';
            echo '</div>';
        echo '</div>';
    }
}
?>

        
        
    </div>
    
</div>

<?php
include "footer.php";
?>