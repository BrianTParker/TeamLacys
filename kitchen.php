<?php
include "header.php";
include_once "Products/products.php";
?>

<div class="container-fluid">
	<div class="row">
	
	   <div class="col-sm-8 col-sm-offset-2">
	   
			<!--This is generic image area which has image of kitchen generic products-->	
			<div class ="text-center">	
				<img src = "img/bannerKitchen.jpg" alt="Generic Kitchen product" width= "870" height="150">
				</br></br>
			</div><!-- end of div for image -->
			
			
			<!-- Only required for left/right tabs -->
			<div class="tabbable"> 
				
				<ul class="nav nav-tabs">
	
					<?php 
					
					//Formulate Queries
					$bakeware_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.product_category = 'bakeware' 
									order by p.date_added desc");								
					$bakeware_count_sql = $DBH->query("select count(*) from products where product_category = 'bakeware'");
					
					$cookware_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.product_category = 'cookwear' 
									order by p.date_added desc");								
					$cookware_count_sql = $DBH->query("select count(*) from products where product_category = 'cookwear'");
					
					$dining_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.product_category = 'dining' 
									order by p.date_added desc");								
					$dining_count_sql = $DBH->query("select count(*) from products where product_category = 'dining'");
					
					$smallapp_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.product_category = 'smallappliances' 
									order by p.date_added desc");								
					$smallapp_count_sql = $DBH->query("select count(*) from products where product_category = 'smallappliances'");
														
					
					$per_row = 4;
					
					?>
					
					<!-- navigation bar -->
					<li class="active"><a href="#Bakeware" data-toggle="tab">Bakeware</a></li>
					
					<li><a href="#Cookware" data-toggle="tab">Cookware</a></li>
					
					<li><a href="#dining" data-toggle="tab">Dining</a></li>
					
					<li><a href="#SmallApp" data-toggle="tab">Small Appliances</a></li>
					
								
				</ul><!-- end of navigation bar -->
				
					
				<div class="tab-content" >
				
				<!-- Bakeware tab -->
					<div class="tab-pane active" id="Bakeware"> 
					
						<table class = "table table-product">
						<?php
							$bakeware_sql->setFetchMode(PDO::FETCH_ASSOC);
							
							$i = 0;
							$count1 = $bakeware_count_sql->fetch();							
							echo "<br/>\n";
							
							while($row = $bakeware_sql->fetch()) {	
								
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
					</div> <!-- end of Bakeware products-->
					
					<!-- Cookware Tab -->
					<div class="tab-pane" id="Cookware">
						<table class="table table-product">
						
						<?php
							$cookware_sql->setFetchMode(PDO::FETCH_ASSOC);
							$j = 0;
							$count2 = $cookware_count_sql->fetch();

							echo "<br/>\n";
							while($row = $cookware_sql->fetch()) {
								
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
					</div><!-- end of Cookware tab-->
					
					
					<!--Small Appliances tab-->
					<div class="tab-pane" id="SmallApp">
						<table class="table table-product">
						
						<?php
							$smallapp_sql->setFetchMode(PDO::FETCH_ASSOC);
							$k = 0;
							$count3 = $smallapp_count_sql->fetch();

							echo "<br/>\n";
							while($row = $smallapp_sql->fetch()) {
								
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
					</div> <!-- end of Small Appliances tab-->
					
					<!-- dining tab-->
					<div class="tab-pane" id="dining">
						<table class="table table-product">
						
						<?php
							$dining_sql->setFetchMode(PDO::FETCH_ASSOC);
							$l = 0;
							$count4 = $dining_count_sql->fetch();

							echo "<br/>\n";
							while($row = $dining_sql->fetch()) {
								
								echo '<td>';
								
								// If the item is added in inventory within last 7 days 
								if (strtotime($row['date_added']) > strtotime('-7 days')) {
									echo displayNewProductIcon();
								}	
								
								echo displayProducts($row['id'], $row['image_location'], $row['name']);
								echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
																
								echo "<br/><br/>\n";											
								echo '</td>';
								
								// display i in 4 columns
								if (++$l % $per_row == 0 && $l >0 && $l < $count4) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div><!-- end of dining tab-->
		
				</div><!-- end of tab-content-->
				
			</div><!-- end of tab-table-->
		</div><!-- end of column and column offset-->
	</div> <!-- end of row-->
</div> <!-- end of container-fluid-->

<br/><br/><br/><br/>

<?php
include "footer.php";
?>