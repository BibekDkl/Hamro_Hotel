<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // Verify password
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user'] = $row['name'];
            echo "Login successful!";
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
