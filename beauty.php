<?php
include "header.php";
include_once "Products/products.php";
?>

<div class="container-fluid">
	<div class="row">
	
	   <div class="col-sm-8 col-sm-offset-2">
	   
			<!--This is generic image area which has image of Beauty generic products-->	
			<div class ="text-center">	
				<img src = "img/bannerBeauty.jpg" alt="Generic Beauty product" width= "100%" height="150">
				</br></br>
			</div><!-- end of div for image -->
			
			
			<!-- Only required for left/right tabs -->
			<div class="tabbable"> 
				
				<ul class="nav nav-tabs">
	
					<?php 
					
					//Formulate Queries
					$haircare_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.product_category = 'haircare' 
									order by p.date_added desc");								
					$haircare_count_sql = $DBH->query("select count(*) from products where product_category = 'haircare'");
					
					$perfume_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.product_category = 'perfume' 
									order by p.date_added desc");								
					$perfume_count_sql = $DBH->query("select count(*) from products where product_category = 'perfume'");
					
					$makeup_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.product_category = 'makeup' 
									order by p.date_added desc");								
					$makeup_count_sql = $DBH->query("select count(*) from products where product_category = 'makeup'");
					
					$cologne_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.product_category = 'cologne' 
									order by p.date_added desc");								
					$cologne_count_sql = $DBH->query("select count(*) from products where product_category = 'cologne'");
														
					
					$per_row = 4;
					
					?>
					
					<!-- navigation bar -->
					<li class="active"><a href="#Haircare" data-toggle="tab">Hair Care</a></li>
					
					<li><a href="#Perfume" data-toggle="tab">Perfume</a></li>
					
					<li><a href="#Cologne" data-toggle="tab">Cologne</a><li>
					
					<li><a href="#Makeup" data-toggle="tab">Makeup</a></li>					
								
				</ul><!-- end of navigation bar -->
				
					
				<div class="tab-content" >
				
				<!-- Hair Care tab -->
					<div class="tab-pane active" id="Haircare"> 
					
						<table class = "table table-product">
						<?php
							$haircare_sql->setFetchMode(PDO::FETCH_ASSOC);
							
							$i = 0;
							$count1 = $haircare_count_sql->fetch();							
							echo "<br/>\n";
							
							while($row = $haircare_sql->fetch()) {	
								
								echo '<td>';
								
								// If the item is added in inventory within last 7 days 
								if (strtotime($row['date_added']) > strtotime('-7 days')) {
									echo displayNewProductIcon();
								}	
								
								echo displayProducts($row['id'], $row['image_location'], $row['name']);
								echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
																
								echo "<br/><br/>\n";											
								echo '</td>';

								// display items in 4 columns
								if (++$i % $per_row == 0 && $i >0 && $i < $count1) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div> <!-- end of Hair Care products-->
					
					<!-- Perfume Tab -->
					<div class="tab-pane" id="Perfume">
						<table class="table table-product">
						
						<?php
							$perfume_sql->setFetchMode(PDO::FETCH_ASSOC);
							$j = 0;
							$count2 = $perfume_count_sql->fetch();

							echo "<br/>\n";
							while($row = $perfume_sql->fetch()) {
								
								echo '<td>';
								
								// If the item is added in inventory within last 7 days 
								if (strtotime($row['date_added']) > strtotime('-7 days')) {
									echo displayNewProductIcon();
								}	
								
								echo displayProducts($row['id'], $row['image_location'], $row['name']);
								echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
																
								echo "<br/><br/>\n";											
								echo '</td>';
								
								// display items in 4 columns
								if (++$j % $per_row == 0 && $j >0 && $j < $count2) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div><!-- end of perfume tab-->
					
					
					<!--Cologne tab-->
					<div class="tab-pane" id="Cologne">
						<table class="table table-product">
						
						<?php
							$cologne_sql->setFetchMode(PDO::FETCH_ASSOC);
							$k = 0;
							$count3 = $cologne_count_sql->fetch();

							echo "<br/>\n";
							while($row = $cologne_sql->fetch()) {
								
								echo '<td>';
								
								// If the item is added in inventory within last 7 days 
								if (strtotime($row['date_added']) > strtotime('-7 days')) {
									echo displayNewProductIcon();
								}	
																
								echo displayProducts($row['id'], $row['image_location'], $row['name']);
								echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
								
								echo "<br/><br/>\n";											
								echo '</td>';

								// display items in 4 columns
								if (++$k % $per_row == 0 && $k >0 && $k < $count3) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div> <!-- end of cologne tab-->
					
					<!-- Make up tab-->
					<div class="tab-pane" id="Makeup">
						<table class="table table-product">
						
						<?php
							$makeup_sql->setFetchMode(PDO::FETCH_ASSOC);
							$l = 0;
							$count4 = $makeup_count_sql->fetch();

							echo "<br/>\n";
							while($row = $makeup_sql->fetch()) {
								
								echo '<td>';
								
								// If the item is added in inventory within last 7 days 
								if (strtotime($row['date_added']) > strtotime('-7 days')) {
									echo displayNewProductIcon();
								}	
								
								echo displayProducts($row['id'], $row['image_location'], $row['name']);
								echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
																
								echo "<br/><br/>\n";											
								echo '</td>';
								
								// display items in 4 columns
								if (++$l % $per_row == 0 && $l >0 && $l < $count4) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div><!-- end of Make up tab-->
									
				</div><!-- end of tab-content-->
				
			</div><!-- end of tab-table-->
		</div><!-- end of column and column offset-->
	</div> <!-- end of row-->
</div> <!-- end of container-fluid-->

<br/><br/><br/><br/>

<?php
include "footer.php";
?>