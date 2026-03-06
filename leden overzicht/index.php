<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>FitForFun Ledenbeheersysteem</title>
</head>

<body bgcolor="#f5f6fa" style="font-family: system-ui, sans-serif; padding: 30px;">


</td>
</tr>
</table>

<br>

<!-- BLAUW TITELVAK -->
<table bgcolor="#eff6ff" border="2" bordercolor="#3b82f6" cellpadding="15" cellspacing="0" width="100%">
<tr>
<td>
<h1 style="margin: 0; color:#1e3a8a; font-size:28px;">FitForFun Ledenbeheersysteem</h1>
<div style="color:#6b7280;">Overzicht van alle leden</div>
</td>
</tr>
</table>

<br>

<!-- STATISTIEKEN -->
<table width="100%" cellspacing="15">
<tr>

<td>
<table bgcolor="white" border="1" bordercolor="#dbeafe" cellpadding="15" width="100%">
<tr>
<td>
<b style="color:#3b82f6;">Totaal leden</b><br>
<span style="font-size:24px; color:#1e40af;">6</span>
</td>
</tr>
</table>
</td>

<td>
<table bgcolor="white" border="1" bordercolor="#dbeafe" cellpadding="15" width="100%">
<tr>
<td>
<b style="color:#3b82f6;">Actieve leden</b><br>
<span style="font-size:24px; color:#1e40af;">5</span>
</td>
</tr>
</table>
</td>

<td>
<table bgcolor="white" border="1" bordercolor="#dbeafe" cellpadding="15" width="100%">
<tr>
<td>
<b style="color:#3b82f6;">Inactieve leden</b><br>
<span style="font-size:24px; color:#1e40af;">1</span>
</td>
</tr>
</table>
</td>

<td>
<table bgcolor="white" border="1" bordercolor="#dbeafe" cellpadding="15" width="100%">
<tr>
<td>
<b style="color:#3b82f6;">Activiteitspercentage</b><br>
<span style="font-size:24px; color:#1e40af;">83%</span>
</td>
</tr>
</table>
</td>

</tr>
</table>

<!-- ZOEKVELD -->
<input 
type="text" 
id="search" 
placeholder="Zoek op naam, email of stad..." 
style="width:100%; padding:12px; border:1px solid #93c5fd; border-radius:10px; font-size:15px;"
>

<br><br>

<!-- LEDENTABEL -->
<table id="ledenTabel" width="100%" border="1" bordercolor="#dbeafe" cellspacing="0" cellpadding="10" bgcolor="white">

<thead bgcolor="#eff6ff">
<tr>
<th align="left" style="color:#1e3a8a;">Naam</th>
<th align="left" style="color:#1e3a8a;">Leeftijd</th>
<th align="left" style="color:#1e3a8a;">Contact</th>
<th align="left" style="color:#1e3a8a;">Adres</th>
<th align="left" style="color:#1e3a8a;">Lid sinds</th>
<th align="left" style="color:#1e3a8a;">Status</th>
</tr>
</thead>

<tbody>

<tr>
<td>Jan van der Berg<br><small>ID: 1</small></td>
<td>35 jaar<br>12-04-1990</td>
<td>jan.vanderberg@email.nl<br>0612345678</td>
<td>Hoofdstraat 12<br>1012AB Amsterdam</td>
<td>15-01-2024</td>
<td><b style="color:#16a34a;">Actief</b></td>
</tr>

<tr>
<td>Emma Jansen<br><small>ID: 2</small></td>
<td>30 jaar<br>23-09-1995</td>
<td>emma.jansen@email.nl<br>0623456789</td>
<td>Dorpsweg 45<br>3011CD Rotterdam</td>
<td>03-02-2024</td>
<td><b style="color:#16a34a;">Actief</b></td>
</tr>

<tr>
<td>Pieter de Vries<br><small>ID: 3</small></td>
<td>37 jaar<br>05-11-1988</td>
<td>pieter.devries@email.nl<br>0634567890</td>
<td>Stationslaan 3<br>3511EF Utrecht</td>
<td>22-11-2023</td>
<td><b style="color:#dc2626;">Inactief</b></td>
</tr>

<tr>
<td>Sophie Bakker<br><small>ID: 4</small></td>
<td>33 jaar<br>08-03-1991</td>
<td>sophie.bakker@email.nl<br>0645678901</td>
<td>Kerkstraat 78<br>5611GH Eindhoven</td>
<td>08-03-2024</td>
<td><b style="color:#16a34a;">Actief</b></td>
</tr>

<tr>
<td>Thomas Visser<br><small>ID: 5</small></td>
<td>41 jaar<br>30-01-1983</td>
<td>thomas.visser@email.nl<br>0656789012</td>
<td>Parklaan 9<br>9721JZ Groningen</td>
<td>19-04-2024</td>
<td><b style="color:#16a34a;">Actief</b></td>
</tr>

<tr>
<td>Lisa Smit<br><small>ID: 6</small></td>
<td>27 jaar<br>14-12-1996</td>
<td>lisa.smit@email.nl<br>0667890123</td>
<td>Lindelaan 25<br>8011KL Zwolle</td>
<td>12-05-2024</td>
<td><b style="color:#16a34a;">Actief</b></td>
</tr>

</tbody>
</table>

<script>
document.getElementById("search").addEventListener("keyup", function () {

let filter = this.value.toLowerCase();
let rows = document.querySelectorAll("#ledenTabel tbody tr");

rows.forEach(row => {

let text = row.innerText.toLowerCase();
row.style.display = text.includes(filter) ? "" : "none";

});

});
</script>

</body>
</html>