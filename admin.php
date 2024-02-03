<?php 
$title = 'Admin Panel';
require_once 'header.php';
?>

<h1>Admin Panel</h1>

<?php
// Include the database connection file
require_once 'connect.php';

// Fetch all users from the database
$userQuery = "SELECT * FROM tbluser";
$userResult = mysqli_query($conn, $userQuery);

// Fetch all match locations from the database
$locationQuery = "SELECT * FROM tblmatchlocation";
$locationResult = mysqli_query($conn, $locationQuery);

// Check for query success for both user and match locations
if (!$userResult || !$locationResult) {
    die("Query failed: " . mysqli_error($conn));
}

// Display user information as a table
echo "<h2>User Information</h2>";
echo "<table border='1'>";
echo "<tr><th>User ID</th><th>Username</th><th>Email</th><th>Type of user</th></tr>";

while ($userRow = mysqli_fetch_assoc($userResult)) {
    echo "<tr>";
    echo "<td>{$userRow['uid']}</td>";
    echo "<td>{$userRow['name']}</td>";
    echo "<td>{$userRow['email']}</td>";
    echo "<td>{$userRow['type']}</td>";
    // Add more user details as needed
    echo "</tr>";
}

echo "</table>";

// Display match location information as a table
echo "<h2>Match Location Information</h2>";
echo "<table border='1'>";
echo "<tr><th>Location ID</th><th>Name</th><th>Address</th><th>Facilities</th><th>Owner Name</th><th>Owner Phone</th></tr>";

while ($locationRow = mysqli_fetch_assoc($locationResult)) {
    echo "<tr>";
    echo "<td>{$locationRow['mlid']}</td>";
    echo "<td>{$locationRow['name']}</td>";
    echo "<td>{$locationRow['address']}</td>";
    echo "<td>{$locationRow['facilities']}</td>";
    echo "<td>{$locationRow['owner_name']}</td>";
    echo "<td>{$locationRow['owner_phone']}</td>";
    echo "</tr>";
}

echo "</table>";

// Free the result sets
mysqli_free_result($userResult);
mysqli_free_result($locationResult);

// Close the database connection
mysqli_close($conn);
?>

<?php require_once 'footer.php';?>