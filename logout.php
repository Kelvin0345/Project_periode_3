<?php
session_start();

// Aan en uit Login unhappy scenario
$forceError = false; // true = test, false = normaal

if (isset($_SESSION['is_ingelogd']) && $_SESSION['is_ingelogd'] == true) {

    if ($forceError) {
        header("Location: index.php?error=logout_failed");
        exit();
    }

    $_SESSION = [];
    session_unset();
    session_destroy();

    header("Location: index.php"); // stuurt user terug naar index.php
    exit();

} else {
    header("Location: login.php?error=not_logged_in"); // error melding voor uitloggen
    exit();
}
?>