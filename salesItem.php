
<?php
include "header.php";

	$men_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, pr.percentage, pr.expiration_date
								from products p
								left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
								where p.age_category = 'adult' and p.gender_category = 'male'");
								
	$men_count_sql = $DBH->query("select count(*) from products where gender_category = 'male'");

	
	$per_row = 4;
?>
<div class="container-fluid">
	<div class = "row">
		<div class ="text-center">
			<!--This is generic image area which has image of men's generic products-->	
			<img src = "img/img3.jpg" alt="Generic men's product" width= "850" height="150">
			</br></br>
		</div><!-- end of div for image -->
	</div>
	
	<div class = "row">
		<div class="col-sm-1 col-sm-offset-1">
			<br/><br/>
			<li class="active"><a href="#Pants" data-toggle="tab">Men</a></li>
			<li><a href="#Shirts" data-toggle="tab">Women</a></li>
			<li><a href="#Belts" data-toggle="tab">Children</a></li>
			<li><a href="#Watches" data-toggle="tab">Home</a></li>
			<li><a href="#Watches" data-toggle="tab">Beauty</a></li>
								
		
		
		</div>
		
		<div class="col-sm-8 col-sm-offset-1">
			<h4><strong><u>Men</u></strong></h4>
		<table class = "table table-product">
						<?php
						$men_sql->setFetchMode(PDO::FETCH_ASSOC);
						$i = 0;
						$count1 = $men_count_sql->fetch();							
						echo "<br/>\n";
								
						while($row = $men_sql->fetch()) {	
						
								# get the image and description of product in one cell
								#echo '<td><a href="./details.php?data=' . $row['id'] . '"><img src="' . $row['image_location'] . '"
								#			 class="img-thumbnailproduct"></a>';
								#echo "<br/><br/>\n";
								#echo '<a href="./details.php?data=' . $row['id'] . '">' . $row['name'] . '</a>';
								#echo "<br/>\n";
							$promotion = false;
							if(!isset($row['percentage']) )
							
							#if(!empty($row['percentage']))
							{
								echo '<td><a href="./details.php?data=' . $row['id'] . '"><img src="' . $row['image_location'] . '"
											 class="img-thumbnailproduct"></a>';
								echo "<br/><br/>\n";
								echo '<a href="./details.php?data=' . $row['id'] . '">' . $row['name'] . '</a>';
								echo "<br/>\n";
								
								$promotion = true;
								$promotional_price = ($row['price'] - ($row['price'] * $row['percentage']));
								$exp_date = strtotime($row['expiration_date']);
								echo '<font color = "gray">Reg. $'. $row['price'];	
								echo "</br>\n";
								echo '<font color = "red"><strong>Sale $' . number_format($promotional_price, 2) ;
								# get the image and description of product in one cell
								
							}
							
							if($promotion)
							{
									
									
								
								#echo '<font color = "gray">Reg. $'. $row['price'];	
								#echo "</br>\n";
								#echo '<font color = "red"><strong>Sale $' . number_format($promotional_price, 2) ;
							}
							
							echo "<br/><br/>\n";
							echo '</td>';

							# display pants in 3 columns
							if (++$i % $per_row == 0 && $i >0 && $i < $count1) {
							echo '<tr></tr>';
							}
						}
						
						?>                        
						</table>
		
		
		</div>
		
		
	</div>
</div>
	

<br/><br/><br/><br/>


<?php
include "footer.php"
?>
