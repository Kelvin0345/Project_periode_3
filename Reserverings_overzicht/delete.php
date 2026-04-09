<?php
include('config/config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    // NIEUWe pdo
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM Reservering WHERE Id = :id";
    $statement = $pdo->prepare($sql);
    // Sturen naar de ID
    $statement->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    // executeren
    $statement->execute();

    // controleren of er iets verwijderd is
    if ($statement->rowCount() > 0) {
        $melding = "De gegevens zijn verwijderd. U wordt teruggestuurd naar de index-pagina.";
        $class = "alert-success";
    } else {
        $melding = "Er is niets verwijderd. Mogelijk bestaat het ID niet.";
        $class = "alert-warning";
    }

    // ss
} catch (PDOException $e) {
    // unhappy scenario
    $melding = "reservering is al verwijderd.";
    // Stuurt de div een alert melding
    $class = "alert-danger";
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

    <!-- Script van  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
        </script>
</body>

</html