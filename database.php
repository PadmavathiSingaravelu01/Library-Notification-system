<?php
$hostName = "localhost";
$userName = "siva";
$password = "lib2023";
$databaseName = "mydb";
 $conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>