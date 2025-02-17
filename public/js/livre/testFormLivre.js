//////////////////////////////////////
// SCRIPT POUR TESTER LE FORMULAIRE //
//////////////////////////////////////

// SELECTION DES ELEMENTS DU DOM
const titre = document.querySelector("#titre");
const auteur = document.querySelector("#auteur");
const genre = document.querySelector("#genre");
const annee = document.querySelector("#annee");

const titreError = document.querySelector("#titreError");
const auteurError = document.querySelector("#auteurError");
const genreError = document.querySelector("#genreError");
const anneeError = document.querySelector("#anneeError");

const modalFormulaire = new bootstrap.Modal(document.querySelector("#modalFormCreate"));

// IMPORTATION DES FONCTIONS
import { addLivre } from "./modules/addLivre.js";

//-----------------------------------------------//
// VALIDATION DES CHAMPS DU FORMULAIRE AU SUBMIT //
//-----------------------------------------------//
document.querySelector("#form").addEventListener("submit", function(event) {
   
    // EMPECHER L'ENVOI DU FORMULAIRE
    event.preventDefault();
    let isValid = true;

    // VALIDATION DU TITRE
    if (titre.value.length < 3) {
        afficherErreur(titreError, "Le titre doit contenir au moins 3 caractères.");
        isValid = false;
    } else {
        effacerErreur(titreError);
    }

    // VALIDATION DE L'AUTEUR
    if (auteur.value.length < 3) {
        afficherErreur(auteurError, "L'auteur doit contenir au moins 3 caractères.");
        isValid = false;
    } else {
        effacerErreur(auteurError);
    }

    // VALIDATION DU GENRE
    if (genre.value.length < 3) {
        afficherErreur(genreError, "Le genre doit contenir au moins 3 caractères.");
        isValid = false;
    } else {
        effacerErreur(genreError);
    }

    // VALIDATION DE L'ANNEE
    if (annee.value.length !== 4) {
        afficherErreur(anneeError, "L'année doit contenir 4 caractères.");
        isValid = false;
    } else {
        effacerErreur(anneeError);
    }

    // ENVOI DU FORMULAIRE SI TOUT EST VALIDE
    if (isValid) {

        // ENVOI DU FORMULAIRE
        addLivre(this); // Appelle le module addLivre.js dans modules/addLivre.js
        //this.submit();

        // RESET DU FORMULAIRE
        this.reset();    
        //containerImage.classList.add("d-none");
        //showImage.src = "";

        // FERMETURE DE LA MODALE
        modalFormulaire.hide();
    }
});


//-----------------------------------------------//
// VALIDATION DES CHAMPS DU FORMULAIRE EN ERREUR //
//-----------------------------------------------//

// ECOUTER SUR LE CHAMP DU TITRE
titre.addEventListener("input", () => {
    if (titre.value.length >= 3) {
        effacerErreur(titreError);
    }
});

// ECOUTEUR SUR LE CHAMP DE L'AUTEUR
auteur.addEventListener("input", () => {
    if (auteur.value.length >= 3) {
        effacerErreur(auteurError);
    }
});

// ECOUTEUR SUR LE CHAMP DU GENRE
genre.addEventListener("input", () => {
    if (genre.value.length >= 3) {
        effacerErreur(genreError);
    }
});

// ECOUTEUR SUR LE CHAMP DE L'ANNEE
annee.addEventListener("input", () => {
    if (annee.value.length === 4) {
        effacerErreur(anneeError);
    }
});


//----------------------------------//
// FONCTION D'AFFICHAGE DES ERREURS //
//----------------------------------//

// FONCTION POUR AFFICHER LES ERREURS
function afficherErreur(champErreur, message) {
    champErreur.textContent = message;
    champErreur.style.display = "block";
}

// FONCTION POUR EFFACER LES ERREURS
function effacerErreur(champErreur) {
    champErreur.textContent = "";
    champErreur.style.display = "none";
}