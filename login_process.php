<?php
session_start(); //Start een sessie en sessies gebruik je om gegevens van de ingelogde gebruiker te bewaren

require_once 'account overzicht/config/config.php'; //Haalt de database instellingen op zoals host, database naam, gebruiker en wachtwoord

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  //Controleert of het formulier is verstuurd POST betekent dat de gebruiker data heeft verzonden via het formulier
    $email = $_POST['email']; //Pakt de ingevulde email uit het formulier
    $password = $_POST['password']; //Pakt de ingevulde wachtwoord uit het formulier

    try {
        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
        $pdo = new PDO($dsn, $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM accountenoverzicht 
                WHERE Email = :email 
                AND Isactief = 1"; //Zoekt een account met hetzelfde emailadres en kijkt ook of het account actief is
                
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $account = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($account) {
            if ($password == $account['Wachtwoord']) {
                $_SESSION['account_id'] = $account['Id'];
                $_SESSION['voornaam'] = $account['Voornaam'];
                $_SESSION['achternaam'] = $account['Achternaam'];
                $_SESSION['email'] = $account['Email'];
                $_SESSION['is_ingelogd'] = true;

                header('Location: index.php');
                exit;
            } else {
                header('Location: login.php?error=1');
                exit;
            }
        } else {
            header('Location: login.php?error=1');
            exit;
        }

    } catch (PDOException $e) {
        echo "Database fout: " . $e->getMessage();
    }
}
?>