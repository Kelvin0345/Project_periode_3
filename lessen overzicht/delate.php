<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "fitness";

// Verbinding maken met de database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Database verbinding mislukt");

// Controleren of er een delete request is via GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Zorgt dat het een veilig nummer is

    // Verwijder de les uit de database
    $stmt = $conn->prepare("DELETE FROM pakketten WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Redirect terug naar index.php om refresh-probleem te voorkomen
    header("Location: index.php");
    exit;
} else {
    // Geen id opgegeven, terugsturen naar index.php
    header("Location: index.php");
    exit;
}
?>