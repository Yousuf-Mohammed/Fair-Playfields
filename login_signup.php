<?php
$title = 'Login and Sign Up';
require_once 'header.php';

// Include the connection file
include 'connect.php';
?>

<div class="container">
    <section class="login-section">
        <h2>Log in</h2>
        <form action="login_code.php" method="post" id="loginForm">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
            <button type="button" class="btn btn-secondary" onclick="clearLoginForm()">Clear</button>
            <a href="forgot_password.php">Forgot password?</a>
        </form>
    </section>


    <section class="signup-section">
        <h2>Sign Up</h2>
        <form action="signup_code.php" method="post" id="signupForm" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="full-name" class="form-label">Full Name:</label>
                <input type="text" id="full-name" name="full_name" class="form-control" placeholder="Full Name"
                    required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                    required>
            </div>

            <div class="mb-3">
                <label for="birth_date" class="form-label">Birth Date:</label>
                <input type="date" id="birth_date" name="birth_date" class="form-control">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" id="address" name="address" placeholder="Address">
            </div>

            <div class="mb-3">
                <label for="user-type">User Type:</label>
                <select id="user-type" name="user_type" onchange="showPosition(this.value)">
                    <option value="select">Select</option>
                    <option value="player">Player</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="mb-3" id="position" style="display:none;">
                <label for="player-position">First Position:</label>
                <select id="player-position-one" name="player_position_priority_one">
                    <option value="goalkeeper">Goalkeeper</option>
                    <option value="defender">Defender</option>
                    <option value="midfielder">Midfielder</option>
                    <option value="attacker">Attacker</option>
                </select>
                <label for="player-rate-one">Rate (1-7):</label>
                <input type="number" id="player-rate-one" name="player_rate_one" min="1" max="7" /><br>

                <div class="mb-3">
                    <label for="player-position">Second Position:</label>
                    <select id="player-position-two" name="player_position_priority_two">
                        <option value="goalkeeper">Goalkeeper</option>
                        <option value="defender">Defender</option>
                        <option value="midfielder">Midfielder</option>
                        <option value="attacker">Attacker</option>
                    </select>
                    <label for="player-rate-two">Rate (1-7):</label>
                    <input type="number" id="player-rate-two" name="player_rate_two" min="1" max="7" /><br>
                </div>
            </div>


            <div class="mb-3">
                <label for="profile-picture" class="form-label">Profile Picture:</label>
                <input type="file" id="profile-picture" name="profile_picture" class="form-control"
                    accept="image/png, image/jpeg">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Sign Up</button>
                <button type="button" class="btn btn-secondary" onclick="clearSignupForm()">Clear</button>
            </div>


        </form>
    </section>
</div>

<?php require_once 'footer.php'; ?>