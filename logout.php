<?php
include "header.php";


unset($_SESSION);
session_destroy();
header("location:" . $_SERVER['HTTP_REFERER']);
include "footer.php"
?>

