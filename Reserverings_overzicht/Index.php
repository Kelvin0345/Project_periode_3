<?php
// CONFIG INLADEN (database gegevens)
include('config/config.php');

// DATABASE CONNECTIE (PDO)
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    // Nieuwe PDO verbinding maken
    $pdo = new PDO($dsn, $dbUser, $dbPass);

    // Errors tonen als exceptions (handig voor debugging)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL QUERY (reserveringen ophalen)
    $sql = "
        SELECT 
            RS.Id,
            RS.Voornaam,
            RS.Tussenvoegsel,
            RS.Achternaam,
            RS.Nummer,
            RS.Datum,
            RS.Tijd,
            RS.Reserveringstatus
        FROM Reservering AS RS
        ORDER BY RS.Id DESC
    ";

    // Query voorbereiden
    $statement = $pdo->prepare($sql);

    // Query uitvoeren
    $statement->execute();

    // Resultaten ophalen als objecten
    $result = $statement->fetchAll(PDO::FETCH_OBJ);

} catch (PDOException $e) {
    // Foutmelding als database faalt
    die("Database fout: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitForFun</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100..900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/Style.css">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg custom-navbar navbar-dark">
        <div class="container-fluid">

            <!-- Logo -->
            <a class="navbar-brand" href="#">FitFor<span>FUN</span></a>

            <!-- Hamburger menu (mobiel) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigatie links -->
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="/index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Lessen.html">Lessen</a></li>
                    <li class="nav-item"><a class="nav-link" href="#vacatures">Vacatures</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>

                <!-- Login / registratie knoppen -->
                <div class="d-flex">
                    <a href="#" class="btn btn-outline-primary me-2">Registreren</a>
                    <a href="../login.php" class="btn btn-primary">Login</a>
                </div>

            </div>
        </div>
    </nav>

    <!-- PAGINA TITEL -->

    <div class="container my-4">
        <h1 class="text-center">
            Reserveringen <span class="text-danger">Overzicht</span>
        </h1>
    </div>


    <!-- BUTTON: NIEUWE RESERVERING -->

    <div class="container mb-3 text-end">
        <a href="./create.php" class="btn btn-danger btn-sm">
            <i class="bi bi-plus-square"></i> Nieuwe Reservering
        </a>
    </div>

    <!-- RESERVERINGEN LIJST -->

    <div class="container">

        <div class="reserveringen-tabel">

            <?php if (!empty($result)): ?>

                <!-- Loop door alle reserveringen -->
                <?php foreach ($result as $Reservering): ?>

                    <div class="row border-bottom py-2 align-items-center">

                        <!-- Voornaam -->
                        <div class="col-12 col-md">
                            <?= htmlspecialchars($Reservering->Voornaam); ?>
                        </div>

                        <!-- Tussenvoegsel -->
                        <div class="col-12 col-md">
                            <?= htmlspecialchars($Reservering->Tussenvoegsel); ?>
                        </div>

                        <!-- Achternaam -->
                        <div class="col-12 col-md">
                            <?= htmlspecialchars($Reservering->Achternaam); ?>
                        </div>

                        <!-- Nummer -->
                        <div class="col-12 col-md">
                            <?= htmlspecialchars($Reservering->Nummer); ?>
                        </div>

                        <!-- Datum -->
                        <div class="col-12 col-md">
                            <?= htmlspecialchars($Reservering->Datum); ?>
                        </div>

                        <!-- Tijd -->
                        <div class="col-12 col-md">
                            <?= htmlspecialchars($Reservering->Tijd); ?>
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-md">
                            <?= htmlspecialchars($Reservering->Reserveringstatus); ?>
                        </div>

                        <!-- Wijzig -->
                        <div class="col-12 col-md-1 text-center">
                            <a href="update.php?id=<?= $Reservering->Id; ?>">
                                <i class="bi bi-pencil-square text-success"></i>
                            </a>
                        </div>

                        <!-- Verwijder -->
                        <div class="col-12 col-md-1 text-center">
                            <a href="delete.php?id=<?= $Reservering->Id; ?>">
                                <i class="bi bi-x-square text-danger"></i>
                            </a>
                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <!-- Als er geen data is -->
                <div class="text-center py-4">
                    Geen reserveringen gevonden.
                </div>

            <?php endif; ?>

        </div>
    </div>


    <!-- FOOTER -->
    <footer class="footer mt-5" id="contact">
        <div class="container text-center">

            <!-- Logo -->
            <div class="footer-logo">FitFor<span>Fun</span></div>

            <!-- Copyright -->
            <p>© 2026 FitForFun Gym. Alle rechten voorbehouden.</p>

            <!-- Links -->
            <div class="footer-links d-flex justify-content-center gap-3 flex-wrap">
                <a href="/geplande_lessen/index.php">Lessen</a>
                <a href="/Medewerkers overzicht/index.php">Medewerkers</a>
                <a href="/Reserverings_overzicht/Index.php">Reserveringen</a>
                <a href="#">Privacy</a>
            </div>

        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>