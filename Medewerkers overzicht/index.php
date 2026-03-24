<?php
include('config/config.php');
$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";

$pdo = new PDO($dsn, $dbUser, $dbPass);

$sql = 'SELECT MDW.Id
               ,MDW.Voornaam
               ,MDW.Tussenvoegsel
               ,MDW.Achternaam
               ,MDW.Nummer
               ,MDW.Medewerkersoort
        FROM    Medewerkers as MDW
        ORDER BY MDW.Id DESC
               ,MDW.Voornaam DESC
               ,MDW.Tussenvoegsel DESC
               ,MDW.Achternaam DESC
               ,MDW.Nummer DESC
               ,MDW.Medewerkersoort DESC';

$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_OBJ);

//var_dump($result);
?>
<!--hier start de html -->
<!doctype html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project 3</title> <!--de titel van de browser tab -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/MedewerkersOverzicht.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;600&display=swap" rel="stylesheet">
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

        <!-- Titel + knop naast elkaar -->
        <div class="medewerkers-header">
            <div>
                <p class="hero-label">Personeel</p>
                <h1 class="medewerkers-titel">Medewerkers <span>Overzicht</span></h1>
            </div>
            <!-- Knop naar create pagina -->
            <a href="create.php" class="btn-nieuwe-mdw">
                <i class="bi bi-person-plus-fill"></i> Nieuwe Medewerker
            </a>
        </div>

        <!-- Tabel -->
        <div class="tabel-wrapper">
            <table class="table table-striped table-hover medewerkers-tabel">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Voornaam</th>
                        <th>Tussenvoegsel</th>
                        <th>Achternaam</th>
                        <th>Nummer</th>
                        <th>Medewerkersoort</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $medewerker):?>
                    <tr>
                        <td><?= $medewerker->Id; ?></td>
                        <td><?= $medewerker->Voornaam; ?></td>
                        <td><?= $medewerker->Tussenvoegsel; ?></td>
                        <td><?= $medewerker->Achternaam; ?></td>
                        <td><?= $medewerker->Nummer; ?></td>
                        <td>
                            <!-- Badge kleur op basis van medewerkersoort -->
                            <span class="mdw-badge mdw-<?= strtolower($medewerker->Medewerkersoort); ?>">
                                <?= $medewerker->Medewerkersoort; ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
                <a href="/Reserverings_overzicht/index.php">Reserverings overzicht</a>
                <a href="#">Vacaturen</a>
            </div>
        </div>
    </footer>

    <!--hieronder is de script voor bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>