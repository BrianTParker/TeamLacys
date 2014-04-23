<?php
include "header.php";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$userId = $_GET['data'];
}	

if(!isset($userId)){
	$userId = '';
}
	

				
?>



<div class="row">
	
    <div class="col-sm-8 col-sm-offset-2">
		<h1>Purchase History</h1>
		<table class="table">
		<head>
			<th>Confirmation Code</th>
			<th>Purchase Date</th>
			<th>Item</th>
			<th>Size</th>
            <th>Color</th>
			<th>Qty</th>
			<th>Purchase Amount</th>
			
        </head>
		<?php 
		$history_sql = $DBH->query("select ps.amount_total, ps.purchase_date, ps.confirmation_code, pd.amount, pd.quantity, pd.size, pd.color,p.name, p.image_location
				from purchase_summary ps 
				join purchase_details pd on pd.purchase_summary_id = ps.id
				join products p on p.id = pd.product_id
				join customers c on c.id = pd.customer_id
				where c.id = " . $userId . "
				order by pd.id desc");
		
		//$history_sql->setFetchMode(PDO::FETCH_ASSOC);
		while($row = $history_sql->fetch()){
			echo '<tr>' . "\n";
			//echo '<td><image src="' . $row['image_location'] . '" alt="' . $row['name'] . '"></td>' . "\n";
			echo '<td>' . $row['confirmation_code'] . '</td>' . "\n";
			echo '<td>' . $row['purchase_date'] . '</td>' . "\n";
			echo '<td>' . $row['name'] . '</td>' . "\n";
			echo '<td>' . $row['size'] . '</td>' . "\n";
            echo '<td>' . $row['color'] . '</td>' . "\n";
			echo '<td> x' . $row['quantity'] . '</td>' . "\n";
			echo '<td>$' . number_format($row['amount'], 2) . '</td>';
			
			echo '</tr>' . "\n";
		}
		
		?>
		</table>
	
	
	</div>

</div>




<?php
include "footer.php"
?>