<?php
session_start();
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 1 && $_SESSION['role'] != 2)) {
    // If the user is not an admin, redirect to the login page or another page
    header("location: login.php");
    exit;
}