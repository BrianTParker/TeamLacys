<?php
include "header.php";
include_once "Products/products.php";
?>

<div class="container-fluid">
	<div class="row">
	
	   <div class="col-sm-8 col-sm-offset-2">
	   
			<!--This is generic image area which has image of Home generic products-->	
			<div class ="text-center">	
				<img src = "img/bannerHome.jpg" alt="Generic Home product" width= "870" height="150">
				</br></br>
			</div><!-- end of div for image -->
			
			
			<!-- Only required for left/right tabs -->
			<div class="tabbable"> 
				
				<ul class="nav nav-tabs">
	
					<?php 
					
					//Formulate Queries
					$bedbath_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.product_category = 'bedBath' 
									order by p.date_added desc");								
					$bedbath_count_sql = $DBH->query("select count(*) from products where product_category = 'bedBath'");
					
					$comforters_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.product_category = 'comforters' 
									order by p.date_added desc");								
					$comforters_count_sql = $DBH->query("select count(*) from products where product_category = 'comforters'");
					
					$luggage_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, p.date_added, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.product_category = 'luggage' 
									order by p.date_added desc");								
					$luggage_count_sql = $DBH->query("select count(*) from products where product_category = 'luggage'");
														
					
					$per_row = 4;
					
					?>
					
					<!-- navigation bar -->
					<li class="active"><a href="#Bedbath" data-toggle="tab">Bed & Bath</a></li>
									
					<li><a href="#Comforters" data-toggle="tab">Comforter Set</a></li>
					
					<li><a href="#Luggage" data-toggle="tab">Luggage</a></li>
					
								
				</ul><!-- end of navigation bar -->
				
					
				<div class="tab-content" >
				<!-- Hair Care tab -->
					<div class="tab-pane active" id="Bedbath"> 
					
						<table class = "table table-product">
						<?php
							$bedbath_sql->setFetchMode(PDO::FETCH_ASSOC);
							
							$i = 0;
							$count1 = $bedbath_count_sql->fetch();							
							echo "<br/>\n";
							
							while($row = $bedbath_sql->fetch()) {	
								
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
					
					<!-- comforter Tab -->
					<div class="tab-pane" id="Comforters">
						<table class="table table-product">
						
						<?php
							$comforters_sql->setFetchMode(PDO::FETCH_ASSOC);
							$j = 0;
							$count2 = $comforters_count_sql->fetch();

							echo "<br/>\n";
							while($row = $comforters_sql->fetch()) {
								
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
					</div><!-- end of comforter tab-->
					
					<!-- Luggage Tab -->
					<div class="tab-pane" id="Luggage">
						<table class="table table-product">
						
						<?php
							$luggage_sql->setFetchMode(PDO::FETCH_ASSOC);
							$k = 0;
							$count3 = $luggage_count_sql->fetch();

							echo "<br/>\n";
							while($row = $luggage_sql->fetch()) {
								
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
					</div><!-- end of luggage tab-->
								
				</div><!-- end of tab-content-->
				
			</div><!-- end of tab-table-->
		</div><!-- end of column and column offset-->
	</div> <!-- end of row-->
</div> <!-- end of container-fluid-->

<br/><br/><br/><br/>

<?php
include "footer.php";
?>