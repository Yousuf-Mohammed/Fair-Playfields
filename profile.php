<!-- filename: profile.php -->
<?php include '../html/header.html'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .title {
        text-align: center;
        color: #444;
    }

    .profile-card {
        display: flex;
        justify-content: space-around;
        align-items: flex-start;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .left-column,
    .right-column {
        flex-basis: 50%;
    }

    .profile-image img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 3px solid #eee;
    }

    .user-name {
        margin-top: 15px;
    }

    .additional-details {
        text-align: left;
        margin-top: 15px;
        display: block;
        /* Ensure details are always visible */
    }

    .additional-details strong {
        color: #333;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">User Profile</h1>
        <div class="profile-card">
            <div class="left-column">
                <div class="profile-image">
                    <img src="profile-image.jpg" alt="Profile Image">
                </div>
                <h3 class="user-name">Full Name</h3>
            </div>
            <div class="right-column">
                <div class="additional-details">
                    <p><strong>Age:</strong> [Age]</p>
                    <p><strong>Phone Number:</strong> [Phone Number]</p>
                    <p><strong>Email:</strong> [Email]</p>
                    <p><strong>Address:</strong> [Address]</p>
                </div>
            </div>
        </div>
    </div>
    <?php include '../html/footer.html'; ?>
</body>

</html>