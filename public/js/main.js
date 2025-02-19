//////////////////
// POPUP COOKIE //
//////////////////

// SELECTION DES ELEMENTS DU DOM
const modalCookie = new bootstrap.Modal(document.querySelector("#modalCookie"));
const btnCookieRefuse = document.querySelector("#btnCookieRefuse");
const btnCookieAccept = document.querySelector("#btnCookieAccept");


// CONTROLE DE L'EXISTENCE D'UN COOKIE D'ACCEPTATION
fetch("index.php?controller=Utilisateur&action=ctrlCookie")
    .then((response) => response.json()) // On récupère la réponse et on la transforme en objet JSON
    .then((data) => // On récupère les données
    {
        if (!data) modalCookie.show();
    })
    .catch(error => {
        console.error("Erreur:", error);
    });

// ACCEPTATION DES COOKIES
btnCookieAccept.addEventListener("click", () => {
    fetch("index.php?controller=Utilisateur&action=validCookie&cookie=accept")
    .then((response) => response.json()) // On récupère la réponse et on la transforme en objet JSON
    .then((data) => // On récupère les données
    {
        if (data) modalCookie.hide();
    })
    .catch(error => {
        console.error("Erreur:", error);
    });
});

// REFUS DES COOKIES
btnCookieRefuse.addEventListener("click", () => {
    fetch("index.php?controller=Utilisateur&action=validCookie")
    .then((response) => response.json()) // On récupère la réponse et on la transforme en objet JSON
    .then((data) => // On récupère les données
    {
        if (data) modalCookie.hide();
    })
    .catch(error => {
        console.error("Erreur:", error);
    });
});


//////////////////////////////
// FLECHE SCROLL HAUT PAGE  //
//////////////////////////////

// SELECTION DE LA FLECHE
const arrowScroll = document.querySelector("#arrowScroll");


// AFFICHAGE DE LA FLECHE AU SCROLL
window.addEventListener("scroll", () => {   
    if (window.scrollY > 100) {
        arrowScroll.style.visibility = "visible";
    } else {
        arrowScroll.style.visibility = "hidden";
    }
})

// RETOUR HAUT DE PAGE AU CLICK
arrowScroll.addEventListener('click', ()=> {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Pour un défilement doux
    });
});


////////////////////////////////////////
// AFFICHAGE DES CALENDRIERS AU CLICK //
////////////////////////////////////////
// jour.addEventListener("focus", () => {
//    jour.showPicker();
// });