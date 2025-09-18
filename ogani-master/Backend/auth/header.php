<?php
session_start(); // Start session
include './auth.php'; // Include auth functions
?>

<div class="header__top__right__auth">
    <?php if (isLoggedIn()): ?>
        <div class="dropdown">
            <a href="#" class="dropbtn"><i class="fa fa-user"></i> Hi, <?php echo getUsername(); ?>!</a>
            <div class="dropdown-content">
                <a href="logout.php">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <a href="sign.html"><i class="fa fa-user"></i> Login</a>
    <?php endif; ?>
</div>


<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropbtn {
        text-decoration: none;
        color: black;
        padding: 10px;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 120px;
        box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 10px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>



