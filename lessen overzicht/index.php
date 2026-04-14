<?php
// =========================
// DATABASE CONNECTIE
// =========================
$conn = new mysqli("localhost", "root", "", "fitness");

if ($conn->connect_error) {
    die("Database verbinding mislukt");
}

// =========================
// INPUT (SEARCH + DATUM)
// =========================
$zoek = $_GET['zoek'] ?? "";
$datum = $_GET['datum'] ?? "";
$error = $_GET['error'] ?? "";

// =========================
// CHECK OF DATUM KOLOM BESTAAT
// voorkomt crash!
// =========================
$kolomBestaat = false;
$check = $conn->query("SHOW COLUMNS FROM pakketten LIKE 'datum'");
if ($check && $check->num_rows > 0) {
    $kolomBestaat = true;
}

// =========================
// QUERY OPBOUWEN
// =========================
$sql = "SELECT * FROM pakketten WHERE 1";

// zoek op naam
if ($zoek != "") {
    $sql .= " AND naam LIKE '%".$conn->real_escape_string($zoek)."%'";
}

// alleen datum gebruiken als kolom bestaat
if ($datum != "" && $kolomBestaat) {
    $sql .= " AND datum = '".$conn->real_escape_string($datum)."'";
}

// query uitvoeren
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>FitForFun Lessen</title>
<link rel="stylesheet" href="style.css">

<style>
/* EXTRA FIX VOOR RESPONSIVE */
.table-wrapper{
    width:100%;
    overflow-x:auto;
}

.inline-delete{
    display:inline-block;
}

/* ERROR BOX */
.error-box{
    background: rgba(255,0,0,0.2);
    padding:12px;
    border-radius:10px;
    margin:15px 0;
}

/* MOBILE */
@media(max-width:600px){
    table{
        font-size:12px;
    }

    .edit-btn, .delete-btn{
        width:auto;
        padding:6px 8px;
    }

    h1{
        font-size:26px;
    }
}
</style>

</head>

<body>

<div class="container">

<!-- =========================
HEADER
========================= -->
<div class="header">
    <h1>FitForFun Lessen</h1>
    <p>Overzicht van alle lessen</p>
</div>

<!-- =========================
ZOEKEN
========================= -->
<form method="GET" class="edit-form">

<input type="text" name="zoek"
placeholder="Zoek les..."
value="<?= htmlspecialchars($zoek) ?>">

<input type="date" name="datum"
value="<?= htmlspecialchars($datum) ?>">

<button class="button">Zoeken</button>

</form>

<!-- =========================
ERROR VAN DELETE
========================= -->
<?php if($error): ?>
<div class="error-box">
    <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<!-- =========================
HAPPY / UNHAPPY FLOW
========================= -->
<?php if($result->num_rows == 0): ?>

<!--  UNHAPPY -->
<div class="error-box">
     Geen lessen gevonden
</div>

<?php else: ?>

<!-- ✅ HAPPY -->
<div class="stats-container">
    <div class="stats">
        <p>Resultaten gevonden</p>
        <h2><?= $result->num_rows ?></h2>
    </div>
</div>

<!-- =========================
TABEL
========================= -->
<div class="table-wrapper">
<table>

<tr>
<th>Naam</th>
<th>Datum</th>
<th>Prijs</th>
<th>Acties</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>

<td><?= htmlspecialchars($row['naam']) ?></td>
<td><?= $kolomBestaat ? $row['datum'] : "Geen datum" ?></td>
<td>€<?= htmlspecialchars($row['prijs']) ?></td>

<td>

<!-- EDIT -->
<a class="edit-btn"
href="update.php?id=<?= $row['id'] ?>">
Wijzig
</a>

<!-- DELETE -->
<form class="inline-delete"
method="POST"
action="delete.php"
onsubmit="return confirm('Weet je het zeker?')">

<input type="hidden" name="id"
value="<?= $row['id'] ?>">

<button class="delete-btn">
Delete
</button>

</form>

</td>
</tr>
<?php endwhile; ?>

</table>
</div>

<?php endif; ?>

</div>
</body>
</html>