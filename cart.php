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
				echo '<td>';
				echo '<form id="removeCartForm" method="POST" action="./php/cart/ajax/cart_remove_item.php">'; 
				/* echo '<select name="quantity">';
				echo '<option>1</option>';
				echo '<option>2</option>';
				echo '<option>3</option>';
				echo '<option>4</option>';
				echo '<option>5</option>';
				echo '</select>'; */
				echo $item[ 'quantity' ];
				echo '</td>';
				echo '<td>';
				/* echo '<select name="size">';
				echo '<option>S</option>';
				echo '<option>M</option>';
				echo '<option>L</option>';
				echo '<option>XL</option>';
				echo '<option>XXL</option>';
				echo '</select>'; */
				echo $item[ 'size' ];
				echo '</td>';
				
				$subTotal 	+= ( $item[ 'price' ] * $item[ 'quantity' ] );
                $total 		+= ( $item[ 'price' ] * $item[ 'quantity' ] );
				
                echo '<td>$' . $subTotal . '</td>';
				
				echo '<td>';
				echo '<button type="submit" class="btn btn-default">Remove</button>';
				echo '</td>';
				
				echo '<input type="hidden" name="id" value="' . $item['id'] . '"/>';
				echo '<input type="hidden" name="name" value="' . $item['name'] . '"/>';
				echo '<input type="hidden" name="description" value="' . $item['description'] . '"/>';
				echo '<input type="hidden" name="image_location" value="' . $item['image_location'] . '"/>';
				echo '<input type="hidden" name="price" value="' . $item['price'] . '"/>';
				echo '<input type="hidden" name="index" value="' . $index . '"/>';
				echo '</form>' . "\n";
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