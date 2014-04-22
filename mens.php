<?php
	include "header.php";
	include_once "Products/products.php";
?>

<div class="container-fluid">
	<div class="row">
	
	   <div class="col-sm-8 col-sm-offset-2">
	   
			<!--This is generic image area which has image of men's generic products-->	
			<div class ="text-center">	
				<img src = "img/bannerMen.jpg" alt="Generic men's product" width= "100%" height="150">
				</br></br>
			</div><!-- end of div for image -->
			
			
			<!-- Only required for left/right tabs -->
			<div class="tabbable"> 
				
				<ul class="nav nav-tabs">
	
					<?php 
					
					//Formulate Queries
					$pants_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.age_category = 'adult' and p.gender_category = 'male' and p.article_category = 'pants'
									order by p.date_added desc");								
					$pants_count_sql = $DBH->query("select count(*) from products where article_category = 'pants'");

					$shirts_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.age_category = 'adult' and p.gender_category = 'male' and p.article_category = 'shirts'
									order by p.date_added desc");	
					$shirts_count_sql = $DBH->query("select count(*) from products where article_category = 'shirts'");
					
					$suits_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.age_category = 'adult' and p.gender_category = 'male' and p.article_category = 'suits'
									order by p.date_added desc");	
					$suits_count_sql = $DBH->query("select count(*) from products where article_category = 'suits'");

					$belts_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.age_category = 'adult' and p.gender_category = 'male' and p.article_category = 'belts'
									order by p.date_added desc");
					$belts_count_sql = $DBH->query("select count(*) from products where article_category = 'belts'");

					$watches_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.age_category = 'adult' and p.gender_category = 'male' and p.article_category = 'watches'
									order by p.date_added desc");

					$watches_count_sql = $DBH->query("select count(*) from products where article_category = 'watches'");
					
					$activewear_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.age_category = 'adult' and p.gender_category = 'male' and p.article_category = 'active wear'
									order by p.date_added desc");
					$activewear_count_sql = $DBH->query("select count(*) from products where article_category = 'active wear'");
					
					$shoes_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
							from products p
							left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
							where p.age_category = 'adult' and p.gender_category = 'male' and p.article_category = 'shoes'
							order by p.date_added desc");
					$shoes_count_sql = $DBH->query("select count(*) from products where article_category = 'shoes'");					
					
					
					$per_row = 4;
					
					?>
					
					<!-- navigation bar -->
					<li class="active"><a href="#Pants" data-toggle="tab">Pants</a></li>
					
					<li><a href="#Shirts" data-toggle="tab">Shirts</a></li>
					
					<li><a href="#Suits" data-toggle="tab">Suits</a></li>
					
					<li><a href="#Belts" data-toggle="tab">Belts</a></li>
					
					<li><a href="#Watches" data-toggle="tab">Watches</a></li>
					
					<li><a href="#ActiveWear" data-toggle="tab">Active Wear</a></li>
					
					<li><a href="#Shoes" data-toggle="tab">Shoes</a></li>
								
				</ul><!-- end of navigation bar -->
				
					
				<div class="tab-content" >
				
					<!-- pants tab -->
					<div class="tab-pane active" id="Pants"> 
					
						<table class = "table table-product">
						<?php
							$pants_sql->setFetchMode(PDO::FETCH_ASSOC);
							
							$i = 0;
							$count1 = $pants_count_sql->fetch();							
							echo "<br/>\n";
							
							while($row = $pants_sql->fetch()) {	
								
								echo '<td>';
								
								// If the item is added in inventory within last 7 days 
								if (strtotime($row['date_added']) > strtotime('-7 days')) {
									echo displayNewProductIcon();
								}	
								
								echo displayProducts($row['id'], $row['image_location'], $row['name']);
								echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
																
								echo "<br/><br/>\n";											
								echo '</td>';

								// display pants in 4 columns
								if (++$i % $per_row == 0 && $i >0 && $i < $count1) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div> <!--end of pants tab-->
					
					
					<!-- shirts tab-->
					<div class="tab-pane" id="Shirts">
						<table class="table table-product">
						
						<?php
							$shirts_sql->setFetchMode(PDO::FETCH_ASSOC);
							$j = 0;
							$count2 = $shirts_count_sql->fetch();

							echo "<br/>\n";
							while($row = $shirts_sql->fetch()) {
								
								echo '<td>';
								
								// If the item is added in inventory within last 7 days 
								if (strtotime($row['date_added']) > strtotime('-7 days')) {
									echo displayNewProductIcon();
								}	
								
								echo displayProducts($row['id'], $row['image_location'], $row['name']);
								echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
																
								echo "<br/><br/>\n";											
								echo '</td>';
								
								// display shirts in 4 columns
								if (++$j % $per_row == 0 && $j >0 && $j < $count2) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div><!-- end of shirts tab-->
					
					<!-- suits tab-->
					<div class="tab-pane" id="Suits">
						<table class="table table-product">
						
						<?php
							$suits_sql->setFetchMode(PDO::FETCH_ASSOC);
							$j = 0;
							$count2 = $suits_count_sql->fetch();

							echo "<br/>\n";
							while($row = $suits_sql->fetch()) {
								
								echo '<td>';
								
								// If the item is added in inventory within last 7 days 
								if (strtotime($row['date_added']) > strtotime('-7 days')) {
									echo displayNewProductIcon();
								}	
								
								echo displayProducts($row['id'], $row['image_location'], $row['name']);
								echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
																
								echo "<br/><br/>\n";											
								echo '</td>';
								
								// display suits in 4 columns
								if (++$j % $per_row == 0 && $j >0 && $j < $count2) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div><!-- end of suites tab-->
					
					
					<!-- Belts tab-->
					<div class="tab-pane" id="Belts">
						<table class="table table-product">
						
						<?php
							$belts_sql->setFetchMode(PDO::FETCH_ASSOC);
							$k = 0;
							$count3 = $belts_count_sql->fetch();

							echo "<br/>\n";
							while($row = $belts_sql->fetch()) {
								
								echo '<td>';
								
								// If the item is added in inventory within last 7 days 
								if (strtotime($row['date_added']) > strtotime('-7 days')) {
									echo displayNewProductIcon();
								}	
								
								echo displayProducts($row['id'], $row['image_location'], $row['name']);
								echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
																
								echo "<br/><br/>\n";											
								echo '</td>';

								// display belts in 4 columns
								if (++$k % $per_row == 0 && $k >0 && $k < $count3) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div> <!-- end of belts tab-->
					
					
					<!-- Watches tab-->
					<div class="tab-pane " id="Watches">
						<table class="table table-product">
						
						<?php
							$watches_sql->setFetchMode(PDO::FETCH_ASSOC);
							$l = 0;
							$count4 = $watches_count_sql->fetch();

							echo "<br/>\n";
							while($row = $watches_sql->fetch()) {
							
								echo '<td>';
								
								// If the item is added in inventory within last 7 days 
								if (strtotime($row['date_added']) > strtotime('-7 days')) {
									echo displayNewProductIcon();
								}
								
								echo displayProducts($row['id'], $row['image_location'], $row['name']);
								echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
																
								echo "<br/><br/>\n";											
								echo '</td>';

								// display watches in 4 columns
								if (++$l % $per_row == 0 && $l >0 && $l < $count4) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div> <!-- end of watches tab-->
					
					<!-- Active wear tab-->
					<div class="tab-pane" id="ActiveWear">
						<table class="table table-product">
						
						<?php
							$activewear_sql->setFetchMode(PDO::FETCH_ASSOC);
							$n = 0;
							$count6 = $activewear_count_sql->fetch();

							echo "<br/>\n";
							while($row = $activewear_sql->fetch()) {
								
								echo '<td>';
								
								// If the item is added in inventory within last 7 days 
								if (strtotime($row['date_added']) > strtotime('-7 days')) {
									echo displayNewProductIcon();
								}	
								
								echo displayProducts($row['id'], $row['image_location'], $row['name']);
								echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
																
								echo "<br/><br/>\n";											
								echo '</td>';
								
								// display active wear in 4 columns
								if (++$n % $per_row == 0 && $n >0 && $n < $count6) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div><!-- end of Active wear tab-->
					
					<!-- Shoes tab-->
					<div class="tab-pane" id="Shoes">
						<table class="table table-product">
						
						<?php
							$shoes_sql->setFetchMode(PDO::FETCH_ASSOC);
							$m = 0;
							$count5 = $shoes_count_sql->fetch();

							echo "<br/>\n";
							while($row = $shoes_sql->fetch()) {
								
								echo '<td>';
								
								// If the item is added in inventory within last 7 days 
								if (strtotime($row['date_added']) > strtotime('-7 days')) {
									echo displayNewProductIcon();
								}	
								
								echo displayProducts($row['id'], $row['image_location'], $row['name']);
								echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
																
								echo "<br/><br/>\n";											
								echo '</td>';
								
								// display shoes in 4 columns
								if (++$m % $per_row == 0 && $m >0 && $m < $count5) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div><!-- end of shoes tab-->
					
				</div><!-- end of tab-content-->
				
			</div><!-- end of tab-table-->
		</div><!-- end of column and column offset-->
	</div> <!-- end of row-->
</div> <!-- end of container-fluid-->

<br/><br/><br/><br/>

<?php
	include "footer.php"
?>