<?php 
$title='Login';
require_once 'template/header.php'
?>

<div class="container">
    <section class="login-section">
        <h2>Log in</h2>
        <form action="login_code.php" method="post" id="loginForm">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required><br>

            <button type="submit">Login</button>
            <button type="button" onclick="clearLoginForm()">Clear</button>
            <a href="forgot_password.php">Forgot password?</a>
        </form>
    </section>

    <section class="signup-section">
        <h2>Sign Up</h2>
        <form action="signup_code.php" method="post" id="signupForm">
            <label for="full-name">Full Name:</label>
            <input type="text" id="full-name" name="full_name" placeholder="Full Name" /><br>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" placeholder="Phone" /><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" /><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required><br>

            <label for="birthdate">Birth Date:</label>
            <input type="date" id="birthdate" name="birthdate" /><br><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Address" /><br>

            <label for="user-type">User Type:</label>
            <select id="user-type" name="user_type" onchange="showPosition(this.value)">
                <option value="player">Player</option>
                <option value="admin">Admin</option>
            </select><br>
            <div id="position" style="display:none;">
                <label for="player-position">First Position:</label>
                <select id="player-position" name="player_position_priority_one">
                    <option value="goalkeeper">Goalkeeper</option>
                    <option value="defender">Defender</option>
                    <option value="midfielder">Midfielder</option>
                    <option value="attacker">Attacker</option>
                </select><label for="player-rate-one">Rate (1-7):</label>
                <input type="number" id="player-rate-one" name="player_rate_one" min="1" max="7" /><br>

                <label for="player-position">Secound Position:</label>
                <select id="player-position" name="player_position_priority_two">
                    <option value="goalkeeper">Goalkeeper</option>
                    <option value="defender">Defender</option>
                    <option value="midfielder">Midfielder</option>
                    <option value="attacker">Attacker</option>
                </select><label for="player-rate-two">Rate (1-7):</label>
                <input type="number" id="player-rate-two" name="player_rate_two" min="1" max="7" /><br>
            </div>
            <label for="picture">Profile Picture:</label>
            <input type="file" id="profile-picture" name="profile_picture" accept="image/png, image/jpeg">
            <br><br>
            <button type="submit">Sign Up</button>
            <button type="button" onclick="clearSignupForm()">Clear</button>
        </form>
    </section>
</div>
<?php require_once 'template/footer.php'?>