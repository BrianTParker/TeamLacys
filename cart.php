<?php
/**********************************INCLUDE*********************************** *
* **************************************************************************** */
include_once( "./Cart/CartManager.php" );
?>

<?php
include "header.php";
?>
<div class="row">

    <div class="col-sm-8 col-sm-offset-1">
	
        <h2>Cart</h2>
		
		<table class="table">
        <?php
        
			// initialize cart manager -nm
			$CART_MGR = CartManager::init();
			
			// for each item in the cart -nm
			foreach( $CART_MGR->getItems() as $key => $item ){
				
				//print_r( $item );
				// print item to screen -nm
				echo '<tr>' . "\n";
				echo '<td><img src="' . $item['image_location'] . '"/></td>' . "\n";
				echo '<td>' . $item['name'] . '</td>' . "\n";
				echo '<td>' . $item['description'] . '</td>' . "\n";
				echo '<td>$' . $item['price'] . '</td>' . "\n";
				
				// TODO: action="cart_remove_item.php"
				echo '<td> <form id="cartForm" method="POST" action=""> <button type="submit" class="btn btn-default">Remove</button>
					<input type="hidden" name="id" value="' . $key . '"/> </form>' . "\n";
				echo '</tr>' . "\n";
			}
        ?>
        </table>
    </div>
</div>

<?php
include "footer.php";
?>