<?php
$title = 'Match Details';
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

// Get the match ID from the URL
$matchID = mysqli_real_escape_string($conn, $_GET['match_id']);

// Fetch match details from the database
$matchDetailsQuery = "SELECT m.*, ml.venue_name AS match_location
                     FROM `match` m
                     JOIN match_location ml ON m.match_location_id = ml.match_location_id
                     WHERE m.match_id = '$matchID'";

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

                    <h3 class="mt-4">Player List:</h3>
                    <ol>
                        <?php
                            // Display player list
                            foreach ($players as $key => $player) {
                                if (!empty($player)) {
                                    echo "<li class='list-group-item'>$player</li>";
                                }
                            }
                        ?>
                    </ol>

                    <?php
                // Check if the match is full
                if (count($players) == $matchDetails['max_players']) {
                    // Display button to divide players into two teams
                ?>
                    <!-- Button to divide players into two teams -->
                    <form action="divide_teams.php" method="post">
                        <input type="hidden" name="match_id" value="<?php echo $matchID; ?>">
                        <button type="submit" class="btn btn-primary mt-3">Divide Players into Teams</button>
                    </form>
                    <?php
                } elseif (!in_array($user['user_name'], $players)) {
                    // Display button to join the match
                ?>
                    <!-- Button to join the match -->
                    <!-- <form action="join_match.php" method="post">
                        <input type="hidden" name="match_id" value="<?php echo $matchID; ?>">
                        <button type="submit" class="btn btn-primary mt-3">Join Match</button>
                    </form> -->

                    <?php
$title = 'Match Details';
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

// Get the match ID from the URL
$matchID = mysqli_real_escape_string($conn, $_GET['match_id']);

// Fetch match details from the database
$matchDetailsQuery = "SELECT m.*, ml.venue_name AS match_location
                     FROM `match` m
                     JOIN match_location ml ON m.match_location_id = ml.match_location_id
                     WHERE m.match_id = '$matchID'";

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
                                        <p class="card-text">Location: <?php echo $matchDetails['match_location']; ?>
                                        </p>
                                        <p class="card-text">Max Players: <?php echo $matchDetails['max_players']; ?>
                                        </p>
                                        <p class="card-text">Remaining Players: <?php echo $remainingPlayers; ?></p>

                                        <h3 class="mt-4">Player List:</h3>
                                        <ol>
                                            <?php
                            // Display player list
                            foreach ($players as $key => $player) {
                                if (!empty($player)) {
                                    echo "<li class='list-group-item'>$player</li>";
                                }
                            }
                        ?>
                                        </ol>

                                        <?php
                // Check if the match is full
                if (count($players) == $matchDetails['max_players']) {
                    // Display button to divide players into two teams
                ?>
                                        <!-- Button to divide players into two teams -->
                                        <form action="divide_teams.php" method="post">
                                            <input type="hidden" name="match_id" value="<?php echo $matchID; ?>">
                                            <button type="submit" class="btn btn-primary mt-3">Divide Players into
                                                Teams</button>
                                        </form>
                                        <?php
                } elseif (!in_array($user['user_name'], $players)) {
                    // Display button to join the match
                ?>
                                        <!-- Button to join the match -->
                                        <!-- <form action="join_match.php" method="post">
                        <input type="hidden" name="match_id" value="<?php echo $matchID; ?>">
                        <button type="submit" class="btn btn-primary mt-3">Join Match</button>
                    </form> -->

                                        <!-- Button to join the match -->
                                        <form action="register_event.php" method="GET">
                                            <input type="hidden" name="match_id" value="<?php echo $matchID; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                            <input type="hidden" name="primary_position"
                                                value="<?php echo isset($user['primary_position']) ? $user['primary_position'] : ''; ?>">
                                            <input type="hidden" name="secondary_position"
                                                value="<?php echo isset($user['secondary_position']) ? $user['secondary_position'] : ''; ?>">
                                            <input type="hidden" name="personal_rating"
                                                value="<?php echo isset($user['personal_rating']) ? $user['personal_rating'] : ''; ?>">
                                            <input type="hidden" name="admin_rating"
                                                value="<?php echo isset($user['admin_rating']) ? $user['admin_rating'] : ''; ?>">
                                            <input type="hidden" name="team_number"
                                                value="<?php echo isset($teamNumber) ? $teamNumber : ''; ?>">
                                            <input type="hidden" name="scored_goals" value="0">
                                            <!-- Default value for scored_goals -->

                                            <button type="submit" class="btn btn-primary mt-3">Join Match</button>
                                        </form>



                                        <?php
                } else {
                    echo "<p>You are already in this match.</p>";
                }
                ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <h3>Team A</h3>
                                <ul>
                                    <!-- Display Team A list here -->
                                    <?php
                // You can implement this part based on your specific requirements
                // For example:
                foreach ($players as $key => $player) {
                    if ($key % 2 == 0) { // Even-indexed players belong to Team A
                        echo "<li>$player</li>";
                    }
                }
                ?>
                                </ul>
                            </div>
                            <div class="col">
                                <h3>Team B</h3>
                                <ul>
                                    <!-- Display Team B list here -->
                                    <?php
                // You can implement this part based on your specific requirements
                // For example:
                foreach ($players as $key => $player) {
                    if ($key % 2 != 0) { // Odd-indexed players belong to Team B
                        echo "<li>$player</li>";
                    }
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
                    <br>
                    <br>
                    <?php require_once 'footer.php'; ?>


                    <?php
                } else {
                    echo "<p>You are already in this match.</p>";
                }
                ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3>Team A</h3>
            <ul>
                <!-- Display Team A list here -->
                <?php
                // You can implement this part based on your specific requirements
                // For example:
                foreach ($players as $key => $player) {
                    if ($key % 2 == 0) { // Even-indexed players belong to Team A
                        echo "<li>$player</li>";
                    }
                }
                ?>
            </ul>
        </div>
        <div class="col">
            <h3>Team B</h3>
            <ul>
                <!-- Display Team B list here -->
                <?php
                // You can implement this part based on your specific requirements
                // For example:
                foreach ($players as $key => $player) {
                    if ($key % 2 != 0) { // Odd-indexed players belong to Team B
                        echo "<li>$player</li>";
                    }
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
<br>
<br>
<?php require_once 'footer.php'; ?>