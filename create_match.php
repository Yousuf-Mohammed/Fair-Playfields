<?php
$title = 'Create Match';
require_once 'header.php';

// Include the database connection file
require_once 'connect.php';

// Define variables to store user inputs
$match_name = $match_date = $time_from = $time_to = $min_players = $max_players = $match_location = '';
$error = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user inputs
    $match_name = mysqli_real_escape_string($conn, $_POST['match_name']);
    $match_date = mysqli_real_escape_string($conn, $_POST['match_date']);
    $time_from = mysqli_real_escape_string($conn, $_POST['time_from']);
    $time_to = mysqli_real_escape_string($conn, $_POST['time_to']);
    $min_players = mysqli_real_escape_string($conn, $_POST['min_players']);
    $max_players = mysqli_real_escape_string($conn, $_POST['max_players']);
    $match_location = mysqli_real_escape_string($conn, $_POST['match_location']);

    // Insert data into match table
    $sql = "INSERT INTO `match` (user_id, match_location_id, match_name, match_date, start_time, end_time, min_players, max_players, match_status)
    VALUES ('5', '5', '$match_name', '$match_date', '$time_from', '$time_to', '$min_players', '$max_players', 'Active')";

    // Execute the query with error handling
    mysqli_query($conn, $sql) or die('Error in query: ' . $sql . ' ' . mysqli_error($conn));

    // Success message using JavaScript dialog
    echo '<script>
            alert("Match created successfully");
            window.location.href = "index.php"; // Redirect to the home page or another page
          </script>';
}

// Fetch match locations from the database
$locationQuery = "SELECT * FROM match_location";
$locationResult = mysqli_query($conn, $locationQuery);

?>

<div class="container">
    <form class="match-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <h2>Create New Match</h2>
        <label for="match-name" class="form-label">Match Name:</label>
        <input type="text" id="match-name" name="match_name" class="form-control" required>

        <label for="date" class="form-label">Date:</label>
        <input type="date" id="date" name="match_date" class="form-control" required>

        <label for="time-from" class="form-label">Time From:</label>
        <input type="time" id="time-from" name="time_from" class="form-control" required>

        <label for="time-to" class="form-label">Time To:</label>
        <input type="time" id="time-to" name="time_to" class="form-control" required>

        <label for="min-players" class="form-label">Minimum Number of Players:</label>
        <input type="number" id="min-players" name="min_players" class="form-control" required>

        <label for="max-players" class="form-label">Maximum Number of Players:</label>
        <input type="number" id="max-players" name="max_players" class="form-control" required>

        <label for="location" class="form-label">Match Location:</label>
        <select id="location" name="match_location" class="form-control" required>
            <?php
            // Display match locations in the dropdown list
            while ($locationRow = mysqli_fetch_assoc($locationResult)) {
                echo "<option value='{$locationRow['venue_name']}'>{$locationRow['venue_name']}</option>";
            }

            // Free the result set
            mysqli_free_result($locationResult);
            ?>
        </select>

        <div class="button-container">
            <input type="submit" value="Create Match" class="btn btn-primary">
            <button type="button" onclick="clearForm()" class="btn btn-secondary">Clear</button>
        </div>
    </form>

    <?php
    // Display error message if any
    echo '<p class="error">' . $error . '</p>';
    ?>
</div>

<?php require_once 'footer.php'; ?>