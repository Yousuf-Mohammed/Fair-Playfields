<?php
require_once 'header.php';
require_once 'auth.php'; // Include the authentication logic
require_once 'connect.php';

// Authenticate the user
$user = authenticate();

// Check if user is authenticated
if (!$user) {
    // Handle unauthorized access
    echo "Unauthorized access.";
    exit();
}

// Get the match ID from the URL if it exists
$matchID = isset($_GET['match_id']) ? mysqli_real_escape_string($conn, $_GET['match_id']) : null;


// Fetch match details from the database
$matchDetailsQuery = "SELECT m.*, ml.venue_name AS match_location
                     FROM `match` m
                     JOIN match_location ml ON m.match_location_id = ml.match_location_id
                     WHERE m.match_id = '$matchID'";

$matchDetailsResult = mysqli_query($conn, $matchDetailsQuery);

?>

<div class="container mt-5">
    <h1 class="mb-4">Join Match</h1>

    <?php
    // Check for query success
    if (!$matchDetailsResult) {
        die('Error in query: ' . $matchDetailsQuery . ' ' . mysqli_error($conn));
    }

    // Check if there are any match details
    if (mysqli_num_rows($matchDetailsResult) > 0) {
        // Display match details
        $matchDetails = mysqli_fetch_assoc($matchDetailsResult);

        // Explode the player list string into an array and remove empty or null values
        $players = array_filter(explode(',', $matchDetails['player_list']));
        // Calculate remaining player slots
        $remainingPlayers = $matchDetails['max_players'] - count($players);
    ?>

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $matchDetails['match_name']; ?></h2>
                        <p class="card-text">Date: <?php echo $matchDetails['match_date']; ?></p>
                        <p class="card-text">Time: <?php echo $matchDetails['start_time']; ?> to
                            <?php echo $matchDetails['end_time']; ?></p>
                        <p class="card-text">Location: <?php echo $matchDetails['match_location']; ?></p>
                        <p class="card-text">Max Players: <?php echo $matchDetails['max_players']; ?></p>
                        <p class="card-text">Remaining Players: <?php echo $remainingPlayers; ?></p>

                        <form action="register_event.php" method="post">

                            <div>
                                <label for="match_name">Match Name:</label>
                                <input type="text" id="match_name" name="match_name" value="<?php echo $matchDetails['match_name']; ?>" readonly>
                                <label for="match_id">Match ID:</label>
                                <input type="text" id="match_id" name="match_id" value="<?php echo $matchID; ?>" readonly>
                            </div>
                            <div>
                                <label for="user_name">User Name:</label>
                                <input type="text" id="user_name" name="user_name" value="<?php echo $user['user_name']; ?>" readonly>
                                <label for="user_id">User ID:</label>
                                <input type="text" id="user_id" name="user_id" value="<?php echo $user['user_id']; ?>" readonly>
                            </div>


                            <label for="primary_position">Primary Position:</label>
                            <input type="text" id="primary_position" name="primary_position" required><br><br>
                            <label for="secondary_position">Secondary Position:</label>
                            <input type="text" id="secondary_position" name="secondary_position" required><br><br>
                            <label for="personal_rating">Personal Rating:</label>
                            <input type="number" id="personal_rating" name="personal_rating" required><br><br>

                            <button type="submit" class="btn btn-primary mt-3">Join Match</button>
                        </form>
                    </div>
                </div>
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
<br>
<br>
<?php
// Handle form submission and save form data to event table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $matchID = mysqli_real_escape_string($conn, $_POST['match_id']);
    $eventUserID = mysqli_real_escape_string($conn, $_POST['user_id']);
    $eventPrimaryPosition = mysqli_real_escape_string($conn, $_POST['primary_position']);
    $eventSecondaryPosition = mysqli_real_escape_string($conn, $_POST['secondary_position']);
    $eventPersonalRating = isset($_POST['personal_rating']) && $_POST['personal_rating'] !== '' ? mysqli_real_escape_string($conn, $_POST['personal_rating']) : null;
    $eventAdminRating = 0;
    $eventTeamNumber = 0;
    $eventScoredGoals = 0;

    // Prepare insert statement
    $insertEventQuery = "INSERT INTO events (user_id, match_id, primary_position, secondary_position, personal_rating, admin_rating, team_number, scored_goals) 
                             VALUES ('$eventUserID', '$matchID', '$eventPrimaryPosition', '$eventSecondaryPosition', '$eventPersonalRating', '$eventAdminRating', '$eventTeamNumber', '$eventScoredGoals')";

    // Execute insert statement
    if (mysqli_query($conn, $insertEventQuery)) {
        echo "Event registered successfully.";
    } else {
        echo "Error registering event: " . mysqli_error($conn);
    }
}
?>
<?php require_once 'footer.php'; ?>