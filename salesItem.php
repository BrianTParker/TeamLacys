<!--File name: Sales Item Page
	Description: This file is used to display all sales items for all product categories 
-->
	
	
 <!-- include header file and products file
  This is the section to formulate sql statement queries for each product categories and to count the sales items
  under each categories
 --> 

 <?php
include "header.php";
include_once "Products/products.php";

	$men_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, pr.percentage, pr.expiration_date
								from products p
								left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
								where p.age_category = 'adult' and p.gender_category = 'male'");
								
	

	$sale_men_count_sql = $DBH->query("select count(*) from products p left join promotions pr on pr.product_id = p.id where p.gender_category = 'male' and pr.percentage !=0");
	
	$women_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, pr.percentage, pr.expiration_date
								from products p
								left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
								where p.age_category = 'adult' and p.gender_category = 'women'");
								
	$sale_women_count_sql = $DBH->query("select count(*) from products p left join promotions pr on pr.product_id = p.id where p.gender_category = 'male' and pr.percentage !=0");
	
	$child_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, pr.percentage, pr.expiration_date
								from products p
								left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
								where p.age_category = 'child'");
								
	$sale_child_count_sql = $DBH->query("select count(*) from products p left join promotions pr on pr.product_id = p.id where p.age_category = 'child' and pr.percentage !=0");
	
	
	$per_row = 4;
?>
<!--This is the main div-->
<div class="container-fluid">
	<!--This first row is to display Sales Item Image banner image-->
	<div class = "row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class ="text-center">
				<!--Image banner-->	
					<img src = "img/bannerSale.jpg" alt="Generic men's product" width= "870" height="150">
					<a href = "top"></a>
					</br></br>
			</div><!-- end of div for image -->
		
			
			<!-- Only required for left/right tabs -->
			<div class="tabbable"> 
				
				<ul class="nav nav-tabs">
				<!-- navigation bar -->
					<li class="active"><a href="#Men" data-toggle="tab">Men</a></li>
					
					<li><a href="#Women" data-toggle="tab">Women</a></li>
					
					<li><a href="#Children" data-toggle="tab">Children</a></li>
					
					<li><a href="#Kitchen" data-toggle="tab">Kitchen & Dining</a></li>
					
					<li><a href="#HomeEssentials" data-toggle="tab">Home Essentials</a></li>
					
					<li><a href="#Beauty" data-toggle="tab">Beauty</a></li>
								
				</ul><!-- end of navigation bar -->
				
				
				<div class="tab-content" >
				
					<!-- Men tab -->
					<div class="tab-pane active" id="Men"> 
						<table class = "table table-product">
						<?php
							$men_sql->setFetchMode(PDO::FETCH_ASSOC);
							$i = 0;
							$count1 = $sale_men_count_sql->fetch();							
						
							echo "<br/>\n";
								
							while($row = $men_sql->fetch()) {	
								if(isset($row['percentage']) )
								{
									echo '<td>';
									echo displayProducts($row['id'], $row['image_location'], $row['name']);
									echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
									echo '</td>';								

									// display men's in 4 columns
									if (++$i % $per_row == 0 && $i >0 && $i < $count1) {
										echo '<tr></tr>';
								}
								}

							}
						?>
				
						</table>
						
					</div><!--end of div for men's sales item-->

					<!-- Women tab -->
					<div class="tab-pane active" id="Women"> 
						<table class = "table table-product">
						<?php
							$women_sql->setFetchMode(PDO::FETCH_ASSOC);
							$i = 0;
							$count2 = $sale_women_count_sql->fetch();							
						
							echo "<br/>\n";
								
							while($row = $women_sql->fetch()) {	
								if(isset($row['percentage']) )
								{
									echo '<td>';
									echo displayProducts($row['id'], $row['image_location'], $row['name']);
									echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
									echo '</td>';								

									// display women's in 4 columns
									if (++$i % $per_row == 0 && $i >0 && $i < $count2) {
										echo '<tr></tr>';
									}
								}

							}
						?> 
				
						</table>
						
					</div><!--end of div for women's sales item-->
			
			
					<!-- Children tab -->
					<div class="tab-pane active" id="Children"> 
						<table class = "table table-product">
						<?php
							$child_sql->setFetchMode(PDO::FETCH_ASSOC);
							$i = 0;
							$count3 = $sale_child_count_sql->fetch();							
						
							echo "<br/>\n";
								
							while($row = $child_sql->fetch()) {	
								if(isset($row['percentage']) )
								{
									echo '<td>';
									echo displayProducts($row['id'], $row['image_location'], $row['name']);
									echo displayPrice($row['price'], $row['percentage'], $row['expiration_date']);
									echo '</td>';								

									// display children's in 4 columns
									if (++$i % $per_row == 0 && $i >0 && $i < $count3) {
										echo '<tr></tr>';
									}
								}

							}
						?> 
				
						</table>

					</div><!--end of div for children's sales item-->
			
					<!-- Kitchen tab -->
					<div class="tab-pane active" id="Kitchen"> 
						<table class = "table table-product">
					
				
						</table>
					
					</div><!--end of div for kitchen's sales item-->
			
					<!-- Home tab -->
					<div class="tab-pane active" id="HomeEssentials"> 
						<table class = "table table-product">
					
				
						</table>
					
					</div><!--end of div for home's sales item-->
			
					<!-- Beauty tab -->
					<div class="tab-pane active" id="Beauty"> 
						<table class = "table table-product">
					
				
						</table>
					
					</div><!--end of div for kitchen's sales item-->
				</div>
			</div>
		</div><!--end of column div to display sales items-->
	</div><!--end of second main row-->
</div><!-- end of container-fluid-->
	

<br/><br/><br/><br/>


<?php
include "footer.php"
?>
