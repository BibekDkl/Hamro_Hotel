<?php
include('connect.php');
session_start(); // ✅ Start session


if (!isset($_SESSION['name'])) {
    echo "<script>
        alert('Please log in to place an order.');
        window.location.href = 'login.php';
    </script>";
    exit(); // ✅ Stop further execution
}

// Capture form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Prepare SQL query
$sql = "INSERT INTO contact_messages (full_name, email, phone, subject, message) 
        VALUES ('$full_name', '$email', '$phone', '$subject', '$message')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Message Sent Successfully!'); window.location.href='index.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
