<?php

// config include
include ('config/config.php');
//host
$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";
/**
 * Nieuwe pdo maken
 */
$pdo = new PDO($dsn, $dbUser,$dbPass);

//tabel
$sqlLes = "SELECT GLN.Id
              ,GLN.Naam
              ,GLN.Prijs
              ,GLN.Datum
              ,GLN.Tijd
              ,GLN.MinAantalPersonen
              ,GLN.MaxAantalPersonen
              ,GLN.Beschikbaarheid
        FROM LesOverzicht AS GLN
        ORDER BY GLN.ID ASC";

// Statment prepareren
$statementLes = $pdo->prepare($sqlLes);

// state uitvoeren
$statementLes->execute();

// tabel te zien
$lesResult = $statementLes->fetchAll(PDO::FETCH_OBJ);
//var_dump


//Leden select
$sqlLeden = "SELECT OVALPP.Id
              ,OVALPP.PeriodeStart  
              ,OVALPP.PeriodeEind
              ,OVALPP.AantalNieuweLeden
              ,OVALPP.AantalVertrokkenLeden
              ,OVALPP.TotaalAantalLeden
        FROM OverzichtAantalLedenPerPeriode AS OVALPP 
        ORDER BY OVALPP.Id DESC";

// Statment prepareren
$statementLeden = $pdo->prepare($sqlLeden);

// state uitvoeren
$statementLeden->execute();

// tabel te zien
$ledenResult = $statementLeden->fetchAll(PDO::FETCH_OBJ);

//data selecteren

//var_dump($result);

?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitforfun</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Idiqlat:wght@200;300;400&family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    
    <nav class="navbar"> <!-- hier is de nav bar -->
        <div class="nav-logo">FitFor<span>FUN</span></div>
            <ul class="nav-links">
                <li><a href="/index.php">Home</a></li>
                <li><a href="/Lessen.html">Lessen</a></li>
                <li><a href="#vacatures">Vacaturen</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
        <div class="nav-auth"> <!-- login en registeer knoppen -->
            <a href="#" class="btn-registreer">Registreren</a>
            <a href="../login.php" class="btn-login">Login</a>
        </div>
    </nav>
   

    <!-- Tabel Geplande lessen -->
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-8">
                <h3>Geplande Lessen</h3>
            </div>
        </div>
    </div>

    <div class="tabel-wrapper">
        <table class="table table-striped table-hover reserveringen-tabel">
            <thead>
                <th>Naam</th>
                <th>Prijs</th>
                <th>Datum</th>
                <th>Tijd</th>
                <th>MinAantalPersonen</th>
                <th>MaxAantalpersonen</th>
                <th>Beschikbaarheid</th>
            </thead>
                <tbody>
                    <?php foreach ($lesResult as $LesOverzicht):?>
                        <tr>
                            <td><?= $LesOverzicht->Naam; ?></td>
                            <td><?= $LesOverzicht->Prijs; ?></td>
                            <td><?= $LesOverzicht->Datum; ?></td>
                            <td><?= $LesOverzicht->Tijd; ?></td>
                            <td><?= $LesOverzicht->MinAantalPersonen; ?></td>
                            <td><?= $LesOverzicht->MaxAantalPersonen; ?></td>
                            <td><?= $LesOverzicht->Beschikbaarheid; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
        </table>
    </div>

    <!-- Tabel aantal leden per periode -->
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-8">
                <h3>Overzicht Aantal Leden Per Periode</h3>
            </div>
        </div>
    </div>
    
    <div class="table wrapper">
        <table class="table table-striped table-hover reserveringen-tabel">
                <thead>
                    <th>Periodestart</th>
                    <th>Periodeind</th>
                    <th>AantalNieuweleden</th>
                    <th>AantalVertrokkenLeden</th>
                    <th>Totaalaantalleden</th>
                </thead>
            <tbody>
                <?php foreach ($ledenResult as $OverzichtAantalLedenPerPeriode):?>
                     <tr>
                        <td><?= $OverzichtAantalLedenPerPeriode->PeriodeStart; ?></td>
                        <td><?= $OverzichtAantalLedenPerPeriode->PeriodeEind; ?></td>
                        <td><?= $OverzichtAantalLedenPerPeriode->AantalNieuweLeden; ?></td>
                        <td><?= $OverzichtAantalLedenPerPeriode->AantalVertrokkenLeden; ?></td>
                        <td><?= $OverzichtAantalLedenPerPeriode->TotaalAantalLeden; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    </div>

    <!-- FOOTER -->
    <footer class="footer" id="contact">
        <div class="footer-inner">
            <div class="footer-logo">FitFor<span>Fun</span></div> <!--hier is de logo van de footer -->
            <p>© 2026 FitForFun Gym. Alle rechten voorbehouden.</p>
            <div class="footer-links">
                <a href="/geplande_lessen/index.php">Geplande lessen</a>
                <a href="/Medewerkers overzicht/index.php">Medewerkers overzicht</a>
                <a href="./Reserverings_overzicht/Index.php">Reserverings overzicht</a>
                <a href="#">Privacy</a>
                <a href="#">Vacaturen</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
            crossorigin="anonymous">
    </script>

    
</body>
</html>