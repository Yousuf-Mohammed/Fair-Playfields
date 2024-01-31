<?php 
$title='Contact';
require_once 'template/header.php'
?>


<div class="container">
    <h1 class="title">User Profile</h1>
    <div class="profile-card">
        <div class="left-column">
            <div class="profile-image">
                <img src="profile-image.jpg" alt="Profile Image">
            </div>
            <h3 class="user-name">Full Name</h3>
        </div>
        <div class="right-column">
            <div class="additional-details">
                <p><strong>Age:</strong> [Age]</p>
                <p><strong>Phone Number:</strong> [Phone Number]</p>
                <p><strong>Email:</strong> [Email]</p>
                <p><strong>Address:</strong> [Address]</p>
            </div>
        </div>
    </div>
</div>


<?php require_once 'template/footer.php'?>