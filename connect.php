<?php
$servername = "localhost"; // Your local server
$username = "root"; // Default MySQL username
$password = ""; // Leave empty (if no password)
$database = "foodie_fly"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}  else {
    echo "Connected successfully!";
}


?>