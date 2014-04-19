<?php
include "header.php";

?>

<?php 
					
//Formulate Queries
							
$sales_by_product_sql = $DBH->query("select * from
							(select p.name, sum(pd.quantity) as number_sold, sum(pd.amount) as total_amount
							from purchase_summary ps
							join purchase_details pd on pd.purchase_summary_id = ps.id
							join products p on p.id = pd.product_id
							join customers c on c.id = pd.customer_id
							group by p.name
							) a
							order by a.number_sold desc");
							
$sales_by_customer_sql = $DBH->query("select * from
										(select c.first_name, c.last_name,c.email,sum(pd.amount) as total_amount
										from purchase_summary ps
										join purchase_details pd on pd.purchase_summary_id = ps.id
										join products p on p.id = pd.product_id
										join customers c on c.id = pd.customer_id
										group by c.first_name, c.last_name, c.email
										) a
										order by a.total_amount desc");
										
$total_sales_sql = $DBH->query("select c.first_name, c.last_name,c.email, ps.purchase_date, ps.grand_total, ps.confirmation_code
								from purchase_summary ps
								join purchase_details pd on pd.purchase_summary_id = ps.id
								join products p on p.id = pd.product_id
								join customers c on c.id = pd.customer_id
								where ps.grand_total > 0
								order by ps.purchase_date desc");
?>

<div class="container-fluid">
	<div class="row">
	
	   <div class="col-sm-8 col-sm-offset-2">
		<div class="tabbable boxed parentTabs"> 
				
				<ul class="nav nav-tabs">
	
					
					<!-- navigation bar -->
					<li class="active"><a href="#SalesData" data-toggle="tab">Sales Data</a></li>
					
					<li><a href="#Feedback" data-toggle="tab">Customer Feedback</a></li>
					
					
								
				</ul><!-- end of navigation bar -->
				
					
				<div class="tab-content" >
				
					<!------------------------------------------------------------------------------------------------------------------>
					<!----------------------------------------------- Sales Data Tab --------------------------------------------------------->
				
					<div class = "tab-pane fade active in" id = "SalesData">
					
					<div class = "tabbable">
					<!-- Sales tab -->
					
					</br>
						
							
							<ul class = "nav nav-tabs">
												
								<li class="active"><a href="#SalesByProduct" data-toggle="tab">Sales By Product</a></li>
								<li><a href="#SalesByCustomer" data-toggle="tab">Sales By Customer</a></li>
								<li><a href="#AllSales" data-toggle="tab">All Sales</a></li>
							</ul> <!-- end of navigation bar for Sales Data-->	
									
									<div class="tab-content" >
							
										<!-- Sales By Product tab -->
										<div class="tab-pane active" id="SalesByProduct"> 
								
							
											<table class="table table-admin">
												<head>
													<th>Product Name</th>
													<th>Total Quantity Sold</th>
													<th>Total Dollar Amount</th>
													
												</head>
												<?php
												$sales_by_product_sql->setFetchMode(PDO::FETCH_ASSOC);
										
										
												while($row = $sales_by_product_sql->fetch()){
													echo '<tr>' . "\n";
													echo '<td>' . $row['name'] . '</td>' . "\n";
													echo '<td>' . $row['number_sold'] . '</td>' . "\n";
													echo '<td>$' . $row['total_amount'] . '</td>' . "\n";
													echo '</tr>' . "\n";
												}
												?>
											
											
											</table>
										</div>
										
										<div class="tab-pane" id="SalesByCustomer">
											
											<table class="table table-admin">
												<head>
													<th>Customer Name</th>
													<th>Email</th>
													<th>Total Dollar Amount</th>
													
												</head>
											<?php
											$sales_by_customer_sql->setFetchMode(PDO::FETCH_ASSOC);
										
										
												while($row = $sales_by_customer_sql->fetch()){
													echo '<tr>' . "\n";
													echo '<td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>' . "\n";
													echo '<td>' . $row['email'] . '</td>' . "\n";
													echo '<td>$' . $row['total_amount'] . '</td>' . "\n";
													echo '</tr>' . "\n";
												}
											?>
											
											</table>
										
										</div>
										
										<div class="tab-pane" id="AllSales">
											
											<table class="table table-admin">
												<head>
													<th>Customer Name</th>
													<th>Email</th>
													<th>Purchase Date</th>
													<th>Sale Total</th>
													<th>Confirmation Code</th>
													
												</head>
											<?php
											$total_sales_sql->setFetchMode(PDO::FETCH_ASSOC);
										
										
												while($row = $total_sales_sql->fetch()){
													echo '<tr>' . "\n";
													echo '<td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>' . "\n";
													echo '<td>' . $row['email'] . '</td>' . "\n";
													echo '<td>' . $row['purchase_date'] . '</td>' . "\n";
													echo '<td>$' . $row['grand_total'] . '</td>' . "\n";
													echo '<td>' . $row['confirmation_code'] . '</td>' . "\n";
													echo '</tr>' . "\n";
												}
											?>
											
											</table>
										
										</div>
									</div> <!--tab-content-->
						</div>
					</div> <!--end of sales tab-->
					
					<!-- Feedback tab -->
					<div class = "tab-pane fade" id="Feedback"> 
					
						
					</div> <!--end of Feedback tab-->
					
				</div> <!--end of sales data tab-->
					
					
					
					
					
				
					
				
					
					
		</div><!-- end of tab-content-->
				
		</div><!-- end of tab-table-->
		
	   </div>
</div>






<?php
	include "footer.php"
?>