////////////////////
// SIDEBAR TOGGLE //
////////////////////

// SELECTION DES ELEMENTS DU DOM
const sidebarBtn = document.querySelector("#sidebarBtn");
const sidebar = document.querySelector("#accordionSidebar");
const sidebarIcon = document.querySelector("#sidebarBtn i");
const sidebarLabels = document.querySelectorAll("#sidebarLabel");
const sidebarLogos = document.querySelectorAll("#sidebarLogo");

// INITIALISATION DU DERNIER ETAT
let sidebarStatus = JSON.parse(localStorage.getItem("sidebar"));
if (sidebarStatus) {
    fctSidebar();
}

//------------------------------------//
// BASCULEMENT DE LA SIDEBAR AU CLICK //
//------------------------------------//
sidebarBtn.addEventListener("click", () => {
    fctSidebar();
    localStorage.setItem("sidebar", JSON.parse(!sidebarStatus));
});

//------------------------//
// FONTION DE BASCULEMENT //
//------------------------//
function fctSidebar() {
    sidebar.classList.toggle("toggled");
    sidebarIcon.classList.toggle("bi-caret-left-fill");
    sidebarIcon.classList.toggle("bi-caret-right-fill");
    sidebarLabels.forEach(sidebarLabel => {
        sidebarLabel.classList.toggle("d-none");
    });
    sidebarLogos.forEach(sidebarLogo => {
        sidebarLogo.classList.toggle("fs-4");
    });
}


////////////////////
// FLECHE SCROLL  //
////////////////////

// SELECTION DE LA FLECHE
const arrowScroll = document.querySelector("#arrowScroll");

// AFFICHAGE DE LA FLECHE AU SCROLL
window.addEventListener("scroll", () => {   
    if (window.scrollY > 100) {
        arrowScroll.style.display = "inline";
    } else {
        arrowScroll.style.display = "none";
    }
})

// RETOUR HAUT DE PAGE AU CLICK
// arrowScroll.addEventListener('click', ()=> {
//     window.scrollTo({
//         top: 0,
//         behavior: 'smooth' // Pour un défilement doux
//     });
// });


//////////////////
// POPUP COOKIE //
//////////////////

// SELECTION DES ELEMENTS DU DOM
// const modalCookie = new bootstrap.Modal(document.querySelector("#modalCookie"));
// const btnCookieRefuse = document.querySelector("#btnCookieRefuse");
// const btnCookieAccept = document.querySelector("#btnCookieAccept");


// // CONTROLE DE L'EXISTENCE D'UN COOKIE D'ACCEPTATION
// fetch("index.php?controller=Utilisateur&action=ctrlCookie")
//     .then((response) => response.json()) // On récupère la réponse et on la transforme en objet JSON
//     .then((data) => // On récupère les données
//     {
//         if (!data) modalCookie.show();
//     })
//     .catch(error => {
//         console.error("Erreur:", error);
//     });

// // ACCEPTATION DES COOKIES
// btnCookieAccept.addEventListener("click", () => {
//     fetch("index.php?controller=Utilisateur&action=validCookie&cookie=accept")
//     .then((response) => response.json()) // On récupère la réponse et on la transforme en objet JSON
//     .then((data) => // On récupère les données
//     {
//         if (data) modalCookie.hide();
//     })
//     .catch(error => {
//         console.error("Erreur:", error);
//     });
// });

// REFUS DES COOKIES
// btnCookieRefuse.addEventListener("click", () => {
//     fetch("index.php?controller=Utilisateur&action=validCookie")
//     .then((response) => response.json()) // On récupère la réponse et on la transforme en objet JSON
//     .then((data) => // On récupère les données
//     {
//         if (data) modalCookie.hide();
//     })
//     .catch(error => {
//         console.error("Erreur:", error);
//     });
// });