<?php
$display = 'none';

if (isset($_POST['submit'])) {
    include('config/config.php');

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
    $pdo = new PDO($dsn, $dbUser, $dbPass);

    $sql = "INSERT INTO Medewerkers
            (
                Id,
                Voornaam,
                Tussenvoegsel,
                Achternaam,
                Nummer,
                Medewerkersoort
            )
            VALUES
            (
                :id,
                :voornaam,
                :tussenvoegsel,
                :achternaam,
                :nummer,
                :medewerkersoort
            )";

    $statement = $pdo->prepare($sql);

$medewerkerSoort = $_POST['medewerkerSoort'] ?? '';

if ($medewerkerSoort == '') {
    die('Kies een medewerkersoort.');
}
    $statement->bindValue(':id', $_POST['idMedewerker'], PDO::PARAM_STR);
    $statement->bindValue(':voornaam', $_POST['voornaamMedewerker'], PDO::PARAM_STR);
    $statement->bindValue(':tussenvoegsel', $_POST['tussenvoegselMedewerker'], PDO::PARAM_STR);
    $statement->bindValue(':achternaam', $_POST['achternaamMedewerker'], PDO::PARAM_STR);
    $statement->bindValue(':nummer', $_POST['nummerMedewerker'], PDO::PARAM_STR);
    $statement->bindValue(':medewerkersoort', $medewerkerSoort, PDO::PARAM_STR);

    $statement->execute();

    $display = 'flex';

    header('Refresh:3; url=index.php');
}
?>

<!doctype html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nieuwe Medewerker – FitForFun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/CreateMO.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;600&display=swap" rel="stylesheet">
  </head>
  <body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-logo">FitFor<span>FUN</span></div>
        <ul class="nav-links">
            <li><a href="/index.html">Home</a></li>
            <li><a href="/Lessen.html">Lessen</a></li>
            <li><a href="#vacatures">Vacaturen</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <div class="nav-auth">
            <a href="#" class="btn-registreer">Registreren</a>
            <a href="#" class="btn-login">Login</a>
        </div>
    </nav>

    <!-- PAGINA INHOUD -->
    <div class="medewerkers-pagina">

        <!-- Paginatitel -->
        <div class="medewerkers-header">
            <p class="hero-label">Personeel</p>
            <h1 class="medewerkers-titel">Nieuwe <span>Medewerker</span></h1>
        </div>

        <!-- Succes melding (zichtbaar na submit) -->
        <div class="succes-melding" style="display:<?= $display ?? 'none'; ?>">
            <div class="succes-box">
                <i class="bi bi-check-circle-fill"></i>
                De gegevens zijn opgeslagen. U wordt teruggestuurd naar het overzicht...
            </div>
        </div>

        <!-- Formulier kaart -->
        <div class="formulier-wrapper">

            <!-- Terug knop -->
            <a href="index.php" class="terug-link">
                <i class="bi bi-arrow-left"></i> Terug naar overzicht
            </a>

            <form action="create.php" method="POST" class="create-form">

                <div class="form-rij">
                    <label for="InputIdMedewerker">Medewerker ID</label>
                    <input name="idMedewerker"
                           placeholder="Bijv. 6"
                           type="text"
                           id="InputIdMedewerker"
                           value="<?= $_POST['idMedewerker'] ?? '' ?>">
                </div>

                <div class="form-rij">
                    <label for="InputVoorNaamMedewerker">Voornaam</label>
                    <input name="voornaamMedewerker"
                           placeholder="Bijv. Emma"
                           type="text"
                           id="InputVoorNaamMedewerker"
                           value="<?= $_POST['voornaamMedewerker'] ?? '' ?>">
                </div>

                <div class="form-rij">
                    <label for="InputTussenvoegselMedewerker">Tussenvoegsel</label>
                    <input name="tussenvoegselMedewerker"
                           placeholder="Bijv. van der (optioneel)"
                           type="text"
                           id="InputTussenvoegselMedewerker"
                           value="<?= $_POST['tussenvoegselMedewerker'] ?? '' ?>">
                </div>

                <div class="form-rij">
                    <label for="InputAchternaamMedewerker">Achternaam</label>
                    <input name="achternaamMedewerker"
                           placeholder="Bijv. Smit"
                           type="text"
                           id="InputAchternaamMedewerker"
                           value="<?= $_POST['achternaamMedewerker'] ?? '' ?>">
                </div>

                <div class="form-rij">
                    <label for="InputNummerMedewerker">Nummer</label>
                    <input name="nummerMedewerker"
                           placeholder="Bijv. 1006"
                           type="text"
                           id="InputNummerMedewerker"
                           value="<?= $_POST['nummerMedewerker'] ?? '' ?>">
                </div>

                <div class="form-rij">
                    <label for="InputMedewerkerSoort">Medewerkersoort</label>
                    <!-- Dropdown in plaats van vrij tekstveld, zodat je alleen geldige waarden kan kiezen -->
                    <select name="medewerkerSoort" id="InputMedewerkerSoort" required>
                        <option value="" disabled selected>Kies een soort...</option>
                        <option value="Manager"         <?= (($_POST['medewerkerSoort'] ?? '') === 'Manager')         ? 'selected' : '' ?>>Manager</option>
                        <option value="Beheerder"       <?= (($_POST['medewerkerSoort'] ?? '') === 'Beheerder')       ? 'selected' : '' ?>>Beheerder</option>
                        <option value="Diskmedewerker"  <?= (($_POST['medewerkerSoort'] ?? '') === 'Diskmedewerker')  ? 'selected' : '' ?>>Diskmedewerker</option>
                    </select>
                </div>

                <button name="submit" type="submit" class="btn-verstuur">
                    <i class="bi bi-person-plus-fill"></i> Medewerker toevoegen
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>