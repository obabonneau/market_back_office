////////////////////
// SIDEBAR TOGGLE //
////////////////////
const sidebarToggle = document.querySelector("#sidebarToggle");
const sidebarToggleIcon = sidebarToggle.querySelector("i");
const sidebarLabel = document.querySelectorAll("#sidebarLabel");
const sidebarLogo = document.querySelectorAll("#sidebarLogo");

sidebarToggle.addEventListener("click", () => {
    document.querySelector("#accordionSidebar").classList.toggle("toggled");
    sidebarToggleIcon.classList.toggle("bi-caret-left-fill");
    sidebarToggleIcon.classList.toggle("bi-caret-right-fill");
    sidebarLabel.forEach(label => {
        label.classList.toggle("d-none");
    });
    sidebarLogo.forEach(logo => {
        logo.classList.toggle("fa-2x");
    });
});


////////////////////
// FLECHE SCROLL  //
////////////////////

// SELECTION DE LA FLECHE
const arrowScroll = document.querySelector("#arrowScroll");

// AFFICHAGE DE LA FLECHE AU SCROLL
window.addEventListener("scroll", () => {   
    if (window.scrollY > 10) {
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



////////////////////////////////////////
// AFFICHAGE DES CALENDRIERS AU CLICK //
////////////////////////////////////////
// jour.addEventListener("focus", () => {
//    jour.showPicker();
// });