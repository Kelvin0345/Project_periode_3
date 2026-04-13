<?php

// include
include('config/config.php');
// Dsn 
$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";

//nieuw pdo maken
$pdo = new PDO($dsn, $dbUser, $dbPass);

//sql select table
$sql = "SELECT RS.Id
              ,RS.Voornaam
              ,RS.Tussenvoegsel
              ,RS.Achternaam
              ,RS.Nummer
              ,RS.Datum
              ,RS.Tijd
              ,RS.Reserveringstatus
        FROM Reservering AS RS
        ORDER BY RS.ID DESC";

//Prepareren
$statement = $pdo->prepare($sql);

//uitvoeren

$statement->execute();


//Tabel te zien

$result = $statement->fetchAll(PDO::FETCH_OBJ);


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
    <link
        href="https://fonts.googleapis.com/css2?family=Idiqlat:wght@200;300;400&family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/Style.css">
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
        </div>
        <div class="nav-auth">
            <a href="#" class="btn-registreer">Registreren</a>
            <a href="../login.php" class="btn-login">Login</a>
        </div>
    </nav>





    <!-- Container tabel -->
    <div class="reserveringen-pagina">
        <div class="reserveringen-header">
            <h1 class="reserveringen-titel">
                Reserveringen <span>Overzicht</span>
            </h1>
        </div>

        <!-- Nieuwe reservering toevoegen -->
        <div class="row justify-content-center my-3">
            <div class="col-10">
                <h6>
                    <a href="./create.php" class="btn btn-danger btn-sm ms-2">
                        <i class="bi bi-plus-square"></i> Nieuwe Reservering
                    </a>
                </h6>
            </div>
        </div>





        <!-- Tabel die zichtbaar is op de website -->
        <div class="tabel-wrapper">
            <table class="table table-striped table-hover reserveringen-tabel">
                <thead>
                    <tr>
                        <th>Voornaam</th>
                        <th>Tussenvoegsel</th>
                        <th>Achternaam</th>
                        <th>Nummer</th>
                        <th>Datum</th>
                        <th>Tijd</th>
                        <th>Reserveringstatus</th>
                        <th>Verwijder</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $Reservering): ?>
                        <tr>
                            <td><?= $Reservering->Voornaam; ?></td>
                            <td><?= $Reservering->Tussenvoegsel; ?></td>
                            <td><?= $Reservering->Achternaam; ?></td>
                            <td><?= $Reservering->Nummer; ?></td>
                            <td><?= $Reservering->Datum; ?></td>
                            <td><?= $Reservering->Tijd; ?></td>
                            <td><?= $Reservering->Reserveringstatus; ?></td>
                            <td class="text-center">
                                <a href="update.php?id=<?=  $Reservering->Id; ?>">
                                    <i class="bi bi-pencil-square text-success"></i>
                                </a>
                            </td>
                            <td class='text-center'>
                                <a href="delete.php?id=<?= $Reservering->Id; ?>">
                                    <i class="bi bi-x-square text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer" id="contact">
        <div class="footer-inner">
            <div class="footer-logo">FitFor<span>Fun</span></div>
            <p>© 2026 FitForFun Gym. Alle rechten voorbehouden.</p>
            <div class="footer-links">
                <a href="/geplande_lessen/index.php">Geplande lessen</a>
                <a href="/Medewerkers overzicht/index.php">Medewerkers overzicht</a>
                <a href="/Reserverings_overzicht/Index.php">Reserverings overzicht</a>
                <a href="#">Privacy</a>
                <a href="#">Vacaturen</a>
            </div>
        </div>
    </footer>



    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
        </script>


</body>

</html>