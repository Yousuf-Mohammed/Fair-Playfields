<?php
// Database configuration
$host = "localhost"; // e.g., localhost
$username = "root";
$password = "";
$database = "dbfairplayfields";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to UTF-8 (optional, adjust based on your needs)
$conn->set_charset("utf8");
?>