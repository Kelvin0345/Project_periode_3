<?php

// Database gegevns laden
include('config/config.php');

// Dsn aanmaken
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

// Controleren of het formulier is verstuurd
if (isset($_POST['submit'])) {

    // Ingevoerde gegevens opschonen
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // SQL query om gegevens te wijzigen
    $sql = "UPDATE Reservering AS RS
            SET Voornaam = :voornaam,
                Tussenvoegsel = :tussenvoegsel,
                Achternaam = :achternaam,
                Nummer = :nummer,
                Datum = :datum,
                Tijd = :tijd,
                Reserveringstatus = :Reserveringstatus
            WHERE RS.Id = :id";
    
    // Query voorbereiden
    $statement = $pdo->prepare($sql);
    
    // Waarden koppelen
    $statement->bindValue(':voornaam', $_POST['Voornaam'], PDO::PARAM_STR);
    $statement->bindValue(':tussenvoegsel', $_POST['Tussenvoegsel'], PDO::PARAM_STR);
    $statement->bindValue(':achternaam', $_POST['Achternaam'], PDO::PARAM_STR);
    $statement->bindValue(':nummer', $_POST['Nummer'], PDO::PARAM_STR);
    $statement->bindValue(':datum', $_POST['Datum'], PDO::PARAM_STR);
    $statement->bindValue(':tijd', $_POST['Tijd'], PDO::PARAM_STR);
    $statement->bindValue(':Reserveringstatus', $_POST['Reserveringstatus'], PDO::PARAM_STR);
    $statement->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
    
    // Statement uitvoeren 
    $statement->execute();

    // Succes melding tonen
    $display = 'flex';

    // Na 3 seconden terug naar index
    header('Refresh:3; index.php');

} else {
    
    // Gegevens ophalen van  reservering
    $sql = "SELECT RS.Id,
                   RS.Voornaam,
                   RS.Tussenvoegsel,
                   RS.Achternaam,
                   RS.Nummer,
                   RS.Datum,
                   RS.Tijd,
                   RS.Reserveringstatus
            FROM Reservering AS RS
            WHERE RS.Id = :id";
    
    // Query voorbereiden
    $statement = $pdo->prepare($sql);
    // ID uit URL halen
    $statement->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    // Uitvoeren
    $statement->execute();
    // Resultaat ophalen
    $result = $statement->fetch(PDO::FETCH_OBJ);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update formulier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- container van de update -->
    <div class="container mt-3">

        <!-- tekst van Wijzigen Reservering -->
        <div class="row justify-content-center">
            <div class="col-6">
                <h3 class="text-primary">Wijzig Reservering:</h3>
            </div>
        </div>

        <!-- Terugsturen naar de index -->
        <div class="row justify-content-center" style="display:<?= $display ?? 'none'; ?>">
            <div class="col-6">
                <div class="alert alert-success text-center">
                    De gegevens zijn gewijzigd. U wordt teruggestuurd naar de index-pagina
                </div>
            </div>
        </div>

        <!-- div voor de formulier -->
        <div class="row justify-content-center">
            <div class="col-6">
                <!-- Formulier voor aanpassen -->
                <form action="update.php" method="POST">
                    <!-- VOORNAAM -->
                    <div class="mb-3">
                        <label class="form-label">Voornaam:</label>
                        <input name="Voornaam" type="text" class="form-control"
                            value="<?= $result->Voornaam ?? $_POST['Voornaam'] ?? '' ?>" required>
                    </div>

                    <!-- Tussenvoegsel -->
                    <div class="mb-3">
                        <label class="form-label">Tussenvoegsel:</label>
                        <input name="Tussenvoegsel" type="text" class="form-control"
                            value="<?= $result->Tussenvoegsel ?? $_POST['Tussenvoegsel'] ?? '' ?>" >
                    </div>

                    <!-- Achternaam -->
                    <div class="mb-3">
                        <label class="form-label">Achternaam:</label>
                        <input name="Achternaam" type="text" class="form-control"
                            value="<?= $result->Achternaam ?? $_POST['Achternaam'] ?? '' ?>" required>
                    </div>

                    <!-- Nummer -->
                    <div class="mb-3">
                        <label class="form-label">Nummer:</label>
                        <input name="Nummer" type="text" class="form-control"
                            value="<?= $result->Nummer ?? $_POST['Nummer'] ?? '' ?>"required>
                    </div>

                    <!-- Datum -->
                    <div class="mb-3">
                        <label class="form-label">Datum:</label>
                        <input name="Datum" type="date" class="form-control"
                            value="<?= $_POST['Datum'] ?? $result->Datum ?? '' ?>" required>
                    </div>

                    <!-- Tijd -->
                    <div class="mb-3">
                        <label class="form-label">Tijd:</label>
                        <input name="Tijd" type="text" class="form-control"
                            value="<?= $result->Tijd ?? $_POST['Tijd'] ?? '' ?>" required>
                    </div>

                    <!-- Reserveringstatus -->
                    <div class="mb-3">
                        <label class="form-label">Reserveringstatus:</label>
                        <select name="Reserveringstatus" class="form-control" required>
                            <option value="">Kies een status</option>
                            <option value="Vrij" <?= ($_POST['Reserveringstatus'] ?? $result->Reserveringstatus ?? '') == 'Vrij' ? 'selected' : '' ?>>Vrij</option>
                            <option value="Bezet" <?= ($_POST['Reserveringstatus'] ?? $result->Reserveringstatus ?? '') == 'Bezet' ? 'selected' : '' ?>>Bezet</option>
                            <option value="Gereserveerd" <?= ($_POST['Reserveringstatus'] ?? $result->Reserveringstatus ?? '') == 'Gereserveerd' ? 'selected' : '' ?>>Gereserveerd</option>
                            <option value="Geannuleerd" <?= ($_POST['Reserveringstatus'] ?? $result->Reserveringstatus ?? '') == 'Geannuleerd' ? 'selected' : '' ?>>Geannuleerd</option>
                        </select>
                    </div>

                    <!-- Id selecteren als wijzigen -->
                    <input name="id" type="hidden" value="<?= $result->Id ?? $_POST['id'] ?>">
                  
                    <!-- Vestuur knop -->
                    <div class="d-grid">
                        <button name="submit" class="btn btn-primary btn-lg">Verstuur</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</body>

</html>