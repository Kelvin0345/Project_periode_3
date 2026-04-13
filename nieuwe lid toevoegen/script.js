function voegLidToe(){

let voornaam = document.getElementById("voornaam").value;
let achternaam = document.getElementById("achternaam").value;
let email = document.getElementById("email").value;

let message = document.getElementById("errorMessage");

if(voornaam === "" || achternaam === "" || email === ""){

message.innerText = "Het lid kan niet worden aangemaakt. Vul alle velden in.";
message.className = "error";
return;

}

message.innerText = "Lid succesvol toegevoegd!";
message.className = "success";

}