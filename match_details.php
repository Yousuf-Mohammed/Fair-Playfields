<?php
$title = 'Match Details';
require_once 'header.php';

// Include the database connection file
require_once 'connect.php';

// Get the match ID from the URL
$matchID = mysqli_real_escape_string($conn, $_GET['match_id']);

// Fetch match details with player list from the database
$matchDetailsQuery = "SELECT m.*, ml.venue_name AS match_location, GROUP_CONCAT(u.user_name ORDER BY u.user_name ASC) AS player_list
                     FROM `match` m
                     JOIN match_location ml ON m.match_location_id = ml.match_location_id
                     LEFT JOIN `user` u ON m.user_id = u.user_id
                     WHERE m.match_id = '$matchID'
                     GROUP BY m.match_id";

$matchDetailsResult = mysqli_query($conn, $matchDetailsQuery);

?>

<div class="container mt-5">
    <h1 class="mb-4"><?php echo $title; ?></h1>

    <?php
        // Check for query success
        if (!$matchDetailsResult) {
            die('Error in query: ' . $matchDetailsQuery . ' ' . mysqli_error($conn));
        }

        // Check if there are any match details
        if (mysqli_num_rows($matchDetailsResult) > 0) {
            // Display match details and player list
            $matchDetails = mysqli_fetch_assoc($matchDetailsResult);
        ?>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title"><?php echo $matchDetails['match_name']; ?></h2>
            <p class="card-text">Date: <?php echo $matchDetails['match_date']; ?></p>
            <p class="card-text">Time: <?php echo $matchDetails['start_time']; ?> to
                <?php echo $matchDetails['end_time']; ?></p>
            <p class="card-text">Location: <?php echo $matchDetails['match_location']; ?></p>

            <h3 class="mt-4">Player List:</h3>
            <ul class="list-group">
                <?php
                        // Explode the player_list string into an array and display each player
                        $players = explode(',', $matchDetails['player_list']);
                        foreach ($players as $player) {
                            echo "<li class='list-group-item'>$player</li>";
                        }
                        ?>
            </ul>
        </div>
    </div>
    <?php
        } else {
            echo "<p>No match details found.</p>";
        }

        // Free the result set
        mysqli_free_result($matchDetailsResult);

        // Close the database connection
        mysqli_close($conn);
        ?>
</div>
<?php require_once 'footer.php'; ?>