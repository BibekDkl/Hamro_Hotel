<?php
session_start(); // ✅ Start session
include('connect.php'); 

// Check if user is logged in
if (!isset($_SESSION['name'])) {
    echo "<script>
        alert('Please log in to place an order.');
        window.location.href = 'login.php';
    </script>";
    exit(); // ✅ Stop further execution
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name2']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // ✅ Insert into database (correct table columns)
    $sql = "INSERT INTO orders (name, phone_number, email, address) 
            VALUES ('$name', '$phone_number', '$email', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Order placed successfully!');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Error: " . $conn->error . "');
            window.location.href = 'order.php';
        </script>";
    }
}

// ✅ Close connection
$conn->close();
?>
