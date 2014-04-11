<?php
include "header.php";
include_once "Products/products.php";
?>

<div class="container-fluid">
	<div class="row">
	
	   <div class="col-sm-8 col-sm-offset-2">
	   
			<!--This is generic image area which has image of Beauty generic products-->	
			<div class ="text-center">	
				<img src = "img/bannerBeauty.jpg" alt="Generic Beauty product" width= "870" height="150">
				</br></br>
			</div><!-- end of div for image -->
			
			
			<!-- Only required for left/right tabs -->
			<div class="tabbable"> 
				
				<ul class="nav nav-tabs">
	
					<?php 
					
					//Formulate Queries
														
					
					$per_row = 4;
					
					?>
					
					<!-- navigation bar -->
					<li class="active"><a href="#Haircare" data-toggle="tab">Hair Care</a></li>
					
					<li><a href="#Perfume" data-toggle="tab">Perfume</a></li>
					
					<li><a href="#Makeup" data-toggle="tab">Makeup</a></li>					
								
				</ul><!-- end of navigation bar -->
				
					
				<div class="tab-content" >
				
					
				
				
				</div><!-- end of tab-content-->
				
			</div><!-- end of tab-table-->
		</div><!-- end of column and column offset-->
	</div> <!-- end of row-->
</div> <!-- end of container-fluid-->

<br/><br/><br/><br/>

<?php
include "footer.php";
?>