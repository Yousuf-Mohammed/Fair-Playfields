<?php
$title = 'Match Location';
require_once 'header.php';

// Include the database connection file
require_once 'connect.php';

// Define variables to store user inputs
$name = $address = $facilities = $owner_name = $owner_phone = '';
$error = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $facilities = mysqli_real_escape_string($conn, $_POST['facilities']);
    $owner_name = mysqli_real_escape_string($conn, $_POST['owner_name']);
    $owner_phone = mysqli_real_escape_string($conn, $_POST['owner_phone']);

    // Insert data into match_location table
    $sql = "INSERT INTO match_location (venue_name, venue_address, facilities_description, owner_name, owner_phone)
            VALUES ('$name', '$address', '$facilities', '$owner_name', '$owner_phone')";

    if ($conn->query($sql) === TRUE) {
        // Success message using JavaScript dialog
        echo '<script>
                alert("Match location added successfully");
                window.location.href = "index.php"; // Redirect to the home page or another page
              </script>';
    } else {
        // Error message
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<div class="container">
    <h1 class="title">Add Match Location</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <!-- Add form fields for user input -->
        <label for="name">Location Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="facilities">Facilities:</label>
        <textarea id="facilities" name="facilities"></textarea>

        <label for="owner_name">Owner Name:</label>
        <input type="text" id="owner_name" name="owner_name" required>

        <label for="owner_phone">Owner Phone Number:</label>
        <input type="text" id="owner_phone" name="owner_phone" required>

        <button type="submit">Add Match Location</button>
    </form>

    <?php
    // Display error message if any
    echo '<p class="error">' . $error . '</p>';
    ?>
</div>

<?php require_once 'footer.php'; ?>