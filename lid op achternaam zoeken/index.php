<?php
// Onderhoudsmodus
$maintenance = false; // Zet op true om onderhoud te activeren

// Simuleer fout bij laden ledenlijst (unhappy scenario)
$simulateError = false;

if ($maintenance) {
    try {
        // Simuleer fout in onderhoudspagina
        if (rand(1, 10) === 1) {
            throw new Exception("Onderhoudspagina kon niet geladen worden.");
        }

        echo '
        <!DOCTYPE html>
        <html lang="nl">
        <head>
            <meta charset="UTF-8">
            <title>Website in onderhoud</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body class="maintenance">
            <div class="maintenance-box">
                <h1>Website in onderhoud</h1>
                <p>Momenteel is deze website in onderhoud.</p>
            </div>
        </body>
        </html>';
        exit;

    } catch (Exception $e) {
        echo '
        <!DOCTYPE html>
        <html lang="nl">
        <head>
            <meta charset="UTF-8">
            <title>Fout</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body class="maintenance">
            <div class="maintenance-box">
                <h1>Foutmelding</h1>
                <p>Deze website is tijdelijk niet beschikbaar.</p>
            </div>
        </body>
        </html>';
        exit;
    }
}

// Ledenlijst ophalen
try {
    if ($simulateError) {
        throw new Exception("Databasefout: ledenlijst kon niet geladen worden.");
    }

    $leden = [
        ["voornaam" => "Jan", "achternaam" => "Jansen"],
        ["voornaam" => "Piet", "achternaam" => "Peters"],
        ["voornaam" => "Karin", "achternaam" => "Klaassen"],
        ["voornaam" => "Sofie", "achternaam" => "Smit"],
    ];

} catch (Exception $e) {
    $leden = null;
    $errorMessage = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Ledenoverzicht</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Ledenoverzicht</h1>

<?php if (isset($errorMessage)): ?>
    <div class="error-box">
        <p><?= $errorMessage ?></p>
    </div>
<?php else: ?>

<div class="search-container">
    <input type="text" id="searchInput" placeholder="Zoek op achternaam...">
</div>

<p id="noResults" class="hidden">Geen leden gevonden.</p>

<table id="ledenTable">
    <thead>
        <tr>
            <th>Voornaam</th>
            <th>Achternaam</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($leden as $lid): ?>
            <tr>
                <td><?= $lid["voornaam"] ?></td>
                <td><?= $lid["achternaam"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>

<script src="script.js"></script>
</body>
</html>
