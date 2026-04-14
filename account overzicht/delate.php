<?php
$conn = new mysqli("localhost", "root", "", "fitness");

session_start();

if (!isset($_GET['id'])) {
    header("Location: index.php?error=1");
    exit;
}

$id = intval($_GET['id']);

// Check of les bestaat
if (!isset($_SESSION['users'][$id])) {
    header("Location: index.php?error=1");
    exit;
}

// Verwijder de les
unset($_SESSION['users'][$id]);

// Herindexeren zodat de array netjes blijft
$_SESSION['users'] = array_values($_SESSION['users']);

header("Location: index.php?deleted=1");
exit;
?>

?>
