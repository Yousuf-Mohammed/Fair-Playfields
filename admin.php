<?php 
$title = 'Admin Panel';
require_once 'header.php';
?>
<h1>Admin Panel</h1>

<?php
// Include the database connection file
require_once 'connect.php';

// Fetch all users from the database
$query = "SELECT * FROM tbluser";
$result = mysqli_query($conn, $query);

// Check for query success
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Display user information as a table
echo "<table border='1'>";
echo "<tr><th>User ID</th><th>Username</th><th>Email</th><th>Type of user</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['uid']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['type']}</td>";
    // Add more user details as needed
    echo "</tr>";
}

echo "</table>";

// Free the result set
mysqli_free_result($result);

// Close the database connection
mysqli_close($conn);
?>

<?php require_once 'footer.php';?>