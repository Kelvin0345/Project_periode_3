<?php
session_start();

$foutmelding = '';

if (isset($_GET['error']) && $_GET['error'] == 'logout_failed') {
    $foutmelding = 'Uitloggen is mislukt. Je bent nog steeds ingelogd.';
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitForFun</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-logo">FitFor<span>FUN</span></div>
        <ul class="nav-links">
            <li><a href="/index.php" class="active">Home</a></li>
            <li><a href="/Lessen.html">Lessen</a></li>
            <li><a href="#vacatures">Vacaturen</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
<div class="nav-auth">
    <?php if (isset($_SESSION['is_ingelogd']) && $_SESSION['is_ingelogd'] == true) : ?>
        <span class="welcome-text">
            Hallo, <?php echo $_SESSION['voornaam']; ?>
        </span>
        <a href="logout.php" class="btn-login">Uitloggen</a>
    <?php else : ?>
        <a href="#" class="btn-registreer">Registreren</a>
        <a href="login.php" class="btn-login">Login</a>
    <?php endif; ?>
</div>
</nav>

<?php if (!empty($foutmelding)) : ?>
    <p style="color:red; text-align:center; margin:20px; font-weight:bold;">
        <?php echo $foutmelding; ?>
    </p>
<?php endif; ?>

    <!-- HERO SECTION -->
    <section class="hero" id="home">
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <p class="hero-label">Welkom bij FitforFun</p>
            <h1 class="hero-title">Real results<br><span>start here.</span></h1>
            <p class="hero-subtitle">
                Jouw transformatie begint vandaag. Train harder, leef beter.
            </p>
            <div class="hero-buttons">
                <a href="/Lessen.html" class="btn-primary">Bekijk lessen</a>
                <a href="#contact" class="btn-secondary">Meer info</a>
            </div>
        </div>

        <!-- Stats balk onderaan hero -->
        <div class="hero-stats">
            <div class="stat">
                <span class="stat-number">500+</span>
                <span class="stat-label">Leden</span>
            </div>
            <div class="stat">
                <span class="stat-number">20+</span>
                <span class="stat-label">Trainers</span>
            </div>
            <div class="stat">
                <span class="stat-number">30+</span>
                <span class="stat-label">Lessen per week</span>
            </div>
            <div class="stat">
                <span class="stat-number">10jr</span>
                <span class="stat-label">Ervaring</span>
            </div>
        </div>
    </section>

    <!-- SOCIAL MEDIA KNOPPEN -->
    <div class="social-float">
        <a href="#" class="social-btn x-btn">
            <img src="img/x.png" alt="X">
        </a>

        <a href="#" class="social-btn fb-btn">
            <img src="img/fb.png" alt="Facebook">
        </a>

        <a href="#" class="social-btn ig-btn">
            <img src="img/iglogo.png" alt="Instagram">
        </a>
    </div>

    <!-- FOOTER -->
    <footer class="footer" id="contact">
        <div class="footer-inner">
            <div class="footer-logo">FitFor<span>Fun</span></div>
            <p>© 2026 FitForFun Gym. Alle rechten voorbehouden.</p>
            <div class="footer-links">
                <a href="./geplande_lessen/index.php">geplande lessen</a>
                <a href="/Medewerkers overzicht/index.php">Medewerkers overzicht</a>
                <a href="./Reserverings_overzicht/Index.php">Reserverings overzicht</a>
                <a href="#">Privacy</a>
                <a href="#">Vacaturen</a>
            </div>
        </div>
    </footer>

</body>
</html>