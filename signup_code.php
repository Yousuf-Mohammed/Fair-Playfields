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
    $fullName = sanitizeInput($_POST['full_name']);
    $phone = sanitizeInput($_POST['phone']);
    $email = sanitizeInput($_POST['email']);
    $password = password_hash(sanitizeInput($_POST['password']), PASSWORD_DEFAULT); // Hash the password
    $birthDate = sanitizeInput($_POST['birthdate']);
    $address = sanitizeInput($_POST['address']);
    $userType = sanitizeInput($_POST['user_type']);
    $positionPriorityOne = sanitizeInput($_POST['player_position_priority_one']);
    $rateOne = sanitizeInput($_POST['player_rate_one']);
    $positionPriorityTwo = sanitizeInput($_POST['player_position_priority_two']);
    $rateTwo = sanitizeInput($_POST['player_rate_two']);

    // Check if 'profile_picture' index exists in $_FILES
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        // Handle file upload (you may need to implement further validation and security measures)
        $profilePicture = 'uploads/' . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicture);
    } else {
        // Handle the case where no file is uploaded (optional)
        $profilePicture = null; // or set a default picture
    }

    // SQL query to insert user data into tbluser
    $sql = "INSERT INTO tbluser (name, email, phone, password, birth_date, address, type, picture)
            VALUES ('$fullName', '$email', '$phone', '$password', '$birthDate', '$address', '$userType', '$profilePicture')";

    if ($conn->query($sql) === TRUE) {
        echo "User registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>