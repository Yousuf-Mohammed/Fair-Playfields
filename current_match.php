<?php
$title = 'View Current Matches';
require_once 'header.php';

// Include the database connection file
require_once 'connect.php';

// Fetch current matches with match location from the database
$currentMatchesQuery = "SELECT m.*, ml.venue_name AS match_location, ml.venue_address, ml.facilities_description, ml.owner_name, ml.owner_phone 
                        FROM `match` m
                        JOIN match_location ml ON m.match_location_id = ml.match_location_id
                        WHERE m.match_status = 'Active'";
$currentMatchesResult = mysqli_query($conn, $currentMatchesQuery);

?>

<div class="container">
    <h1>Current Matches</h1>

    <?php
    // Check for query success
    if (!$currentMatchesResult) {
        die('Error in query: ' . $currentMatchesQuery . ' ' . mysqli_error($conn));
    }

    // Check if there are any matches
    if (mysqli_num_rows($currentMatchesResult) > 0) {
        // Display current matches information as a table
        echo "<table border='1'>";
        echo "<tr><th>Match ID</th><th>Match Name</th><th>Date</th><th>Time From</th><th>Time To</th><th>Min Players</th><th>Max Players</th><th>Match Location</th><th>Venue Address</th><th>Facilities Description</th><th>Owner Name</th><th>Owner Phone</th></tr>";

        while ($matchRow = mysqli_fetch_assoc($currentMatchesResult)) {
            echo "<tr>";
            echo "<td>{$matchRow['match_id']}</td>";
            echo "<td>{$matchRow['match_name']}</td>";
            echo "<td>{$matchRow['match_date']}</td>";
            echo "<td>{$matchRow['start_time']}</td>";
            echo "<td>{$matchRow['end_time']}</td>";
            echo "<td>{$matchRow['min_players']}</td>";
            echo "<td>{$matchRow['max_players']}</td>";
            echo "<td>{$matchRow['match_location']}</td>";
            echo "<td>{$matchRow['venue_address']}</td>";
            echo "<td>{$matchRow['facilities_description']}</td>";
            echo "<td>{$matchRow['owner_name']}</td>";
            echo "<td>{$matchRow['owner_phone']}</td>";

            // Add a link to view match details with the match ID in the URL
            echo "<td><a href='match_details.php?match_id={$matchRow['match_id']}'>View Details</a></td>";

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No active matches found.</p>";
    }

    // Free the result set
    mysqli_free_result($currentMatchesResult);

    // Close the database connection
    mysqli_close($conn);
    ?>

</div>

<?php require_once 'footer.php'; ?>