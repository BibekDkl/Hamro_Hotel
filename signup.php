<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validate input
    if (empty($name) || empty($email) || empty($password)) {
        header("Location: login.php?error=All fields are required!");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password

    // Check if name or email already exists
    $checkQuery = "SELECT * FROM users WHERE name = ? OR email = ?";
    $stmt = $conn->prepare($checkQuery);

    if ($stmt === false) {
        header("Location: login.php?error=Database error: " . urlencode($conn->error));
        exit();
    }

    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: login.php?error=Name or Email already exists!");
        exit();
    } else {
        // Insert user into the database
        $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            header("Location: login.php?error=Database error: " . urlencode($conn->error));
            exit();
        }

        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            header("Location: login.php?success=Registration successful! Please login.");
            exit();
        } else {
            header("Location: login.php?error=Error: " . urlencode($stmt->error));
            exit();
        }
    }

    $stmt->close();
    $conn->close();
}
?>
