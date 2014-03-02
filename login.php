<?php
include "header.php";
?>
<div class="row">
   <div class="col-sm-3 col-sm-offset-1">
        <form role="form" action="login.php" method="POST">
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

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    checkLogin();
}

function checkLogin(){
    global $DBH;
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    
    $STH = $DBH->query("select * from customers where email = '" . $email . "' and password = '" . $password . "'");
    if($STH->rowCount() == 1){
    $sql = $DBH->query("SELECT id, first_name, last_name from customers where email = '" . $email . "' and password = '" . $password . "'"); 			
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $row = $sql->fetch();
    $id = $row['id'];
    $firstName = $row['first_name'];
    $lastName = $row['last_name'];
    $email = $_POST['email'];
    
    $_SESSION["firstName"] = $firstName;
    $_SESSION["lastName"] = $lastName;
    $_SESSION["email"] = $email;
    $_SESSION["id"] = $id; 
    $_SESSION["cart"] = array();

    header("location: index.php");
    }
    else {
        echo "Wrong email and password";

    }
}
include "footer.php";
?>