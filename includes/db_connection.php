<?php
$host = 'localhost';
$username = 'springle_admin';
$password = '786$karacHi';
$dbname = 'springle_craft';

// Establish a database connection
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>