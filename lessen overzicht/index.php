<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "fitness";

// Verbinding maken met MySQL
$conn = new mysqli($host,$user,$pass);
if($conn->connect_error) die("Database verbinding mislukt");

// Database aanmaken als die nog niet bestaat
$conn->query("CREATE DATABASE IF NOT EXISTS $db");
$conn->select_db($db);

// Tabel aanmaken als die nog niet bestaat
$conn->query("
CREATE TABLE IF NOT EXISTS pakketten(
    id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(100),
    feature1 TEXT,
    feature2 TEXT,
    beschrijving TEXT,
    prijs DECIMAL(10,2)
)
");

// Controleren of de tabel leeg is
$check = $conn->query("SELECT COUNT(*) as totaal FROM pakketten");
$rowCheck = $check->fetch_assoc();

// Alleen voorbeelddata toevoegen als er nog niks in staat
if($rowCheck['totaal'] == 0){
    $conn->query("
    INSERT INTO pakketten (naam,feature1,feature2,beschrijving,prijs) VALUES
    ('PT Starter pakket','Fitness Trainer A (NL-Actief / Level 3 EREPS)','Fitness Trainer B (NL-actief / Level 4 EREPS)','Voor een goede start als toekomstig personal trainer volg je Fitness Trainer A en B.',135.00),
    ('PT Pro Pakket','Fitness Trainer A (NL-Actief / Level 3 EREPS)','Personal Trainer opleiding ACE (Level 4 EREPS)','Wil je als Personal Trainer een wereldwijd erkend diploma dan kies je dit pakket.',166.58),
    ('PT Master Pakket','Fitness Trainer A (NL-Actief / Level 3 EREPS)','Personal Trainer Medical Exercise (Level 5 EREPS)','Onderscheid jezelf in de fitnessmarkt met dit complete pakket.',301.25),
    ('PT Pro Package English','Fitness Trainer A English (Level 3)','Personal Trainer Course English ACE (Level 4 EREPS)','International recognized Personal Trainer Package.',126.60)
    ");
}

// Filters ophalen uit URL
$zoek = isset($_GET['zoek']) ? $conn->real_escape_string($_GET['zoek']) : "";
$sort = isset($_GET['sort']) ? $_GET['sort'] : "";

// SQL query opbouwen
$sql = "SELECT * FROM pakketten WHERE 1";

// Zoekfunctie
if($zoek != "") {
    $sql .= " AND naam LIKE '%$zoek%'";
}

// Prijsfilters
if(isset($_GET['min']) && $_GET['min'] !== ""){
    $min = floatval($_GET['min']);
    $sql .= " AND prijs >= $min";
}
if(isset($_GET['max']) && $_GET['max'] !== ""){
    $max = floatval($_GET['max']);
    $sql .= " AND prijs <= $max";
}

// Sorteren
if($sort == "laag-hoog") {
    $sql .= " ORDER BY prijs ASC";
}
elseif($sort == "hoog-laag") {
    $sql .= " ORDER BY prijs DESC";
}

// Query uitvoeren
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PT Pakketten</title>
<link rel="stylesheet" href="style.css">
<style>
/* Inline CSS voor responsive aanpassing van je bestaande style */

.lessons {
    display: grid;
    grid-template-columns: repeat(auto-fill,minmax(300px,1fr));
    gap: 20px;
}

.card {
    background: white;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}

.card-title {
    font-weight: bold;
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.card-body ul {
    padding-left: 20px;
    margin-bottom: 10px;
}

.card-body p {
    margin-bottom: 10px;
}

.price-box {
    font-weight: bold;
    margin-bottom: 10px;
}

.button {
    background: #2563eb;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.error {
    background: #fee2e2;
    color: #b91c1c;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
}

/* Responsive voor mobiel */
@media(max-width: 600px){
    .filter-bar input[type="text"] {
        width: 100%;
        margin-bottom: 10px;
    }
    .price-filter {
        width: 100%;
    }
    .lessons {
        grid-template-columns: 1fr;
    }
}
</style>
<script>
function togglePriceFilter(){
    const box = document.getElementById("priceContent");
    box.style.display = box.style.display === "block" ? "none" : "block";
}
</script>
</head>
<body>

<div class="container">

<form method="GET">

<div class="filter-bar">
    <input type="text" name="zoek" placeholder="Zoek lesnaam..." value="<?php echo htmlspecialchars($zoek); ?>">
</div>

<div class="price-filter">
    <div class="price-header" onclick="togglePriceFilter()">
        <span>Filters</span>
        <span class="arrow">▼</span>
    </div>

    <div class="price-content" id="priceContent">
        <h4>Prijs</h4>
        <label>Min prijs:</label>
        <input type="number" name="min" step="0.01" value="<?php echo isset($_GET['min']) ? $_GET['min'] : ""; ?>">

        <label>Max prijs:</label>
        <input type="number" name="max" step="0.01" value="<?php echo isset($_GET['max']) ? $_GET['max'] : ""; ?>">

        <h4>Sorteren</h4>
        <div class="sort-options">
            <label><input type="radio" name="sort" value="" <?php if($sort=="") echo "checked"; ?>> Aanbevolen</label>
            <label><input type="radio" name="sort" value="laag-hoog" <?php if($sort=="laag-hoog") echo "checked"; ?>> Prijs laag - hoog</label>
            <label><input type="radio" name="sort" value="hoog-laag" <?php if($sort=="hoog-laag") echo "checked"; ?>> Prijs hoog - laag</label>
        </div>

        <button type="submit" class="button">Filter toepassen</button>
    </div>
</div>

</form>

<div class="lessons">
<?php
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "
        <div class='card'>
            <div class='card-title'>".$row['naam']."</div>
            <div class='card-body'>
                <ul>
                    <li>".$row['feature1']."</li>
                    <li>".$row['feature2']."</li>
                </ul>
                <p>".$row['beschrijving']."</p>
                <div class='price-box'>€".$row['prijs']."</div>
                <center>
                    <button class='button'>Bekijk pakket</button>
                </center>
            </div>
        </div>
        ";
    }
}else{
    echo "<div class='error'>Er zijn geen lessen die voldoen aan deze filters</div>";
}
?>
</div>

<div style="text-align:center; margin:30px 0;">
    <a href="nieuwelessen.php"><button class="button">Nieuwe les toevoegen</button></a>
</div>

</div>

</body>
</html>