<?php
include('config/config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$display = 'none';
$foutmelding = '';

if (isset($_POST['submit'])) {

    $sql = "UPDATE Medewerkers SET
                Voornaam        = :voornaam,
                Tussenvoegsel   = :tussenvoegsel,
                Achternaam      = :achternaam,
                Nummer          = :nummer,
                Medewerkersoort = :medewerkersoort
            WHERE Id = :id";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $_POST['idMedewerker'], PDO::PARAM_INT);
    $statement->bindValue(':voornaam', $_POST['voornaamMedewerker'], PDO::PARAM_STR);
    $statement->bindValue(':tussenvoegsel', $_POST['tussenvoegselMedewerker'], PDO::PARAM_STR);
    $statement->bindValue(':achternaam', $_POST['achternaamMedewerker'], PDO::PARAM_STR);
    $statement->bindValue(':nummer', $_POST['nummerMedewerker'], PDO::PARAM_STR);
    $statement->bindValue(':medewerkersoort', $_POST['medewerkerSoort'], PDO::PARAM_STR);

    try {
    
    //throw new PDOException('Test fout');    
    $statement->execute();

        $display = 'flex';
        header('Refresh: 3; url=index.php');

    } catch (PDOException $e) {
        $foutmelding = 'Er is iets misgegaan bij het opslaan.';
    }

} else {
    $sql = "SELECT Id, Voornaam, Tussenvoegsel, Achternaam, Nummer, Medewerkersoort
            FROM Medewerkers
            WHERE Id = :id";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_OBJ);
}
?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wijzig Medewerker – FitForFun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRI14kXlLFvY473l6cr9ZwB07VP4J8tLH7qKQnukguIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/UpdateMO.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;600&display=swap"
        rel="stylesheet">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-logo">FitFor<span>FUN</span></div>
        <ul class="nav-links">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/Lessen.html">Lessen</a></li>
            <li><a href="#vacatures">Vacaturen</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <div class="nav-auth">
            <a href="#" class="btn-registreer">Registreren</a>
            <a href="../login.php" class="btn-login">Login</a>
        </div>
    </nav>

    <!-- PAGINA INHOUD -->
    <div class="medewerkers-pagina">

        <!-- Paginatitel -->
        <div class="medewerkers-header">
            <p class="hero-label">Personeel</p>
            <h1 class="medewerkers-titel">Wijzig <span>Medewerker</span></h1>
        </div>

        <!-- Succes melding (zichtbaar na submit) -->
        <div class="succes-melding" style="display:<?= $display ?>">
            <div class="succes-box">
                <i class="bi bi-check-circle-fill"></i>
                De gegevens zijn opgeslagen. U wordt teruggestuurd naar het overzicht...
            </div>
        </div>

        <?php if (!empty($foutmelding)): ?>
            <div class="error-melding">
                <div class="error-box">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <?= $foutmelding; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Formulier kaart -->
        <div class="formulier-wrapper">

            <!-- Terug knop -->
            <a href="index.php" class="terug-link">
                <i class="bi bi-arrow-left"></i> Terug naar overzicht
            </a>

            <form action="update.php" method="POST" class="create-form">

                <!-- Hidden veld zodat de id ook via POST meekomt -->
                <input type="hidden" name="idMedewerker" value="<?= $result->Id ?? '' ?>">

                <div class="form-rij">
                    <label for="InputVoorNaamMedewerker">Voornaam</label>
                    <input name="voornaamMedewerker" type="text" id="InputVoorNaamMedewerker" placeholder="Bijv. Emma"
                        value="<?= $_POST['voornaamMedewerker'] ?? $result->Voornaam ?? '' ?>">
                </div>

                <div class="form-rij">
                    <label for="InputTussenvoegselMedewerker">Tussenvoegsel</label>
                    <input name="tussenvoegselMedewerker" type="text" id="InputTussenvoegselMedewerker"
                        placeholder="Bijv. van der (optioneel)"
                        value="<?= $_POST['tussenvoegselMedewerker'] ?? $result->Tussenvoegsel ?? '' ?>">
                </div>

                <div class="form-rij">
                    <label for="InputAchternaamMedewerker">Achternaam</label>
                    <input name="achternaamMedewerker" type="text" id="InputAchternaamMedewerker"
                        placeholder="Bijv. Smit"
                        value="<?= $_POST['achternaamMedewerker'] ?? $result->Achternaam ?? '' ?>">
                </div>

                <div class="form-rij">
                    <label for="InputNummerMedewerker">Nummer</label>
                    <input name="nummerMedewerker" type="text" id="InputNummerMedewerker" placeholder="Bijv. 1006"
                        value="<?= $_POST['nummerMedewerker'] ?? $result->Nummer ?? '' ?>">
                </div>

                <div class="form-rij">
                    <label for="InputMedewerkerSoort">Medewerkersoort</label>
                    <select name="medewerkerSoort" id="InputMedewerkerSoort" required>
                        <option value="" disabled>Kies een soort...</option>
                        <?php foreach (['Manager', 'Beheerder', 'Diskmedewerker'] as $soort): ?>
                            <option value="<?= $soort ?>" <?= (($_POST['medewerkerSoort'] ?? $result->Medewerkersoort ?? '') === $soort) ? 'selected' : '' ?>>
                                <?= $soort ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button name="submit" type="submit" class="btn-verstuur">
                    <i class="bi bi-floppy-fill"></i> Wijzigingen opslaan
                </button>

            </form>
        </div>

    </div>

    <!-- SOCIAL MEDIA KNOPPEN -->
    <div class="social-float">
        <a href="#" class="social-btn x-btn">
            <img src="../img/x.png" alt="X">
        </a>
        <a href="#" class="social-btn fb-btn">
            <img src="../img/fb.png" alt="Facebook">
        </a>
        <a href="#" class="social-btn ig-btn">
            <img src="../img/iglogo.png" alt="Instagram">
        </a>
    </div>

    <!-- FOOTER -->
    <footer class="footer" id="contact">
        <div class="footer-inner">
            <div class="footer-logo">FitFor<span>Fun</span></div>
            <p>© 2026 FitForFun Gym. Alle rechten voorbehouden.</p>
            <div class="footer-links">
                <a href="/Medewerkers overzicht/index.php">Medewerkers overzicht</a>
                <a href="#">Privacy</a>
                <a href="#">Vacaturen</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoFeorCglvxywXHG90JcYn3nv7wiPVlz7YVwJrWcXK/BmnVDxM+DzscQbITxT"
        crossorigin="anonymous"></script>
</body>

</html>