<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>FitForFun Ledenbeheersysteem</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<header>
<h1>FitForFun Ledenbeheersysteem</h1>
<p>Overzicht van alle leden</p>
</header>

<table>

<thead>
<tr>
<th>Naam</th>
<th>Leeftijd</th>
<th>Status</th>
</tr>
</thead>

<tbody>

<tr onclick="showMember(1)">
<td>Jan van der Berg</td>
<td>35 jaar</td>
<td class="active">Actief</td>
</tr>

<tr onclick="showMember(2)">
<td>Emma Jansen</td>
<td>30 jaar</td>
<td class="active">Actief</td>
</tr>

<tr onclick="showMember(3)">
<td>Pieter de Vries</td>
<td>37 jaar</td>
<td class="inactive">Inactief</td>
</tr>

<tr onclick="showMember(4)">
<td>Sophie Bakker</td>
<td>33 jaar</td>
<td class="active">Actief</td>
</tr>

</tbody>

</table>

</div>

<!-- Popup met alle gegevens -->
<div id="memberPopup" class="popup">
<div class="popup-content">

<span class="close" onclick="closePopup()">X</span>

<h2>Lid gegevens</h2>

<div id="memberInfo"></div>

</div>
</div>

<script src="script.js"></script>

</body>
</html>