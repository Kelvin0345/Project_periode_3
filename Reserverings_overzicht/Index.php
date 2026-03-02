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




    









    
</body>
</html>