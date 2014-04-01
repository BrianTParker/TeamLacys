
<?php
include "header.php";
?>
<div class="container-fluid">
	<div class="row">
	   <div class="col-sm-8 col-sm-offset-2">
	   
			<!--<div class ="text-center">
				<!--This is generic image area which has image of women's generic products-->	
			<!--<img src = "img/women.jpg" alt="Generic women's product" width= "850" height="150">
				</br></br>
			</div><!-- end of div for image -->
			
			<div class="tabbable"> <!-- Only required for left/right tabs -->
				<ul class="nav nav-tabs">
	
					<?php 
					$pants_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.age_category = 'adult' and p.gender_category = 'female' and p.article_category = 'pants'");								
					$pants_count_sql = $DBH->query("select count(*) from products where article_category = 'pants'");

					$shirts_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.age_category = 'adult' and p.gender_category = 'female' and p.article_category = 'shirts'");	
					$shirts_count_sql = $DBH->query("select count(*) from products where article_category = 'shirts'");

					$skirts_sql = $DBH->query("select p.id, p.name, p.description, p.image_location, p.price, pr.percentage,pr.expiration_date
									from products p
									left join promotions pr on pr.product_id = p.id and pr.expiration_date >= CURDATE()	
									where p.age_category = 'adult' and p.gender_category = 'female' and p.article_category = 'skirts'");
					$skirts_count_sql = $DBH->query("select count(*) from products where article_category = 'skirts'");

					$per_row = 4;
					?>
					<!-- navigation bar -->
					<li class="active"><a href="#Pants" data-toggle="tab">Pants</a></li>
					
					<li><a href="#Shirts" data-toggle="tab">Shirts</a></li>
					
					<li><a href="#Skirts" data-toggle="tab">Skirts</a></li>
								
				</ul><!-- end of navigation bar -->
					
				<div class="tab-content" >
					<div class="tab-pane active" id="Pants"> <!-- pants tab -->
					
						<table class = "table table-product">
						<?php
						$pants_sql->setFetchMode(PDO::FETCH_ASSOC);
						$i = 0;
						$count1 = $pants_count_sql->fetch();							
						echo "<br/>\n";

						while($row = $pants_sql->fetch()) {	
							$promotion = false;
							# get the image and description of product in one cell
							echo '<td><a href="./details.php?data=' . $row['id'] . '"><img src="' . $row['image_location'] . '"
											 class="img-thumbnailproduct"></a>';
							echo "<br/><br/>\n";
							echo '<a href="./details.php?data=' . $row['id'] . '">' . $row['name'] . '</a>';
							echo "<br/>\n";		

							if(isset($row['percentage']) )
							{
								$promotion = true;
								$promotional_price = ($row['price'] - ($row['price'] * $row['percentage']));
								$exp_date = strtotime($row['expiration_date']);
							}
							if($promotion)
							{
								echo '<font color = "gray">Reg. $'. $row['price'];	
								echo "</br>\n";
								echo '<font color = "red"><strong>Sale $' . number_format($promotional_price, 2) ;
							}
							else
							{
								echo '<strong>$'. $row['price'];	
							}
							echo "<br/><br/>\n";
							echo '</td>';

							# display pants in 4 columns
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
							$promotion = false;
							# get the image and description of product in one cell
							echo '<td><a href="./details.php?data=' . $row['id'] . '"><img src="' . $row['image_location'] . '"
											 class="img-thumbnailproduct"></a>';
							echo "<br/><br/>\n";
							echo '<a href="./details.php?data=' . $row['id'] . '">' . $row['name'] . '</a>';
							echo "<br/>\n";

							if(isset($row['percentage']) )
							{
								$promotion = true;
								$promotional_price = ($row['price'] - ($row['price'] * $row['percentage']));
								$exp_date = strtotime($row['expiration_date']);
							}
							if($promotion)
							{
								echo '<font color = "gray">Reg. $'. $row['price'];	
								echo "</br>\n";
								echo '<font color = "red"><strong>Sale $' . number_format($promotional_price, 2) ;
							}
							else
							{
								echo '<strong>$'. $row['price'];	
							}
							echo "<br/><br/>\n";
							echo '</td>';

							# display shirts in 4 columns
							if (++$j % $per_row == 0 && $j >0 && $j < $count2) {
							echo '<tr></tr>';
							}
						}
						?>                        
						</table>
					</div><!-- end of shirts tab-->
					
					<!-- Skirts tab-->
					<div class="tab-pane" id="Skirts">
						<table class="table table-product">
						<?php
						$skirts_sql->setFetchMode(PDO::FETCH_ASSOC);
						$k = 0;
						$count3 = $skirts_count_sql->fetch();

						echo "<br/>\n";
						while($row = $skirts_sql->fetch()) {

							$promotion = false;
							# get the image and description of product in one cell
							echo '<td><a href="./details.php?data=' . $row['id'] . '"><img src="' . $row['image_location'] . '"
												class="img-thumbnail"></a>';
							echo "<br/><br/>\n";
							echo '<a href="./details.php?data=' . $row['id'] . '">' . $row['name'] . '</a>';
							echo "<br/>\n";

							if(isset($row['percentage']) )
							{
								$promotion = true;
								$promotional_price = ($row['price'] - ($row['price'] * $row['percentage']));
								$exp_date = strtotime($row['expiration_date']);
							}
							if($promotion)
							{
								echo '<font color = "gray">Reg. $'. $row['price'];	
								echo "</br>\n";
								echo '<font color = "red"><strong>Sale $' . number_format($promotional_price, 2) ;
							}
							else
							{
								echo '<strong>$'. $row['price'];	
							}
							echo "<br/><br/>\n";
							echo '</td>';

							# display Skirts in 4 columns
							if (++$k % $per_row == 0 && $k >0 && $k < $count3) {
							echo '<tr></tr>';
							}
						}
						?>                        
						</table>
					</div> <!-- end of Skirts tab-->
					
				</div><!-- end of tab-content-->
				
			</div><!-- end of tab-table-->
		</div><!-- end of column and column offset-->
	</div> <!-- end of row-->
</div> <!-- end of container-fluid-->
<br/><br/><br/><br/>


<?php
include "footer.php"
?>
