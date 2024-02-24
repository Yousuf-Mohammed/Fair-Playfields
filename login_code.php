<?php
// Include the connection file
include 'connect.php';

// Function to sanitize user input
function sanitizeInput($input)
{
    global $conn;
    // Use prepared statements to prevent SQL injection
    return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags(trim($input))));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form inputs
    $user_name = sanitizeInput($_POST['user_name']);
    $user_password = sanitizeInput($_POST['user_password']);

    // SQL query to check user credentials
    $sql = "SELECT * FROM user WHERE user_name = '$user_name' AND user_password = '$user_password'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if any row is returned
    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Password is correct, redirect to appropriate page
        session_start();
        $_SESSION['user_id'] = $user['user_id']; // Store user ID in session
        header("Location: index.php");
        exit();
    } else {
        // Incorrect username or password
        echo '<script>alert("Incorrect username or password");</script>';
        echo "<script>window.location.href='javascript:history.back()'</script>"; //Redirects the user with JavaScript
    }
}

// Close the connection
$conn->close();
