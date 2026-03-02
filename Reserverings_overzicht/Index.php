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
</head>
<body>

<div class="container-mt-3">
        <div class="row-justify-content-center">
            <div class="col-8">
                <h3>Reservering overzicht</h3>
            </div>
        </div>

        <div class="row justidy-content-center my-3">
            <div class="col-10"><h6>Nieuwe achtbaan <a href="./create.php"><i class="bi bi-plus-square text-danger text-danger"></i></h6></a></div>
        </div>

        <div class="row-justify-content-center mt-3">
            <div class="col-10">
                <table class="table table-striped table-hover ">
                    <thead>
                        <th>Voornaam</th>
                        <th>Tussenvoegsel</th>
                        <th>Achternaam</th>
                        <th>Nummer</th>
                        <th>Datum</th>
                        <th</th>
                        <th>Wijzig</th>
                        <th>Verwijder</th>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $Rollercoaster):?>
                            <tr>
                                <td><?= $Rollercoaster->RollerCoaster; ?></td>
                                <td><?= $Rollercoaster->AmusementPark; ?></td>
                                <td><?= $Rollercoaster->Country; ?></td>
                                <td class="text-center"><?= $Rollercoaster->TopSpeed; ?></td>
                                <td class="text-center"><?= $Rollercoaster->Height; ?></td>
                                <td ><?= $Rollercoaster->YOFC; ?></td>
                                
                                <td class="text-center">
                                    <a href="update.php?id=<?=  $Rollercoaster->Id; ?>">
                                      <i class="bi bi-pencil-square text-success"></i>
                                    </a>
                                </td>
                                
                                <td class='text-center'>
                                    <a href="delete.php?id=<?= $Rollercoaster->Id; ?>">
                                        <i class="bi bi-x-square text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>   
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>










    
</body>
</html>