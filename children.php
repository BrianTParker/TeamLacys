<!--File Name : children.php
	Description : Displays categories page for children's products. User can navigate
				  through tabs from navigation bar and user can review the products for men.
				  The default tab displays children's pants category.
--->



<!-- include header file and products file-->
<?php
	include "header.php";
	include_once "Products\products.php";
?>

<div class="container-fluid">
	<div class="row">
	
	   <div class="col-sm-8 col-sm-offset-2">
	   
			<!--This is generic image area which has image of men's generic products-->	
			<div class ="text-center">	
				<img src = "img/bannerChild.jpg" alt="Generic children's product" width= "870" height="150">
				</br></br>
			</div><!-- end of div for image -->
								
			<?php 
			
			//Formulate Queries for boys
			$boys_pants_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
							from products p
							left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
							where p.age_category = 'child' and p.gender_category = 'male' and p.article_category = 'pants'
							order by p.date_added desc");								
			$boys_pants_count_sql = $DBH->query("select count(*) from products where article_category = 'pants'");

			$boys_shirts_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
							from products p
							left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
							where p.age_category = 'child' and p.gender_category = 'male' and p.article_category = 'shirts'
							order by p.date_added desc");	
			$boys_shirts_count_sql = $DBH->query("select count(*) from products where article_category = 'shirts'");

			$boys_shoes_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
							from products p
							left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
							where p.age_category = 'child' and p.gender_category = 'male' and p.article_category = 'shoes'
							order by p.date_added desc");
			$boys_shoes_count_sql = $DBH->query("select count(*) from products where article_category = 'shoes'");
			
			//Formulate Queries for girls
			$girls_pants_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
							from products p
							left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
							where p.age_category = 'child' and p.gender_category = 'female' and p.article_category = 'pants'
							order by p.date_added desc");								
			$girls_pants_count_sql = $DBH->query("select count(*) from products where article_category = 'pants'");

			$girls_shirts_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
							from products p
							left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
							where p.age_category = 'child' and p.gender_category = 'female' and p.article_category = 'shirts'
							order by p.date_added desc");	
			$girls_shirts_count_sql = $DBH->query("select count(*) from products where article_category = 'shirts'");

			$girls_shoes_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
							from products p
							left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
							where p.age_category = 'child' and p.gender_category = 'female' and p.article_category = 'shoes'
							order by p.date_added desc");
			$girls_shoes_count_sql = $DBH->query("select count(*) from products where article_category = 'shoes'");
			
			$per_row = 4;
			
			?>
						
			<!-- Only required for left/right tabs -->
			<div class="tabbable"> 
			
				<ul class = "nav nav-tabs">
						
					<!-- navigation bar for boys -->
					<li class="active"><a href="#Boys" data-toggle="tab">Boys</a></li>
					<li><a href="#Girls" data-toggle="tab">Girls</a></li>
					<li><a href="#NewBorn" data-toggle="tab">New Born Shop</a></li>
					
				</ul>
									
				<ul class="nav nav-tabs">
				
					<!-- navigation bar for boys -->
					<li class="active" id = "Boys"><a href="#Boys_Pants" data-toggle="tab">Pants</a></li>
					
					<li><a href="#Boys_Shirts" data-toggle="tab">Shirts</a></li>
					
					<li><a href="#Boys_Shoes" data-toggle="tab">Shoes</a></li>
					
				</ul> <!-- end of navigation bar for boys-->
									
				<ul class="nav nav-tabs">
				
					<!-- navigation bar for girls -->
					<li id = "Girls"><a href="#Girls_Pants" data-toggle="tab">Pants</a></li>
					
					<li id = "Girls"><a href="#Girls_Shirts" data-toggle="tab">Shirts</a></li>
					
					<li id ="Girls"><a href="#Girls_Shoes" data-toggle="tab">Shoes</a></li>
					
				</ul> <!-- end of navigation bar for girls-->
			
											
				<div class="tab-content" >
				
				<!------------------------------------------------------------------------------------------------------------------>
				<!----------------------------------------------- Boys Tab --------------------------------------------------------->
				
					<!-- pants tab -->
					<div class="tab-pane active" id="Boys_Pants"> 
					
						<table class = "table table-product">
						<?php
							$boys_pants_sql->setFetchMode(PDO::FETCH_ASSOC);
							
							$i = 0;
							$count1 = $boys_pants_count_sql->fetch();							
							echo "<br/>\n";
							
							while($row = $boys_pants_sql->fetch()) {	
								
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
					<div class="tab-pane" id="Boys_Shirts">
						<table class="table table-product">
						
						<?php
							$boys_shirts_sql->setFetchMode(PDO::FETCH_ASSOC);
							$j = 0;
							$count2 = $boys_shirts_count_sql->fetch();

							echo "<br/>\n";
							while($row = $boys_shirts_sql->fetch()) {
								
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
					
					
					<!-- Shoes tab-->
					<div class="tab-pane" id="Boys_Shoes">
						<table class="table table-product">
						
						<?php
							$boys_shoes_sql->setFetchMode(PDO::FETCH_ASSOC);
							$k = 0;
							$count3 = $boys_shoes_count_sql->fetch();

							echo "<br/>\n";
							while($row = $boys_shoes_sql->fetch()) {
								
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
					</div> <!-- end of shoes tab-->
									
			<!------------------------------------------------------------------------------------------------------------------>
			<!----------------------------------------------- Girls Tab -------------------------------------------------------->
						
				
					<!-- pants tab -->
					<div class="tab-pane active" id="Girls_Pants"> 
					
						<table class = "table table-product">
						<?php
							$girls_pants_sql->setFetchMode(PDO::FETCH_ASSOC);
							
							$i1 = 0;
							$count11 = $girls_pants_count_sql->fetch();							
							echo "<br/>\n";
							
							while($row = $girls_pants_sql->fetch()) {	
								
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
								if (++$i1 % $per_row == 0 && $i1 >0 && $i1 < $count11) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div> <!--end of pants tab-->
									
					<!-- shirts tab-->
					<div class="tab-pane" id="Girls_Shirts">
						<table class="table table-product">
						
						<?php
							$girls_shirts_sql->setFetchMode(PDO::FETCH_ASSOC);
							$j1 = 0;
							$count21 = $girls_shirts_count_sql->fetch();

							echo "<br/>\n";
							while($row = $girls_shirts_sql->fetch()) {
								
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
								if (++$j1 % $per_row == 0 && $j1 >0 && $j1 < $count21) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div><!-- end of shirts tab-->
					
					
					<!-- Shoes tab-->
					<div class="tab-pane" id="Girls_Shoes">
						<table class="table table-product">
						
						<?php
							$girls_shoes_sql->setFetchMode(PDO::FETCH_ASSOC);
							$k1 = 0;
							$count31 = $girls_shoes_count_sql->fetch();

							echo "<br/>\n";
							while($row = $girls_shoes_sql->fetch()) {
								
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
								if (++$k1 % $per_row == 0 && $k1 >0 && $k1 < $count31) {
								echo '<tr></tr>';
								}
							}
						?>                        
						</table>
					</div> <!-- end of shoes tab-->
						
				</div><!-- end of tab-content-->
				
			</div><!-- end of tab-table-->
		</div><!-- end of column and column offset-->
	</div> <!-- end of row-->
</div> <!-- end of container-fluid-->

<br/><br/><br/><br/>

<!-- include footer file
<?php
	include "footer.php"
?>
<!-- end of mens.php file-->
