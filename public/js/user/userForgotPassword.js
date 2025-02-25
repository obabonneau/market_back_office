///////////////////////////////////////////////////////
// SCRIPT DE CONTROLE AVANT CONNEXION AU BACK OFFICE //
///////////////////////////////////////////////////////

// DEFINITION DES REGEX
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const passwordRegex = /^(?=(.*[a-z]))(?=(.*[A-Z]))(?=(.*[0-9]))(?=(.*[!@#$%^&*(),.?":{}|<>[\]\\\/+=~`'_;-]))(?=.{8,}).*$/;
const requirements = {
    length: { regex: /.{8,}/, element: 'length' },
    lowercase: { regex: /[a-z]/, element: 'lowercase' },
    uppercase: { regex: /[A-Z]/, element: 'uppercase' },
    number: { regex: /[0-9]/, element: 'number' },
    special: { regex: /[!@#$%^&*(),.?":{}|<>[\]\\\/+=~`'_;-]/, element: 'special' }
};

// SELECTION DES ELEMENTS DU DOM
const formForgotEmail= document.querySelector("#formForgotEmail");
const formForgotPassword = document.querySelector("#formForgotPassword");
const token = document.querySelector("#token");
const userToken = document.querySelector("#userToken");
const email = document.querySelector("#email");
const password = document.querySelector("#password");
const emailError = document.querySelector("#emailError");
const passwordError = document.querySelector("#passwordError");
const message = document.querySelector("#message");

// IMPORT DES MODULES
import { showError, eraseError } from "../module/modalFormError.js";


//-----------------------------------------//
// VALIDATION DU CHAMP EMAIL DU FORMULAIRE //
//-----------------------------------------//
if (formForgotEmail) {
    formForgotEmail.addEventListener("submit", function (event) {

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

        // SI LE FORMULAIRE EST VALIDE
        if (isValid) {
            forgotPasswordMail(token.value, email.value);
        }
    });
}

//---------------------------------------------------------------//
// CONTROLE ET ENVOI DU MAIL DE REINITIALISATION DU MOT DE PASSE //
//---------------------------------------------------------------//
function forgotPasswordMail(token, email) {

    // REQUETE POUR LA CONNEXION DE L'UTILISATEUR
    fetch("index.php?controller=Utilisateur&action=forgotPasswordEmail",
    {
        method: "POST",
        body: JSON.stringify({
            token: token,
            email: email,
        }),
        headers: {
            "Content-type": "application/json; charset=UTF-8",
        },
    })
        .then((response) => response.json())
        .then((result) => {
            if (result.data) {

                // AFFICHAGE DU MESSAGE DE CONFIRMATION
                formForgotEmail.classList.add("d-none");
                message.classList.remove("d-none");
            } else {

                // AFFICHAGE DU MESSAGE D'ERREUR
                showError(loginError, result.message);
            }
        })
        .catch(error => {
            //console.error("Erreur:", error);
        });
};

//----------------------------------------------//
// VALIDATION DES CHAMPS PASSWORD DU FORMULAIRE //
//----------------------------------------------//
if (formForgotPassword) {
    formForgotPassword.addEventListener("submit", function (event) {

        // EMPECHER L'ENVOI CLASSIQUE DU FORMULAIRE
        event.preventDefault();
        let isValid = true;

        // VALIDATION DU PASSWORD
        if (!passwordRegex.test(password.value)) {
            showError(passwordError, "Le mot de passe n'est pas valide.");
            isValid = false;
        } else {
            eraseError(passwordError);
        }

        // VALIDATION DE LA CONFIRMATION DU PASSWORD
        // A développer

        // SI LE FORMULAIRE EST VALIDE
        if (isValid) {
            forgotPasswordUpdate(token.value, userToken.value, password.value);
        }
    });
}

//----------------------------------------------------------//
// CONTROLE ET MISE A JOUR DU MOT DE PASSE DE L'UTILISATEUR //
//----------------------------------------------------------//
function forgotPasswordUpdate(token, userToken, password) {

    // REQUETE POUR LA CONNEXION DE L'UTILISATEUR
    fetch("index.php?controller=Utilisateur&action=forgotPasswordUpdate",
    {
        method: "POST",
        body: JSON.stringify({
            token: token,
            userToken: userToken,
            password: password,
        }),
        headers: {
            "Content-type": "application/json; charset=UTF-8",
        },
    })
        .then((response) => response.json())
        .then((result) => {
            if (result.data) {
                console.log(result.data);

                // AFFICHAGE DU MESSAGE DE CONFIRMATION
                formForgotPassword.classList.add("d-none");
                message.classList.remove("d-none");
                setTimeout(() => {
                    window.location.href = "index.php";
                }, 3000); 
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
if (email) {
    email.addEventListener("input", () => {
        eraseError(loginError);
        if (emailRegex.test(email.value)) {
            eraseError(emailError);
        }
    });
}

// VALIDATION DU PASSWORD
if (password) {
    password.addEventListener("input", () => {
        eraseError(loginError);
        if (passwordRegex.test(password.value)) {
            eraseError(passwordError);
        }
    });
}