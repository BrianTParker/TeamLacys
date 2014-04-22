<?php
include "header.php";


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
								

	$details_sql = $DBH->query("select p.id as product_id, p.name as product_name, p.description as product_desc, p.image_location, p.has_color, p.has_size,p.price, pr.percentage, pr.expiration_date,
								p.quantity
								from products p
								left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()							
								where p.id = " . $productId);
								
	$color_sql = $DBH->query("select color_name from colors");
	
	$size_sql = $DBH->query("select size from sizes");
	
?>

	<?php
			$details_sql->setFetchMode(PDO::FETCH_ASSOC);
			$row = $details_sql->fetch();
	?>
	<div class="row">
		<div class="col-sm-2 col-sm-offset-1">
			<?php
				echo '<br/><br/>';
				echo '<td><a href="./details.php?data=' . $row['product_id'] . '"><img src="' . $row['image_location'] . '" ></a></td>' . "\n";
			?>
		</div>
		
		
		<div class="col-sm-3 col-sm-offset-1">
			<?php
				echo '<table class="table" width="200">';
					echo '<tr>';
						echo '<p class="text-center"><h2>' . $row['product_name'] . '</h2>' . "\n";
					echo '</tr>';
					
					echo '<tr>';
						echo '<td>';
						if(isset($row['percentage']) ){
							$promotion = true;
							$promotional_price = ($row['price'] - ($row['price'] * $row['percentage']));
							$exp_date = strtotime($row['expiration_date']);
						}
						
						//if($promotion){
						//	echo '<h5>Sale Price: $' . number_format($promotional_price, 2) . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <strong><font color="red">' . $row['percentage'] * 100 . '% off!</font></strong></h5></td>' . "\n"; 
						//}
						
						if($promotion)
						{
						
							echo '<h5><font color = "gray">Regular Price: $' . $row['price'] . '</font></h5>' . "\n";
							echo '<h5><strong>Sale Price: $' . number_format($promotional_price, 2) . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <font color="red">' . $row['percentage'] * 100 . '% off!</font></strong></h5></td>' . "\n"; 
						}
						else
						{
							echo '<h5><strong>Regular Price:  $'. $row['price'].'</strong></h5>';		
						}
						
						echo '</td>';
					echo '</tr>';
					
					
					
			?>
	
					<tr>
						<td style="text-align:left;">
							<form id="addCartForm" method="POST" class="form-inline">
								<label>Qty: &nbsp&nbsp&nbsp&nbsp&nbsp</label>
									<select style="width:80px" class="form-control" name="quantity">
										<?php
										if($row['quantity'] > 0){
											for($i = 1; $i <= $row['quantity']; $i++){
												echo '<option>' . $i . '</option>' . "\n";
											}
										}else{
											echo '<option>1</option>' . "\n";
										}
										?>										
									</select>
								<br/><br/>
								<?php
								if($row['has_size'] == 1){
									echo '<label>Size: &nbsp&nbsp&nbsp&nbsp</label>' . "\n";
									echo '<select style="width:80px" class="form-control" name="size">' . "\n";
									$size_sql->setFetchMode(PDO::FETCH_ASSOC);
									while($sizeRow = $size_sql->fetch()){
										echo '<option>' . $sizeRow['size'] . '</option>' . "\n";
									}
									echo '</select>' . "\n";
									echo '<br/><br/>' . "\n";
								}
								?>
										
								<?php
								if($row['has_color'] == 1){
									echo '<label>Color: &nbsp&nbsp</label>' . "\n";
									echo '<select style="width:100px" class="form-control" name="color">' . "\n";
									$color_sql->setFetchMode(PDO::FETCH_ASSOC);
									
									while($colorRow = $color_sql->fetch()){
										echo '<option>' . $colorRow['color_name'] . '</option>' . "\n";
									}
									echo '</select>' . "\n";
									echo '<br/><br/>' . "\n";
								}
								
								?>
								
									
									
										
									
									
	
	
								<p style="text-align:center;">
									<?php
									if($row['quantity'] > 0){
										echo '<button type="submit" class="btn btn-warning btn-lg">Add to cart</button>' . "\n";
									}else{
										echo '<button type="submit" class="btn btn-warning btn-lg" disabled>Out of Stock</button>' . "\n";
									}
									
									?>
									</p>
									<input type="hidden" name="id" value="<?php echo $row['product_id']; ?>"/>
									<input type="hidden" name="name" value="<?php echo $row['product_name']; ?>"/>
									
									<input type="hidden" name="image_location" value="<?php echo $row['image_location']; ?>"/>
									
									<?php
										if($promotion){
											echo '<input type="hidden" name="price" value="' . $promotional_price . '"/>';
										}else{
											echo '<input type="hidden" name="price" value="' . $row['price'] . '"/>';
										}
									?>
	
							</form>
							
							<?php
							
							if($ACCT_MGR->getAccessLevel() == 1){
								echo '<div class="col-sm-3 col-sm-offset-3">';
								echo '<form class="form" method="POST" action="createPromotion.php">';
								echo '<input type="hidden" value="' . $productId . '" name="productId">';
								echo '<button type="submit" name="createPromotion" class="btn btn-warning btn-lg">Create Promotion</button>' . "\n";
								echo '</form>';
								echo '</div>';
							}
									
							?>
						</td>
					</tr>
					
					<tr>
						<td></td>
					</tr>
				</table>
			
			<div class="panel panel-default" style="text-align:left;">
				<div class="panel-heading">
					<class="panel-title"><h4><b>Details & Care</b></h4>
				</div> 
				
				<div class="panel-body">
					<?php
						echo '<br/>';
						echo '<td style="text-align:center;"><h5>' . $row['product_desc'] . '</h5></td>' . "\n";
					?>
				</div>
			</div>
		</div>
		
		<div class="col-sm-3 col-sm-offset-1">
			<br/>
			<div class="panel panel-default" style="text-align:center;">
				<div class="panel-heading">
					<class="panel-title"><h3>Reviews</h3>
				</div> 
				
				<div class="panel-body">
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
				
				<div class="panel-footer">
					<?php
						if($review_sql->rowCount() >0){
							echo '<table class="table">' . "\n";
								while($row = $review_sql->fetch()) {
									echo '<tr>' . "\n";
									echo '<td>' . "\n";
									echo '<p><h6><i>' . $row['review'] . '</h6></p> </i>';
									echo '- <strong>' . $row['first_name'] . ' ' . $row['last_name'] . ' </strong>';
									echo '</td>' . "\n";
									echo '</tr>' . "\n";
						
								}
							echo '</table>' . "\n";
							echo '<h4></h4/>';
						}else{
							echo '<p><i><h5>(Be the first to write a review!)</h5></p> </i>';
						}
					?>
				</div>
				
				
		</div>
    </div>
</div>
	

<br/><br/><br/><br/>
<?php
include "footer.php"
?>