///////////////////////////////////////////////////////
// SCRIPT DE CONTROLE AVANT CONNEXION AU BACK OFFICE //
///////////////////////////////////////////////////////

// DEFINITION DES REGEX
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const passwordRegex = /^.{8,}$/;

// SELECTION DES ELEMENTS DU DOM
const formLogin = document.querySelector("#formLogin");
const token = document.querySelector("#token");
const email = document.querySelector("#email");
const password = document.querySelector("#password");
const emailError = document.querySelector("#emailError");
const passwordError = document.querySelector("#passwordError");
const loginError = document.querySelector("#loginError");

// IMPORT DES MODULES
import { showError, eraseError } from "../module/modalFormError.js";


//-----------------------------------------------//
// VALIDATION DES CHAMPS DU FORMULAIRE AU SUBMIT //
//-----------------------------------------------//
formLogin.addEventListener("submit", function(event) {
   
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
    if (!passwordRegex.test(password.value)) {
        showError(passwordError, "Le mdp doit contenir au moins 8 caractères.");
        isValid = false;
    }   else {
        eraseError(passwordError);
    }

    // SI LE FORMULAIRE EST VALIDE, ON LANCE LA VERIFICATION DU USER ET DU MDP
    if (isValid) {
        ctrlUser(token.value, email.value, password.value);
    }
});


//----------------------------------------//
// CONTROLE DES IDENTIFIANTS DE CONNEXION //
//----------------------------------------//
function ctrlUser(token, email, password) {

    // REQUETE POUR LA CONNEXION DE L'UTILISATEUR
    fetch("index.php?controller=Utilisateur&action=logon",
    {
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
        .then((result) => {
            if (result.data) {

                // REDIRECTION VERS LA PAGE D'ACCUEIL
                window.location.href = "index.php";
            } else {

                // AFFICHAGE DU MESSAGE D'ERREUR
                showError(loginError, result.message);
            }
        })
        .catch(error => {
            //console.error("Erreur:", error);
        });
};


//-----------------------------------------------//
// VALIDATION DES CHAMPS DU FORMULAIRE EN ERREUR //
//-----------------------------------------------//

// VALIDATION DE L'EMAIL
email.addEventListener("input", () => {
    eraseError(loginError);
    if (emailRegex.test(email.value)) {
        eraseError(emailError);
    }
});

// VALIDATION DU MOT DE PASSE
password.addEventListener("input", () => {
    eraseError(loginError);
    if (passwordRegex.test(password.value)) {
        eraseError(passwordError);
    }
});