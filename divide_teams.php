<?php
// Include authentication logic
require_once 'auth.php';
// Include database connection
require_once 'connect.php';

// Authenticate the user
$user = authenticate();

// Check if user is authenticated
if (!$user) {
    // Handle unauthorized access
    echo "Unauthorized access.";
    exit();
}

// Get the match ID from the form data
$matchID = mysqli_real_escape_string($conn, $_POST['match_id']);

// Fetch player list from the database
$matchDetailsQuery = "SELECT player_list FROM `match` WHERE match_id = '$matchID'";
$matchDetailsResult = mysqli_query($conn, $matchDetailsQuery);

// Check for query success
if (!$matchDetailsResult) {
    die('Error in query: ' . $matchDetailsQuery . ' ' . mysqli_error($conn));
}

// Fetch the player list
$matchDetails = mysqli_fetch_assoc($matchDetailsResult);
$playerList = explode(',', $matchDetails['player_list']);

// Randomly shuffle the player list
shuffle($playerList);

// Calculate the number of players per team
$totalPlayers = count($playerList);
$playersPerTeam = ceil($totalPlayers / 2);

// Divide players into two teams
$teamA = array_slice($playerList, 0, $playersPerTeam);
$teamB = array_slice($playerList, $playersPerTeam);

// Update the match details with team assignments
$teamAList = implode(',', $teamA);
$teamBList = implode(',', $teamB);

$updateQuery = "UPDATE `match` SET team_a_players = '$teamAList', team_b_players = '$teamBList' WHERE match_id = '$matchID'";
$updateResult = mysqli_query($conn, $updateQuery);

// Check for query success
if (!$updateResult) {
    die('Error in query: ' . $updateQuery . ' ' . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);

// Redirect back to the match details page
header("Location: match_details.php?match_id=$matchID");
exit();
?>