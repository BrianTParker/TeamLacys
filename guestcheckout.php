<?php
// RUN: http://localhost/TeamLacys/guestcheckout.php
?><?php
include "header.php";
?>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-2 col-lg-4 col-sm-offset-3 col-md-offset-5 col-lg-offset-4">

		<h1>Guest Checkout</h1>
		
		<form id="guestUserForm" role="form">
		
			<div class="form-group ">
				<label for="guestFName">First Name</label>
				<input type="text" maxlength="30" class="form-control" pattern="^[a-zA-Z]+$" oninvalid="setCustomValidity('Please enter only letters')" id="guestFName" name="fName" placeholder="Enter First Name" required>
			</div>
			
			<div class="form-group">
				<label for="guestLName">Last Name</label>
				<input type="text" maxlength="30" class="form-control" pattern="^[a-zA-Z]+$" oninvalid="setCustomValidity('Please enter only letters')" id="guestLName" name="lName" placeholder="Enter Last Name" required>
			</div>
			
			<div class="form-group">
				<label for="guestEmail">Email</label>
				<input type="email" class="form-control" id="guestEmail" name="email" placeholder="Enter Email" required>
			</div>
			
			<div class="form-group">
				<label for="guestPhone">Phone Number</label>
				<input type="tel" class="form-control" pattern="^[2-9]\d{2}-\d{3}-\d{4}$" id="guestPhone" name="phone" placeholder="XXX-XXX-XXXX">
			</div>
			
			<button type="submit" class="btn btn-success">Continue Checkout</button>
			or
			<a href="./login.php">Login</a>/<a href="./newuser.php">Register</a>
			
			<input type="hidden" name="alvl" 	value="3"/>
			<input type="hidden" name="active" 	value="0"/>
		</form>
		
	</div>
</div>
	</br></br></br></br></br></br>
<?php
include "footer.php"
?>