<?php
$host="web245.webfaction.com"; // Host name 
$username="teamlacys"; // Mysql username 
$password="lacys"; // Mysql password 
$db_name="advanced_systems_project"; // Database name 

    # connect to the database  
    try {  
  # MySQL with PDO_MYSQL
  $DBH = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
  $DBH->query("SET time_zone = 'US/Eastern'");
  }
	catch(PDOException $e) {
    echo $e->getMessage();
}
?>