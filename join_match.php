<?php
require_once 'auth.php'; // Include the authentication logic
require_once 'connect.php'; // Include the database connection file

// Authenticate the user
$user = authenticate();

// Check if user is authenticated
if (!$user) {
    // Handle unauthorized access
    echo "Unauthorized access.";
    exit();
}

// Check if the match ID is provided
if (!isset($_POST['match_id'])) {
    // Redirect the user to an error page or back to the previous page
    header("Location: error.php");
    exit();
}

// Get the match ID from the POST data
$matchID = mysqli_real_escape_string($conn, $_POST['match_id']);

// Fetch the current player list for the match
$playerListQuery = "SELECT player_list FROM `match` WHERE match_id = '$matchID'";
$playerListResult = mysqli_query($conn, $playerListQuery);

if (!$playerListResult) {
    // Handle query error
    die('Error in query: ' . $playerListQuery . '. Error: ' . mysqli_error($conn));
}

// Fetch the current player list
$playerListData = mysqli_fetch_assoc($playerListResult);
$currentPlayerList = $playerListData['player_list'];

// Append the user's name to the player list
$newPlayerList = $currentPlayerList . "," . $user['user_name'];

// Update the player list in the database
$updatePlayerListQuery = "UPDATE `match` SET player_list = '$newPlayerList' WHERE match_id = '$matchID'";
$updatePlayerListResult = mysqli_query($conn, $updatePlayerListQuery);

if (!$updatePlayerListResult) {
    // Handle query error
    die('Error in query: ' . $updatePlayerListQuery . '. Error: ' . mysqli_error($conn));
}

// Prepare and execute insert statement to add player info to player_info table
$insertPlayerInfoQuery = "INSERT INTO player_info (user_id, match_id, primary_position, secondary_position, personal_rating) 
                          VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $insertPlayerInfoQuery);
mysqli_stmt_bind_param($stmt, 'iisss', $user['user_id'], $matchID, $_POST['primary_position'], $_POST['secondary_position'], $_POST['personal_rating']);
$insertPlayerInfoResult = mysqli_stmt_execute($stmt);

if (!$insertPlayerInfoResult) {
    // Handle query error
    die('Error in query: ' . $insertPlayerInfoQuery . '. Error: ' . mysqli_stmt_error($stmt));
}

// Redirect the user back to the match details page
header("Location: match_details.php?match_id=$matchID");
exit();
