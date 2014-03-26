<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */
include "header.php";
?>

<?php 
	$subtotal 	= 0;
	$salesTax	= .06;
	$shipping	= 0;
	$total		= 0;
	
	// get sub total -nm
	foreach (CartManager::getInstance()->getItems() as $item){
	
		$subtotal += $item["price"];
	}
	
	// sales tax -nm
	$salesTax = $subtotal * .06;
	
	// shipping -nm
	$shipping = CartManager::getInstance()->getItemCount() * 1;
	
	// order total -nm
	$total = $subtotal + $salesTax + $shipping;
?>

<div class="row">
	
    <div class="col-sm-10 col-sm-offset-1">
<h1>Cart</h1>

</div>
<div class="col-sm-2 col-sm-offset-9">
	<form action="./index.php">
		<button class="btn btn-default pull-right">Continue Shopping</button>
	</form>
    <br/>
    <br/>
</div>
</div>
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
	<table class="table table-striped table-condensed table-responsive">
		<th>Item</th>
		<th>Name</th>
		<th>Description</th>
		<th>Price</th>
		<th>Qty</th>
		<th>Size</th>
		<th>Total</th>
		<th></th>
		
		<?php
			if (CartManager::getInstance()->isEmpty()){
			
				echo "<tr><td>There are no items in your cart!</td></tr>";
			
			}else{ // list all items in cart -nm
			
				foreach (CartManager::getInstance()->getItems() as $index => $item){
			
					echo '<tr>';
					echo '	<td>';
					echo '		<img src="' . $item['image_location'] . ' " width=96 height=144 />';
					echo '	</td>';
					
					echo '	<td>';
					echo '		<font>' . $item['name'] . '</font>';
					echo '	</td>';
					
					echo '	<td>';
					echo '		<font>' . $item['description'] . '</font>';
					echo '	</td>';
					
					echo '	<td>';
					echo '		<font>$' . number_format($item['price'], 2) . '</font>';
					echo '	</td>';
					
					echo '	<td>';
					echo '		<font>' . $item['quantity'] . '</font>';
					echo '	</td>';
					
					echo '	<td>';
					echo '		<font>' . $item['size'] . '</font>';
					echo '	</td>';
					
					echo '	<td>';
					echo '		<font>$' . number_format($item["price"] * $item["quantity"], 2) . '</font>';
					echo '	</td>';
					
					echo '	<td>';
					echo '	<form id="removeCartForm" method="POST" action="./php/cart/ajax/cart_remove_item.php">';
					echo '		<input type="hidden" name="id" 				value="' . $item['id'] 				. '"/>';
					echo '		<input type="hidden" name="name" 			value="' . $item['name'] 			. '"/>';
					echo '		<input type="hidden" name="description" 	value="' . $item['description'] 	. '"/>';
					echo '		<input type="hidden" name="image_location" 	value="' . $item['image_location'] 	. '"/>';
					echo '		<input type="hidden" name="price" 			value="' . $item['price'] 			. '"/>';
					echo '		<input type="hidden" name="index" 			value="' . $index 					. '"/>';
					echo '		<button type="submit" class="btn btn-danger btn-xs pull-right">Remove</button>';
					echo '	</form>';
					echo '	</td>';
					echo '</tr>';
				}
			}
		?>
	</table>
</div>
</div>
</div>
</div>

<div class="row">
	<div class="col-sm-3 col-sm-offset-8">
	<table class="table">
		
		<tr>
			<td><b>Subtotal:</b></td>
			<td><?php echo "$" . number_format( $subtotal, 2 ); ?></td>
		</tr>
		
		<tr>
			<td><b>Sales Tax:</b></td>
			<td><?php echo "$" . number_format( $salesTax, 2 ); ?></td>
		</tr>
		
		<tr>
			<td><b>Shipping Cost:</b></td>
			<td><?php echo "$" . number_format( $shipping, 2 ); ?></td>
		</tr>
		
		<tr>
			<td><b>Total:</b></td>
			<td><?php echo "$" . number_format( $total, 2 ); 	?></td>
			<td>
				<form method="POST" action="<?php
					
					if (AccountManager::getInstance()->isLoggedIn()){
					
						echo './checkout.php';
					}else{
					
						echo './guestcheckout.php';
					}
				?>" >
					
					<?php 
						if (!CartManager::getInstance()->isEmpty()){
						
							echo '<button class="btn btn-success btn-sm" type="submit" name="beginCheckout" value="Checkout" id="cartCheckout">Check Out</button>';
						}
					?>
					
					<input type="hidden" name="total" value="<?php echo $total; ?>"/>
				</form>
			</td>
		</tr>
		
	</table>
</div>
</div>

<?php
include "footer.php";
?>