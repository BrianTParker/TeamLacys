<?php
include "header.php";



$ACCT_MGR = AccountManager::getInstance();
?>

<div class="row">
	
    <div class="col-sm-2 col-sm-offset-1">
		<a href="./purchase_history.php?data=<?php echo $ACCT_MGR->getId(); ?>">View Purchase History</a>
		<h1>Account</h1>
		
		<table class="table">
		<tr>
		<td>First Name:</td>
		<td><?php echo $ACCT_MGR->getFirstName(); ?></td>
		</tr>
		<tr>
		<td>Last Name:</td>
		<td><?php echo $ACCT_MGR->getLastName(); ?></td>
		</tr>
		<tr>
		<td>Email:</td>
		<td><?php echo $ACCT_MGR->getEmail(); ?></td>
		</tr>
		<tr>
		<td>Phone:</td>
		<td><?php echo $ACCT_MGR->getPhone(); ?></td>
		</tr>
		<tr>
		
		</table>
		
		<form method="POST" action="edit_account.php">
			<input type="hidden" name="firstName" value="<?php echo $ACCT_MGR->getFirstName(); ?>">
			<input type="hidden" name="lastName" value="<?php echo $ACCT_MGR->getLastName(); ?>">
			<input type="hidden" name="email" value="<?php echo $ACCT_MGR->getEmail(); ?>">
			<input type="hidden" name="phone" value="<?php echo $ACCT_MGR->getPhone(); ?>">
			<button class="btn btn-default" name="editAccount" type="submit">Edit Account</button>
		</form>
		<form method="POST" action="change_password.php">
			<input type="hidden" name="email" value="<?php echo $ACCT_MGR->getEmail(); ?>">
			<button class="btn btn-default" name="changePassword" type="submit">Change Password</button>
		</form>
		<form method="POST" action="close_account.php">
			
			<button class="btn btn-default" name="closeAccount" type="submit">Close Account</button>
		</form>
		
	</div>

</div>




<?php
include "footer.php"
?>