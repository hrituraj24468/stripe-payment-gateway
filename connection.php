<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$db="stripenew";

$con = mysqli_connect($servername, $username, $password,$db);

if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

?>