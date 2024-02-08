<?php require_once 'C:\wamp64\www\Fair Playfields\config\app.php'; ?>


<!DOCTYPE html>
<html dir="<?php echo $config['dir']?>" lang="<?php echo $config['lang'];?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $config['app_name']." | ".$title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
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
            <a href="admin.php">Admin</a>
            <a href="login_signup.php">Login</a>
        </nav>
    </header>