<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "fitness";

// Verbinding maken met database
$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error) die("Database verbinding mislukt");

$error = "";

// Controleren of formulier is verzonden
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Waarden ophalen en spaties verwijderen
    $naam = trim($_POST['naam']);
    $feature1 = trim($_POST['feature1']);
    $feature2 = trim($_POST['feature2']);
    $beschrijving = trim($_POST['beschrijving']);
    $prijs = trim($_POST['prijs']);

    // Validatie: controleren of alles is ingevuld
    if($naam == "" || $feature1 == "" || $feature2 == "" || $beschrijving == "" || $prijs == ""){
        $error = "Vul alle velden in.";
    }
    // Controleren of prijs een geldig getal is
    elseif(!is_numeric($prijs)) {
        $error = "Prijs moet een nummer zijn.";
    }
    else {
        // Prepared statement gebruiken voor veiligheid
        $stmt = $conn->prepare("INSERT INTO pakketten (naam, feature1, feature2, beschrijving, prijs) VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssssd", $naam, $feature1, $feature2, $beschrijving, $prijs);

        // Query uitvoeren
        if($stmt->execute()){
            // Terugsturen naar homepage met succesmelding
            header("Location: index.php?success=1");
            exit;
        } else {
            $error = "Fout bij opslaan.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Nieuwe les</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Nieuwe les toevoegen</h2>

<?php 
// Foutmelding tonen als er een probleem is
if($error != "") echo "<div class='error'>$error</div>"; 
?>

<form method="POST">

<label>Naam:</label>
<input type="text" name="naam" value="<?php echo isset($_POST['naam']) ? htmlspecialchars($_POST['naam']) : ""; ?>">

<label>Feature 1:</label>
<input type="text" name="feature1" value="<?php echo isset($_POST['feature1']) ? htmlspecialchars($_POST['feature1']) : ""; ?>">

<label>Feature 2:</label>
<input type="text" name="feature2" value="<?php echo isset($_POST['feature2']) ? htmlspecialchars($_POST['feature2']) : ""; ?>">

<label>Beschrijving:</label>
<textarea name="beschrijving"><?php echo isset($_POST['beschrijving']) ? htmlspecialchars($_POST['beschrijving']) : ""; ?></textarea>

<label>Prijs (€):</label>
<input type="number" step="0.01" name="prijs" value="<?php echo isset($_POST['prijs']) ? $_POST['prijs'] : ""; ?>">

<button type="submit" class="button">Opslaan</button>

</form>

</div>

</body>
</html>