<?php
include "header.php";



$ACCT_MGR = AccountManager::getInstance();
?>

<div class="container-fluid">
	<br/>
	<br/>
	<div class="panel panel-default">
		<div class="panel-heading text-center"><div class="row offset1 text-center">
				<div class="col-md-2">
				<a class="btn btn-primary btn-sm" href="./purchase_history.php?data=<?php 
								echo $ACCT_MGR->getId(); ?>">View Purchase History</a></div>
								<div class="col-md-2"><form method="POST" action="change_password.php">
				<input type="hidden" name="email" value="<?php echo $ACCT_MGR->getEmail(); ?>">
				<button class="btn btn-primary btn-sm" name="changePassword" type="submit">Change Password</button>
			</form></div>
			<div class="col-md-4"><h2>My Account</h2></div>
			<div class="col-md-2">
			<form method="POST" action="edit_account.php">
				<input type="hidden" name="firstName" value="<?php echo $ACCT_MGR->getFirstName(); ?>">
				<input type="hidden" name="lastName" value="<?php echo $ACCT_MGR->getLastName(); ?>">
				<input type="hidden" name="email" value="<?php echo $ACCT_MGR->getEmail(); ?>">
				<input type="hidden" name="phone" value="<?php echo $ACCT_MGR->getPhone(); ?>">
				<button class="btn btn-primary btn-sm" name="editAccount" type="submit">Edit Account</button>
			</form>
		</div>
			<div class="col-md-2">
			<form method="POST" action="close_account.php">
				<button class="btn btn-primary btn-sm" name="closeAccount" type="submit">Close Account</button>
			</form>
		</div>
			</div></div>
  

			
			
			<table class="table text-center">
				<tr>
					<td><h4>First Name:</h4></td>
					<td><h4>Last Name:</h4></td>
					<td><h4>Email:</h4></td>
					<td><h4>Phone:</h4></td>
				</tr>
				<tr>
					<td><?php echo $ACCT_MGR->getFirstName(); ?></td>
					<td><?php echo $ACCT_MGR->getLastName(); ?></td>
					<td><?php echo $ACCT_MGR->getEmail(); ?></td>
					<td><?php echo $ACCT_MGR->getPhone(); ?></td>
				</tr>
			</table>
			
			</div>
			<br/><br/><br/><br/>

			

			
			<br/>
			
			<br/>
				
		
	
</div>
<?php
include "footer.php"
?>