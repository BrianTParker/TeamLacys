<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */
include "header.php";
?>
<div class="row">

    <div class="col-sm-8 col-sm-offset-1">
	
        <h2>Cart</h2>
		
		<table class="table">
        <?php
        
			// initialize cart manager -nm
			$CART_MGR = CartManager::getInstance();
			
			// for each item in the cart -nm
			foreach( $CART_MGR->getItems() as $index => $item ){
				
				//print_r( $item );
				// print item to screen -nm
				echo '<tr>' . "\n";
				echo '<td><img src="' . $item['image_location'] . '"/></td>' . "\n";
				echo '<td>' . $item['name'] . '</td>' . "\n";
				echo '<td>' . $item['description'] . '</td>' . "\n";
				echo '<td>$' . $item['price'] . '</td>' . "\n";
                echo '<td> Qty:' . $item['quantity'] . '</td>' . "\n";
				
				// TODO: action="cart_remove_item.php"
				echo '<td> <form id="removeCartForm" method="POST" action=""> <button id="remove" type="submit" class="btn btn-default">Remove</button>
					<input type="hidden" name="index" value="' . $index . '"/> </form>' . "\n";
				echo '</tr>' . "\n";
			}
        ?>
        </table>
    </div>
</div>

<?php
include "footer.php";
?>