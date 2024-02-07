<?php 
$title = 'Profile';
require_once 'header.php';
?>

<div class="container">
    <h1 class="title">User Profile</h1>
    <div class="profile-card row">

        <?php
        // Include the database connection file
        require_once 'connect.php';

        // Replace 'user_id' with the actual user ID you want to display
        $uid = 4;

        // Fetch user data from the database
        $query = "SELECT * FROM user WHERE user_id = $uid";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Calculate age based on birth date
            $birthDate = new DateTime($row['user_birth_date']);
            $currentDate = new DateTime();
            $age = $currentDate->diff($birthDate)->y;

            // Display user profile information
            echo '<div class="left-column col-md-6">
                    <div class="profile-image">
                        <img src="' . $row['user_picture'] . '" alt="Profile Image" class="img-fluid">
                    </div>
                    <h3 class="user-name">' . $row['user_name'] . '</h3>
                </div>
                <div class="right-column col-md-6">
                    <div class="additional-details">
                        <p><strong>Age:</strong> ' . $age . '</p>
                        <p><strong>Phone Number:</strong> ' . $row['user_phone'] . '</p>
                        <p><strong>Email:</strong> ' . $row['user_email'] . '</p>
                        <p><strong>Address:</strong> ' . $row['user_address'] . '</p>
                    </div>
                </div>';
        } else {
            echo "No user found.";
        }

        // Close the database connection
        $conn->close();
        ?>

    </div>
</div>

<?php require_once 'footer.php';?>