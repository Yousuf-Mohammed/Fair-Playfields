<?php 
$title = 'Home Page';
require_once 'header.php';
?>

<div class="container">
    <main class="main">
        <section class="matches">
            <h2>Upcoming Matches</h2>
            <p>
                Upcoming matches content here
            </p>
        </section>
        <section class="matches">
            <h2>Current Matches</h2>
            <p>
                Current matches content here
            </p>
        </section>
        <section class="players">
            <h2>Top Players</h2>
            <p>
                Top players content here
            </p>
        </section>
    </main>
    <aside class="sidebar">
        <h3>Sidebar</h3>
        <ul>
            <li><a href="#">View Current Matches</a></li>
            <li><a href="create_match.php">Create New Matches</a></li>
            <li><a href="match_location.php">Add New Location</a></li>
            <li><a href="profile.php">My Profile</a></li>
        </ul>
    </aside>
</div>

<?php require_once 'footer.php';?>