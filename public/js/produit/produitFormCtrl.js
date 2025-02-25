////////////////////////////////////////////////
// SCRIPT POUR LE TEST DU FORMULAIRE PRODUITS //
////////////////////////////////////////////////

// SELECTION DES ELEMENTS DU DOM
const id_categorie = document.querySelector("#id_categorie");
const produit = document.querySelector("#produit");
const marque = document.querySelector("#marque");
const description = document.querySelector("#description");
const prix = document.querySelector("#prix");

const id_categorieError = document.querySelector("#id_categorieError");
const produitError = document.querySelector("#produitError");
const marqueError = document.querySelector("#marqueError");
const descriptionError = document.querySelector("#descriptionError");
const prixError = document.querySelector("#prixError");

// IMPORT DES MODULES
import { modalForm, modalFormId } from "../module/modalForm.js";
import { showError, eraseError } from "../module/modalFormError.js";
import { produitCreate } from "./produitCreate.js";
//import { userUpdate } from "./userUpdate.js";


//-----------------------------------------------//
// VALIDATION DES CHAMPS DU FORMULAIRE AU SUBMIT //
//-----------------------------------------------//
document.querySelector("#form").addEventListener("submit", function(event) {
   
    // EMPECHER L'ENVOI CLASSIQUE DU FORMULAIRE
    event.preventDefault();
    let isValid = true;

    // VALIDATION DE LA CATEGORIE
    if (id_categorie.value === "") {
        showError(id_categorieError, "Veuillez sélectionner une catégorie.");
        isValid = false;
    } else {
        eraseError(id_categorieError);
    }    

    // VALIDATION DU PRODUIT
    if (produit.value.length < 2) {
        showError(produitError, "Le produit doit contenir au moins 2 caractères.");
        isValid = false;
    } else {
        eraseError(produitError);
    }

    // VALIDATION DE LA MARQUE
    if (marque.value.length < 2) {
        showError(marqueError, "La marque doit contenir au moins 2 caractères.");
        isValid = false;
    } else {
        eraseError(marqueError);
    }

    // VALIDATION DE LA DESCRIPTION
    if (description.value.length < 2) {
        showError(descriptionError, "La description doit contenir au moins 2 caractères.");
        isValid = false;
    } else {
        eraseError(descriptionError);
    }

    // VALIDATION DU PRIX
    if (isNaN(prix.value)) {
        showError(prixError, "Le prix doit être un nombre.");
        isValid = false;
    } else {
        eraseError(prixError);
    }

    // SI LE FORMULAIRE EST VALIDE, ON LANCE LA VERIFICATION DU USER ET DU MDP
    if (isValid) {

        // ENVOI DU FORMULAIRE
        if (modalFormId.value === "") {
            produitCreate(this);
        } else {
            //userUpdate(this);
        }

        // RESET DU FORMULAIRE
        this.reset();

        // FERMETURE DE LA MODALE
        modalForm.hide();
    }
});

//-----------------------------------------------//
// VALIDATION DES CHAMPS DU FORMULAIRE EN ERREUR //
//-----------------------------------------------//

// VALIDATION DE LA CATEGORIE
id_categorie.addEventListener("input", () => {
    if (id_categorie.value !== "") {
        eraseError(id_categorieError);
    }
});

// VALIDATION DU PRODUIT
produit.addEventListener("input", () => {
    if (produit.value.length >= 2) {
        eraseError(produitError);
    }
});

// VALIDATION DE LA MARQUE
marque.addEventListener("input", () => {
    if (marque.value.length >= 2) {
        eraseError(marqueError);
    }
});

// VALIDATION DE LA DESCRIPTION
description.addEventListener("input", () => {
    if (description.value.length >= 2) {
        eraseError(descriptionError);
    }
});

// VALIDATION DU PRIX
prix.addEventListener("input", () => {
    if (!isNaN(prix.value)) {
        eraseError(prixError);
    }
});