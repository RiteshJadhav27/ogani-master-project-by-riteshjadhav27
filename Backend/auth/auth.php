<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['username']);
}

function getUsername() {
    return isLoggedIn() ? $_SESSION['username'] : null;
}
?>
