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
$matchID = isset($_POST['match_id']) ? mysqli_real_escape_string($conn, $_POST['match_id']) : null;

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
                        <!-- Display other match details -->
                        <!-- Form for registering to the match -->
                        <form action="register_to_match.php" method="post">
                            <!-- Hidden fields for match ID and user ID -->
                            <input type="hidden" name="match_id" value="<?php echo $matchID; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                            <!-- Other form fields for primary position, secondary position, personal rating -->
                            <!-- Add form fields for primary position, secondary position, personal rating -->
                            <!-- Submit button to register for the match -->
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
<?php require_once 'footer.php'; ?>