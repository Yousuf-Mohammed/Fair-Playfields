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
    $name = sanitizeInput($_POST['full_name']);
    $phone = sanitizeInput($_POST['phone']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']); // No need to hash the password in this version
    $birthDate = sanitizeInput($_POST['birth_date']);
    $address = sanitizeInput($_POST['address']);

    // SQL query to insert user data into user table
    $sql = "INSERT INTO user (user_name, user_email, user_phone, user_password, user_birth_date, user_address)
            VALUES ('$name', '$email', '$phone', '$password', '$birthDate', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
        alert("User registered successfully");
        window.location.href = "login.php";
      </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>