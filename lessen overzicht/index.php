<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "fitness";

$conn = new mysqli($host,$user,$pass);

if($conn->connect_error){
die("Database verbinding mislukt");
}

$conn->query("CREATE DATABASE IF NOT EXISTS $db");
$conn->select_db($db);

$conn->query("DROP TABLE IF EXISTS pakketten");

$conn->query("
CREATE TABLE pakketten(
id INT AUTO_INCREMENT PRIMARY KEY,
naam VARCHAR(100),
feature1 TEXT,
feature2 TEXT,
beschrijving TEXT,
prijs VARCHAR(50)
)
");

$conn->query("
INSERT INTO pakketten (naam,feature1,feature2,beschrijving,prijs) VALUES

('PT Starter pakket',
'Fitness Trainer A (NL-Actief / Level 3 EREPS)',
'Fitness Trainer B (NL-actief / Level 4 EREPS)',
'Voor een goede start als toekomstig personal trainer volg je Fitness Trainer A en B.',
'€135,- per maand'),

('PT Pro Pakket',
'Fitness Trainer A (NL-Actief / Level 3 EREPS)',
'Personal Trainer opleiding ACE (Level 4 EREPS)',
'Wil je als Personal Trainer een wereldwijd erkend diploma dan kies je dit pakket.',
'€166,58 per maand'),

('PT Master Pakket',
'Fitness Trainer A (NL-Actief / Level 3 EREPS)',
'Personal Trainer Medical Exercise (Level 5 EREPS)',
'Onderscheid jezelf in de fitnessmarkt met dit complete pakket.',
'€301,25 per maand'),

('PT Pro Package English',
'Fitness Trainer A English (Level 3)',
'Personal Trainer Course English ACE (Level 4 EREPS)',
'International recognized Personal Trainer Package.',
'€126,60 per maand')
");

$zoek = "";

if(isset($_GET['zoek'])){
$zoek = $conn->real_escape_string($_GET['zoek']);
$sql = "SELECT * FROM pakketten WHERE naam LIKE '%$zoek%'";
}else{
$sql = "SELECT * FROM pakketten";
}

$result=$conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>

<title>PT Pakketten</title>

<style>

body{
font-family:Arial;
background:#f2f6ff;
margin:0;
}

.container{
width:90%;
max-width:1200px;
margin:auto;
margin-top:40px;
}

.lessons{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:25px;
}

.card{
background:white;
border-radius:10px;
overflow:hidden;
box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

.card-image{
height:140px;
background:#dbe6ff;
}

.card-title{
padding:20px;
font-size:22px;
color:#1e5eff;
font-weight:bold;
}

.card-body{
padding:20px;
font-size:14px;
}

.card-body ul{
padding:0;
}

.card-body li{
list-style:none;
margin-bottom:8px;
}

.card-body li:before{
content:"✔ ";
color:#1e5eff;
font-weight:bold;
}

.price-box{
background:#f7f7f7;
padding:15px;
margin-top:15px;
}

.price{
background:#1e5eff;
color:white;
padding:10px;
margin-top:10px;
text-align:center;
font-weight:bold;
}

.button{
margin-top:20px;
background:#2bb673;
color:white;
border:none;
padding:12px 20px;
border-radius:25px;
cursor:pointer;
font-weight:bold;
}

.search-box{
text-align:center;
margin-bottom:30px;
}

.search-box input{
padding:10px;
width:250px;
border-radius:20px;
border:1px solid #ccc;
}

.search-box button{
padding:10px 20px;
border:none;
background:#1e5eff;
color:white;
border-radius:20px;
cursor:pointer;
margin-left:10px;
}

.error{
color:red;
font-weight:bold;
text-align:center;
margin-top:20px;
}

</style>

</head>

<body>

<div class="container">

<div class="search-box">
<form method="GET">

<input type="text" name="zoek" placeholder="Zoek op lesnaam..." value="<?php echo $zoek; ?>">

<button type="submit">Zoeken</button>

</form>
</div>

<div class="lessons">

<?php

if($result->num_rows > 0){

while($row=$result->fetch_assoc()){

echo "

<div class='card'>

<div class='card-image'></div>

<div class='card-title'>
".$row['naam']."
</div>

<div class='card-body'>

<ul>

<li>".$row['feature1']."</li>

<li>".$row['feature2']."</li>

</ul>

<p>".$row['beschrijving']."</p>

<div class='price-box'>

<strong>Prijs</strong>

<div class='price'>
".$row['prijs']."
</div>

</div>

<center>

<button class='button'>Bekijk pakket</button>

</center>

</div>

</div>

";

}

}else{

echo "<div class='error'>Deze les bestaat niet</div>";

}

?>

</div>

</div>

</body>

</html>