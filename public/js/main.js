////////////////////
// SIDEBAR TOGGLE //
////////////////////

// SELECTION DES ELEMENTS DU DOM
const sidebar = document.querySelector("#accordionSidebar");
const navbarBtn = document.querySelector("#sidebarBtn");
const navbarBtnIcon = document.querySelector("#sidebarBtn i");
const sidebarLabels = document.querySelectorAll("#sidebarLabel");
const sidebarIcons = document.querySelectorAll("#sidebarLogo");

// INITIALISATION DU DERNIER ETAT
let sidebarStatus = JSON.parse(localStorage.getItem("sidebar"));
if (sidebarStatus) {
    fctSidebar();
}

//------------------------------------//
// BASCULEMENT DE LA SIDEBAR AU CLICK //
//------------------------------------//
navbarBtn.addEventListener("click", () => {
    fctSidebar();
    localStorage.setItem("sidebar", JSON.parse(!sidebarStatus));
});

//------------------------//
// FONTION DE BASCULEMENT //
//------------------------//
function fctSidebar() {
    sidebar.classList.toggle("toggled");
    navbarBtnIcon.classList.toggle("bi-caret-left-fill");
    navbarBtnIcon.classList.toggle("bi-caret-right-fill");
    sidebarLabels.forEach(sidebarLabel => {
        sidebarLabel.classList.toggle("d-none");
    });
    sidebarIcons.forEach(sidebarIcon => {
        sidebarIcon.classList.toggle("fs-4");
    });
}

//////////////////////////////
// LIEN ACTIF DE LA SIDEBAR //
//////////////////////////////
const menuItems = document.querySelectorAll("#accordionSidebar .nav-item");
const currentUrl = window.location.href;

menuItems.forEach(menuItem => {
    const menuItemLink = menuItem.querySelector(".nav-link"); 
    const menuItemIcon = menuItem.querySelector(".nav-link i"); 
    const menuItemText = menuItem.querySelector(".nav-link span");  
    if (currentUrl.includes(menuItemLink.href)) {
        menuItem.classList.add("active");
        menuItemIcon.style.color = "#ffff00";
        menuItemText.style.color = "#ffff00";
    }
});

if (currentUrl !== "https://www.cefii-developpements.fr/olivier1422/cefii_market/market_back_office/public/index.php") {
// if (currentUrl !== "http://app.local/CEFii_Market/market_back_office/public/index.php") {
    menuItems[0].classList.remove("active");
    sidebarIcons[0].style.color = "#ffffff";
    sidebarLabels[0].style.color = "#ffffff";
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
// fetch("index.php?controller=User&action=ctrlCookie")
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
//     fetch("index.php?controller=User&action=validCookie&cookie=accept")
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
//     fetch("index.php?controller=User&action=validCookie")
//     .then((response) => response.json()) // On récupère la réponse et on la transforme en objet JSON
//     .then((data) => // On récupère les données
//     {
//         if (data) modalCookie.hide();
//     })
//     .catch(error => {
//         console.error("Erreur:", error);
//     });
// });