<?php
include "header.php";



$ACCT_MGR = AccountManager::getInstance();
?>
<div class="container-fluid">
	<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
			<h1>My Account</h1>
			<div class="col-sm-3 "><p><a href="./purchase_history.php?data=<?php echo $ACCT_MGR->getId(); ?>">View Purchase History</a></p></div>
			<table class="table">
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
			<br/><br/><br/><br/>

			<form method="POST" action="change_password.php">
				<input type="hidden" name="email" value="<?php echo $ACCT_MGR->getEmail(); ?>">
				<button class="btn btn-primary btn-sm" name="changePassword" type="submit">Change Password</button>
			</form>
			<br/>
			<form method="POST" action="edit_account.php">
				<input type="hidden" name="firstName" value="<?php echo $ACCT_MGR->getFirstName(); ?>">
				<input type="hidden" name="lastName" value="<?php echo $ACCT_MGR->getLastName(); ?>">
				<input type="hidden" name="email" value="<?php echo $ACCT_MGR->getEmail(); ?>">
				<input type="hidden" name="phone" value="<?php echo $ACCT_MGR->getPhone(); ?>">
				<button class="btn btn-primary btn-sm" name="editAccount" type="submit">Edit Account</button>
			</form>
			<br/>
				<form method="POST" action="close_account.php">
				<button class="btn btn-primary btn-sm" name="closeAccount" type="submit">Close Account</button>
			</form>
		</div>
	</div>
</div>
<?php
include "footer.php"
?>