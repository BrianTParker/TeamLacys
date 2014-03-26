<?php
// RUN: http://localhost/TeamLacys/guestcheckout.php
?><?php
include "header.php";
?>
<div class="col-xs-6 col-sm-6 col-md-2 col-lg-4 col-sm-offset-3 col-md-offset-5 col-lg-offset-4">

	<h1>Guest Checkout</h1>
	
	<form id="guestUserForm" role="form">
	
		<div class="form-group ">
			<label for="guestFName">First Name</label>
			<input type="text" class="form-control" id="guestFName" placeholder="Enter First Name" required>
		</div>
		
		<div class="form-group">
			<label for="guestLName">Last Name</label>
			<input type="text" class="form-control" id="guestLName" placeholder="Enter Last Name" required>
		</div>
		
		<div class="form-group">
			<label for="guestEmail">Email</label>
			<input type="email" class="form-control" id="guestEmail" placeholder="Enter Email" required>
		</div>
		
		<div class="form-group">
			<label for="guestPhone">Phone Number</label>
			<input type="tel" class="form-control" id="guestPhone" placeholder="Enter Phone Number" required>
		</div>
		
		<button type="submit" class="btn btn-success">Continue Checkout</button>
		or
		<a href="./login.php">Login</a>/<a href="./newuser.php">Register</a>
		
	</form>
	
</div>
<?php
include "footer.php"
?>