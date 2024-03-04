<?php
require_once 'header.php';
require_once 'auth.php'; // Include the authentication logic

// Authenticate the user
$user = authenticate();

// Check if user is authenticated
if (!$user) {
    // Handle unauthorized access
    echo "Unauthorized access.";
    exit();
}

// Get the match ID from the URL
$matchID = $_GET['match_id'];

// Fetch match details from the database
$matchDetails = getMatchDetails($conn, $matchID);

// Fetch players list
$players = array_filter(explode(',', $matchDetails['player_list']));

// Display match details
displayMatchDetails($matchDetails, $players);

// Display player list
displayPlayerList($matchDetails, $user);

function getMatchDetails($conn, $matchID)
{
    // Fetch match details from the database
    $matchDetailsQuery = "SELECT m.*, ml.venue_name AS match_location
                        FROM `match` m
                        JOIN match_location ml ON m.match_location_id = ml.match_location_id
                        WHERE m.match_id = ?";

    $stmt = mysqli_prepare($conn, $matchDetailsQuery);
    mysqli_stmt_bind_param($stmt, 'i', $matchID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die('Error in query: ' . $matchDetailsQuery . ' ' . mysqli_error($conn));
    }

    $matchDetails = mysqli_fetch_assoc($result);

    // Free the result set
    mysqli_free_result($result);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Close the database connection
    mysqli_close($conn);

    return $matchDetails;
}


function displayMatchDetails($matchDetails, $players)
{
    $title = 'Match Details';
?>
<div class="container mt-5">
    <h1 class="mb-4"><?php echo $title; ?></h1>
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
                    <!-- Display remaining player count -->
                    <p class="card-text">Remaining Players:
                        <?php echo $matchDetails['max_players'] - count($players); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}

function displayPlayerList($matchDetails, $user)
{
    $matchID = $_GET['match_id'];
?>
<div class="container mt-5">
    <h3 class="mt-4">Player List:</h3>
    <ol>
        <?php
            $players = array_filter(explode(',', $matchDetails['player_list']));
            foreach ($players as $player) {
                if (!empty($player)) {
                    echo "<li class='list-group-item'>$player</li>";
                }
            }
            ?>
    </ol>
    <?php
        if (count($players) == $matchDetails['max_players']) {
            // Display button to divide players into two teams
        ?>
    <!-- Button to divide players into two teams -->
    <form action="divide_teams.php" method="post">
        <input type="hidden" name="match_id" value="<?php echo $matchID; ?>">
        <button type="submit" class="btn btn-primary mt-3">Divide Players into Teams</button>
    </form>
    <?php
        }
        ?>
    <!-- Button to register for a match -->
    <form action="join_match.php" method="post">
        <input type="hidden" name="match_id" value="<?php echo $matchID; ?>">
        <button type="submit" class="btn btn-primary mt-3">Register for Match</button>
    </form>
</div>
<?php
}
?>
<?php require_once 'footer.php'; ?>