<?php
include "header.php";
include_once( "Account/AccountManager.php" );

$promotional_price = 0;
$promotion = false;

$ACCT_MGR = AccountManager::getInstance();

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
								
?>

	<div class="row">
		<div class="col-sm-3 col-sm-offset-1">

			<div class="panel panel-default" style="text-align:center;">
				<div class="panel-heading">
					<class="panel-title"><h3>Reviews</h3>
				</div> 
				<?php
				if($review_sql->rowCount() >0){
					echo '<table class="table">' . "\n";
					while($row = $review_sql->fetch()) {
						echo '<tr>' . "\n";
						echo '<td>' . "\n";
						echo '<p><i>' . $row['review'] . '</p> </i><br/>';
						echo '- <strong>' . $row['first_name'] . ' ' . $row['last_name'] . ' </strong>';
						echo '</td>' . "\n";
						echo '</tr>' . "\n";
						
					}
					echo '</table>' . "\n";
					echo '<br/>';
					echo '<h4></h4/>';
				}else{
					echo '<p><i><h5>(Be the first to write a review!)</h5></p> </i>';
				}
				?>

			<div class="panel-footer">
			<?php
			if($ACCT_MGR->isLoggedIn()){
				echo '<form class="form-group" method="POST" action="">' . "\n";
				echo '<textarea name ="review" placeholder="Write a Review" class="form-control" rows="3"></textarea>';
				echo '<input type="hidden" name="customer_id" value="' . $ACCT_MGR->getId() . '"/>' . "\n";
				echo '<input type="hidden" name="product_id" value="' . $productId . '"/>' . "\n";
				echo '<br/>';
				echo '<p style="text-align:center;"><button type="submit"  class="btn btn-primary btn-xs">Post Review</button></p>' . "\n";
				
				echo '</form>';
			}else{
				echo '<a href="login.php"> Log in</a> to write a review';
			}
			?>
			</div>
		</div>
</div>
	
	<?php
	$details_sql = $DBH->query("select p.id as product_id, p.name as product_name, p.description as product_desc, p.image_location, p.price, pr.percentage, pr.expiration_date
								from products p
								left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()							
								where p.id = " . $productId);
	?>
	<div class="col-sm-2 col-sm-offset-1">



	<?php
	$details_sql->setFetchMode(PDO::FETCH_ASSOC);
		$row = $details_sql->fetch();
	echo '<td><h3>' . $row['product_name'] . '</h3></td>' . "\n";
		echo '<table class="table" width="200">';

		echo '<tr>';
		
		echo '</tr>';
		echo '<tr>';
		echo '<td style="text-align:center;"><h5>' . $row['product_desc'] . '</h5></td>' . "\n";
		echo '<tr>';
		if(isset($row['percentage']) ){
			
			$promotion = true;
			$promotional_price = ($row['price'] - ($row['price'] * $row['percentage']));
			$exp_date = strtotime($row['expiration_date']);
			
			
		}
		if($promotion){
			echo '<td>$' . number_format($promotional_price, 2) . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <strong>' . $row['percentage'] * 100 . '% off!</strong></td>' . "\n"; 
		}else{
			echo '<td style="text-align:center;"><h4>$' . $row['price'] . '</h4></td>' . "\n";
		}
	?>
	</tr>

	<td style="text-align:center;">
	<?php //echo '<form class="form-inline">'; ?>
	<form id="addCartForm" method="POST" class="form-inline">
	<label>Qty</label>
	<br/>
	<select style="width:60px" class="form-control" name="quantity">
	<option>1</option>
	<option>2</option>
	<option>3</option>
	<option>4</option>
	<option>5</option>
	</select>
	<br/><br/>
	<label>Size</label>
	<br/>
	<select style="width:60px" class="form-control" name="size">
	<option>S</option>
	<option>M</option>
	<option>L</option>
	<option>XL</option>
	<option>XXL</option>
	</select>
	<br/>
	<br/>
	
	
	<p style="text-align:center;"><button type="submit" class="btn btn-default">Add to cart</button></p>
	
	<input type="hidden" name="id" value="<?php echo $row['product_id']; ?>"/>
	<input type="hidden" name="name" value="<?php echo $row['product_name']; ?>"/>
	<input type="hidden" name="description" value="<?php echo $row['product_desc']; ?>"/>
	<input type="hidden" name="image_location" value="<?php echo $row['image_location']; ?>"/>
	<?php
	if($promotion){
		echo '<input type="hidden" name="price" value="' . $promotional_price . '"/>';
	}else{
		echo '<input type="hidden" name="price" value="' . $row['price'] . '"/>';
	}
	?>
	
	</form>
	</form>

	</table>


	
	
    </div>

    <?php
    echo '<td><a href="./details.php?data=' . $row['product_id'] . '"><img src="' . $row['image_location'] . '" ></a></td>' . "\n";
    ?>
</div>
<br/><br/><br/><br/>
<?php
include "footer.php"
?>