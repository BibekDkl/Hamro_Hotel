<?php
session_start();
include 'connect.php'; // Include database connection

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$errors = array(); // Array to store errors

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email2']) && isset($_POST['password2'])) {
    // Check if email and password are received
    if (empty($_POST['email2'])) {
        array_push($errors, "Email is required");
    }
    if (empty($_POST['password2'])) {
        array_push($errors, "Password is required");
    }
    
    if (count($errors) == 0) {
        // Get and sanitize user input
        $email = mysqli_real_escape_string($conn, $_POST['email2']);
        $password = mysqli_real_escape_string($conn, $_POST['password2']);

        // Prepare SQL query to check user existence
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        if ($stmt === false) {
            die("Database query failed: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Verify hashed password
            // Store email and name in session after successful login
if (password_verify($password, $user['password'])) {
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $user['name']; // Store the user's name in session
    $_SESSION['success'] = "You are now logged in";
    header("Location: index.php");
    exit();
}

            } else {
                array_push($errors, "Wrong email/password combination");
            }
        } else {
            array_push($errors, "User not found");
        }
        
        $stmt->close();
    }
    
    // Store errors in session and redirect back to login page
    if (count($errors) > 0) {
        $_SESSION['error'] = implode("<br>", $errors);
        header("Location: login.php");
        exit();
    }


$conn->close();
?>