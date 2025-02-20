////////////////////////////////////////////////////////////
// 
////////////////////////////////////////////////////////////

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
const token = document.querySelector("#token");
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

// IMPORT DES FONCTIONS DE GESTION DES ERREURS
import { showError, eraseError } from "../module/errorForm.js";


//-----------------------------------------------//
// VALIDATION DES CHAMPS DU FORMULAIRE AU SUBMIT //
//-----------------------------------------------//
document.querySelector("#formCreate").addEventListener("submit", function(event) {
   
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
    if (!passwordRegex.test(password.value)) {
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
        //
    }
});


//-----------------------------------------------//
// VALIDATION DES CHAMPS DU FORMULAIRE EN ERREUR //
//-----------------------------------------------//

//
prenom.addEventListener("input", () => {
    if (prenom.value.length >= 2) {
        eraseError(prenomError);
    }
});

//
nom.addEventListener("input", () => {
    if (nom.value.length >= 2) {
        eraseError(nomError);
    }
});

//
email.addEventListener("input", () => {
    if (emailRegex.test(email.value)) {
        eraseError(emailError);
    }
});

password.addEventListener("input", () => {
    if (passwordRegex.test(password.value)) {
        eraseError(passwordError);
        menuCheck.style.display = "none";
    }
});

//
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