<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        die("Email and password are required!");
    }

    // Update the query based on your actual table structure
    $sql = "SELECT email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing query: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            // Store user details in session
             $_SESSION['email'] = $row['email'];
             $_SESSION['password'] = $row['password'];

            echo "Login successful! Welcome, " . $_SESSION['user_name'];
            header("Location: index.php"); // Redirect to home page
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No account found with this email!";
    }

    $stmt->close();
    $conn->close();
}
?>
