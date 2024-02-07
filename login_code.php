<?php
// Include the connection file
include 'connect.php';

// Function to sanitize user input
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form inputs
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    // SQL query to check user credentials
    $sql = "SELECT * FROM user WHERE user_name = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, check password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['user_password'])) {
            // Password is correct, redirect to home page or do further actions
            header("Location: home.php");
            exit();
        } else {
            echo '<script>alert("Incorrect password");</script>';
        }
    } else {
        echo '<script>alert("User not found");</script>';
    }
}

// Close the connection
$conn->close();
?>