<?php
include('config/config.php');


$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";




$pdo = new PDO($dsn, $dbUser, $dbPass);

if (isset($_POST['submit'])) {
    // Er is submit knop
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // var_dump($_POST);

    // Sql update
    $sql = "UPDATE   Reservering` as RS
        SET      Voonaam = :voornaam
                 ,Tussenvoegsel = :tussenvoegsel
                 ,Achternaam = :achternaam
                 ,Nummer = :nummer
                 ,Datum = :datum
                 ,Tijd = :tijd
                 ,Reserveringstatus = :Reserveringstatus
        WHERE RS.Id = :id";

    // Statement prepareren
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':voornaam', $_POST['Voornaam'], PDO::PARAM_STR);
    $statement->bindValue(':tussenvoegsel', $_POST['Tussenvoegsel'], PDO::PARAM_STR);
    $statement->bindValue(':achternaam', $_POST['Achternaam'], PDO::PARAM_STR);
    $statement->bindValue(':nummer', $_POST['Nummer'], PDO::PARAM_INT);
    $statement->bindValue(':datum', $_POST['Datum'], PDO::PARAM_INT);
    $statement->bindValue(':tijd', $_POST['Tijd'], PDO::PARAM_STR);
    $statement->bindValue(':Reserveringstatus', $_POST['Reserveringstatus'], PDO::PARAM_STR);
    $statement->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

    $statement->execute();

    //Melding
    $display = 'flex';

    header('Refresh:3; index.php');

} else {
    // we komen op de update pagina




    $sql = "SELECT RS.Id
              ,RS.Voornaam
              ,RS.Tussenvoegsel
              ,RS.Achternaam
              ,RS.Nummer
              ,RS.Tijd
              ,RS.Reserveringstatus
              ,DATE_FORMAT (RS.Tijd, '%d-%m-%Y') 
        FROM Reservering AS RS
        WHERE RS.Id = :id";

    $statement = $pdo->prepare($sql);

    $statement->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

    $statement->execute();


    //Array

    $result = $statement->fetch(PDO::FETCH_OBJ);

    //data selecteren

    // var_dump($result);



}
?>






<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update fomulier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">

        <!-- titel pagina -->
        <div class="row justify-content-center">
            <div class="col-6">
                <h3 class="text-primary">Wijzig Reservering:</h3>
            </div>
        </div>

        <div class="row justify-content-center" style="display:<?= $display ?? 'none'; ?>">
            <div class="col-6">
                <div class="alert alert-succes text-center" role="alert">
                    De gegevens zijn gewijzigd. U wordt teruggestuurd naar de index-pagina
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-6">
                <form action="update.php" method="POST">
                    <div class="mb-3">
                        <label for="inputVoornaam" class="form-label">Voornaam:</label>
                        <input name="Voornaam" placeholder="Vul de voornaam in" type="text" class="form-control"
                            id="inputVoornaam" value="<?= $result->Voornaam ?? $_POST['Voornaam'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputTussenvoegsel" class="form-label">Tussenvoegsel:</label>
                        <input name="Tussenvoegsel" placeholder="Vul de tussenvoegsel in" type="text"
                            class="form-control" id="inputTussenvoegsel"
                            value="<?= $result->Tussenvoegsel ?? $_POST['Tussenvoegsel'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputAchternaam" class="form-label">Achternaam:</label>
                        <input name="Achternaam" placeholder="Vul Achternaam in" type="text" class="form-control"
                            id="inputAchternaam" value="<?= $result->Achternaam ?? $_POST['Achternaam'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputNummer" class="form-label">Nummer:</label>
                        <input name="Nummer" placeholder="Vul de Nummer in" type="text" class="form-control"
                            id="inputNummer" value="<?= $result->Nummer ?? $_POST['Nummer'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputDatum" class="form-label">Datum:</label>
                        <input name="Datum" placeholder="Vul de datum in" type="date" class="form-control"
                            id="inputDatum" value="<?= $_POST['Datum'] ?? $result->Datum ?? '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputTijd " class="form-label">Tijd:</label>
                        <input name="Tijd" placeholder="Vul de TIjd in" type="text" class="form-control" id="inputTijd"
                            value="<?= $result->Tijd ?? $_POST['Tijd'] ?>">
                    </div>

                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="inputReserveringstatus" class="form-label">Reserveringstatus:</label>

                            <select name="Reserveringstatus" class="form-control" id="inputReserveringstatus" required>
                                <option value="">Kies een status</option>
                                <option value="Vrij" <?= ($_POST['Reserveringstatus'] ?? $result->Reserveringstatus ?? '') == 'Vrij' ? 'selected' : '' ?>>Vrij</option>
                                <option value="Bezet" <?= ($_POST['Reserveringstatus'] ?? $result->Reserveringstatus ?? '') == 'Bezet' ? 'selected' : '' ?>>Bezet</option>
                                <option value="Gereserveerd" <?= ($_POST['Reserveringstatus'] ?? $result->Reserveringstatus ?? '') == 'Gereserveerd' ? 'selected' : '' ?>>Gereserveerd
                                </option>
                                <option value="Geannuleerd" <?= ($_POST['Reserveringstatus'] ?? $result->Reserveringstatus ?? '') == 'Geannuleerd' ? 'selected' : '' ?>>Geannuleerd
                                </option>
                            </select>
                        </div>

                    </div>

                    <input name="id" type="hidden" value="<?= $result->Id ?? $_POST['id'] ?>">

                    <div class="d-grid gap-2">
                        <button name="submit" type="submit" class="btn btn-primary btn-lg mt-2">Verstuur</button>
                    </div>
                </form>
            </div>
        </div>


        
    </div>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>