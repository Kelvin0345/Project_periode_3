<?php
session_start();

// check of gebruiker ingelogd is
if (isset($_SESSION['user_id'])) {

    // probeer uitloggen
    if (session_destroy()) {
        // happy scenario
        header("Location: index.php");
        exit();
    } else {
        // unhappy scenario
        header("Location: dashboard.php?error=logout_failed");
        exit();
    }

} else {
    // geen sessie → ook fout
    header("Location: index.php?error=not_logged_in");
    exit();
}