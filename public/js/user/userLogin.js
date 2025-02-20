////////////////////////////////////////////////////////
// SCRIPT DE CONTROLES AVANT CONNEXION AU BACK OFFICE //
////////////////////////////////////////////////////////

// DEFINITION DES REGEX
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const mdpRegex = /^.{4,}$/;

// SELECTION DES ELEMENTS DU DOM
const token = document.querySelector("#token");
const email = document.querySelector("#email");
const password = document.querySelector("#password");
const emailError = document.querySelector("#emailError");
const mdpError = document.querySelector("#mdpError");
const loginError = document.querySelector("#loginError");

// IMPORT DES FONCTIONS DE GESTION DES ERREURS
import { showError, eraseError } from "../module/errorForm.js";

//-----------------------------------------------//
// VALIDATION DES CHAMPS DU FORMULAIRE AU SUBMIT //
//-----------------------------------------------//
document.querySelector("#formLogin").addEventListener("submit", function(event) {
   
    // EMPECHER L'ENVOI CLASSIQUE DU FORMULAIRE
    event.preventDefault();
    let isValid = true;

    // VALIDATION DE L'EMAIL
    if (!emailRegex.test(email.value)) {
        showError(emailError, "L'email n'est pas valide.");
        isValid = false;
    } else {
        eraseError(emailError);
    }

    // VALIDATION DU MOT DE PASSE
    if (!mdpRegex.test(password.value)) {
        showError(mdpError, "Le mdp doit contenir au moins 8 caractères.");
        isValid = false;
    }   else {
        eraseError(mdpError);
    }

    // SI LE FORMULAIRE EST VALIDE, ON LANCE LA VERIFICATION DU USER ET DU MDP
    if (isValid) {
        ctrlUser(token.value, email.value, password.value);
    }
});


//
// 
//
function ctrlUser(token, email, password) {
    fetch("index.php?controller=Utilisateur&action=logon", {
        method: "POST",
        body: JSON.stringify({
            token: token,
            email: email,
            password: password,
        }),
        headers: {
            "Content-type": "application/json; charset=UTF-8",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                window.location.href = "index.php?controller=Home&action=home";
            } else {
                showError(loginError, data.message);
            }
        })
        .catch(error => {
            //console.error("Erreur:", error);
        });
};


//-----------------------------------------------//
// VALIDATION DES CHAMPS DU FORMULAIRE EN ERREUR //
//-----------------------------------------------//

// ECOUTER SUR LE CHAMP DU TITRE
email.addEventListener("input", () => {
    eraseError(loginError);
    if (emailRegex.test(email.value)) {
        eraseError(emailError);
    }
});

// ECOUTEUR SUR LE CHAMP DE L'AUTEUR
password.addEventListener("input", () => {
    eraseError(loginError);
    if (mdpRegex.test(password.value)) {
        eraseError(mdpError);
    }
});