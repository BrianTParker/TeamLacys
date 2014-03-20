<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */
include "header.php";
?>
<div class="row">

    <div class="col-sm-10 col-sm-offset-1">
	
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
			
			echo '<tr>' . "\n";
			echo '<form action="./index.php">' . "\n";
			echo '<button class="btn btn-primary btn-sm pull-left" type="submit">Continue Shopping</button>' . "\n";
			echo '</form>' . "\n";
			echo '</tr>' . "\n";
			
			if ($CART_MGR->isEmpty()){
				
				echo '<tr>';
				echo '<td align="center"><i>You have nothing in your cart!</i></td>';
				echo '</tr>';

			
			}else{
			
				// for each item in the cart -nm
				foreach( $CART_MGR->getItems() as $index => $item ){
					$subTotal = 0;
					//print_r( $item );
					// print item to screen -nm
					echo '<tr>';
					echo '<td><img class="img-responsive" src="' . $item['image_location'] . '"/></td>' . "\n";
					echo '<td>' . $item['name'] . '</td>' . "\n";
					echo '<td>' . $item['description'] . '</td>' . "\n";
					echo '<td>$' . number_format($item['price'], 2) . '</td>' . "\n";
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
					
					echo '<td>$' . number_format($subTotal, 2) . '</td>';
					
					echo '<td>';
					echo '<button type="submit" class="btn btn-danger btn-xs pull-right">Remove</button>';
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
				
				echo '</table>';
				echo '<div class="form-group">';
				echo '<div class="col-sm-4 col-sm-offset-8" align="right">';
				echo '<form action="./index.php">';
				echo '<button class="btn btn-primary btn-sm" type="submit">Continue Shopping</button>';
						
				echo '</form>';
				
				echo '<form action="checkout.php" method="POST" id="checkout">';
				echo "<h4>Total: $" . number_format($total, 2) . "\n </h4>";
				
				echo '<input type="hidden" name="total" value="' . $total . '"/><br/><br/>';
				echo '<button class="btn btn-success btn-sm pull-right" type="submit" name="beginCheckout" value="Checkout">Check Out</button>';
					
				echo '</form>';
				echo '</div>';
				echo '</div>';
			}
        ?>
    </div>
</div>
<br/><br/><br/><br/><br/><br/>
<?php
include "footer.php";
?>