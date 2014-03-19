<?php
include "header.php";
include_once( "Account/AccountManager.php" );

$promotional_price = 0;


	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$productId = $_POST['product_id'];
		$customerId = $_POST['customer_id'];
		$review = $_POST['review'];
		if(!empty($_POST['review'])){
			$review_insert_sql = "insert into reviews (product_id, customer_id, review)
									values (:productId, :customerId,:review)";
			$review_insert_sql = $DBH->prepare($review_insert_sql);
			$review_insert_sql->execute(array(':productId'=>$productId,
							  ':customerId'=>$customerId,
							  ':review'=>$review
							  ));
		}
		
										
	}
	
	
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$productId = $_GET['data'];
	}	
									
	$review_sql = $DBH->query("select r.review,
								c.first_name, c.last_name
								from reviews r
								join customers c on c.id = r.customer_id
								where r.product_id = " . $productId);
								


	echo '<div class="row">' . "\n";

	echo '<div class="col-sm-3 col-sm-offset-1">' . "\n";
		echo '<h1>Reviews</h1>' . "\n";
		if($review_sql->rowCount() >0){
			echo '<table class="table">' . "\n";
			while($row = $review_sql->fetch()) {
				echo '<tr>' . "\n";
				echo '<td>' . "\n";
				echo '<p>' . $row['review'] . '</p> <br/>';
				echo '- ' . $row['first_name'] . ' ' . $row['last_name'];
				echo '</td>' . "\n";
				echo '</tr>' . "\n";
				
			}
			echo '</table>' . "\n";
			echo '<br/>';
			echo '<h3>Write a review</h3/>';
		}else{
			echo '<h3>Be the first to write a review</h3>';
		}
		
		$ACCT_MGR = AccountManager::getInstance();
		if($ACCT_MGR->isLoggedIn()){
			echo '<form class="form-group" method="POST" action="">' . "\n";
			echo '<textarea name ="review" class="form-control" rows="3"></textarea>';
			echo '<input type="hidden" name="customer_id" value="' . $ACCT_MGR->getId() . '"/>' . "\n";
			echo '<input type="hidden" name="product_id" value="' . $productId . '"/>' . "\n";
			echo '<button type="submit" class="btn btn-default">Post Review</button>' . "\n";
			
			echo '</form>';
		}else{
			echo '<a href="login.php"> Log in</a> to write a review';
		}
		
	echo '</div>' . "\n";


	$details_sql = $DBH->query("select p.id as product_id, p.name as product_name, p.description as product_desc, p.image_location, p.price, pr.percentage, pr.expiration_date 
								from products p
								left join promotions pr on pr.product_id = p.id 								
								where p.id = " . $productId);
	echo '<div class="col-sm-2 col-sm-offset-1">' . "\n";





	$details_sql->setFetchMode(PDO::FETCH_ASSOC);
	$row = $details_sql->fetch();
	echo '<table class="table">';
	echo '<tr>';
	echo '<td><a href="./details.php?data=' . $row['product_id'] . '"><img src="' . $row['image_location'] . '"></a></td>' . "\n";
	echo '</tr>';
	echo '<tr>';
	echo '<td><h3>' . $row['product_name'] . '</h3></td>' . "\n";
	echo '</tr>';
	echo '<tr>';
	echo '<td>' . $row['product_desc'] . '</td>' . "\n";
	echo '<tr>';
	if(isset($row['percentage'])){
		$promotional_price = ($row['price'] - ($row['price'] * $row['percentage']));
		echo '<td>$' . number_format($promotional_price, 2) . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <strong>' . $row['percentage'] * 100 . '% off!</strong></td>' . "\n"; 
	}else{
		echo '<td>$' . $row['price'] . '</td>' . "\n";
	}
	
	echo '</tr>';

	echo '<td>';
	echo '<form id="addCartForm" method="POST" class="form">'; 
	echo '<select name="quantity">';
	echo '<option>1</option>';
	echo '<option>2</option>';
	echo '<option>3</option>';
	echo '<option>4</option>';
	echo '<option>5</option>';
	echo '</select>';
	echo ' Qty';
	echo '<br/>';
	echo '<br/>';
	echo '<select name="size">';
	echo '<option>S</option>';
	echo '<option>M</option>';
	echo '<option>L</option>';
	echo '<option>XL</option>';
	echo '<option>XXL</option>';
	echo '</select>';
	echo ' Size';
	echo '<br/>';
	echo '<br/>';
	echo '<button type="submit" class="btn btn-default">Add to cart</button>';
	echo '<input type="hidden" name="id" value="' . $row['product_id'] . '"/>';
	echo '<input type="hidden" name="name" value="' . $row['product_name'] . '"/>';
	echo '<input type="hidden" name="description" value="' . $row['product_desc'] . '"/>';
	echo '<input type="hidden" name="image_location" value="' . $row['image_location'] . '"/>';
	if(isset($row['percentage'])){
		echo '<input type="hidden" name="price" value="' . $promotional_price . '"/>';
	}else{
		echo '<input type="hidden" name="price" value="' . $row['price'] . '"/>';
	}
	
	echo '</form>' . "\n";
	echo '</table>';
		
	
	?>
   
    </div>
    
</div>

<?php
include "footer.php"
?>