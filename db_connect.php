<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="advanced_systems_project"; // Database name 

    # connect to the database  
    try {  
  # MySQL with PDO_MYSQL
  $DBH = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
  
  }
	catch(PDOException $e) {
    echo $e->getMessage();
}
?>