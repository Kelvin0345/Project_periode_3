<?php
$conn = new mysqli("localhost", "root", "", "fitness");

// ID ophalen
$id = $_GET['id'] ?? null;

if(!$id){
    header("Location: lessen.php");
    exit;
}

// Les ophalen
$stmt = $conn->prepare("SELECT * FROM pakketten WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$les = $stmt->get_result()->fetch_assoc();

$error = "";

// =========================
// UPDATE LOGICA
// =========================
if(isset($_POST['update'])){

    $naam = trim($_POST['naam']);
    $prijs = $_POST['prijs'];

    // VALIDATIE
    if($naam == "" || $prijs == ""){
        $error = "De les kan niet worden gewijzigd";
    } else {

        // UPDATE QUERY
        $stmt = $conn->prepare(
        "UPDATE pakketten SET naam=?, prijs=? WHERE id=?"
        );

        $stmt->bind_param("sdi", $naam, $prijs, $id);

        if($stmt->execute()){
            header("Location: lessen.php");
            exit;
        } else {
            $error = "Update mislukt";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container">

<h1>Les wijzigen</h1>

<?php if($error): ?>
<div class="error-box"><?= $error ?></div>
<?php endif; ?>

<form method="POST" class="edit-form">

<input type="text" name="naam"
value="<?= htmlspecialchars($les['naam']) ?>">

<input type="number" step="0.01" name="prijs"
value="<?= $les['prijs'] ?>">

<button class="button" name="update">
Opslaan
</button>

</form>

<a href="lessen.php">← Terug</a>

</div>
</body>
</html>