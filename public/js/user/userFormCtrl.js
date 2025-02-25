///////////////////////////////////////////////////
// SCRIPT POUR LE TEST DU FORMULAIRE UTILISATEUR //
///////////////////////////////////////////////////

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
const prenom = document.querySelector("#prenom");
const nom = document.querySelector("#nom");
const email = document.querySelector("#email");
const password = document.querySelector("#password");
const statut = document.querySelector("#statut");

const prenomError = document.querySelector("#prenomError");
const nomError = document.querySelector("#nomError");
const emailError = document.querySelector("#emailError");
const passwordError = document.querySelector("#passwordError");
const statutError = document.querySelector("#statutError");

const passwordShow = document.querySelector("#passwordShow");
const menuCheck = document.querySelector("#menuCheck");

// IMPORT DES MODULES
import { modalForm, modalFormId } from "../module/modalForm.js";
import { showError, eraseError } from "../module/modalFormError.js";
import { userCreate } from "./userCreate.js";
import { userUpdate } from "./userUpdate.js";


//-----------------------------------------------//
// VALIDATION DES CHAMPS DU FORMULAIRE AU SUBMIT //
//-----------------------------------------------//
document.querySelector("#form").addEventListener("submit", function(event) {
   
    // EMPECHER L'ENVOI CLASSIQUE DU FORMULAIRE
    event.preventDefault();
    let isValid = true;

    // VALIDATION DU PRENOM
    if (prenom.value.length < 2) {
        showError(prenomError, "Le prénom doit contenir au moins 2 caractères.");
        isValid = false;
    } else {
        eraseError(prenomError);
    }

    // VALIDATION DU NOM
    if (nom.value.length < 2) {
        showError(nomError, "Le nom doit contenir au moins 2 caractères.");
        isValid = false;
    } else {
        eraseError(nomError);
    }

    // VALIDATION DE L'EMAIL
    if (!emailRegex.test(email.value)) {
        showError(emailError, "L'email n'est pas valide.");
        isValid = false;
    } else {
        eraseError(emailError);
    }

    // VALIDATION DU MOT DE PASSE
    if (((!passwordRegex.test(password.value)) && ((modalFormId.value === ""))) || (((!passwordRegex.test(password.value)) && (password.value !== "") && (modalFormId.value !== "")))) {
        showError(passwordError, "Le mdp n'est pas valide.");
        isValid = false;
    }   else {
        eraseError(passwordError);
    }

    // VALIDATION DU STATUT
    if (statut.value === "") {
        showError(statutError, "Veuillez sélectionner un statut.");
        isValid = false;
    } else {
        eraseError(statutError);
    }

    // SI LE FORMULAIRE EST VALIDE, ON LANCE LA VERIFICATION DU USER ET DU MDP
    if (isValid) {

        // ENVOI DU FORMULAIRE
        if (modalFormId.value === "") {
            userCreate(this);
        } else {
            userUpdate(this);
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

// VALIDATION DU PRENOM
prenom.addEventListener("input", () => {
    if (prenom.value.length >= 2) {
        eraseError(prenomError);
    }
});

// VALIDATION DU NOM
nom.addEventListener("input", () => {
    if (nom.value.length >= 2) {
        eraseError(nomError);
    }
});

// VALIDATION DE L'EMAIL
email.addEventListener("input", () => {
    if (emailRegex.test(email.value)) {
        eraseError(emailError);
    }
});

// VALIDATION DU MOT DE PASSE
password.addEventListener("input", () => {
    if (passwordRegex.test(password.value)) {
        eraseError(passwordError);
        menuCheck.style.display = "none";
    }
});

// VALIDATION DU STATUT
statut.addEventListener("input", () => {
    if (statut.value !== "") {
        eraseError(statutError);
    }
});


//------------------------------------//
// AFFICHAGE DU MOT DE PASSE EN CLAIR //
//------------------------------------//
passwordShow.addEventListener("change", () => {
    if (passwordShow.checked) {
        password.type = "text";
    } else {
        password.type = "password";
    }
});


//-----------------------------------------------//
// AFFICHAGE DU MENU DE CONTROLE DU MOT DE PASSE //
//-----------------------------------------------//
password.addEventListener("click", (event) => {
    if (!passwordRegex.test(password.value)) {
        menuCheck.style.display = "block";
        event.stopPropagation(); // Empêche la propagation pour éviter la fermeture immédiate
    }
});

// FERMETURE DU MENU DE CONTROLE EN DEHORS DE LA ZONE
document.addEventListener("click", () => {
    menuCheck.style.display = "none";
});

// EMPECHER LA FERMETURE DU MENU DE CONROLE EN CLIQUANT DEDANS
menuCheck.addEventListener("click", (event) => {
    event.stopPropagation();
});


//------------------------------//
// VERIFICATION DU MOT DE PASSE //
//------------------------------//
password.addEventListener("input", () => {
    checkPassword(password.value);
});

// FONCTION DE VERIFICATION DU MOT DE PASSE
function checkPassword(pwd) {
    Object.values(requirements).forEach(({ regex, element }) => {
        const isOk = regex.test(pwd);
        checkDisplay(`#${element}`, isOk);
    });
}

// FONCTION D'AFFICHAGE DE L'ICONE DE VALIDATION
function checkDisplay(unit, isOk) {
    const element = document.querySelector(unit);
    const addClasses = isOk ? ["bi-check-circle-fill", "text-success"] : ["bi-x-circle-fill", "text-danger"];
    const removeClasses = isOk ? ["bi-x-circle-fill", "text-danger"] : ["bi-check-circle-fill", "text-success"]; 
    element.classList.remove(...removeClasses); //... pour extraire les éléments du tableau
    element.classList.add(...addClasses);
}