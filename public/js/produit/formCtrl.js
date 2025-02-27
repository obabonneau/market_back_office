////////////////////////////////////////////////
// SCRIPT POUR LE TEST DU FORMULAIRE PRODUITS //
////////////////////////////////////////////////

// SELECTION DES ELEMENTS DU DOM
const id_categorie = document.querySelector("#id_categorie");
const produit = document.querySelector("#produit");
const marque = document.querySelector("#marque");
const description = document.querySelector("#description");
const prix = document.querySelector("#prix");
const image = document.querySelector("#image");

const id_categorieError = document.querySelector("#id_categorieError");
const produitError = document.querySelector("#produitError");
const marqueError = document.querySelector("#marqueError");
const descriptionError = document.querySelector("#descriptionError");
const prixError = document.querySelector("#prixError");
const imageError = document.querySelector("#imageError");

// IMPORT DES MODULES
import { modalForm, modalFormId } from "../module/modalForm.js";
import { showError, eraseError } from "../module/modalFormError.js";
import { imageCtrl } from "./image.js";
import { create } from "./create.js";

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
    if (prix.value === "") {
        showError(prixError, "Le prix est vide.");
        isValid = false;
    } else {
        eraseError(prixError);
    }

    // VALIDATION DE L'IMAGE
    if (image.files.length === 0) {
        showError(imageError, "Veuillez sélectionner une image.");
        isValid = false;
     } else {
     
         //SI FICHIER EXISTANT, ON VERIFIE QU'IL S'AGIT D'UNE IMAGE
        if (imageCtrl(image) !== "OK") {
            showError(imageError, imageCtrl(image));
            isValid = false;
        } else {
            eraseError(imageError);
        }
     }
    
    // SI LE FORMULAIRE EST VALIDE, ON LANCE LA VERIFICATION DU USER ET DU MDP
    if (isValid) {
        
        // ENVOI DU FORMULAIRE
        if (modalFormId.value === "") {
            create(this);
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
    if (prix.value !== "") {
        eraseError(prixError);
    }
});

// VALIDATION DE L'IMAGE
image.addEventListener("input", () => {
    if (imageCtrl(image) === "OK") {
        eraseError(imageError);
    }
});





prix.addEventListener("input", function () {
    // Remplace le point par une virgule
    prix.value = prix.value.replace(".", ",");
    
    // Supprime tous les caractères qui ne sont pas des chiffres ou une virgule
    prix.value = prix.value.replace(/[^0-9,]/g, "");

    // Limite à deux décimales après la virgule
    let parts = prix.value.split(",");
    if (parts[1] && parts[1].length > 2) {
        parts[1] = parts[1].slice(0, 2); // garde seulement 2 décimales
    }
    prix.value = parts.join(",");
});