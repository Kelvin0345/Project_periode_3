<?php
session_start();

if (isset($_SESSION['user_id'])) {
    session_unset();

    if (session_destroy()) {
        header("Location: index.php");
        exit();
    } else {
        header("Location: login.php?error=logout_failed");
        exit();
    }
} else {
    header("Location: login.php?error=not_logged_in");
    exit();
}
?>