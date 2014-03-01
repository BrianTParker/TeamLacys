<?php
include "header.php";
?>
<div class="row">
   <div class="col-sm-3 col-sm-offset-1">
        <form role="form" action="authenticate.php" method="POST">
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          
          <button type="submit" class="btn btn-default">Submit</button>
        </form>


   </div>
</div>

<?
include "footer.php";
?>