<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id === 0) {
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medewerker verwijderen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/DeleteMO.css">
</head>
<body>

    <!-- Index pagina als achtergrond -->
    <iframe class="bg-iframe" src="index.php"></iframe>

    <div class="delete-wrapper">
        <div class="delete-card">
            <div class="delete-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                     stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6l-1 14H6L5 6"></path>
                    <path d="M10 11v6"></path>
                    <path d="M14 11v6"></path>
                    <path d="M9 6V4h6v2"></path>
                </svg>
            </div>
            <h2>Medewerker verwijderen</h2>
            <p>Weet je zeker dat je deze medewerker wilt verwijderen?<br>
               Deze actie kan niet ongedaan worden gemaakt.</p>

            <div class="d-flex gap-3 justify-content-center mt-3">
                <a href="delete.php?id=<?= $id ?>" class="delete-btn">Ja, verwijderen</a>
                <a href="index.php" class="btn btn-secondary">Annuleren</a>
            </div>
        </div>
    </div>

</body>
</html>