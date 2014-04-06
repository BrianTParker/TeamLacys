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
		<div class ="text-center">
			<!--Image banner-->	
			<img src = "img/img3.jpg" alt="Generic men's product" width= "850" height="150">
			<a href = "top"></a>
			</br></br>
		</div><!-- end of div for image -->
	</div>
	
	<!--This second row is to display the sales products-->
	<div class = "row">
		<!--This div is to list the products name navigation link-->
		<div class="col-sm-2 col-sm-offset-1">
			<br/><br/>
			<li><a href="#men" >Men</a></li>
			<li><a href="#women">Women</a></li>
			<li><a href="#child">Children</a></li>
			<li><a href="#kitchen">Kitchen & Dining</a></li>
			<li><a href="#home">Home Essential</a></li>
			<li><a href="#beauty">Beauty</a></li>
			
		
		</div><!--end of div for product list-->
		
		<!--This div is to display the sales products image-->
		<div class="col-sm-7 col-sm-offset-1">
			<!--The first row is to display all men's sales item-->
			<div class = "row">
				<h4 id = "men"><strong><u>Men</u></strong></h4>
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
				<p class="text-right"><h5><a href = '#top'>Back to top </a></h5></p>
			</div><!--end of div for men's sales item-->

			<!--The second row is to display all women's sales item-->
			<div class = "row">
				<h4 id = "women"><strong><u>Women</u></strong></h4>
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
				<p class="text-right"><h5><a href = '#top'>Back to top </a></h5></p>
			</div><!--end of div for women's sales item-->
			
			
			<!--The second row is to display all children's sales item-->
			<div class = "row">
				<h4 id = "child"><strong><u>Children</u></strong></h4>
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

								// display women's in 4 columns
								if (++$i % $per_row == 0 && $i >0 && $i < $count3) {
									echo '<tr></tr>';
								}
							}

						}
						?> 
				
				</table>
				<p class="text-right"><h5><a href = '#top'>Back to top </a></h5></p>
			</div><!--end of div for women's sales item-->
			
			<!--The second row is to display all child's sales item-->
			<div class = "row">
				<h4 id = "child"><strong><u>Kitchen & Dining</u></strong></h4>
				<table class = "table table-product">
					
				
				</table>
				<p class="text-right"><h5><a href = '#top'>Back to top </a></h5></p>
			</div><!--end of div for child's sales item-->
			
			<!--The second row is to display all home essential's sales item-->
			<div class = "row">
				<h4 id = "home"><strong><u>Home Essentials</u></strong></h4>
				<table class = "table table-product">
					
				</table>
				<p class="text-right"><h5><a href = '#top'>Back to top </a></h5></p>
			</div><!--end of div for child's home essentials item-->
			
			
			<!--The second row is to display all beauty's sales item-->
			<div class = "row">
				<h4 id = "beauty"><strong><u>Beauty</u></strong></h4>
				<table class = "table table-product">
					
				</table>
				<p class="text-right"><h5><a href = '#top'>Back to top </a></h5></p>
			</div><!--end of div for beauty essentials item-->
		</div><!--end of column div to display sales items-->
	
		
	</div><!--end of second main row-->>
</div><!-- end of container-fluid-->
	

<br/><br/><br/><br/>


<?php
include "footer.php"
?>
