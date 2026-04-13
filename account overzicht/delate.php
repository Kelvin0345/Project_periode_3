<?php
session_start();

$id = $_GET['id'] ?? null;

/* =========================
   SCENARIO 1: SUCCES
========================= */
if(isset($_SESSION['users'][$id])){
    unset($_SESSION['users'][$id]);
    $_SESSION['users'] = array_values($_SESSION['users']);

    $message = "Account succesvol verwijderd";
}

/* =========================
   SCENARIO 2: ERROR
========================= */
else {
    $message = "Het account kan niet worden verwijderd";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>Delete account</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Account verwijderen</h1>

<p><?= $message ?></p>

<br>
<a href="index.php">← Terug naar overzicht</a>

</body>
</html>