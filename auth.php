<?php
function authenticate()
{
    // Start the session
    // session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect the user to the login page if not logged in
        header("Location: login.php");
        exit();
    }

    // Retrieve the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Include the database connection file
    require_once 'connect.php';

    // Use the global keyword to access the $conn variable
    global $conn;

    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user data from the database
    $query = "SELECT * FROM user WHERE user_id = $user_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
