<?php
require_once 'C:\wamp64\www\Fair Playfields\config\app.php';

// Start the session
session_start();

// Include the connection file
include 'connect.php';

// Initialize username variable
$username = '';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Retrieve user information from the database
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT user_name FROM user WHERE user_id = '$user_id'";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result->num_rows > 0) {
        // Fetch the user's username
        $user_data = $result->fetch_assoc();
        $username = $user_data['user_name'];
    }
}
?>

<!DOCTYPE html>
<html dir="<?php echo $config['dir'] ?>" lang="<?php echo $config['lang']; ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $config['app_name'] . " | " . $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" href="css\about.css">
    <!-- <link rel="stylesheet" href="css\index.css"> -->
    <!-- Include Bootstrap CSS -->
    <link href="path/to/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom CSS styles (if any) -->
    <link rel="stylesheet" href="path/to/custom.css">
</head>

<body>
    <header>
        <nav class="menu">
            <img src=".\img\logo.png" alt="Logo">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <a href="admin.php">Admin</a>
                <a href="logout.php">Logout</a>
            <?php else : ?>
                <a href="login_signup.php">Login</a>
            <?php endif; ?>
        </nav>
        <?php if (isset($_SESSION['user_id'])) : ?>
            <!-- Display the welcome message and username -->
            <span>Welcome, <?php echo $username; ?>!</span>
        <?php endif; ?>
    </header>