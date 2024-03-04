<?php
$title = 'Admin Panel';
require_once 'header.php';
?>

<h1>Admin Panel</h1>

<?php
// Include the database connection file
require_once 'connect.php';

// Function for error handling
function handleError($query, $connection)
{
    die('Error in query: ' . $query . ' ' . mysqli_error($connection));
}

// Fetch all users from the database
$userQuery = "SELECT * FROM user";
$userResult = mysqli_query($conn, $userQuery) or handleError($userQuery, $conn);

// Fetch all match locations from the database
$locationQuery = "SELECT * FROM match_location";
$locationResult = mysqli_query($conn, $locationQuery) or handleError($locationQuery, $conn);

// Fetch all matches from the database along with user_id
$matchQuery = "SELECT m.*, u.user_id AS creator_user_id FROM `match` m LEFT JOIN user u ON m.user_id = u.user_id";
$matchResult = mysqli_query($conn, $matchQuery) or handleError($matchQuery, $conn);

// Display user information as a table
echo "<h2>User Information</h2>";
echo "<table border='1'>";
echo "<tr><th>User ID</th><th>Username</th><th>Email</th><th>Type of user</th></tr>";

while ($userRow = mysqli_fetch_assoc($userResult)) {
    echo "<tr>";
    echo "<td>{$userRow['user_id']}</td>";
    echo "<td>{$userRow['user_name']}</td>";
    echo "<td>{$userRow['user_email']}</td>";
    echo "<td>{$userRow['user_type']}</td>";
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
    echo "<td>{$locationRow['match_location_id']}</td>";
    echo "<td>{$locationRow['venue_name']}</td>";
    echo "<td>{$locationRow['venue_address']}</td>";
    echo "<td>{$locationRow['facilities_description']}</td>";
    echo "<td>{$locationRow['owner_name']}</td>";
    echo "<td>{$locationRow['owner_phone']}</td>";
    echo "</tr>";
}

echo "</table>";

// Display match information as a table
echo "<h2>Match Information</h2>";
echo "<table border='1'>";
echo "<tr><th>Match ID</th><th>Match Name</th><th>Date</th><th>Time From</th><th>Time To</th><th>Min Players</th><th>Max Players</th><th>Match Location</th><th>Creator User ID</th></tr>";

while ($matchRow = mysqli_fetch_assoc($matchResult)) {
    echo "<tr>";
    echo "<td>{$matchRow['match_id']}</td>";
    echo "<td>{$matchRow['match_name']}</td>";
    echo "<td>{$matchRow['match_date']}</td>";
    echo "<td>{$matchRow['start_time']}</td>";
    echo "<td>{$matchRow['end_time']}</td>";
    echo "<td>{$matchRow['min_players']}</td>";
    echo "<td>{$matchRow['max_players']}</td>";
    // Fetch match location name based on match_location_id
    $matchLocationQuery = "SELECT venue_name FROM match_location WHERE match_location_id = '{$matchRow['match_location_id']}'";
    $matchLocationResult = mysqli_query($conn, $matchLocationQuery) or handleError($matchLocationQuery, $conn);
    $matchLocationRow = mysqli_fetch_assoc($matchLocationResult);
    echo "<td>{$matchLocationRow['venue_name']}</td>";
    // Display creator_user_id
    echo "<td>{$matchRow['creator_user_id']}</td>";
    mysqli_free_result($matchLocationResult);
    echo "</tr>";
}

echo "</table>";

// Free the result sets
mysqli_free_result($userResult);
mysqli_free_result($locationResult);
mysqli_free_result($matchResult);

// Close the database connection
mysqli_close($conn);
?>

<?php require_once 'footer.php'; ?>