<?php
include "header.php";
$total = 0;
?>

<div class="row">

    <div class="col-sm-8 col-sm-offset-1">
    
        <h1>Checkout</h1>
        
        <table class="table">
            
            <head>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
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

        </table>
        <table class="table">
            <head>
                <th></th>
                <th></th>
                <th></th>
                <th>Total</th>
            </head>
            
            <tr>
            
            </tr>
        </table>
    
    </div>
    
</div>    



<?php
include "footer.php";
?>