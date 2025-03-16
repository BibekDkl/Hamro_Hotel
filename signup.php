<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Check if name or email already exists
    $checkQuery = "SELECT * FROM users WHERE name = ? OR email = ?";
    $stmt = $conn->prepare($checkQuery);

    // Check if prepare() succeeded
    if ($stmt === false) {
        $message = "Error preparing query: " . $conn->error;
    } else {
        $stmt->bind_param("ss", $name, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $message = "name or Email already exists!";
            header("Location: login.php");
                    exit();;
        } else {
            // Insert user into the database
            $query = "INSERT INTO users (Name, Email, Password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            
            // Check if prepare() succeeded again
            if ($stmt === false) {
                $message = "Error preparing insert query: " . $conn->error;
            } else {
                $stmt->bind_param("sss", $name, $email, $password);
                if ($stmt->execute()) {
                    header("Location: login.php");
                    exit();;
                } else {
                    $message = "Error: " . $stmt->error;
                }
            }
        }
        
        
    }
    $stmt->close();
    echo $message;
    $conn->close();
    
}
?>
