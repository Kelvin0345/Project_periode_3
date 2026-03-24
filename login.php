<?php
session_start(); //hier word een sessie gestart
$foutmelding = '';

if (isset($_GET['error'])) {
    if ($_GET['error'] == 'logout_failed') {
        $foutmelding = 'Uitloggen is mislukt. Probeer opnieuw.';
    } elseif ($_GET['error'] == 'not_logged_in') {
        $foutmelding = 'Je bent niet ingelogd.';
    } else {
        $foutmelding = 'E-mail of wachtwoord is onjuist.';
    }
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FitForFun</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;600;700&display=swap" 
        rel="stylesheet">
</head>

<body>

    <div class="overlay"></div>

    <div class="login-container">
        <div class="login-box">
            <h1>FITFOR<span>FUN</span></h1>
            <p class="subtitle">Log in op je account</p>

            <?php if (!empty($foutmelding)): ?>
                <p class="error-message"><?php echo $foutmelding; ?></p>
            <?php endif; ?>

            <form action="login_process.php" method="POST">
                <div class="input-group">
                    <label for="email">E-mailadres</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="input-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <a href="index.php" class="back-link">Terug naar home</a>
        </div>
    </div>

</body>

</html>