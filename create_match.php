<?php 
$title = 'Contact';
require_once 'header.php';
?>

<div class="container">
    <form class="match-form">
        <h2>Create New Match</h2>
        <div class="mb-3">
            <label for="match-name" class="form-label">Match Name:</label>
            <input type="text" id="match-name" name="match_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date:</label>
            <input type="date" id="date" name="match_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="time-from" class="form-label">Time From:</label>
            <input type="time" id="time-from" name="time_from" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="time-to" class="form-label">Time To:</label>
            <input type="time" id="time-to" name="time_to" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="min-players" class="form-label">Minimum Number of Players:</label>
            <input type="number" id="min-players" name="min_players" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="max-players" class="form-label">Maximum Number of Players:</label>
            <input type="number" id="max-players" name="max_players" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Match Location:</label>
            <input type="text" id="location" name="match_location" class="form-control" required>
        </div>

        <div class="button-container">
            <input type="submit" value="Create Match" class="btn btn-primary">
            <button type="button" onclick="clearForm()" class="btn btn-secondary">Clear</button>
        </div>
    </form>
</div>

<?php require_once 'footer.php';?>