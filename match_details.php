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
    <h1 class="mb-4">Match Details</h1>

    <div class="row">
        <!-- Match Details section -->
        <div class="col-md-6">
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
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $matchDetails['match_name']; ?></h2>
                    <p class="card-text">Date: <?php echo $matchDetails['match_date']; ?></p>
                    <p class="card-text">Time: <?php echo $matchDetails['start_time']; ?> to
                        <?php echo $matchDetails['end_time']; ?></p>
                    <p class="card-text">Location: <?php echo $matchDetails['match_location']; ?></p>
                    <p class="card-text">Max Players: <?php echo $matchDetails['max_players']; ?></p>
                    <!-- Display remaining player count -->
                    <p class="card-text">Remaining Players: <?php echo $remainingPlayers; ?></p>
                    <!-- Display list of players -->
                    <h5 class="card-title">Players Joined:</h5>
                    <ul class="list-group">
                        <?php foreach ($players as $player) : ?>
                        <?php if (!empty($player)) : ?>
                        <li class="list-group-item"><?php echo $player; ?></li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php
            } else {
                echo "<p>No match details found.</p>";
            }

            // Free the result set
            mysqli_free_result($matchDetailsResult);
            ?>
        </div>

        <!-- Join this Match section -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">Join this Match</h2>
                    <form action="register_to_match.php" method="post">
                        <input type="hidden" name="match_id" value="<?php echo $matchID; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                        <!-- Add form fields for primary position, secondary position, personal rating -->
                        <div class="mb-3">
                            <label for="primary_position" class="form-label">Primary Position:</label>
                            <select id="primary_position" name="primary_position" class="form-select" required>
                                <option value="">Select Primary Position</option>
                                <option value="Goalkeeper">Goalkeeper</option>
                                <option value="Defender">Defender</option>
                                <option value="Midfielder">Midfielder</option>
                                <option value="Attacker">Attacker</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="secondary_position" class="form-label">Secondary Position:</label>
                            <select id="secondary_position" name="secondary_position" class="form-select" required>
                                <option value="">Select Secondary Position</option>
                                <option value="Goalkeeper">Goalkeeper</option>
                                <option value="Defender">Defender</option>
                                <option value="Midfielder">Midfielder</option>
                                <option value="Attacker">Attacker</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="personal_rating" class="form-label">Personal Rating (1-10):</label>
                            <input type="number" id="personal_rating" name="personal_rating" class="form-control"
                                min="1" max="10" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Join Match</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>