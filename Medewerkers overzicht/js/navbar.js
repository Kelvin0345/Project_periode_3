const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');
const menuSluit  = document.getElementById('menuSluit');

function sluitMenu() {
    hamburger.classList.remove('open');
    mobileMenu.classList.remove('open');
}

hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    mobileMenu.classList.toggle('open');
});

// Sluit knop binnen het menu
menuSluit.addEventListener('click', sluitMenu);

// Sluit bij klikken op een link
mobileMenu.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', sluitMenu);
});