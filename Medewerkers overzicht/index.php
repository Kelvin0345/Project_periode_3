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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"> <!-- de css -->
  </head>
  <body>
    <div class="cointainer mt-3">        <!--hier start de container voor de tabel -->
      <div class="row justify-content-center">
        <div class="col-8">
                 <!--hier is de titel van de tabel -->
          <h3>Medewerkers Overzicht</h3>
        </div>
      </div>
    </div>
  
    <div class="row justify-content-center">
      <div class="col-8">
        <!--hier komt de tabel -->
        <table class="table table-striped table-hover">
          <thead>
            <th>Id</th>
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>Nummer</th>
            <th>Medewerkersoort</th>
     <!--   <th>Unhappy scenario</th> -->
          </thead>
          <tbody>
            <?php foreach ($result as $medewerker):?>
            <tr>
              <td><?= $medewerker->Id; ?></td>
              <td><?= $medewerker->Voornaam; ?></td>
              <td><?= $medewerker->Tussenvoegsel; ?></td>
              <td><?= $medewerker->Achternaam; ?></td>
              <td><?= $medewerker->Nummer; ?></td>
              <td><?= $medewerker->Medewerkersoort; ?></td>
            <!-- <td>< #?= $unhappyscenario->Unhappy; ?></td> -->
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>




       <!--hieronder is de script voor bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>