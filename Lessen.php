<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lessen – FitForFun</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-logo">FITFOR<span>FUN</span></div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="lessen.php" class="active">Lessen</a></li>
            <li><a href="#vacatures">Vacaturen</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <div class="nav-auth">
            <a href="#" class="btn-registreer">Registreren</a>
            <a href="#" class="btn-login">Login</a>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <section class="page-header">
        <div class="page-header-overlay"></div>
        <div class="page-header-content">
            <p class="hero-label">Ons aanbod</p>
            <h1 class="page-header-title">Onze <span>Lessen</span></h1>
            <p class="page-header-sub">Voor elk niveau — van beginner tot gevorderde</p>
        </div>
    </section>

    <!-- FILTER KNOPPEN -->
    <section class="filter-sectie">
        <div class="filter-knoppen">
            <button class="filter-btn actief" onclick="filterLessen('alle', this)">Alle</button>
            <button class="filter-btn" onclick="filterLessen('kracht', this)">Kracht</button>
            <button class="filter-btn" onclick="filterLessen('cardio', this)">Cardio</button>
            <button class="filter-btn" onclick="filterLessen('mind', this)">Mind & Body</button>
            <button class="filter-btn" onclick="filterLessen('vechtsport', this)">Vechtsport</button>
        </div>
    </section>

    <!-- LESSEN GRID -->
    <section class="lessen-pagina">
        <div class="lessen-grid-groot" id="lessenGrid">

            <div class="les-card-groot" data-categorie="kracht">
                <div class="les-card-top kracht-bg">
                    <span class="les-badge">Kracht</span>
                    <div class="les-emoji">🏋️</div>
                </div>
                <div class="les-card-body">
                    <h3>Krachttraining</h3>
                    <p>Bouw spiermassa op met begeleiding van onze coaches. Geschikt voor alle niveaus.</p>
                    <ul class="les-details">
                        <li>⏱ 60 minuten</li>
                        <li>📅 Ma, Wo, Vr</li>
                        <li>👤 Max 15 personen</li>
                    </ul>
                    <a href="#" class="btn-primary">Inschrijven</a>
                </div>
            </div>

            <div class="les-card-groot" data-categorie="cardio">
                <div class="les-card-top hiit-bg">
                    <span class="les-badge">Cardio</span>
                    <div class="les-emoji">🔥</div>
                </div>
                <div class="les-card-body">
                    <h3>HIIT</h3>
                    <p>High Intensity Interval Training voor maximale vetverbranding in korte tijd.</p>
                    <ul class="les-details">
                        <li>⏱ 45 minuten</li>
                        <li>📅 Di, Do, Za</li>
                        <li>👤 Max 20 personen</li>
                    </ul>
                    <a href="#" class="btn-primary">Inschrijven</a>
                </div>
            </div>

            <div class="les-card-groot" data-categorie="mind">
                <div class="les-card-top yoga-bg">
                    <span class="les-badge">Mind & Body</span>
                    <div class="les-emoji">🧘</div>
                </div>
                <div class="les-card-body">
                    <h3>Yoga</h3>
                    <p>Verbeter je flexibiliteit, balans en mentale rust met onze yogalessen.</p>
                    <ul class="les-details">
                        <li>⏱ 75 minuten</li>
                        <li>📅 Ma, Wo, Za</li>
                        <li>👤 Max 12 personen</li>
                    </ul>
                    <a href="#" class="btn-primary">Inschrijven</a>
                </div>
            </div>

            <div class="les-card-groot" data-categorie="vechtsport">
                <div class="les-card-top boksen-bg">
                    <span class="les-badge">Vechtsport</span>
                    <div class="les-emoji">🥊</div>
                </div>
                <div class="les-card-body">
                    <h3>Boksen</h3>
                    <p>Leer vechttechnieken en verbeter je conditie tegelijk. Voor beginners en gevorderden.</p>
                    <ul class="les-details">
                        <li>⏱ 60 minuten</li>
                        <li>📅 Di, Do, Za</li>
                        <li>👤 Max 10 personen</li>
                    </ul>
                    <a href="#" class="btn-primary">Inschrijven</a>
                </div>
            </div>

            <div class="les-card-groot" data-categorie="cardio">
                <div class="les-card-top spin-bg">
                    <span class="les-badge">Cardio</span>
                    <div class="les-emoji">🚴</div>
                </div>
                <div class="les-card-body">
                    <h3>Spinning</h3>
                    <p>Intensieve fietssessies op muziek. Perfect om je conditie snel te verbeteren.</p>
                    <ul class="les-details">
                        <li>⏱ 50 minuten</li>
                        <li>📅 Ma, Wo, Vr</li>
                        <li>👤 Max 25 personen</li>
                    </ul>
                    <a href="#" class="btn-primary">Inschrijven</a>
                </div>
            </div>

            <div class="les-card-groot" data-categorie="mind">
                <div class="les-card-top pilates-bg">
                    <span class="les-badge">Mind & Body</span>
                    <div class="les-emoji">🌿</div>
                </div>
                <div class="les-card-body">
                    <h3>Pilates</h3>
                    <p>Versterk je core en verbeter je houding met gerichte oefeningen.</p>
                    <ul class="les-details">
                        <li>⏱ 60 minuten</li>
                        <li>📅 Di, Do</li>
                        <li>👤 Max 10 personen</li>
                    </ul>
                    <a href="#" class="btn-primary">Inschrijven</a>
                </div>
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
            <div class="footer-logo">FITFOR<span>FUN</span></div>
            <p>© 2026 FitForFun Gym. Alle rechten voorbehouden.</p>
            <div class="footer-links">
                <a href="#">Contact</a>
                <a href="#">Privacy</a>
                <a href="#">Vacaturen</a>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT voor filter functie -->
    <script>
        // Filtert de leskaarten op categorie
        function filterLessen(categorie, knop) {
            // Verwijder 'actief' van alle knoppen
            const alleKnoppen = document.querySelectorAll('.filter-btn');
            alleKnoppen.forEach(btn => btn.classList.remove('actief'));

            // Zet 'actief' op de geklikte knop
            knop.classList.add('actief');

            // Haal alle leskaarten op
            const kaarten = document.querySelectorAll('.les-card-groot');

            kaarten.forEach(kaart => {
                // Als 'alle' is geselecteerd, laat alles zien
                if (categorie === 'alle') {
                    kaart.style.display = 'block';
                } else {
                    // Verberg of toon op basis van categorie
                    if (kaart.dataset.categorie === categorie) {
                        kaart.style.display = 'block';
                    } else {
                        kaart.style.display = 'none';
                    }
                }
            });
        }
    </script>

</body>
</html>