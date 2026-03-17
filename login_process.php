<?php

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

/* test account */
$correct_email = "admin@test.com";
$correct_password = "1234";

/* controleren */
if ($email == $correct_email && $password == $correct_password) {

    $_SESSION['user'] = $email;

    header("Location: index.html");
    exit();

} else {

    header("Location: login.php?error=1");
    exit();

}