<!--File Name : products.php
	Description : Displays name, product image, sales price, regular price and New item 
				  icon for products that is added in last 7 days in inventory.
--->

<?php
	
	//
	// displayProducts function displays product image and product name
	//
	function displayProducts($id, $image_location, $name) {
		echo '<a href="./details.php?data=' . $id. '"><img src="' . $image_location . '"
						 class="img-thumbnailproduct" style="position: inline ;z-index: 1;"></a>';
		echo "<br/><br/>\n";
		echo '<a href="./details.php?data=' . $id . '">' . $name . '</a>';
		echo "<br/>\n";		

	}
	
	//
	// If promotion is true for product display sales price, displays regular price
	// displayPrice function determines if promotion is true for product then display 
	// sales price,and regular price else display regular price
	//

	function displayPrice($price, $percentage, $expiration_date) {
		$promotion = false;
		
		if(isset($percentage) )
		{
				$promotion = true;
				$promotional_price = ($price - ($price * $percentage));
				$exp_date = strtotime($expiration_date);
		}
		
	
		if($promotion) {
			echo '<font color = "gray">Reg. $'. $price;	
			echo "</br>\n";
			echo '<font color = "red"><strong>Sale $' . number_format($promotional_price, 2) ;
		}
		else {
			echo '<strong>$'. $price;	
		}
	}
	
	//
	// displayNewProecutIcon function displays new item icon
	//
	function displayNewProductIcon() {
		echo '<img src = "img/new-icon.png" alt="New Product Icon" style="position: absolute;z-index: 1;">';
	}
?>
 <!-- end of product.php file-->

