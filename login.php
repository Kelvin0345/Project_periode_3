<?php
session_start();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FitForFun</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="overlay"></div>

    <div class="login-container">
        <div class="login-box">
            <h1>FITFOR<span>FUN</span></h1>
            <p class="subtitle">Log in op je account</p>

            <form action="login_process.php" method="POST">
                <div class="input-group">
                    <label for="email">E-mailadres</label>
                    <input type="text" name="email" id="email" placeholder="Vul je e-mailadres in" required>
                </div>

                <div class="input-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" name="password" id="password" placeholder="Vul je wachtwoord in" required>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <a href="index.html" class="back-link">Terug naar home</a>
        </div>
    </div>

</body>
</html>