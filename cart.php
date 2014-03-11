<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */
include "header.php";
?>
<div class="row">

    <div class="col-sm-8 col-sm-offset-1">
	
        <h2>Cart</h2>
		
		<table class="table table-condensed">
            <head>
                <th></th>
                <th>Item</th>
                <th>Description</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Size</th>
                <th>Sub Total</th>
                <th></th>
                
            </head>
        <?php
            $subTotal = 0;
            $total = 0;
			// initialize cart manager -nm
			$CART_MGR = CartManager::getInstance();
			
			// for each item in the cart -nm
			foreach( $CART_MGR->getItems() as $index => $item ){
				$subTotal = 0;
				//print_r( $item );
				// print item to screen -nm
				echo '<tr>' . "\n";
				echo '<td><img src="' . $item['image_location'] . '"/></td>' . "\n";
				echo '<td>' . $item['name'] . '</td>' . "\n";
				echo '<td>' . $item['description'] . '</td>' . "\n";
				echo '<td>$' . $item['price'] . '</td>' . "\n";
                echo '<td> x' . $item['quantity'] . '</td>' . "\n";
                echo '<td> ' . $item['size'] . '</td>' . "\n";
                $subTotal += ($item['price'] * $item['quantity']);
                $total += ($item['price'] * $item['quantity']);
                echo '<td>$' . $subTotal . '</td>';
				//echo $total;
                
				// TODO: action="cart_remove_item.php"
				echo '<td> <form id="removeCartForm" method="POST" action=""> <button id="remove" type="submit" class="btn btn-default">Remove</button>
					<input type="hidden" name="index" value="' . $index . '"/> </form>' . "\n";
				echo '</tr>' . "\n";
                
			}
        ?>
        </table>
        <div class="col-sm-4 col-sm-offset-8" align="right">
            <form action="checkout.php" method="POST" id="checkout">
            <?php echo "Total: $" . $total . "\n "; ?>
            
                <input type="hidden" name="total" value="<?php echo $total; ?>"/>
                <button class="btn btn-default" type="submit" name="submit" value="Checkout">Check out</button>
            </form>
        
        </div>
    </div>
</div>

<?php
include "footer.php";
?>