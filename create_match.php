<?php 
$title='Contact';
require_once 'template/header.php'
?>


<div class="container">
    <form class="match-form" action="process_match.php" method="post">
        <h2>Create New Match</h2>
        <label for="match-name">Match Name:</label>
        <input type="text" id="match-name" name="match_name" required><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="match_date" required><br>

        <label for="time-from">Time From:</label>
        <input type="time" id="time-from" name="time_from" required><br>

        <label for="time-to">Time To:</label>
        <input type="time" id="time-to" name="time_to" required><br>

        <label for="min-players">Minimum Number of Players:</label>
        <input type="number" id="min-players" name="min_players" required><br>

        <label for="max-players">Maximum Number of Players:</label>
        <input type="number" id="max-players" name="max_players" required><br>

        <label for="location">Match Location:</label>
        <input type="text" id="location" name="match_location" required><br>

        <div class="button-container">
            <input type="submit" value="Create Match">
            <button type="button" onclick="clearForm()">Clear</button>
        </div>
    </form>
</div>
<?php require_once 'template/footer.php'?>