```php
<?php
include('config/config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";
$pdo = new PDO($dsn, $dbUser, $dbPass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$display = 'none';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sql = "INSERT INTO accountenoverzicht
    (
        Voornaam,
        Tussenvoegsel,
        Achternaam,
        Relatienummer,
        Mobiel,
        Email,
        Isactief,
        Opmerking
    )
    VALUES
    (
        :voornaam,
        :tussenvoegsel,
        :achternaam,
        :relatienummer,
        :mobiel,
        :email,
        :isactief,
        :opmerking
    )";

    $statement = $pdo->prepare($sql);

    $statement->bindValue(':voornaam', $_POST['voornaam']);
    $statement->bindValue(':tussenvoegsel', $_POST['tussenvoegsel']);
    $statement->bindValue(':achternaam', $_POST['achternaam']);
    $statement->bindValue(':relatienummer', $_POST['relatienummer'], PDO::PARAM_INT);
    $statement->bindValue(':mobiel', $_POST['mobiel']);
    $statement->bindValue(':email', $_POST['email']);
    $statement->bindValue(':isactief', $_POST['isactief'], PDO::PARAM_INT);
    $statement->bindValue(':opmerking', $_POST['opmerking']);

    $statement->execute();

    $display = 'flex';
    header('Refresh:3; index.php');
}
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account toevoegen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-3">

    <div class="row justify-content-center" style="display:<?= $display ?? 'none'; ?>">
        <div class="col-6">
            <div class="alert alert-success text-center">
                Account succesvol toegevoegd. U wordt teruggestuurd naar de indexpagina.
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-6">
            <h3 class="text-primary">Nieuw account toevoegen</h3>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-6">

            <form action="create.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Voornaam</label>
                    <input name="voornaam" type="text" class="form-control"
                        value="<?= $_POST['voornaam'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tussenvoegsel</label>
                    <input name="tussenvoegsel" type="text" class="form-control"
                        value="<?= $_POST['tussenvoegsel'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Achternaam</label>
                    <input name="achternaam" type="text" class="form-control"
                        value="<?= $_POST['achternaam'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Relatienummer</label>
                    <input name="relatienummer" type="number" class="form-control"
                        value="<?= $_POST['relatienummer'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mobiel</label>
                    <input name="mobiel" type="text" class="form-control"
                        value="<?= $_POST['mobiel'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control"
                        value="<?= $_POST['email'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Actief</label>
                    <select name="isactief" class="form-control">
                        <option value="1">Ja</option>
                        <option value="0">Nee</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Opmerking</label>
                    <textarea name="opmerking" class="form-control"><?= $_POST['opmerking'] ?? '' ?></textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Opslaan</button>
                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>
```
