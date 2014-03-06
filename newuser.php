<?php
include "header.php";




?>
<div class="row">
   <div class="col-sm-3 col-sm-offset-1">
        <form role="form" action="Account/validate_new_account.php" method="POST">
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter First Name">
          </div>
          <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Enter Last Name">
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
          </div>
          
          <div class="form-group">
            <label for="phone">Phone (optional)</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone">
          </div>
          
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          
          <div class="form-group">
            <label for="passwordCheck">Re-enter Password</label>
            <input type="password" class="form-control" id="passwordCheck" name="passwordCheck" placeholder="Password">
          </div>
          
          <button type="submit" class="btn btn-default">Create New Account</button>
        </form>


   </div>
</div>
<?php
include "footer.php";
?>