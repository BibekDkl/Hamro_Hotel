<?php
session_start(); // Start session
include('connect.php'); // Include database connection

// Check if user is logged in
if (!isset($_SESSION['name'])) {
    echo "<script>
        alert('Please log in to place an order.');
        window.location.href = 'login.php';
    </script>";
    exit(); // Stop further execution
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name2']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Insert into orders table to create a new order
    $sql = "INSERT INTO orders (name, phone_number, email, address) 
            VALUES ('$name', '$phone_number', '$email', '$address')";

    if ($conn->query($sql) === TRUE) {
        // Get the last inserted order ID
        $order_id = $conn->insert_id;

        // Get the user's email from the session
        $user_email = $_SESSION['email'];

        // Insert cart items into order_items table
        foreach ($_SESSION['cart'] as $itemId => $item) {
            $food_name = mysqli_real_escape_string($conn, $item['name']);
            $quantity = mysqli_real_escape_string($conn, $item['quantity']);
            $price = mysqli_real_escape_string($conn, $item['price']);
            $total = $price * $quantity;

            // Insert into order_items table
            $sql_items = "INSERT INTO order_items (order_id, user_email, food_name, quantity, price, total) 
                          VALUES ('$order_id', '$user_email', '$food_name', '$quantity', '$price', '$total')";

            if (!$conn->query($sql_items)) {
                echo "<script>
                    alert('Error inserting cart items: " . $conn->error . "');
                    window.location.href = 'order.php';
                </script>";
                exit();
            }
        }

        // Clear the cart after the order is placed
        $_SESSION['cart'] = [];

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

// Close connection
$conn->close();
?>