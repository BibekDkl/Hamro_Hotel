<?php
// Database configuration
$servername = "localhost"; // Your local server
$username = "root"; // Default MySQL username
$password = ""; // Leave empty (if no password)
$database = "foodie_fly"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    // Log the error (for debugging)
    error_log("Connection failed: " . $conn->connect_error);
    // Display a user-friendly message
    die("An error occurred while connecting to the database. Please try again later.");
}

// Set character set to UTF-8 (optional but recommended)
$conn->set_charset("utf8mb4");

// Optional: Display success message (for debugging only)
// echo "Connected successfully!";
?>