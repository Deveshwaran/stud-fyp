<?php
$dsn = 'mysql:host=localhost;dbname=studfyp';
$username = 'root';
$password = '';
$options = [];
try {
$connection = new PDO($dsn, $username, $password, $options);
  //echo "Database connection successfully\n";
} catch(PDOException $e) {

    die('Could not connect: ' . mysqli_connect_error());
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname= "studfyp";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>
