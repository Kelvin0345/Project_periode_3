const members = {

1:{
name:"Jan van der Berg",
age:"35 jaar",
birthday:"12-04-1990",
email:"jan.vanderberg@email.nl",
phone:"0612345678",
address:"Hoofdstraat 12, Amsterdam",
since:"15-01-2024",
status:"Actief"
},

2:{
name:"Emma Jansen",
age:"30 jaar",
birthday:"23-09-1995",
email:"emma.jansen@email.nl",
phone:"0623456789",
address:"Dorpsweg 45, Rotterdam",
since:"03-02-2024",
status:"Actief"
},

3:{
name:"Pieter de Vries",
age:"37 jaar",
birthday:"05-11-1988",
email:"pieter.devries@email.nl",
phone:"0634567890",
address:"Stationslaan 3, Utrecht",
since:"22-11-2023",
status:"Inactief"
}

}

function showMember(id){

const member = members[id]

// ✅ HAPPY SCENARIO
if(member){

document.getElementById("memberInfo").innerHTML = `
<p><b>Naam:</b> ${member.name}</p>
<p><b>Leeftijd:</b> ${member.age}</p>
<p><b>Geboortedatum:</b> ${member.birthday}</p>
<p><b>Email:</b> ${member.email}</p>
<p><b>Telefoon:</b> ${member.phone}</p>
<p><b>Adres:</b> ${member.address}</p>
<p><b>Lid sinds:</b> ${member.since}</p>
<p><b>Status:</b> ${member.status}</p>
`;

document.getElementById("memberPopup").style.display = "block";

}

// ❌ UNHAPPY SCENARIO
else{

alert("Geen gegevens beschikbaar voor dit lid.");

}

}

function closePopup(){
document.getElementById("memberPopup").style.display = "none";
}