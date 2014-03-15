<?php
include "header.php";
include_once( "Account/AccountManager.php" );
?>


	
	<?php
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
	
		echo '<div class="row">' . "\n";

		echo '<div class="col-sm-4 col-sm-offset-1">' . "\n";
			echo '<h1>Reviews</h1>' . "\n";
			
			$ACCT_MGR = AccountManager::getInstance();
			if($ACCT_MGR->isLoggedIn()){
				
			}
			
		echo '</div>' . "\n";
		echo '<div class="col-sm-2">' . "\n";
		
		$id = $_GET['data'];
		
		$details_sql = $DBH->query("select p.id as product_id, p.name as product_name, p.description as product_desc, p.image_location, p.price from products p 
									left join reviews r on p.id = r.product_id 
									left join customers c on c.id = r.customer_id
									where p.id = " . $id);
		
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
		echo '<td>$' . $row['price'] . '</td>' . "\n";
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
		echo '<input type="hidden" name="price" value="' . $row['price'] . '"/>';
		echo '</form>' . "\n";
		echo '</table>';
		
	}
	?>
   
    </div>
    
</div>

<?php
include "footer.php"
?>