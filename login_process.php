<?php
session_start();

require_once 'account overzicht/config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
        $pdo = new PDO($dsn, $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM accountenoverzicht 
                WHERE Email = :email 
                AND Isactief = 1";
                
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