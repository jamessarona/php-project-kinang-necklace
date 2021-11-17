<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "kinang";
// Create connection
$link = mysqli_connect("$servername", "$username", "$password") or die(mysqli_error($link));
mysqli_select_db($link, "$databasename") or die(mysqli_error($link));
?>