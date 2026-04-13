<?php

// gegevens van config aankoppelen 
include('config/config.php');

// Database Verbinding
$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";

// Database aankoppelen
$pdo = new PDO($dsn, $dbUser, $dbPass);

// silent mode activeren zodat de unhappy scenario activeert
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

// controleren of id bestaat
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $melding = "Geen geldige reservering opgegeven.";
    $class = "alert-warning";
} else {

    // sql Delete op basis van ID 
    $sql = "DELETE FROM Reservering
            WHERE Id = :id";
        
    // Statement
    $statement = $pdo->prepare($sql);

    if ($statement) {
        // Sturen naar de ID
        $statement->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

        // uitvoeren
        if ($statement->execute()) {

            // controleren of er iets verwijderd is
            if ($statement->rowCount() > 0) {
                $melding = "De gegevens zijn verwijderd. U wordt teruggestuurd naar de index-pagina.";
                $class = "alert-success";
            } else {
                $melding = "De reservering kon niet worden gevonden of is reeds verwijderd.";
                $class = "alert-warning";
            }

        } else {
            // unhappy scenario bij execute
            $melding = "Er is een fout opgetreden bij het verwijderen.";
            $class = "alert-danger";
        }

    } else {
        // unhappy scenario bij prepare
        $melding = "Query kon niet worden voorbereid.";
        $class = "alert-danger";
    }
}

// terugsturen naar reserverings overzicht tabel
header("Refresh: 3; url=index.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD-basic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- Alert melding -->
   <div class="alert <?= $class ?> text-center" role="alert">
        <?= $melding ?>
    </div>

    <!-- Script van bootstrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
        </script>
</body>

</html>