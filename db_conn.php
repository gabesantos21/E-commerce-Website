<?php
$server_name = "127.0.0.1:3306"; // put your Server 
$user_name = "root"; // username 
$password = ""; // enter password
$Db_name = ""; // database Name

$conn = mysqli_connect($server_name, $user_name, $password, $Db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>