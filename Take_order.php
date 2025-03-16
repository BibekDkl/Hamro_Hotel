<?php
include 'connect.php';
// Collect form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone_number = $_POST['phone-number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    
    // Assuming food items and price are static for now, you can modify as per your dynamic cart
    $food_items = "Pizza, Sandwich, Burger"; // Static example; ideally it would come from the cart
    $total_price = 24.00; // Static example; ideally it would come from the cart

    // Insert the data into the orders table
    $sql = "INSERT INTO orders (name, phone_number, email, address, food_items, total_price) 
            VALUES ('$name', '$phone_number', '$email', '$address', '$food_items', '$total_price')";

    if ($conn->query($sql) === TRUE) {
        echo "Order placed successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
