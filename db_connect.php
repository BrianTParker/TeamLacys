<?php
$host="localhost"; // Host name 
$username="nicholas_lacysUS"; // Mysql username 
$password="GTC_WEB"; // Mysql password 
$db_name="nicholas_lacys"; // Database name 

    # connect to the database  
    try {  
  # MySQL with PDO_MYSQL
  $DBH = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
  
  }
	catch(PDOException $e) {
    echo $e->getMessage();
}
?>