<?php

include ('config/config.php');

$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";

$pdo = new PDO($dsn, $dbUser,$dbPass);


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


$statement = $pdo->prepare($sql);

//uitvoeren

$statement->execute();


//Array

$result = $statement->fetchAll(PDO::FETCH_OBJ);

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
    <link rel="stylesheet" href="./css/Style.css">
</head>
<body>
    <div class="container mt-3">
        <div class="row justify content-center">
            <div class="col-8">
                <h3>Reservering overzicht</h3>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-10">
            <table class="table table-striped table-hover">
                <thead>
                    <th>Voornaam</th>
                    <th>Tussenvoegsel</th>
                    <th>Achternaam</th>
                    <th>Nummer</th>
                    <th>Datum</th>
                    <th>Tijd</th>
                    <th>Reserveringstatus</th>
                </thead>
                <tbody>
                    <?php foreach ($result as $Reservering):?>
                        <tr>
                            <td><?= $Reservering->Voornaam; ?></td>
                            <td><?= $Reservering->Tussenvoegsel; ?></td>
                            <td><?= $Reservering->Achternaam; ?></td>
                            <td><?= $Reservering->Nummer; ?></td>
                            <td><?= $Reservering->Datum; ?></td>
                            <td><?= $Reservering->Tijd; ?></td>
                            <td><?= $Reservering->Reserveringstatus; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
            crossorigin="anonymous">
    </script>

    
</body>
</html>