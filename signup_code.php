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
    $password = password_hash(sanitizeInput($_POST['password']), PASSWORD_DEFAULT); // Hash the password
    $birthDate = sanitizeInput($_POST['birth_date']);
    $address = sanitizeInput($_POST['address']);
    $type = sanitizeInput($_POST['type']);
    $positionPriorityOne = sanitizeInput($_POST['player_position_priority_one']);
    $rateOne = sanitizeInput($_POST['player_rate_one']);
    $positionPriorityTwo = sanitizeInput($_POST['player_position_priority_two']);
    $rateTwo = sanitizeInput($_POST['player_rate_two']);

    // Check if 'profile_picture' index exists in $_FILES
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        // Handle file upload (you may need to implement further validation and security measures)
        $picture = 'uploads/' . basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $picture);
    } else {
        // Handle the case where no file is uploaded (optional)
        $picture = null; // or set a default picture
    }

    // SQL query to insert user data into tbluser
    $sql = "INSERT INTO tbluser (name, email, phone, password, birth_date, address, type, picture)
            VALUES ('$name', '$email', '$phone', '$password', '$birthDate', '$address', '$type', '$picture')";

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