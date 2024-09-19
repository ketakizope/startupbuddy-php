<?php
date_default_timezone_set('Asia/Kolkata'); // Set timezone

$servername = "localhost:3306"; // or "localhost"
$username = "root";
$password = "";
$dbname = "student"; // Ensure this matches the actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo("Connection failed: " . $conn->connect_error);
}
?>
