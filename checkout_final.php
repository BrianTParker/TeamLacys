<?php
include "header.php";
$total = 0;
?>

<div class="row">

    <div class="col-sm-4 col-sm-offset-1">
        
        <h1>Checkout Summary</h1>
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
    </div>
    
</div>





<?php
include "footer.php";
?>