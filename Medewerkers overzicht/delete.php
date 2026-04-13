<?php 

include('config/config.php');

$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";

$pdo = new PDO($dsn, $dbUser, $dbPass);

$sql = "DELETE FROM Medewerkers 
        WHERE Id =:id";

$statement= $pdo->prepare($sql);

$statement->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

$statement->execute();

header('Refresh: 3; url=index.php');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD met PHP en MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/DeleteMO.css">
</head>
<body>

    <!-- NAV KOMT HIER (doe jij zelf) -->

    <div class="delete-wrapper">
        <div class="delete-card">
            <div class="delete-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                     stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6l-1 14H6L5 6"></path>
                    <path d="M10 11v6"></path>
                    <path d="M14 11v6"></path>
                    <path d="M9 6V4h6v2"></path>
                </svg>
            </div>
            <h2>Medewerker verwijderd</h2>
            <p>De gegevens zijn succesvol verwijderd.<br>
               U wordt automatisch teruggestuurd naar het overzicht.</p>
            <div class="delete-timer">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                     stroke="#4a90d9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                Doorsturen in 3 seconden...
            </div>
            <a href="index.php" class="delete-btn">Terug naar overzicht</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESAaA55NDzOxhy9GkcIdsLk1eN7N6jIeHz"
            crossorigin="anonymous">
    </script>
</body>
</html>