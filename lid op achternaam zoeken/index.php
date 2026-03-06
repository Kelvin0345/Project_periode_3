<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>Zoek op Achternaam</title>
</head>

<body backgroundcolor="#f5f6fa" style="font-family: system-ui, sans-serif; padding: 30px;">

<!-- BLAUW TITELVAK -->
<table backgroundcolor="#eff6ff" border="2" bordercolor="#3b82f6" cellpadding="15" cellspacing="0" width="100%">
    <tr>
        <td>
            <h1 style="margin: 0; color:#1e3a8a; font-size:28px;">Zoek op Achternaam</h1>
            <div style="color:#6b7280;">Vind een lid op basis van achternaam</div>
        </td>
    </tr>
</table>

<br>

<!-- ZOEKVELD -->
<input 
    type="text" 
    id="search" 
    placeholder="Voer achternaam in..." 
    style="width:100%; padding:14px; border:1px solid #93c5fd; border-radius:10px; font-size:16px;"
>

<br><br>

<!-- WIT VAK MET ICON EN TEKST -->
<table width="100%" backgroundcolor="white" border="1" bordercolor="#dbeafe" cellpadding="25" cellspacing="0" style="border-radius:14px;">
    <tr>
        <td align="center" style="color:#6b7280; font-size:16px;">
            <div style="font-size:40px; color:#3b82f6;">🔍</div>
            <b>Begin met typen</b><br>
            <span style="font-size:14px;">Voer een achternaam in om te zoeken naar een lid</span>
        </td>
    </tr>
</table>

<br>

<!-- RESULTATEN TABEL (WORDT AUTOMATISCH GEFILTERD) -->
<table id="resultaten" width="100%" border="1" bordercolor="#dbeafe" cellspacing="0" cellpadding="10" bgcolor="white" style="display:none;">
    <thead backgroundcolor="#eff6ff">
        <tr>
            <th align="left" style="color:#1e3a8a;">Naam</th>
            <th align="left" style="color:#1e3a8a;">Email</th>
            <th align="left" style="color:#1e3a8a;">Telefoon</th>
            <th align="left" style="color:#1e3a8a;">Status</th>
        </tr>
    </thead>
    <tbody id="resultBody"></tbody>
</table>

<script>
// Ledenlijst (zelfde namen als jouw overzicht)
const leden = [
    { achternaam: "van der Berg", naam: "Jan van der Berg", email: "jan.vanderberg@email.nl", tel: "0612345678", status: "Actief" },
    { achternaam: "Jansen", naam: "Emma Jansen", email: "emma.jansen@email.nl", tel: "0623456789", status: "Actief" },
    { achternaam: "de Vries", naam: "Pieter de Vries", email: "pieter.devries@email.nl", tel: "0634567890", status: "Inactief" },
    { achternaam: "Bakker", naam: "Sophie Bakker", email: "sophie.bakker@email.nl", tel: "0645678901", status: "Actief" },
    { achternaam: "Visser", naam: "Thomas Visser", email: "thomas.visser@email.nl", tel: "0656789012", status: "Actief" },
    { achternaam: "Smit", naam: "Lisa Smit", email: "lisa.smit@email.nl", tel: "0667890123", status: "Actief" }
];

document.getElementById("search").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let resultTable = document.getElementById("resultaten");
    let resultBody = document.getElementById("resultBody");

    resultBody.innerHTML = "";

    if (filter.length === 0) {
        resultTable.style.display = "none";
        return;
    }

    let matches = leden.filter(lid => lid.achternaam.toLowerCase().includes(filter));

    if (matches.length === 0) {
        resultBody.innerHTML = "<tr><td colspan='4'>Geen resultaten gevonden</td></tr>";
        resultTable.style.display = "";
        return;
    }

    matches.forEach(lid => {
        resultBody.innerHTML += `
            <tr>
                <td>${lid.naam}</td>
                <td>${lid.email}</td>
                <td>${lid.tel}</td>
                <td><b style="color:${lid.status === "Actief" ? "#16a34a" : "#dc2626"};">${lid.status}</b></td>
            </tr>
        `;
    });

    resultTable.style.display = "";
});
</script>

</body>
</html>
