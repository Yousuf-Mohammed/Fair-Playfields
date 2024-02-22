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

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $matchID = mysqli_real_escape_string($conn, $_POST['match_id']);
    $eventUserID = $user['user_id'];
    $eventPrimaryPosition = mysqli_real_escape_string($conn, $_POST['primary_position']);
    $eventSecondaryPosition = mysqli_real_escape_string($conn, $_POST['secondary_position']);
    $eventPersonalRating = isset($_POST['personal_rating']) && $_POST['personal_rating'] !== '' ? mysqli_real_escape_string($conn, $_POST['personal_rating']) : 'null';
    $eventAdminRating = isset($_POST['admin_rating']) && $_POST['admin_rating'] !== '' ? mysqli_real_escape_string($conn, $_POST['admin_rating']) : 'null';
    $eventTeamNumber = mysqli_real_escape_string($conn, $_POST['team_number']);
    $eventScoredGoals = isset($_POST['scored_goals']) && $_POST['scored_goals'] !== '' ? mysqli_real_escape_string($conn, $_POST['scored_goals']) : 'null';

    // Prepare insert statement
    $insertEventQuery = "INSERT INTO events (user_id, match_id, primary_position, secondary_position, personal_rating, admin_rating, team_number, scored_goals) 
                         VALUES ('$eventUserID', '$matchID', '$eventPrimaryPosition', '$eventSecondaryPosition', $eventPersonalRating, $eventAdminRating, '$eventTeamNumber', $eventScoredGoals)";

    // Execute insert statement
    if (mysqli_query($conn, $insertEventQuery)) {
        echo "Event registered successfully.";
    } else {
        echo "Error registering event: " . mysqli_error($conn);
    }
}

?>