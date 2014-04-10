<?php
include "header.php";

if(!isset($productId)){
	$productId = '';
}
				
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['createPromotion'])){
		$productId = $_POST['productId'];
		echo '<form class="form" method="POST" action="">' . "\n";
		echo 'Percentage (ex. use .2 for 20%)' . "\n";
		echo '<input type="text" name="percentage">' . "\n";
		echo 'Expiration Date (yyyy-mm-dd)' . "\n";
		echo '<input type="text" name="expiration_date">' . "\n";
		echo '<input type="hidden" name="productId" value="' . $productId . '">';
		echo '<input type="submit" name="promotionSubmit" value="Submit">' . "\n";
		
		echo '</form>' . "\n";
	}
	
	if(isset($_POST['promotionSubmit'])){
	
		$STH = $DBH->query("select * from promotions where product_id = '" . $productId . "' and expiration_date >= CURDATE()");
        if($STH->rowCount() > 0){
			header("location: index.php");
		}else{
		$expiration_date = date ("Y-m-d", strtotime($_POST['expiration_date']));
		
		$sql = "Insert into promotions(product_id, percentage, expiration_date)
				values (:product_id, :percentage,:expiration_date)";
		$q = $DBH->prepare($sql);
		$q->execute(array(':product_id'=>$_POST['productId'],
						  ':percentage'=>$_POST['percentage'],
						  ':expiration_date'=>$expiration_date
						  ));
		header("location: index.php");
		}
		
	}
}




?>